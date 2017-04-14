<?php 
require_once( DIR_TEMPLATE.$this->config->get('config_template')."/development/libs/framework.php" );
$themeName =  $this->config->get('config_template');
$helper = ThemeControlHelper::getInstance( $this->registry, $themeName );

require( DIR_TEMPLATE.$this->config->get('config_template')."/template/common/config.tpl" ); 
$themeConfig = (array)$this->config->get('themecontrol');

$categoryConfig = array( 
	'listing_products_columns' 		     		=> 0,
	'listing_products_columns_small' 	     	=> 2,
	'listing_products_columns_minismall'    	=> 1,
	'cateogry_display_mode' 			     	=> 'grid',
	'category_pzoom'				          	=> 1,	
	'quickview'                                 => 0,
	'show_swap_image'                       	=> 0,
	); 

$categoryConfig  	= array_merge($categoryConfig, $themeConfig );
$DISPLAY_MODE 	 	= $categoryConfig['cateogry_display_mode'];
$MAX_ITEM_ROW 	 	= $themeConfig['listing_products_columns']?$themeConfig['listing_products_columns']:3; 
$MAX_ITEM_ROW_SMALL = $categoryConfig['listing_products_columns_small']?$categoryConfig['listing_products_columns_small']:2;
$MAX_ITEM_ROW_MINI  = $categoryConfig['listing_products_columns_minismall']?$categoryConfig['listing_products_columns_minismall']:2; 
$categoryPzoom 	    = $categoryConfig['category_pzoom']; 
$quickview          = $categoryConfig['quickview'];
$swapimg            = ($categoryConfig['show_swap_image'])?'swap':'';

?>


<?php echo $header; ?>
<?php require( DIR_TEMPLATE.$this->config->get('config_template')."/template/common/breadcrumb.tpl" );  ?>
<div class="container">
	<div class="row"> 
		<section class="col-md-12">
			<?php if ($thumb || $description) { ?>
				<div class="category-info clearfix hidden-xs hidden-sm">
					<?php if ($thumb) { ?>
					<div class="image"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" class="img-responsive" /></div>
					<?php } ?>
					<?php if ($description) { ?>
					<div class="category-description wrapper">
						<?php echo $description; ?>
					</div>
					<?php } ?>
				</div>
			<?php } ?>
		</section>
		 <?php if ($products) { ?>
		<?php if( $SPAN[0] ): ?>

			<aside class="col-md-<?php echo $SPAN[0];?>">
				<?php echo $column_left; ?>
			</aside>	
		<?php endif; ?> 
		<?php } if(!$products) { ?>
		<section class="col-md-<?php echo $SPAN[0]+$SPAN[1];?>">
		<?php } else{ ?>
		<section class="col-md-<?php echo $SPAN[1];?>">
		<?php } ?>		
			<div id="content">
				<?php echo $content_top; ?>
				<div class="heading-cont clearfix">
					<h1><?php echo $heading_title;?></h1>

					<!--------------Added content by Elakkiya-------------->
					<?php require( DIR_TEMPLATE.$this->config->get('config_template')."/template/product/product_filter.tpl" );  ?>    
					
				</div>
				 
				<?php
				/**
				 * product category
				 * $ospans allow overrides width of columns base on thiers indexs. format array( 1=> 3 )[value from 1->12]
				 */
				$modules = $helper->getModulesByPosition( 'call_by_category' ); 
				$ospans = array();

				if( count($modules) ){
					$cols = 2;	
					$class = $helper->calculateSpans( $ospans, $cols );

					$j=1;
					foreach ($modules as $i =>  $module) {
						if( $i++%$cols == 0 || count($modules)==1 ){  $j=1;?><div class="row"><?php } ?>

						<div class="<?php echo $class[$j];?>"><?php echo $module; ?></div>

						<?php if( $i%$cols == 0 || $i==count($modules) ){ ?></div><?php } ?>	
						<?php  $j++;  } ?>
						<?php } ?>	


						<?php if ($categories) { ?>
						<div class="panel panel-default refine-search clearfix box white">
							<div class="panel-heading box-heading">
								<span><?php echo $text_refine; ?></span>
								<em class="shapes right"></em>	
								<em class="line"></em>
							</div>
							<div class="panel-body category-list clearfix box-content">
								<?php if (count($categories) <= 5) { ?>
								<ul>
									<?php foreach ($categories as $category) { ?>
									<li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
									<?php } ?>
								</ul>
								<?php } else { ?>
								<?php for ($i = 0; $i < count($categories);) { ?>
								<ul>
									<?php $j = $i + ceil(count($categories) / 4); ?>
									<?php for (; $i < $j; $i++) { ?>
									<?php if (isset($categories[$i])) { ?>
									<li><a href="<?php echo $categories[$i]['href']; ?>"><?php echo $categories[$i]['name']; ?></a></li>
									<?php } ?>
									<?php } ?>
								</ul>
								<?php } ?>
								<?php } ?>
							</div>
						</div>
						<?php } ?>


						<?php if ($products) { ?>
						<?php require( DIR_TEMPLATE.$this->config->get('config_template')."/template/product/product_collection.tpl" );  ?>
						<?php } ?>					

						<?php if (!$categories && !$products) { ?>
						<div class="content"><div class="wrapper"><?php echo $text_empty; ?></div></div>
						<div class="buttons">
							<div class="right"><a href="<?php echo $continue; ?>" class="button btn btn-theme-default"><?php echo $button_continue; ?></a></div>
						</div>
						<?php } 
						else if($categories && !$products)
						{ ?>
							<div class="content"><div class="wrapper"><?php echo $text_empty; ?></div></div>
						<div class="buttons">
							<div class="right"><a href="<?php echo $continue; ?>" class="button btn btn-theme-default"><?php echo $button_continue; ?></a></div>
						</div>
						<?php }
						?>

						<?php echo $content_bottom; ?></div>



	<script type="text/javascript">
		<!--
		function display(view) {
			if (view == 'list') {
				$('.product-grid').attr('class', 'product-list');

				$('.products-block  .product-block').each(function(index, element) {

					$(element).parent().addClass("col-fullwidth");
				});		

				$('.display').html('<span class="new_asearch_fl"><?php echo $text_display; ?></span><a class="list active"><i class="fa fa-th-list"></i><em><?php echo $text_list; ?></em></a><a class="grid" onclick="display(\'grid\');"><i class="fa fa-th"></i><em><?php echo $text_grid; ?></em></a>');

				$.totalStorage('display', 'list'); 
			} else {
				$('.product-list').attr('class', 'product-grid');

				$('.products-block  .product-block').each(function(index, element) {
					$(element).parent().removeClass("col-fullwidth");  
				});	

				$('.display').html('<span class="new_asearch_fl"><?php echo $text_display; ?></span><a class="list" onclick="display(\'list\');"><i class="fa fa-th-list"></i><em><?php echo $text_list; ?></em></a><a class="grid active"><i class="fa fa-th"></i><em><?php echo $text_grid; ?></em></a>');

				$.totalStorage('display', 'grid');
			}
		}

		view = $.totalStorage('display');

		if (view) {
			display(view);
		} else {
			display('<?php echo $DISPLAY_MODE;?>');
		}
	//-->
	</script> 

</section> 


<?php if( $SPAN[2] ): ?>
	<aside class="col-md-<?php echo $SPAN[2];?>">	
		<?php echo $column_right; ?>
	</aside>
<?php endif; ?>

</div></div>	



<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick="closemodal();" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">EMAIL NOTIFICATION</h4>
      </div>
      <div class="modal-body">
      <div class="new_asearch_mb" ><p> Notify me when the product is back in Stock!</p></div>

       	<form class="form-horizontal">
       	<input type="hidden" id="npro_id" name="npro_id">
       	<input type="hidden" id="pro_name" name="pro_name">
       		<input type="hidden" id="pro_href" name="pro_href">
       	<div class="form-group">
		    <label for="inputPassword3" class="col-sm-4 control-label">Product Name</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control new_asearch_fw" id="Nproductname" placeholder="Product Name" disabled="disabled">
		    </div>
		  </div>

		     <div class="form-group" id="respcontent">
		  
		  </div> 

		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-4 control-label">Email<span class="mand_field">*</span></label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" id="Nemail" placeholder="Required">
		    </div>
		  </div>
		 <!-- <div class="form-group">
		    <label for="inputPassword3" class="col-sm-4 control-label">Name<span class="mand_field">*</span></label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" id="Nname" placeholder="Name">
		    </div>
		  </div> -->

		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-4 control-label">Mobile Number</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" id="Nmobileno" placeholder="Optional">
		    </div>
		  </div>

		 <!-- <div class="form-group">
		    <label for="inputPassword3" class="col-sm-4 control-label">Comments</label>
		    <div class="col-sm-6">
		      <textarea class="form-control" id="NComments" placeholder="Comments"></textarea>
		    </div>
		  </div> -->

		</form>
      </div>
      <div class="modal-footer new_asearch_padd">
      <span class="alert alert-success new_asearch_padd1" id="success_msgaa">send successfully</span>
      <span class="alert alert-danger new_asearch_padd1" id="failure_msg">sending failed</span>
      	<img src="<?php echo CurrentHost; ?>/image/loading_spinner.gif" alt="loading..." id="image_spinner">
        <button type="button" class="btn btn-default" id="closebtn" onclick="closemodal();">Close</button>
        <button type="button" class="btn btn-primary" id="sendbtn" onclick="sendnotify();">Send</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript"> 
 
var google_tag_params = { 
<?php if(count($products)>1) { ?>
ecomm_prodid: [<?php $idsval='';$count=count($products); $j=1;

  foreach ($products as $i => $product) { 
  	
  	if($j<$count)
  		{$comma=",";}else{$comma="";} 
  	
  	$idsval.='"'.$product["product_id"].'"'.$comma;
  	$j++;
  	 }   
  	 echo $idsval; ?>], 
  	 <?php } else { ?>
  	 ecomm_prodid: <?php $idsval='';$count=count($products); $j=1;

  foreach ($products as $i => $product) { 
  	$idsval.='"'.$product["product_id"].'"';
  	$j++;
  	 }    
  	if($idsval) {echo $idsval;} else echo '""'; ?>, 	
  	 	<?php }?>
  	 	
ecomm_pagetype: "category",   	 	
ecomm_category: "Category > <?php  $actual_link ="$_SERVER[REQUEST_URI]";

					$subval=strstr($actual_link,'/'); 
					
					$subval1=str_replace('/',' > ',$subval);
					
					$subvaln=strstr($subval1,'?');
					$subval3=str_replace($subvaln,'',$subval1);
					$subval2=str_replace('/',' > ',$subval3);   
					echo trim($subval2,"> ");  
					 ?>",  
<?php if(count($products)>1) { ?>			  
ecomm_totalvalue: [<?php $count=count($products); $j=1;$priceval='';
  foreach ($products as $i => $product) { 
  	
  	if($j<$count)
  		{$comma=",";}else{$comma="";} 
  	if (!$product['special']) {$finalprice=$product['price'];}else{$finalprice=$product['special'];}
  	$finalprice=str_replace(",","",$finalprice); 
  	$orgprice=str_replace("<span class='WebRupee'>Rs</span>","",$finalprice);
   	$priceval.=number_format($orgprice,2, '.', '').$comma;   
  	$j++;  
  	 }     
  	 echo $priceval; ?>], 
<?php } else { ?>
	ecomm_totalvalue: <?php $count=count($products); $j=1;$priceval='';
  foreach ($products as $i => $product) {   	
  	
  	if (!$product['special']) {$finalprice=$product['price'];}else{$finalprice=$product['special'];}
  	$finalprice=str_replace(",","",$finalprice); 
  	$orgprice=str_replace("<span class='WebRupee'>Rs</span>","",$finalprice);
   	$priceval.=number_format($orgprice,2, '.', '');   
  	$j++;  
  	 }     
  	
  	 if($priceval) {echo $priceval;} else echo '""'; ?>, 
<?php } ?>  
};
</script>
<?php echo $footer; ?>