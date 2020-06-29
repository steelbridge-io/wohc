jQuery(document).ready(function($) {

	/* Loads top bar notice on front page. Expands on page load
	------------------------------------------------------------ */
	$(".expandable").slideDown(1000);
});

var bootstrapButton = $.fn.button.noConflict() // return $.fn.button to previously assigned value
$.fn.bootstrapBtn = bootstrapButton

jQuery(function($){

	"use strict";

	/* Match height for featured content.
	--------------------------------------------- */
	$( '.featured-portfolio .entry' ).matchHeight();
	$( '.featured-content .entry' ).matchHeight();


	/* Parallax Effects
	--------------------------------------------- */
	function kreativ_parallax_effects() {
		//* Parallax effects on front page sections
		$(window).scroll(function(){
			var scrolltop = $(window).scrollTop();
			//* Front page section 1 parallax effect
			$(".front-page-1").css("backgroundPosition", "50% " + -(scrolltop/6) + "px");
		});
	}

	//* Init parallax effects
	kreativ_parallax_effects();

	/* Smooth Scroll
	--------------------------------------------- */
	function kreativ_smooth_scroll() {
		//* Smooth scroll on front page sections
		var root = $('html, body');
		$('a[href*="#"]:not([href="#"])').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				root.animate({
				scrollTop: target.offset().top
				}, 400);
				return false;
			}
			}
		});
	}

	//* Init smooth scroll
	kreativ_smooth_scroll();

});
