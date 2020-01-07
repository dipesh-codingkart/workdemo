<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version'    => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';
require 'classes/mainfunct.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce            = require 'inc/woocommerce/class-storefront-woocommerce.php';
	$storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php';

	require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
	require 'inc/woocommerce/storefront-woocommerce-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';

	if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.0.0', '>=' ) ) {
		require 'inc/nux/class-storefront-nux-starter-content.php';
	}
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */
 
function remove_jquery_migrate_notice() {
    $m= $GLOBALS['wp_scripts']->registered['jquery-migrate'];
    $m->extra['before'][]='temp_jm_logconsole = window.console.log; window.console.log=null;';
    $m->extra['after'][]='window.console.log=temp_jm_logconsole;';
}
add_action( 'init', 'remove_jquery_migrate_notice', 5 );

/* 
function my_custom_shipping_init() {
    class WC_Shipping_Flat_Rate extends WC_Shipping_Method {
        public function __construct( $instance_id = 0 ) {
			$this->id                 = 'flat_rate';
			$this->instance_id        = absint( $instance_id );
			$this->method_title       = __( 'Flat rate', 'woocommerce' );
			$this->method_description = __( 'Lets you charge a fixed rate for shipping.', 'woocommerce' );
			$this->supports           = array(
				'shipping-zones',
				'instance-settings',
				'instance-settings-modal',
			);		
			$this->initnew();	
			add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
		}
		public function initnew() {
		$this->form_fields = array(

					'title232' => array(
						'title'       => __( 'Title', 'dc_raq' ),
						'type'        => 'text',
						'description' => __( 'Title to be displayed on site', 'dc_raq' ),
						'default'     => __( 'Request a Quote', 'dc_raq' )
					)

				);
			$this->title232 = $this->get_option( 'title232' );
		}
    }
}
add_action( 'woocommerce_shipping_init', 'my_custom_shipping_init' );
 */
//define the woocommerce_<id>_shipping_add_rate callback 
function action_woocommerce_id_shipping_add_rate( $instance, $rate ) { 
    
	print_r("wwwwwwwwwwwwwwwwwww");	
}; 
         
// add the action 
add_action( "woocommerce_flat_rate_shipping_add_rate", 'action_woocommerce_id_shipping_add_rate', 10, 2 ); 