<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/init.php');?>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/auth-admin.php');?>

<!doctype html>
<html>
<head>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/user-interface/states/root.admin.companies/companies-head.php');?>
	<link rel="stylesheet" href="/PIFE/user-interface/vendors/bootstrap-table/dist/bootstrap-table.min.css">

</head>
<body>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/user-interface/states/root.admin.companies/companies.php');?>

	<div class="container">
		<div id="sectionTitle" class="well well-sm"><label>Company list</label></div>
		<div id="toolbar">
			<button id="deleteSelectionButton" class="btn btn-danger" data-toggle="modal" data-target="#myModal2" disabled>
				<i class="glyphicon glyphicon-remove"></i> Delete
			</button>
			<div class="modal fade" id="myModal2" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Confirmation</h4>
						</div>
						<div class="modal-body">
							<p>Are you sure you want to delete these companies?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
							<button id="confirmRemove" type="button" class="btn btn-danger">Yes, Delete</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<table id="table" data-toolbar="#toolbar" data-search="true" data-show-columns="true" data-detail-view="true" data-detail-formatter="detailFormatter" data-minimum-count-columns="2" data-height="" data-pagination="true" data-pageSize="10" data-id-field="id" data-page-list="[10, 20, 50, 100, ALL]" data-show-footer="false" data-cache="true" data-side-pagination="client" data-response-handler="responseHandler" data-advanced-search="true" data-id-table="advancedTable">
		</table>

	</div>

	<?php require($_SERVER['DOCUMENT_ROOT'] . '/PIFE/user-interface/states/root.admin.companies/companies-scripts.php');?>
	<script src="list.js"></script>
		
</body>
</html>

