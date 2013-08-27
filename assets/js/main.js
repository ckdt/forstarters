$.noConflict();
jQuery(document).ready(function($) {
	$('.post').fitVids();
	$('.flexslider').flexslider({
    	animation: "slide",
    	directionNav: false     
  	});
});