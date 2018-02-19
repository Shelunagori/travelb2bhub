  <?php echo $this->Html->script(['jquery.validate']);?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
	var cityData = '<?php echo $allCities; ?>';
	$(document).ready(function () {
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
 
<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
				 <?php 
				 
				 $role_id=$this->request->session()->read('Auth.User.role_id');
				 ?>
				<div class="form-group col-md-4">
                  <label>Category</label>
                  <select class="form-control">
                    <option>--Select--Please---</option>
                    <option value="1" <?php if($role_id== 1){ echo "Selected"; }?> >Travel Agent</option>
                    <option value="2" <?php if($role_id== 2){ echo "Selected"; }?> >Event Planner</option>
                    <option value="3" <?php if($role_id== 3){ echo "Selected"; }?> >Hotelier</option>
                  </select>
                </div>
				 <div class="form-group col-md-4">
                  <label>First Name</label>
                  <input type="text" class="form-control" name="first_name" value="<?php echo $users['first_name'] ?>" id="first_name" placeholder="First Name">
                </div>
				 <div class="form-group col-md-4">
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
                  <input type="text" class="form-control" name="address1" value="<?php echo $users['address1'] ?>" id="address1" placeholder="Enter Here">
                </div>
				
				<div class="form-group col-md-6">
                  <label>Locality</label>
                  <input type="text" class="form-control" name="locality" value="<?php echo $users['locality'] ?>" id="locality" placeholder="Enter Here">
                </div>
				 <div class="form-group col-md-6">
                  <label>City</label>
                  <select class="form-control">
                    <option>--Select--Please---</option>
                    <option value="1" <?php if($role_id== 1){ echo "Selected"; }?> >Travel Agent</option>
                    <option value="2" <?php if($role_id== 2){ echo "Selected"; }?> >Event Planner</option>
                    <option value="3" <?php if($role_id== 3){ echo "Selected"; }?> >Hotelier</option>
                  </select>
                </div>
				
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" id="exampleInputFile">

                  <p class="help-block">Example block-level help text here.</p>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> Check me out
                  </label>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
            
        </div>
         
      </div>
      <!-- /.row -->
    </section>
 
  <div id="profile_edit" class="container-fluid">
    <div class="row equal_column">
          <div class="col-lg-12 col-md-9 col-sm-9 col-xs-12 padding0">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 border_bottom">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 ">
                     <h4 class="title">Edit Profile</h4>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 ">
                   
                   
                    
          
          <hr class="hr_bordor">
        <p><!--<strong>This site is currently being refined to serve you better. You will be notified in the next few days, once the website is fully functional</strong>--></p>
        <div class="form" >
            <?php $pararm = $users['id']; ?>
			<?php  echo $this->Form->create("Users", ['type' => 'file', 'url' => ['controller' => 'Users', 'action' => 'edit',$pararm], 'id'=>"UserRegisterForm"]); ?>
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-b20">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_category">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt margin-b10">
                    <div class="input-field">
                      <label for="from">User Category</label>
                      <input type="text" class="form-control" name="" disabled value="<?php if($this->request->session()->read('Auth.User.role_id') == 1) {echo "Travel Agent";} elseif($this->request->session()->read('Auth.User.role_id') == 2) { echo "Event Planner";} else {echo "Hotelier";} ?>"/>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
                    <div class="input-field">
                      <label for="from">First Name<span class="asterisk">
                                                    <img src="../img/Asterisk.png" class="img-responsive">
                                                </span></label>
                      <input type="text" class="form-control" name="first_name" value="<?php echo $users['first_name'] ?>" id="first_name" placeholder="Enter Here"/>
                    </div>
                 </div>
                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
                    <div class="input-field">
                      <label for="from">Last Name<span class="asterisk">
                                                    <img src="../img/Asterisk.png" class="img-responsive">
                                                </span></label>
                      <input type="text" class="form-control" name="last_name" value="<?php echo $users['last_name'] ?>" id="last_name" placeholder="Enter Here"/>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
                    <div class="input-field">
                      <label for="from">Company Name<span class="asterisk">
                                                    <img src="../img/Asterisk.png" class="img-responsive">
                                                </span></label>
                      <input type="text" class="form-control" name="company_name" value="<?php echo $users['company_name'] ?>" id="company_name" placeholder="Enter Here"/>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
                    <div class="input-field">
                      <label for="from">Email<span class="asterisk">
                                                    <img src="../img/Asterisk.png" class="img-responsive">
                                                </span></label>
                      <input type="text" name="email" class="form-control" value="<?php echo $users['email'] ?>" id="email" placeholder="Enter Here" disabled/>
                    </div>
                  </div>
                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
                    <div class="input-field">
                      <label for="from"> Mobile Number<span class="asterisk">
                                                    <img src="../img/Asterisk.png" class="img-responsive">
                                                </span></label>
                      <input type="text" class="form-control" name="mobile_number" value="<?php echo str_replace(' ','',$users['mobile_number']); ?>" id="mobile_number" placeholder="Enter Here"/>
                    </div>
                 </div>
                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
                    <div class="input-field">
                      <label for="from">Secondary Contact<span class="asterisk">
                                                    <img src="../img/Asterisk.png" class="img-responsive">
                                                </span></label>
                      <input type="text" name="p_contact" class="form-control" value="<?php echo $users['p_contact'] ?>" id="p_contact" placeholder="Secondary Contact Number"/>
                    </div>
                 </div>

                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
                    <div class="input-field">
                      <label for="from">Address Line 1<span class="asterisk">
                                                    <img src="../img/Asterisk.png" class="img-responsive">
                                                </span></label>
                      <input type="text" class="form-control" name="address" value="<?php echo $users['address'] ?>" id="address" placeholder="Enter Here"/>
                    </div>
                 </div>

                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
                    <div class="input-field">
                      <label for="from">Address Line 2</label>
                      <input type="text" class="form-control" name="address1" value="<?php echo $users['address1'] ?>" id="address1" placeholder="Enter Here"/>
                    </div>
                 </div>

                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
                    <div class="input-field">
                      <label for="from">Locality<span class="asterisk">
                                                    <img src="../img/Asterisk.png" class="img-responsive">
                                                </span></label>
                      <input type="text" class="form-control" name="locality" value="<?php echo $users['locality'] ?>" id="locality" placeholder="Enter Here"/>
                    </div>
                 </div>



                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
                    <div class="input-field">
                      <label for="from">City<span class="asterisk">
                                                    <img src="../img/Asterisk.png" class="img-responsive">
                                                </span></label>
                      <input type="text" class="form-control" id="city_name" name="city_name" value="<?php echo (!empty($users['city_id']))?$allCityList[$users['city_id']]:"" ;?>" placeholder="Select city/nearest city"/>
                    <input type='hidden' id='city_id' name="city_id" value="<?php echo (!empty($users['city_id']))?$users['city_id']:"" ?>" />
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
                    <div class="input-field">
                      <label for="from">State</label>
                      <input type="text" class="form-control" id ="state_name" value = "<?php echo (!empty($users['state_id']))?$allStates[$users['state_id']]:""; ?>"name="state_name" placeholder="Select State" readonly/>
                        <input type='hidden' id='state_id' name="state_id" value="<?php echo (!empty($users['state_id']))?$users['state_id']:""; ?>" />
                    </div>
                 </div>

                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
                    <div class="input-field">
                      <label for="from">Country</label>
                      <input type="text" class="form-control" id ="country_name" Value ="India" name="country_name" placeholder="Select Country" readonly/>
                        <input type='hidden' id='country_id' name="country_id" value="<?php echo (!empty($users['country_id']))?$users['country_id']:""; ?>" />
                    </div>
                 </div>
                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
                    <div class="input-field">
                      <label for="from">Pincode<span class="asterisk">
                                                    <img src="../img/Asterisk.png" class="img-responsive">
                                                </span></label>
                      <input type="text" class="form-control" id ="pincode" value = "<?php echo (!empty($users['pincode']))?$users['pincode']:""; ?>"name="pincode" placeholder="Enter Pincode"/>
                    </div>
                 </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
                    <div class="input-field">
                      <label for="from">Website URL</label>
                      <input type="text" class="form-control" id ="web_url" value = "<?php echo (!empty($users['web_url']))?$users['web_url']:""; ?>" name="web_url" placeholder="Website URL"/>
                    </div>
                </div>

            <?php if($this->request->session()->read('Auth.User.role_id') == 1) { ?>
                <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt margin-b10">
                    <div id="preferenceStateDiv" >
                        <label for="Preference_States">States where you operate</label>
                        <img src="/img/detail-ico.png" alt="" title="Select upto 5 states where you can organized Travel Packages, Hotel Rooms, or Transportation Services for other Users."/>
                        <div class="input-field">
                            <?php 
                            $selectedPreferenceStates = "";
                            if(!empty($users['preference'])) {
                                $selectedPreferenceStates = explode(",", $users['preference']);
                            }	
                            echo $this->Form->control('preference', ["value"=>$selectedPreferenceStates, "id"=>"preference", "type"=>"select", 'options' =>$allStates, "multiple"=>true , "class"=>"form-control chosen-select", "data-placeholder"=>"Select Some States", "style"=>"height:125px;"]); ?>
                        </div>
                     </div>
                </div>
            
		<?php } ?>
		  </div>
                </div>
                
            <?php if($this->request->session()->read('Auth.User.role_id') == 1) { ?>
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-b20">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_category">
            
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
					<h3 style="color: #000;">Certificates</h3>
					<div class="table-responsive" id="table_responsive">
                        <table class="table">
                            <thead>
                              <tr>
                                <th style="">Sr. No.</th>
                                <th style="">Certificate Name</th>
                                <th style="">Certificate Image</th>
                                <th style="">Previous Uploaded Image</th>
                              </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td >1.</td>
                                    <td>IATA</td>
                                    <td><?php echo $this->Form->input('IATA Pic', ['type' => 'file', 'class' => 'form-control', 'name' => 'iata_pic']); ?></td>
                                    <td>
                                        <div>
                                        <?php if(!empty($users['iata_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['iata_pic'])) { 
                                        echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['iata_pic'], ["alt"=>"IATA Pic", "height"=>150]);?>
                                        <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td >2.</td>
                                    <td>T A F I Pic</td>
                                    <td><?php echo $this->Form->input('T A F I Pic', ['type' => 'file', 'class' => 'form-control', 'name' => 'tafi_pic']); ?></td>
                                    <td>
                                        <div>
                                        <?php if(!empty($users['tafi_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['tafi_pic'])) { 
                                        echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['tafi_pic'], ["alt"=>"T A F I Pic", "height"=>150]);?>
                                        <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td >3.</td>
                                    <td>T A A I Pic</td>
                                    <td><?php echo $this->Form->input('T A A I Pic', ['type' => 'file', 'class' => 'form-control', 'name' => 'taai_pic']); ?></td>
                                    <td>
                                        <div>
                                        <?php if(!empty($users['taai_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['taai_pic'])) { 
                                        echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['taai_pic'], ["alt"=>"T A A I Pic", "height"=>150]);?>
                                        <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td >4.</td>
                                    <td>I A T O Pic</td>
                                    <td><?php echo $this->Form->input('IATO Pic', ['type' => 'file', 'class' => 'form-control', 'name' => 'iato_pic']); ?></td>
                                    <td>
                                        <div>
                                        <?php if(!empty($users['iato_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['iato_pic'])) { 
                                        echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['iato_pic'], ["alt"=>"I A T O Pic", "height"=>150]);?>
                                        <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td >5.</td>
                                    <td>A D Y O I Pic</td>
                                    <td><?php echo $this->Form->input('A D Y O I Pic', ['type' => 'file', 'class' => 'form-control', 'name' => 'adyoi_pic']); ?></td>
                                    <td>
                                        <div>
                                        <?php if(!empty($users['adyoi_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['adyoi_pic'])) { 
                                        echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['adyoi_pic'], ["alt"=>"A D Y O I Pic", "height"=>150]);?>
                                        <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td >6.</td>
                                    <td>I S O 9001 Pic</td>
                                    <td><?php echo $this->Form->input('I S O 9001 Pic', ['type' => 'file', 'class' => 'form-control', 'name' => 'iso9001_pic']); ?></td>
                                    <td>
                                        <div>
                                        <?php if(!empty($users['iso9001_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['iso9001_pic'])) { 
                                        echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['iso9001_pic'], ["alt"=>"I S O 9001 Pic", "height"=>150]);?>
                                        <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td >7.</td>
                                    <td>U F T A A Pic</td>
                                    <td><?php echo $this->Form->input('U F T A A Pic', ['type' => 'file', 'class' => 'form-control', 'name' => 'uftaa_pic']); ?></td>
                                    <td>
                                        <div>
                                        <?php if(!empty($users['uftaa_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['uftaa_pic'])) { 
                                        echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['uftaa_pic'], ["alt"=>"U F T A A Pic", "height"=>150]);?>
                                        <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td >8.</td>
                                    <td>A D T O I Pic</td>
                                    <td><?php echo $this->Form->input('A D T O I Pic', ['type' => 'file', 'class' => 'form-control', 'name' => 'adtoi_pic']); ?></td>
                                    <td>
                                        <div>
                                        <?php if(!empty($users['adtoi_pic']) && file_exists(WWW_ROOT."img".DS."user_travel_certificates".DS.$users['id'].DS.$users['adtoi_pic'])) { 
                                        echo $this->Html->image('user_travel_certificates/'.$users['id'].'/'.$users['adtoi_pic'], ["alt"=>"A D T O I Pic", "height"=>150]);?>
                                        <?php } ?>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
					</div>
				</div>
				</div>
				</div>
             
            
			<?php } elseif($this->request->session()->read('Auth.User.role_id') == 3) { ?>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-b20">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_category">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
					<div class="input-field">
						<label for="from">Hotel Rating<span class="asterisk">
                                                    <img src="../img/Asterisk.png" class="img-responsive">
                                                </span></label>
						<?php
						$hotel_rating = (!empty($users['hotel_rating']))? $users['hotel_rating']:""; ?>		



<div class="input-field">

			<div style=" width: 200px;" >
			<input style="display:none;" type="radio" checked value="0" name="hotel_rating"/>
       <input class="star star-5" id="star-5-21" type="radio" value="5" <?php if($hotel_rating=="5") {echo "checked";} ?> name="hotel_rating"/>
       <label class="star star-5" for="star-5-21"></label>
       <input class="star star-4" id="star-4-21" type="radio" value="4" <?php if($hotel_rating=="4") {echo "checked";} ?> name="hotel_rating"/>
       <label class="star star-4" for="star-4-21"></label>
       <input class="star star-3" id="star-3-21" type="radio" value="3" <?php if($hotel_rating=="3") {echo "checked";} ?>  name="hotel_rating"/>
       <label class="star star-3" for="star-3-21"></label>
       <input class="star star-2" id="star-2-21" type="radio" value="2" <?php if($hotel_rating=="2") {echo "checked";} ?> name="hotel_rating"/>
       <label class="star star-2" for="star-2-21"></label>
       <input class="star star-1" id="star-1-21" type="radio" value="1" <?php if($hotel_rating=="1") {echo "checked";} ?> name="hotel_rating"/>
       <label class="star star-1" for="star-1-21"></label>
       </div> </div>





					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
					<div class="input-field">
						<label for="from">Hotel Categories</label>
						<?php 
						$selectedCetegories = (!empty($users['hotel_categories']))? explode(",",$users['hotel_categories']):"";
						echo $this->Form->control('hotel_categories', ["id"=>"hotel_categories", "type"=>"select", "empty"=>"Select Hotel Categories", 'options' =>$hotelCategories, "value"=>$selectedCetegories , "class"=>"form-control chosen-select"]);?>
					</div>
				</div>
				</div>
				</div>
			<?php } ?>          
			 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-b20">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_category">
          
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
              <div class="thumbnail min_height220">               
                  <?php echo $this->Form->input('Profile Picture', ['type' => 'file', 'class' => 'form-control', 'name' => 'profile_pic']); ?>
                   <div>
                    <?php if(!empty($users['profile_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['profile_pic'])) {
                    echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['profile_pic'], ["class"=>"img-responsive", "alt"=>"Profile Pic", "height"=>150]);?>
                    <?php } ?>
                </div>
              </div>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
               <div class="thumbnail min_height220">
               
                  <?php 
                  if($this->request->session()->read('Auth.User.role_id') == 1 or $this->request->session()->read('Auth.User.role_id') == 2) {
                    echo $this->Form->input('Photograph of your office (Pic 1)', ['type' => 'file', 'class' => 'form-control', 'name' => 'company_img_1' ]);
                  }else{
                      echo $this->Form->input('Photograph of your Hotel-1', ['type' => 'file', 'class' => 'form-control', 'name' => 'company_img_1' ]);
                  }		  ?>
                    <div>
                    <?php if(!empty($users['company_img_1_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['company_img_1_pic'])) { 
                    echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['company_img_1_pic'], ["class"=>"img-responsive", "alt"=>"Company Image 1 Pic", "height"=>150]);?>
                    <?php } ?>
                </div>
              </div>
          </div>

		  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
               <div class="thumbnail min_height220">			
                  <?php  if($this->request->session()->read('Auth.User.role_id') == 1 or $this->request->session()->read('Auth.User.role_id') == 2) {
                    echo $this->Form->input('Photograph of your office (Pic 2)', ['type' => 'file', 'class' => 'form-control', 'name' => 'company_img_2' ]);
                  }else{
                      echo $this->Form->input('Photograph of your Hotel-2', ['type' => 'file', 'class' => 'form-control', 'name' => 'company_img_2' ]);
                  }?>
                 <div>
                    <?php if(!empty($users['company_img_2_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['company_img_2_pic'])) { 
                    echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['company_img_2_pic'], ["class"=>"img-responsive", "alt"=>"Company Image 2 Pic", "height"=>150]);?>
                    <?php } ?>
                 </div>
			</div>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
              <div class="thumbnail min_height220">		
			       <?php echo $this->Form->input('Pan Card', ['type' => 'file', 'class' => 'form-control', 'name' => 'pancard', "pancard"]); ?>
                    <div>
                        <?php if(!empty($users['pancard_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['pancard_pic'])) { 
                        echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['pancard_pic'], ["class"=>"img-responsive", "alt"=>"Pan Card Pic", "height"=>150]);?>
                        <?php } ?>
                    </div>
              </div>
          </div>


          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
              <div class="thumbnail min_height220">		
                    <?php echo $this->Form->input('Business card', ['type' => 'file', 'class' => 'form-control', 'name' => 'id_card','id'=>'id_card']); ?>
                    <div>
                        <?php if(!empty($users['id_card_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['id_card_pic'])) { 
                        echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['id_card_pic'], ["class"=>"img-responsive", "alt"=>"Business card Pic", "height"=>150]);?>
                        <?php } ?>
                    </div>
              </div>
          </div>

		  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt margin-b10">
              <div class="thumbnail min_height220">	
			        <?php echo $this->Form->input('Company Shop Act Registration', ['type' => 'file', 'class' => 'form-control', 'name' => 'company_shop_registration']); ?>
              <div>
				<?php if(!empty($users['company_shop_registration_pic']) && file_exists(WWW_ROOT."img".DS."user_docs".DS.$users['id'].DS.$users['company_shop_registration_pic'])) {
				echo $this->Html->image('user_docs/'.$users['id'].'/'.$users['company_shop_registration_pic'], ["class"=>"img-responsive", "alt"=>"Company Shop Act Registration Pic", "height"=>150]);?>
				<?php } ?>
              </div>
			</div>
          </div>
            </div>
          </div>
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-b20">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user_category">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt margin-b20">
			 <div class="input-field">
                 <label for="from">Description<span class="asterisk">
                                                    <img src="../img/Asterisk.png" class="img-responsive">
                                                </span></label>
                 <textarea name="description" class="form-control" id="description" placeholder="Enter Here" col="10" row="10"><?php echo $users['description'] ?></textarea>
			 </div>
		  </div>
            </div>
		  </div>
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
              <div class="margi1">
                <input type="submit" name="submit" class="btn btn-primary btn-block " value="Update Profile ">
              </div>
           </div>
        </form>
        </div>
     
</div>
</div>
</div>
</div>

<?php echo $this->element('footer');?>
 <?php echo $this->Html->css(['telinput/css/intlTelInput']);?>
  <?php echo $this->Html->script(['telinput/intlTelInput']);?>
  <?php echo $this->Html->script(['telinput/utils']);?>
  <?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
 $.validator.addMethod("needsSelection", function (value, element) {
	var count = $(element).find('option:selected').length;
	if(count == 0)
		return false;
	if(count > 0 && count < 6)
		return true;
	else
		return false;
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
		"p_contact": {
			required: true,
			number: true,
			minlength:10,
  			maxlength:10
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
		"p_contact": {
			required: "Please enter secondary contact number.",
number: "Please enter only number",
			minlength: "Please enter at least 10 digit",
			maxlength: "Please enter no more than 10 digit"
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
</script>
 <?php echo $this->Html->css(['chosen/chosen']);?>
 <?php echo $this->Html->script(['chosen/chosen.jquery']);?>
 <?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php if($this->request->session()->read('Auth.User.role_id') == 1) { ?>
	<script>
		var needPreferenceState = true;
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
		$(document).ready(function($){
			$(".chosen-select").chosen();
			alert();
		});
        
        
        
        function DoubleScroll(element) {
                var scrollbar= document.createElement('div');
                scrollbar.appendChild(document.createElement('div'));
                scrollbar.style.overflow= 'auto';
                scrollbar.style.overflowY= 'hidden';
                scrollbar.firstChild.style.width= element.scrollWidth+'px';
                scrollbar.firstChild.style.paddingTop= '1px';
                scrollbar.firstChild.appendChild(document.createTextNode('\xA0'));
                scrollbar.onscroll= function() {
                    element.scrollLeft= scrollbar.scrollLeft;
                };
                element.onscroll= function() {
                    scrollbar.scrollLeft= element.scrollLeft;
                };
                element.parentNode.insertBefore(scrollbar, element);
            }

            DoubleScroll(document.getElementById('table_responsive'));
	</script>
<?php } ?>
<script>
    $("#mobile_number").intlTelInput({

formatOnDisplay: false,
      initialCountry: "in",
      onlyCountries: ['in'],
       separateDialCode: true,


      
    });
  </script>
<script>
    $("#p_contact").intlTelInput({
     formatOnDisplay: false,
       initialCountry: "in",
      onlyCountries: ['in'],
       separateDialCode: true
    });
  </script>