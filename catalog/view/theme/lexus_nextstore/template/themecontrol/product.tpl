<?php require( DIR_TEMPLATE.$this->config->get('config_template')."/template/common/config.tpl" );

  $themeConfig = (array)$this->config->get('themecontrol');
  $productConfig = array(
      'product_enablezoom'         => 1,
      'product_zoommode'           => 'basic',
      'product_zoomeasing'         => 1,
      'product_zoomlensshape'      => "round",
      'product_zoomlenssize'       => "150",
      'product_zoomgallery'        => 0,
      'enable_product_customtab'   => 0,
      'product_customtab_name'     => '',
      'product_customtab_content'  => '',
      'product_related_column'     => 0,

  );
  $categoryConfig = array(
	'category_pzoom'			   => 1,

  ); 
  $categoryPzoom 	    = $categoryConfig['category_pzoom']; 
  $productConfig 		= array_merge( $productConfig, $themeConfig );  
  $languageID 			= $this->config->get('config_language_id');   
?>

<?php 
/******************************************************
 * @package Pav Opencart Theme Framework for Opencart 1.5.x
 * @version 1.1
 * @author http://www.pavothemes.com
 * @copyright	Copyright (C) Augus 2013 PavoThemes.com <@emai:pavothemes@gmail.com>.All rights reserved.
 * @license		GNU General Public License version 2
*******************************************************/


$themeConfig = $this->config->get( 'themecontrol' );
$LANGUAGE_ID = $this->config->get( 'config_language_id' ); 
$themeName =  $this->config->get('config_template');
require_once( DIR_TEMPLATE.$this->config->get('config_template')."/development/libs/framework.php" );
$helper = ThemeControlHelper::getInstance( $this->registry, $themeName );
$helper->setDirection( $direction );
/* Add scripts files */
$helper->addScript( 'catalog/view/javascript/jquery/jquery-1.7.1.min.js' );
$helper->addScript( 'catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js' );
$helper->addScript( 'catalog/view/javascript/jquery/ui/external/jquery.cookie.js' );
$helper->addScript( 'catalog/view/javascript/common.js' );
$helper->addScript( 'catalog/view/theme/'.$themeName.'/javascript/common.js' );
$helper->addScript( 'catalog/view/javascript/jquery/bootstrap/bootstrap.min.js' );

$helper->addScriptList( $scripts );

$helper->addCss( 'catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css' );	
if( isset($themeConfig['customize_theme']) 
	&& file_exists(DIR_TEMPLATE.$themeName.'/stylesheet/customize/'.$themeConfig['customize_theme'].'.css') ) {  
	$helper->addCss( 'catalog/view/theme/'.$themeName.'/stylesheet/customize/'.$themeConfig['customize_theme'].'.css'  );
}

$helper->addCss( 'catalog/view/theme/javascript/webrupee_font.css' );
$helper->addCss( 'catalog/view/theme/'.$themeName.'/stylesheet/animation.css' );
$helper->addCss( 'catalog/view/theme/'.$themeName.'/stylesheet/font-awesome.min.css' );	
$helper->addCssList( $styles );

$layoutMode = $helper->getParam( 'layout' );

$pageClass =  $helper->getPageClass();
$vmegamenu = $helper->renderModule( 'module/pavverticalmenu' );
?>
<!DOCTYPE html>
<html dir="<?php echo $helper->getDirection(); ?>" class="<?php echo $helper->getDirection(); ?>" lang="<?php echo $lang; ?>">
<head>
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<!-- Mobile viewport optimized: h5bp.com/viewport -->
	<meta name="viewport" content="width=device-width">
	<meta charset="UTF-8" />
	<title><?php echo $title; ?></title>
	<base href="<?php echo $base; ?>" />
	<?php if ($description) { ?>
	<meta name="description" content="<?php echo $description; ?>" />
	<?php } ?>
	<?php if ($keywords) { ?>
	<meta name="keywords" content="<?php echo $keywords; ?>" />
	<?php } ?>
	<link rel="stylesheet" type="text/css" href="catalog/view/javascript/webrupee_font.css" />
	<?php if ($icon) { ?>
	<link href="<?php echo $icon; ?>" rel="icon" />
	<?php } ?>
	<?php foreach ($links as $link) { ?>
	<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
	<?php } ?>
	<?php foreach ($helper->getCssLinks() as $link) { ?>
	<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
	<?php } ?>

	<?php if( $themeConfig['theme_width'] &&  $themeConfig['theme_width'] != 'auto' ) { ?>
	<style> #page-container .container{max-width:<?php echo $themeConfig['theme_width'];?>; width:auto}</style>
	<?php } ?>

	<?php if( isset($themeConfig['use_custombg']) && $themeConfig['use_custombg'] ) {	?>
	<style> 
		body{
			background:url( "image/<?php echo $themeConfig['bg_image'];?>") <?php echo $themeConfig['bg_repeat'];?>  <?php echo $themeConfig['bg_position'];?> !important;
		}
	</style>
	<?php } ?>

	<style type="text/css">
	.outofstockcls {
    color: #F00 !important;
    font-weight: bold;
	}
	.WebRupee {
    font-family: 'WebRupee';
} 
</style>
	<?php 
		if( isset($themeConfig['enable_customfont']) && $themeConfig['enable_customfont'] ){
			$css=array();
			$link = array();
			for( $i=1; $i<=3; $i++ ){
				if( trim($themeConfig['google_url'.$i]) && $themeConfig['type_fonts'.$i] == 'google' ){
					$link[] = '<link rel="stylesheet" type="text/css" href="'.trim($themeConfig['google_url'.$i]) .'"/>';
					$themeConfig['normal_fonts'.$i] = $themeConfig['google_family'.$i];
				}
				if( trim($themeConfig['body_selector'.$i]) && trim($themeConfig['normal_fonts'.$i]) ){
					$css[]= trim($themeConfig['body_selector'.$i])." {font-family:".str_replace("'",'"',htmlspecialchars_decode(trim($themeConfig['normal_fonts'.$i])))."}\r\n"	;
				}
			}
			echo implode( "\r\n",$link );
			?>
			<style>
			<?php echo implode("\r\n",$css);?>
			</style>
			<?php } else { ?>			
			<link href='http://fonts.googleapis.com/css?family=Open+Sans:800italic,800,700italic,700,600italic,600,400italic,400,300italic,300' rel='stylesheet' type='text/css'>
			<?php } ?>
			<?php foreach ($styles as $style) { ?>
			<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
			<?php } ?>
			<?php foreach( $helper->getScriptFiles() as $script )  { ?>
			<script type="text/javascript" src="<?php echo $script; ?>"></script>
			<?php } ?>


			<?php if( isset($themeConfig['custom_javascript'])  && !empty($themeConfig['custom_javascript']) ){ ?>
			<script type="text/javascript"><!--
			$(document).ready(function() {
				<?php echo html_entity_decode(trim( $themeConfig['custom_javascript']) ); ?>
			});
			//--></script>
			<?php }	?>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->	
<!--[if lt IE 9]>
<?php if( isset($themeConfig['load_live_html5'])  && $themeConfig['load_live_html5'] ) { ?>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<?php } else { ?>
<script src="catalog/view/javascript/html5.js"></script>
<?php } ?>
<script src="catalog/view/javascript/respond.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $themeName;?>/stylesheet/ie8.css" />
<![endif]-->

<?php if ( isset($stores) && $stores ) { ?>
<script type="text/javascript"><!--
$(document).ready(function() {
	<?php foreach ($stores as $store) { ?>
		$('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
		<?php } ?>
	});
//--></script>
<?php } ?>
<?php echo $google_analytics; ?>

<script type="text/javascript">
function get_radio_value1(a,b) {
			
				var inputs = document.getElementsByName(b);
				for (var i = 0; i < inputs.length; i++) 
				{
	
					  if (inputs[i].checked) 
					  {

						// document.getElementById(inputs[i].value).style.border = "3px solid";   
					   }
					  else
					  { 
					  //document.getElementsByTagName("img").styleborder = "1px solid #ccc"; 
					  }
				}
				 //  document.getElementById("kdesc").innerHTML = "You Have Choosed <font color=#5c88cf style='font-size:20px'>"+ a + " </font>Size";
          }

        </script><script type="text/javascript">
$(function(){
    $("#big-image img:eq(0)").nextAll().hide();
    $(".small-images img").click(function(e){
        var $this = $(this),
            index = $this.index();
        $(".small-images img").removeClass('selected');
        $this.addClass('selected');
        $("#big-image img").eq(index).show().siblings().hide();
    });
});

</script>

<style>
.small-images a, .big-images a {display:inline-block}
.small-images .selected {border:4px solid #f47116 !important}
</style>

</head>
<body class="quickview">
	<!----------Dynamic Content start ---------->
		<div id="breadcrumb">
		<div style="width:100%; height:30px; position:fixed; right:5px !important;"><div style="float: left; bottom:5px !important;" id="cboxClose1">close</div></div>
		</div>
		<!----------Dynamic Content end ---------->
	<section id="page-quickview" role="main">
		<section id="sys-notification">
			<div class="container">
				<?php if ($error) { ?>
				<div class="warning"><?php echo $error ?><img src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/image/close.png" alt="" class="close" /></div>
				<?php } ?>
				<div id="notification"></div>
			<script type="text/javascript">
				$(document).ready(function() {
					$( "#notification" ).delegate( "a", "click", function() {
						window.parent.location = $(this).attr('href');
						return false;
					});
				});
			</script>
			</div>
		</section>
		<section id="columns">

		

<?php echo $header; $this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js'); ?>

<?php require( DIR_TEMPLATE.$this->config->get('config_template')."/template/common/breadcrumb.tpl" );  ?>
		<div class="container">
			<div class="row">

<section class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div id="content" class="product-detail">
		<?php echo $content_top; ?>		
			<div class="product-info">
				<div class="row">			
					<?php if ($thumb || $images) { ?>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 image-container">
						<div class="product-cont">
							<?php if( isset($date_available) && $date_available == date('Y-m-d')) {   ?>	    	
								<span class="product-label product-label-new">
									<span><?php echo $this->language->get( 'text_new' ); ?></span>	
								</span>												
							<?php } ?>	
							<?php if( $is_newarrival &&  $is_newarrival  != 0) {   ?>	
							<span class="product-label product-label-newarrival">
								<span>&nbsp;</span>  								
							</span>							
						<?php } ?>
						
							<?php if( $special )  { ?>          
								<span class="product-label product-label-special"><span><?php echo $saving; ?>%</span></span>
							<?php } ?>
					
							<?php if ($thumb) { ?>
							<div class="image">
								<a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" class="colorbox">
									<img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image"  data-zoom-image="<?php echo $popup; ?>" class="product-image-zoom img-responsive"/>
								</a>
							</div>
							<?php } ?>		
					
							<?php if ($images) { ?>
							<div class="image-additional slide carousel" id="image-additional">
								<div id="image-additional-carousel" class="carousel-inner">
									<?php 
									if( $productConfig['product_zoomgallery'] == 'slider' && $thumb ) {  
										$eimages = array( 0=> array( 'popup'=>$popup,'thumb'=> $thumb )  ); 
										$images = array_merge( $eimages, $images );
									}
									$icols = 4; $i= 0;
									foreach ($images as  $image) { ?>
										<?php if( (++$i)%$icols == 1 ) { ?>
										<div class="item clearfix">
										<?php } ?>
											<a href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>" class="colorbox" data-zoom-image="<?php echo $image['popup']; ?>" data-image="<?php echo $image['popup']; ?>">
												<img src="<?php echo $image['thumb']; ?>" style="max-width:<?php echo $this->config->get('config_image_additional_width');?>px"  title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" data-zoom-image="<?php echo $image['popup']; ?>" class="product-image-zoom img-responsive" />
											</a>
										<?php if( $i%$icols == 0 || $i==count($images) ) { ?>
										</div>
									  <?php } ?>
									<?php } ?>		
								</div>

								<!-- Controls -->
								<a class="left carousel-control" href="#image-additional" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								</a>
								<a class="right carousel-control" href="#image-additional" data-slide="next">							
									<i class="fa fa-angle-right"></i>
								</a>

							</div>			
							<script type="text/javascript">
								$('#image-additional .item:first').addClass('active');
								$('#image-additional').carousel({interval:false})
						</script>
						<?php } ?>     
					</div>		
					</div>
					<?php } ?>
			
		
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 product-view">				
						<h1><?php echo $heading_title; ?></h1>	

						<?php if ($review_status) { ?>
						<div class="review" style="margin-bottom:5px!important">
							<div><img src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/image/stars-<?php echo $rating; ?>.png" alt="<?php echo $reviews; ?>" />&nbsp;&nbsp;<a onclick="$('a[href=\'#tab-review\']').trigger('click');"><?php echo $reviews; ?></a>&nbsp;&nbsp;</div>
						</div>
						<?php } ?>

						<div class="description">
							<?php if ($manufacturer) { ?>
								 
									<b><?php echo $text_manufacturer; ?></b>
									<a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a>&nbsp;|&nbsp;								
								 	
							<?php } ?>
							 
								<b><?php echo $text_model; ?></b>
								<?php echo $model; ?> &nbsp;
							 
							<?php if ($reward) { ?>
								 
									<b><?php echo $text_reward; ?></b>
									<?php echo $reward; ?> &nbsp;	
								 
							<?php } ?>						
							 	
						</div>
								
			 		
						<?php if ($price) { ?>
						<div class="price" style="padding:0px!important">
							<div class="price-gruop">

								<?php if (!$special) { ?>
									<?php echo $price; ?>
								<?php } else { ?>
								<span class="price-old"><?php echo $price; ?></span>&nbsp;
								<span class="income" style="font-size:20px;">(<?php echo $saving; ?>% <?php echo $text_income; ?>)</span>&nbsp;
								<span class="price-new"><?php echo $special; ?></span>
								
								<?php } ?>
	<div id="kdesc" style="font-size:19px;color:yellowgreen ;font-weight:bold;display:none"></div>
			
							</div>	
							<div class="other-price">
								<?php if ($tax) { ?>
									<!--<span class="price-tax"><?php echo $text_tax; ?> <?php echo $tax; ?></span><br/>-->
								<?php } ?>
								<?php if ($points) { ?>
									<span class="reward"><small><?php echo $text_points; ?> <?php echo $points; ?></small></span>
								<?php } ?>
							</div>			 		
							<?php if ($discounts) { ?>	 		
							<div class="discount"> 
								<ul>
									<?php foreach ($discounts as $discount) { ?>							
									<li style="color:orange; font-size:15px; font-weight:bold;">Discount: <?php echo sprintf($text_discount, $discount['quantity'], $discount['price']); ?></li>
									<?php } ?>
								</ul>
							</div>
							<?php } ?>
						</div>
						<?php } ?>

							<?php if ($stock == "In Stock"){	  	
	 ?>
						<?php if ($options) { ?>	

						
										
						<div class="options" >
							<h2><?php echo $text_option; ?></h2>        
							<?php foreach ($options as $option) { ?>

							<?php if ($option['type'] == 'select') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option form-group" style="display:none">
								<?php if ($option['required']) { ?>
								<p><span class="required">*</span>
								<?php } ?>
								<b><?php echo $option['name']; ?>:</b></p>									
								<select name="option[<?php echo $option['product_option_id']; ?>]">
									<option value=""><?php echo $text_select; ?></option>
									<?php foreach ($option['option_value'] as $option_value) { ?>
									<option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
									<?php if ($option_value['price']) { ?>
									(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
									<?php } ?>
									</option>
									<?php } ?>
								</select>							
							</div>        
							<?php } ?>
						
						
							<?php if ($option['type'] == 'radio') { ?>
	<?php if( $option['name'] == 'Size'){?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option form-group">
								<?php if ($option['required']) { ?>
								<p><span class="required">*</span>
								<?php } ?>
								<b><?php echo $option['name']; ?>:</b></p>						
								<?php foreach ($option['option_value'] as $option_value) { ?>
								<div class="radio">
									<label for="option-value-<?php echo $option_value['product_option_value_id']; ?>">
										<input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />	
										<?php echo $option_value['name']; ?>
										<?php if ($option_value['price']) { ?>
										(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
										<?php } ?>
									</label>							
								</div>
								<?php } ?>
							</div>					
							<?php }} ?>

			
			
							<?php if ($option['type'] == 'checkbox') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option form-group" style="display:none">
								<?php if ($option['required']) { ?>
								<p><span class="required">*</span>
								<?php } ?>
								<b><?php echo $option['name']; ?>:</b></p>						
								<?php foreach ($option['option_value'] as $option_value) { ?>
								<div class="checkbox">
									<label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
										<input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
										<?php if ($option_value['price']) { ?>
										(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
										<?php } ?>
									</label>	
								</div>						
								<?php } ?>
							</div>					
							<?php } ?>

			
			
							<?php if ($option['type'] == 'image') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option form-group" >
								
								<div class="option-image">
									<span style="margin-right: 5px;">
									<?php if ($option['required']) { ?>
									<span class="required"></span>
									<?php } ?>
									<b><?php echo $option['name']; ?>:</b></span>
									<?php foreach ($option['option_value'] as $option_value) {
										$ps=""; if($option_value['price']){
	$ps = split("<span class='WebRupee'>Rs</span>", $option_value['price']); }

	 ?>
									 
										<span style="width: 1px;"><input type="radio" name="option[<?php echo $option['product_option_id']; ?>]"  value="<?php echo $option_value['product_option_value_id']; ?>" class="selected" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" style="position: absolute;margin-left: 27px;margin-top: 25px;opacity: 0.9; visibility: hidden;" /></span>

										<span><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>">
	<div class="small-images">
	<img id="<?php echo $option_value['product_option_value_id']; ?>"  width="30" height="30" src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" onclick="get_radio_value('<?php echo @$ps[1]; ?>')"/>
	</div>
	</label></span>
										<span>
											<label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php //echo $option_value['name']; ?>
												<?php if ($option_value['price']) { ?>
												<!--(<?php //echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)-->
												<?php } ?>
											</label>
										</span>
									 
									<?php } ?> <span id="rid"></span>
									
                                
									</button>
								</span>
									</a>
								</span>

								</div>
							</div>
							<?php } ?>

			
							<?php if ($option['type'] == 'text') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option form-group" style="display:none">
								<?php if ($option['required']) { ?>
								<p><span class="required">*</span>
								<?php } ?>
								<b><?php echo $option['name']; ?>:</b></p>
								<input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
							</div>		
							<?php } ?>
		
		
							<?php if ($option['type'] == 'textarea') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option form-group" style="display:none">
								<?php if ($option['required']) { ?>
								<p><span class="required">*</span>
								<?php } ?>
								<b><?php echo $option['name']; ?>:</b></p>
								<textarea name="option[<?php echo $option['product_option_id']; ?>]" cols="40" rows="5" class="form-control"><?php echo $option['option_value']; ?></textarea>
							</div>        
							<?php } ?>
			
			
							<?php if ($option['type'] == 'file') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option form-group" style="display:none"> 
								<?php if ($option['required']) { ?>
								<p><span class="required">*</span>
								<?php } ?>
								<b><?php echo $option['name']; ?>:</b></p>
								<input type="button" value="<?php echo $button_upload; ?>" id="button-option-<?php echo $option['product_option_id']; ?>" class="button btn btn-theme-default">
								<input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" />
							</div>		
							<?php } ?>
			
							<?php if ($option['type'] == 'date') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option form-group" style="display:none">
								<?php if ($option['required']) { ?>
								<p><span class="required">*</span>
								<?php } ?>
								<b><?php echo $option['name']; ?>:</b></p>
								<input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" />
							</div>		
							<?php } ?>		
			
							<?php if ($option['type'] == 'datetime') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option form-group" style="display:none">
								<?php if ($option['required']) { ?>
								<p><span class="required">*</span>
								<?php } ?>
								<b><?php echo $option['name']; ?>:</b></p>
								<input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" />
							</div>        
							<?php } ?>		
			
							<?php if ($option['type'] == 'time') { ?>
							<div id="option-<?php echo $option['product_option_id']; ?>" class="option form-group" >
								<?php if ($option['required']) { ?>
								<p><span class="required">*</span>
								<?php } ?>
								<b><?php echo $option['name']; ?>:</b></p>
								<input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="time" />
							</div>        
							<?php } ?>		
					
						<?php } ?>
					</div>
				<?php } 
}

				?>
				<?php if ($stock == "In Stock"){ } else {?>
				<div class="product-availability">
					<b><?php echo $text_stock; ?></b>
					<span class="availability <?php if ($stock == "Out Of Stock"){ echo "outofstockcls"; }?>"><?php echo $stock; ?></span>	
				</div>
				<?php } if ($stock == "In Stock"){

			?>
			
				
				<div class="product-extra">
					<!--<div class="quantity-adder pull-left">
						<div class="quantity-number pull-left">
							<span><?php echo $text_qty; ?></span>
							<input type="text" name="quantity" size="2" value="<?php echo $minimum; ?>" />
						</div>
						<div class="quantity-wrapper pull-left">
							<span class="add-up add-action fa fa-plus"></span> 
							<span class="add-down add-action fa fa-minus"></span>
						</div>					
						
					</div>	-->
					<input type="hidden" name="product_id" size="2" value="<?php echo $product_id; ?>" />	
						<input type="hidden" name="quantity" size="2" value="<?php echo $minimum; ?>" />								
					<div class="cart pull-left">					
						<!-- <input type="button" value="<?php //echo $button_cart; ?>" id="button-cart" class="button btn btn-theme-default" /> -->

						<!--<button id="button-buynow" class="btn btn-shopping-cart btn-cart-detail orange">						
							<span class="fa fa-shopping-cart product-icon hidden-sm hidden-md">&nbsp;</span>
							<span>Buy now</span>
						</button>

						<button id="button-cart" class="btn btn-shopping-cart btn-cart-detail grey">						
							<span class="fa fa-shopping-cart product-icon hidden-sm hidden-md">&nbsp;</span>
							<span><?php echo $button_cart; ?></span>
						</button>-->

						

					</div>
					<div class="pull-left">

						
							
<a id="testedd" onclick=window.parent.location.href="<?php echo $this->url->link('product/product', 'product_id=' . $product_id); ?>" style="float:left;"><div class="btnview"  style="background-color: #f58634;color: white;padding: 8px 20px;width: 162px;font-size:16px;font-weight:bold;font-family: "Raleway-Medium",Helvetica,Arial,sans-serif;">VIEW DETAILS</div></a>
							<a class="wishlist" onclick="addToWishList('<?php echo $product_id; ?>');" title="add to wishlist" style="float: left; margin: 3px 0px 0px 10px;">
								<i class="fa fa-heart"></i>
								<!--<?php echo $button_wishlist; ?>-->
							</a>

							

						</div>&nbsp;&nbsp;&nbsp;
						
                 	



					</div>
					<?php

				}
					?>

<!--<div class="share">
							
					<div class="addthis_default_style"><a class="addthis_button_compact"><?php echo $text_share; ?></a> <a class="addthis_button_email"></a><a class="addthis_button_print"></a> <a class="addthis_button_facebook"></a> <a class="addthis_button_twitter"></a></div>
					<script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js"></script> 
					
				</div>	
					
				</div> -->

				<?php if ($minimum > 1) { ?>
					<div class="minimum"><small><?php echo $text_minimum; ?></small></div>
				<?php } ?>			
					
					<div class="share">
			<a class="sharesocial">SHARE: &nbsp;</a> 
				<!-- AddThis Button END --> 				
				<div class="addthis_default_style">
				<a onclick="PopupCenter('https://plus.google.com/share?url=<?php echo CurrentHost; ?>','xtf','450','400');"><img class="piconcls" src="<?php echo CurrentHost; ?>/image/social-icons/google_plus27.png"></a>&nbsp;&nbsp;<a onclick="PopupCenter('https://twitter.com/intent/tweet?text=@go_footlounge&','xtf','450','400');"><img class="piconcls" src="<?php echo CurrentHost; ?>/image/social-icons/twittersmall1.png"></a>&nbsp; 
				<a onclick="PopupCenter('http://www.facebook.com/sharer/sharer.php?u=<?php echo CurrentHost; ?>','xtf','450','400');"> <img class="piconcls" src="<?php echo CurrentHost; ?>/image/icon-facebook.png"></a>
				
				</div>
				<script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js"></script> 
				<!-- AddThis Button BEGIN --> 
			</div>		
					
			
				<?php if ($tags) { ?>
				<div class="tags">
					<b><?php echo $text_tags; ?></b>
					<?php for ($i = 0; $i < count($tags); $i++) { ?>
					<?php if ($i < (count($tags) - 1)) { ?>
					<a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
					<?php } else { ?>
					<a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
					<?php } ?>
					<?php } ?>
				</div>
				<?php } ?>  
			</div>
		</div>
	</div>

	</div>

<?php if( $productConfig['product_enablezoom'] ) { ?>
<script type="text/javascript" src=" catalog/view/javascript/jquery/elevatezoom/elevatezoom-min.js"></script>
<script type="text/javascript">
	<?php if( $productConfig['product_zoomgallery'] == 'slider' ) {  ?>
		$("#image").elevateZoom({gallery:'image-additional-carousel', cursor: 'pointer', galleryActiveClass: 'active'}); 
		<?php } else { ?>
		var zoomCollection = '<?php echo $productConfig["product_zoomgallery"]=="basic"?".product-image-zoom":"#image";?>';
		$( zoomCollection ).elevateZoom({
		<?php if( $productConfig['product_zoommode'] != 'basic' ) { ?>
		zoomType        : "<?php echo $productConfig['product_zoommode'];?>",
		<?php } ?>
		lensShape : "<?php echo $productConfig['product_zoomlensshape'];?>",
		lensSize    : <?php echo (int)$productConfig['product_zoomlenssize'];?>,
	});
	<?php } ?> 
</script>
<?php } ?>



<script type="text/javascript">
<!--
$('#button-cart').bind('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: $('.product-info input[type=\'text\'], .product-info input[type=\'hidden\'], .product-info input[type=\'radio\']:checked, .product-info input[type=\'checkbox\']:checked, .product-info select, .product-info textarea'),
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, information, .error').remove();
			
			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						$('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
					}
				}
			} 
			
			if (json['success']) {
				$('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
					
				$('.success').fadeIn('slow');
					
				$('#cart-total').html(json['total']);
				
				$('html, body').animate({ scrollTop: 0 }, 'slow'); 
			}	
		}
	});
});
//-->

$('#button-buynow').bind('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: $('.product-info input[type=\'text\'], .product-info input[type=\'hidden\'], .product-info input[type=\'radio\']:checked, .product-info input[type=\'checkbox\']:checked, .product-info select, .product-info textarea'),
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, information, .error').remove();
			
			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						$('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
					}
				}
			} 
			
			if (json['success']) {
				$('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');

					var url = "index.php?route=checkout/checkout";    
					//$(location).attr('href',url);

					$('.success').fadeIn('slow');
					
					$('#cart-total').html(json['total']);
					
					$('html, body').animate({ scrollTop: 0 }, 'slow'); 
					$.colorbox.close();

					window.parent.location = url;
					
				
			}	
		}
	});
});
</script>

<?php if ($options) { ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/ajaxupload.js"></script>
<?php foreach ($options as $option) { ?>
<?php if ($option['type'] == 'file') { ?>
<script type="text/javascript"><!--
new AjaxUpload('#button-option-<?php echo $option['product_option_id']; ?>', {
  action: 'index.php?route=product/product/upload',
  name: 'file',
  autoSubmit: true,
  responseType: 'json',
  onSubmit: function(file, extension) {
    $('#button-option-<?php echo $option['product_option_id']; ?>').after('<img src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/image/loading.gif" class="loading" style="padding-left: 5px;" />');
    $('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', true);
  },
  onComplete: function(file, json) {
    $('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', false);

    $('.error').remove();

    if (json['success']) {
      alert(json['success']);
      $('input[name=\'option[<?php echo $option['product_option_id']; ?>]\']').attr('value', json['file']);
    }

    if (json['error']) {
      $('#option-<?php echo $option['product_option_id']; ?>').after('<span class="error">' + json['error'] + '</span>');
    }

    $('.loading').remove(); 
  }
});
//-->
</script>

<?php } ?>
<?php } ?>
<?php } ?>

<script type="text/javascript">
<!--
$('#review .pagination a').live('click', function() {
  $('#review').fadeOut('slow');

  $('#review').load(this.href);

  $('#review').fadeIn('slow');

  return false;
});

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');
$('#review').load('index.php?route=product/product', 'product_id=<?php echo $product_id; ?>');
$('#button-review').bind('click', function() {
  $.ajax({
    url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
    type: 'post',
    dataType: 'json',
    data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
    beforeSend: function() {
      $('.success, .warning').remove();
      $('#button-review').attr('disabled', true);
      $('#review-title').after('<div class="attention"><img src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
    },
    complete: function() {
      $('#button-review').attr('disabled', false);
      $('.attention').remove();
    },
    success: function(data) {
      if (data['error']) {
        $('#review-title').after('<div class="warning">' + data['error'] + '</div>');
      }

      if (data['success']) {
        $('#review-title').after('<div class="success">' + data['success'] + '</div>');

        $('input[name=\'name\']').val('');
        $('textarea[name=\'text\']').val('');
        $('input[name=\'rating\']:checked').attr('checked', '');
        $('input[name=\'captcha\']').val('');
      }
    }
  });
});
//-->
</script> 

<script type="text/javascript">
<!--
$('#tabs a').tabs();
//-->
</script> 

<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript">
<!--
$(document).ready(function() {
  if ($.browser.msie && $.browser.version == 6) {
    $('.date, .datetime, .time').bgIframe();
  }

  $('.date').datepicker({dateFormat: 'yy-mm-dd'});
  $('.datetime').datetimepicker({
    dateFormat: 'yy-mm-dd',
    timeFormat: 'h:m'
  });
  $('.time').timepicker({timeFormat: 'h:m'});
});


//popup center social link
    function PopupCenter(url, title, w, h) {
	    // Fixes dual-screen position                         Most browsers      Firefox
	    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
	    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

	    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
	    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

	    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
	    var top = ((height / 2) - (h / 2)) + dualScreenTop;
	    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

	    // Puts focus on the newWindow
	    if (window.focus) {
	        newWindow.focus();
	    } 
	}  
//-->
</script> 
</section>
 
 

</div></div>

</section></section> 
</body></html>