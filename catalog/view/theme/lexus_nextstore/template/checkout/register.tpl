<div class="row">
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<!--<h2><?php echo $text_your_details; ?></h2> -->
		<span class="required">*</span> <?php echo $entry_firstname; ?><br />
		<input type="text" name="firstname" value="" class="large-field" />
		<br />
		<br />
		<span class="required">*</span> <?php echo $entry_lastname; ?><br />
		<input type="text" name="lastname" value="" class="large-field" />
		<br />
		<br />
		<span class="required">*</span> <?php echo $entry_email; ?><br />
		<input type="text" name="email" value="<?php if(isset($this->session->data['newuserid'])) echo $this->session->data['newuserid']; ?>" class="large-field" />
		<br />
		<br />
		   <span class="required">*</span> <?php echo $entry_phone;?><br />
		<input type="text" name="mobile" value="" class="large-field" />
		<br />
		<br />
		
		<!--<?php //echo $entry_fax; ?><br />
		<input type="text" name="fax" value="" class="large-field" />
		<br />
		<br /> -->
		<h2><?php echo $text_your_password; ?></h2>
		<span class="required">*</span> <?php echo $entry_password; ?><br />
		<input type="password" name="password" value="" class="large-field" />
		<br />
		<br />
		<span class="required">*</span> <?php echo $entry_confirm; ?> <br />
		<input type="password" name="confirm" value="" class="large-field" />
		<br />
		<br />
		<br />
	</div>


	<div class="col-lg-6 col-sm-6 col-xs-12">
		<!--<h2><?php echo $text_your_address; ?></h2> -->
		<!--<?php echo $entry_company; ?><br />
		<input type="text" name="company" value="" class="large-field" />
		<br />
		<br />--> 
		<!--<span class="required">*</span> --> <?php echo $entry_telephone; ?><br />
		<input type="text" name="telephone" value="" class="large-field" />
		<br />
		<br />
		<div style="display: <?php echo (count($customer_groups) > 1 ? 'table-row' : 'none'); ?>;">
			<?php echo $entry_customer_group; ?><br />
			<?php foreach ($customer_groups as $customer_group) { ?>
			<?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
			<input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>" id="customer_group_id<?php echo $customer_group['customer_group_id']; ?>" checked="checked" />
			<label for="customer_group_id<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></label>
			<br />
			<?php } else { ?>
			<input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>" id="customer_group_id<?php echo $customer_group['customer_group_id']; ?>" />
			<label for="customer_group_id<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></label>
			<br />
			<?php } ?>
			<?php } ?>
			<br />
		</div>

		<!--<div id="company-id-display"><span id="company-id-required" class="required">*</span> <?php echo $entry_company_id; ?><br />
			<input type="text" name="company_id" value="" class="large-field" />
			<br />
			<br />
		</div>
		
		<div id="tax-id-display"><span id="tax-id-required" class="required">*</span> <?php echo $entry_tax_id; ?><br />
			<input type="text" name="tax_id" value="" class="large-field" />
			<br />
			<br />
		</div>-->
		<span class="required">*</span> <?php echo $entry_address_1; ?><br />
		<input type="text" name="address_1" value="" class="large-field" />
		<br />
		<br />  
     
		<span class="required">*</span> <?php echo $entry_postcode; ?><br />
		<input type="text" name="postcode" value="<?php if($postcode)echo $postcode; else { if(isset($this->session->data['user_zipcode'])) echo $this->session->data['user_zipcode']; } ?>" class="large-field" onchange="getchangedvalues();" />
		<br/>
		
		<!------------hidden field for country state city------>
		<input type="hidden" name="city" value="" class="large-field" />
		<input name="country_id" type="hidden" class="large-field" value='99' /> 
		<input type="hidden" name="zone_id" class="large-field" /> 
		<div id="resppincodecont" style="display:none; ">
		 
<br />
		<br />
		<span class="lbladdress">CITY :</span> &nbsp; <span id="respcity"></span>
		<br />
		<br />
		<span class="lbladdress">STATE :</span> &nbsp; <span id="respstate"></span>
		</div>
		<!--<br />
		<br /> 
		<span class="required">*</span> <?php echo $entry_city; ?><br />
		<input type="text" name="city" value="" class="large-field" />
		<br />
		<br />
		
		<span class="required">*</span> <?php echo $entry_country; ?><br />
		<select name="country_id" class="large-field">
			<option value=""><?php echo $text_select; ?></option>
			<?php foreach ($countries as $country) { ?>
			<?php if ($country['country_id'] == $country_id) { ?>
			<option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
			<?php } else { ?>
			<option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
			<?php } ?>
			<?php } ?>
		</select>
		<br />
		<br />
		<span class="required">*</span> <?php echo $entry_zone; ?><br />
		<select name="zone_id" class="large-field"></select>
		<br />
		<br />
		<br />-->
	</div>	
</div>	

	
<div class="checkbox" style="clear: both; padding-top: 15px; border-top: 1px solid #e2e2e2;">	
	<label for="newsletter">
		<?php echo $entry_newsletter; ?>
		<input type="checkbox" name="newsletter" value="1" id="newsletter" />
	</label>
	<br />
	<?php if ($shipping_required) { ?>	
	<label for="shipping">
		<?php //echo $entry_shipping; ?>
		<input type="hidden" name="shipping_address" value="1" id="shipping" />
	</label>
	<br />
	<?php } ?>
	<!--<br />
	<br />-->	
</div>

<!--<p>Would you like to receive SMS alert for this Order? &nbsp;
    <?php if($smsalertcode=='' || $smsalertcode==1) { ?>
    <input type="radio" value="1" name="smsalert" checked="checked">Yes &nbsp; <input type="radio" value="0" name="smsalert">No</p>
    <?php } else { ?>
    <input type="radio" value="1" name="smsalert">Yes &nbsp; <input type="radio" value="0" name="smsalert" checked="checked">No</p>
    <?php } ?>-->
    
<?php if ($text_agree) { ?>
	<div class="buttons">
		<div class="right">
			<?php echo $text_agree; ?>
			<input type="checkbox" name="agree" value="1" />
			<input type="button" value="<?php echo $button_continue; ?>" id="button-register" class="button btn btn-theme-default" />
		</div>
	</div>
<?php } else { ?>
	<div class="buttons">
		<div class="right">
			<input type="button" value="<?php echo $button_continue; ?>" id="button-register" class="button btn btn-theme-default" />
		</div>
	</div>
<?php } ?>


<script type="text/javascript">
<!--
$('#payment-address input[name=\'customer_group_id\']:checked').live('change', function() {
	var customer_group = [];
	
<?php foreach ($customer_groups as $customer_group) { ?>
	customer_group[<?php echo $customer_group['customer_group_id']; ?>] = [];
customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_display'] = '<?php echo $customer_group['company_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_required'] = '<?php echo $customer_group['company_id_required']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_display'] = '<?php echo $customer_group['tax_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_required'] = '<?php echo $customer_group['tax_id_required']; ?>';
<?php } ?>	

	if (customer_group[this.value]) {
		if (customer_group[this.value]['company_id_display'] == '1') {
			$('#company-id-display').show();
		} else {
			$('#company-id-display').hide();
		}
		
		if (customer_group[this.value]['company_id_required'] == '1') {
			$('#company-id-required').show();
		} else {
			$('#company-id-required').hide();
		}
		
		if (customer_group[this.value]['tax_id_display'] == '1') {
			$('#tax-id-display').show();
		} else {
			$('#tax-id-display').hide();
		}
		
		if (customer_group[this.value]['tax_id_required'] == '1') {
			$('#tax-id-required').show();
		} else {
			$('#tax-id-required').hide();
		}	
	}
});

$('#payment-address input[name=\'customer_group_id\']:checked').trigger('change');
//-->
</script> 

<script type="text/javascript">
<!--
$('#payment-address select[name=\'country_id\']').bind('change', function() {
	if (this.value == '') return;
	$.ajax({
		url: 'index.php?route=checkout/checkout/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('#payment-address select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/image/loading.gif" alt="loading" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#payment-postcode-required').show();
			} else {
				$('#payment-postcode-required').hide();
			}
			
			html = '<option value=""><?php echo $text_select; ?></option>';
			
			if (json['zone'] != '') {

				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
	      				html += ' selected="selected"';
	    			}
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('#payment-address select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#payment-address select[name=\'country_id\']').trigger('change');
//-->
</script> 

<script type="text/javascript">


<!--
$('.colorbox').colorbox({
	width: 640,
	height: 480
});
//-->
</script> 
<script>
$( document ).ready(function() {
	
	getchangedvalues();
   });  
function getchangedvalues()
{
 var zip = '<?php if(isset($this->session->data['user_zipcode'])){ echo $this->session->data['user_zipcode'];  }  ?>'; 
var newzip=document.getElementsByName("postcode")[0].value; 
	 
if(zip!=newzip)
{
	zip=newzip; 
} 
	 if(zip != '')
	 {

	  $.ajax({
              type: "POST",
             
              url: 'index.php?route=common/home/getstatecity/', 
              data:
              {
              	zipcode:zip,                               
              },
              success: function(resp){
              if(resp !=0){
              var jsonresp=JSON.parse(resp);   

              document.getElementsByName("city")[0].value=jsonresp.city; 
               $("#resppincodecont").show(); 
                $("#respcity").html(jsonresp.city) ;
                $("#respstate").html(jsonresp.state); 
                         
              $.ajax({
              type: "POST",             
              url: 'index.php?route=common/home/getstatecodeinfo/', 
              data:
              {
              	
              	statename:jsonresp.state,                               
              },
              success: function(respnew){
              	if(respnew !=0 ){
              	document.getElementsByName("zone_id")[0].value=respnew; } 
              	
              }
              });
              }
              else{
               $("#resppincodecont").hide(); 
              	 document.getElementsByName("city")[0].value="";
              	 document.getElementsByName("zone_id")[0].value="";    
              }	

              }
        });
      } 
      }
	</script>
	<script type="text/javascript">

        $(document).ready(function() {
        	
           $("input[name=mobile]").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

            $("input[name=telephone]").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
            
        } );
</script>