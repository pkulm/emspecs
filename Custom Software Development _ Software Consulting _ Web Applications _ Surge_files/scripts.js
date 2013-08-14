//Menu Plugin
(function ($) {
	$.fn.extend({
		menuNav: function (customOptions) {
			var options = $.extend({}, $.fn.menuNav.defaultOptions, customOptions);
			return this.each(function () {
				var obj = $(this);
				var liUl = $('li', obj);
				liUl.find('ul', obj).hide();
				liUl.each(function () {
					if ($('ul:first', $(this)).length == 1) $('a:first', $(this)).append(options.tambahHtml);
					$(this).hover(function () {
						$('ul:first', this).slideDown();
					}, function () {
						$('ul:first', this).slideUp();
					});
				})
			});
		}
	});
})(jQuery); //End Menu Plugin
/**
 * Equal Heights Plugin
 * Equalize the heights of elements. Great for columns or any elements
 * that need to be the same size (floats, etc).
 * 
 * Version 1.0
 * Updated 12/10/2008
 *
 * Copyright (c) 2008 Rob Glazebrook (cssnewbie.com) 
 *
 * Usage: $(object).equalHeights([minHeight], [maxHeight]);
 * 
 * Example 1: $(".cols").equalHeights(); Sets all columns to the same height.
 * Example 2: $(".cols").equalHeights(400); Sets all cols to at least 400px tall.
 * Example 3: $(".cols").equalHeights(100,300); Cols are at least 100 but no more
 * than 300 pixels tall. Elements with too much content will gain a scrollbar.
 * 
 */
 
(function ($) {
	$.fn.equalHeights = function (minHeight, maxHeight) {
		tallest = (minHeight) ? minHeight : 0;
		this.each(function () {
			if ($(this).height() > tallest) {
				tallest = $(this).height();
			}
		});
		if ((maxHeight) && tallest > maxHeight) tallest = maxHeight;
		return this.each(function () {
			$(this).height(tallest).css("overflow", "hidden");
		});
	}
})(jQuery);

function getExt(filename) {
	var ext = filename.split('.').pop();
	if (ext == filename) return "";
	return ext;
}

(function ($) {
		   
	$(function () {
		// flex slider
		$('.contentslider').flexslider({
			animation: "slide",
			directionNav: true,
			controlNav: false,
			animationLoop: true,
			pauseOnAction: true,
			pauseOnHover: true,
			nextText: "",
			prevText: "",
		});
		
		$('.portslider, .detailslider').flexslider({
			animation: "slide",
			slideshow: false,
			directionNav: false,
			controlNav: true,
		});
		
		//Menu Nav
		$('#nav').menuNav();
			
		//Mobile Menu
		$('ul.primary-menu').mobileMenu({
			defaultText: 'Navigate to...',
			className: 'responsive-menu',
			subMenuDash: '&nbsp;&nbsp;&nbsp;&nbsp;'
		});
		
		//Back to top
		$("#top").click(function (e) {
			e.preventDefault();
			$("body,html").animate({
				scrollTop: 0 // Top position
			}, 800); // Scroll speed
		});
		
		//tabs
		$(document).ready(function () {
			//$('.st-tabs .tabs-content').hide();
			//$('.st-tabs .tabs-content:first').show();
			$('.st-tabs .tabs-content:first-child').siblings('.tabs-content').hide();
			$('.st-tabs ul.tabs li:first-child').addClass('active');
			$('.st-tabs ul.tabs a').live('click', function (e) {
				e.preventDefault();
				$(this).parents('li').addClass('active').siblings('li.active').removeClass('active');
				var tab_id = $(this).parents('li').index();
				$(this).parents('.st-tabs').find('.tabs-content').eq(tab_id).show().siblings('.tabs-content').hide();
			});
		});
		
		//accordions
		$('.st-accordion1').accordion();
		$('.st-accordion2').accordion({
			oneOpenedItem: true
		});
		
		var stZoom = function () {
				//portfolio hover image
				jQuery("a.zoom").hover(function () {
					jQuery(this).find('img').animate({
						opacity: 0.3
					}, 400, 'easeOutExpo');
					jQuery(this).find('span').animate({
						top: '50%',
						marginLeft: '-' + ($(this).find('span').width() / 2) + 'px'
					}, 300, 'easeOutExpo');
				}, function () {
					jQuery(this).find('span').animate({
						top: '150%'
					}, 300, 'easeInExpo', function () {
						jQuery(this).css('top', '-50%');
					});
					jQuery(this).find('img').animate({
						opacity: 1
					}, 400, 'easeInExpo');
				});
			};
		stZoom();
		
		$(document).ready(function() {
		  // get the action filter option item on page load
		  var $filterType = $('#filterOptions li.active a').attr('class');
			
		  // get and assign the ourHolder element to the
			// $holder varible for use later
		  var $holder = $('div.ourHolder');
		
		  // clone all items within the pre-assigned $holder element
		  var $data = $holder.clone();
		
		  // attempt to call Quicksand when a filter option
			// item is clicked
			$('#filterOptions li a').click(function(e) {
				// reset the active class on all the buttons
				$('#filterOptions li').removeClass('active');
				
				// assign the class of the clicked filter option
				// element to our $filterType variable
				var $filterType = $(this).attr('class');
				$(this).parent().addClass('active');
				
				if ($filterType == 'all') {
					// assign all li items to the $filteredData var when
					// the 'All' filter option is clicked
					var $filteredData = $data.find('div.qsand');
				} 
				else {
					// find all li elements that have our required $filterType
					// values for the data-type element
					var $filteredData = $data.find('div.qsand[data-type~=' + $filterType + ']');
				}
				
				// call quicksand and assign transition parameters
				$holder.quicksand($filteredData, {
					duration: 800,
					easing: 'easeInOutQuad',
					enhancement: function () {
						$("a[rel^='prettyPhoto']").prettyPhoto();
						stZoom();
						//equalHeights
						$(".equalH").equalHeights();
						
						if ( typeof Cufon != 'undefined') {
							Cufon.refresh();
						}
					}
				});
				return false;
			});
		});
		
		//prettyphoto
		$("a[rel^='prettyPhoto']").prettyPhoto();
		
		//equalHeights
		$(".equalH").equalHeights();
		
		$(".portfolio").fitVids();
		$(".st-video").fitVids();
			
		//contact form
		$('#contact_form').submit(function () {
			$('#loading_contact_form').fadeIn('fast');
			$('#result_contact_form').hide();
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: $(this).serialize(),
				success: function (data) {
					$('#result_contact_form').html(data);
					$('#result_contact_form').fadeIn('fast');
					$('#loading_contact_form').hide();
				}
			})
			return false;
		});
		
		//simple contact widget
		$('#contact_form_wgt').submit(function () {
			$('#result_contact_form_wgt').hide();
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: $(this).serialize(),
				success: function (data) {
					$('#result_contact_form_wgt').html(data);
					$('#result_contact_form_wgt').fadeIn('fast');
				}
			})
			return false;
		});
		
		//newsletter widget
		$('#newsletter_form_wgt').submit(function () {
			$('#result_newsletter_form_wgt').hide();
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: $(this).serialize(),
				success: function (data) {
					$('#result_newsletter_form_wgt').html(data);
					$('#result_newsletter_form_wgt').fadeIn('fast');
				}
			})
			return false;
		});
	});
	
})(jQuery);