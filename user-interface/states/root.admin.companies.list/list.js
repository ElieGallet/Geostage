var $table = $('#table'),
$remove = $('#deleteSelectionButton'),
$confirmRemove = $('#confirmRemove'),
$send = $('#emailSelectionButton'),
$data,
selections = [];

function initTable(){
	$.post( 
		"/business-logic/services/generate-company-json.php"
		)
	.done(
		function(data) {
			console.log(data);
			$data = JSON.parse(data);
			$table.bootstrapTable({
				height: getHeight(),
				columns: [
				[
				{
					field: 'state',
					checkbox: true,
					align: 'center',
					valign: 'middle'
				}, {
					field: 'username',
					title: 'Username',
					sortable: true,
					editable: false,
					footerFormatter: totalNameFormatter,
					align: 'center'
				}, {
					field: 'name',
					title: 'Name',
					sortable: true,
					align: 'center',
					editable: false,
					footerFormatter: totalNameFormatter
				}, {
					field: 'sector',
					title: 'Theme',
					sortable: true,
					align: 'center',
					editable: false,
					footerFormatter: totalNameFormatter
				}, {
					field: 'level',
					title: 'Level',
					sortable: true,
					align: 'center',
					editable: false,
					footerFormatter: totalNameFormatter
				}, {
					field: 'operate',
					title: '',
					align: 'center',
					events: operateEvents,
					formatter: operateFormatter
				}
				]
				],
				data: $data
			});
		}
		);
	setTimeout(function () {
		$table.bootstrapTable('resetView');
	}, 200);
	$table.on('check.bs.table uncheck.bs.table ' +
		'check-all.bs.table uncheck-all.bs.table', function () {
			$remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
			$send.prop('disabled', !$table.bootstrapTable('getSelections').length);
// save your data, here just save the current page
selections = getIdSelections();
// push or splice the selections if you want to save all data selections
});
	$table.on('expand-row.bs.table', function (e, index, row, $detail) {
/*if(index % 2 == 1) {
$detail.html('Loading from ajax request...');
$.get('LICENSE', function (res) {
$detail.html(res.replace(/\n/g, '<br>'));
});
}*/
});

	$table.on('all.bs.table', function (e, name, args) {
		console.log(name, args);
	});

	$confirmRemove.click(function () {
		var ids = getIdSelections();
		$remove.prop('disabled', true);
		$send.prop('disabled', true);
		ids.forEach(function(id){

			$table.bootstrapTable('remove', {
				field: 'id',
				values: [id]
			});

			var xhr = new XMLHttpRequest();
			xhr.open("GET", "/business-logic/services/delete-company.php?id="+id, true);
			xhr.send(null);

		});

		$("#myModal2").modal("hide");
		$('body').removeClass('modal-open');
		$('.modal-backdrop').remove();
	});
	$(window).resize(function () {
		$table.bootstrapTable('resetView', {
			height: getHeight()
		});
	});
}

function getIdSelections() {
	return $.map($table.bootstrapTable('getSelections'), function (row) {
		return row.id
	});
}

function responseHandler(res) {
	$.each(res.rows, function (i, row) {
		row.state = $.inArray(row.id, selections) !== -1;
	});
	return res;
}

function detailFormatter(index, row) {
	var html = [];
	$.each(row, function (key, value) {
		html.push('<p><b>' + key + ':</b> ' + value + '</p>');
	});
	return html.join('');
}

function operateFormatter(value, row, index) {
	return [
	'<a class="send" href="javascript:void(0)" title="Send">',
	'<i class="glyphicon glyphicon-envelope"></i>',
	'</a>    ',
	'<div class="modal fade" id="myModalSender'+row.id+'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">',
	'<div class="modal-dialog">',
	'<!-- Modal content-->',
	'<div class="modal-content">',
	'<!-- Modal Header -->',
	'<div class="modal-header">',
	'<button type="button" class="close" data-dismiss="modal">',
	'<span aria-hidden="true">&times;</span>',
	'<span class="sr-only">Close</span>',
	'</button>',
	'<h4 class="modal-title" id="myModalLabel">',
	'Email to '+ row.name + ' ',
	'</h4>',
	'</div>',
	'<!-- Modal Body -->',
	'<div class="modal-body">',
	'<textarea id="emailContent'+row.id+'" class="form-control" rows="5" style="resize: none;" name="content" form="emailForm" placeholder="enter your text here..."></textarea>',
	'</div>',
	'<div class="modal-footer">',
	'<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>',
	'<button id="confirmSend'+row.id+'" type="button" class="btn btn-primary">Send</button>',
	'</div>',
	'</div>',
	'</div>',
	'</div>',

	'<a class="modify" href="./../root.admin.companies.update/update.php?id='+ row.id +'" title="Modify">',
	'<i class="glyphicon glyphicon-pencil"></i>',
	'</a>    ',

	'<a class="remove" href="javascript:void(0)" data-toggle="modal" title="Remove">',
	'<i class="glyphicon glyphicon-remove"></i>',
	'</a>',
	'<div class="modal fade" id="myModal" role="dialog">',
	'<div class="modal-dialog">',
	'<!-- Modal content-->',
	'<div class="modal-content">',
	'<div class="modal-header">',
	'<button type="button" class="close" data-dismiss="modal">&times;</button>',
	'<h4 class="modal-title">Confirmation</h4>',
	'</div>',
	'<div class="modal-body">',
	'<p>Are you sure you want to delete this company?</p>',
	'</div>',
	'<div class="modal-footer">',
	'<button type="button" class="btn btn-default" data-dismiss="modal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>',
	'<button id="confirm" type="button" class="btn btn-danger">Yes, Delete</button>',
	'</div>',
	'</div>',
	'</div>',
	'</div>'
	].join('');
}
window.operateEvents = {
	'click .modify': function (e, value, row, index) {
	},
	'click .send': function (e, value, row, index) {
		$(document).ready(function(){
			$("#myModalSender"+row.id).modal("show");
			$("#confirmSend"+row.id).click(function(){
				var content = $("#emailContent"+row.id).val();
				console.log(content);
				var receiver = row.email;
				var xhr = new XMLHttpRequest();
				xhr.open("GET", "/business-logic/services/email.php?receiver="+receiver+"&content="+content, true);
				xhr.send(null);
				$("#myModalSender"+row.id).modal("hide");
				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
			});
		});
	},
	'click .remove': function (e, value, row, index) {
		$(document).ready(function(){
			$("#myModal").modal("show");
			$("#confirm").click(function(){
				$table.bootstrapTable('remove', {
					field: 'id',
					values: [row.id]
				});
				var xhr = new XMLHttpRequest();
				xhr.open("GET", "/business-logic/services/delete-company.php?id="+row.id, true);
				xhr.send(null);
				$("#myModal").modal("hide");
				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
			});
		});
	}
};

function totalTextFormatter(data) {
	return 'Total';
}

function totalNameFormatter(data) {
	return data.length;
}

function totalPriceFormatter(data) {
	var total = 0;
	$.each(data, function (i, row) {
		total += +(row.price.substring(1));
	});
	return '$' + total;
}

function getHeight() {
	return $(window).height() - $('#navbar').outerHeight(true) - $('#sectionTitle').outerHeight(true);
}

$(function () {
	var scripts = [
	location.search.substring(1) || '/user-interface/vendors/bootstrap-table/dist/bootstrap-table.js', '/user-interface/vendors/bootstrap-table/dist/extensions/toolbar/bootstrap-table-toolbar.js'
	],
	eachSeries = function (arr, iterator, callback) {
		callback = callback || function () {};
		if(!arr.length) {
			return callback();
		}
		var completed = 0;
		var iterate = function () {
			iterator(arr[completed], function (err) {
				if(err) {
					callback(err);
					callback = function () {};
				}
				else{
					completed += 1;
					if(completed >= arr.length) {
						callback(null);
					}
					else{
						iterate();
					}
				}
			});
		};
		iterate();
	};
	eachSeries(scripts, getScript, initTable);
});

function getScript(url, callback) {
	var head = document.getElementsByTagName('head')[0];
	var script = document.createElement('script');
	script.src = url;
	var done = false;
	script.onload = script.onreadystatechange = function() {
		if(!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {
			done = true;
			if(callback){
				callback();
			}
			script.onload = script.onreadystatechange = null;
		}
	};
	head.appendChild(script);
	return undefined;
}