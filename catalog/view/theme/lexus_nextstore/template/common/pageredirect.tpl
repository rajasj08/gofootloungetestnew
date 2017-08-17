<?php 
/******************************************************
 * @package Pav Opencart Theme Framework for Opencart 1.5.x
 * @version 1.1
 * @author http://www.pavothemes.com
 * @copyright	Copyright (C) Augus 2013 PavoThemes.com <@emai:pavothemes@gmail.com>.All rights reserved.
 * @license		GNU General Public License version 2
*******************************************************/

require( DIR_TEMPLATE.$this->config->get('config_template')."/template/common/config.tpl" );

?>
<?php $value="sdd"; ?>
<!--<div class="page-404">-->
<?php echo $header; ?> 

 

<!--------------404 content starts here-->
<section id="content404" class="content404">
<style>
.redirectrow{ margin-top:200px; min-height:250px; width:80%; margin:0 auto; }
.innerredirectrow{ margin-top: 30px; }


@media screen and (min-width: 320px) and (max-width: 767px) {
.infop{ color :#000; font-size:12px; font-weight:bold;}
.reimage{ width:100%;}
.textdiv{ text-align:center;}
}
@media screen and (min-width: 768px) and (max-width: 999px) {
.infop{ color :#000; font-size:14px; text-align:center; font-size:24px;}
.textdiv{ text-align:center;}
.reimage{ width:500px;}

}

@media screen and (min-width: 1000px) {
.infop{ color :#000; font-size:24px; margin-top:15%;}
.reimage{ width:500px;}
}

</style>

</head>
<body style=" background:#FFF;">
    <div class="container" style="border: 1px solid #ccc;">
       <div class="row redirectrow">

           <div class="col-md-12 innerredirectrow">

                  <div class="col-md-6">
                  <img src="http://testourwork.com/footlounge/image/we_will_be_back.jpg" class="reimage">
                 </div>

                 <div class="col-md-6 textdiv">
                   <p class="infop"> We are busy updating the store <br/> for you and will be back shortly.</p>
                 </div>
  
           </div>   
           
       </div>
    </div>
<?php echo $footer; ?>

<script type="text/javascript">
$( document ).ready(function() {
    $('#pav-slideshow').css('display','none');
});
</script>

</body>

</html>