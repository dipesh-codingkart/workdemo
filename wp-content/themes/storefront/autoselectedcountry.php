<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/wordpressnew/wp-config.php';
	defined( 'ABSPATH' ) || exit;
	$productid = $_GET['productid'];
	$product = new WC_Product_Variable($productid);
 	$available_variations = $product->get_available_variations();

	$zones_id = $_GET['zone_id'];
	$zones = $data = $classes_keys = array();
	// Rest of the World zone
	$zone                                              = new \WC_Shipping_Zone(0);
	$zones[$zone->get_id()]                            = $zone->get_data();
	$zones[$zone->get_id()]['formatted_zone_location'] = $zone->get_formatted_location();
	$zones[$zone->get_id()]['shipping_methods']        = $zone->get_shipping_methods();

	// Merging shipping zones
	$shipping_zones = array_merge( $zones, WC_Shipping_Zones::get_zones() );

	// Shipping Classes
	$shipping           = new \WC_Shipping();
	$shipping_classes   = $shipping->get_shipping_classes();

	// The Shipping Classes for costs in "Flat rate" Shipping Method
	foreach($shipping_classes as $shipping_class)
	{
		if(!empty($shipping_class->term_id))
		{
			$key_class_cost = 'class_cost_'.$shipping_class->term_id;	
			// The shipping classes
			$classes_keys[$shipping_class->term_id] = array(
				'term_id' => $shipping_class->term_id,
				'name' => $shipping_class->name,
				'slug' => $shipping_class->slug,
				'count' => $shipping_class->count,
				'key_cost' => $key_class_cost
			);
		}	
	}
	// For 'No class" cost
	/*$classes_keys[0] = array(
		'term_id' => '',
		'name' =>  'No shipping class',
		'slug' => 'no_class',
		'count' => '',
		'key_cost' => 'no_class_cost'
	);*/
	foreach ( $shipping_zones as $shipping_zone ) 
	{
		if($shipping_zone['id'] == $zones_id)
		{
			$zone_id = $shipping_zone['id'];
			$zone_name = $zone_id == '0' ? __('Rest of the word', 'woocommerce') : $shipping_zone['zone_name'];
			$zone_locations = $shipping_zone['zone_locations'][0]->code; // array
			$zone_location_name = $shipping_zone['formatted_zone_location'];
			$countries_obj   = new WC_Countries();
    		$default_county_states = $countries_obj->get_states($zone_locations);
			// Set the data in an array:
			$data[$zone_id]= array(
				'zone_id'               => $zone_id,
				'zone_name'             => $zone_name,
				'zone_location_name'    => $zone_location_name,
				'zone_locations'        => $zone_locations,
				'shipping_methods'      => array()
			);
			if($shipping_zone['id'] != '1') {
				foreach ( $shipping_zone['shipping_methods'] as $sm_obj ) 
				{
					$method_id   = $sm_obj->id;
					$instance_id = $sm_obj->get_instance_id();
					$enabled = $sm_obj->is_enabled() ? true : 0;
					// Settings specific to each shipping method
					$instance_settings = $sm_obj->instance_settings;
					if( $enabled ){
						$data[$zone_id]['shipping_methods'][$instance_id] = array(
							'$method_id'    => $sm_obj->id,
							'instance_id'   => $instance_id,
							'rate_id'       => $sm_obj->get_rate_id(),
							'default_name'  => $sm_obj->get_method_title(),
							'custom_name'   => $sm_obj->get_title(),
						);
						if( $method_id == 'free_shipping' ){
							$data[$zone_id]['shipping_methods'][$instance_id]['requires'] = $instance_settings['requires'];
							$data[$zone_id]['shipping_methods'][$instance_id]['min_amount'] = $instance_settings['min_amount'];
						}
						if( $method_id == 'flat_rate' ){
							$data[$zone_id]['shipping_methods'][$instance_id]['class_costs'] = $instance_settings['class_costs'];
							$data[$zone_id]['shipping_methods'][$instance_id]['calculation_type'] = $instance_settings['type'];
							//$classes_keys[0]['cost'] = $instance_settings['no_class_cost'];
								foreach( $instance_settings as $key => $setting )
								if ( strpos( $key, 'class_cost_') !== false )
								{
									$class_id = str_replace('class_cost_', '', $key );								
									$subtotal = $classes_keys[$class_id]['cost'] = $setting;
									if($classes_keys[$class_id]['term_id'])
									{		
										$terms_data[] = $classes_keys[$class_id];
									}	
								}
							$data[$zone_id]['shipping_methods'][$instance_id]['classes_costs'] = $classes_keys;
						}
					}
				}
			}	
		}	
	}
	$data[$zones_id];		
	echo json_encode(array('selected_country_name'=>$zone_location_name,'dataterm'=>$terms_data ,'states'=>$default_county_states));
?>