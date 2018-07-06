
<style>
@media all and (max-width: 771px) {
	/* Logo for Mobile */
	.imagesize{
		width:80% !important;
		margin-top:10px !important;
	 }
}
@media all and (min-width: 771px) {
	/* Logo for Mobile */
	.imagesize{
		width:70% !important;
		margin-top:10px !important;
	 }
}
@media all and (min-width: 1001px) {
	/* Logo for Mobile */
	.imagesize{
		width:15% !important;
		margin-top:10px !important;
	 }
}
hr { margin-top:0px!important;}
.price {
	height: 40px;
    background-color: #000000d9;
    color: #FFF;
    text-align: center;
    font-size: 18px;
    padding-top: 7px;
}
.priceing
{
    padding: 5px;
    margin-bottom: 20px;  
    border: 1px solid #ddd;
    border-radius: 5px;	
}
.img {
    position: relative;
    text-align: center;
    color: white;
}

body{
	font-family: popins-regular !important;
}

.carousel-inner>.item>a>img, .carousel-inner>.item>img, .img-responsive, .thumbnail a>img, .thumbnail>img { 
	height: 200 !important;
    width: 200 !important; 
}
.arroysign
{
	margin: 17px;
	right: 23px !important;
    width: 3% !important;
    top: 40%;
    bottom: 52%;
}
.select2-container--default .select2-selection--multiple
{
    background-color: inherit !important;
}
.alert-warning{ color:#FFF !important;}	

@media only screen and (max-device-width: 480px) {
	div.rohit {
		zoom: 2.5;
	}
	span.select2-dropdown {
		zoom: 3.5;
	}
	.a{
		color:white !important;
	}	
	.tnc{
		margin-top: -18px !important;
	}
}
input[type=checkbox] {
    margin: 0px 0 0;
}	

</style>
<style>
	#country-list{list-style:none;margin-left: 1px;padding:0;width:94%; margin-top: 10px;    position: absolute;
    z-index: 1000;
    background-color: #fff;}
	#country-list li{padding-left: 10px;padding-top: 7px; background: #d8d4d41a ; border: 0px solid #bbb9b9;;top:2px}
	#country-list li:hover{background:#d8d4d4;cursor: pointer;}
	.column_column ul li, .column_helper ul li, .column_visual ul li, .icon_box ul li, .mfn-acc ul li, .ui-tabs-panel ul li, .post-excerpt ul li, .the_content_wrapper ul li{margin-bottom:0px !important}
	#search-box{border: #e2e2e2 1px solid;border-radius:4px;}
	#Content{ width:90% !important; margin-left: 5%;}
  </style>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Travel B2B HUB</title> 
	<?php echo $this->Html->css('/assets/bootstrap/css/bootstrap.min.css'); ?>
	<?php echo $this->Html->css('/assets/login/fonts/iconic/css/material-design-iconic-font.min.css'); ?>
	<?php echo $this->Html->css('/assets/login/animate/animate.css'); ?>
	<?php echo $this->Html->css('/assets/login/css-hamburgers/hamburgers.min.css'); ?>
	<?php echo $this->Html->css('/assets/login/animsition/css/animsition.min.css'); ?>
	<?php echo $this->Html->css('/assets/login/select2/select2.min.css'); ?>
	<?php echo $this->Html->css('/assets/login/daterangepicker/daterangepicker.css'); ?>
	<?php echo $this->Html->css('/assets/login/daterangepicker/daterangepicker.css'); ?>
	<?php echo $this->Html->css('/assets/login/css/util.css'); ?>
	<?php echo $this->Html->css('/assets/login/css/main.css'); ?>
	<?php echo $this->Html->css('https://fonts.googleapis.com/css?family=Raleway'); ?>
	
	<?php echo $this->Html->css('/assets/plugins/select2/select2.min.css'); ?>
	<style>
		.bgdiv { background-image: url('../webroot/assets/login/login_background.jpg'); }
		.p-b-34 { padding-bottom: 10px !important; }
		.login100-form-title { font-size:14px; }
		.wrap-login100 { background-color:#1f222db8 !important; width:420px !important; padding: 18px 55px 37px 55px; }
		.p-t-27 { padding-top: 10px; }
		.error { color: #ff9898; text-align:left; }
		.wrap-input100 {
		  //margin: 10px !important;
		}
		
	</style>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119659958-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-119659958-1');
	</script>
</head>
<body>
	<div class="limiter">
		<div class="container-login100 bgdiv">
			<div class="wrap-login100 rohit" style="width: 920px !important;">
				<center>
					<?=  $this->Html->image('/img/Travel B2B logo.png', ['style'=>'width:30%;margin-top:10px;"','class'=>'imagesize']) ?>
					<h4  style="color:#fff;margin:20px 0 0px 0;font-family:Raleway, sans-serif ;">REGISTRATION</h4>
				</center>
 			<p style="color:#ff9898 !important;"><?php echo $this->Flash->render(); ?></p>
			<br />
			<?php echo $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'register','autocomplete'=>"off"],'id'=>"UserRegisterForm",'onSubmit' => 'return getstatevalid();']); ?>
				
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Select Type">
								<select name="role_id" id="role_id" class="form-control input100" required="" style="height: 35px;margin-top: 4px;margin-bottom:0px !important;" >
									<option value="" disabled selected>User Category</option>
									<?php 
									$promotion_id=$_GET['promotion_id'];
									foreach($memberships as $membership) { 
									   $selected ='';
									   if(isset($_GET['promotion_id']) && $_GET['promotion_id']!="" && ($membership['id']==$_GET['promotion_id'])){
										$selected ='selected';
									   }
									   ?>
									<option <?php echo $selected; ?> style="color:black;" value="<?php echo  $membership['id']; ?>"><?php echo  $membership['membership_name']; ?></option>
									  <?php } ?>
								</select>
							</div>					
						</div>
						<div class="col-md-6 hoteltype" >
							<div class="wrap-input100 validate-input"  data-validate = "Company Name">
							<input class=" input100 trim_space_valid taxtboxname" required=""  id="company_name" type="text" name="company_name" >
							<span class="focus-input100 lablename" data-placeholder="Company Name" ></span></div>				
						</div>										
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-6" >
								<div class="wrap-input100 validate-input" data-validate = "First name">
									<input class="input100 trim_space_valid only_char" required="" type="text" name="first_name"/>
									<span class="focus-input100" data-placeholder="First Name"></span>
								</div>
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Last name">
									<input class="input100 trim_space_valid only_char" required="" type="text" name="last_name" />
									<span class="focus-input100" data-placeholder="Last Name"></span>
								</div>						
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Email">
								<input class="input100 trim_space_valid"  required="" type="email" name="email" id="email" />
								<span class="focus-input100" data-placeholder="Email"></span>
							</div>
						</div>
						<div class="col-md-6" style="color:white;">
							<div class="wrap-input100 validate-input" data-validate = "Contact No">
								<input class="input100 trim_space_valid"  required="" type="text"  maxlength="10" minlength="10" id="number_format" name="mobile_number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"/>
								<span class="focus-input100" data-placeholder="Contact No. (India)"></span>
							</div>										
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
							<div class="col-md-6">
								<div class="wrap-input100 validate-input" data-validate = "Password">
									<input class="input100 trim_space_valid allowdisallow" required="" type="password" name="password"  id="password"/>
									<span class="focus-input100 " data-placeholder="Password"></span>
									<label id="password_error" style="padding-top: -33px;" class="error"></label>
								</div>	
								
							</div>						
							<div class="col-md-6">
								<div class="wrap-input100 validate-input" data-validate = "Confirm Password">
									<input class="input100 trim_space_valid allowdisallow" required="" type="password" name="cpassword" id="cpassword"/>
									<span class="focus-input100 cpass" data-placeholder="Confirm Password"></span>
									<label id="Cpassword_error" style="padding-top: -33px;" class="error"></label>
								</div>
								
								
							</div>	
					</div>
				</div>
				<div class="row col-md-12">
					<div class="col-md-12">
						<div class="wrap-input100 validate-input" data-validate = "Address">
							<input class="input100 trim_space_valid"  required="" type="text" name="address"  id="address"/>
							<span class="focus-input100" data-placeholder="Address"></span>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Locality">
										<input class="input100 trim_space_valid"  required="" type="text" name="locality"  id="locality"/>
										<span class="focus-input100" data-placeholder="Locality or Village or Town"></span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "City">
								<input class=" input100 trim_space_valid city_select" required="" id="city-search-box" type="text"  name="city"  taxboxname="" noofrows="1"/>
								<span class="focus-input100" data-placeholder="Select City/Nearest City"></span>
							</div>
							<div class="suggesstion-box" style="margin-top:-37px"></div>
						</div>				
					</div>
				</div>
				<input type="hidden" name="country_id" id="country_id">
				<input type="hidden" name="city_id" id="city_id">
				<input type="hidden" name="state_id" id="state_id">
				<div class="row">
					<div class="col-md-12" style="margin-top:10px">
						<div class="col-md-6"> 
							<div class="wrap-input100 validate-input" data-validate = "Pincode">
								<input class="input100 trim_space_valid"  required=""  type="text" name="pincode" id="pincode" maxlength="6" minlength="6" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"/>
								<span class="focus-input100" data-placeholder="Pincode"></span>
								<label id="pincode_error" style="padding-top: -33px;" class="error"></label>
							</div>
						</div>	
					</div>	
				</div>
				<div class="row col-md-12">
					<div class="col-md-6">
								<div class="wrap-input100 validate-input st" data-validate = "State">
								<input readonly class="input100 trim_space_valid" type="text"  required="" id ="state_name" name="state_name" /> 
								 <span class="focus-input100" data-placeholder="State"></span>
							</div>						
						</div>
					<div class="col-md-6">
							<div class="wrap-input100 validate-input ctr" data-validate = "Country">
								<input class="input100 trim_space_valid"  required="" type="text" readonly id ="country_name" name="country_name" />
								<span class="focus-input100" data-placeholder="Country"></span>
							</div>										
						</div>	
				</div>	
				
				 
								
				<div class="row col-md-12">
					<div class="col-md-12 preferenceStateDiv" id="preferenceStateDiv">
						<div class="mt" tooltip="Select upto 5 states">
							<div class="wrap-input100 validate-input">
								<span for="Preference_States"  style="color:#fff;font-size:16px !important;">States where you operate</span>
								
								<div class="input-field">
									<?php echo $this->Form->control('preference', ["id"=>"preference", "type"=>"select", 'options' =>$allStates, "multiple"=>true , "class"=>"form-control focus-input100 chosen-select ", "data-placeholder"=>"Select upto 5 states where you operate", "style"=>"height:100px;"]); ?>
									<span style="display:none" class="helpblock error" id="oprateerror" style="text-align:left !important;" > This field is required.</span>
								</div>
							</div>
						</div>
					</div>					
				</div>
				<div class="row col-md-12">
					<div class="col-md-12">
						<div class="contact100-form-checkbox col-md-12">
						<table>
							<tr>
								<td>
									<input class="chk_input tnc"  id="ckb1" type="checkbox" required  name="remember-me">
								</td>	
								<td  >	
									<span class="" for="ckb1" style="color:white;margin-left:20px !important;">
										I accept the <a style="color:white;" target="_blank"  href="http://www.travelb2bhub.com/privacy-policy/"><u>Privacy Policy</u></a> and <a style="color:white;" target="_blank"  href="http://www.travelb2bhub.com/terms-and-conditions/"><u>Terms & Conditions</a></u>
									</span><br>
									
								</td>
							</tr>
							<tr>
								<td colspan="2"><span id="chk_cond" style="color:rgb(255, 152, 152); display:none;display: inline;">Please accept Terms & Conditions and Privacy Policy</span></td>
							</tr>
						</table>	
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-xs-12" align="center">
						<input type="submit" class="btn btn-primary sb"   value="Register">
					</div>
				</div><br><br>
				<div class="col-md-12 text-center" style="margin-top: 20px;">
					<p style="color:#fff;">Do you have an account ?
						<a class="txt1" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'login')) ?>" style="color:#5ba7a4;font-size:19px;" >
							Sign in
						</a>
					</p>
				</div>		 
		</div>
	</div>
	<div id="dropDownSelect1"></div>
</body>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php echo $this->Html->script('/assets/login/animsition/js/animsition.min.js'); ?>
<?php echo $this->Html->script('/assets/login/bootstrap/js/popper.js'); ?>
<?php echo $this->Html->script('/assets/login/bootstrap/js/bootstrap.min.js'); ?>

<?php echo $this->Html->script('/assets/plugins/select2/select2.full.min.js'); ?>
<?php echo $this->Html->script('/assets/login/daterangepicker/moment.min.js'); ?>
<?php echo $this->Html->script('/assets/login/daterangepicker/daterangepicker.js'); ?>
<?php echo $this->Html->script('/assets/login/countdowntime/countdowntime.js'); ?>
<?php echo $this->Html->script('/assets/login/js/main.js'); ?>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?> 

<script>
$(document).ready(function(){	
$(".suggesstion-box").hide();	
	$('.select2').select2();
	$(document).on('click',"#pincode",function(){ 
		var city_id=$('#city_id').val();
		if(city_id==''){
			alert('Please select a city from the dropdown list');
			$('#city-search-box').val('');
		}
	});
	$(document).on('keyup',"#pincode",function(){ 
		var city_id=$('#city_id').val();
		if(city_id==''){
			alert('Please select a city from the dropdown list');
			$('#city-search-box').val('');
		}
	}); 
	$('.only_char').keyup(function(){
		var inputtxt=  $(this).val();
		var numbers =  /[^a-zA-Z ]/;
 		if(inputtxt.match(numbers))  
		{
			$(this).val('');
			return false; 
		} 
	}); 
	$('.allowdisallow').keyup(function(){
		var pass=  $('#password').val();
		var cpass=  $('#cpassword').val();
 		if(pass.length>5){
 			if((pass.length>0) && (cpass.length>0)){
				if(pass===cpass){ $('#Cpassword_error').html('');}
				else{
 					$('#Cpassword_error').html('Password Not Match.');
 				}			
			}
		}
	});
	$('.allowdisallow').blur(function(){
		var pass=  $('#password').val();
		var cpass=  $('#cpassword').val();
 		if(pass.length>5){
 			if((pass.length>0) && (cpass.length>0)){
				if(pass===cpass){ $('#Cpassword_error').html('');}
				else{
 					$('#Cpassword_error').html('Password Not Match.');
					$('#cpassword').val('');
				}			
			}
		}
	});
	
	$('.allowdisallow').keyup(function(){
		var pass=  $('#password').val();
		if(pass.length>5){
			$('#password_error').html('');
		}
		else{
			$('#password_error').html("Password must be at least six characters long.");
			return false;
		}		
	});
	$('#pincode').keyup(function(){
		var pass=  $('#pincode').val();
		if(pass.length>5){
			$('#pincode_error').html('');
		}
		else{
			$('#pincode_error').html("Pincode must be at least six digits long.");
			return false;
		}		
	});
	
	$('#pincode').blur(function(){
		var pass=  $('#pincode').val();
		if(pass.length>5){
			$('#pincode_error').html('');
		}
		else{
			$('#pincode_error').html("Pincode must be at least six digits long.");
			$('#pincode').val('');
			return false;
		}		
	});
	
	$('#preference').change(function(){
		var pass=  $(this,'option:selected').val();
 		if(pass.length>4){
			$('#oprateerror').html('');
		}
		else{
			$('#oprateerror').html("Please select between 1 to 5 states.");
			return false;
		}		
	});
	

	$(document).on('blur',"#email",function(){
 		var email=$(this).val();
		var m_data = new FormData();
 		m_data.append('email',email);
		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "Users", "action" => "checkEmaileExixt"]); ?>",
			data: m_data,
			processData: false,
			contentType: false,
			type: 'POST',
			dataType:'text',
			success: function(data)
			{	 
				if(data=='remove'){alert("Email ID Already Exist");
					$('#email').val('');
				}
			}
		});
 	});
	
	
	
	$(document).on('blur',"#number_format",function(){ 
 		var mobile_number=$(this).val();
		var m_data = new FormData();
		 
		if(mobile_number.length==10){  
			m_data.append('mobile_number',mobile_number);
			$.ajax({
				url: "<?php echo $this->Url->build(["controller" => "Users", "action" => "checkMobileExixt"]); ?>",
				data: m_data,
				processData: false,
				contentType: false,
				type: 'POST',
				dataType:'text',
				success: function(data)
				{	 
					if(data=='remove'){
						alert("Mobile Number Already Exist");
						$('#mobile_number').val('');
					}
				}
			});
		}
		else
		{
			alert("Please enter valid Mobile No.");
			$(this).val('');
		}		
	
	});
	$(document).on('blur',"#city-search-box",function(){ 
 		$('.suggesstion-box').delay(1000).fadeOut(500);
	});
	$("#city-search-box").keyup(function(){
 		var input=$("#city-search-box").val(); 
		var noofrows=$(this).attr('noofrows');
		var taxboxname=$(this).attr('taxboxname');
		var master=$(this);
		//alert(input);
		var m_data = new FormData();
		m_data.append('input',input);
		m_data.append('noofrows',noofrows);
		m_data.append('taxboxname',taxboxname);
		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "Users", "action" => "ajaxCityRegister"]); ?>",
			data: m_data,
			processData: false,
			contentType: false,
			type: 'POST',
			dataType:'text',
			success: function(data)
			{	 
				$(".suggesstion-box").show();
				$(".suggesstion-box").html(data);
				$(".city-search-box").css("background","#FFF");
			}
		});
	});
	
	 
	$(document).on('change',"#role_id",function(){
 		var roleid = jQuery( "#role_id option:selected" ).val();
 		if(roleid != "" && roleid == 3) {
			$('.lablename').removeAttr('data-placeholder');
			$('.lablename').attr('data-placeholder','Hotel Name');
			
			$('.taxtboxname').removeAttr('name');
			$('.taxtboxname').attr('name','company_name');
			
 		}
		else
		{
			$('.lablename').removeAttr('data-placeholder');
			$('.lablename').attr('data-placeholder','Company Name');
			
			$('.taxtboxname').removeAttr('name');
			$('.taxtboxname').attr('name','company_name');
 		}
		if(roleid != "" && roleid == 1) {
			$('.chosen-choices').hide();
			$('#preferenceStateDiv').show();
			$('#preference').attr('required','required');
			$('.helpblock').show();
			var needPreferenceState = true;
		} else {
			$('#preferenceStateDiv').hide();
			('.helpblock').hide();
			$('#preference').removeAttr('required','required');
			var needPreferenceState = false;
		}
		var settings = $('#UserRegisterForm').validate().settings;
		$.extend(true, settings, {
			rules: {
				"preference[]": {
					required: true,
					needsSelection: needPreferenceState,
				}
			},
			messages: {
				"preference[]": {
					needsSelection: "Please select between 1 to 5 states."
				}
			}
		});
	});
});
function selectCountry(value,city_code,state,country_id,state_name,country_name) {
		var state_id=state;

		$(".suggesstion-box").hide();
		$("#city-search-box").val(value);
		$("#city_id").val(city_code);
		
 		$("#state_id").val(state_id);

		$(".st").html('<span for="Preference_States" style="color:#fff;font-family:Raleway, sans-serif ;">States</span><input readonly style="padding:0px !important;" class="input100 trim_space_valid" type="text" value='+state_name+' required="" id ="state_name" name="state_name" /> ');
		$("#state_name").val(state_name);
		$('#pc').html('<br>');
		//alert(state_name);
		$(".ctr").html('<span for="Preference_Country" style="color:#fff;font-family:Raleway, sans-serif ;">Country</span><input class="input100 trim_space_valid"  required="" value='+country_name+' style="padding:0px !important;" type="text" readonly id ="country_name" name="country_name" />');
		$("#country_id").val(country_id);
		$("#country_name").val(country_name);
 	}	

</script>
<?php echo $this->Html->css(['chosen/chosen']);?>
<?php echo $this->Html->script(['chosen/chosen.jquery']);?>	
<script>
$('.trim_space_valid').change(function() {
    $(this).val($(this).val().trim());
});
</script>
<script type="text/javascript">
 
$(document).ready(function($){
 	$("#preferenceStateDiv").hide();
	<?php if(isset($_GET['role']) && $_GET['role']=="1"){ ?>
 	$("#preferenceStateDiv").show();
	<?php } ?>
	<?php if(isset($_GET['role']) && $_GET['role']=="3"){ ?>
	$('.hotelname').html('Hotel Name');
	<?php } ?>
	
	var last_valid_selection = null;
	$( "#preference" ).change(function(event) {
  	var total_preference = $("#preference :selected").length;
 	if ($(this).val().length > 5) {
  	alert("You can select only 5 Preference");
  	//$("#preference option:selected:last").attr('selected', null);
  	$(this).val(last_valid_selection);
  	return false;
  	}else{
  	last_valid_selection = $(this).val();
  	}
	}); 
	$(".chosen-select").chosen({ max_selected_options: 5 });
	$(".chosen-select").select2({
		  maximumSelectionLength: 5,width: '100%'
		 
	});
	$(".select2-search__field").css("width", "280");
	
});
 
  </script>	
<script>
$(document).ready(function (){  
  $("#chk_cond").hide();
	$(document).on('click',"#ckb1",function(){
		var va = +$('.chk_input').is( ':checked' );
		if(va==0)
		{
			$("#chk_cond").show();
		}
		else
		{
			$("#chk_cond").hide();
		}
	});
});
</script>	
<script type="text/javascript">
$(document).ready(function (){
	<?php if($_GET['promotion_id']==1){?>
	  
		$('.preferenceStateDiv').show();

	<?php } ?>
	var prootionId=<?php echo $_GET['promotion_id'];?>;
	if(prootionId == 3 ){
		$('.lablename').removeAttr('data-placeholder');
		$('.lablename').attr('data-placeholder','Hotel Name');
		
		$('.taxtboxname').removeAttr('name');
		$('.taxtboxname').attr('name','company_name');
	}
	else{
		$('.lablename').removeAttr('data-placeholder');
		$('.lablename').attr('data-placeholder','Company Name');
		
		$('.taxtboxname').removeAttr('name');
		$('.taxtboxname').attr('name','company_name');
	}
});
</script>	
<script type="text/javascript">
 	setInterval(function(){ abc(); }, 2000);
	function abc()
	{ 	
		$('#msg_div').fadeOut(300);
		var delay = 300;
		setTimeout(function() {
			$('#msg_div').remove();
		}, delay);
	} 
</script> 
</html>