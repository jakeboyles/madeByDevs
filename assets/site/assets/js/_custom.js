/*jshint smarttabs:true */

function updateNewsChevrons(callout) {
	$(callout).each(function() {
		var lheight = $(this).outerHeight(),
		chev = $(this).find('.fa'),
		cheight = chev.height(),
		position = (lheight/2) - (cheight/2);
		chev.css('top', position);
	});
	$('.full-width-nav').height($('body').height()+100);
}
function centerElement(wtc) {
	$(wtc).find('.fa').each(function() {
		var pw = $(this).parent().outerWidth(),
		tw = $(this).outerWidth(),
		offw = (pw-tw)/2;
		console.log('wtc = '+wtc+', pw = '+ pw + ', tw = '+ tw +', offw = '+offw);
		$(this).css('left',offw);
	});
}
$(document).ready(function(){
	updateNewsChevrons('.newsLinks li');
	updateNewsChevrons('.mobile-expand-list .content li a');
	updateNewsChevrons('.footer-links li a');
	$(".chosen-select").chosen();
	$('input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' // optional
  });

	$('body').on('click', '[data-toggle="modal"]', function() {
		$( $(this).data('target') ).data('trigger', $(this) );
	});


	$('.full-width-nav .navigation').html($('.navbar-collapse').html());
	$('.stripe-pattern-one tbody tr').first().children('td').css('border-top', 'none');
	  $(".flexible-container").click(function(event){
	    event.stopPropagation();
	  });
	  $(".click-here").click(function(event){
	    event.stopPropagation();
	    $(this).hide();
	  });
	  $("html").click(function(){
	    $('.click-here').show();
	  });
	  //jquery mobile events setup
	  $(".click-here").on('tap',function(event){
	    event.stopPropagation();
	    $(this).hide();
	  });
	  $("html").on('tap',function(){
	    $('.click-here').show();
	  });
  $('.jcarousel-control-prev')
            .jcarouselControl({
                target: '-=1'
            });

        $('.jcarousel-control-next')
            .jcarouselControl({
                target: '+=1'
            });

});
$('.jcarousel')
    .on('jcarousel:create jcarousel:reload', function() {
        var element = $(this),
			height = element.height(),
            width = element.innerWidth();
        if (width > 1000) {
            width = width / 4;
        } else if (width > 768) {
            width = width / 3;
        } else if (width > 450) {
            width = width / 2;
        }
        $('.control').height(height);

        element.jcarousel('items').css('width', width + 'px');
    })
    .jcarousel({
         wrap: 'circular'
    });
$(document).on('click', '.mobile-expand-list .content > li > a', function(e) {
	e.preventDefault();
	if($(this).parent().hasClass('active')) {
		$(this).parent().addClass('closing');
		$(this).find('.fa').removeClass('fa-chevron-down').addClass('fa-chevron-right');
	} else {
		$(this).parent().addClass('active');
		$(this).find('.fa').removeClass('fa-chevron-right').addClass('fa-chevron-down');

	}
	$(this).parent().children('ul').slideToggle(400,function() {
		if($(this).parent().hasClass('closing')) {
			$(this).parent().removeClass('active').removeClass('closing');
		}
	});
});
$(document).on('click', '.navbar-toggle', function() {
	$('.full-width-nav').slideToggle();
	$(document).scrollTop(0);
});
$(document).on('click', '.closeMenu',function(e) {
	e.preventDefault();
	$('.full-width-nav').slideToggle();
});
$(document)
    .on('change', '.btn-file :file', function() {
        var input = $(this),
            numFiles = input.get(0).files.length ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        $(this).parent().next('.help-block').html(label);
});
$(window).resize(function() {
        updateNewsChevrons('.newsLinks li');
        updateNewsChevrons('.mobile-expand-list .content li a');
        updateNewsChevrons('.footer-links li a');
        updateNewsChevrons('.control');
        centerElement('.control');
        if ($(window).width() < 1080) {
		  }
		 else {
		    $('.full-width-nav').hide();
		 }
    });
$(window).trigger('resize');
$(window).load(function(){
	$(window).trigger('resize');
});


// Starting Jon's Additions
$(document).ready(function(){
	/*######################################################################
	# Directions
	######################################################################*/
	// Location AJAX Search
	$('#search-locations-form').submit(function(e){
		e.preventDefault();

		// Set Vars
		ajaxURL = $(this).attr('action');
		search = $(this).find('#search-locations').val();
		formData = $(this).serialize();
		resultsContainer = $('.location-search-results');
		dataContainer = resultsContainer.find('.data-return');

		// If the Search Was Not Empty
		if( search.length )
		{
			$.ajax({
				url: ajaxURL,
				type: 'POST',
				data: formData,
				success: function( response ) {
					resultsContainer.removeClass('hide');
					dataContainer.html( response );
				}
			});
		}
	});
	/*######################################################################
	# Teams
	######################################################################*/
	// Team AJAX Search
	$('#search-teams-form').submit(function(e){
		e.preventDefault();

		// Set Vars
		ajaxURL = $(this).attr('action');
		search = $(this).find('#search-teams').val();
		formData = $(this).serialize();
		resultsContainer = $('.team-search-results');
		dataContainer = resultsContainer.find('.data-return');

		// If the Search Was Not Empty
		if( search.length )
		{
			$.ajax({
				url: ajaxURL,
				type: 'POST',
				data: formData,
				success: function( response ) {
					resultsContainer.removeClass('hide');
					dataContainer.html( response );
				}
			});
		}
	});
	/*######################################################################
	# Divisions
	######################################################################*/
	// Team AJAX Search
	$('#search-divisions-form').submit(function(e){
		e.preventDefault();

		// Set Vars
		ajaxURL = $(this).attr('action');
		search = $(this).find('#search-divisions').val();
		formData = $(this).serialize();
		resultsContainer = $('.division-search-results');
		dataContainer = resultsContainer.find('.data-return');

		// If the Search Was Not Empty
		if( search.length )
		{
			$.ajax({
				url: ajaxURL,
				type: 'POST',
				data: formData,
				success: function( response ) {
					resultsContainer.removeClass('hide');
					dataContainer.html( response );
				}
			});
		}
	});


	// Add/Edit Modal Form
	$('#ajax-add-record-form, #ajax-edit-record-form').on('submit', function(e){
		// Prevent Default Function
		e.preventDefault();

		// Set Vars
		var thisForm = $(this);
		var modal = $(this).parents('.modal');
		var formErrorContainer = $(modal).find('.ajax-form-errors');
		var modalTrigger = modal.data('trigger');
		var formErrorList = $(modal).find('.ajax-form-errors ul');
		var ajaxURL = modalTrigger.data('ajax-url');

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
					modal.modal('toggle');
					$('table tbody').append('<tr>'+response.row+'</tr>');
				}

			}
		});

	});


	// Edit Modal: Update Field Values on Modal Open
	$('.editModal').click(function() {
		// Find The Element that Triggered This Modal
		// Vars
		var ajaxURL = $(this).data('ajax-url');
		var formFieldsContainer = $('#edit-modal').find('.form-fields');

		// Load in Edit Fields
		$.ajax({
			url: ajaxURL,
			success: function( response ) {
				formFieldsContainer.html( response );

				// Re-Initialize jQuery Plugins on Dynamic Content
				//loadSelect2();
				//$('.date-mask').mask("99/99/9999");
				//$('.timepicker-default').timepicker();
			}
		});
	});

});
// End Jon's Additions

