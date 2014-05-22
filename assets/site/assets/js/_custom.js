/*jshint smarttabs:true */

function updateNewsChevrons(callout) {
	$(callout).each(function() {
		var lheight = $(this).outerHeight(),
		chev = $(this).find('.fa'),
		cheight = chev.height(),
		position = (lheight/2) - (cheight/2);
		chev.css('top', position);
	});
}
$(document).ready(function(){
	updateNewsChevrons('.newsLinks li');
	updateNewsChevrons('.schedule li a');
	$(".chosen-select").chosen();
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
$(window).resize(function() {
        updateNewsChevrons('.newsLinks li');
        updateNewsChevrons('.schedule li a');
    });