<?php 
include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Track Order</title>
  <link href="catalog/view/theme/lexus_nextstore/stylesheet/bootstrap.min.css" rel="stylesheet" />
   <style>

@media (min-width: 320px) and (max-width: 767px) {
.maindiv{ height:500px; width:100%;}
.tracksubcls{ margin-left:3%; height:60px; width:120px; border:2px solid #f39c12; float: left; border-radius: 5px; margin-top: 10.5%; font-size: 24px; background-color: #f39c12; color:#FFF;}
.trackcls{ width:85% !important; }
.loadcls{float: none !important; }
.optioncls{ width: 100% !important; float:left;}
.btnoutercls1{}
}
@media (min-width: 769px) { .maindiv{ height:500px; width:50% !important; margin: 0 auto;} }


@media (min-width: 768px) {
.maindiv{ height:500px; width:60%; margin: 0 auto;}
.tracksubcls{ height:60px;  border:2px solid #f39c12;  border-radius: 5px; margin-top: 25%; font-size: 24px; background-color: #f39c12; color:#FFF; width:100%;}
.btnoutercls1{width: 25%; margin: 0px auto;}
}
    .toppcls{ margin-top: 10%; height: 60px;}
    .trackcls{ height:60px; width:100%; border:3px solid #ccc; float: left;  border-radius:5px; font-size: 24px; color:#ccc; text-align: center;}
    
    .subdiv{ margin-top: 0%;}
    .iframestyle{width:100%; height:400px; border: 1px solid #ccc; margin-top: 40px;} 
    .loadcls{float: left; margin-left: 40%; margin-top: 5%;}   
    .optioncls{ width: 25%; float:left;  font-size: 18px;}
    .btnoutercls{ height:30px;}
    
    .txtdecorcls{text-decoration: none; }
    .subdiv div{ padding: 10px;}


   </style>
   <script type="text/javascript" src="<?php echo CurrentHost; ?>/catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
</head>


<body>

     <div class="maindiv">
       <div class="subdiv">
      <div>

        <form id="myForm">
                  <p class="toppcls">
                 <input type="text" id="trackid" name="trackid" class="trackcls" placeholder="Enter Tracking Number">
                 </p>
                  <br/>
<p style="font-size:14px; font-weight:bold;">Select Courier Partner</p>
                 <div class="btnoutercls">

                  <div class="optioncls"><input type="radio" name="option1" value="dtdc" checked="checked">DTDC</div><div class="optioncls"><input type="radio" name="option1" value="fedex">Fedex</div>
                 
                  <div class="optioncls"><input type="radio" name="option1" value="delhivery">Delhivery</div><div class="optioncls"><input type="radio" name="option1" value="aramex">Aramex</div>
                </div>    

                  <div class="btnoutercls1">
                    <a href="javascript:void(0);" onclick="gettrack();" class="txtdecorcls"><input type="button" id="tracksub" Value="Track" class="tracksubcls"></a>
                  </div>  

        </form> 

        <div id="frametrame"></div>


      </div>
     </div>


     </div>

 
<script>

 function gettrack()//get track
 {
   var couriercomp=$('input[name=option1]:checked', '#myForm').val();
   var trackid=$("#trackid").val(); 
   var  flag=1; 
   if(trackid==''){ flag=0; $("#trackid").css('border','2px solid #F00'); }
   else{$("#trackid").css('border','1px solid #ccc');}
   var iframetxt='';
   if(trackid){

    if(couriercomp == 'dtdc'){ iframetxt='https://track.aftership.com/dtdc/'+trackid; }
    else if(couriercomp == 'fedex'){ iframetxt='https://track.aftership.com/fedex/'+trackid; }
    else if(couriercomp == 'delhivery'){ iframetxt='https://track.aftership.com/delhivery/'+trackid; }
    else if(couriercomp == 'aramex'){ iframetxt='https://track.aftership.com/aramex/'+trackid; }
              

              $("#frametrame").html('<div class="loadcls"><img src="<?php echo CurrentHost; ?>/image/loading_spinner.gif" alt="loading..."><div>');
             $.ajax({
                    type: "POST", 
                    url: 'trackordership.php',    
                    data: { 
                      trackid:trackid
                    },
                   
                    success: function(jsonresp){

                       $("#frametrame").html('<iframe src="'+iframetxt+'" name="iframe_a" class="iframestyle"></iframe>');

                     //$("#frametrame").html(jsonresp);
                     //alert(jsonresp); 
                      // $("#frametrame").html('<iframe src="'+jsonresp+'" name="iframe_a" class="iframestyle"></iframe>');
                    }

              });  
              //$("#frametrame").html('<iframe src="'+iframetxt+'" name="iframe_a" class="iframestyle"></iframe>');  

            }

 }

</script>
</body>
</html>