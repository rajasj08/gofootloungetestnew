<?php  
	/******************************************************
	 * @package Pav Megamenu module for Opencart 1.5.x
	 * @version 1.1
	 * @author http://www.pavothemes.com
	 * @copyright	Copyright (C) Feb 2013 PavoThemes.com <@emai:pavothemes@gmail.com>.All rights reserved.
	 * @license		GNU General Public License version 2
	*******************************************************/

	require_once( DIR_TEMPLATE.$this->config->get('config_template')."/development/libs/framework.php" );
	$themeConfig = (array)$this->config->get('themecontrol');
	$themeName =  $this->config->get('config_template');
	$helper = ThemeControlHelper::getInstance( $this->registry, $themeName );
	$LANGUAGE_ID = $this->config->get( 'config_language_id' );  
?>
</section>





<?php
/**
 * Promotion modules
 * $ospans allow overrides width of columns base on thiers indexs. format array( 1=> 3 )[value from 1->12]
 */
$modules = $helper->getModulesByPosition( 'promotion' ); 
$ospans = array(1=>6,2=>6);

if( count($modules) ){
$cols = isset($config['block_promotion'])&& $config['block_promotion']?(int)$config['block_promotion']:count($modules);	
$class = $helper->calculateSpans( $ospans, $cols );
?>
<section class="pav-promotion" id="pav-promotion">
	<div class="container">
		<?php $j=1;foreach ($modules as $i =>  $module) {?>
		<?php if( $i++%$cols == 0 || count($modules)==1 ){  $j=1;?><div class="row"><?php } ?>	
		<div class="<?php echo $class[$j];?>"><?php echo $module; ?></div>
		<?php if( $i%$cols == 0 || $i==count($modules) ){ ?></div><?php } ?>	
		<?php  $j++;  } ?>
	</div>	
</section>
<?php } ?>





<?php
	/**
	 * Footer Top Position
	 * $ospans allow overrides width of columns base on thiers indexs. format array( 1=> 3 )[value from 1->12]
	 */
	$modules = $helper->getModulesByPosition( 'mass_bottom' ); 
	$ospans = array();
	$cols   = 1;
	if( count($modules) ) { 
?>


<section id="pav-mass-bottom">
	<div class="container">
		<?php $j=1;foreach ($modules as $i =>  $module) {   ?>
			<?php if( $i++%$cols == 0 || count($modules)==1 ){  $j=1;?><div class="row"><?php } ?>	
			<div class="col-lg-<?php echo floor(12/$cols);?> col-sm-<?php echo floor(12/$cols);?> col-xs-12"><?php echo $module; ?></div>
			<?php if( $i%$cols == 0 || $i==count($modules) ){ ?></div><?php } ?>	
		<?php  $j++;  } ?>
	</div>	
</section>
<?php } ?>




<footer id="footer">

	<!--<div class="row social-links">
		<div class="container">
			<div class="col-md-8 col-sm-12 get-in-touch-cont">
				<span class="get-in-touch">Get in touch</span>
				<a href="https://www.facebook.com/footlounge.online" target="_blank">
					<span class="fa fa-facebook circle">&nbsp;</span></a>&nbsp;
				<a href="https://plus.google.com/u/0/115256944391879546136/posts" target="_blank"><span class="fa fa-google-plus circle">&nbsp;</span></a>&nbsp;
				<a href="https://twitter.com/go_footlounge" target="_blank"><span class="fa fa-twitter circle">&nbsp;</span></a>&nbsp;
				<a href="https://instagram.com/go_footlounge/" target="_blank">
				<span class="fa fa-instagram circle">&nbsp;</span>
				</a>
			</div>
			<div class="col-md-4 col-sm-12">
				<div class="shipping-cod-secure-payment-cont">
					<img src="<?php echo CurrentHost; ?>/image/shipping-cod-secure-payment.png">
				</div>
				<div class="clrBoth">&nbsp;</div>
			</div>
			
		</div>
	</div>-->
	<div class="col-sm-12">
			<div class="container">
				<div class="shippincon">
<div class="col-sm-4">

<img src="<?php echo CurrentHost; ?>/image/indian-rupee-symbol-icon.png" alt="cash on delivery">cash on delivery
</div>
<div class="col-sm-4">

<img src="<?php echo CurrentHost; ?>/image/100-percent-secure-icon.png" alt="secure shopping">Secure Shopping
</div>
<div class="col-sm-4">
<img src="<?php echo CurrentHost; ?>/image/free-shipping-icon.png" alt="free shipping">free shipping	
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
	<?php
	/**
	 * Footer Top Position
	 * $ospans allow overrides width of columns base on thiers indexs. format array( 1=> 3 )[value from 1->12]
	 */
	$modules = $helper->getModulesByPosition( 'footer_top' ); 
	$ospans = array();
	
	if( count($modules) ){
	$cols = isset($themeConfig['block_footer_top'])&& $themeConfig['block_footer_top']?(int)$themeConfig['block_footer_top']:count($modules);
	//if( $cols < count($modules) ){ $cols = count($modules); }
	$class = $helper->calculateSpans( $ospans, $cols );
	?>
	<div class="footer-top">			
		<div class="container">
			<div class="custom">
				<?php $j=1;foreach ($modules as $i =>  $module) {   ?>
					<?php if( $i++%$cols == 0 || count($modules)==1 ){  $j=1;?><div class="row"><?php } ?>	
					<div class="<?php echo $class[$j];?>"><?php echo $module; ?></div>
					<?php if( $i%$cols == 0 || $i==count($modules) ){ ?></div><?php } ?>	
				<?php  $j++;  } ?>
			</div>
		</div>		
	</div>
	<?php } ?>
	<?php
	/**
	 * Footer Center Position
	 * $ospans allow overrides width of columns base on thiers indexs. format array( 1=> 3 )[value from 1->12]
	 */
	$modules = $helper->getModulesByPosition( 'footer_center' ); 
	$ospans = array(1=>3,2=>2,3=>2,4=>2,5=>3);
	
	if( count($modules) ){
	$cols = isset($themeConfig['block_footer_center'])&& $themeConfig['block_footer_center']?(int)$themeConfig['block_footer_center']:count($modules);
	$class = $helper->calculateSpans( $ospans, $cols );
	?>
	<div class="footer-center">
		<div class="container">
		<?php $j=1;foreach ($modules as $i =>  $module) {  ?>
				<?php if( $i++%$cols == 0 || count($modules)==1 ){  $j=1;?><div class="row"><?php } ?>	
				<div class="<?php echo $class[$j];?>"><?php echo $module; ?></div>
				<?php if( $i%$cols == 0 || $i==count($modules) ){ ?></div><?php } ?>	
		<?php  $j++;  } ?>	
		</div>
	</div>
<?php } elseif((isset($themeConfig['enable_footer_center'])&&$themeConfig['enable_footer_center'])) { ?>
<div class="footer-center">
		<div class="container">

			<div class="row rowborder">			
			<?php if( isset($themeConfig['widget_about_data'][$LANGUAGE_ID]) ) {

			?>
			<div class="column col-xs-12 col-sm-12 col-lg-12 col-md-12">
				<div class="box about-us">					
					<div class="box-content footer-text">
						<?php echo html_entity_decode( $themeConfig['widget_about_data'][$LANGUAGE_ID], ENT_QUOTES, 'UTF-8' ); ?>
					</div>
				</div>
			</div>
			<?php } ?>	
			</div>
			
			<div class="row footer-links footer-text">
			<?php if ($informations) { ?>
			<div class="column col-xs-12 col-sm-3 col-lg-3 col-md-3">
				<div class="box info">
					<div class="box-heading"><span class="footer-linktext"><?php echo $text_information; ?></span></div>
					<div class="box-content">
						<ul class="list">
						  <?php foreach ($informations as $information) { ?>
						  <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
						  <?php } ?>
                                                   <li><a href="http://blog.footlounge.in/">Our Blog</a></li>   
						</ul>
					</div>					
				</div>
			</div>
			<?php } ?>				
		  
			<div class="column col-xs-12 col-sm-3 col-lg-3 col-md-3">
				<div class="box extra">
					<div class="box-heading"><span><?php echo $text_extra; ?></span></div>
					<div class="box-content">
						<ul class="list">							
							<li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
							<li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
							<!--<li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>-->
							<li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
						</ul>
					</div>			
				</div>
			</div>

			<div class="column col-xs-12 col-sm-3 col-lg-3 col-md-3">
				<div class="box">
					<div class="box-heading"><span><?php echo $text_account; ?></span></div>
					<div class="box-content">
						<ul class="list">						  
							<li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
							<li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
							<li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
							<li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="column col-xs-12 col-sm-3 col-lg-3 col-md-3">
				<div class="box customer-service">
					<div class="box-heading"><span><?php echo $text_service; ?></span></div>
					<div class="box-content">
						<ul class="list">						  
							<li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
							<li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
							<li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
							<li><a href="<?php echo CurrentHost; ?>/Footlounge-Frequently-Asked-Questions">FAQ</a></li>
						</ul>
					</div>	
				</div>
			</div>
		 </div> 

		 <div class="col-xs-12">
 <div class="footext new_foot_border">	
<div class="footer-linktext footernstyle">Top Brands</div>
<p class="category-p"><a href="<?php echo CurrentHost; ?>/adidas-shoes-online" class="linklight">Adidas</a>&nbsp;/&nbsp;<a class="linklight" href="<?php echo CurrentHost; ?>/reebok-shoes-online">Reebok</a>&nbsp;/&nbsp;<a class="linklight" href="<?php echo CurrentHost; ?>/nike-shoes-online">Nike</a>&nbsp;/&nbsp;<a class="linklight" href="<?php echo CurrentHost; ?>/american-tourister-travel-bags-online">American Tourister</a>&nbsp;/&nbsp;<a class="linklight" href="<?php echo CurrentHost; ?>/fila-shoes-online">Fila</a>&nbsp;/&nbsp;<a class="linklight" href="<?php echo CurrentHost; ?>/footlounge-sports-clothing-online">Foot Lounge</a>&nbsp;/&nbsp;<a class="linklight" href="<?php echo CurrentHost; ?>/lee-cooper-shoes-online">Lee Cooper</a>&nbsp;/&nbsp;<a class="linklight" href="<?php echo CurrentHost; ?>/puma-shoes-online">Puma</a></p>
</div>
</div>
		 <div class="col-xs-12"> 	
		 <div class="footext">
<div class="footer-linktext footernstyle">Top Categories</div>

<!--<a href="javascript:void(0)" class="linklight">Men Shoes</a>&nbsp;/&nbsp;<a class="linklight" href="javascript:void(0)">Men Clothing</a>&nbsp;/&nbsp;<a class="linklight" href="javascript:void(0)">Men Accessories</a>&nbsp;/&nbsp;<a class="linklight" href="javascript:void(0)">Men Fitness</a>&nbsp;/&nbsp;<a class="linklight" href="javascript:void(0)">running shoes</a>/<a href="javascript:void(0)">tennis shoes</a>/<a href="javascript:void(0)">cricket shoes</a>/<a href="javascript:void(0)">football shoes</a>/<a href="javascript:void(0)">basketball shoes</a>/<a href="javascript:void(0)">training shoes</a>/<a href="javascript:void(0)">walking shoes</a>/<a href="javascript:void(0)">floaters</a>/<a href="javascript:void(0)">flip-flops/sandals</a>/<a href="javascript:void(0)">hiking shoes</a>/<a href="javascript:void(0)">cardio shoes</a>/<a href="javascript:void(0)">dance shoes</a>/<a href="javascript:void(0)">sports clothing</a>/<a href="javascript:void(0)">sports shorts</a>/<a href="javascript:void(0)">sports t-shirts</a>/<a href="javascript:void(0)">sports track pants</a>/<a href="javascript:void(0)">caps</a>/<a href="javascript:void(0)">wallets</a>/<a href="javascript:void(0)">socks</a>/<a href="javascript:void(0)">headbands</a>/<a href="javascript:void(0)">back pack</a>/<a href="javascript:void(0)">travel bag</a>/<a href="javascript:void(0)">yoga mat</a>/<a href="javascript:void(0)">fitness mat</a>/<a href="javascript:void(0)">resistance tube</a>/<a href="javascript:void(0)">power tube</a>/<a href="javascript:void(0)">dumbbells</a>/<a href="javascript:void(0)">kettle bells</a>/<a href="javascript:void(0)">weights</a>/<a href="javascript:void(0)">bottle</a> -->
<p class="category-p"><a href="<?php echo CurrentHost; ?>/men" class="linklight">Men</a>&nbsp;/&nbsp;<a class="linklight" href="<?php echo CurrentHost; ?>/women">Women</a>&nbsp;/&nbsp;<a class="linklight" href="<?php echo CurrentHost; ?>/kids">Kids</a>&nbsp;/&nbsp;<a class="linklight" href="<?php echo CurrentHost; ?>/men/shoes">Sport Shoes</a>&nbsp;/&nbsp;<a class="linklight" href="<?php echo CurrentHost; ?>/men/shoes/running-shoes">running Shoes</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/men/shoes/sports/tennis-shoes" class="linklight">Tennis Shoes</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/men/shoes/sports/cricket-shoes" class="linklight">Cricket Shoes</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/men/shoes/sports/football-shoes" class="linklight">Football Shoes</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/men/shoes/sports/basketball-shoes" class="linklight">Basketball Shoes</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/men/shoes/training-shoes" class="linklight">Training Shoes</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/women/shoes/walking-shoes" class="linklight">Walking Shoes</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/men/shoes/sandals-floaters" class="linklight">Floaters</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/women/shoes/flip-flops-slippers" class="linklight">Flip - Flops</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/men/shoes/sandals-floaters" class="linklight">Sandals</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/men/shoes/outdoor-hiking-shoes" class="linklight">Hiking Shoes</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/women/shoes/cardio-shoes" class="linklight">Cardio Shoes</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/women/shoes/dance-shoes" class="linklight">Dance Shoes</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/men/clothing" class="linklight">Sport Clothing</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/men/clothing/shorts" class="linklight">Sport Shorts</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/men/clothing/t-shirt" class="linklight">Sport T-Shirts</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/men/clothing/track-pants" class="linklight">Sports Track Pants</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/men/accessories/caps" class="linklight">Caps</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/men/accessories/wallet" class="linklight">Wallets</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/men/accessories/socks" class="linklight">Socks</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/men/accessories/headband" class="linklight">Headbands</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/men/accessories/backpack" class="linklight">Back Pack</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/men/accessories/travel-bag" class="linklight">Travel Bag</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/fitness/yoga-mat" class="linklight">Yoga Mat</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/fitness/fitness-mat" class="linklight">Fitness Mat</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/fitness/resistance-tube" class="linklight">Resistance Tube</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/fitness/power-tube" class="linklight">power Tube</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/fitness/dumbells" class="linklight">Dumbbells</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/fitness/kettle-bells" class="linklight">Kettle Bells</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/fitness/ankle-weight" class="linklight">Weights</a>&nbsp;/&nbsp;<a href="<?php echo CurrentHost; ?>/fitness/water-bottle" class="linklight">Bottle</a></p>
</div>	

</div>
 
<div id="powered" class="cfont"><div class="container">
<div class="copyright">

<!--<?php if( isset($themeConfig['enable_custom_copyright']) && $themeConfig['enable_custom_copyright'] ) { ?>
	<?php echo $themeConfig['copyright'];?>
<?php } else { ?>
	<?php echo $powered; ?>. 
<?php } ?> -->
footlounge.in powered by <a href="http://tech-bee.com/" target="_blank">Tech-Bee</a>. All Rights Reserved.


</div>	
</div></div>


<div id="clickme" class="footerclass">
<img src="<?php echo CurrentHost; ?>/image/downarrow.png" alt="footlounge">

</div>


<script>
$( document ).ready(function() {
$( "#clickme img" ).click(function() {
  $( "#footer_botbtn" ).toggle( "fast", function() {
    // Animation complete.
  });
});

if ($(window).width()  < 768) {
 $(".footer-links").hide();
$(".mobcnt").show();
}
else
{

$(".mobcnt").hide(); 
 $(".footer-links").show();
}
});
</script>



<div id="footer_botbtn">



 <div class="col-xs-12">
 	<div class="footext new_foot_bordertop">	
<div class="footernstyle">Did You Know?</div> 

You should use a sports specific shoe if you play a sport 3 times a week or more.
Sports Shoes enhance your performance on the field and help prevent injuries. 
<b class="boldc">Treat Your Feet Right. Get them a Sports Shoe.</b>  
<span class="underlinecls">Shoes Do Not Multi-task</span>. When you walk / run or play a sport your feet need the right shoe for each.

<div class="footernstyle">Sports Shoes at FootLounge</div>
Footlounge is a leading sports footwear and apparel retailer based out of Chennai, India. We opened doors in April 2007 and have grown to 19 stores since inception. We offer sports specific performance products manufactured by leading athletic brands. Our specialized service includes providing our customers expert guidance on the type of shoe needed for their sport. Our reputed range of brands include Adidas, Reebok, Nike, Puma, Fila, Lee Cooper and Woodland.
FootLounge is your one-stop shop catering to all your athletic needs ranging from sports shoes, sports t-shirts , tracks, shorts, sports accessories, socks, caps , sports bags , yoga mats, dumb bells and weights. Our sports specific product varieties range across Cricket, Tennis, Basketball, Football, Training and Hiking. We also carry a wide range of Running shoes, Cardio Shoes, Walking Shoes, Indoor/Outdoor Shoes, Sandals, Floaters and Flip-flops. Take Advantage of our sports specialists who will give you their valuable input on the type of shoes you will need for your sport/need. Sports Specialists are available for your convenience via chat session and on our direct line.
We have a wide range of reputed brands which we take pride in delivering to your door step with our <b class="boldc">Free Delivery</b> across the nation. We offer <b class="boldc">Free Exchange/Free Returns</b> and easy, secure payment options including <b class="boldc">Cash on Delivery</b> for your shopping experience to be completely stress free. Relax and Unwind at your home and leave the rest to us.
Not Sure about the right <b class="boldc">Shoe Size for You?</b>
Worry not as we now have an accurate shoe size measuring tool for your convenience. Still unsure? Our Sales specialists will help you find the right size for you. Just Chat with us Or Call Us. 
<div class="footernstyle">Online Deals and Discounts</div>
Why Over pay? Shop with us to get the best deals in the market.
We now provide the same great in-store shopping experience to our online community with our online shop-<?php echo CurrentHost; ?>. We offer the best deals and discounts for sports shoes, sports clothing and sports accessories. Explore our sports collections in Adidas Sale, Reebok Sale, and Nike Sale. 
Our Online shop also have weekly sale/discounts on branded clothing , fitness and accessory – Adidas track pants, Adidas t-shirts, Adidas shorts, Adidas socks, Adidas caps,  Adidas bags, Reebok track pants, Reebok t-shirts, Reebok socks, Reebok caps, sports bags, yoga mats, dumbbells, weights, tubes, bottles, kettle bells. Buy from our extensive range of sports shoes which include Tennis shoes, Cricket shoes, Football shoes, Basketball shoes, Running shoes, Training shoes, Cardio shoes, Dance shoes, Hiking shoes, Floaters, Flip-flops, Sandals. Our online shop now carry American Tourister products for a limited time.
<div class="footernstyle">Introducing Brand <img src="<?php echo CurrentHost; ?>/image/data/lo2logo.png" alt="Footlounge Logo" class="footerlogoimg"/></div>
Did you try out our very own Brand FootLounge? Affordable Sportswear range includes Track pants, Sports T-shirts and Sports Shorts. Our unique Dry Cool technology keeps you at ease all day long. Our products are a unique combination of top quality products and rock bottom prices.
<br/><br/> 
Prices starting from Rs 454/- . Try us out Now!

</div>	

</div>

</div>

	</div>


</div>
<?php  } ?>	



<div class="mobcnt removenormalmob">
<div class="column col-xs-12 col-sm-3 col-lg-3 col-md-3 "><div class="box-heading mobileheadn"><!--<span class="footer-linktext linkmob">Quick Links</span>--></div><div class="column col-xs-7 col-sm-3 col-lg-3 col-md-3 footermob"><div class="box info"><div class="box-content"><ul class="list"><li class="first"><a href="<?php echo CurrentHost; ?>/delivery-information">Delivery Information</a></li><li><a href="<?php echo CurrentHost; ?>/brands">Brands</a></li><li class="last"><a href="<?php echo CurrentHost; ?>/footlounge-return-policy">Return Policy</a></li></ul></div></div><!--<a href="mailto:order@footlounge.in"><button type="button" class="emailbtnmob">Email Us</button></a> --></div><div class="column col-xs-5 col-sm-3 col-lg-3 col-md-3 footermob"><div class="box info"><div class="box-content"><ul class="list"><li class="last"><a href="<?php echo CurrentHost; ?>/Footlounge-Frequently-Asked-Questions">FAQ</a></li><li><a href="<?php echo CurrentHost; ?>/voucher">Gift Vouchers</a></li><li><a href="<?php echo CurrentHost; ?>/sitemap">Site Map</a></li></ul></div></div><!--<a href="<?php echo CurrentHost; ?>/contact"><button type="button" class="emailbtnmob">Contact Us</button></a>-->


</div><div class="fccenter"><a href="mailto:order@footlounge.in"><button type="button" class="emailbtnmob"><i class="fa fa-envelope-o" aria-hidden="true"></i> &nbsp;Email Us</button></a></div></div>
<div class="col-md-12">
			
				<!--<div class="col-md-6 paypart">
				<div class="row topclasspay">
				<h3><b>Secured Shopping by &nbsp;<img src="image/Secures-Shopping/file_d44if0o2qr40m0o.png" class="payoptclsmain"></b></h3>
					<div class="payoptdivcls"><img src="image/Secures-Shopping/FootLoungeSecuredShopping.jpg" class="payoptclsx"></div> 

				</div>
			</div>	 -->

			<div class="col-md-12 paypart">
				<div class="row topclasspay">
				<!--<h3><b>Payment Options</b></h3> -->
					<div class="payoptdivcls"><img src="image/Payment-Options/FL-Mobile-Payment-Options.jpg" alt="FootLounge Payment Options" class="payoptcls1x"></div> 
					
				</div>
			</div>	
		
			</div>

<div class="mobilelastcol"><a href="<?php echo CurrentHost; ?>/terms-conditions">Terms &amp; Conditions</a> | <a href="<?php echo CurrentHost; ?>/privacy-policy-and-pisclaimer">Privacy Policy</a> | <a href="<?php echo CurrentHost; ?>/aboutus">About Us</a></div></div>
</div>	



<?php
/**
 * Footer Bottom
 * $ospans allow overrides width of columns base on thiers indexs. format array( 1=> 3 )[value from 1->12]
 */
$modules = $helper->getModulesByPosition( 'footer_bottom' ); 
$ospans = array();

if( count($modules) ){
$cols = isset($themeConfig['block_footer_bottom'])&& $themeConfig['block_footer_bottom']?(int)$themeConfig['block_footer_bottom']:count($modules);	
$class = $helper->calculateSpans( $ospans, $cols );
?>
<div class="footer-bottom">
	<?php $j=1;foreach ($modules as $i =>  $module) {  ?>
	<?php if( $i++%$cols == 0 || count($modules)==1 ){  $j=1;?><div class="row"><?php } ?>	
	<div class="<?php echo $class[$j];?>"><?php echo $module; ?></div>
	<?php if( $i%$cols == 0 || $i==count($modules) ){ ?></div><?php } ?>	
	<?php  $j++;  } ?>	
</div>
<?php } ?>




</footer>




<?php
//call social 
$social_left = $helper->getModulesByPosition('outsite_left');
$social_right = $helper->getModulesByPosition('outsite_right');
if(isset($social_left) && !empty($social_left[0])) {
	echo $social_left[0];
}
if(isset($social_right) && !empty($social_right[0])) {
	echo $social_right[0];
}

// call newsletter
$newsletter_bottom = $helper->getModulesByPosition('outsite_bottom');
if(isset($newsletter_bottom) && !empty($newsletter_bottom[0])) {
	echo $newsletter_bottom[0];
}
?>






<?php if( isset($themeConfig['enable_paneltool']) && $themeConfig['enable_paneltool'] ){  ?>
	<?php  echo $helper->renderAddon( 'panel' );?>
<?php } ?>

<script type="text/javascript">
	$(document).ready(function() {
		$("li:first-child").addClass('first');
		$("li:last-child").addClass('last');	
		$(".box-product .row:last-child").addClass('last');				
		$("#image-additional a:last-child").addClass('last'); 
		$(".product-items:last-child").addClass('last');
		$('.product-cols:last-child').addClass('last');	
		$(".product-cols:first-child").addClass('first');		
		$(".product-grid div[class^='col-']:last-child").addClass('last');
		$(".product-grid .row:last-child").addClass('last');
		$(function(){
			$('#header .links li').last().addClass('last');
			$('.breadcrumb a').last().addClass('last');
			$('.cart tr').eq(0).addClass('first');																									  
		});								
	});
</script>
</section> 
<!-- ClickDesk Live Chat Service for websites -->
<script type='text/javascript'>
var _glc =_glc || []; _glc.push('all_ag9zfmNsaWNrZGVza2NoYXRyDwsSBXVzZXJzGOKV4s8LDA');
var glcpath = (('https:' == document.location.protocol) ? 'https://my.clickdesk.com/clickdesk-ui/browser/' : 
'http://my.clickdesk.com/clickdesk-ui/browser/');
var glcp = (('https:' == document.location.protocol) ? 'https://' : 'http://');
var glcspt = document.createElement('script'); glcspt.type = 'text/javascript'; 
glcspt.async = true; glcspt.src = glcpath + 'livechat-new.js';
var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(glcspt, s);
</script>
<!-- End of ClickDesk -->

<div id="knowYourSize" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $know_your_size_heading_title; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo $know_your_size_description; ?>
      </div>
      <div class="modal-footer">
      	<span class="pull-left"> For any additional size related questions please email us on <a href="mailto:service@footlounge.in" title="Mail Us">service@footlounge.in</a></span>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 956201375;
var google_custom_params = window.google_tag_params; var
google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript"
src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div class="new_page_disp2">
<img height="1" width="1" class="new_page_disp1" alt="FootLounge Google ads"
src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/956201375/?v
alue=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript> 
</body></html>