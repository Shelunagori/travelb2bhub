<!DOCTYPE html>
<html lang="en">
<head>
	<title>Travel B2B HUB</title>
	 <?php echo $this->Html->css('/assets/bootstrap/css/bootstrap.min.css'); ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
	<?php echo $this->Html->css('/assets/login/fonts/iconic/css/material-design-iconic-font.min.css'); ?>
	<?php echo $this->Html->css('/assets/login/animate/animate.css'); ?>
	<?php echo $this->Html->css('/assets/login/css-hamburgers/hamburgers.min.css'); ?>
	<?php echo $this->Html->css('/assets/login/animsition/css/animsition.min.css'); ?>
	<?php echo $this->Html->css('/assets/login/select2/select2.min.css'); ?>
	<?php echo $this->Html->css('/assets/login/daterangepicker/daterangepicker.css'); ?>
	<?php echo $this->Html->css('/assets/login/daterangepicker/daterangepicker.css'); ?>
	<?php echo $this->Html->css('/assets/login/css/util.css'); ?>
	<?php echo $this->Html->css('/assets/login/css/main.css'); ?>
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
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Select Type">
								<select name="role_id" id="role_id" class="input100" required="" style="height: 35px;margin-top: 11px;" >
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
							<div class="wrap-input100 validate-input"  data-validate = "Company Name">
								<input class="input100 trim_space_valid" id="company_name" type="text" name="company_name" placeholder="Company Name">
								<span class="focus-input100" data-placeholder="&#xf0f7;"></span>
							</div>				
						</div>										
					</div>
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "First name">
								<input class="input100 trim_space_valid" type="text" name="first_name" placeholder="First Name">
								<span class="focus-input100" data-placeholder="&#xf207;"></span>
							</div>						
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Last name">
								<input class="input100 trim_space_valid" type="text" name="last_name" placeholder="Last Name">
								<span class="focus-input100" data-placeholder="&#xf207;"></span>
							</div>						
						</div>										
					</div>
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Email">
								<input class="input100 trim_space_valid" type="email" name="email" placeholder="Email">
								<span class="focus-input100" data-placeholder="&#xf003;"></span>
							</div>						
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Contact No">
								<input class="input100 trim_space_valid" id="mobile_number" type="text" name="mobile_number" placeholder="Contact No.">
								<span class="focus-input100" data-placeholder="&#xf003;"></span>
							</div>	
						</div>										
					</div>
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Password">
								<input class="input100 trim_space_valid" type="password" name="password" placeholder="Password" id="password">
								<span class="focus-input100" data-placeholder="&#xf003;"></span>
							</div>						
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Contact No">
								<input class="input100 trim_space_valid" type="password" name="cpassword" placeholder=" Confirm Password" id="cpassword">
								<span class="focus-input100" data-placeholder="&#xf003;"></span>
							</div>	
						</div>										
					</div>
					<div class="col-md-12">
						<div class="col-md-12">
							<div class="wrap-input100 validate-input" data-validate = "Address">
								<input class="input100 trim_space_valid" type="text" name="address" placeholder="Address" id="address">
								<span class="focus-input100" data-placeholder="&#xf015;"></span>
							</div>						
						</div>
						<div class="col-md-12">
							<div class="wrap-input100 validate-input" data-validate = "Address1">
								<input class="input100 trim_space_valid" type="password" name="address1" placeholder="" id="address1">
							</div>	
						</div>										
					</div>
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "Locality">
								<input class="input100 trim_space_valid" type="text" name="locality" placeholder="Locality or Village or Town" id="locality">
								<span class="focus-input100" data-placeholder="&#xf015;"></span>
							</div>						
						</div>
						<div class="col-md-6">
							<div class="wrap-input100 validate-input" data-validate = "City">
								<input class="input100 trim_space_valid" name="city_name" type="text" placeholder="City or Nearest City" id="city_name" autocomplete="off">
								<span class="focus-input100" data-placeholder="&#xf015;"></span>
							</div>	
						</div>										
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="width: 100%;">Login</button>
						<input type="hidden" name="redirect_page" value="<?php echo $redirect_page;?>"/>
					</div>					
				<?php echo $this->Form->end();?>
			</div>
		</div>
	</div>
	<div id="dropDownSelect1"></div>
</body>
<?php echo $this->Html->script('/assets/login/jquery/jquery-3.2.1.min.js'); ?>
<?php echo $this->Html->script('/assets/login/animsition/js/animsition.min.js'); ?>
<?php echo $this->Html->script('/assets/login/bootstrap/js/popper.js'); ?>
<?php echo $this->Html->script('/assets/login/bootstrap/js/bootstrap.min.js'); ?>
<?php echo $this->Html->script('/assets/login/select2/select2.min.js'); ?>
<?php echo $this->Html->script('/assets/login/daterangepicker/moment.min.js'); ?>
<?php echo $this->Html->script('/assets/login/daterangepicker/daterangepicker.js'); ?>
<?php echo $this->Html->script('/assets/login/countdowntime/countdowntime.js'); ?>
<?php echo $this->Html->script('/assets/login/js/main.js'); ?>
					<script>
						var cityData = '<?php echo $allCities; ?>';
						//alert(cityData);
                        $(function ()
                        {
							
							
                            /*$('#city_id').change(function(){
                                var city=$('#city_id').val();
                                $('#state_id').val($('#city_id').find("#"+city).attr("state"));
                                 $('#country_id').val("101");
                            });*/
                            $('.multiselect-ui').multiselect({
                                includeSelectAllOption: false,
								maxHeight: 300,
								
                            });
                       
                         /*$("#wizard").steps({
                                headerTag: "h2",
                                bodyTag: "section",
                                transitionEffect: "slideLeft"
                            });*/
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
</html>