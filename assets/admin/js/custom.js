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
	$('.dataTable').each(function() {
		// Set Sort Column
		var sortColumn = 0;
		if( typeof $(this).attr('data-sort') !== 'undefined' && $(this).attr('data-sort').length ) {
			sortColumn = $(this).attr('data-sort');
		}
		
		// Set Sort Direction
		var sortDirection = 'asc';
		if( typeof $(this).attr('data-sort-direction') !== 'undefined' && $(this).attr('data-sort-direction').length ) {
			sortDirection = $(this).attr('data-sort-direction');
		}
		
		// Update Sort Option Per Table
		dataTableOptions["aaSorting"] = [[ sortColumn, sortDirection ]];

		// Initialize Datatable Per Table
		$(this).dataTable(dataTableOptions);
	});
	
    // Style Number of Results Dropdown
	$('.dataTables_wrapper .dataTables_length select').addClass("select2-wrapper span12");
	$(".select2-wrapper").select2({minimumResultsForSearch: -1});

	/* ##############################################################################
	# Generic Form JS
	############################################################################# */
	$('select.pretty-select').select2({ placeholder: 'Select One', allowClear: true });
});