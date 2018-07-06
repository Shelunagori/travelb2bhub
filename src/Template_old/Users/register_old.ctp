<style>
    p.p-policy-content {
        line-height: 23px;
        text-align: justify;
    }
    h3.p-policy-head {
        margin-bottom: 50px;
    }

    .policy-details {
        margin-top: 25px;
    }
    .bigdrop {
    width: 524px !important;
}
#mobile_number{
padding-left: 84px !important;
}
	.select2-search__field{ padding: 3px !important;
    font-size: 13px !important;}
</style>
  <style>
  .ui-autocomplete {
    max-height: 300px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 300px;
  }
  </style>

 <?php echo $this->Html->css(['jquery.steps','multiselect','tooltip']); ?>
  <?php echo $this->Html->script(['modernizr-2.6.2.min', 'jquery.cookie-1.3.1','multiselect','jquery.steps','selectFx','jquery.validate']);?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div id="tra-contact" class="grey_bg">
    
    <div class="container-fluid login_bg ">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0">
                 <h1 class="text-center">Register</h1>
            </div>
        </div>
    </div>
    
    <div class="container-fluid grey_bg padding-tb40">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-xs-12 register_column animate-box">
                <?= $this->Flash->render() ?>

                <div class="content">
                   <?php  
                        echo $this->Form->create(null, [
                                                            'type' => 'file',
                                                            'url' => ['controller' => 'Users', 'action' => 'register','autocomplete'=>"off"],
															'id'=>"UserRegisterForm",'onSubmit' => 'return getstatevalid();'
                        ]); 
                    ?> 
					
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

                    <div id="wizard">
                        
                         
                        <section class="registartion-wrap">
                          
                           
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
                                    <div class="input-field">
                                        <label for="from">User Category
                                            <span class="asterisk">
                                                <img src="../img/Asterisk.png" class="img-responsive">
                                            </span>
                                        </label>
                                        <select name="role_id" id="role_id" class="form-control" required="" >
                                            <option value="" disabled selected>Select</option>
                                            <?php foreach($memberships as $membership) { 
											   $selected ='';
											   if(isset($_GET['role']) && $_GET['role']!="" && ($membership['id']==$_GET['role'])){
										   
												$selected ='selected';
											   }
											   ?>
                                            <option <?php echo $selected; ?> value="<?php echo  $membership['id']; ?>"><?php echo  $membership['membership_name']; ?></option>
                                              <?php } ?>
                                        </select>
                                    </div>
                                </div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
                                    <div class="input-field">
                                        <label for="from" class="hotelname">Company Name
                                         <span class="asterisk">
                                                <img src="../img/Asterisk.png" class="img-responsive">
                                            </span>
                                        </label>
                                        <input type="text" name="company_name" class="form-control trim_space_valid" id="company_name"/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
                                    <div class="input-field">
                                        <label for="from">First Name
                                         <span class="asterisk">
                                                <img src="../img/Asterisk.png" class="img-responsive">
                                            </span>
                                        </label>
                                        <input type="text" name="first_name" class="form-control trim_space_valid" id="first_name" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
                                    <div class="input-field">
                                        <label for="from">Last Name
                                         <span class="asterisk">
                                                <img src="../img/Asterisk.png" class="img-responsive">
                                            </span>
                                        </label>
                                        <input type="text" name="last_name" class="form-control trim_space_valid" id="last_name" />
                                    </div>
                                </div>
                            
                             
                                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
                                    <div class="input-field">
                                        <label for="from">Email
                                         <span class="asterisk">
                                                <img src="../img/Asterisk.png" class="img-responsive">
                                            </span>
                                        </label>
                                        <input type="email" name="email" class="form-control" id="email" />
                                    </div>
                                </div>
                                 
                               
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
                                    <div class="input-field">
                                        <label for="from">Password
                                         <span class="asterisk">
                                                <img src="../img/Asterisk.png" class="img-responsive">
                                            </span>
                                        </label>
                                        <input type="password" name="password" class="form-control trim_space_valid" id="password" />
                                    </div>
                                </div>

                                <div class="ccol-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
                                    <div class="input-field">
                                        <label for="from">Confirm Password
                                         <span class="asterisk">
                                                <img src="../img/Asterisk.png" class="img-responsive">
                                            </span>
                                        </label>
                                        <input type="password" name="cpassword" class="form-control trim_space_valid" id="cpassword" />
                                    </div>
                                </div>
								
								
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
                                    <div class="input-field">
                                        <label for="from">Contact No.
                                         <span class="asterisk">
                                                <img src="../img/Asterisk.png" class="img-responsive">
                                            </span>
                                        </label>
                                        <input type="tel" class="form-control" name="mobile_number" value="" id="mobile_number"/>
                                    </div>
                                </div>
                                
                           
                        </section>

                        
                        <section class="registartion-wrap">
                          
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
                                    <div class="input-field">
                                        <label for="from">Address
                                         <span class="asterisk">
                                                <img src="../img/Asterisk.png" class="img-responsive">
                                            </span>
                                        </label>
                                        <input type="text" name="address" class="form-control trim_space_valid" id="address" />
                                    </div>
                                </div>
                               
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
                                    <div class="input-field">
                                        <input type="text" name="address1" class="form-control" id="address1" />
                                    </div>
                                </div>                            
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
                                    <div class="input-field">
										 <label for="from">Locality</label>
                                        <input type="text" name="locality" class="form-control" id="locality" placeholder="Enter Locality or Village or Town" />
                                    </div>
                                </div>
                          
                            
								<div id="otherAddressDiv">
										 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
											<div class="input-field">
												<label for="from">City
                                                 <span class="asterisk">
                                                <img src="../img/Asterisk.png" class="img-responsive">
                                            </span>
                                                </label>
												<input type="text" placeholder="Select City or Nearest City" class="form-control" id ="city_name" name="city_name" autocomplete="off" />
												<input type='hidden' id='city_id' value='' name="city_id"/>
												<!-- <select name="city_id" id="city_id" class="form-control">
													<option value="" disabled selected>Select City</option>
													<?php foreach($cities as $city){
													   
														
													?>
													 <option value="<?php echo $city['id']; ?>" id="<?php echo $city['id'];?>" state="<?php echo $city['state_id'];?>"><?php echo $city['name']; ?></option>
													<?php } ?>
												</select> -->
											</div>
										</div>
										

										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
											<div class="input-field">
												<label for="from">State </label>
												<input type="text" class="form-control" id ="state_name" name="state_name" placeholder="State" readonly/>
												<input type='hidden' id='state_id' value='' name="state_id"/>
												<!-- <select name="state_id" id="state_id" class="form-control">
													<option value="" disabled selected>Select State</option>
													<?php foreach($states as $state){
													   
													?>
													 <option value="<?php echo $state['id']; ?>"><?php echo $state['state_name']; ?></option>
													<?php } ?>
												</select> -->
											</div>
										</div>
							
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
											<div class="input-field">
												<label for="from">Pincode
                                                 <span class="asterisk">
                                                    <img src="../img/Asterisk.png" class="img-responsive">
                                                </span>
                                                </label>
												 <input type="text" class="form-control trim_space_valid" name="pincode" id="pincode" />
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
											<div class="input-field">
												<label for="from">Country</label>
												<input type="text" class="form-control" id ="country_name" name="country_name" placeholder="Country" readonly/>
												<input type='hidden' id='country_id' value='' name="country_id"/>
											</div>
										</div>
									</div>
								</div>

								
                              
									<div class="col-xs-12 col-md-12 mt" style="display:none;">
										<div class="image-upload">
											<label for="file-input">
												User Profile Picture<br><?php echo $this->Html->image('img-icon.png'); ?>
											</label>

											<input id="file-input" name="image" type="file"/>  Upload Picture
										</div>
									</div>
								<div id="preferenceStateDiv">
									<div class="col-xs-12 col-xs-12 mt" tooltip="Select upto 5 states">
									<div class="col-xs-12 col-md-12 mt padding0">
									 <label for="Preference_States">States where you operate</label>
						   
									 <span style="font-size:11px;">(Select upto 5 states )</span>
											<div class="input-field">
											<?php echo $this->Form->control('preference', ["id"=>"preference", "type"=>"select", 'options' =>$allStates, "multiple"=>true , "class"=>"form-control chosen-select", "data-placeholder"=>"Select upto 5 states where you operate", "style"=>"height:125px;"]); ?>
											
										</div>
									 </div>
									 </div>
								</div>
                              <div class="col-xxs-12 col-xs-12 mt">
										<div class="col-xs-12">
											<div class="input-field">
												<input type="checkbox" class="form-control agree-check" name="term_n_cond" id="term_n_cond">                               <span class="asterisk">
                                                    <img src="../img/Asterisk.png" class="img-responsive">
                                                </span>
												<span class="termcondition">I agree to the <a href="/pages/privacypolicy"target="_blank">Privacy Policy</a> and <a href="/pages/termsandconditions"target="_blank">Terms & Conditions</a></span>
											</div>
										</div>
								</div>
                                <div class="col-md-12 center col-md-12 mt">
                                    <div class="col-xs-12">
										<input type="submit" class="btn btn-primary" value="Submit">
									</div>
                                </div>
                                </section>
                                </form>
                                </div>
                                </div>

                                </div>
                                </div>

                                </div>
                                </div>
<div class="modal fade form-modal" id="stateerrormodal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title">Alert!</h4>
		</div>
        <div class="modal-body">
			<p style="margin-left: 10px;">Entered CITY is not in our Database. Please select a valid CITY from the list that appears when you enter text in the CITY textbox.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default closepreview" data-dismiss="modal">Ok</button>
        </div>
      </div>
    </div>
  </div>
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
</script>
 <script>
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