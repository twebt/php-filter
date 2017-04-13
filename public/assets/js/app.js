$(function() {

	// Run function here
	$(window).scroll(function() {
		$('.filter-form').fixedFilter(1200);
		$('#toTop').showOrHideToTop(300);
	});


	/*
	 * Fixed Filter
	*/

	// get filter offset top
	filterOffsetTop = $('.filter-form').offset().top; 

	$.fn.fixedFilter = function(resoluton) {

		// set default value
		resoluton = resoluton || 1200;

		// check if resoluton is not a number or undefined
		if (isNaN(resoluton) || typeof resoluton === undefined) {
			resoluton = 1200;
		}

		// scrollTop var
		scrollTop = $(window).scrollTop(); 

		// make fixed filter over resolution
		if ($(window).width() > resoluton) {
			return this.each(function() {
				(scrollTop >= filterOffsetTop) ? $(this).addClass('fixed') : $(this).removeClass('fixed');
			});
		}
	}
	


	/*
	 * Function to show/hide #toTop button
	 *
	 * @var target default value is 0 and must be a number
	 * @var speed default value is 500 and must be a number 
	*/
	$.fn.showOrHideToTop = function(target) {

		'use strict';

		// set default value
		target = target || 0;

		scrollTop = $(window).scrollTop();

		// check if target is not a number or undefined
		if (isNaN(target) || typeof target === undefined) {
			target = 0;
		}

		// return the result
		return this.each(function() {
			(scrollTop >= target) ? $(this).show() : $(this).hide();
		});	
	}


	/*
	 * Function Scroll To Top
	*/ 
	$.fn.ScrollToTOp = function(speed) {

		speed = speed || 500;

		// check if speed is not a number or undefined
		if (isNaN(speed) || typeof speed === undefined) {
			speed = 0;
		}

		return this.bind('click', function(e) {

			e.preventDefault();

			// animate the scrolling
			$('html, body').animate({
				scrollTop : 0
			}, speed);
			return false;
		});	
	}
	// Run function here
	$('#toTop').ScrollToTOp(800);
});