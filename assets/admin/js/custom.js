$(document).ready(function(){
	
	/* ##############################################################################
	# For Bootstra's .modal()
	# Add a Listener to set Trigger Element to Modal .data() to be used in the Modal
	############################################################################# */
	$('[data-toggle="modal"]').on('click', function() {
		$( $(this).data('target') ).data('trigger', $(this) );
	});

	/* ##############################################################################
	# DataTables
	# further intialized in admin/assets/js/datatables.js
	############################################################################# */
	// Default DataTable Options
	var dataTableOptions = 
	{ "sDom": "<'row'<'col-md-6'l <'toolbar'>><'col-md-6'f>r>t<'row'<'col-md-12'p i>>",
		"oLanguage": {
			"sLengthMenu": "_MENU_ ",
			"sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
		}
	}

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

	/* ##############################################################################
	# Delete Modal
	############################################################################# */
	/*
	$('#delete-modal').on('show.bs.modal', function (e) {
		// Modal Data Options
		var modal = $(this).data('modal').options;
		var rowLabel = modal.label;

		// Modal HTML
		var htmlLabel = $(this).find('.data-row-label');
		htmlLabel.text( rowLabel );
		console.log(htmlLabel);

		// Update Delete Text


		// do something...
		console.log('test');
	});
	*/
	/*
	$('a[data-target="#delete-modal"]').on('click', function(e) {
		// Prevent Default
		e.preventDefault();

		// Update Delete Modal HTML
		var modalTarget = $( $(this).data('target') );
		modalTarget.find('.data-row-label').text( $(this).data('label') );

		// Update Data on Modal Container
		modalTarget.data( 'id','test' );

		// Show Modal
		$(modalTarget).modal('show');
	});

	$('button[data-action="delete-row"]').on('click', function(e) {
		// Grab Parent Modal Container
		var modal = $(this).parents('.modal');
		console.log( modal );
		console.log( modal.data('awesome') );

		// Prevent Default
		e.preventDefault();

		// Remove Row


	});
	*/

	// Delete Modal: Update Modal Content
	$('#delete-modal').on('show.bs.modal', function() {
		// Find The Element that Triggered This Modal
		var trigger = $(this).data('trigger');

		// Update HTML on Modal
		var htmlLabel = $(this).find('.data-row-label');
		htmlLabel.text( trigger.data('label') );
	});

	// Delete Modal: Delete Button Functionality ( what actually deletes the row )
	$('[data-action="delete-row"]').on('click', function(e){
		e.preventDefault();

		// Set Vars
		var modal = $(this).parents('.modal');
		var modalTrigger = modal.data('trigger');
		var rowID = modalTrigger.data('row-id');
		var ajaxURL = modalTrigger.data('ajax-url');
		var csrf_token = $('.dataTable thead tr input[name="csrf_token"]').val();
		var table = $('.dataTable').dataTable();
		var row =  $('.dataTable tr#' + rowID)[0];

		// Remove Record from DB
		$.ajax({
			//type: 'post',
			url: ajaxURL,
			//data: { id: rowID, csrf_token: csrf_token },
			success: function(response){
				console.log('made it to success function')
			}
		});
		
		// Remove Row From The Table ( DataTable )
		table.fnDeleteRow( row, null, true );

		// Close Delete Modal
		$('#delete-modal').modal('hide');

	});

});

