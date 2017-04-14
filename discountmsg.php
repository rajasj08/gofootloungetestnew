<?php 
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
<head style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
<!-- If you delete this tag, the sky will fall on your head -->


<meta name="viewport" content="width=device-width" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">


<title style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">ZURBemails</title>
<style>

@font-face{font-family:WebRupee;src:url(WebRupee.V2.0.eot);src:local('WebRupee'),url(WebRupee.V2.0.ttf) format('truetype'),url(WebRupee.V2.0.woff) format('woff'),url(WebRupee.V2.0.svg) format('svg');font-weight:400;font-style:normal}.WebRupee{font-family:WebRupee}
	</style>
 

 <style style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">


 @import url("http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css");

/* ------------------------------------- 
		GLOBAL 
------------------------------------- */
* { 
	margin:0;
	padding:0; 
}
* { font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; }

img { 
	max-width: 100%; 
}
.collapse {
	margin:0;
	padding:0;
}
body {
	-webkit-font-smoothing:antialiased; 
	-webkit-text-size-adjust:none; 
	width: 100%!important; 
	height: 100%;
}


/* ------------------------------------- 
		ELEMENTS 
------------------------------------- */
a { color: #0030f6 !important;}

.btn {
	text-decoration:none;
	color: #FFF;
	background-color: #666;
	padding:10px 16px;
	font-weight:bold;
	margin-right:10px;
	text-align:center;
	cursor:pointer;
	display: inline-block;
}

p.callout {
	padding:15px;
	background-color:#ECF8FF;
	margin-bottom: 15px;
}
.callout a {
	font-weight:bold;
	color: #2BA6CB;
}

table.social {
/* 	padding:15px; */
	background-color: #ebebeb;
	
}
.social{margin-top:0px;}
.social .soc-btn {
	padding: 3px 7px;
	font-size:12px;
	margin-bottom:10px;
	text-decoration:none;
	color: #FFF;font-weight:bold;
	display:block;
	text-align:center;
}
a.fb { background-color: #3B5998!important; }
a.tw { background-color: #1daced!important; }
a.gp { background-color: #DB4A39!important; }
a.ms { background-color: #000!important; }

.sidebar .soc-btn { 
	display:block;
	width:100%;
}

/* ------------------------------------- 
		HEADER 
------------------------------------- */
table.head-wrap { width: 100%;background-color:#f4f5f7 !important;}

.header.container table td.logo { padding: 15px; }
.header.container table td.label { padding: 15px; padding-left:0px;}


/* ------------------------------------- 
		BODY 
------------------------------------- */
table.body-wrap { width: 100%;}


/* ------------------------------------- 
		FOOTER 
------------------------------------- */
table.footer-wrap { width: 100%;	clear:both!important;
}
.footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
.footer-wrap .container td.content p {
	font-size:10px;
	font-weight: bold;
	
}
.footer-wrap{position: relative;top: 30px;}


/* ------------------------------------- 
		TYPOGRAPHY 
------------------------------------- */
h1,h2,h3,h4,h5,h6 {
font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
}
h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }

h1 { font-weight:200; font-size: 44px;}
h2 { font-weight:200; font-size: 37px;}
h3 { font-weight:500; font-size: 27px;margin-top: 1px !important;}
h4 { font-weight:500; font-size: 23px;}
h5 { font-weight:900; font-size: 17px;}
h6 { font-weight:bold !important; font-size: 14px !important; text-transform: uppercase !important; color:#5660b1 !important;}

.collapse { margin:0!important;display:block !important;}

p, ul { 
	margin-bottom: 10px; 
	font-weight: normal; 
	font-size:14px; 
	line-height:1.6;
}
p.lead { font-size:17px; }
p.last { margin-bottom:0px;}

ul li {
	margin-left:5px;
	list-style-position: inside;
}

/* ------------------------------------- 
		SIDEBAR 
------------------------------------- */
ul.sidebar {
	background:#ebebeb;
	display:block;
	list-style-type: none;
}
ul.sidebar li { display: block; margin:0;}
ul.sidebar li a {
	text-decoration:none;
	color: #666;
	padding:10px 16px;
/* 	font-weight:bold; */
	margin-right:10px;
/* 	text-align:center; */
	cursor:pointer;
	border-bottom: 1px solid #777777;
	border-top: 1px solid #FFFFFF;
	display:block;
	margin:0;
}
ul.sidebar li a.last { border-bottom-width:0px;}
ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}



/* --------------------------------------------------- 
		RESPONSIVENESS
		Nuke it from orbit. It's the only way to be sure. 
------------------------------------------------------ */

/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
.container {
	display:block!important;
	max-width:600px!important;
	margin:0 auto!important; /* makes it centered */
	clear:both!important;
}

/* This should also be a block element, so that it will fill 100% of the .container */
.content {
	padding:15px;
	max-width:600px;
	margin:0 auto;
	display:block; 
}

/* Let's make sure tables in the content area are 100% wide */
.content table { width: 100%; }


/* Odds and ends */
.column {
	width: 300px;
	float:left;
}
.column-wrap { 
	padding:0!important; 
	margin:0 auto; 
	max-width:600px!important;
}
.column table { width:100%;}
.social .column {
	width: 280px;
	min-width: 279px;
	float:left;
}

/* Be sure to place a .clear element after each set of columns, just to be safe */
.clear { display: block; clear: both; }


/* ------------------------------------------- 
		PHONE
		For clients that support media queries.
		Nothing fancy. 
-------------------------------------------- */


@media (min-width: 320px) and (max-width:320px){
	
.removepadd{padding: 0px !important;}
.border{border:2px solid #f98a2d;}
.womens{font-weight: bold;font-size:13px !important;position: relative;top: 0px !important; }
.product{font-size: 13px !important;position: relative;top:0px !important;text-decoration:underline;color: #551a8b !important ;}
.mybtnccls{font-size:10px;}	
}
@media (min-width: 360px) and (max-width:360px){
	
.removepadd{padding: 0px !important;}
.border{border:2px solid #f98a2d;}
.womens{font-weight: bold;font-size:13px !important;position: relative;top: 0px !important; }
.product{font-size: 13px !important;position: relative;top:0px !important;text-decoration:underline;color: #551a8b !important ;}
.mybtnccls{font-size:10px;}		
}



@media only screen and (max-width: 600px) {
	
	a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}

	div[class="column"] { width: auto!important; float:none!important;}
	
	table.social div[class="column"] {
		width:auto!important;
	}

}
@media (min-width: 320px) and (max-width:768px){
.menutxtstl{color:#f58634 !important; font-size:11px !important; }
.latcls{font-size:11px !important; line-height:1;}
.mybtnccls{font-size:12px; height:40px !important;} 
}
@media (min-width: 1000px)
 {

.latcls{font-size:13px !important;}
.mybtnccls{font-size:14px;}
 }


.removepadd{padding: 0px !important;}
.border{border:2px solid #f98a2d;}
.womens{font-weight: bold;font-size:15px;position: relative;top: 0px; }
.product{font-size: 15px;position: relative;top:10px;text-decoration:underline;color: #551a8b !important;}
.bor-bottom{font-size: 20px;background: white;border-right: 1px solid #ddd; }
.highlight{position: relative;top:20px;}
.topbor{border-top:1px solid #ddd !important; }
.socborder{border:1px solid #ddd;}
.contact{float:right !important;margin:0px -13px 0px -7px !important; }
.border1{border: 1px solid #ddd ;}
.top{position: relative;top:25px;}
.bortop{border-top: 1px solid #ddd;border-bottom: 1px solid #ddd;}
.borbot{border-bottom: 1px solid #ddd;}
.borcolor{background:#f9f9f9;}
.padd{padding: 9px;position: relative;left: -7px;}
.pro-high{font-size: 20px;}
.lefticon{margin-left:5px;}
img.bottom {
    vertical-align: middle;
} 
.menustl{padding-left:5px; padding-right:5px; text-align:center; }
.menutxtstl{color:#f58634 !important; font-size:14px; }


 </style>

</head>
<body bgcolor="#FFFFFF" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none;height: 100%;width: 100%!important;">

<!-- HEADER -->
<table class="head-wrap" bgcolor="#FFF " style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;background-color: #FFF !important;">
	<tr style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
		<td style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
		<td class="header container" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;display: block!important;max-width: 600px!important;margin: 0 auto!important;clear: both!important;">
			
				<div class="content" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 15px;max-width: 600px;margin: 0 auto;display: block;">
					<table style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;">
					<tr style="text-align:center; font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
						<td align="center" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; text-align:center;"><img src="<?php echo CurrentHost; ?>/image/data/lo2logo.png" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 100%; margin-bottom:10px !important;"></td>
						
					</tr>

<!--<tr> 
<td style="text-align:center;"><img src="<?php echo CurrentHost; ?>/image/phone.png" class="bottom" style="width: 30px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; vertical-align: middle;" ><strong style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; ">+91-9176870701</strong>       
&nbsp;&nbsp;/&nbsp;&nbsp;   	
<img src="<?php echo CurrentHost; ?>/image/mail.png" class="bottom" style="width: 30px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; vertical-align: middle;" /><strong style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><a style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #0030f6 !important;">order@footlounge.in</a></strong></td>  -->
<!--
<td  style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; text-align:center;"><img src="<?php echo CurrentHost; ?>/image/phone.png" class="" style="width: 30px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;" ><span><strong style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">+91-9176870701</strong></span>&nbsp;&nbsp;&nbsp;&nbsp;   
               <img src="<?php echo CurrentHost; ?>/image/mail.png" class="" style="width: 30px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;" /><span> <strong style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><a href="email.php" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #0030f6 !important;">order@footlounge.in</a></strong></span></td>
--> 

              <!-- </tr>       -->




<!--<tr  align="center" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
						<td  align="center" style="width:900px !important; font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">


<a href="http://facebook.com/footlounge.online" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #0030f6 !important;"><img src="<?php echo CurrentHost; ?>/image/data/Social%20Icons/facebook.png" style="width: 44px;height: 44px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 100%; "></a>
<a href="https://twitter.com/go_footlounge" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #0030f6 !important;"><img style="width: 44px;height: 44px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 100%;margin-left: 5px;" src=" <?php echo CurrentHost; ?>/image/data/Social%20Icons/twitter.png " class="lefticon"></a>
<a href="https://www.instagram.com/go_footlounge" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #0030f6 !important;"><img src=" <?php echo CurrentHost; ?>/image/data/Social%20Icons/instagram.png" class="lefticon" style="width: 44px;height: 44px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 100%;margin-left: 5px;"></a>
<a href="https://www.youtube.com/c/adidas" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #0030f6 !important;"><img src="<?php echo CurrentHost; ?>/image/data/Social%20Icons/youtube.png" class="lefticon" style="width: 44px;height: 44px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 100%;margin-left: 5px;"></a><a href="https://in.pinterest.com/footloungeindia/" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #0030f6 !important;"><img src="<?php echo CurrentHost; ?>/image/data/Social%20Icons/pinterest.png" class="lefticon" style="width: 44px;height: 44px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 100%;margin-left: 5px;"></a><a href="http://blog.footlounge.in/" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #0030f6 !important;"><img src="<?php echo CurrentHost; ?>/image/data/Social%20Icons/blogger-icon.png" class="lefticon" style="width: 44px;height: 44px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 100%;margin-left: 5px;"></a>


</td>
blogger-icon.png
</tr> -->





				</table>
				</div>
				
		</td>

		<td style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
	</tr>
</table><!-- /HEADER -->


<!-- BODY --> 
<table class="body-wrap" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;">
	<tr style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
		<td style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
		<td class="container" bgcolor="#FFFFFF" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;display: block!important;max-width: 600px!important;margin: 0 auto!important;clear: both!important;">

			<div class="content" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 15px;max-width: 600px;margin: 0 auto;display: block;">

                        <!---table for menu display-->
                        <table style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%; height:40px; background:#FFF;">
				<tr style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
					<td class="menustl" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; "><a class="menutxtstl" href="<?php echo CurrentHost; ?>/new-arrivals"><span class="menu-title">NEW ARRIVALS</span></a></td>

                                        <td class="menustl" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; "><a class="menutxtstl" href="<?php echo CurrentHost; ?>/men"><span class="menu-title">MEN</span></a></td>

                                        <td class="menustl" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; "><a class="menutxtstl" href="<?php echo CurrentHost; ?>/women"><span class="menu-title">WOMEN</span></a></td>

                                        <td class="menustl" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; "><a class="menutxtstl" href="<?php echo CurrentHost; ?>/kids"><span class="menu-title">KIDS</span></a></td>

                                        <td class="menustl" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; "><a class="menutxtstl" href="<?php echo CurrentHost; ?>/brands"><span class="menu-title">BRANDS</span></a></td>

                                        <td class="menustl" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; "><a class="menutxtstl" href="<?php echo CurrentHost; ?>/deals"><span class="menu-title">DEALS</span></a></td>

                                      <!--  <td class="menustl" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; "><a class="menutxtstl" href="<?php echo CurrentHost; ?>/travel-needs"><span class="menu-title">TRAVEL NEEDS</span></a></td> -->
                                </tr>
                        </table>

                         
			<table style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%; margin-top:20px;">
				<tr style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
					<td style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
						
						<h3 style="font-family: &quot;HelveticaNeue-Light&quot;, &quot;Helvetica Neue Light&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 500;font-size: 14px;margin-top: 1px !important;">Dear changecustomername,</h3>
						<!--<p class="lead" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6;">Thank you for visiting <a href="<?php echo CurrentHost; ?>/" style="text-decoration:none;">www.footlounge.in</a> .We have received your Request to be notified when the below product is back IN STOCK. You will be the first to know when this or similar item is back in our shelves!</p> -->

                                          <table class="border col-xs-12 col-sm-12 col-md-12 removepadd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 2px solid  #8ce3e1;width: 100%;padding: 0px !important;height:150px; background: #8ce3e1; padding:5%;">
						<tbody style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
						<!--<tr width="100%" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><td style="padding:2%;"><h3 style=" margin-bottom:0px;">Extra Sweet Deal Just For You</h3></td>
</tr> -->
<!--<tr width="100%" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><td style="text-align:center;"><h4>Take an additional ndispercent OFF - JUST FOR TODAY!</h4></td> </tr>-->
<tr width="100%" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><td style="text-align:center;"><marquee direction="left" SCROLLDELAY=500 behavior="alternate"><h5 style="font-size: 19px; line-height: 30px; font-family:Arial;">Your Favourite is just a click away.<br/> Use coupon code below to know how much you save <br/> OFFER REMAINS VALID JUST FOR TODAY.</h5></marquee></td>
</tr>  
<tr width="100%" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><td style="text-align:center;"><h5>USE CODE : ndiscode</h5></td> 
</tr> 
</tbody></table> 
<p style="position:relative; top:15px; font-weight:bold; margin-top:10px; margin-bottom:10px; text-align:center;">SHOPPING BAG</p> 
abusershoppingbag
<!--<table class="table table-bordered border col-xs-12 col-sm-12 col-md-12 removepadd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;padding: 0px !important; padding:5%; margin-top:12px;">
<thead>
<tr style="background:#f0f0c3; "><th>Product Image</th><th>Name</th><th>Quantity</th><th>Price</th><th>Total</th></tr>
</thead>
						<tbody style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
						<tr width="100%" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><td style="text-align:left;"></td>
<td style="text-align:left; width:40%;"><p>Nike Downshifter 6 Msl Grey Running Shoes</p>
<p><span>- Size : 8</span></p>
</td>
<td style="text-align:left;">*1</td>
<td style="text-align:left;">Rs.5289</td> 
<td style="text-align:left;">Rs.5289</td>
</tr>
<tr style="background:#f0f0c3; "><td colspan="4" align="right">Sub-Total : </td><td style="float:right;">Rs.5289</td></tr>
<tr style="background:#f0f0c3; "><td colspan="4" align="right">Total : </td><td style="float:right;">Rs.5289</td></tr>
</tbody></table> -->  
  
<table class="col-xs-12 col-sm-12 col-md-12 removepadd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;padding: 0px !important; padding:5%; margin-top:12px; margin-bottom:20px;">
<tbody><tr><td align="center" style="text-align:center"><a href="checkoutnowbtnval"><input type="button" value="Checkout Now" style="height:30px; width:150px; background:#f58634; color:#FFF; font-size:18px; cursor:pointer;"></a></td></tr></tbody>
</table>  

<p style="text-align:center;"><b> YOU MAY LIKE</b></p>

nhotpicksforyou
<!--<table class="col-xs-12 col-sm-12 col-md-12 removepadd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;padding: 0px !important; padding:5%; margin-top:12px; margin-bottom:50px;">

<tbody style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
<tr width="100%" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><td style="text-align:left;"></td>
<td class="col-md-3"><p><img src="<?php echo CurrentHost; ?>/image/cache/data/Nike Shoes/684658030 Nike Downshifter 6 Msl Grey Running Shoes/Nike Downshifter 6 Msl grey Running Shoes 1-453x397.jpg" style="max-width:92px" title="nike downshifter 6 msl grey running shoes" alt="nike downshifter 6 msl grey running shoes" data-zoom-image="<?php echo CurrentHost; ?>/image/cache/data/Nike Shoes/684658030 Nike Downshifter 6 Msl Grey Running Shoes/Nike Downshifter 6 Msl grey Running Shoes 1-630x552.jpg" class="product-image-zoom img-responsive"><br/>Nike Downshifter 6 Msl Grey Running Shoes</p>
<p><span>Rs.4200</span></p>
<button style="height:30px; width:100%; background:#f58634;"><a style="color:#FFF !important;">Shop Now</a></button>
</td>
<td class="col-md-3"><p><img src="<?php echo CurrentHost; ?>/image/cache/data/Nike Shoes/684658030 Nike Downshifter 6 Msl Grey Running Shoes/Nike Downshifter 6 Msl grey Running Shoes 1-453x397.jpg" style="max-width:92px" title="nike downshifter 6 msl grey running shoes" alt="nike downshifter 6 msl grey running shoes" data-zoom-image="<?php echo CurrentHost; ?>/image/cache/data/Nike Shoes/684658030 Nike Downshifter 6 Msl Grey Running Shoes/Nike Downshifter 6 Msl grey Running Shoes 1-630x552.jpg" class="product-image-zoom img-responsive"><br/>Nike Downshifter 6 Msl Grey Running Shoes</p>
<p><span>Rs.3200</span></p>
<button style="height:30px; width:100%; background:#f58634;"><a style="color:#FFF !important;">Shop Now</a></button>
</td>
<td class="col-md-3"><p><img src="<?php echo CurrentHost; ?>/image/cache/data/Nike Shoes/684658030 Nike Downshifter 6 Msl Grey Running Shoes/Nike Downshifter 6 Msl grey Running Shoes 1-453x397.jpg" style="max-width:92px" title="nike downshifter 6 msl grey running shoes" alt="nike downshifter 6 msl grey running shoes" data-zoom-image="<?php echo CurrentHost; ?>/image/cache/data/Nike Shoes/684658030 Nike Downshifter 6 Msl Grey Running Shoes/Nike Downshifter 6 Msl grey Running Shoes 1-630x552.jpg" class="product-image-zoom img-responsive"><br/>Nike Downshifter 6 Msl Grey Running Shoes</p>
<p><span>Rs.2200</span></p>
<button style="height:30px; width:100%; background:#f58634;"><a style="color:#FFF !important;">Shop Now</a></button>
</td>
<td class="col-md-3"><p><img src="<?php echo CurrentHost; ?>/image/cache/data/Nike Shoes/684658030 Nike Downshifter 6 Msl Grey Running Shoes/Nike Downshifter 6 Msl grey Running Shoes 1-453x397.jpg" style="max-width:92px" title="nike downshifter 6 msl grey running shoes" alt="nike downshifter 6 msl grey running shoes" data-zoom-image="<?php echo CurrentHost; ?>/image/cache/data/Nike Shoes/684658030 Nike Downshifter 6 Msl Grey Running Shoes/Nike Downshifter 6 Msl grey Running Shoes 1-630x552.jpg" class="product-image-zoom img-responsive"><br/>Nike Downshifter 6 Msl Grey Running Shoes</p>
<p><span>Rs.6200</span></p>
<button style="height:30px; width:100%; background:#f58634;"><a style="color:#FFF !important;">Shop Now</a></button>
</td>
</tr>

</tbody></table> -->

<table bgcolor="#FFF" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;">
					<tr> 
<td style="text-align:center;"><img src="<?php echo CurrentHost; ?>/image/phone.png" class="bottom" style="width: 30px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; vertical-align: middle;" ><strong style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; ">+91-9176870701</strong>       
&nbsp;&nbsp; / &nbsp;&nbsp;   	
<img src="<?php echo CurrentHost; ?>/image/mail.png" class="bottom" style="width: 30px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; vertical-align: middle;" /><strong style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><a style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #0030f6 !important;">order@footlounge.in</a></strong></td>
<!--
<td  style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif; text-align:center;"><img src="<?php echo CurrentHost; ?>/image/phone.png" class="" style="width: 30px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;" ><span><strong style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">+91-9176870701</strong></span>&nbsp;&nbsp; &nbsp;&nbsp;   
               <img src="<?php echo CurrentHost; ?>/image/mail.png" class="" style="width: 30px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;" /><span> <strong style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><a href="email.php" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #0030f6 !important;">order@footlounge.in</a></strong></span></td>
--> 

              </tr>    


<tr  align="center" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
						<td  align="center" style="width:900px !important; font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">


<a href="http://facebook.com/footlounge.online" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #0030f6 !important;"><img src="<?php echo CurrentHost; ?>/image/data/Social%20Icons/facebook.png" style="width: 44px;height: 44px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 100%; "></a>
<a href="https://twitter.com/go_footlounge" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #0030f6 !important;"><img style="width: 44px;height: 44px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 100%;margin-left: 5px;" src=" <?php echo CurrentHost; ?>/image/data/Social%20Icons/twitter.png " class="lefticon"></a>
<a href="https://www.instagram.com/go_footlounge" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #0030f6 !important;"><img src=" <?php echo CurrentHost; ?>/image/data/Social%20Icons/instagram.png" class="lefticon" style="width: 44px;height: 44px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 100%;margin-left: 5px;"></a>
<!--<a href="https://www.youtube.com/c/adidas" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #0030f6 !important;"><img src="<?php echo CurrentHost; ?>/image/data/Social%20Icons/youtube.png" class="lefticon" style="width: 44px;height: 44px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 100%;margin-left: 5px;"></a>--><a href="https://in.pinterest.com/footloungeindia/" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #0030f6 !important;"><img src="<?php echo CurrentHost; ?>/image/data/Social%20Icons/pinterest.png" class="lefticon" style="width: 44px;height: 44px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 100%;margin-left: 5px;"></a><a href="http://blog.footlounge.in/" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #0030f6 !important;"><img src="<?php echo CurrentHost; ?>/image/data/Social%20Icons/blogger-icon.png" class="lefticon" style="width: 44px;height: 44px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 100%;margin-left: 5px;"></a>


</td>

</tr> 





				</table>






						
						<!-- A Real Hero (and a real human being) -->

						<!--<table class="border col-xs-12 col-sm-12 col-md-12 removepadd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 2px solid #f98a2d;width: 100%;padding: 0px !important;">
						<tbody style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
						<tr width="100%" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
					    <td width="25%" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
					    <img src="changeproductimage" alt="" width="150" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 100%;"></td>

					    <td width="75%" class="womens" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;font-weight: bold;font-size: 14px;position: relative;top: 0px;">changeproductname<br style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
						<a href="changeproductlink" class="product" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;font-size: 14px;position: relative;top: 10px;text-decoration: underline;color: #551a8b !important;">Click here to view this product</a>
						</td>


						</tr>
						</tbody>
						</table>-->

						<!--<p>reqproductsize</p>

						<table style="font-size:14px;position:relative;top:10px;padding:9px; margin-bottom:10px;"><th >Product Highlight:</th></table> 

						changeproducthighlight  -->

						<!-- Callout Panel -->
<!--<table class="border1 top " cellspacing="10" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ddd;position: relative;top: 25px;width: 100%;">

      <tr style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
          <th class="padd pro-high" align="left" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 9px;position: relative;left: -7px;font-size: 20px;">
          Product Highlight:</th><th style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></th>
       
      </tr>
      <tr class="bortop" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border-top: 1px solid #ddd;border-bottom: 1px solid #ddd;">

        <th class="padd" align="left" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 9px;position: relative;left: -7px;">Type</th>
        <th class="padd" align="left" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 9px;position: relative;left: -7px;">Runnin shoes</th>
      </tr>
      <tr class="borbot borcolor" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border-bottom: 1px solid #ddd;background: #f9f9f9;">
        <td class="padd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 9px;position: relative;left: -7px;">Material(upper)</td>
        <td class="padd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 9px;position: relative;left: -7px;">Mesh</td>
      </tr>
      <tr class="borbot" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border-bottom: 1px solid #ddd;">
        <td class="padd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 9px;position: relative;left: -7px;">Material(sole)</td>
        <td style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">Rubber</td>
      
      </tr><tr class="borbot borcolor" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border-bottom: 1px solid #ddd;background: #f9f9f9;">
        <td class="padd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 9px;position: relative;left: -7px;">Closing</td>
        <td class="padd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 9px;position: relative;left: -7px;">Lace-up</td>
      </tr>
      <tr class="borbot" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border-bottom: 1px solid #ddd;">
        <td class="padd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 9px;position: relative;left: -7px;">Ankle Height</td>
        <td class="padd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 9px;position: relative;left: -7px;">Low Ankle</td>
      </tr>
      <tr class="borbot borcolor" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border-bottom: 1px solid #ddd;background: #f9f9f9;">
        <td class="padd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 9px;position: relative;left: -7px;">Brand</td>
        <td class="padd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 9px;position: relative;left: -7px;">Reebok</td>
      </tr>
      <tr class="borbot" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border-bottom: 1px solid #ddd;">
        <td class="padd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 9px;position: relative;left: -7px;">Product ID/Code</td>
        <td class="padd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 9px;position: relative;left: -7px;">AR0984</td>
      </tr>
      <tr class="borbot borcolor" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border-bottom: 1px solid #ddd;background: #f9f9f9;">
        <td class="padd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 9px;position: relative;left: -7px;">Model Name</td>
        <td class="padd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 9px;position: relative;left: -7px;">Reebok Ultra Speed</td>
      </tr>
      <tr style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
        <td class="padd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 9px;position: relative;left: -7px;">Product Warranty</td>
        <td class="padd" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 9px;position: relative;left: -7px;">3 Months against manufacturing defects</td>
      </tr>
     
</table>---->


						<!-- /Callout Panel -->
					<!--	<table class="clearfix" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;"></table> -->
									
												
						<!-- social & contact -->
						<!--<table class="social " width="100%" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;position: relative;top: 20px;background-color: #ebebeb;width: 100%;margin-top:30px;">
							<tr style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
								<td style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
									
									
									
									<table align="right" class="column contact" style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 533px;float: right !important;min-width: 279px;">
										<tr style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
											<td style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;padding: 15px;">				
												
												<h5 class="" style="font-family: &quot;HelveticaNeue-Light&quot;, &quot;Helvetica Neue Light&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 900;font-size: 14px; line-height: 1.6; margin:0px !important;"></h5>
												
<a href="<?php echo CurrentHost; ?>/adidas-shoes-online" class="anchor_detail" style="margin-right:5px; font-size:14px;">Shop Adidas</a>|
<a href="<?php echo CurrentHost; ?>/reebok-shoes-online" class="anchor_detail" style="margin-right:5px; font-size:14px;">Shop Reebok</a>|
<a href="<?php echo CurrentHost; ?>/nike-shoes-online" class="anchor_detail" style="margin-right:5px; font-size:14px;">Shop Nike  </a>|
<a href="<?php echo CurrentHost; ?>/puma-shoes-online" class="anchor_detail" style="margin-right:5px; font-size:14px;">Shop Puma   </a>|
<a href="<?php echo CurrentHost; ?>/footlounge-sports-clothing-online" class="anchor_detail" style="margin-right:5px; font-size:14px;">Shop Footlounge</a>
											</td>
										</tr>
									</table> --><!-- /column 2 -->
									
								<!--</td>
							</tr>
						</table>--><!-- /social & contact -->  
					
 

					
					<!--</td>
				</tr>
			</table>
			</div>
									
		</td>
		<td style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
	</tr>
</table>--><!-- /BODY -->

				
		</td>
		<td style="font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
	</tr>
</table><!-- /FOOTER -->

</body>
</html>