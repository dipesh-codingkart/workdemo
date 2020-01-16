<?php 
	/* Template Name: Gift Templates */
	get_header();
	global $product;
	$productid='10';
	$product = new WC_Product_Variable($productid);
	$available_variations = $product->get_available_variations();
	$checkedvariation =  json_encode($available_variations);
	
	$productbysize = wc_get_product_terms( $productid, 'pa_size', array( 'fields' => 'all' ) );
	$productbyduration = wc_get_product_terms( $productid, 'pa_duration', array( 'fields' => 'all' ) );
    $productbyfrequency = wc_get_product_terms( $productid, 'pa_frequency', array( 'fields' => 'all' ) );
	$shipping_classess = array();
	foreach($product->get_visible_children() as $variation_id)
	{
		$variation = wc_get_product($variation_id); 
		$term_id = $variation->get_shipping_class_id(); 
		$term = get_term_by('term_id', $term_id, 'product_shipping_class'); 
		$shipping_term_id[$variation_id] = $term->term_id;
	}
	$shipping_term_id = json_encode($shipping_term_id);
	global $woocommerce;
	$delivery_zones = WC_Shipping_Zones::get_zones();
	$gift_sub_time = explode(':',get_option('gift_sub_time'));
?>
<div class="container mainloder">
<form id="myForm">
<div class="col-sm-10 borderright">
	<div>
		<a href="javascript:void(0);" class="tablink" data-tabid="COFFEE" >COFFEE</a>
		<a href="javascript:void(0);" class="tablink geartab" data-tabid="GEAR">GEAR</a>
		<a href="javascript:void(0);" class="tablink" data-tabid="DELIVERY">DELIVERY</a>
		<a href="javascript:void(0);" class="tablink" data-tabid="TIMING">TIMING</a>
		<a href="javascript:void(0);" class="tablink" data-tabid="REVIEW">REVIEW</a>
	</div><br><br><br><br>
	<div class="tabcontent_COFFEE">
			<h3>1. CHOOSE SIZE</h3>
			<div class="row">
				<?php
					$sizecount=0;
					foreach($productbysize as $valofsize)
					{
				?>		
					<label class="col-sm-4"><input type="radio" class="variationconnect" <?php if($sizecount=='1') { echo "checked"; } ?> name="productsize" value="<?php echo $valofsize->slug; ?>"><?php echo $valofsize->name; ?></label>
				<?php
					++$sizecount;
					}
				?>
			</div>
			<h3>2. HOW OFTEN?</h3>
			<div class="row">
				<?php
					$frequencycount=0; 
					foreach($productbyfrequency as $valoffrequency)
					{
				?>		
					<label class="col-sm-4" id="frequencysh_<?php echo $frequencyslug[] = $valoffrequency->slug; ?>" ><input  <?php if($frequencycount=='0') { echo "checked"; } ?> type="radio" class="variationconnect" name="productfrequency" value="<?php echo $valoffrequency->slug; ?>"><?php echo $valoffrequency->name; ?></label>
				<?php
					++$frequencycount;
					}
				?>
			</div>
			<h3>3. HOW LONG?</h3>
			<div class="row">
				<?php
					$durationcount = 0;
					foreach($productbyduration as $valofduration)
					{
				?>		
					<label class="col-sm-4"   id="durationsh_<?php echo $durationslug[] = $valofduration->slug; ?>"  <?php if($valofduration->slug == 'two-months') { echo "style=display:none";  } ?> ><input type="radio" class="variationconnect" <?php if($durationcount=='0') { echo "checked"; } ?> name="productduration" value="<?php echo $valofduration->slug; ?>"><?php echo $valofduration->name; ?></label>
				<?php
					++$durationcount;
					}
				?>
			</div>
			<h3>4. GRIND TYPE?</h3>
			<div class="row">
				<?php
					$taxonomy = 'pa_grind_type';
					$args=array(
					  'hide_empty' => false,
					  'orderby' => 'name',
					  'order' => 'DESC'
					);
					$tax_terms = get_terms( $taxonomy, $args );
					foreach ( $tax_terms as $tax_term ) {
						?>
						<label class="col-sm-4">
							<input type="radio"  class="variationconnect"  <?php if($tax_term->slug=='whole-bean') { echo "checked"; } ?> name="grind_type" value="<?php echo $tax_term->slug; ?>"><?php echo $tax_term->name; ?>	
								</label>
					<?php
					}
					$groundtaxonomy = 'pa_ground-grind-type';
					$groundargs=array(
					  'hide_empty' => false,
					  'orderby' => 'name',
					  'order' => 'ASC'
					);
					$groundtax_terms = get_terms( $groundtaxonomy, $groundargs );
					?>	
					<label class="col-sm-4 ground_grind_type" style='display:none;' >
						<select  name="ground_grind_type"  class="from-control ground_grind_type_value">
						<?php
							foreach($groundtax_terms as $groundtax_term)
							{
								?>
								<option value="<?php echo $groundtax_term->slug; ?>"><?php echo $groundtax_term->name; ?></option>
								<?php
							}
						?>
						</select>	
					</label>		
			</div>
	</div>
	<div class="tabs  tabcontent_GEAR">
		<div class="row col-md-12">
			<ul class="list-inline">
				<li class="active"><a href="javascript:void(0);" class="selectprosubcat" data-subcategory="allproducts">All</a></li>
				<?php
					$sub_cats_args = array(
							'taxonomy'     => 'product_cat',
							'child_of'     => 0,
							'parent'       => '140',
							'orderby'      => 'name',
							'show_count'   => 0,
							'pad_counts'   => 0,
							'hierarchical' => 1,
							'title_li'     => '',
							'hide_empty'   => 0
					);
					$sub_cats = get_categories( $sub_cats_args );
					if($sub_cats) 
					{
						foreach($sub_cats as $sub_category) 
						{
							echo '<li><a href="javascript:void(0);"  class="selectprosubcat" data-subcategory="'.$sub_category->slug.'" >'.$sub_category->name.'</a></li>';
						}   
					}
				?>	
			</ul>
		</div>
		<div class="row">		
		<?php 	$productargs = array( 'post_type' => 'product',  'product_cat' => 'addons',  'orderby' => 'menu_order' );
				$productloop = new WP_Query( $productargs );
				while ( $productloop->have_posts() ) : $productloop->the_post(); global $product; 
				if ( $product->is_in_stock() ) 
				{
					?>
					<div class="col-sm-3 autohideshow subcats_<?php $cat = get_the_terms( $post->ID, 'product_cat' ); foreach ($cat as $categoria) { if($categoria->parent == '140'){ echo $categoria->slug; } } ?>">
						<?php woocommerce_show_product_sale_flash( $post, $product ); ?>
						<?php if (has_post_thumbnail( $productloop->post->ID )) echo get_the_post_thumbnail($productloop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />'; ?>
						<h3><?php the_title(); ?></h3>
						<p><?php echo $productloop->post->post_excerpt;; ?></p>
						<label><?php echo $product->get_price_html(); ?>
						<input type="checkbox" data-id="<?php echo $productloop->post->ID; ?>" data-pdtname="<?php echo the_title(); ?>"  class="ckprodadd" name="productaddon" value="<?php echo $product->get_price(); ?>" >
						<span  class="oncountrychg changedata_<?php echo $productloop->post->ID; ?>">ADD</span></label>       
					</div>	
					<?php 
				}
				endwhile;
		?>
		</div>
	</div>
	<div  class="tabs tabcontent_DELIVERY">
			<span class="chooseformerror"></span>		
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title">
							<label>
									<input type="radio" name="xzy" class="chooseform chooseform_1" value="1" data-formid="1" >
									Send the first box to the recipient
							</label>
						</h4>
					</div>
					<div class="firsthidefrom form1">
						<div class="panel-body">
							<div class="col-md-12">
								<form class="form-horizontal" action="/action_page.php">
									<div class="form-group  col-sm-6">
										<label class="control-label" >RECIPIENT DETAILS</label>
									</div>
									<div class="form-group  col-sm-6">
										<label class="control-label" >GIFT MESSAGE DETAILS</label>
									</div>
									<div class="col-sm-6">
										<div  class="form-group">
									  		<label class="control-label" >FIRST NAME* (This will print on the coffee bag labels)</label>
											<input type="text" class="form-control form_fname_1" name="form_1_fname" value="">
											<span class="form_fnameerror_1"></span>
										</div>
										<div  class="form-group">
									  		<label class="control-label" >LAST NAME*</label>
											<input type="text" class="form-control form_lname_1"  name="form_1_lname">
											<span class="form_lnameerror_1"></span>
										</div>
										<div  class="form-group">
									  		<label class="control-label" >ADDRESS LINE 1*</label>
											<input type="text" class="form-control form_address_1 empty_for_country_ch"  name="form_address_1">
											<span class="form_addresserror_1"></span>
										</div>
										<div  class="form-group">
									  		<label class="control-label" >ADDRESS LINE 2</label>
											<input type="text" class="form-control form_address2_1"  name="form_address2_1">
											<span class="form_address2error_1"></span>
										</div>
										<div  class="form-group">
									  		<label class="control-label" >CITY*</label>
											<input type="text" class="form-control form_city_1 empty_for_country_ch"  name="form_city_1">
											<span class="form_cityerror_1"></span>
										</div>
										<div  class="form-group statehideshow">
									  		<label class="control-label" >STATE*</label>
											<select name="form_state_1" class="form-control form_state_1 statebycountry" >
											</select>
											<span class="form_stateerror_1"></span>
										</div>
										<div  class="form-group">
									  		<label class="control-label" >POST CODE*</label>
											<input type="text" class="form-control form_zip_1 empty_for_country_ch"   name="form_zip_1">
											<span class="form_ziperror_1"></span>
										</div>
										<div  class="form-group">
									  		<label class="control-label" ><input type="checkbox"   name="form_des_type_1" class="form_des_type_1" >This address is a P.O. Box</label>
											<span class="form_des_typeerror_1"></span>
										</div>
										<div  class="form-group selectedcountry">
										</div>
										<a href="javascript:void(0);" class="tablink" data-tabid="COFFEE" >Change Country</a>
									</div>
									<div class="col-sm-6">
									  	<div class="form-group">
											<label class="control-label" >GIFTED BY*</label>
											<input type="text" class="form-control form_gifted_by_1"   name="form_gifted_by_1">
											<span class="form_gifted_byerror_1"></span>
										</div>
										<div class="form-group">
											<label class="control-label" >GIFTED BY*</label>
											<textarea name="form_gift_msg_1" class="form-control form_gift_msg_1" maxlength="255" rows="6" autocomplete="off"></textarea>
											Remaining: 255 characters <br>
											<span class="form_gift_msgerror_1"></span>
										</div>
										<div class="form-group">
											<label class="control-label" ><input type="checkbox" class="form_non_branded_mailer" name="form_non_branded_mailer_1" value="<?php echo get_option('GS_non_branded_mailer_shipping_amount'); ?>" >Ship first delivery in non-branded mailer +$ <?php echo get_option('GS_non_branded_mailer_shipping_amount').".00"; ?></label>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingTwo">
						<h4 class="panel-title">
						  <label>
						  	<input type="radio" name="xzy" class="chooseform chooseform_2" data-formid="2" value="2">
							Send the first box to me (so I can gift in person)
						  </label>	
						</h4>
					</div>
					<div class="firsthidefrom form2">
						<div class="panel-body">
							 <div class="col-md-12">
								<form class="form-horizontal" action="/action_page.php">
									<div class="form-group  col-sm-6">
										<label class="control-label" >RECIPIENT DETAILS</label>
									</div>
									<div class="form-group  col-sm-6">
										<label class="control-label" >GIFT MESSAGE DETAILS</label>
									</div>
									<div class="col-sm-6">
										<div  class="form-group">
									  		<label class="control-label" >FIRST NAME* (This will print on the coffee bag labels)</label>
											<input type="text" class="form-control form_fname_2" name="form_fname_2" value="">
											<span class="form_fnameerror_2"></span>
										</div>
										<div  class="form-group">
									  		<label class="control-label" >LAST NAME*</label>
											<input type="text" class="form-control form_lname_2"   name="form_lname_2">
											<span class="form_lnameerror_2"></span>
										</div>
										<div  class="form-group">
									  		<label class="control-label" >ADDRESS LINE 1*</label>
											<input type="text" class="form-control form_address_2"   name="form_address_2">
											<span class="form_addresserror_2"></span>
										</div>
										<div  class="form-group">
									  		<label class="control-label" >ADDRESS LINE 2</label>
											<input type="text" class="form-control form_address2_2"   name="form_address2_2">
											<span class="form_address2error_2"></span>
										</div>
										<div  class="form-group">
									  		<label class="control-label" >CITY*</label>
											<input type="text" class="form-control form_city_2"   name="form_city_2">
											<span class="form_cityerror_2"></span>
										</div>
										<div  class="form-group statehideshow">
									  		<label class="control-label" >STATE*</label>
											<select name="form_state_2" class="form-control form_state_2 statebycountry">
											</select>
											<span class="form_stateerror_2"></span>
										</div>
										<div  class="form-group">
									  		<label class="control-label" >POST CODE*</label>
											<input type="text" class="form-control form_zip_2"   name="form_zip_2">
											<span class="form_ziperror_2"></span>
										</div>
										<div  class="form-group">
									  		<label class="control-label" ><input type="checkbox"   name="form_des_type_2" class="form_des_type_2" >This address is a P.O. Box</label>
											<span class="form_des_typeerror_2"></span>
										</div>
										<div  class="form-group selectedcountry" >
										</div>
										<a href="javascript:void(0);" class="tablink" data-tabid="COFFEE" >COFFEE</a>
									</div>
									<div class="col-sm-6">
									  	<div class="form-group">
											<label class="control-label" >GIFTED BY*</label>
											<input type="text" class="form-control form_gifted_by_2"   name="form_gifted_by_2">
											<span class="form_gifted_byerror_2"></span>
										</div>
										<div class="form-group">
											<label class="control-label" >GIFTED BY*</label>
											<textarea name="form_gift_msg_2" class="form-control form_gift_msg_2" maxlength="255" rows="6" autocomplete="off"></textarea>
											Remaining: 255 characters <br>
											<span class="form_gift_msgerror_2"></span>
										</div>
										<div class="form-group">
											<label class="control-label" ><input type="checkbox" class="form_non_branded_mailer" name="form_non_branded_mailer_2" value="<?php echo get_option('GS_non_branded_mailer_shipping_amount'); ?>" >Ship first delivery in non-branded mailer +$ <?php echo get_option('GS_non_branded_mailer_shipping_amount').".00"; ?></label>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default panelform3">
					<div class="panel-heading" role="tab" id="headingThree">
						<h4 class="panel-title">
							<input type="radio" name="xzy" class="chooseform chooseform_3" data-formid="3">
							Send an e-gift card
						</h4>
					</div>
					<div class="firsthidefrom form3">
						<div class="panel-body">
							<div class="col-md-12">
								<form class="form-horizontal" action="/action_page.php">
									<div class="form-group  col-sm-6">
										<label class="control-label" ><input type="radio" class="chooseform3_1" checked data-formid="3" value="3_1"  name="form_3_you_fname">Send to my email address</label>
										<label class="control-label" ><input type="radio" class="chooseform3_1" data-formid="3" value="3_2" name="form_3_you_fname">Send to recipient's email address</label>
									</div>
									<div class="form-group  col-sm-6">
										<label class="control-label" >YOUR DETAILS</label>
									</div>
									<div class="form-group  col-sm-6">
										<label class="control-label" >GIFT RECIPIENT'S DETAILS</label>
									</div>
									<div class="col-sm-6">
										<div  class="form-group">
									  		<label class="control-label" >FIRST NAME*</label>
											<input type="text" class="form-control form_fname_3"   name="form_fname_3">
											<span class="form_fnameerror_3"></span>
										</div>
										<div  class="form-group">
									  		<label class="control-label" >LAST NAME*</label>
											<input type="text" class="form-control form_lname_3"   name="form_lname_3">
											<span class="form_lnameerror_3"></span>
										</div>
										<div  class="form-group">
									  		<label class="control-label" >EMAIL ADDRESS*</label>
											<input type="text" class="form-control form_you_email_3"   name="form_you_email_3">
											<span class="form_you_emailerror_3"></span>
										</div>
									</div>
									<div class="col-sm-6">
									  	<div  class="form-group">
									  		<label class="control-label" >FIRST NAME*</label>
											<input type="text" class="form-control form_rec_fname_3"   name="form_rec_fname_3">
											<span class="form_rec_fnameerror_3"></span>
										</div>
										<div  class="form-group">
									  		<label class="control-label" >LAST NAME*</label>
											<input type="text" class="form-control form_rec_lname_3"   name="form_rec_lname_3">
											<span class="form_rec_lnameerror_3"></span>
										</div>
										<div  class="form-group rec_email"  style="display:none;">
									  		<label class="control-label" >EMAIL ADDRESS*</label>
											<input type="text" class="form-control cond_email_address "   name="form_rec_email_3">
											<span class="form_rec_emailerror_3"></span>
										</div>
										<div class="form-group">
											<label class="control-label" >GIFT MESSAGE*</label>
											<textarea name="form_gift_msg_3" class="form-control form_gift_msg_3" maxlength="255" rows="6" autocomplete="off"></textarea>
											Remaining: 255 characters <br>
											<span class="form_gift_msgerror_3  msgerror_3"></span>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div><!-- panel-group -->
	</div>
	<div class="tabs tabcontent_TIMING">
	<div class="us_class_show_hide">
	<?php
		$zone_id='1'; /* by us country methods show */
		foreach($delivery_zones[$zone_id]['shipping_methods'] as $sm_obj ) 
		{
			$method_id   = $sm_obj->id;
			$instance_id = $sm_obj->get_instance_id();
			$instance_settings = $sm_obj->instance_settings;
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
			<label class="<?php if(get_option( 'us_shipping_mehtod_first' )==$us_shipping_mehtodid) { echo 'active_method'; $selected_shipping_assign =  $instance_settings['shipping_assign'];	} ?>   world_coffee_sampler_<?php echo $instance_settings['shipping_assign']; ?>" <?php if(!empty(get_option( 'us_shipping_mehtod_disable' ))) { if(in_array($us_shipping_mehtodid,get_option( 'us_shipping_mehtod_disable' ))) { echo 'style="display:none;"'; } } ?> >

				<input type="radio" class="select_shipping_method not_cheked_<?php echo $instance_settings['shipping_assign']; ?> world_coffee_sampler_<?php echo $instance_settings['shipping_assign']; ?>"  data-uscostofmethod="<?php echo $instance_settings['class_cost_85']; ?>"   data-uscostofmethod1="<?php echo $instance_settings['class_cost_85']; ?>" <?php if(get_option( 'us_shipping_mehtod_first' )==$us_shipping_mehtodid) {   echo 'checked';	} ?> name="us_shipping_mehtod" value="<?php echo $instance_settings['shipping_assign']; ?>"><?php echo $data[$zone_id]['shipping_methods'][$instance_id]['custom_name']; ?><br> <?php echo $instance_settings['shipping_msg']; ?><br>
				<p  class='p_<?php echo $instance_settings['shipping_assign']; ?>' style="display:none;" >FREE</p>
				<span class='span_<?php echo $instance_settings['shipping_assign']; ?>'>
					<?php 
						if($data[$zone_id]['shipping_methods'][$instance_id]['$method_id']=='free_shipping') {
							echo 'FREE'; 
						} else {	
							echo "+ $ ".$instance_settings['class_cost_85']; 
						} 
					?>
				</span>		
			</label> &nbsp;&nbsp;
			<?php
		}
	?>
	</div>
	<br><br><br>
	<div class="datepicker"></div>
	</div>
	<div class="tabs tabcontent_REVIEW">
		<h3>About</h3>
		<p>Who we are and what we do.</p>
	</div>
	</div>
	<div class="col-sm-2">
		<div class="coffeedetail">
			<select name="calc_shipping_country" class="from-control mycountryclass">
				<option value="" disabled="disabled"><?php _e( 'Select a country&hellip;', 'woocommerce' ); ?></option><?php  $count = '1';   foreach ( (array) $delivery_zones as $key => $the_zone ) {   ?>
				<option  <?php if($count=='1') { echo 'selected'; } ?> value="<?php  echo $delivery_zones[$count]['zone_id']; ?>"><?php  echo $delivery_zones[$count]['formatted_zone_location']; ?></option>
				<?php ++$count;   }  ?>
			</select>
			<p class="hideshowpdata">The tasting kit is the first delivery. So for e.g., a monthly 3 month subscription has 1 tasting kit and 2 deliveries after.</p>
		</div>
		<div class="geardetail"  style="display:none;">
		 	<p>We have carefully selected this coffee gear from thousands of options based on our own testing. Each and every one of these also come highly recommended by leading review websites.</p><br>
			<p>The gear comes with the tasting kit in one box perfect for gifting.</p>
		</div>
		<div class="deliverydetail"  style="display:none;">
		 	<p> All options come with a printable gift card.</p>
		</div>
		<div class="form1 firsthidefrom" style="display:none;" >
			<p>The first delivery will include instructions & a voucher code for the recipient to set up their account and the rest of their deliveries.</p>
			<p>The second delivery will not be shipped until the gift recipient sets up their Driftaway account.</p>
		</div>
		<div class="form2 firsthidefrom" style="display:none;" >
			<p>The first delivery will include instructions & a voucher code for the recipient to set up their account and the address for the rest of their deliveries.</p>
			<p>The second delivery will not be shipped until the gift recipient sets up their Driftaway account.</p>
		</div>
		<div class="form3 firsthidefrom" style="display:none;" >
			<p>View sample gift card here.</p>
			<p>The email will include instructions for the recipient to start their gift subscription.</p>
		</div>
		<div class="timingdetail"  style="display:none;">
			<p>The gift recipient can choose the timing for their 2nd and subsequent deliveries when they set up their account.</p>
 			<p>Get it in time for the holidays! View order deadlines</p>
		</div>
	</div>
</form>	
</div>
<div>
	
<br><br><br>
SUBTOTAL <span class="showzonevariationtotal" id="showzonevariation"></span>
&nbsp;&nbsp;&nbsp; <span id="showzonevariationtotal">Free shipping available</span>
</div>
<script>
    var checkedvariation = <?php echo $checkedvariation ?>;
	var productallduration = <?php echo json_encode($durationslug) ?>;
    var productallfrequency = <?php echo json_encode($frequencyslug) ?>;
	var shipping_term_id = <?php echo $shipping_term_id ?>;
	var productid = <?php echo $productid ?>;
	var customurl = "<?php echo get_template_directory_uri().'/autoselectedcountry.php' ?>";
	var express_priority = "<?php echo get_option('express_priority') ?>";
	var gifthour = <?php echo $gift_sub_time[0] ?>;
	var giftmin = <?php echo $gift_sub_time[1] ?>;
	var intl_calendar = "<?php echo get_option('intl_calendar') ?>";
	var shipping_assigns = "<?php echo $selected_shipping_assign ?>";
	var us_free_shipping_cal = "<?php echo get_option('us_free_shipping_cal') ?>";
	var disable_tasting_kit_cal = "<?php echo get_option('disable_tasting_kit_cal') ?>";
	var ground_grind_dates = "<?php echo get_option('ground_grind_dates') ?>";
</script>	
<?php  get_footer(); ?>