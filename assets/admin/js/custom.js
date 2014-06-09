$(document).ready(function(){
	
	/* ##############################################################################
	# Universal DatePicker Styling
	############################################################################# */
	$('.input-append.date').datepicker({
		autoclose: true,
		todayHighlight: true
	});

	/* ##############################################################################
	# Bootstrap Functions
	############################################################################# */
	// For Bootstrap's .modal()
	// Add a Listener to set Trigger Element to Modal .data() to be used in the Modal
	$('body').on('click', '[data-toggle="modal"]', function() {
		$( $(this).data('target') ).data('trigger', $(this) );
	});

	// Initialize Popover
	$('[data-toggle="popover"]').popover();

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
	// Delete Modal: Update Modal Content
	$('#delete-modal').on('show.bs.modal', function() {
		// Find The Element that Triggered This Modal
		var trigger = $(this).data('trigger');

		// Update HTML on Modal
		var htmlLabel = $(this).find('.data-row-label');
		htmlLabel.text( trigger.data('label') );
		$('#delete-modal .alert-error').addClass('hide');
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
		var row = $('.dataTable tr#' + rowID)[0];

		// Remove Record from DB or Display Error Message
		$.ajax({
			url: ajaxURL,
			success: function(response) {

				// Don't Delete and Throw Error Message
				if( response === 'error' ){
					$('#delete-modal .alert-error').removeClass('hide');
				}
				// Delete and Remove Row From DB and Table
				else
				{
					// Remove Row From The Table ( DataTable )
					table.fnDeleteRow( row, null, true );

					// Close Delete Modal
					$('#delete-modal').modal('hide');
				}
				
			}
		});
		
	});

	/* ##############################################################################
	# Generic JavaScript Add/Edit Modal's
	############################################################################# */
	// Add/Edit Modal: Update Modal Content When Modal Closes
	$('#add-modal, #edit-modal').on('hide.bs.modal', function() {
		// Set Vars
		var formErrorContainer = $(this).find('.ajax-form-errors');
		var thisForm = $(this).find('form');

		// Reset Form on Modal Close
		if( $(this).is('#add-modal') )
		{
			thisForm.trigger('reset');
		}

		// Hide Errors on Modal Close
		formErrorContainer.addClass('hide');
	});

	// Edit Modal: Update Field Values on Modal Open
	$('#edit-modal').on('show.bs.modal', function() {
		// Find The Element that Triggered This Modal
		var trigger = $(this).data('trigger');

		// Vars
		var ajaxURL = trigger.data('ajax-url');
		var formFieldsContainer = $(this).find('.form-fields');

		// Load in Edit Fields
		$.ajax({
			url: ajaxURL,
			success: function( response ) {
				formFieldsContainer.html( response );
			}
		});
	});

	// Add/Edit Modal Form
	$('#ajax-add-record-form, #ajax-edit-record-form').on('submit', function(e){
		// Prevent Default Function
		e.preventDefault();

		// Set Vars
		var thisForm = $(this);
		var modal = $(this).parents('.modal');
		var modalTrigger = modal.data('trigger');
		var ajaxURL = modalTrigger.data('ajax-url');
		var formErrorContainer = $(modal).find('.ajax-form-errors');
		var formErrorList = $(modal).find('.ajax-form-errors ul');
		var table = $('.dataTable').dataTable();
		var rowID = modalTrigger.data('row-id');
		var row = $('.dataTable tr#' + rowID)[0];

		// AJAX Request to Add Record
		$.ajax({
			url: ajaxURL,
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'json',
			success: function(response) {

				// Error
				if( response.result === 'error' )
				{
					formErrorList.html( response.errors );
					formErrorContainer.removeClass('hide');
				}
				// Success
				else
				{
					// Add Row To DataTable View
					if( thisForm.is('#ajax-add-record-form') )
					{
						// Add Record to DataTable View
						var addID = table.fnAddData( response.row );

						// Add an ID to the TR of the row just Added
						var theNode = table.fnSettings().aoData[addID[0]].nTr; 
						theNode.setAttribute( 'id', response.insert_id );
					}

					// Update Row In DataTable View
					if( thisForm.is('#ajax-edit-record-form') )
					{
						table.fnUpdate( response.row, row );
					}

					// Close the Modal
					modal.modal('hide');
				}

			}
		});

	});

	/* ##############################################################################
	# Games Functionality on Sessions Edit Page
	############################################################################# */
	$('body').on('change', '#game-divisions-dropdown', function(e){
		e.preventDefault();

		// Vars
		var divisionID = $(this).val()
		var formContainer = $('.teams-dropdowns');
		var ajaxURL = $(this).data('ajax-url') + '/' + divisionID;

		// Display Team Dropdown Fields
		if( divisionID.length )
		{
			$.ajax({
				url: ajaxURL,
				success: function( response ) {
					//console.log( response );
					formContainer.html( response );
				}
			});
		}
		// Remove Team Dropdown Fields
		else
		{
			formContainer.html('');
		}
		
	});

});





