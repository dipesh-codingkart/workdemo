<?php
class managedate
{
	function __construct()
	{
		add_action('admin_menu', array($this,'managedate_menu'));
		add_action('admin_enqueue_scripts',array($this,'wp_adding_scripts'));
		add_action('admin_init', array($this,'talimiboard_register_theme_settings'));
	}
	public function wp_adding_scripts() 
    {
		if($_GET['page']=='manage_date') {
			wp_register_script('jquery-ui', get_template_directory_uri().'/classes/admin/managedate/js/jquery-ui.js',array('jquery'),'1.1', true);
			wp_enqueue_script('jquery-ui');
			wp_register_script('jquery-custom-manage', get_template_directory_uri().'/classes/admin/managedate/js/jquery-custom-manage.js',array('jquery'),'1.1', true);
			wp_enqueue_script('jquery-custom-manage');
			wp_register_script('jquery-ui.multidatespicker', get_template_directory_uri().'/classes/admin/managedate/js/jquery-ui.multidatespicker.js',array('jquery'),'1.1', true);
			wp_enqueue_script('jquery-ui.multidatespicker');
			wp_register_script('jquery.timeselector', get_template_directory_uri().'/classes/admin/managedate/js/jquery.timeselector.js',array('jquery'),'1.1', true);
			wp_enqueue_script('jquery.timeselector');
			wp_register_style('jquery-ui', get_template_directory_uri().'/classes/admin/managedate/css/jquery-ui.css');
			wp_enqueue_style('jquery-ui');
			wp_register_style('jquery-ui.multidatespicker', get_template_directory_uri().'/classes/admin/managedate/css/jquery-ui.multidatespicker.css');
			wp_enqueue_style('jquery-ui.multidatespicker');
			wp_register_style('jquery.timeselector', get_template_directory_uri().'/classes/admin/managedate/css/jquery.timeselector.css');
			wp_enqueue_style('jquery.timeselector');
		}	
	}
	public function managedate_menu() {	
 	  	add_menu_page('Manage Date','Manage date','manage_options','manage_date', array($this,'managedate_funct'),'dashicons-smiley','56');
	}
	public function talimiboard_register_theme_settings()
    {
        register_setting('managedate_funct', 'express_priority');
        register_setting('managedate_funct', 'gift_sub_time');
        register_setting('managedate_funct', 'GS_non_branded_mailer_shipping_amount');
        register_setting('managedate_funct', 'intl_calendar');
        register_setting('managedate_funct', 'us_shipping_mehtod_disable');
        register_setting('managedate_funct', 'us_shipping_mehtod_first');
		register_setting('managedate_funct', 'us_free_shipping_cal');
		register_setting('managedate_funct', 'disable_tasting_kit_cal');
		register_setting('managedate_funct', 'ground_grind_dates');
		register_setting('managedate_funct', 'holiday_dates');
    }
	public function managedate_funct()
	{
		if($_GET['page']=='manage_date') {
			include 'adminmanagedate.php';
		}	
	}
}
new managedate();
?>