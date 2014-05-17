/*jshint smarttabs:true */

function updateNewsChevrons() {
	$('.newsLinks li').each(function() {
		var lheight = $(this).height(),
		chev = $(this).find('.fa'),
		cheight = chev.height(),
		position = (lheight/2) - (cheight/2);
		chev.css('top', position);
	});
}
$(document).ready(function(){
	updateNewsChevrons();
});

$(window).resize(function() {
        updateNewsChevrons();
    });