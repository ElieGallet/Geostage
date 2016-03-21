<?php
/*
This script assignes GPS coordinates to each internship location (company address)
It modifies the JSON file generated from the database
*/

/* FGC en UTF 8 */
function get_file_contents_utf8($fn) {
	$content = file_get_contents($fn);
	return mb_convert_encoding($content, 'UTF-8', mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
}

/* callback function */
function stringF($string, $callback){
	$results = $string;
	if(is_callable($callback)){
		call_user_func($callback, $results);
	}
}

function jsonRemoveUnicodeSequences($struct){
	return str_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($struct));
}

/* Open JSON file and fetch its contents */
$fileJSON = $_SERVER['DOCUMENT_ROOT'] . '/PIFE/data-access/json/company.json';
$file = fopen($fileJSON, 'r');
$contentFile = fgets($file);
fclose ($file);

/* Decode contents */
$decoded = json_decode(trim($contentFile), true);

/* Initialisation */
$i = 0;
$sauvegardeResultats = array();
$detectSimilar = array(
	'mail' => NULL,
	'dateDebut' => NULL,
	'dateFin' => NULL
	);

// DEBUG - LIMITES POUR LES ADRESSES
$limiteTest = 600;

/* Data treatment */

foreach($decoded as $doc){
	$success = true;
	$address = $doc['address'] . ' ' . $doc['street'] . ' ' . $doc['cedex'] . ' ' . $doc['postal_code'] . ' ' . $doc['city'] . ' ' . $doc['country'];
	$offers = array();
	$offers = $business->getInternshipOffers($doc['id']);
	$doc['offers'] = array();
	if($offers){
		foreach($offers as $offer){
			array_push($doc['offers'], $offer['file_name']);
		}
	}

	/* Transform address into GPS coordinates */
	$concatAdresse = trim($address);
	$adressePourUrl = urlencode($concatAdresse);
	$adresseGoogle = "http://maps.google.com/maps/api/geocode/json?address={$adressePourUrl}&sensor=false";
	if($i < $limiteTest){
		$moissonGoogle = get_file_contents_utf8($adresseGoogle);
		$decodeGoogle = json_decode($moissonGoogle, true);
		if(isset($decodeGoogle["results"]["0"]["geometry"]["location"]["lat"])){
			$doc[] = array(
				$decodeGoogle["results"]["0"]["geometry"]["location"]["lng"],
				$decodeGoogle["results"]["0"]["geometry"]["location"]["lat"]
				);
			$i++;
			usleep(120);
		}
		else{
			$adresseMapbox = "https://api.mapbox.com/v4/geocode/mapbox.places/{$adressePourUrl}.json?access_token=pk.eyJ1Ijoia2V2aW5zZSIsImEiOiJjaWZpZHhoOWkwMHdndGNseGRxc3A0d3U1In0.N5FbDKd9BQlcYh8bwsLVCA";
			$moissonMapbox = get_file_contents_utf8($adresseMapbox);
			$decodeMapbox = json_decode($moissonMapbox, true);
			if(isset($decodeMapbox["features"]["0"]["geometry"]["coordinates"][0])){
				$doc[] = array(
					$decodeMapbox["features"]["0"]["geometry"]["coordinates"][0],
					$decodeMapbox["features"]["0"]["geometry"]["coordinates"][1]
					);
				$i++;
				usleep(120);
			}
			else{
				$success = false; // API failed to transform address (RIP)
			}
		}
	}
	if($success != false){
		$sauvegardeResultats[] = $doc;
	}
}

$renvoi['company'] = $sauvegardeResultats;

$fileGeoJSON = $_SERVER['DOCUMENT_ROOT'] . '/PIFE/data-access/json/company.geojson';
file_put_contents($fileGeoJSON, jsonRemoveUnicodeSequences($renvoi));

require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/create-map-geojson.php');

?>
