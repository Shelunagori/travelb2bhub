 <style>
	#country-list{list-style:none;margin-left: 1px;padding:0;width:auto; margin-top: 10px;}
	#country-list li{padding-left: 10px;padding-top: 7px; background: #efeeee85 ; border-bottom: #bbb9b9 1px solid; height:35px;top:2px}
	#country-list li:hover{background:#d8d4d4;cursor: pointer;}
	.column_column ul li, .column_helper ul li, .column_visual ul li, .icon_box ul li, .mfn-acc ul li, .ui-tabs-panel ul li, .post-excerpt ul li, .the_content_wrapper ul li{margin-bottom:0px !important}
	#search-box{border: #e2e2e2 1px solid;border-radius:4px;}
	#Content{ width:90% !important; margin-left: 5%;}
	select:focus {background-color:#FFF !important;}
	input:focus {background-color:#FFF !important;}
	input[type="text"]:focus {background-color:#FFF !important;}
</style>

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
                  <input type="textbox" class="form-control" required autocomplete="off" id="city-search-box" name="city" placeholder="where you want to go?">
				  <div class="suggesstion-box" style="margin-top:-10px"></div>
                </div>
				<div class="col-md-12">
				<div class="form-group col-md-4">
					  <label for="exampleInputPassword1">PinCode</label>
					  <input type="text" class="form-control" id ="pincode" value = "<?php echo (!empty($users['pincode']))?$users['pincode']:""; ?>"name="pincode" placeholder="Enter Pincode">
				</div>
				<div class="shw">
					<div class="form-group col-md-4">
						  <label>States</label>
						  <?php echo $this->Form->input('state_id',['label' => false,'class'=>'form-control select2','options'=>$states_show,'empty'=>'---Select--Please---']);?>
					</div>

					<div class="form-group col-md-4">
						  <label>Country</label>
						  <?php echo $this->Form->input('country_id',['label' => false,'class'=>'form-control select2','options'=>$country_show]);?>
					</div>
				
				</div> 
				
				<div class="form-group col-md-12">
                  <label>Select Preference</label>
                   <?php 
                            $selectedPreferenceStates = "";
                            if(!empty($users['preference'])) {
                                $selectedPreferenceStates = explode(",", $users['preference']);
                            }	
                            echo $this->Form->control('preference', ["value"=>$selectedPreferenceStates, "id"=>"preference", "type"=>"select", 'options' =>$allStates, "multiple"=>true , "class"=>"form-control chosen-select", "data-placeholder"=>"Select Some States", "style"=>"height:125px;"]); ?>
                </div>
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

<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
   
<script>

$(document).ready(function(){	 
		$("#city-search-box").keyup(function(){
		var input=$("#city-search-box").val();
 		var m_data = new FormData();
		m_data.append('input',input);			
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
		
	});
	function selectCountry(value,city_code,state) {
		
		var state_id=state;
		$("#city-search-box").val(value);
		$(".suggesstion-box").hide();
		$(".cityCode").val(city_code);
			 	
			var m_data = new FormData();
		m_data.append('state_id',state_id);			
		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "Users", "action" => "ajax_state_show"]); ?>",
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