<style>
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
.overlap {
    position: absolute;
    bottom: 0px;
    right: 0px;
	width:100%;
	opacity: .7;
}
.nm { 
	font-size: 19px;
    color: #373435;
    font-weight: 900;
}
.other { 
	font-size: 17px;
    color: #727376; 
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
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Travel B2B HUB</title>
	<?php echo $this->Html->css('/assets/font-awesome/fonts/font-awesome.min.css'); ?>
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
		.login100-form-title { font-size:25px; }
		.wrap-login100 { background:#1f222db8 !important; width:420px !important; padding: 18px 55px 37px 55px; }
		.p-t-27 { padding-top: 10px; }
		.error { color: #ff9898; text-align:center; }
	</style>
</head>
<body>
	<div class="limiter">
		<div class="container-login100 bgdiv">
			<div class="wrap-login100" style="width: 920px !important;">
				<center>
					<?=  $this->Html->image('/img/mini_logo.png', ['style'=>'width:10%;']) ?>
				</center>
				<span class="login100-form-title p-b-34 p-t-27">
					TRAVEL B2b HUB
				</span>			
			<p style="color:#ff9898 !important;"><?php echo $this->Flash->render(); ?></p>
			<br />
			<?php echo $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'register','autocomplete'=>"off"],'id'=>"UserRegisterForm",'onSubmit' => 'return getstatevalid();']); ?>
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Select Type">
								<select name="role_id" id="role_id" class="form-control input100" required="" style="height: 35px;margin-top: 11px;" >
									<option value="" disabled selected>Select</option>
									<?php foreach($memberships as $membership) { 
									   $selected ='';
									   if(isset($_GET['role']) && $_GET['role']!="" && ($membership['id']==$_GET['role'])){
								   
										$selected ='selected';
									   }
									   ?>
									<option <?php echo $selected; ?> style="color:black;" value="<?php echo  $membership['id']; ?>"><?php echo  $membership['membership_name']; ?></option>
									  <?php } ?>
								</select>
							</div>					
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input "  data-validate = "Company Name">
						 <input class=" input100 trim_space_valid " required=""  id="company_name" type="text" name="company_name" placeholder="Company Name">
							</div>				
						</div>										
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-6">
								<div class="wrap-input100 validate-input" data-validate = "First name">
									<input class="input100 trim_space_valid"  required="" type="text" name="first_name" placeholder="First Name"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Last name">
									<input class="input100 trim_space_valid"  required="" type="text" name="last_name" placeholder="Last Name">
								</div>						
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Email">
									<input class="input100 trim_space_valid"  required="" type="email" name="email" placeholder="Email">
								</div>
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Contact No">
									<input class="input100 trim_space_valid"  required="" id="mobile_number" type="text" name="mobile_number" placeholder="Contact No.">
							</div>										
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
							<div class="col-md-6">
								<div class="wrap-input100 validate-input" data-validate = "Password">
										<input class="input100 trim_space_valid" required=""  type="password" name="password" placeholder="Password" id="password">
									</div>	
								</div>						
							<div class="col-md-6">
								<div class="wrap-input100 validate-input" data-validate = "Confirm Password">
											<input class="input100 trim_space_valid" required=""  type="password" name="cpassword" placeholder=" Confirm Password" id="cpassword">
										</div>
									</div>	
					</div>
				</div>
				<div class="row col-md-12">
					<div class="col-md-12">
							<div class="wrap-input100 validate-input" data-validate = "Address">
										<input class="input100 trim_space_valid"  required="" type="text" name="address" placeholder="Address" id="address">
									</div>
					</div>
				</div>
				<div class="row col-md-12">
					<div class="col-md-12">
							<div class="wrap-input100 validate-input" data-validate = "Address1">
										<input class="input100 trim_space_valid"  required="" type="text" name="address1" placeholder="Address1" id="address1">
								</div>	
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Locality">
										<input class="input100 trim_space_valid"  required="" type="text" name="locality" placeholder="Locality or Village or Town" id="locality">
							</div>
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "City">
								<select name="city_id" id="city_id" class="form-control select2 input100" required="" style="height: 35px;margin-top: 11px;" >
									<option value="" >Select</option>
									<?php foreach($cities1 as $city) { 
										$state_name=$city->state->state_name;
										$country_name=$city->state->country->country_name;
									?>
											<option style="color:black;" state_name="<?php echo $state_name; ?>" state_id="<?php echo $city['state_id']; ?>" country_name="<?php echo $country_name; ?>" country_id="<?php echo $city['country_id']; ?>" value="<?php echo  $city['id']; ?>">
												<?php echo  $city['name']; ?>
												 (<?php echo $state_name; ?>)
											</option>
									  <?php } ?>
								</select>
								<div class="suggesstion-box" style="margin-top:-10px"></div>
							</div>	
						</div>				
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "State">
								<input readonly class="input100 trim_space_valid" type="text"  required="" id ="state_name" name="state_name" placeholder="State" >
								<input type='hidden' id='state_id' name="state_id"/>
							</div>						
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Pincode">
								<input class="input100 trim_space_valid"  required="" placeholder="Pin Code" type="text" name="pincode" id="pincode">
							</div>
						</div>	
					</div>	
				</div>	
				<div class="row col-md-12">
					<div class="col-md-12">
							<div class="wrap-input100 validate-input" data-validate = "Country">
										<input class="input100 trim_space_valid"  required="" type="text" readonly id ="country_name" name="country_name" placeholder="Country" >
										<input type='hidden' id='country_id' name="country_id"/>
							</div>										
						</div>	
				</div>	
				<div class="row col-md-12">
					<div class="col-md-12" id="preferenceStateDiv">
						<div class="mt" tooltip="Select upto 5 states">
							<div class="wrap-input100 validate-input">
								<label for="Preference_States" style="color:#fff;">States where you operate</label>
								<span style="font-size:11px;color:#fff;">(Select upto 5 states )</span>
								<div class="input-field">
									<?php echo $this->Form->control('preference', ["id"=>"preference", "type"=>"select", 'options' =>$allStates, "multiple"=>true , "class"=>"form-control chosen-select", "data-placeholder"=>"Select upto 5 states where you operate", "style"=>"height:125px;"]); ?>
								</div>
							</div>
						</div>
					</div>					
				</div>
				<div class="row col-md-12">
					<div class="col-md-12">
						<div class="contact100-form-checkbox col-md-12">
							<input class="input-checkbox100 chk_input"  id="ckb1" type="checkbox" required  name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								I accept your Privacy Policy and  Terms and Conditions
							</label>
							<span id="chk_cond" style="color:red;">Please Checked Terms and Condition</span>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-xs-12" align="center">
						<input type="submit" class="btn btn-primary" id="ckb1"  value="Register">
					</div>
				</div>
				<div class="col-md-12 text-center" style="margin-top: 20px;">
					<p style="color:#fff">Do you have an account ?
						<a class="txt1" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'login')) ?>" style="color:#5ba7a4;" >
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
<script>
$(document).ready(function(){	 
$('.select2').select2();
$(document).on('change',"#city_id",function(){
	var city_id=$(this, 'option: selected').val();
	var state_id=parseFloat($('option:selected', this).attr('state_id'));
	var state_name=$('option:selected', this).attr('state_name');
	var country_id=parseFloat($('option:selected', this).attr('country_id'));
	var country_name=$('option:selected', this).attr('country_name');
	$("#state_id").val(state_id);
	$("#state_name").val(state_name);
	$("#country_id").val(country_id);
	$("#country_name").val(country_name);
});
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
  
	/*$("#city-search-box").keyup(function(){
		var input=$("#city-search-box").val();
 		var m_data = new FormData();
		m_data.append('input',input);
		m_data.append('taxboxname',0);
		m_data.append('noofrows',0);
		 
		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "Users", "action" => "ajax_city"]); ?>",
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
	*/
	$(document).on('change',"#role_id",function(){
 		var roleid = jQuery( "#role_id option:selected" ).val();
		/*if(roleid==3){
			$('.hotelname').html('Hotel Name<span class="asterisk"><img class="img-responsive" src="../img/Asterisk.png"></span>')		
		} else{
			$('.hotelname').html('Company Name<span class="asterisk"><img class="img-responsive" src="../img/Asterisk.png"></span>')		
		}*/
		if(roleid != "" && roleid == 1) {
			$('#preferenceStateDiv').show();
			var needPreferenceState = true;
		} else {
			$('#preferenceStateDiv').hide();
			var needPreferenceState = false;
		}
		var settings = $('#UserRegisterForm').validate().settings;
		$.extend(true, settings, {
			rules: {
				"preference[]": {
					needsSelection: needPreferenceState
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
</script>	
<script>
$(document).ready(function(){ 
	
});









	/*
		var cityData = '<?php echo $allCities; ?>';
						//alert(cityData);
                        $(function ()
                        {
							
						$('#city_id').change(function(){
							var city=$('#city_id').val();
							$('#state_id').val($('#city_id').find("#"+city).attr("state"));
							 $('#country_id').val("101");
						});
						
						$('.multiselect-ui').multiselect({
							includeSelectAllOption: false,
							maxHeight: 300,
						});
                       
                        $("#wizard").steps({
                                headerTag: "h2",
                                bodyTag: "section",
                                transitionEffect: "slideLeft"
                            });
                        }); 
						$(document).ready(function () {
							//alert("working..");
						   // $.get("usersgetcitylist.json", function (d) {
						   //   console.log(d);
						   var data = [
								{'label': 'Delhi,Delhi', 'value': 1},
								{'label': 'Gurgaon,Hariyana', 'value': 2},
								{'label': 'Saket,Delhi', 'value': 3},
								{'label': 'Mumbai,Mahastra', 'value': 4},
								{'label': 'Kolkatta,Paschim Bangal', 'value': 5},
								{'label': 'Jaypur,Rajsthan', 'value': 6},
								{'label': 'Udaypur,Rajsthan', 'value': 7},
								{'label': 'Kota,Rajsthan', 'value': 8},
								{'label': 'Lucknow,UttarPradesh', 'value': 9},
								{'label': 'Varansi,UttarPradesh', 'value': 10},
								{'label': 'Allahabad,UttarPradesh', 'value': 11},
								{'label': 'Noida,UttarPradesh', 'value': 12},
								{'label': 'GreaterNoida,UttarPradesh', 'value': 13},
								{'label': 'Pune,Mahastra', 'value': 14},
								{'label': 'Patna,Bihar', 'value': 15},
								{'label': 'Ranchi,Jharkhand', 'value': 16},
								{'label': 'Adampur,Haryana', 'value': 17},
								{'label': 'Ambala,Haryana', 'value': 18},
								{'label': 'Faridabad,Haryana', 'value': 19},
								{'label': 'Hisar,Haryāna', 'value': 20},
								];
						   
							
							$("#city_name").autocomplete({
								source: JSON.parse(cityData),
								select: function (e, ui) {
									e.preventDefault();
									$("#city_id").val(ui.item.value);
									$(this).val(ui.item.label);
									$("#state_id").val(ui.item.state_id);
									$("#state_name").val(ui.item.state_name);

									$("#country_id").val(ui.item.country_id);
									$("#country_name").val(ui.item.country_name);
								
								}
							});
							// Overrides the default autocomplete filter function to search only from the beginning of the string
							$.ui.autocomplete.filter = function (array, term) {
								var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(term), "i");
								return $.grep(array, function (value) {
									return matcher.test(value.label);
								});
							};

						});
                    </script>
<script>
$('.trim_space_valid').change(function() {
    $(this).val($(this).val().trim());
});
 $.validator.addMethod("needsSelection", function (value, element) {
	var count = $(element).find('option:selected').length;
	if(count == 0)
		return false;
	if(count > 0 && count < 6)
		return true;
	else
		return false;
});
jQuery.validator.addMethod("phoneno", function(phone_number, element) {
    	    phone_number = phone_number.replace(/\s+/g, "");
    	    return this.optional(element) || phone_number.length > 9 && 
phone_number.match(/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/);
    	}, "<br />Please specify a valid phone number");
jQuery.validator.addMethod("email", function(value, element) {
value = value.trim();
return this.optional(element) || /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(value);
}, "Please enter a valid email.");

$('#UserRegisterForm').validate({
onkeyup: function (element, event) {
            if (event.which === 9 && this.elementValue(element) === "") {
                return;
            } else {
                this.element(element);
            }
        },
	rules: {
		"company_name" : {
			required : true
		},
		"first_name" : {
			required : true
		},
		"last_name" : {
			required : true
		},
		"email": {
			required : true,
			email: true
		},
		"mobile_number": {
			required : true,
			number: true,
			minlength:10,
  			maxlength:10
		},
		"address": {
			required: true
		},
		"city_name": {
			required: true
		},
		"state_name": {
			required: true
		},
		"country_name": {
			required: true
		},
		"pincode": {
			required: true,
			number:true
		},
		
		"password": {
			required: true
		},
		"cpassword": {
			required: true,
			equalTo: "#password"
		},
		"term_n_cond": {
			required: true
		}
	},
	messages: {
		"company_name" : {
			required : "Please enter company name."
		},
		"first_name" : {
			required : "Please enter first name."
		},
		"last_name" : {
			required : "Please enter last name."
		},
		"email": {
			required : "Please enter email.",
			email : "Please enter valid email."
		},
		"mobile_number": {
			required : "Please enter contact number.",
			number: "Please enter only number",
			minlength: "Please enter at least 10 digit",
			maxlength: "Please enter no more than 10 digit"
		},
		"address": {
			required: "Please enter address."
		},
		"city_name": {
			required: "Please select city."
		},
		"state_name": {
			required: ""
		},
		"country_name": {
			required: ""
		},
		"pincode": {
			required: "Please enter pincode.",
			number: "Please enter only number"
		},
		"password": {
			required: "Please enter password."
		},
		"cpassword": {
			required: "Please enter confirm password.",
			equalTo: "Confirm password should be equal to password."
		},
		"term_n_cond": {
			required: "Please select terms & conditions."
		}
	},
	ignore: ":hidden:not(select)",
errorPlacement: function(error, element) {
        if (element.is(':checkbox')) {
            error.insertAfter($(".termcondition"));
        }else{
         error.insertAfter(element);
        } 
    }
});
$(function () {
	$('#role_id').change(function(){
		var roleid = jQuery( "#role_id option:selected" ).val();
		if(roleid==3){
		$('.hotelname').html('Hotel Name<span class="asterisk"><img class="img-responsive" src="../img/Asterisk.png"></span>')		
		} else{
			$('.hotelname').html('Company Name<span class="asterisk"><img class="img-responsive" src="../img/Asterisk.png"></span>')		
		}
		if(roleid != "" && roleid == 1) {
			$('#preferenceStateDiv').show();
			var needPreferenceState = true;
		} else {
			$('#preferenceStateDiv').hide();
			var needPreferenceState = false;
		}
		var settings = $('#UserRegisterForm').validate().settings;
		$.extend(true, settings, {
			rules: {
				"preference[]": {
					needsSelection: needPreferenceState
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
function getstatevalid()
	{
		var statename = $('#state_name').val();
		var cityname = $('#city_name').val();
		var cityid = $('#city_id').val();
		if(cityname!=""){
		if(statename==""){
			//stateerrormodal
			$('body').addClass('modal-open'); 
	$("#stateerrormodal").addClass("in");
	$("#stateerrormodal").show();
		 }
		}
	}
$(".closepreview" ).click(function() {
$('body').removeClass('modal-open');
$("#stateerrormodal").removeClass("in");
	$("#stateerrormodal").hide(); 
});
</script>
  <?php echo $this->Html->css(['chosen/chosen']);?>
  <?php echo $this->Html->script(['chosen/chosen.jquery']);?>
  
  <?php echo $this->Html->css(['select2/select2']);?>
  <?php echo $this->Html->script(['select2/select2']);?>
  
  <?php echo $this->Html->css(['telinput/css/intlTelInput']);?>
  <?php echo $this->Html->script(['telinput/intlTelInput']);?>
  <?php echo $this->Html->script(['telinput/utils']);?>
  
<script type="text/javascript">
$('#UserRegisterForm').submit(function(){
if ($("#UserRegisterForm").valid()) {
$(this).find(':input[type=submit]').prop('disabled', true);
}
    
});
$(document).ready(function($){

	//$(".chosen-select").chosen({ max_selected_options: 5 });
	
	$("#preferenceStateDiv").hide();
	<?php if(isset($_GET['role']) && $_GET['role']=="1"){ ?>
	
	$("#preferenceStateDiv").show();
	<?php } ?>
	<?php if(isset($_GET['role']) && $_GET['role']=="3"){ ?>
	$('.hotelname').html('Hotel Name');
	<?php } ?>
	$(".chosen-select").select2({
		  maximumSelectionLength: 5,width: '100%'
		 
		 });
	/*var last_valid_selection = null;
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
	});*/
	
	$(".select2-search__field").css("width", "280");
	
});

    $("#mobile_number").intlTelInput({
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: "body",
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // nationalMode: false,
      onlyCountries: ['in'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
       separateDialCode: true
      //utilsScript: "build/js/utils.js"
    });
  </script>					
</html>