 //kadima  social tooltip js
 jQuery(function(){
		jQuery('li').tooltip();
		jQuery("[data-toggle='tooltip']").tooltip();
		jQuery("[data-toggle='popover']").popover();
		
		
		
    });

	/*----------------------------------------------------*/
/*	Scroll To Top Section
/*----------------------------------------------------*/
	jQuery(document).ready(function () {
	
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 100) {
				jQuery('.kadima_scrollup').fadeIn();
			} else {
				jQuery('.kadima_scrollup').fadeOut();
			}
		});
	
		jQuery('.kadima_scrollup').click(function () {
			jQuery("html, body").animate({
				scrollTop: 0
			}, 600);
			return false;
		});
	
	});	

	
	jQuery.browser = {};
			(function () {
				jQuery.browser.msie = false;
				jQuery.browser.version = 0;
				if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
					jQuery.browser.msie = true;
					jQuery.browser.version = RegExp.$1;
				}
			})();
