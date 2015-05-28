<!-- BEGIN SHOW/HIDE MAIN MENU -->
jQuery('.mobilenav-menu-button').on('touchstart click', function(e) {
e.preventDefault();

	/* touchstart events */
	if(jQuery('.mobilenav-by-themo').hasClass('mobilenav-menu-active'))
	{
		/* hide accordion menu */
		jQuery(".mobilenav-by-themo").removeClass("mobilenav-menu-active");
		jQuery(".mobilenav-accordion-tooltip").removeClass("mobilenav-tooltip-active");
		/* hide menu button active colors */
		jQuery(".mobilenav-menu-button").removeClass("mobilenav-menu-button-active");
		jQuery(".mobilenav-menu-button").toggleClass("mobilenav-menu-button-hover");
		jQuery(".mobilenav-menu-button").removeClass("mobilenav-menu-button-hover-touch");
		/* hide close div */
		jQuery('.mobilenav-menu-close').removeClass('mobilenav-menu-close-active-opacity');
		setTimeout(function(){
			jQuery('.mobilenav-menu-close').removeClass('mobilenav-menu-close-active-position');
		},400);
	} else {
		/* show accordion menu */
		jQuery(".mobilenav-by-themo").addClass("mobilenav-menu-active");
		jQuery(".mobilenav-accordion-tooltip").addClass("mobilenav-tooltip-active");
		/* show menu button active colors */
		jQuery(".mobilenav-menu-button").addClass("mobilenav-menu-button-active");
		jQuery(".mobilenav-menu-button").toggleClass("mobilenav-menu-button-hover");
		jQuery(".mobilenav-menu-button").removeClass("mobilenav-menu-button-hover-touch");
		/* show close div */
		jQuery('.mobilenav-menu-close').addClass('mobilenav-menu-close-active-opacity');
		jQuery('.mobilenav-menu-close').addClass('mobilenav-menu-close-active-position');
	}

});

jQuery(".mobilenav-menu-button").hover(
	function() {
		jQuery(".mobilenav-menu-button").addClass("mobilenav-menu-button-hover-touch");
	},
	function() {
		jQuery(".mobilenav-menu-button").removeClass("mobilenav-menu-button-hover-touch");
});
<!-- END SHOW/HIDE MAIN MENU -->


<!-- BEGIN HIDE MAIN MENU WHEN CLICKED/TAPPED ON CLOSE DIV -->
jQuery('.mobilenav-menu-close').on('touchstart click', function(e) {
e.preventDefault();

	/* touchstart events */
	/* hide accordion menu */
	jQuery(".mobilenav-by-themo").removeClass("mobilenav-menu-active");
	jQuery(".mobilenav-accordion-tooltip").removeClass("mobilenav-tooltip-active");
	/* hide menu button active colors */
	jQuery(".mobilenav-menu-button").removeClass("mobilenav-menu-button-active");
	jQuery(".mobilenav-menu-button").toggleClass("mobilenav-menu-button-hover");
	/* hide close div */
	jQuery('.mobilenav-menu-close').removeClass('mobilenav-menu-close-active-opacity');
	setTimeout(function(){
		jQuery('.mobilenav-menu-close').removeClass('mobilenav-menu-close-active-position');
	},400);

	return false;

});
<!-- END HIDE MAIN MENU WHEN CLICKED/TAPPED ON CLOSE DIV -->


<!-- BEGIN CONVERTING DEFAULT WP MENU TO A SLIDE-DOWN ONE -->
jQuery(document).ready(function ($) {
    jQuery('.menu ul').slideUp(0);

    jQuery('.mobilenav-by-themo .menu-item-has-children').click(function () {
        var target = jQuery(this).children('a');
        if(target.hasClass('menu-expanded')){
            target.removeClass('menu-expanded');
        }else{
            jQuery('.menu-item > a').removeClass('menu-expanded');
            target.addClass('menu-expanded');
        }
        jQuery(this).find('ul:first')
                    .slideToggle(350)
                    .end()
                    .siblings('li')
                    .find('ul')
                    .slideUp(350);
    });

});
<!-- END CONVERTING DEFAULT WP MENU TO A SLIDE-DOWN ONE -->