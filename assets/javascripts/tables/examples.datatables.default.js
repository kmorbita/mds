

(function( $ ) {

	'use strict';

	var datatableInit = function() {

		$('#datatable-default').dataTable();
		$('#datatable-joblist').dataTable({
			"searching" : false,
			"info": false,
			"bFilter": false,
			"bLengthChange": false,
			"bPaginate": false
		});
		$('#datatable-default2').dataTable();
		$('#datatable-default3').dataTable();
		$('#datatable-task-per').dataTable();
		$('#datatable-eqpt-task').dataTable({
			"searching" : false,
			"info": false,
			"bFilter": false,
			"bLengthChange": false,
			"pageLength": 5,
			"bPaginate": false
		});
		$('#datatable-per-task').dataTable({
			"searching" : false,
			"info": false,
			"bFilter": false,
			"bLengthChange": false,
			"pageLength": 5,
			"bPaginate": false
		});
		$('#datatable-personnel').dataTable({
			"searching" : false,
			"info": false,
			"bFilter": false,
			"bLengthChange": false,
			"pageLength": 10,
			"bPaginate": false
		});
		$('#datatable-operator').dataTable({
			"searching" : false,
			"info": false,
			"bFilter": false,
			"bLengthChange": false,
			"pageLength": 10,
			"bPaginate": false
		});
		$('#datatable-job').dataTable({
			"searching" : false,
			"info": false,
			"bFilter": false,
			"bLengthChange": false,
			"pageLength": 10,
			"bPaginate": false
		});
		$('#datatable-all_gang').dataTable({
			"searching" : false,
			"info": false,
			"bFilter": false,
			"bLengthChange": false,
			"pageLength": 10,
			"bPaginate": false
		});
		$('#datatable-all_operator').dataTable({
			"searching" : false,
			"info": false,
			"bFilter": false,
			"bLengthChange": false,
			"pageLength": 10,
			"bPaginate": false
		});
		$('#datatable-def1').dataTable({
			"searching" : false,
			"info": false,
			"bFilter": false,
			"bLengthChange": false,
			"pageLength": 10,
			"bPaginate": false
		});
		$('#datatable-def2').dataTable({
			"searching" : false,
			"info": false,
			"bFilter": false,
			"bLengthChange": false,
			"pageLength": 10,
			"bPaginate": false
		});
		$('#datatable-def3').dataTable({
			"searching" : false,
			"info": false,
			"bFilter": false,
			"bLengthChange": false,
			"pageLength": 10,
			"bPaginate": false
		});
		$('#datatable-def4').dataTable({
			"searching" : false,
			"info": false,
			"bFilter": false,
			"bLengthChange": false,
			"pageLength": 10,
			"bPaginate": false
		});
		$('#datatable-def5').dataTable({
			"searching" : false,
			"info": false,
			"bFilter": false,
			"bLengthChange": false,
			"pageLength": 10,
			"bPaginate": false
		});
		$('#datatable-export').dataTable({
			dom: 'Bfrtip',
			buttons: [{
				extend: 'excel',
				text: 'Excel',
				className: 'exportExcel',
				filename: 'Test_Excel',
				exportOptions: { modifier: { page: 'all'} }
			}]
		});

	};

	$(function() {
		datatableInit();
	});

}).apply( this, [ jQuery ]);