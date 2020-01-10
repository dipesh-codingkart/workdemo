<?php
class mainclass
{
	function __construct()
	{
		require 'customize-gift/template.php';
		if(is_admin()) {
			require 'admin/managedate/datefuction.php';
		}
		add_filter( 'woocommerce_shipping_instance_form_fields_flat_rate', array( $this, 'add_extra_fields_in_flat_rate_shipping_method' ), 10, 1);
		add_filter('woocommerce_shipping_instance_form_fields_free_shipping', array( $this, 'add_extra_fields_in_free_shipping_method' ), 10, 1);
	}
	public function add_extra_fields_in_flat_rate_shipping_method($settings)
	{
		$counter = 0;
		$arr = array();
		foreach ($settings as $key => $value)
		{
			if($key=='cost' && $counter==0)
			{
				$arr[$key] = $value;
				$arr['shipping_assign'] = array(
					'title' 		=> __( 'Shipping Assign', 'woocommerce' ),
					'type' 			=> 'text',
					'placeholder'	=> 'shipping',
					'description'	=> '',
					// 'default' 		=> 'shipping',
					// 'desc_tip'		=> true
				);
				$arr['shipping_msg'] = array(
					'title' 		=> __( 'Shipping Message', 'woocommerce' ),
					'type' 			=> 'text',
					'placeholder'	=> 'msg',
					'description'	=> '',
					// 'default' 		=> 'msg',
					// 'desc_tip'		=> true
				);
				$counter++;
			}
			else
			{
				$arr[$key] = $value;
			}
		}
		return $arr;
	}
	public function add_extra_fields_in_free_shipping_method($settings)
	{
		$settings['shipping_assign'] = array(
			'title' 		=> __( 'Shipping Assign', 'woocommerce' ),
			'type' 			=> 'text',
			'placeholder'	=> 'shipping',
			'description'	=> '',
			// 'default' 		=> 'shipping',
			// 'desc_tip'		=> true
		);
		$settings['shipping_msg'] = array(
			'title' 		=> __( 'Shipping Message', 'woocommerce' ),
			'type' 			=> 'text',
			'placeholder'	=> 'msg',
			'description'	=> '',
			// 'default' 		=> 'msg',
			// 'desc_tip'		=> true
		);
		return $settings;	
	}
}
new mainclass();
?>