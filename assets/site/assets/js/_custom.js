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
	updateNewsChevrons('.schedule li a');
	updateNewsChevrons('.footer-links li a');
	$(".chosen-select").chosen();
	$('input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' // optional
  });
	$('.full-width-nav .navigation').html($('.navbar-collapse').html());
	$('.standings tbody tr').first().children('td').css('border-top', 'none');
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
$(document).on('click', '.schedule > li a', function(e) {
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
        updateNewsChevrons('.schedule li a');
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