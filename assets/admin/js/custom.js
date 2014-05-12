$(document).ready(function(){
	/* ##############################################################################
	# DataTables
	# further intialized in admin/assets/js/datatables.js
	############################################################################# */
	// Default DataTable Options
	var dataTableOptions = 
	{ "sDom": "<'row'<'col-md-6'l <'toolbar'>><'col-md-6'f>r>t<'row'<'col-md-12'p i>>",
		//"aaSorting": [[ 1, "asc" ]],
		"oLanguage": {
			"sLengthMenu": "_MENU_ ",
			"sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
		}
	}

	// Conditional Default Column Sorting
	//dataTableOptions["aaSorting"] = [[ 1, "asc" ]];

	// Initialize Datatable
	$('.dataTable').dataTable(dataTableOptions);
	
    // Style Number of Results Dropdown
	$('.dataTables_wrapper .dataTables_length select').addClass("select2-wrapper span12");
	$(".select2-wrapper").select2({minimumResultsForSearch: -1});
});