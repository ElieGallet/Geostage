<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/init.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/auth-admin.php');?>

<?php
setlocale(LC_ALL, 'fr', 'fr_FR', 'fr_FR.UTF-8');
setlocale(LC_CTYPE, 'fr_FR.UTF-8');

/* FGC en UTF 8 */
function file_get_contents_utf8($fn) {
	$content = file_get_contents($fn);
	return mb_convert_encoding($content, 'UTF-8',
		mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
}

/* Opening GeoJSON file */
$fileGeoJSON = $_SERVER['DOCUMENT_ROOT'] . '/PIFE/data-access/json/company.geojson';
$file = fopen($fileGeoJSON, 'r');
$contentFile = fgets($file);
fclose ($file);

$decoded = json_decode(trim($contentFile), true);

$i = 0;
$sauvegardeResultats = array();
$sauvegardeResultats['features'] = array();


/* Data Treatment */
foreach ($decoded['company'] as $company) {

	$fetchedCompany['type'] = 'Feature';

	$fetchedCompany['properties']['id'] = $company['id'];
	$fetchedCompany['properties']['siret'] = $company['siret'];
	$fetchedCompany['properties']['sector'] = $company['sector'];
	$fetchedCompany['properties']['level'] = $company['level'];
	$fetchedCompany['properties']['offers'] = $company['offers'];
	$fetchedCompany['properties']['name'] = $company['name'];
	$fetchedCompany['properties']['street'] = $company['street'];
	$fetchedCompany['properties']['postal_code'] = $company['postal_code'];
	$fetchedCompany['properties']['city'] = $company['city'];
	$fetchedCompany['properties']['country'] = $company['country'];
	$fetchedCompany['properties']['description'] = $company['description'];
	$fetchedCompany['properties']['phone'] = $company['phone'];
	$fetchedCompany['properties']['tutor'] = $company['tutor'];
	$fetchedCompany['properties']['website'] = $company['website'];

	/* GPS coordinates transformation */
	if(isset($company[16])) { // a bit tricky, 16 is actually the number of the row where coordinates are located
		$fetchedCompany['geometry']['type'] = 'Point';
		$fetchedCompany['geometry']['coordinates'] = array(
			$company[16][0],
			$company[16][1]
			);
		$sauvegardeResultats['features'][] = $fetchedCompany;
	}
}

$fileMap = $_SERVER['DOCUMENT_ROOT'] . '/PIFE/data-access/json/map.geojson';
file_put_contents($fileMap, json_encode($sauvegardeResultats));
?>
