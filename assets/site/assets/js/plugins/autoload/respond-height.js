/*jshint -W009*/
/*jshint -W099*/

// Reference: http://codepen.io/micahgodbolt/pen/FgqLc
// OodleTech Modified to replace $ with jQuery to work with WordPress
function equalheight(container) {
 	
	var currentTallest = 0;
	var currentRowStart = 0;
	var rowDivs = new Array();
	var $el;
	var topPosition = 0;
     
	jQuery(container).each(function() {
	
	   $el = jQuery(this);
	   jQuery($el).height('auto');
	   topPostion = $el.position().top;
	
	   if (currentRowStart !== topPostion) {
	     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
	       rowDivs[currentDiv].height(currentTallest);
	     }
	     rowDivs.length = 0; // empty the array
	     currentRowStart = topPostion;
	     currentTallest = $el.height();
	     rowDivs.push($el);
	   } else {
	     rowDivs.push($el);
	     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
	  }
	   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
	     rowDivs[currentDiv].height(currentTallest);
	   }
	});
}