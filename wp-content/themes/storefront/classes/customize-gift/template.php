<?php
class giftclass
{
	function __construct()
	{
		add_action('wp_enqueue_scripts',array($this,'wp_adding_scripts'));
		// add_action('wp_footer', array($this,'method'));
	}
	public function wp_adding_scripts() 
    {
    	if(is_page_template('gifttemplate.php'))
    	{
			wp_register_script('jquery-ui', get_template_directory_uri().'/classes/customize-gift/js/jquery-ui.js',array('jquery'),'1.1', true);
			wp_enqueue_script('jquery-ui');
			wp_register_script('custom', get_template_directory_uri() . '/classes/customize-gift/js/custom.js',array('jquery'),'1.1', true);
			wp_enqueue_script('custom');
			wp_register_script('bootstrap.min', get_template_directory_uri() . '/classes/customize-gift/js/bootstrap.min.js',array('jquery'),'3.4.1', true);
			wp_enqueue_script('bootstrap.min');
			wp_register_style('custom', get_template_directory_uri().'/classes/customize-gift/css/custom.css');
			wp_enqueue_style('custom');
			wp_register_style('bootstrap.min', get_template_directory_uri().'/classes/customize-gift/css/bootstrap.min.css');
			wp_enqueue_style('bootstrap.min');
			wp_register_style('jquery-ui', get_template_directory_uri().'/classes/customize-gift/css/jquery-ui.css');
			wp_enqueue_style('jquery-ui');
		}
	}
	/* public function method()
	{
		echo get_template_directory_uri() . '/classes/js/bootstrap.min.js';
	} */
}
new giftclass();
?>