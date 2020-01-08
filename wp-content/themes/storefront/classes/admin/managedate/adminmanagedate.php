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
		</tbody>
	</table>
	<?php submit_button(); ?>
</form>