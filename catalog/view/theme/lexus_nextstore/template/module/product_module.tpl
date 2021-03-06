<?php 
	$cols = 4;
	$span = 12/$cols;

	$themeConfig  	 			= (array)$this->config->get('themecontrol');
	$categoryConfig  			= array( 		
		'category_pzoom' 		=> 1,
		'show_swap_image' 		=> 0,
		'quickview' 			=> 0,
	); 
	$categoryConfig  			= array_merge($categoryConfig, $themeConfig );
	$categoryPzoom 	    		= $categoryConfig['category_pzoom'];
	$quickview 					= $categoryConfig['quickview'];
	$swapimg 					= ($categoryConfig['show_swap_image'])?'swap':'';
?>

<div class="box-heading">
	<span><?php echo $heading_title; ?></span>
	<em class="shapes right"></em>	
	<em class="line"></em>
</div>  

<div class="box-content">		
	<?php foreach ($products as $i => $product) { $i=$i+1; ?>
	<?php if( $i%$cols == 1 && $cols > 1 ) { ?>
	<div class="row product-items">
		<?php } ?> 
		<div class="col-lg-<?php echo $span;?> col-md-<?php echo $span;?> col-sm-<?php echo $span;?> product-cols">
			<div class="product-block">
				<?php if ($product['thumb']) { ?>
					
					<?php $product_images = $this->model_catalog_product->getProductImages( $product['product_id'] ); ?>
					<div class="image <?php echo isset($product_images[0])?$swapimg:''; ?>">
						<?php if( $product['is_newarrival'] &&  $product['is_newarrival']  != 0) {   ?>	
							<span class="product-label product-label-newarrival">
								<span>&nbsp;</span>  								
							</span>							
						<?php } ?>
						<?php if( $product['special'] ) {   ?>	
							<span class="product-label product-label-special">
								<span><?php echo $this->language->get( 'text_sale' ); ?></span>  								
							</span>							
						<?php } ?>

						<?php if( $categoryPzoom ) { $zimage = str_replace( "cache/","", preg_replace("#-\d+x\d+#", "",  $product['thumb'] ));  ?>
							<a href="<?php echo $zimage;?>" class="info-view colorbox product-zoom" rel="colorbox" title="<?php echo $product['name']; ?>"><i class="fa fa-search-plus"></i></a>
						<?php } ?>

						<!-- Swap image -->
						<div class="flip">
							<a href="<?php echo $product['href']; ?>" class="swap-image">
								<img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" class="front" />
								<?php 
								if( $categoryConfig['show_swap_image'] ){
									$product_images = $this->model_catalog_product->getProductImages( $product['product_id'] );
									if(isset($product_images) && !empty($product_images)) {
										$thumb2 = $this->model_tool_image->resize($product_images[0]['image'],  $this->config->get('config_image_product_width'),  $this->config->get('config_image_product_height') );
									?>	
									<img src="<?php echo $thumb2; ?>" alt="<?php echo $product['name']; ?>" class="back" />
								<?php } } ?>								
							</a>
						</div>

						<?php //#2 Start fix quickview in fw?>
							<?php if ($quickview) { ?>
								<a class="pav-colorbox btn btn-theme-default" href="<?php echo $this->url->link("themecontrol/product",'product_id='.$product['product_id'] );?>"><em class="fa fa-plus"></em><span><?php echo $this->language->get('quick_view'); ?></span></a>
							<?php } ?>
						<?php //#2 End fix quickview in fw?>

					</div>
				<?php } ?>
				
				<div class="product-meta">
					<div class="left">
						<h3 class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h3>
						<?php if ($product['price']) { ?>
						<div class="price">
							<?php if (!$product['special']) { ?>
							<?php echo $product['price']; ?>
							<?php } else { ?>
							<span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>  <?php  	 
                 $scd= $product['price'];
                 $scd = preg_replace('/\D/', '', $scd);
                 $scd1 = $product['special'];
                 $scd1 = preg_replace('/\D/', '', $scd1);
                 $sum_total =   round((($scd  - $scd1)/$scd)*100, 0);
                                ?>

<span style=" font-size:12px;
    font-weight: 800;color:#e55e5e">[<?php echo $sum_total; ?>% <?php echo 'OFF'; ?>]</span>
           
							<?php } ?>
						</div>
						<?php } ?>
					</div>
					
					<div class="right">
						<div class="rating">
							<?php if ($product['rating']) { ?>							
								<img src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" />
							<?php } ?>
						</div>

						<?php if( isset($product['description']) ) { ?>
							<p class="description"><?php echo utf8_substr( strip_tags($product['description']),0,160);?>...</p>
						<?php } ?>

						<div class="action">
							<div class="cart">									
								<!-- <input type="button" value="&#xf07a;" onclick="addToCart('<?php //echo $product['product_id']; ?>');" class="product-icon fa fa-shopping-cart shopping-cart " /> -->
								<button onclick="addToCart('<?php echo $product['product_id']; ?>');" class="btn btn-shopping-cart">
									<span class="fa fa-shopping-cart product-icon hidden-sm hidden-md">&nbsp;</span>
									<span><?php echo $button_cart; ?></span>
								</button>										
							</div>
							<div class="button-group">
								<div class="wishlist"> 
									<a onclick="addToWishList('<?php echo $product['product_id']; ?>');" title="<?php echo $this->language->get("button_wishlist"); ?>" class="fa fa-heart product-icon">
										<?php //echo $this->language->get("button_wishlist"); ?>
									</a>
								</div>
								<div class="compare">
									<a onclick="addToCompare('<?php echo $product['product_id']; ?>');" title="<?php echo $this->language->get("button_compare"); ?>" class="fa fa-refresh product-icon">
										<?php //echo $this->language->get("button_compare"); ?>
									</a>
								</div>
							</div>
						</div>
					</div>																		
				</div>		
			</div>
		</div>		
		<?php if( ($i%$cols == 0 || $i==count($products) ) && $cols > 1 ) { ?>
	</div>
	<?php } ?>			
	<?php } ?>		
</div>	