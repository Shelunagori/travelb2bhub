<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
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
.col-md-12s
{
	padding-right:0px !important;
	padding-left:0px !important;	
}
 label{
	color:#96989A !important;
	font-weight:100;
}
</style>

<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
             <div class="box-header with-border">
              <h3 class="box-title">Edit Profile</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<?php $pararm = $users['id']; ?>
            <?php  echo $this->Form->create("Users", ['type' => 'file', 'url' => ['controller' => 'Users', 'action' => 'edit',$pararm], 'id'=>"UserRegisterForm"]); ?>
              <div class="box-body">
			  <fieldset>
				<legend><b>COMPANY INFORMATION</b></legend>
			  <div>
				 <?php 
				 $role_id=$this->request->session()->read('Auth.User.role_id');
				 ?>
				 <div class="form-group col-md-12" style="display:none">
                  <label>Category</label>
                  <select class="form-control">
                    <option>--Select--Please---</option>
                    <option value="1" <?php if($role_id== 1){ echo "Selected"; }?> >Travel Agent</option>
                    <option value="2" <?php if($role_id== 2){ echo "Selected"; }?> >Event Planner</option>
                    <option value="3" <?php if($role_id== 3){ echo "Selected"; }?> >Hotelier</option>
                  </select>
                </div> 
				 <div class="form-group col-md-6">
                  <label>First Name</label>
                  <input type="text" class="form-control" name="first_name" value="<?php echo $users['first_name'] ?>" id="first_name" placeholder="First Name">
                </div>
				 <div class="form-group col-md-6">
                  <label>Last Name</label>
                  <input type="text" class="form-control" name="last_name" value="<?php echo $users['last_name'] ?>" id="last_name" placeholder="last Name">
                </div>
				<div class="form-group col-md-6">
                  <label>Company Name</label>
                  <input type="text" class="form-control" name="company_name" value="<?php echo $users['company_name'] ?>" id="company_name" placeholder="Company Name">
                </div>
				 <div class="form-group col-md-6">
                  <label>Website</label>
                  <input type="text" class="form-control" id ="web_url" value = "<?php echo (!empty($users['web_url']))?$users['web_url']:""; ?>" name="web_url" placeholder="Website URL">
                </div>
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Email Id</label>
                  <input type="email" class="form-control" name="email" class="form-control" value="<?php echo $users['email'] ?>" id="email" placeholder="Enter Here">
                </div>
                <div class="form-group col-md-4">
                  <label for="exampleInputPassword1">Mobile No.</label>
                  <input type="text" class="form-control" name="mobile_number" value="<?php echo str_replace(' ','',$users['mobile_number']); ?>" id="mobile_number" placeholder="Enter Here">
                </div>
				<div class="form-group col-md-4">
                  <label for="exampleInputPassword1">Secondary Contact No.</label>
                  <input type="text" class="form-control" name="p_contact" value="<?php echo $users['p_contact'] ?>" id="p_contact" placeholder="Secondary Contact Number">
                </div>
				
				<div class="form-group col-md-6">
                  <label>Address Line 1</label>
                  <input type="text" class="form-control" name="address" value="<?php echo $users['address'] ?>" id="address" placeholder="Enter Here" >
                </div>
				 <div class="form-group col-md-6">
                  <label>Address Line 2</label>
                  <input type="text" class="form-control" name="adress1" value="<?php echo $users['adress1'] ?>" id="adress1" placeholder="Enter Here">
                </div>
				
				<div class="form-group col-md-6">
                  <label>Locality</label>
                  <input type="text" class="form-control" name="locality" value="<?php echo $users['locality'] ?>" id="locality" placeholder="Enter Here">
                </div>
				 <div class="form-group col-md-6">
                  <label>City</label>
                  <input type="textbox" taxboxname="<?php echo $users['state_id']; ?>" noofrows="1" class="form-control city_select" required autocomplete="off" id="city-search-box" name="city" placeholder="Select city/nearest city" value="<?php echo (!empty($users['city_id']))?$allCityList[$users['city_id']]:"" ;?>">
				  <input type="hidden" value="<?php echo $users['city_id']; ?>" id="city_id" name="city_id" >
				  <div class="suggesstion-box" style="margin-top:-10px"></div>
                </div>
				<div class="col-md-12 col-md-12s">
				<div class="form-group col-md-4">
					  <label for="exampleInputPassword1">PinCode</label>
					  <input type="text" class="form-control" id ="pincode" value = "<?php echo (!empty($users['pincode']))?$users['pincode']:""; ?>"name="pincode" placeholder="Enter Pincode">
				</div>
				<div class="shw">
					<div class="form-group col-md-4">
						<?php 
						//pr($states_show->toarray());exit;
						$states_show=$states_show->toarray();?>
						  <label>States</label>
							<input type="text" class="form-control" id ="state_name" value="<?php echo $states_show[$users['state_id']];?>" name="state_name" placeholder="Select State" readonly />
							<input type='hidden' id='state_id' name="state_id" value="<?php echo (!empty($users['state_id']))?$users['state_id']:""; ?>" />
					</div><?php $country_show=$country_show->toarray();  ?>
					<div class="form-group col-md-4">
						  <label>Country</label>
						  <input type="text" class="form-control" id ="country_name" Value ="<?php echo $country_show[$users['country_id']];?>" name="country_name" placeholder="Select Country" readonly />
                          <input type='hidden' id='country_id' name="country_id" value="<?php echo (!empty($users['country_id']))?$users['country_id']:""; ?>" />
					</div>
				</div> 
				
				<div class="form-group col-md-12">
                  <label>States of Operation</label>
                   <?php 
					$selectedPreferenceStates = "";
					if(!empty($users['preference'])) 
					{
						$selectedPreferenceStates = explode(",", $users['preference']);
					}	
					echo $this->Form->control('preference', ["value"=>$selectedPreferenceStates, "id"=>"preference", "type"=>"select", 'options' =>$allStates, "multiple"=>true , "class"=>"form-control select2", "data-placeholder"=>"Select Some States", "style"=>"height:125px;"]); ?>
                </div>
                 </div>
				 </div>
				</fieldset>
				<fieldset>
				<legend><b>CERTIFICATES</b></legend>
			   
				 <div>
					<div class="col-md-12">
						<div class="img_show col-md-3" align="center">
							<?php if(!empty($users['iata_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['iata_pic'])) { 
								echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['iata_pic'], ["alt"=>"IATA Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']);?>
							<?php }else{ 
								echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"IATA Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
								} ?>
							<p>
								<?php echo $this->Form->input('IATA Pic', ['type' => 'file', 'class' => 'form-control', 'name' => 'iata_pic']); ?>
								 
							</p>
						</div>
						<div class="img_show col-md-3" UPLOAD PHOTO align="center">
							<?php if(!empty($users['tafi_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['tafi_pic'])) {
                                echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['tafi_pic'], ["alt"=>"T A F I Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']);?>
                            <?php }else{ 
								echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"T A F I Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
								} ?>
							<p>
								<?php echo $this->Form->input('T A F I Pic', ['type' => 'file', 'class' => 'form-control', 'name' => 'tafi_pic']); ?>
								 
							</p>
						</div>
						
						<div class="img_show col-md-3" align="center">
							<?php if(!empty($users['taai_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['taai_pic'])) { 
                                echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['taai_pic'], ["alt"=>"T A A I Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']);?>
							<?php }else{ 
								echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"T A A I Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
								} ?>
							<p>
								<?php echo $this->Form->input('T A A I Pic', ['type' => 'file', 'class' => 'form-control', 'name' => 'taai_pic']); ?>
								 
							</p>
						</div>
						
						<div class="img_show col-md-3" align="center">
							<?php if(!empty($users['iato_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['iato_pic'])) { 
                                echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['iato_pic'], ["alt"=>"I A T O Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']);?>
							<?php }else{ 
								echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"I A T O Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
								} ?>
							<p>
								<?php echo $this->Form->input('IATO Pic', ['type' => 'file', 'class' => 'form-control', 'name' => 'iato_pic']); ?>
								 
							</p>
						</div>
						
						<div class="img_show col-md-3" align="center">
							<?php if(!empty($users['adyoi_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['adyoi_pic'])) { 
                                echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['adyoi_pic'], ["alt"=>"A D Y O I Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']);?>
							<?php }else{ 
								echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"A D T O I Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
								} ?>
							<p>
								<?php echo $this->Form->input('A D Y O I Pic', ['type' => 'file', 'class' => 'form-control', 'name' => 'adyoi_pic']); ?>
								 
							</p>
						</div>
						
						<div class="img_show col-md-3" align="center">
							<?php if(!empty($users['iso9001_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['iso9001_pic'])) { 
                                echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['iso9001_pic'], ["alt"=>"I S O 9001 Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']);?>
							<?php }else{ 
								echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"I S O 9001 Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
								} ?>
							<p>
								<?php echo $this->Form->input('I S O 9001 Pic', ['type' => 'file', 'class' => 'form-control', 'name' => 'iso9001_pic']); ?>
								 
							</p>
						</div>
						
						<div class="img_show col-md-3" align="center">
							<?php if(!empty($users['uftaa_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['uftaa_pic'])) { 
                               echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['uftaa_pic'], ["alt"=>"U F T A A Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']);?>
							<?php }else{ 
								echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"U F T A A Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
								} ?>
							<p>
								<?php echo $this->Form->input('U F T A A Pic', ['type' => 'file', 'class' => 'form-control', 'name' => 'uftaa_pic']); ?>
								 
							</p>
						</div>
						
						<div class="img_show col-md-3" align="center">
							<?php if(!empty($users['adtoi_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['adtoi_pic'])) { 
                                echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['adtoi_pic'], ["alt"=>"A D T O I Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']);?>
							<?php }else{ 
								echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"A D T O I Pic", "height"=>130, 'width'=>130, 'style'=>'border-radius: 50%;']); 
								} ?>
							<p>
								<?php echo $this->Form->input('A D T O I Pic', ['type' => 'file', 'class' => 'form-control', 'name' => 'adtoi_pic']); ?>
								 
							</p>
						</div>
						
					</div>
				 </div>
				</fieldset>
				
				<fieldset>
				<legend><b>UPLOAD PHOTO</b></legend>
			   
				 <div>
					<div class="col-md-12">
						<div class="img_show col-md-4" align="center">
							<?php if(!empty($users['profile_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['profile_pic'])) {
								echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['profile_pic'], ["class"=>"img_setup", "alt"=>"Profile Pic",'height'=>150,'width'=>170]);?>
							<?php }else{ 
								echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"Profile Pic",'height'=>150,'width'=>170]); 
								} ?>
							<p>
								<?php echo $this->Form->input('Profile Picture', ['type' => 'file', 'class' => 'form-control', 'name' => 'profile_pic']); ?>
								 
							</p>
						</div>
						<div class="img_show col-md-4" align="center" >
							<?php if(!empty($users['company_img_1_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.	$users['id'].DS.$users['company_img_1_pic'])) { 
								echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['company_img_1_pic'], ["class"=>"  img_setup", "alt"=>"Company Image 1 Pic",'height'=>150,'width'=>170]);?>
							<?php }else{ 
								echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"Profile Pic",'height'=>150,'width'=>170]); 
								} ?>
							<p>
							<?php 
							  if($this->request->session()->read('Auth.User.role_id') == 1 or $this->request->session()->read('Auth.User.role_id') == 2) {
								echo $this->Form->input('Photograph of your office (Pic 1)', ['type' => 'file', 'class' => 'form-control', 'name' => 'company_img_1','style'=>'height:130 !important;' ]);
							  }else{
								  echo $this->Form->input('Photograph of your Hotel-1', ['type' => 'file', 'class' => 'form-control', 'name' => 'company_img_1' ]);
							  } ?>
								 
							</p>
						</div>
						 
						<div class="img_show col-md-4" align="center"  style="height:250">
							<?php if(!empty($users['company_img_2_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['company_img_2_pic'])) { 
								echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['company_img_2_pic'], ["class"=>"img_setup", "alt"=>"Company Image 2 Pic",'height'=>150,'width'=>170]);?>
							<?php }else{ 
								echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"Profile Pic",'height'=>150,'width'=>170]); 
								} ?>
							<p>
								<?php  if($this->request->session()->read('Auth.User.role_id') == 1 or $this->request->session()->read('Auth.User.role_id') == 2) {
									echo $this->Form->input('Photograph of your office (Pic 2)', ['type' => 'file', 'class' => 'form-control', 'name' => 'company_img_2' ]);
								  }else{
									  echo $this->Form->input('Photograph of your Hotel-2', ['type' => 'file', 'class' => 'form-control', 'name' => 'company_img_2' ]);
								}?>
							</p>
						</div>
						
						</div>
						 
						<div class="col-md-12" style="margin-top:30px;">
							<div class="img_show col-md-4" align="center">
								<?php 
								if(!empty($users['pancard_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['pancard_pic'])) { 
									echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['pancard_pic'], ["class"=>"img_setup", "alt"=>"Pan Card Pic",'height'=>150,'width'=>170]);?>
								<?php }else{ 
									echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"Profile Pic",'height'=>150,'width'=>170]); 
								} ?>
								<p>
									<?php echo $this->Form->input('Pan Card', ['type' => 'file', 'class' => 'form-control', 'name' => 'pancard', "pancard"]); ?>
								</p>
							</div>
						<div class="img_show col-md-4" align="center">
							<?php 
							if(!empty($users['id_card_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['id_card_pic'])) { 
								echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['id_card_pic'], ["class"=>"img_setup", "alt"=>"Business card Pic",'height'=>150,'width'=>170]);?>
							<?php }else{ 
								echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"Profile Pic",'height'=>150,'width'=>170]); 
								} ?>
							<p>
								<?php echo $this->Form->input('Business card', ['type' => 'file', 'class' => 'form-control', 'name' => 'id_card','id'=>'id_card']); ?>
							</p>
						</div>
						<div class="img_show col-md-4" align="center">
							<?php 
							if(!empty($users['company_shop_registration_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['company_shop_registration_pic'])) {
								echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['company_shop_registration_pic'], ["class"=>"img_setup", "alt"=>"Company Shop Act Registration Pic",'height'=>150,'width'=>170]);?>
							<?php }else{ 
								echo $this->Html->image('user_docs/noimage.png', ["class"=>"img-responsive", "alt"=>"Profile Pic",'height'=>150,'width'=>170]); 
								} ?>
							<p>
								<?php echo $this->Form->input('Company Shop Act Registration', ['type' => 'file', 'class' => 'form-control', 'name' => 'company_shop_registration']); ?>
							</p>
						</div>
					</div>
				 </div>
				</fieldset>
				<fieldset>
				<legend><b>Description</b></legend>
					<div>
						<div class="form-group col-md-12">
							<textarea name="description" class="form-control" id="description" placeholder="Enter Here" rows="3"><?php echo $users['description'] ?></textarea>
						</div> 
					</div>
				</fieldset>
            </div>
			   
              <div class="box-footer">
				<center>
					<button type="submit" class="btn btn-primary">Update Profile</button>
				</center>	
              </div>
            </form>
          </div>
            
        </div>
         
      </div>
      <!-- /.row -->
    </section>

   
<script>

$(document).ready(function(){	 

	$(document).on('blur',".city_select",function(){
		var master=$(this);
		master.closest('div').find('div.suggesstion-box').delay(2000).fadeOut(1000);
	});
	$("#city-search-box").keyup(function(){
		var input=$("#city-search-box").val(); 
			var noofrows=$(this).attr('noofrows');
			var taxboxname=$(this).attr('taxboxname');
			var master=$(this);
			var m_data = new FormData();
			m_data.append('input',input);
			m_data.append('noofrows',noofrows);
			m_data.append('taxboxname',taxboxname);
		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "Users", "action" => "ajaxCity"]); ?>",
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
			"p_contact": {
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
			"locality": {
				required: true
			},
			"pincode": {
				required: true
			},
			"description": {
				required: true
			},
			"hotel_rating": {
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
			"p_contact": {
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
			"locality": {
				required: "Please enter locality."
			},
			"pincode": {
				required: "Please enter pincode."
			},
			"description": {
				required: "Please enter description."
			},
			"hotel_rating": {
				required: "Please select rating."
			}
		},
		ignore: ":hidden:not(select)"
	});
	var profile_pic = '<?php echo $users["profile_pic"]; ?>';
	var role_id = '<?php echo $users["role_id"]; ?>';
	var company_img_1 = '<?php echo $users["company_img_1_pic"]; ?>';
	var pancard = '<?php echo $users["pancard_pic"]; ?>';
	var id_card = '<?php echo $users["id_card_pic"]; ?>';
	var company_shop_registration = '<?php echo $users["company_shop_registration_pic"]; ?>';
	var profile_pic_flag = true;
	var company_img_1_pic_flag = true;
	var pancard_pic_flag = true;
	var id_card_pic_flag = true;
	var company_shop_registration_pic_flag = true;
	if(profile_pic != "") {
		profile_pic_flag = false;
	}
	if(company_img_1 != "") {
		company_img_1_pic_flag = false;
	}
	if(pancard != "") {
		pancard_pic_flag = false;
	}
	if(id_card != "") {
		id_card_pic_flag = false;
	}
	if(company_shop_registration != "") {
		company_shop_registration_pic_flag = false;
	}

	var travel_certificate_flag = false;
	var hotel_category_flag = false;
	if(role_id == "1") {
		var travel_certificate_flag = true;
		var hotel_category_flag = false;
	} else if(role_id == "3") {
		var travel_certificate_flag = false;
		var hotel_category_flag = true;
	}
	var settings = $('#UserRegisterForm').validate().settings;
	$.extend(true, settings, {
		rules: {
		  /* "profile_pic": {
			   required: profile_pic_flag
			},
			"company_img_1": {
				required: company_img_1_pic_flag
			},
			"pancard": {
				required: pancard_pic_flag
			},
			"id_card": {
				required: id_card_pic_flag
			},
			"company_shop_registration": {
				required: company_shop_registration_pic_flag
			},*/
			"hotel_categories": {
				required: hotel_category_flag
			}
		},
		messages: {
			/*"profile_pic" : {
				required : "Please upload profile pic."
			},
			"company_img_1": {
				required: "Please upload company image 1."
			},
			"pancard": {
				required: "Please upload pancard."
			},
			"id_card": {
				required: "Please upload id card."
			},
			"company_shop_registration": {
				required: "Please upload company shop registration."
			},*/
			"hotel_categories": {
				required: "Please select hotel categories."
			}
		}
	});
 });
	function selectCountry(value,city_code,state) {
		var state_id=state;
		$("#city-search-box").val(value);
		$(".suggesstion-box").hide();
		$(".cityCode").val(city_code);
		$("#city_id").val(city_code);
		var m_data = new FormData();
		m_data.append('state_id',state_id);			
		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "Users", "action" => "ajaxStateShow"]); ?>",
			data: m_data,
			processData: false,
			contentType: false,
			type: 'POST',
			dataType:'text',
			success: function(data)
			{
				$(".shw").html(data);
			}
		});	
	}
 </script>