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
?>
<div class="container">
<form id="myForm">
<div class="col-sm-10 borderright">
	<div>
		<a href="javascript:void(0);" class="tablink" onclick="openPage('COFFEE', this, '#db4105')"  id="defaultOpen">COFFEE</a>
		<a href="javascript:void(0);" class="tablink gearclass" onclick="openPage('GEAR', this, '#db4105')">GEAR</a>
		<a href="javascript:void(0);" class="tablink" onclick="openPage('DELIVERY', this, '#db4105')">DELIVERY</a>
		<a href="javascript:void(0);" class="tablink" onclick="openPage('TIMING', this, '#db4105')">TIMING</a>
		<a href="javascript:void(0);" class="tablink" onclick="openPage('REVIEW', this, '#db4105')">REVIEW</a>
	</div>
	<div id="COFFEE" class="tabcontent">
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
							<input type="radio" <?php if($tax_term->slug=='whole-bean') { echo "checked"; } ?> name="grind_type" value="<?php echo $tax_term->slug; ?>"><?php echo $tax_term->name; ?>	
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
	<div id="GEAR" class="tabcontent">
		<ul>
			<li class="active"><a href="javascript:void(0);">All</a></li>
			<?php	$sub_cats_args = array(
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
						echo '<li><a href="javascript:void(0);">'.$sub_category->name.'</a></li>';
					}   
				}
			?>	
		</ul>
	   <?php 	$productargs = array( 'post_type' => 'product',  'product_cat' => 'addons',  'orderby' => 'rand' );
        		$productloop = new WP_Query( $productargs );
				while ( $productloop->have_posts() ) : $productloop->the_post(); global $product; 
					if ( $product->is_in_stock() ) 
					{
						?>
						<div class="col-sm-4">
							<a href="<?php echo get_permalink( $productloop->post->ID ) ?>" title="<?php echo esc_attr($productloop->post->post_title ? $productloop->post->post_title : $productloop->post->ID); ?>">
								<?php woocommerce_show_product_sale_flash( $post, $product ); ?>
								<?php if (has_post_thumbnail( $productloop->post->ID )) echo get_the_post_thumbnail($productloop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />'; ?>
								<h3><?php the_title(); ?></h3>
								<span class="price"><?php echo $product->get_price_html(); ?></span>                    
							</a>
						</div>	
						<?php 
					}
				endwhile;	?>
	</div>
	<div id="DELIVERY" class="tabcontent">
	  <h3>Contact</h3>
	  <p>Get in touch, or swing by for a cup of coffee.</p>
	</div>
	<div id="TIMING" class="tabcontent">
	  <h3>About</h3>
	  <p>Who we are and what we do.</p>
	</div>
	<div id="REVIEW" class="tabcontent">
	  <h3>About</h3>
	  <p>Who we are and what we do.</p>
	</div>	
	
	</div>
	<div class="col-sm-2">
		<div>
			<select name="calc_shipping_country" class="from-control mycountryclass">
				<option value="" disabled="disabled"><?php _e( 'Select a country&hellip;', 'woocommerce' ); ?></option><?php  $count = '1';   foreach ( (array) $delivery_zones as $key => $the_zone ) {   ?>
				<option  <?php if($count=='1') { echo 'selected'; } ?> value="<?php  echo $delivery_zones[$count]['zone_id']; ?>"><?php  echo $delivery_zones[$count]['formatted_zone_location']; ?></option>
				<?php ++$count;   }  ?>
			</select>
			<p class="hideshowpdata">The tasting kit is the first delivery. So for e.g., a monthly 3 month subscription has 1 tasting kit and 2 deliveries after.</p>
		</div>
	</div>
</form>	
</div>
SUBTOTAL <span class="showzonevariationtotal" id="showzonevariation"></span>
&nbsp;&nbsp;&nbsp; <span id="showzonevariationtotal">Free shipping available</span>
<script>
    var checkedvariation = <?php echo $checkedvariation ?>;
	var productallduration = <?php echo json_encode($durationslug) ?>;
    var productallfrequency = <?php echo json_encode($frequencyslug) ?>;
	var shipping_term_id = <?php echo $shipping_term_id ?>;
	var productid = <?php echo $productid ?>;
	var customurl = "<?php echo get_template_directory_uri().'/autoselectedcountry.php' ?>";
</script>	
<?php	
	get_footer();
?>