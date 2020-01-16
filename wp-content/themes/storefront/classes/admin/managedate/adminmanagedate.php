<form  method="post" action="options.php">
	<?php settings_fields('managedate_funct'); ?>
	<table>
		<tbody>
			<tr>
				<td>Enable Date for Calender (only for express and priority)</td>
				<td>
					<div class="select_epdates"></div> <input type="hidden" name="express_priority" class="express_priority" value="<?php echo get_option('express_priority'); ?>">
				</td>
			</tr>
			<tr>
				<td>Timing for Gift Subscription</td>
				<td>
					<input type="text" name="gift_sub_time" class="gift_sub_tp" value="<?php echo get_option('gift_sub_time'); ?>">
				</td>
			</tr>
			<tr>
				<td>Disable Shipping Methods for US</td>
				<td> 
				<?php
					$zone_id='1'; /* by us country methods show */
					$delivery_zones = WC_Shipping_Zones::get_zones();
					foreach ( $delivery_zones[$zone_id]['shipping_methods'] as $sm_obj ) 
					{
						$method_id   = $sm_obj->id;
						$instance_id = $sm_obj->get_instance_id();
						$enabled = $sm_obj->is_enabled() ? true : 0;
						if($enabled) {
							$data[$zone_id]['shipping_methods'][$instance_id] = array(
								'$method_id'    => $sm_obj->id,
								'instance_id'   => $instance_id,
								'default_name'  => $sm_obj->get_method_title(),
								'custom_name'   => $sm_obj->get_title(),
							);
							$us_shipping_mehtodid = $data[$zone_id]['shipping_methods'][$instance_id]['instance_id'];
						} 
						?>
						<input type="checkbox" name="us_shipping_mehtod_disable[]" <?php if(!empty(get_option( 'us_shipping_mehtod_disable' ))) { if(in_array($us_shipping_mehtodid,get_option( 'us_shipping_mehtod_disable' ))) { echo 'checked'; } } ?>  value="<?php echo $us_shipping_mehtodid; ?>"><?php echo $data[$zone_id]['shipping_methods'][$instance_id]['custom_name']; ?><br><?php
					}
				?>
				</td>
			</tr>
			<tr>
				<td>Trigger Shipping Methods</td>
				<td> 
				<?php
					foreach ( $delivery_zones[$zone_id]['shipping_methods'] as $sm_obj ) 
					{
						$method_id   = $sm_obj->id;
						$instance_id = $sm_obj->get_instance_id();
						$enabled = $sm_obj->is_enabled() ? true : 0;
						if($enabled) {
							$data[$zone_id]['shipping_methods'][$instance_id] = array(
								'$method_id'    => $sm_obj->id,
								'instance_id'   => $instance_id,
								'default_name'  => $sm_obj->get_method_title(),
								'custom_name'   => $sm_obj->get_title(),
							);
							//print_r($data[$zone_id]['shipping_methods'][$instance_id]);
							$us_shipping_mehtodid = $data[$zone_id]['shipping_methods'][$instance_id]['instance_id'];
						} 
						?>
						<input type="radio" name="us_shipping_mehtod_first" <?php if(!empty(get_option('us_shipping_mehtod_first'))) { if($us_shipping_mehtodid==get_option('us_shipping_mehtod_first')) { echo 'checked'; } } else {  if($data[$zone_id]['shipping_methods'][$instance_id]['$method_id']=='free_shipping') { echo 'checked'; }  }   ?>  value="<?php echo $us_shipping_mehtodid; ?>"><?php echo $data[$zone_id]['shipping_methods'][$instance_id]['custom_name']; ?><br><?php
					}
				?>
				</td>
			</tr>	
			<tr>
				<td>Non-Branded Mailer Shipping Amount</td>
				<td>
					<input type="text" name="GS_non_branded_mailer_shipping_amount"  value="<?php echo get_option('GS_non_branded_mailer_shipping_amount'); ?>">
				</td>
			</tr>
			<tr>
				<td>International Calendar</td>
				<td>
					<div class="select_intlcdates"></div> <input type="hidden" name="intl_calendar" class="intl_calendar"  value="<?php echo get_option('intl_calendar'); ?>">
				</td>
			</tr>
			<tr>
				<td>Enable Specific Dates</td>
				<td>
					<div class="select_free_shipping_dates"></div> <input type="hidden" name="us_free_shipping_cal" class="us_free_shipping_cal"  value="<?php echo get_option('us_free_shipping_cal'); ?>">
				</td>
			</tr>
			<tr>
				<td>Disable Dates Calender for Gift Tasting Kit</td>
				<td>
					<div class="select_disable_tasting_kit_dates"></div> <input type="hidden" name="disable_tasting_kit_cal" class="disable_tasting_kit_cal"  value="<?php echo get_option('disable_tasting_kit_cal'); ?>">
				</td>
			</tr>
			<tr>
				<td>Enable Dates Calender for Gift (Ground Grind Type)</td>
				<td>
					<div class="select_ground_grind_cal"></div> <input type="hidden" name="ground_grind_dates" class="ground_grind_dates"  value="<?php echo get_option('ground_grind_dates'); ?>">
				</td>
			</tr>			
		</tbody>
	</table>
	<?php submit_button(); ?>
</form>