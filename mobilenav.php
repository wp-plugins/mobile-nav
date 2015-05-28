<?php
/*
Plugin Name: Mobile Nav
Plugin URI: http://wordpress.org/plugins/mobi
Description: The easy to use Mobile and Responsive navigation Mneu plugin for any WordPress themes.
Version: 1.0.0
Author: Themology
Author URI: http://themology.net/
License: GPL2
*/


	//
	// CREATE THE SETTINGS PAGE (for WordPress backend, Settings > mobilen nav plugin)
	//
	
	/* create "Settings" link on plugins page */
	function themo_mobilenav_settings_link($links) { 
		$settings_link = '<a href="options-general.php?page=mobilenav-by-themo/mobilenav.php">Settings</a>'; 
		array_unshift($links, $settings_link); 
		return $links; 
	}
	$plugin = plugin_basename(__FILE__); 
	add_filter("plugin_action_links_$plugin", 'themo_mobilenav_settings_link' );

	/* create the "Settings > mobile nav plugin" menu item */
	function themo_mobilenav_admin_menu() {
		add_submenu_page('options-general.php', 'Mobile Nav Plugin Settings', 'Mobile Nav plugin', 'administrator', __FILE__, 'themo_mobilenav_page');
	}
	
	/* create the actual settings page */
	function themo_mobilenav_page() {
		if ( isset ($_POST['update_themo_mobilenav']) == 'true' ) { themo_mobilenav_update(); }
	?>

		<div class="wrap">
			<h2>Mobile Nav, by Themology</h2>
			<strong>Psst!</strong> Mobile Nav's color options can be changed under <strong>Appearance > Customize > Mobile Nav plugin colors</strong>

			<form method="POST" action="">
				<input type="hidden" name="update_themo_mobilenav" value="true" />

				<br><hr><br>

				<table class="form-table">
					<tr valign="top">
					<th scope="row">Absolute/fixed positioning</th>
					<td><label><input type="checkbox" name="mobilenav_absolute" id="mobilenav_absolute" <?php echo get_option('mobilenav_position_absolute'); ?> /> Absolute positioning (Mobile Nav leaves the screen when scrolled).
					<br>If unticked, Mobile Nav will have fixed positioning and will remain at the top at all times.
					<br><strong>Please note:</strong> Do not tick if you select the bottom placement below.</label></td>
					</tr>
					
					<tr valign="top">
					<th scope="row">Top/bottom positioning</th>
					<td><label><input type="checkbox" name="mobilenav_bottom" id="mobilenav_bottom" <?php echo get_option('mobilenav_position_bottom'); ?> /> Bottom positioning (Mobile Nav is placed at the bottom of the screen).
					<br>If unticked, Mobile Nav will have its default top position.</label></td>
					</tr>
					
					<tr valign="top">
					<th scope="row">Show only on touch devices?</th>
					<td><label><input type="checkbox" name="mobilenav_show_mobile_only" id="mobilenav_show_mobile_only" <?php echo get_option('mobilenav_mobile_only'); ?> /> Show Mobile Nav only on touch devices </label></td>
					</tr>
			
					<tr valign="top">
					<th scope="row">Hide back button?</th>
					<td><label><input type="checkbox" name="mobilenav_hide_back" id="mobilenav_hide_back" <?php echo get_option('mobilenav_hide_back_button'); ?> /> Hide the back button on all pages</label></td>
					</tr>
			
					<tr valign="top">
					<th scope="row">Phone number:</th>
					<td>
					<input type="text" name="mobilenav_enter_phone_number" id="mobilenav_enter_phone_number" value="<?php echo get_option('mobilenav_phone_number'); ?>"/>
					<label><input type="checkbox" name="mobilenav_hide_call" id="mobilenav_hide_call" <?php echo get_option('mobilenav_hide_call_button'); ?> /> Hide call button</label>
					</td>
					</tr>
			
					<tr valign="top">
					<th scope="row">Email address:</th>
					<td>
					<input type="text" name="mobilenav_email_address" id="mobilenav_email_address" value="<?php echo get_option('mobilenav_email'); ?>"/>
					<label><input type="checkbox" name="mobilenav_hide_email" id="mobilenav_hide_email" <?php echo get_option('mobilenav_hide_email_button'); ?> /> Hide email button</label>
					</td>
					</tr>
					
					<tr valign="top">
					<th scope="row">Transparency</th>
					<td>
					<input type="text" name="mobilenav_transparency" id="mobilenav_transparency" value="<?php echo get_option('mobilenav_set_transparency'); ?>"/> From 0-1. Example: 0.8 or 0.85. If left emtpy, defaults to 1.
					<br>You'll probably want to keep this at .95 and above, to have that very subtle see-through effect. Depending on how you color customize your menu though, you could go lower.
					</td>
					</tr>
				</table>

				<br><br>
				<h3>Customize icons</h3>
				<hr>
				To customize the four menubar icons, enter new icon names into the fields below.<br>
				You can pick and choose from over 300 icons here: <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/cheatsheet/">http://fortawesome.github.io/Font-Awesome/cheatsheet/</a> (the icon names are <strong>fa-angle-up</strong>, <strong>fa-anchor</strong> etc.).<br>
				If a field is left empty, the default icon will be used.<br><br>

				<table class="form-table">
					<tr valign="top">
					<th scope="row">Custom back icon:</th>
					<td>
					<input type="text" name="mobilenav_custom_back" id="mobilenav_custom_back" value="<?php echo get_option('mobilenav_custom_back_icon'); ?>"/> If left empty, defaults to <strong>fa-long-arrow-left</strong>
					</td>
					</tr>
					
					<tr valign="top">
					<th scope="row">Custom call icon:</th>
					<td>
					<input type="text" name="mobilenav_custom_call" id="mobilenav_custom_call" value="<?php echo get_option('mobilenav_custom_call_icon'); ?>"/> If left empty, defaults to <strong>fa-phone</strong>
					</td>
					</tr>
					
					<tr valign="top">
					<th scope="row">Custom email icon:</th>
					<td>
					<input type="text" name="mobilenav_custom_email" id="mobilenav_custom_email" value="<?php echo get_option('mobilenav_custom_email_icon'); ?>"/> If left empty, defaults to <strong>fa-envelope</strong>
					</td>
					</tr>
					
					<tr valign="top">
					<th scope="row">Custom menu icon:</th>
					<td>
					<input type="text" name="mobilenav_custom_menu" id="mobilenav_custom_menu" value="<?php echo get_option('mobilenav_custom_menu_icon'); ?>"/> If left empty, defaults to <strong>fa-bars</strong>
					</td>
					</tr>
				</table>
				
				<br><br>
				<h3>Customize button links</h3>
				<hr>
				If you'd like to override the call and email button functions with custom links, enter them below. Combined with custom icons (which can be set above), this allows you to give these two buttons a completely different function.<br><br>

				<table class="form-table">
					<tr valign="top">
					<th scope="row">Custom call button link:</th>
					<td>
					<input type="text" name="mobilenav_custom_call_link" id="mobilenav_custom_call_link" value="<?php echo get_option('themo_mobilenav_custom_call_link'); ?>"/> If left empty, defaults to call function
					</td>
					</tr>
					
					<tr valign="top">
					<th scope="row">Custom button link:</th>
					<td>
					<input type="text" name="mobilenav_custom_email_link" id="mobilenav_custom_email_link" value="<?php echo get_option('themo_mobilenav_custom_email_link'); ?>"/> If left empty, defaults to email function
					</td>
					</tr>
				</table>

				<br><hr><br>

				<!-- BEGIN 'SAVE OPTIONS' BUTTON -->	
				<p><input type="submit" name="search" value="Save Options" class="button button-primary" /></p>
				<!-- BEGIN 'SAVE OPTIONS' BUTTON -->	

			</form>

		</div>
	<?php }
	function themo_mobilenav_update() {

		/* absolute/fixed positioning */
		if ( isset ($_POST['mobilenav_absolute'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('mobilenav_position_absolute', $display);

		/* top/bottom positioning */
		if ( isset ($_POST['mobilenav_bottom'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('mobilenav_position_bottom', $display);

		/* show on touch devices only */
		if ( isset ($_POST['mobilenav_show_mobile_only'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('mobilenav_mobile_only', $display);
		
		/* hide back button */
		if ( isset ($_POST['mobilenav_hide_back'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('mobilenav_hide_back_button', $display);
		
		/* enter phone number */
		update_option('mobilenav_phone_number',   $_POST['mobilenav_enter_phone_number']);
		/* hide call button */
		if ( isset ($_POST['mobilenav_hide_call'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('mobilenav_hide_call_button', $display);
		
		/* enter email address */
		update_option('mobilenav_email',   $_POST['mobilenav_email_address']);
		/* hide email button */
		if ( isset ($_POST['mobilenav_hide_email'])=='on') { $display = 'checked'; } else { $display = ''; }
	    update_option('mobilenav_hide_email_button', $display);
		
		/* menu transparency */
		update_option('mobilenav_set_transparency',   $_POST['mobilenav_transparency']);
		
		/* custom back icon */
		update_option('mobilenav_custom_back_icon',   $_POST['mobilenav_custom_back']);
		/* custom call icon */
		update_option('mobilenav_custom_call_icon',   $_POST['mobilenav_custom_call']);
		/* custom email icon */
		update_option('mobilenav_custom_email_icon',   $_POST['mobilenav_custom_email']);
		/* custom menu icon */
		update_option('mobilenav_custom_menu_icon',   $_POST['mobilenav_custom_menu']);

		/* custom call button link */
		update_option('themo_mobilenav_custom_call_link',   $_POST['mobilenav_custom_call_link']);
		/* custom email button link */
		update_option('themo_mobilenav_custom_email_link',   $_POST['mobilenav_custom_email_link']);

	}
	add_action('admin_menu', 'themo_mobilenav_admin_menu');
	?>
<?php


	//
	// Add menu to theme
	//
	
	function themo_mobilenav_footer() {
	?>

		<!-- BEGIN PREVENT TOUCHSTART MISHAPS -->
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<!-- END PREVENT TOUCHSTART MISHAPS -->
		
		<?php if( get_option('mobilenav_mobile_only') ) { ?>
		
			<?php if ( wp_is_mobile() ) { ?>
				<?php if( get_option('mobilenav_position_bottom') ) { ?>
					<style>
					/* add padding to ensure that whatever content may be at the top of the site doesn't get hidden behind the menu */
					html { padding-bottom:50px !important; }
					</style>
				<?php } else { ?>
					<style>
					/* add padding to ensure that whatever content may be at the top of the site doesn't get hidden behind the menu */
					html { margin-top:50px !important; }
					</style>
				<?php } ?>
			<?php } ?>

		<?php } else { ?>
		
			<?php if( get_option('mobilenav_position_bottom') ) { ?>
				<style>
				/* add padding to ensure that whatever content may be at the top of the site doesn't get hidden behind the menu */
				html { padding-bottom:50px !important; }
				</style>
			<?php } else { ?>
				<style>
				/* add padding to ensure that whatever content may be at the top of the site doesn't get hidden behind the menu */
				html { margin-top:50px !important; }
				</style>
			<?php } ?>
		
		<?php } ?>

<?php if( get_option('mobilenav_mobile_only') ) { ?>

	<!-- BEGIN SHOW MOBILE NAV ON MOBILE DEVICES ONLY -->
	<?php if ( wp_is_mobile() ) { ?>

		<!-- BEGIN MENU BAR -->
		<div class="mobilenav-wrapper<?php if ( is_admin_bar_showing() ) { ?> mobilenav-wp-toolbar<?php } else { ?><?php } ?><?php if( get_option('mobilenav_position_absolute') ) { ?> mobilenav-absolute<?php } ?><?php if( get_option('mobilenav_position_bottom') ) { ?> mobilenav-bottom<?php } ?>">
		
			<!-- BEGIN BACK BUTTON -->
			<?php if( get_option('mobilenav_hide_back_button') ) { ?>
			<?php } else { ?>
				<?php if(is_front_page() ) { ?><?php } else { ?>
					<div class="mobilenav-back-button" onClick="history.back()">
						<i class="fa <?php if( get_option('mobilenav_custom_back_icon') ) { ?><?php echo get_option('mobilenav_custom_back_icon'); ?><?php } else { ?>fa-long-arrow-left<?php } ?>"></i>
					</div>
				<?php } ?>
			<?php } ?>
			<!-- END BACK BUTTON -->
			
			<!-- BEGIN CALL BUTTON -->
			<?php if( get_option('mobilenav_hide_call_button') ) { ?>
			<?php } else { ?>
				<a href="<?php if( get_option('themo_mobilenav_custom_call_link') ) { ?><?php echo get_option('themo_mobilenav_custom_call_link'); ?><?php } else { ?>tel://<?php echo get_option('mobilenav_phone_number'); ?><?php } ?>" class="mobilenav-call-button">
					<i class="fa <?php if( get_option('mobilenav_custom_call_icon') ) { ?><?php echo get_option('mobilenav_custom_call_icon'); ?><?php } else { ?>fa-phone<?php } ?>"></i>
				</a>
			<?php } ?>
			<!-- END CALL BUTTON -->
			
			<!-- BEGIN EMAIL BUTTON -->
			<?php if( get_option('mobilenav_hide_email_button') ) { ?>
			<?php } else { ?>
				<a href="<?php if( get_option('themo_mobilenav_custom_email_link') ) { ?><?php echo get_option('themo_mobilenav_custom_email_link'); ?><?php } else { ?>mailto:<?php echo get_option('mobilenav_email'); ?><?php } ?>" class="mobilenav-email-button">
					<i class="fa <?php if( get_option('mobilenav_custom_email_icon') ) { ?><?php echo get_option('mobilenav_custom_email_icon'); ?><?php } else { ?>fa-envelope<?php } ?>"></i>
				</a>
			<?php } ?>
			<!-- END EMAIL BUTTON -->
			
			<!-- BEGIN MENU BUTTON -->
			<div class="mobilenav-menu-button">
				<i class="fa <?php if( get_option('mobilenav_custom_menu_icon') ) { ?><?php echo get_option('mobilenav_custom_menu_icon'); ?><?php } else { ?>fa-bars<?php } ?>"></i>
				<div class="mobilenav-accordion-tooltip"></div>
			</div>
			<!-- END MENU BUTTON -->

		</div>
		<!-- END MENU BAR -->
		
		<!-- BEGIN ACCORDION MENU -->
		<div class="mobilenav-menu-close"></div>
		<div class="<?php if( get_option('mobilenav_position_bottom') ) { ?>mobilenav-bottom<?php } ?>">
		<div class="mobilenav-by-themo<?php if( get_option('mobilenav_position_absolute') ) { ?> mobilenav-absolute<?php } ?>">
			<?php wp_nav_menu( array( 'theme_location' => 'mobilenav-by-themo' ) ); ?>
		</div>
		</div>
		<!-- END ACCORDION MENU -->

	<?php } ?>
	<!-- END SHOW MOBILE NAV ON MOBILE DEVICES ONLY -->
	
<?php } else { ?>

		<!-- BEGIN MENU BAR -->
		<div class="mobilenav-wrapper<?php if ( is_admin_bar_showing() ) { ?> mobilenav-wp-toolbar<?php } else { ?><?php } ?><?php if( get_option('mobilenav_position_absolute') ) { ?> mobilenav-absolute<?php } ?><?php if( get_option('mobilenav_position_bottom') ) { ?> mobilenav-bottom<?php } ?>">
		
			<!-- BEGIN BACK BUTTON -->
			<?php if( get_option('mobilenav_hide_back_button') ) { ?>
			<?php } else { ?>
				<?php if(is_front_page() ) { ?><?php } else { ?>
					<div class="mobilenav-back-button" onClick="history.back()">
						<i class="fa <?php if( get_option('mobilenav_custom_back_icon') ) { ?><?php echo get_option('mobilenav_custom_back_icon'); ?><?php } else { ?>fa-long-arrow-left<?php } ?>"></i>
					</div>
				<?php } ?>
			<?php } ?>
			<!-- END BACK BUTTON -->
			
			<!-- BEGIN CALL BUTTON -->
			<?php if( get_option('mobilenav_hide_call_button') ) { ?>
			<?php } else { ?>
				<a href="<?php if( get_option('themo_mobilenav_custom_call_link') ) { ?><?php echo get_option('themo_mobilenav_custom_call_link'); ?><?php } else { ?>tel://<?php echo get_option('mobilenav_phone_number'); ?><?php } ?>" class="mobilenav-call-button">
					<i class="fa <?php if( get_option('mobilenav_custom_call_icon') ) { ?><?php echo get_option('mobilenav_custom_call_icon'); ?><?php } else { ?>fa-phone<?php } ?>"></i>
				</a>
			<?php } ?>
			<!-- END CALL BUTTON -->
			
			<!-- BEGIN EMAIL BUTTON -->
			<?php if( get_option('mobilenav_hide_email_button') ) { ?>
			<?php } else { ?>
				<a href="<?php if( get_option('themo_mobilenav_custom_email_link') ) { ?><?php echo get_option('themo_mobilenav_custom_email_link'); ?><?php } else { ?>mailto:<?php echo get_option('mobilenav_email'); ?><?php } ?>" class="mobilenav-email-button">
					<i class="fa <?php if( get_option('mobilenav_custom_email_icon') ) { ?><?php echo get_option('mobilenav_custom_email_icon'); ?><?php } else { ?>fa-envelope<?php } ?>"></i>
				</a>
			<?php } ?>
			<!-- END EMAIL BUTTON -->
			
			<!-- BEGIN MENU BUTTON -->
			<div class="mobilenav-menu-button">
				<i class="fa <?php if( get_option('mobilenav_custom_menu_icon') ) { ?><?php echo get_option('mobilenav_custom_menu_icon'); ?><?php } else { ?>fa-bars<?php } ?>"></i>
				<div class="mobilenav-accordion-tooltip"></div>
			</div>
			<!-- END MENU BUTTON -->

		</div>
		<!-- END MENU BAR -->
		
		<!-- BEGIN ACCORDION MENU -->
		<div class="mobilenav-menu-close"></div>
		<div class="<?php if( get_option('mobilenav_position_bottom') ) { ?>mobilenav-bottom<?php } ?>">
		<div class="mobilenav-by-themo<?php if( get_option('mobilenav_position_absolute') ) { ?> mobilenav-absolute<?php } ?>">
			<?php wp_nav_menu( array( 'theme_location' => 'mobilenav-by-themo' ) ); ?>
		</div>
		</div>
		<!-- END ACCORDION MENU -->

<?php } ?>
<!-- END SHOW MOBILE NAV ON MOBILE DEVICES ONLY -->

	<?php
	}
	add_action('wp_head','themo_mobilenav_footer');


	//
	// ENQUEUE mobilenav.css
	//

	function themo_mobilenav_css() {
	// enqueue mobilenav.css only on mobile
	if( get_option('mobilenav_mobile_only') ) {
	if ( wp_is_mobile() ) {
		wp_register_style( 'themo-mobilenav-css', plugins_url( '/mobilenav.css', __FILE__ ) . '', array(), '1', 'all' );
		wp_enqueue_style( 'themo-mobilenav-css' );
	}
	// enqueue mobilenav.css everywhere
	} else {
		wp_register_style( 'themo-mobilenav-css', plugins_url( '/mobilenav.css', __FILE__ ) . '', array(), '1', 'all' );
		wp_enqueue_style( 'themo-mobilenav-css' );
	}
	}
	add_action( 'wp_enqueue_scripts', 'themo_mobilenav_css' );


	//
	// ENQUEUE mobilenav.js
	//
	
	function themo_mobilenav_js() {
	// enqueue mobilenav.js only on mobile
	if( get_option('mobilenav_mobile_only') ) {
	if ( wp_is_mobile() ) {
		wp_register_script( 'themo-mobilenav-js', plugins_url( '/mobilenav.js', __FILE__ ) . '', array( 'jquery' ), '1', true );  
		wp_enqueue_script( 'themo-mobilenav-js' );  
	}
	// enqueue mobilenav.js everywhere
	} else {
		wp_register_script( 'themo-mobilenav-js', plugins_url( '/mobilenav.js', __FILE__ ) . '', array( 'jquery' ), '1', true );  
		wp_enqueue_script( 'themo-mobilenav-js' );
	}
	}
	add_action( 'wp_enqueue_scripts', 'themo_mobilenav_js' );


	//
	// ENQUEUE font-awesome.min.css (icons for menu)
	//
	
	function themo_mobilenav_fontawesome() {
	// enqueue font-awesome.min.css only on mobile
	if( get_option('mobilenav_mobile_only') ) {
	if ( wp_is_mobile() ) {
		wp_register_style( 'mobilenav-fontawesome', plugins_url( '/fonts/font-awesome/css/font-awesome.min.css', __FILE__ ) . '', array(), '1', 'all' );  
		wp_enqueue_style( 'mobilenav-fontawesome' );
	}
	// enqueue font-awesome.min.css everywhere
	} else {
		wp_register_style( 'mobilenav-fontawesome', plugins_url( '/fonts/font-awesome/css/font-awesome.min.css', __FILE__ ) . '', array(), '1', 'all' );  
		wp_enqueue_style( 'mobilenav-fontawesome' );
	}
	}
	add_action( 'wp_enqueue_scripts', 'themo_mobilenav_fontawesome' );


	//
	// Enqueue Google WebFonts
	//
	function themo_mobilenav_font() {
	$protocol = is_ssl() ? 'https' : 'http';

	// enqueue google webfonts only on mobile
	if( get_option('mobilenav_mobile_only') ) {
	if ( wp_is_mobile() ) {
		wp_enqueue_style( 'themo-mobilenav-font', "$protocol://fonts.googleapis.com/css?family=Open+Sans:400' rel='stylesheet' type='text/css" );
	}
	// enqueue google webfonts everywhere
	} else {
		wp_enqueue_style( 'themo-mobilenav-font', "$protocol://fonts.googleapis.com/css?family=Open+Sans:400' rel='stylesheet' type='text/css" );
	}
	}
	add_action( 'wp_enqueue_scripts', 'themo_mobilenav_font' );
	

	//
	// Register Custom Menu Function
	//
	if (function_exists('register_nav_menus')) {
		register_nav_menus( array(
			'mobilenav-by-themo' => ( 'Mobile Nav, by Themology' ),
		) );
	}

	//
	// Add color options to Appearance > Customize
	//
	add_action( 'customize_register', 'themo_mobilenav_customize_register' );
	function themo_mobilenav_customize_register($wp_customize)
	{
		$colors = array();
		/* MOBILE NAV > BACK button */
		$colors[] = array( 'slug'=>'themo_mobilenav_back_button_background', 'default' => '', 'label' => __( 'Mobile Nav > BACK button background', 'themo' ) );
		$colors[] = array( 'slug'=>'themo_mobilenav_back_button_icon', 'default' => '', 'label' => __( 'Mobile Nav > BACK button icon', 'themo' ) );
		$colors[] = array( 'slug'=>'themo_mobilenav_back_button_background_hover', 'default' => '', 'label' => __( 'Mobile Nav > BACK button background hover', 'themo' ) );
		$colors[] = array( 'slug'=>'themo_mobilenav_back_button_icon_hover', 'default' => '', 'label' => __( 'Mobile Nav > BACK button icon hover', 'themo' ) );

		/* Mobile Nav > CALL button */
		$colors[] = array( 'slug'=>'themo_mobilenav_call_button_background', 'default' => '', 'label' => __( 'Mobile Nav > CALL button background', 'themo' ) );
		$colors[] = array( 'slug'=>'themo_mobilenav_call_button_icon', 'default' => '', 'label' => __( 'Mobile Nav > CALL button icon', 'themo' ) );
		$colors[] = array( 'slug'=>'themo_mobilenav_call_button_background_hover', 'default' => '', 'label' => __( 'Mobile Nav > CALL button background hover', 'themo' ) );
		$colors[] = array( 'slug'=>'themo_mobilenav_call_button_icon_hover', 'default' => '', 'label' => __( 'Mobile Nav > CALL button icon hover', 'themo' ) );

		/* Mobile Nav > EMAIL button */
		$colors[] = array( 'slug'=>'themo_mobilenav_email_button_background', 'default' => '', 'label' => __( 'Mobile Nav > EMAIL button background', 'themo' ) );
		$colors[] = array( 'slug'=>'themo_mobilenav_email_button_icon', 'default' => '', 'label' => __( 'Mobile Nav > EMAIL button icon', 'themo' ) );
		$colors[] = array( 'slug'=>'themo_mobilenav_email_button_background_hover', 'default' => '', 'label' => __( 'Mobile Nav > EMAIL button background hover', 'themo' ) );
		$colors[] = array( 'slug'=>'themo_mobilenav_email_button_icon_hover', 'default' => '', 'label' => __( 'Mobile Nav > EMAIL button icon hover', 'themo' ) );

		/* Mobile Nav > MENU button */
		$colors[] = array( 'slug'=>'themo_mobilenav_menu_button_background', 'default' => '', 'label' => __( 'Mobile Nav > MENU button background', 'themo' ) );
		$colors[] = array( 'slug'=>'themo_mobilenav_menu_button_icon', 'default' => '', 'label' => __( 'Mobile Nav > MENU button icon', 'themo' ) );
		$colors[] = array( 'slug'=>'themo_mobilenav_menu_button_background_hover', 'default' => '', 'label' => __( 'Mobile Nav > MENU button background hover', 'themo' ) );
		$colors[] = array( 'slug'=>'themo_mobilenav_menu_button_icon_hover', 'default' => '', 'label' => __( 'Mobile Nav > MENU button icon hover', 'themo' ) );

		/* Mobile Nav > Menubar separator */
		$colors[] = array( 'slug'=>'themo_mobilenav_menubar_separator_color', 'default' => '', 'label' => __( 'Mobile Nav > Menubar separator', 'themo' ) );

		/* Mobile Nav > Accordion menu background */
		$colors[] = array( 'slug'=>'themo_mobilenav_accordion_menu_background', 'default' => '', 'label' => __( 'Mobile Nav > Accordion menu background', 'themo' ) );

		/* Mobile Nav > Accordion menu item background hover */
		$colors[] = array( 'slug'=>'themo_mobilenav_accordion_menu_item_background_hover', 'default' => '', 'label' => __( 'Mobile Nav > Accordion menu item background hover', 'themo' ) );

		/* Mobile Nav > Accordion menu separator */
		$colors[] = array( 'slug'=>'themo_mobilenav_accordion_menu_separator', 'default' => '', 'label' => __( 'Mobile Nav > Accordion menu separator', 'themo' ) );
		
		/* Mobile Nav > Accordion sub-menu separator */
		$colors[] = array( 'slug'=>'themo_mobilenav_accordion_submenu_separator', 'default' => '', 'label' => __( 'Mobile Nav > Accordion sub-menu separator', 'themo' ) );

		/* Mobile Nav > Accordion expand icon (down and up) */
		$colors[] = array( 'slug'=>'themo_mobilenav_accordion_expand_icon_down', 'default' => '', 'label' => __( 'Mobile Nav > Accordion expand icon (down)', 'themo' ) );
		$colors[] = array( 'slug'=>'themo_mobilenav_accordion_expand_icon_up', 'default' => '', 'label' => __( 'Mobile Nav > Accordion expand icon (up)', 'themo' ) );

		/* Mobile Nav > Accordion menu item */
		$colors[] = array( 'slug'=>'themo_mobilenav_accordion_menu_item', 'default' => '', 'label' => __( 'Mobile Nav > Accordion menu item', 'themo' ) );
		$colors[] = array( 'slug'=>'themo_mobilenav_accordion_menu_item_hover', 'default' => '', 'label' => __( 'Mobile Nav > Accordion menu item hover', 'themo' ) );

		/* Mobile Nav > Expanded menu item */
		$colors[] = array( 'slug'=>'themo_mobilenav_accordion_expanded_menu_item', 'default' => '', 'label' => __( 'Mobile Nav > Accordion expanded menu item', 'themo' ) );

		/* Mobile Nav > Expanded menu item background */
		$colors[] = array( 'slug'=>'themo_mobilenav_accordion_expanded_menu_item_background', 'default' => '', 'label' => __( 'Mobile Nav > Accordion expanded menu background', 'themo' ) );

		/* Mobile Nav > Sub-menu item with "text" class */
		$colors[] = array( 'slug'=>'themo_mobilenav_accordion_submenu_text_class', 'default' => '', 'label' => __( 'Mobile Nav > Accordion sub-menu item with "text" class', 'themo' ) );

		/* Mobile Nav > Sub-menu item */
		$colors[] = array( 'slug'=>'themo_mobilenav_accordion_submenu_item', 'default' => '', 'label' => __( 'Mobile Nav > Accordion sub-menu item', 'themo' ) );
		$colors[] = array( 'slug'=>'themo_mobilenav_accordion_submenu_item_hover', 'default' => '', 'label' => __( 'Mobile Nav > Accordion sub-menu item hover', 'themo' ) );

		/* Mobile Nav > Content overlay (when menu open) */
		$colors[] = array( 'slug'=>'themo_mobilenav_content_overlay', 'default' => '', 'label' => __( 'Mobile Nav > Content overlay (when menu open)', 'themo' ) );

	foreach($colors as $color)
	{

	/* create custom color customization section */
	$wp_customize->add_section( 'mobilenav_plugin_colors' , array( 'title' => __('Mobile Nav plugin colors', 'themo'), 'priority' => 30 ));
	$wp_customize->add_setting( $color['slug'], array( 'default' => $color['default'], 'type' => 'option', 'capability' => 'edit_theme_options' ));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array( 'label' => $color['label'], 'section' => 'mobilenav_plugin_colors', 'settings' => $color['slug'] )));
	}
	}


	//
	// Insert theme customizer options into the footer
	//
	
	function themo_mobilenav_header_customize() {
	?>

		<!-- BEGIN CUSTOM COLORS (WP THEME CUSTOMIZER) -->
		<!-- BACK button -->
		<?php $themo_mobilenav_back_button_background = get_option('themo_mobilenav_back_button_background'); ?>
		<?php $themo_mobilenav_back_button_icon = get_option('themo_mobilenav_back_button_icon'); ?>
		<?php $themo_mobilenav_back_button_background_hover = get_option('themo_mobilenav_back_button_background_hover'); ?>
		<?php $themo_mobilenav_back_button_icon_hover = get_option('themo_mobilenav_back_button_icon_hover'); ?>
		
		<!-- CALL button -->
		<?php $themo_mobilenav_call_button_background = get_option('themo_mobilenav_call_button_background'); ?>
		<?php $themo_mobilenav_call_button_icon = get_option('themo_mobilenav_call_button_icon'); ?>
		<?php $themo_mobilenav_call_button_background_hover = get_option('themo_mobilenav_call_button_background_hover'); ?>
		<?php $themo_mobilenav_call_button_icon_hover = get_option('themo_mobilenav_call_button_icon_hover'); ?>

		<!-- EMAIL button -->
		<?php $themo_mobilenav_email_button_background = get_option('themo_mobilenav_email_button_background'); ?>
		<?php $themo_mobilenav_email_button_icon = get_option('themo_mobilenav_email_button_icon'); ?>
		<?php $themo_mobilenav_email_button_background_hover = get_option('themo_mobilenav_email_button_background_hover'); ?>
		<?php $themo_mobilenav_email_button_icon_hover = get_option('themo_mobilenav_email_button_icon_hover'); ?>

		<!-- MENU button -->
		<?php $themo_mobilenav_menu_button_background = get_option('themo_mobilenav_menu_button_background'); ?>
		<?php $themo_mobilenav_menu_button_icon = get_option('themo_mobilenav_menu_button_icon'); ?>
		<?php $themo_mobilenav_menu_button_background_hover = get_option('themo_mobilenav_menu_button_background_hover'); ?>
		<?php $themo_mobilenav_menu_button_icon_hover = get_option('themo_mobilenav_menu_button_icon_hover'); ?>

		<!-- menu bar separator -->
		<?php $themo_mobilenav_menubar_separator_color = get_option('themo_mobilenav_menubar_separator_color'); ?>

		<!-- accordion menu background -->
		<?php $themo_mobilenav_accordion_menu_background = get_option('themo_mobilenav_accordion_menu_background'); ?>
		
		<!-- accordion menu item background hover -->
		<?php $themo_mobilenav_accordion_menu_item_background_hover = get_option('themo_mobilenav_accordion_menu_item_background_hover'); ?>

		<!-- accordion menu separator -->
		<?php $themo_mobilenav_accordion_menu_separator = get_option('themo_mobilenav_accordion_menu_separator'); ?>

		<!-- accordion sub-menu separator -->
		<?php $themo_mobilenav_accordion_submenu_separator = get_option('themo_mobilenav_accordion_submenu_separator'); ?>
		
		<!-- accordion expand icon (down and up) -->
		<?php $themo_mobilenav_accordion_expand_icon_down = get_option('themo_mobilenav_accordion_expand_icon_down'); ?>
		<?php $themo_mobilenav_accordion_expand_icon_up = get_option('themo_mobilenav_accordion_expand_icon_up'); ?>

		<!-- accordion menu item -->
		<?php $themo_mobilenav_accordion_menu_item = get_option('themo_mobilenav_accordion_menu_item'); ?>
		<?php $themo_mobilenav_accordion_menu_item_hover = get_option('themo_mobilenav_accordion_menu_item_hover'); ?>

		<!-- expanded menu item -->
		<?php $themo_mobilenav_accordion_expanded_menu_item = get_option('themo_mobilenav_accordion_expanded_menu_item'); ?>

		<!-- expanded menu item background -->
		<?php $themo_mobilenav_accordion_expanded_menu_item_background = get_option('themo_mobilenav_accordion_expanded_menu_item_background'); ?>

		<!-- accordion sub-menu item with "text" class -->
		<?php $themo_mobilenav_accordion_submenu_text_class = get_option('themo_mobilenav_accordion_submenu_text_class'); ?>
		
		<!-- accordion sub-menu item -->
		<?php $themo_mobilenav_accordion_submenu_item = get_option('themo_mobilenav_accordion_submenu_item'); ?>
		<?php $themo_mobilenav_accordion_submenu_item_hover = get_option('themo_mobilenav_accordion_submenu_item_hover'); ?>

		<!-- content overlay (when menu open) -->
		<?php $themo_mobilenav_content_overlay = get_option('themo_mobilenav_content_overlay'); ?>
		
		<style>
		/**************************************************************
		*** MAIN MENUBAR COLORS (back + call + email + menu buttons)
		**************************************************************/
		/* BACK button */
		.mobilenav-wrapper .mobilenav-back-button { color:<?php echo $themo_mobilenav_back_button_icon; ?>; background-color:<?php echo $themo_mobilenav_back_button_background; ?>; }
		.mobilenav-wrapper .mobilenav-back-button:hover { color:<?php echo $themo_mobilenav_back_button_icon_hover; ?>; background-color:<?php echo $themo_mobilenav_back_button_background_hover; ?>; }

		/* CALL button */
		.mobilenav-wrapper .mobilenav-call-button { color:<?php echo $themo_mobilenav_call_button_icon; ?>; background-color:<?php echo $themo_mobilenav_call_button_background; ?>; }
		.mobilenav-wrapper .mobilenav-call-button:hover { color:<?php echo $themo_mobilenav_call_button_icon_hover; ?>; background-color:<?php echo $themo_mobilenav_call_button_background_hover; ?>; }
		
		/* EMAIL button */
		.mobilenav-wrapper .mobilenav-email-button { color:<?php echo $themo_mobilenav_email_button_icon; ?>; background-color:<?php echo $themo_mobilenav_email_button_background; ?>; }
		.mobilenav-wrapper .mobilenav-email-button:hover { color:<?php echo $themo_mobilenav_email_button_icon_hover; ?>; background-color:<?php echo $themo_mobilenav_email_button_background_hover; ?>; }
		
		/* MENU button */
		.mobilenav-menu-button { color:<?php echo $themo_mobilenav_menu_button_icon; ?>; background-color:<?php echo $themo_mobilenav_menu_button_background; ?>; }
		.mobilenav-menu-button-hover, .mobilenav-menu-button-hover-touch, .mobilenav-menu-button-active { color:<?php echo $themo_mobilenav_menu_button_icon_hover; ?>; background-color:<?php echo $themo_mobilenav_menu_button_background_hover; ?>; }
		
		/* menu bar separator */
		.mobilenav-wrapper .mobilenav-back-button, .mobilenav-wrapper .mobilenav-call-button, .mobilenav-wrapper .mobilenav-email-button, .mobilenav-menu-button { border-color:<?php echo $themo_mobilenav_menubar_separator_color; ?>; }

		/* accordion background */
		.mobilenav-accordion-tooltip { border-bottom-color:<?php echo $themo_mobilenav_accordion_menu_background; ?>; }
		.mobilenav-bottom .mobilenav-accordion-tooltip { border-top-color:<?php echo $themo_mobilenav_accordion_menu_background; ?>; }
		.mobilenav-by-themo { background:<?php echo $themo_mobilenav_accordion_menu_background; ?>; }

		/* accordion menu item hover */
		.mobilenav-by-themo .menu li:hover { background-color:<?php echo $themo_mobilenav_accordion_menu_item_background_hover; ?>; }

		/* accordion menu separator */
		.mobilenav-by-themo .menu li { border-top-color:<?php echo $themo_mobilenav_accordion_menu_separator; ?>; }
		
		/* accordion sub-menu separator */
		.mobilenav-by-themo .sub-menu li { border-bottom-color:<?php echo $themo_mobilenav_accordion_submenu_separator; ?>; }
		
		/* accordion expand icon (down and up) */
		.mobilenav-by-themo .menu-item-has-children:before { color:<?php echo $themo_mobilenav_accordion_expand_icon_down; ?>; }
		.mobilenav-by-themo .menu-item-has-children .menu-expanded:after { color:<?php echo $themo_mobilenav_accordion_expand_icon_up; ?>; }
		
		/* accordion menu item */
		.mobilenav-by-themo .menu a { color:<?php echo $themo_mobilenav_accordion_menu_item; ?>; }
		.mobilenav-by-themo .menu a:hover, .mobilenav-by-themo .menu a:active { color:<?php echo $themo_mobilenav_accordion_menu_item_hover; ?>; }

		/* expanded menu item */
		.mobilenav-by-themo .menu-item-has-children .menu-expanded, .mobilenav-by-themo .menu-item-has-children .menu-expanded:hover { color:<?php echo $themo_mobilenav_accordion_expanded_menu_item; ?>; }

		/* expanded menu item background */
		.mobilenav-by-themo .menu ul, .mobilenav-by-themo .menu-item-has-children .menu-expanded { background-color:<?php echo $themo_mobilenav_accordion_expanded_menu_item_background; ?> !important; }

		/* accordion sub-menu with "text" class */
		.mobilenav-by-themo .sub-menu li.text a { color:<?php echo $themo_mobilenav_accordion_submenu_text_class; ?>; }
		
		/* accordion sub-menu item */
		.mobilenav-by-themo .sub-menu a { color:<?php echo $themo_mobilenav_accordion_submenu_item; ?>; }
		.mobilenav-by-themo .sub-menu a:hover, .mobilenav-by-themo .sub-menu a:active { color:<?php echo $themo_mobilenav_accordion_submenu_item_hover; ?>; }
		
		/* content overlay (when menu open) */
		.mobilenav-menu-close { background-color:<?php echo $themo_mobilenav_content_overlay; ?>; }
		
		/* menu transparency */
		.mobilenav-wrapper { opacity:<?php echo get_option('mobilenav_set_transparency'); ?> }
		</style>
		<!-- END CUSTOM COLORS (WP THEME CUSTOMIZER) -->
	
	<?php
	}
	add_action('wp_footer','themo_mobilenav_header_customize');
?>