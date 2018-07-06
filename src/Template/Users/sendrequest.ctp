
<style>
.hr{
	margin-top:25px !important;
}	
a:hover,a:focus{
    outline: none !important;
    text-decoration: none !important;
}
.tab .nav-tabs{
    display: inline-block !important;
    background: #F0F0F0 !important;
    border-radius: 50px !important;
    border: none !important;
    padding: 1px !important;
}
.tab .nav-tabs li{
    float: none !important;
    display: inline-block !important;
    position: relative !important;
}
.tab .nav-tabs li a{
    font-size: 16px !important;
    font-weight: 700 !important;
    background: none !important;
    color: #999 !important;
    border: none !important;
    padding: 10px 15px !important;
    border-radius: 50px !important;
    transition: all 0.5s ease 0s !important;
}
.tab .nav-tabs li a:hover{
    background: #1295A2 !important;
    color: #fff !important;
    border: none !important;
}
.tab .nav-tabs li.active a,
.tab .nav-tabs li.active a:focus,
.tab .nav-tabs li.active a:hover{
    border: none !important;
    background: #1295A2 !important;
    color: #fff !important;
}
.tab .tab-content{
    font-size: 14px !important;
    color: #686868 !important;
    line-height: 25px !important;
    text-align: left !important;
    padding: 5px 20px !important;
}
.tab .tab-content h3{
    font-size: 22px !important;
    color: #5b5a5a !important;
}
fieldset{
	margin:10px !important;
	border-radius: 6px;
}
.plus_minus_btn{
	height:30px;
	width:40px;
}
.col-md-6
{
	margin-top:10px !important;
}
.col-md-4
{
	margin-top:10px !important;
}
.col-md-3
{
	margin-top:10px !important;
}
.col-md-5
{
	margin-top:6px !important;
}
.col-md-7
{
	margin-top:6px !important;
}
.newColmd4{
	width:33.33333333%;
	float: left;
	position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
	 margin-top: 6px;
}	
.box-room {
    border: 1px solid #eee;
    padding: 5px; 
	float:left;
	padding-bottom: 8px;
}
label {
    display: flex !important;
}
/* p{
	color:#96989A !important;
	font-weight:100;	
} */
</style>
</div>
<div class="container-fluid">
	<div class="box box-primary">
		<div class="box-body" style="padding:15px !important;">
		<div class="row"> 
		 
		<div class=" "> 
		<div id="tra-sendrequest" class=" " style="background:#FFF">
			<div class=" ">
			<div class="tab-content tab">
				<div align="center">
					<ul class="nav nav-tabs" >
						<li class="active"><a href="#tab1" data-toggle="tab">Hotel</a></li>
						<li><a id="tabtransport" href="#tab3" data-toggle="tab">Transport</a></li>
						<li ><a href="#tab2" data-toggle="tab">Package</a></li>
 					</ul>
					<ul>
						<li style="color:red;margin-top:15px;"><?php echo ($PlaceReqCount); ?> Requests Remaining</li>
					</ul>
				</div>
				</br>
				
<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
<div id="loader"></div>
</div>				
<div class="tab-pane active" id="tab1">
<?php
 echo $this->Form->create(null, [
	'type' => 'file',
	'url' => ['controller' => 'Users', 'action' => 'sendrequest'], "id"=>"HotelRequestForm"
]);
?>
<input autocomplete="off" name="category_id" type="hidden" value="3" class="form-control" id="date-start" placeholder="Reference id"/>
<div class="form-box">
	<div class="panel-group" id="HotelAccordion" style="background-color:white;margin-top:-20px;">
		<div class="panel">
				<fieldset>
					  <legend style="color:#369FA1;"><b> &nbsp; GENERAL REQUIREMENTS &nbsp;  </b></legend>
					  <div class="row">
 						<div class="col-md-12 ">
							<div class="col-md-12 ">
								<div class="input-field">
									<p for="from" >
										Reference ID <span class="required" >*</i></span>
										(This is for your reference )
									</p>
									<input autocomplete="off" name="reference_id" type="text" class="form-control ref2 " id="reference_id" required placeholder="Reference ID" autofocus/>
								</div>
							</div>
						</div>
					</div> 
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-4">
								<div class="input-field">
									<p for="from">
										Total Budget  <span class="required">*</span>
									</p>
									<input autocomplete="off" name="total_budget" type="text" min="1" class="form-control" id="total_budget" placeholder="Total Budget" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" />
								</div>
							</div>
							<div class="col-md-4">
								<p for="from">Adults <span class="required">*</span></p>
								<?php echo $this->Form->control('hotelAdult', ["type"=>"text","min"=>0, "class"=>"form-control input-medium", 'p' => false, 'div' => false, "placeholder"=>"0",'oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"]); ?>
							</div>
							<div class="col-md-4">
								<p for="from">Children Below 6 </p>
								<?php echo $this->Form->control('hotelChildren', ["type"=>"text","min"=>0, "class"=>"form-control input-medium", 'p' => false, 'div' => false, "placeholder"=>"0",'oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"]); ?>
							</div>							 
						</div>
					</div>
				</fieldset>
				<fieldset>
					<legend style="color:#369FA1;"><b> &nbsp;  STAY REQUIREMENTS  &nbsp; </b></legend>
				<div class="row">
				<div class="col-md-12">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
						<div class="input-field maindivs">
							<p for="from">No. of Rooms <span class="required">*</span></p>
							<div class="box-room">
								<div class="col-md-7"> Single</div>
								<div class="col-md-5"><input autocomplete="off" name="room1" type="text" min="0" style="height: 27px;" class="form-control number hotelroom" id="from-place" placeholder="0" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"/></div>

								<div class="col-md-7"> Double</div>
								<div class="col-md-5"><input autocomplete="off" name="room2" type="text" min="0" style="height: 27px;" class="form-control number hotelroom" id="from-place" placeholder="0" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"/></div>

								<div class="col-md-7"> Triple</div>
								<div class="col-md-5"><input autocomplete="off" name="room3" type="text" min="0" style="height: 27px;" class="form-control number hotelroom" id="from-place" placeholder="0" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"/></div>

								<div class="col-md-7"> Child with bed</div>
								<div class="col-md-5"><input autocomplete="off" name="child_with_bed" style="height: 27px;" type="text" min="0" class="form-control hotelroom" id="from-place" placeholder="0" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"/></div>

								<div class="col-md-7"> Child without bed</div>
								<div class="col-md-5"><input autocomplete="off" name="child_without_bed" style="height: 27px;" type="text" min="0" class="form-control hotelroom" id="from-place" placeholder="0" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"/></div>
								
							</div>
							<p style="display:none;color:#ea3733;font-weight:100 !important;" id="showerror" > This field is required.</p>
						</div>
					</div>
			
 					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
						<div class="input-field">
						<p for="from">Hotel Rating</p>	
							<div style=" width: 200px;" >
								<input style="display:none;" type="radio" checked value="0" name="hotel_rating"/>
								<input class="star star-5" id="star-5-21" type="radio" value="5" name="hotel_rating"/>
								<label class="star star-5" for="star-5-21"></label>
								<input class="star star-4" id="star-4-21" type="radio" value="4" name="hotel_rating"/>
								<label class="star star-4" for="star-4-21"></label>
								<input class="star star-3" id="star-3-21" type="radio" value="3" name="hotel_rating"/>
								<label class="star star-3" for="star-3-21"></label>
								<input class="star star-2" id="star-2-21" type="radio" value="2" name="hotel_rating"/>
								<label class="star star-2" for="star-2-21"></label>
								<input class="star star-1" id="star-1-21" type="radio" value="1" name="hotel_rating"/>
								<label class="star star-1" for="star-1-21"></label>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
						<div class="input-field hotel_category">
							<p for="from">Hotel Category </p>
							<?php echo $this->Form->control('hotel_category', ["id"=>"h_hotel_category", "type"=>"select",'options' =>$hotelCategories, "multiple"=>true , "class"=>"form-control select2","data-placeholder"=>"Select Options ","style"=>"height:125px;"]);?>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
						<div class="input-field">
							<p for="from">Meal Plan</p>
 							<?php echo $this->Form->control('meal_plan', ["id"=>"h_hotel_category", "type"=>"select",'options' =>$MealPlans, "class"=>"form-control select2","data-placeholder"=>"Select Options ",'empty'=>'Select Options']);?>
 						</div>
					</div>
				</div>
				</div>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-4">
								<p>Locality</p>
								<input autocomplete="off" type="text" class="form-control" name="locality" placeholder="Enter Locality, Village or Town"/>
							</div>
						 
							<div class="col-md-4 form-group">
									<div class="input-field">
									<p for="from">
										Destination City
										<span class="required">*</span>
									</p>
									</div>
									<div>
										<input autocomplete="off" type="text" class="form-control city_select" id="h_city_name" name="h_city_name" noofrows="1" placeholder="Select City or Nearest City"/>
 										<input type='hidden' id='h_city_id' class="ctyidd city_real" name="h_city_id" />
										<div class="suggesstion-box" style="margin-top:-10px;"></div>
									</div>
							</div>
							<span class="shw">
								<div class="col-md-4 form-group">
									<div class="input-field">
										<p for="from">
										Destination State
										</p>
									</div>
									<div>
										<input type='hidden' id='h_state_id' name="h_state_id"/>
										<input type="text" class="form-control" id ="h_state_name" name="h_state_name" placeholder="State" readonly/>
									</div>
								</div>
							</span>
						</div>
					</div>	 
						<div class="row" style="display:none;">
							<div class="col-md-12">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt" >
									<div class="input-field">
										<p for="from">Destination Country</p>
										<input type="text" class="form-control" id ="h_country_name" name="h_country_name" placeholder="Country" readonly/>
										<input type='hidden' id='h_country_id' name="h_country_id"/>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
						<div class=" col-md-12">
								<div class="col-md-6">
									<div class="input-field">
										<p for="from">
											Check In
											<span class="required">*</span>
										</p>
									</div>
									<div class="">
									<input autocomplete="off" type="text" name="check_in" id="HotelDatePicker" class="form-control removeerror" data-date-format="dd-mm-yyyy" placeholder="DD-MM-YYYY"/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-field">
										<p for="from">
											Check Out <span class="required">*</span>
										</p>
									</div>
									<div class="">
										<input autocomplete="off" type="text" name="check_out" class="form-control removeerror" id="datepicker2" data-date-format="dd-mm-yyyy" placeholder="DD-MM-YYYY" />
									</div>
								</div>
							</div>
						</div>
					</fieldset>
							<fieldset>
								<legend style="color:#369FA1;"><b> &nbsp;  Comment Box &nbsp; </b></legend>
									<div class="row" style="margin-bottom: 10px;">
										<div class="col-md-12">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
												<div class="input-field">
													<textarea name="comment" class="form-control mt" cols="" rows="4" placeholder="Enter Comment"></textarea>
												</div>
											</div> 
										</div>
									</div>
							</fieldset>
							<div class="row">
								<div class="col-md-12">
									<div class="input-field">
										<div class="margin text-center">
										<center><input type="submit" class="btn btn-primary btn-submit" value="Submit" style="background-color:#1295A2"></center>
										</div>
									</div>
								</div> 
							</div>
						</div>
					</div>
				</div>
			</div>
<?= $this->Form->end()?>							
<div class="tab-pane " id="tab2" >
<?php
		echo $this->Form->create(null, [
			'type' => 'file',
			'url' => ['controller' => 'Users', 'action' => 'sendrequest'], "id"=>"PackgeRequestForm"
		]);
					?>
<input name="category_id" type="hidden" value="1" class="form-control" id="date-start" placeholder="Reference id"/>
<input type="hidden" name="user_id" value="<?php echo $users['id']; ?>"/>
<div class="form-box" >
	<div class="panel-group" id="accordion" style="background-color:white;margin-top:-20px;">
		<div class="panel ">
			<fieldset>
				  <legend style="color:#369FA1;"><b>  &nbsp; GENERAL REQUIREMENTS &nbsp; </b></legend>
					<div class="row">
						<div class="col-md-12">
						    <div class="col-md-12">
								<div class="input-field">
									<p for="from" >
										Reference ID 
										<span class="required">*</span>
										(This is for your reference )
									</p>
									<input name="reference_id" type="text" class="form-control ref2" id="Reference ID" placeholder="Reference ID" autocomplete="off" />
									 
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-4">
								<div class="input-field">
									<p for="from">
										Total Budget 
										<span class="required">*</span>										
									</p>
									<input autocomplete="off" name="total_budget" type="text" min="1" class="form-control" id="total_budget" placeholder="Total Budget" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" />
								</div>
							</div>
							<div class="col-md-4">
								<p for="from">Adults <span class="required">*</span></p>
								<?php echo $this->Form->control('adult', ["type"=>"text","min"=>0, "class"=>"form-control input-medium", 'p' => false, 'div' => false, "placeholder"=>"0",'oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"]); ?>
 							</div>
							<div class="col-md-4">
								<p for="from">Children Below 6  </p>
								<?php echo $this->Form->control('children', ["type"=>"text","min"=>0, "class"=>"form-control input-medium", 'p' => false, 'div' => false, "placeholder"=>"0",'oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"]); ?>
 							</div>
						</div>
					</div>
			</fieldset>
		 
		 
			<fieldset>
				
				<legend style="color:#369FA1;"><b> &nbsp; STAY REQUIREMENTS &nbsp; </b></legend>
				<div class="newdiv">
				<div class="row">
				<div class="col-md-12">
				<b><div class="Destination-title col-md-12"> Destination </div>	</b>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
						<div class="input-field">
							<p for="from">No. of Rooms <span class="required">*</span></p>
							<div class="box-room">
								<div class="col-md-7"> Single</div>
								<div class="col-md-5"><input autocomplete="off" name="room1" type="text" min="0" style="height: 27px;" class="form-control packageroom" id="room1room" placeholder="0" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"/></div>

								<div class="col-md-7"> Double</div>
								<div class="col-md-5"><input autocomplete="off" name="room2" type="text" min="0" style="height: 27px;" class="form-control packageroom" id="room2room" placeholder="0" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"/></div>

								<div class="col-md-7"> Triple</div>
								<div class="col-md-5"><input autocomplete="off" name="room3" type="text" min="0" style="height: 27px;" class="form-control packageroom" id="room3room" placeholder="0" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"/></div>

								<div class="col-md-7"> Child with bed</div>
								<div class="col-md-5"><input autocomplete="off" name="child_with_bed" style="height: 27px;" type="text" min="0" class="form-control packageroom" id="room4room" placeholder="0" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"/></div>

								<div class="col-md-7"> Child without bed</div>
								<div class="col-md-5"><input autocomplete="off" name="child_without_bed" style="height: 27px;" type="text" min="0" class="form-control packageroom" id="room5room" placeholder="0" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"/></div>
							</div>
							<p style="display:none;color:#ea3733;font-weight:100 !important;" id="showerror12" > This field is required.</p>
						</div>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
						<div class="input-field">
							<p>Hotel Rating</p>	
							<div style="width: 200px;" class="stars">
								<input style="display:none;" type="radio" checked value="0" name="hotel_rating"/>
								<input class="star star-5" id="star-5-2" type="radio" value="5" name="hotel_rating"/>
								<label class="star star-5" for="star-5-2"></label>
								<input class="star star-4" id="star-4-2" type="radio" value="4" name="hotel_rating"/>
								<label class="star star-4" for="star-4-2"></label>
								<input class="star star-3" id="star-3-2" type="radio" value="3" name="hotel_rating"/>
								<label class="star star-3" for="star-3-2"></label>
								<input class="star star-2" id="star-2-2" type="radio" value="2" name="hotel_rating"/>
								<label class="star star-2" for="star-2-2"></label>
								<input class="star star-1" id="star-1-2" type="radio" value="1" name="hotel_rating"/>
								<label class="star star-1" for="star-1-2"></label>
							 </div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
						<div class="input-field hotel_category">
							<p for="from">Hotel Category </p>
							<?php echo $this->Form->control('hotel_category', ["id"=>"h_hotel_category", "type"=>"select",'options' =>$hotelCategories, "multiple"=>true , "class"=>"form-control select2","data-placeholder"=>"Select Options ","style"=>"height:125px;"]);?>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
						<div class="input-field">
							<p for="from">Meal Plan</p>
							<?php echo $this->Form->control('meal_plan', ["id"=>"h_hotel_category", "type"=>"select",'options' =>$MealPlans, "class"=>"form-control select2","data-placeholder"=>"Select Options ",'empty'=>'Select Options']);?>
						</div>
					</div>
				</div>
				</div>
				
 					<div class="row">
						<div class="col-md-12 main_row">
							<div class="col-md-4 form-group">
								<p>Locality</p>
									<input type="text" autocomplete="off" class="form-control" name="locality" id="locality" placeholder="Enter Locality, Village or Town"/>
							</div>
						 
							<div class="col-md-4 form-group">
								<div class="input-field">
								<p for="from">
									Destination City <span class="required">*</span>
								</p>
								</div>
								<div>
								<input type="text" class="form-control city_select ctynamerecord" taxboxname="state_id" noofrows="6"  id="city_name" name="city_name" placeholder="Select City or Nearest City"/>
								<input type='hidden' class="ctyIDname city_real" id='city_id' name="city_id" />
								<div class="suggesstion-box" style="margin-top:-10px"></div>
								</div>
							</div>
							<div class="stateRpl">
								<div class="col-md-4 form-group">
									<div class="input-field">
										<p for="from">
											Destination State
										</p>
									</div>
									<div>
										<input type='hidden' id='state_id' name="state_id"/>
										<input type='text' autocomplete="off" name='state_name'  placeholder="Auto Populated" class="form-control input-large" />
									</div>
								</div>
							</div>
						</div>
					</div>	 
						<div class="row">
							<div class="col-md-12">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt" style="display:none;">
									<div class="input-field form-group">
										<p for="from">Destination Country</p>
										<input type="text" class="form-control" id ="country_name" name="country_name" placeholder="Auto Populated" readonly/>
										<input type='hidden' id='country_id' name="country_id"/>
									</div>
								</div>
							</div>
						</div> 	
						<div class="row">
							<div class=" col-md-12 main_row">
								<div class="col-md-6">
									<div class="input-field">
										<p for="from">
											Check In
											<span class="required">*</span>
										</p>
									</div>
									<div class="">
									<input autocomplete="off" type="text" name="check_in" class="form-control" id="datepickerofpkg" data-date-format="dd-mm-yyyy" placeholder="DD-MM-YYYY"/>
									</div>
									</div> 
								<div class="col-md-6">
									<div class="input-field">
										<p for="from">
											Check Out
											<span class="required">*</span>
										</p>
									</div>
									<div class="">
										<input autocomplete="off" type="text" name="check_out" class="form-control checkdatefornext" id="datepickerofpkg1" data-date-format="dd-mm-yyyy" placeholder="DD-MM-YYYY" />
										                    
									</div>
								</div> 
							</div>
						</div>
					
				
					<div class="input_fields_wrap1"></div>
					<div class="row">
						<div class="col-md-12" style="margin-top:5px">  
							<div class="col-md-12">  
								<button class="btn btn-primary btn-sm add_field_button2 " style="background-color:#1295A2;"><i class="fa fa-plus"></i> Add Destination</button>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			</div>	 
								 
								<fieldset>
									<legend style="color:#369FA1;"><b> &nbsp;  TRANSPORT REQUIREMENTS &nbsp; </b></legend>
									<div class="row">
										<div class="col-md-12 ">
											<div class="col-md-4 ">
												<div class="input-field">
													<p for="from">
														Select Transport <span class="required">*</span>
													</p>
												</div>
												<div class="">
												<?php echo $this->Form->control('transport_requirement', ["type"=>"select",'options' =>$postTravlePackageCategories, "class"=>"form-control select2","data-placeholder"=>"Select Options", "empty"=>'Select Options']);?>
												<label id="transport_requirement-error" class="error" for="transport_requirement"> </label>
 												</div>
											</div>
											<div class="col-md-4">
											<div class="input-field">
												<p for="from">
													Start Date <span class="required">*</span>
												</p>
											</div> 
											<input autocomplete="off" name="start_date" type="text" class="form-control " data-date-format="dd-mm-yyyy" id="packageTransport" placeholder="DD-MM-YYYY"/>
												                   
											 
										</div>
										<div class="col-md-4">
											<div class="input-field">
												<p for="from">
													End Date <span class="required">*</span>
												</p>
											</div>
											<input autocomplete="off" name="end_date" type="text" class="form-control" data-date-format="dd-mm-yyyy" id="packageTransport1" placeholder="DD-MM-YYYY"/>
										</div>	
											
										</div>
									</div>
							 
								<div class="row">
									<div class="col-md-12 main_row">
										<div class="col-md-4 form-group mt">
											<div class="input-field">
											<p for="from">Pickup Locality</p>
											<input autocomplete="off" type="text" class="form-control" name="pickup_locality" id="pickup_locality" placeholder="Enter Locality, Village or Town"/>
											</div>
										</div>
										<div class="col-md-4 mt form-group">
											<div class="input-field">
												<p for="from">Pickup City <span class="required">*</span></p>
												<input type="text" class="form-control city_select ctynamerecord" id="pickup_city_name" name="pickup_city_name"  placeholder="Select City or Nearest City" taxboxname="pickup_state_id" noofrows="5" />
												<input type='hidden' class="ctyIDname city_real" id='pickup_city_id' name="pickup_city_id" />
												<div class="suggesstion-box" style="margin-top:-10px"></div>
											</div>
										</div>	
										<div class="stateRpl">		
											<div class="col-md-4 form-group mt">
												<div class="input-field">
													<p for="from">Pickup State</p>
													<input type='hidden' id='pickup_state_id' name="pickup_state_id"/>
													<input type="text" class="form-control"  id="pickup_state_name" name="pickup_state_name" placeholder="Auto Populated" readonly>
												</div>
											</div>
										
											<div class="col-md-4 form-group mt" style="display:none">
												<div class="input-field">
												<p for="from">Pickup Country</p>
												<input type='hidden' id='pickup_country_id' name="pickup_country_id"/>
												<input type="text" class="form-control" id ="pickup_country_name" name="pickup_country_name" placeholder="Select Country" />
												</div>
											</div>
										</div> 
									</div>
								</div> 
								<div class="package-stops">
								</div>
								<div class="col-md-12"> 
									<button class="btn btn-primary btn-sm package-stop-add " style="background-color:#1295A2;"><i class="fa fa-plus"></i> Add Stop</button>
								</div> 
								<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
												
											<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
											<div class="col-xxs-12 text-center">
													<div class="input_fields_wrap">
														<button class="add_field_button but">Add Stop</button>
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
															<div class="input-field">
																<p for="from" style="float:left;">Stop Name</p>
																<input class="form-control" type="text" placeholder="Stop Name" name="stops[]">
															</div>
														</div>
													</div>
												</div>  </div>-->
											
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-6 form-group">
											<div class="input-field">
												<p for="from">Final Locality
													</p>
												<input class="form-control" type="text" placeholder="Enter Locality or Village or Town" name="finalLocality" id="finalLocality"/>
											</div>
										</div>
										<div class="col-md-6 form-group">
											<div class="input-field">
												<p for="from">Final City <span class="required">*</span>
													 
												</p>
												<input type="text" class="form-control city_select" id="p_final_city_name" noofrows="2" name="p_final_city_name" required placeholder="Select City or Nearest City"/>
												<input type='hidden' id='p_final_city_id' class="city_real" name="p_final_city_id" />
												<div class="suggesstion-box" style="margin-top:-10px"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 rw">
										<div class="col-md-6 form-group">
											<div class="input-field">
											<p for="from">Final State</p>
												<input type='hidden' id='p_final_state_id' name="p_final_state_id"/>
												<input type="text" class="form-control" id ="p_final_state_name" name="p_final_state_name" placeholder="Select State" readonly/>
											</div>
										</div>
										<div class="col-md-6 form-group">
											<div class="input-field">
												<p for="from">Final Country</p>
												<input type='hidden' id='t_final_country_id' name="t_final_country_id"/>
												<input type="text" class="form-control" id ="t_final_country_name" name="t_final_country_name" placeholder="Select Country" readonly/>
											</div>
										</div>
									</div>
								</div>
						</fieldset>
						<fieldset>
								<legend style="color:#369FA1;"><b> &nbsp;  Comment Box &nbsp; </b></legend>
									<div class="row" style="margin-bottom: 10px;">
										<div class="col-md-12">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
												<div class="input-field">
													<textarea name="comment" class="form-control mt" cols="" rows="4" placeholder="Enter Comment"></textarea>
												</div>
											</div> 
										</div>
									</div>
							</fieldset>
							<div class="row">
								 
								<div class="col-md-12">
									<div class="input-field">
										<div class="margin text-center">
										<center><input type="submit" class="btn btn-primary btn-submit" value="Submit" style="background-color:#1295A2"></center>
										</div>
									</div>
								</div> 
							</div>
						</div>
					</div>
				</div>
<?= $this->Form->end()?>
<div class="tab-pane " id="tab3">
							<?php
                            echo $this->Form->create(null, [
                                'type' => 'file',
                                'url' => ['controller' => 'Users', 'action' => 'sendrequest'], "id"=>"TransportRequestForm"
                            ]);
                            ?> 
					<input name="category_id" autocomplete="off" type="hidden" value="2" class="form-control" id="date-start" />
                            <!--Form Box for Hotel-->
							<div class="form-box">
								<div class="panel-group" id="TransportAccordion" style="background-color:white;margin-top:-20px;">
									<div class="panel">
										 
									<fieldset>
									  <legend style="color:#369FA1;"><b> &nbsp;  GENERAL REQUIREMENTS  &nbsp; </b></legend>
										<div class="row">
											<div class="col-md-12">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
													<div class="input-field">
														<p for="from" >
															Reference ID  
															<span class="required">*</span> (This is for your reference )
														</p>
														<input  name="reference_id" type="text" class="form-control ref1" id="reference_id" placeholder="Reference ID" autocomplete="off" />
														 
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="col-md-4">
													<div class="input-field ">
														<p for="from">
															Total Budget 
															<span class="required">*</span>
														</p>
														<input name="total_budget" type="text" min="1" class="form-control " id="total_budget" placeholder="Total Budget" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"/>
													</div>
												</div>
												<div class="col-md-4">
													<p for="from">Adults <span class="required">*</span></p>
													<?php echo $this->Form->control('transportAdult', ["type"=>"text","min"=>0, "class"=>"form-control input-medium", 'p' => false, 'div' => false, "placeholder"=>"0",'oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"]); ?>
												</div>
												<div class="col-md-4">
													<p for="from">Children Below 6  </p>
													<?php echo $this->Form->control('transportChildren', ["type"=>"text","min"=>0, "class"=>"form-control input-medium", 'p' => false, 'div' => false, "placeholder"=>"0",'oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"]); ?>
												</div>
											</div>
										</div>
									</fieldset>
									 
									<fieldset>
									<legend style="color:#369FA1;"><b> &nbsp;  TRANSPORT REQUIREMENTS &nbsp; </b></legend>
									<div class="row">
										<div class="col-md-12 ">
											<div class="col-md-4 ">
												<div class="input-field">
													<p for="from">
														Select Transport 
														<span class="required">*</span>
													</p>
												</div>
												<div class="">
													<?php echo $this->Form->control('transport_requirement', ["type"=>"select",'options' =>$postTravlePackageCategories, "class"=>"form-control select2","data-placeholder"=>"Select Options","empty"=>'Select Options','required']);?>
													<label id="transport_requirement-error" class="error" for="transport_requirement"> </label>
												</div>
												
											</div>
											<div class="col-md-4">
												<div class="input-field">
													<p for="from">
														Start Date
														<span class="required">*</span>
													</p>
												</div>
												<div class="">
													 <input autocomplete="off" name="start_date" type="text" class="form-control" data-date-format="dd-mm-yyyy" id="datepickerofTransport" placeholder="DD-MM-YYYY"/>
												</div>
											</div>
											<div class="col-md-4">
												<div class="input-field">
												<p for="from">
													End Date
													<span class="required">*</span>
												</p>
												</div>
												<div class="">
													 <input autocomplete="off" name="end_date" type="text" class="form-control" data-date-format="dd-mm-yyyy" id="datepickerofTransport1" placeholder="DD-MM-YYYY"/>
												</div>
											</div>	
													
												</div>
											</div>
											<input type='hidden' id='t_pickup_country_id' name="t_pickup_country_id"/>
												<input type="hidden" class="form-control" id ="t_pickup_country_name" name="t_pickup_country_name" placeholder="Country" readonly/> 
									<div class="row">
										<div class="col-md-12 main_row">
											<div class="col-md-4 form-group  mt">
													<div class="input-field">
													<p for="from">Pickup Locality
													 <span class="required">*</span>   
													</p>
													<input autocomplete="off" type="text" class="form-control" name="pickup_locality" id="pickup_locality" placeholder="Enter Locality,Village or Town"/>
													</div>
											</div>
											 <div class="col-md-4 form-group  mt">
												<div class="input-field">
													<p for="from">Pickup City
													<span class="required">*</span>
													</p>
													<input type="text" class="form-control city_select ctynamerecord" id="t_pickup_city_name"  noofrows="4" taxboxname="t_pickup_state_id" name="t_pickup_city_name"  placeholder="Select City or Nearest City"/>
													<input class="ctyIDname city_real" type='hidden' id='t_pickup_city_id' name="t_pickup_city_id" />
													<div class="suggesstion-box" style="margin-top:-10px"></div>
												</div>
											</div>										
											<div class="stateRpl form-group" style="padding-top:1px;">
											<div class="col-md-4   mt">
												<div class="input-field">
												<p for="from">Pickup State</p>
													<input type='hidden' id='t_pickup_state_id' name="t_pickup_state_id"/>
												<input type="text" class="form-control" id ="t_pickup_state_name" name="t_pickup_state_name" placeholder="Auto Populated " readonly>
												</div>
											</div>
											</div>
										</div>
									</div>  
									<div class="transport-stops">
 									</div>
									<div class="row">
										<div class="col-md-12" style="margin-top:10px"> 
											<div class="col-md-12"> 
												<button class="btn btn-primary btn-sm transport-stop-add " style="background-color:#1295A2;"><i class="fa fa-plus"></i> Add Stop</button>	
											</div>			
										</div>	
									</div>	 
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-4 mt">
												<div class="input-field">
													<p for="from">Final Locality
													</p>
													<input class="form-control" type="text" placeholder="Enter Locality,Village or Town" name="finalLocality">
												</div>
											</div>
											<div class="col-md-4 form-group  mt">
													<div class="input-field">
														<p for="from">Final City</p>
														<input type="text" class="form-control city_select" id="t_final_city_name" noofrows="3" name="t_final_city_name" placeholder="Select City or Nearest City"/>
														<input type='hidden' id='t_final_city_id' name="t_final_city_id" class="city_real" />
											<div class="suggesstion-box" style="margin-top:-10px"></div>
														
													</div>
												</div>
											<div class="rw2 form-group" style="padding-top:1px;">
												<div class="col-md-4  mt">
														<div class="input-field">
														<p for="from">Final State</p>
															<input type='hidden' id='t_final_state_id' name="t_final_state_id"/>
														<input type="text" class="form-control" id ="t_final_state_name" name="t_final_state_name" placeholder="Auto Populated" readonly/>
														</div>
													</div>
													<input type='hidden' id='t_final_country_id' name="t_final_country_id"/>
													<input type="hidden" class="form-control" id ="t_final_country_name" name="t_final_country_name" placeholder="Select Country" readonly/>
													<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
														<div class="input-field">
														<p for="from">Final Country</p>
															<input type='hidden' id='t_final_country_id' name="t_final_country_id"/>
															<input type="text" class="form-control" id ="t_final_country_name" name="t_final_country_name" placeholder="Select Country" />
														</div>
													</div>-->
											</div>
										</div>
									</div>
									</fieldset>
									<fieldset>
										<legend style="color:#369FA1;"><b> &nbsp;  Comment Box &nbsp; </b></legend>
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-12">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt">
														<div class="input-field">
															<textarea name="comment" class="form-control mt" cols="" rows="4" placeholder="Enter Comment"></textarea>
														</div>
													</div> 
												</div>
											</div>
									</fieldset>
									<div class="row">
										<div class="col-md-12">
											<div class="input-field">
												<div class="margin text-center">
												<center><input type="submit" class="btn btn-primary btn-submit btn-submit" value="Submit" style="background-color:#1295A2"></center>
												</div>
											</div>
										</div> 
									</div>	
								</div>
							</div>
						</div>
					</div>
			<?= $this->Form->end()?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php echo $this->Html->script(['jquery.validate']);?>
<script>
$(document).ready(function(){ 
	var date = new Date();
	date.setDate(date.getDate());
	//-- Hotel date Pickers Starte 
	/* $('.removeerror').on('chnage',function(){
		
		 //$(this).closest('div').find(".removeerror").trigger( "click" );
		var pass=  $(this).val();
		 
 		if(pass.length >0){
 			$(this).closest('div').find('label.error').hide();
		} 
	}); */
	
	$("#HotelDatePicker").datepicker({
		autoclose:false,
		minDate:0,
		startDate: date,
	}).on("change", function (e) {
 		var selected = $(this).val();
		var checkoutDtaa = $('#datepicker2').val();
		
 		var arrDate = selected.split("-");
		var Ndt=arrDate[2]+'-'+arrDate[1]+'-'+arrDate[0];
		checkOutDateDate = new Date(Ndt); 
		 
		var arrDates = checkoutDtaa.split("-");
		var Ndt=arrDates[2]+'-'+arrDates[1]+'-'+arrDates[0];
		checkInDateDate = new Date(Ndt);
		
		if(checkOutDateDate>=checkInDateDate)
		{
			alert("Please ensure Checkout date is greater than Checkin Date.");
			$('#datepicker2').val("");
		}
	});
	
	$("#datepicker2").datepicker({
		autoclose:true,
		minDate:0,
		startDate: date,
	}).on("change", function (e) {
		var checkOutDate=$(this).val();
		var checkInDate = $('#HotelDatePicker').val();
		if(checkInDate == "") {
			alert("Please select check-in date first.");
			$('#datepicker2').val("");
		}
		else{
			var arrDate = checkOutDate.split("-");
			var Ndt=arrDate[2]+'-'+arrDate[1]+'-'+arrDate[0];
			checkOutDateDate = new Date(Ndt);
			 
			var arrDates = checkInDate.split("-");
			var Ndt=arrDates[2]+'-'+arrDates[1]+'-'+arrDates[0];
			checkInDateDate = new Date(Ndt);
			
			if(checkOutDateDate<=checkInDateDate)
			{
				alert("Please ensure Checkout date is greater than Checkin Date.");
				$('#datepicker2').val("");
			}
		}
	});
 	//-- Hotel date Pickers End 	 
 	//-- Transport date Pickers Starte 
	var date = new Date();
	date.setDate(date.getDate());
	 $("#datepickerofTransport").datepicker({
		autoclose:true,
		minDate:0,
		startDate: date,
	}).on("change", function (e) {
		var selected = $(this).val();
		var checkoutDtaa = $('#datepickerofTransport1').val();
		
 		var arrDate = selected.split("-");
		var Ndt=arrDate[2]+'-'+arrDate[1]+'-'+arrDate[0];
		checkOutDateDate = new Date(Ndt); 
		 
		var arrDates = checkoutDtaa.split("-");
		var Ndt=arrDates[2]+'-'+arrDates[1]+'-'+arrDates[0];
		checkInDateDate = new Date(Ndt);
		
		if(checkOutDateDate>checkInDateDate)
		{
			alert("Please ensure End date is not less than Start Date.");
			$('#datepickerofTransport1').val("");
		}
 	});
	 
	$("#datepickerofTransport1").datepicker({
		autoclose:true,
		minDate:0,
		startDate: date,
	}).on("change", function (e) {
		var checkOutDate=$(this).val();
		var checkInDate = $('#datepickerofTransport').val();
		if(checkInDate == "") {
			alert("Please select start date first.");
			$('#datepickerofTransport1').val("");
		}
		else{
			var arrDate = checkOutDate.split("-");
			var Ndt=arrDate[2]+'-'+arrDate[1]+'-'+arrDate[0];
			EndDate = new Date(Ndt);
			 
			var arrDates = checkInDate.split("-");
			var Ndt=arrDates[2]+'-'+arrDates[1]+'-'+arrDates[0];
			StartDate = new Date(Ndt);
			
			if(StartDate>EndDate)
			{
				alert("Please ensure End date is not less than Start Date.");
				$('#datepickerofTransport1').val("");
			}
		}
	});  
 	//-- TRans date Pickers End 
	//-- Package date Pickers Starte 
	var date = new Date();
	date.setDate(date.getDate());
	$("#datepickerofpkg").datepicker({
		autoclose:true,
		minDate:0,
		startDate: date,
	}).on("change", function (e) {
		var selected = $(this).val();
		var checkoutDtaa = $('#datepickerofpkg1').val();
		
 		var arrDate = selected.split("-");
		var Ndt=arrDate[2]+'-'+arrDate[1]+'-'+arrDate[0];
		checkOutDateDate = new Date(Ndt); 
		 
		var arrDates = checkoutDtaa.split("-");
		var Ndt=arrDates[2]+'-'+arrDates[1]+'-'+arrDates[0];
		checkInDateDate = new Date(Ndt);
		
		if(checkOutDateDate>=checkInDateDate)
		{
			alert("Please ensure Checkout date is greater than Checkin Date.");
			$('#datepickerofpkg1').val("");
		}
 	});
	 
	$("#datepickerofpkg1").datepicker({
		autoclose:true,
		minDate:0,
		startDate: date,
	}).on("change", function (e) {
		var checkOutDate=$(this).val();
		var checkInDate = $('#datepickerofpkg').val();
		if(checkInDate == "") {
			alert("Please select check-in date first.");
			$('#datepickerofpkg1').val("");
		}
		else{
		//	
		var arrDate = checkOutDate.split("-");
		var Ndt=arrDate[2]+'-'+arrDate[1]+'-'+arrDate[0];
 		checkOutDateDate = new Date(Ndt);
		 
  		var arrDates = checkInDate.split("-");
		var Ndt=arrDates[2]+'-'+arrDates[1]+'-'+arrDates[0];
 		checkInDateDate = new Date(Ndt);
		//		
 			if(checkOutDateDate<=checkInDateDate)
			{
 				alert("Please ensure Checkout date is greater than Checkin Date.");
				$('#datepickerofpkg1').val("");
			}
		}
	});  
 	//-- Package date Pickers End 
	//-- Package date Pickers Starte 
	var date = new Date();
	date.setDate(date.getDate());
	$("#packageTransport").datepicker({
		autoclose:true,
		minDate:0,
		startDate: date,
	}).on("change", function (e) {
		var selected = $(this).val();
		var checkoutDtaa = $('#packageTransport1').val();
		
 		var arrDate = selected.split("-");
		var Ndt=arrDate[2]+'-'+arrDate[1]+'-'+arrDate[0];
		checkOutDateDate = new Date(Ndt); 
		 
		var arrDates = checkoutDtaa.split("-");
		var Ndt=arrDates[2]+'-'+arrDates[1]+'-'+arrDates[0];
		checkInDateDate = new Date(Ndt);
		
		if(checkOutDateDate>checkInDateDate)
		{
			alert("Please ensure End date is not less than Start Date.");
			$('#packageTransport1').val("");
		}
 	});
	 
	$("#packageTransport1").datepicker({
		autoclose:true,
		minDate:0,
		startDate: date,
	}).on("change", function (e) {
		var checkOutDate=$(this).val();
		var checkInDate = $('#packageTransport').val();
		if(checkInDate == "") {
			alert("Please select start date date first.");
			$('#packageTransport1').val("");
		}
		else{
		//	
		var arrDate = checkOutDate.split("-");
		var Ndt=arrDate[2]+'-'+arrDate[1]+'-'+arrDate[0];
 		checkOutDateDate = new Date(Ndt);
		 
  		var arrDates = checkInDate.split("-");
		var Ndt=arrDates[2]+'-'+arrDates[1]+'-'+arrDates[0];
 		checkInDateDate = new Date(Ndt);
		//		
 			if(checkOutDateDate<checkInDateDate)
			{
				alert("Please ensure End date is not less than Start Date.");
				$('#packageTransport1').val("");
			}
		}
	});
///------------------------------------


 	$(document).on('blur',".city_select",function(){
		var master=$(this);
		master.closest('div').find('div.suggesstion-box').delay(1000).fadeOut(500);
	});

	$(document).on('keyup',".city_select",function(){
		
 		var input=$(this).val();
		if(input.length>0){
			var noofrows=$(this).attr('noofrows');
			var taxboxname=$(this).attr('taxboxname');
			var master=$(this);
			var m_data = new FormData();
			m_data.append('input',input);			
			m_data.append('noofrows',noofrows);			
			m_data.append('taxboxname',taxboxname);			
			$.ajax({
				url: "<?php echo $this->Url->build(["controller" => "Users", "action" => "ajax_city"]); ?>",
				data: m_data,
				processData: false,
				contentType: false,
				type: 'POST',
				dataType:'text',
				success: function(data)
				{
					master.closest('div').find('div.suggesstion-box').show();
					master.closest('div').find('div.suggesstion-box').html(data);
					master.css("background","#FFF");
				}
			});
		}
	});
	
	
	$(document).on('click',".selectCountry",function(){
		
		var noofrows=$(this).attr('noofrows');
		if(noofrows == 4){
			var stat_id=$(this).attr('stat_id');
			var cty_id=$(this).attr('cty_id');
			var cty_nm=$(this).attr('cty_nm');
			var taxboxname=$(this).attr('taxboxname');
			$(this).closest('div').parent('div').parent('div').parent('div.main_row').find('.ctyIDname').val(cty_id); 
			$(this).closest('div').parent('div').parent('div').parent('div.main_row').find('.ctynamerecord').val(cty_nm); 
			$(this).closest('div').parent('div').parent('div').parent('div.main_row').find(".suggesstion-box").hide();
			
			var mainthis=$(this);
			var m_data = new FormData();
			m_data.append('state_id',stat_id);	
			m_data.append('noofrows',noofrows);		
			m_data.append('taxboxname',taxboxname);		
			$.ajax({
				url: "<?php echo $this->Url->build(["controller" => "Users", "action" => "ajax_state_show_new"]); ?>",
				data: m_data,
				processData: false,
				contentType: false,
				type: 'POST',
				dataType:'text',
				success: function(data)
				{
					mainthis.closest('div').parent('div').parent('div').parent('div.main_row').find(".stateRpl").html(data);
				}
			});
		}
		if(noofrows == 5){
			var stat_id=$(this).attr('stat_id');
			var cty_id=$(this).attr('cty_id');
			var cty_nm=$(this).attr('cty_nm');
			var taxboxname=$(this).attr('taxboxname');
			$(this).closest('div').parent('div').parent('div').parent('div.main_row').find('.ctyIDname').val(cty_id); 
			$(this).closest('div').parent('div').parent('div').parent('div.main_row').find('.ctynamerecord').val(cty_nm); 
			$(this).closest('div').parent('div').parent('div').parent('div.main_row').find(".suggesstion-box").hide();
			//alert($(this).closest('div').parent('div').parent('div').parent('div.main_row').html());
			var mainthis=$(this);
			var m_data = new FormData();
			m_data.append('state_id',stat_id);	
			m_data.append('noofrows',noofrows);		
			m_data.append('taxboxname',taxboxname);		
			$.ajax({
				url: "<?php echo $this->Url->build(["controller" => "Users", "action" => "ajax_state_show_new"]); ?>",
				data: m_data,
				processData: false,
				contentType: false,
				type: 'POST',
				dataType:'text',
				success: function(data)
				{
					mainthis.closest('div').parent('div').parent('div').parent('div.main_row').find(".stateRpl").html(data);
				}
			});
		}
		
		if(noofrows == 6){
			var stat_id=$(this).attr('stat_id');
			var cty_id=$(this).attr('cty_id');
			var cty_nm=$(this).attr('cty_nm');
			var taxboxname=$(this).attr('taxboxname');
			$(this).closest('div').parent('div').parent('div').parent('div.main_row').find('.ctyIDname').val(cty_id); 
			$(this).closest('div').parent('div').parent('div').parent('div.main_row').find('.ctynamerecord').val(cty_nm); 
			$(this).closest('div').parent('div').parent('div').parent('div.main_row').find(".suggesstion-box").hide();
			//alert($(this).closest('div').parent('div').parent('div').parent('div.main_row').html());
			var mainthis=$(this);
			var m_data = new FormData();
			m_data.append('state_id',stat_id);	
			m_data.append('noofrows',noofrows);		
			m_data.append('taxboxname',taxboxname);		
			$.ajax({
				url: "<?php echo $this->Url->build(["controller" => "Users", "action" => "ajax_state_show_new"]); ?>",
				data: m_data,
				processData: false,
				contentType: false,
				type: 'POST',
				dataType:'text',
				success: function(data)
				{
					mainthis.closest('div').parent('div').parent('div').parent('div.main_row').find(".stateRpl").html(data);
				}
			});
		}
		
	});
});

function selectCountry(value,city_code,state,noofrows) {
	var state_id=state;
	if(noofrows==1){
		$('#h_city_name').val(value);
		$(".suggesstion-box").hide();
		$("#h_city_id").val(city_code);
		var m_data = new FormData();
		m_data.append('state_id',state_id);	
		//$("#h_state_name").attr( 'readonly', 'readonly' );
		m_data.append('noofrows',noofrows);		
		m_data.append('taxboxname','');		
		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "Users", "action" => "ajax_state_show_new"]); ?>",
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
	if(noofrows==2){
		$('#p_final_city_name').val(value);
		$(".suggesstion-box").hide();
		$("#p_final_city_id").val(city_code);
		var m_data = new FormData();
		m_data.append('state_id',state_id);			
		m_data.append('noofrows',noofrows);			
		m_data.append('taxboxname','');			
		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "Users", "action" => "ajax_state_show_new"]); ?>",
			data: m_data,
			processData: false,
			contentType: false,
			type: 'POST',
			dataType:'text',
			success: function(data)
			{
				$(".rw").html(data);
			}
		});
	}	
	
	if(noofrows==3){
		$('#t_final_city_name').val(value);
		$(".suggesstion-box").hide();
		$("#t_final_city_id").val(city_code);
		var m_data = new FormData();
		m_data.append('state_id',state_id);			
		m_data.append('noofrows',noofrows);			
		m_data.append('taxboxname','');			
		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "Users", "action" => "ajax_state_show_new"]); ?>",
			data: m_data,
			processData: false,
			contentType: false,
			type: 'POST',
			dataType:'text',
			success: function(data)
			{
				$(".rw2").html(data);
			}
		});
	}
	 
	
} 
$('#HotelRequestForm').submit(function(){
	var x=0;
	$('.hotelroom').each(function(){
		if($(this).val() >0){
			x=1;
		}
	});
	$('#showerror').hide();
	$('#HotelRequestFormCITY').hide();
	if($(this).closest('div').find('.ctyidd').val()==''){
		$('#HotelRequestFormCITY').show();
	}
 	
	if(x==0){
		$('#showerror').show();
		$('html, body').animate({scrollTop:0}, 'slow');
		return false;
	}
	else{
		$("#loader-1").show();
	}
}); 

$('#PackgeRequestForm').submit(function(){
	var x=0;
	$('.packageroom').each(function(){
		if($(this).val() >0){
			x=1;
		}
	});
	$('#showerror12').hide();
	if(x==0){
		$('#showerror12').show();
		$('html, body').animate({scrollTop:0}, 'slow');
		return false;
	}
	else{
		$("#loader-1").show();
	}
	
})

//--- Seco 
	$('#PackgeRequestForm').validate({
		rules: {
			"reference_id" : {
				required : true
			},
			"total_budget" : {
				required : true
			},
			"adult":{
			required : true,
			min: 1
			},
			"city_name":{
			required : true, 
			},
			"check_in" : {
				required : true
			},
			"check_out": {
				required : true,
			},
			"city_id": {
				required: true
			},
			"transport_requirement": {
				required: true
			},
			"start_date" : {
				required : true
			},
			"end_date": {
				required : true,
			},
			"pickup_city_name": {
				required: true
			},
			"pincode": {
				required: true
			}
		},
		messages: {
			"start_date" : {
				required : "Please select start date."
			},
			"end_date": {
				required : "Please select end date."
			},
			"pickup_city_name": {
				required: "Please select valid city."
			},
			"transport_requirement" : {
				required : "Please Select Transport Requirement."
			},
			"reference_id" : {
				required : "Please enter reference id."
			},
			"total_budget" : {
				required : "Please enter total budget."
			},
			"adult" : {
				required : "Please enter number of adults."
			},
			/*"children" : {
				required : "Please enter number of children."
			},*/
			"check_in" : {
				required : "Please select check-in date."
			},
			"check_out": {
				required : "Please select check-out date."
			},
			"city_id": {
				required: "Please select valid city."
			},
		
			"pincode": {
				required: "Please enter pincode."
			}
		},
		submitHandler: function (form) {
 			form[0].submit(); 
		}
	});
 	
	$('#HotelRequestForm').validate({
		rules: {
			"reference_id" : {
				required : true
			},
			"hotelAdult":{
				required : true,
				min: 1
			},
			"h_city_name":{
				required : true, 
			},
			"total_budget" : {
				required : true
			},
			"check_in" : {
				required : true
			},
			"check_out": {
				required : true,
			},
			"h_city_id": {
				required: true
			},
			
			"room1": {
				number: true,
				maxlength:10
			},
		},
		messages: {
			"reference_id" : {
				required : "Please enter reference id."
			},
			"total_budget" : {
				required : "Please enter total budget."
			},
			"hotelAdult" : {
				required : "Please enter number of adults."
			},
			"room1" : {
				required : "Please enter number only."
			},
			/*"hotelChildren" : {
				required : "Please enter number of children."
			},*/
			"check_in" : {
				required : "Please select check-in date."
			},
			"check_out": {
				required : "Please select check-out date."
			},
			"h_city_id": {
				required: "Please select valid city."
			},
			"locality": {
				required: "Please enter locality."
			}
		},
		submitHandler: function (form) {
			form[0].submit(); 
		}
	});
  	
	$('#TransportRequestForm').validate({
		rules: {
			"reference_id" : {
				required : true
			},
			"total_budget" : {
				required : true
			},
			"transportAdult":{
			required : true,
			min: 1
			},
			"t_pickup_city_name":{
				required : true,
			},
			"start_date" : {
				required : true
			},
			"end_date": {
				required : true,
			},
			"t_pickup_city_id": {
				required: true
			},
			"transport_requirement": {
				required: true
			},
			"t_final_city_id": {
				required: true
			},
			"pickup_locality": {
				required: true
			}
		},
		messages: {
			"transport_requirement" : {
				required : "Please Select Transport Requirement."
			},
			"reference_id" : {
				required : "Please enter reference id."
			},
			"total_budget" : {
				required : "Please enter total budget."
			},
			"transportAdult" : {
				required : "Please enter number of adults."
			},
			/*"transportChildren" : {
				required : "Please enter number of children."
			},*/
			"start_date" : {
				required : "Please select start date."
			},
			"end_date": {
				required : "Please select end date."
			},
			"t_pickup_city_id": {
				required: "Please select valid city."
			},
			"t_final_city_id": {
				required: "This field is required."
			},
			"pickup_locality": {
				required: "Please enter locality."
			}
		},
		submitHandler: function (form) {
 			$("#loader-1").show();
			form[0].submit(); 
		}
	});
 	
	$(document).on('blur',".city_select ",function(){ 
		var now=$(this);
		setTimeout(function() {
			var city_id=now.closest('div').find('.city_real').val();
            if(city_id==''){
				alert('Please select a city from the dropdown list');
				now.val(''); 
			}	 
		}, 1000);
 	}); 
 	
	$('#accordion').on('shown.bs.collapse', function () {
		$('.ref2').focus()
	});


</script>
<script>
$(document).ready(function () {
    	$('#tabtransport').click(function (e) {
    		$('.newdivsss').remove();
			$('.remove_field').remove();
    	});
        // This button will increment the value
        $('#btnplus').click(function () {
			 var counter = $('#textcounter').val();
                    counter++ ;
                    $('#textcounter').val(counter);
        });
		$('#btnminus').click(function () {
			 var counter = $('#textcounter').val();
                    counter-- ;
                    $('#textcounter').val(counter);
        });
		 $('#btnplus1').click(function () {
			 var counter1 = $('#textcounter1').val();
                    counter1++ ;
                    $('#textcounter1').val(counter1);
        });
		$('#btnminus1').click(function () {
			 var counter1 = $('#textcounter1').val();
                    counter1-- ;
                    $('#textcounter1').val(counter1);
        });
		 $('#btn_pack_plus').click(function () {
			 var counter = $('#text_counter_pack').val();
                    counter++ ;
                    $('#text_counter_pack').val(counter);
        });
		$('#btn_pack_minus').click(function () {
			 var counter = $('#text_counter_pack').val();
                    counter-- ;
                    $('#text_counter_pack').val(counter);
        });
		 $('#btn_pack_plus1').click(function () {
			 var counter = $('#text_counter_pack1').val();
                    counter++ ;
                    $('#text_counter_pack1').val(counter);
        });
		$('#btn_pack_minus1').click(function () {
			 var counter = $('#text_counter_pack1').val();
                    counter-- ;
                    $('#text_counter_pack1').val(counter);
        });
		$('#btn_tran_plus').click(function () {
			 var counter = $('#text_trans_counter').val();
                    counter++ ;
                    $('#text_trans_counter').val(counter);
        });
		$('#btn_tran_minus').click(function () {
			 var counter = $('#text_trans_counter').val();
                    counter-- ;
                    $('#text_trans_counter').val(counter);
        });
		 $('#btn_tran_plus1').click(function () {
			 var counter = $('#text_trans_counter1').val();
                    counter++ ;
                    $('#text_trans_counter1').val(counter);
        });
		$('#btn_tran_minus1').click(function () {
			 var counter = $('#text_trans_counter1').val();
                    counter-- ;
                    $('#text_trans_counter1').val(counter);
        });
           
    });

</script>

<script>
    $('.btnNext').click(function () {
        $('.nav-tabs > .active').next('li').find('a').trigger('click');
    });

    $('.btnPrevious').click(function () {
        $('.nav-tabs > .active').prev('li').find('a').trigger('click');
    });
</script> 
<script>
    $(document).ready(function () {
        var max_fields = 10;
        var wrapper = $(".input_fields_wrap");
        var add_button5 = $(".add_field_button");
        var packageI = 1;
		
        $(".package-stop-add").click(function (e) {
        
            e.preventDefault();
            var strHtml = '<div class="stop col-md-12 main_row" style="margin-top:5px"><hr  style="margin-top: 8px; margin-bottom: 8px;"></hr> <div class="stop-title" style="font-weight:bold"> Stop ' +packageI+ ' </div><div class="row main_row">';
        	strHtml += '<div class="col-sm-4 mt form-group"> <p for="from">Stop Locality</p><input class="form-control" type="text" placeholder="Enter Locality,Village or Town" name="stops[' +packageI+ ']"> </div>';
        	strHtml += '<div class="col-sm-4 mt form-group"><p for="from">Stop City</p><input class="trans_city form-control city_select ctynamerecord" noofrows="5" taxboxname="state_id_package_stop_city[' +packageI+ ']" type="text" placeholder="Select City or Nearest City" required use_for = "package" numCount = ' +packageI+ ' id="package_stop_city[' +packageI+ ']" name="trasport_stop_city[' +packageI+ ']"><input type="hidden" id="id_package_stop_city[' +packageI+ ']" class="ctyIDname city_real" name="id_package_stop_city[' +packageI+ ']" /><div class="suggesstion-box" style="margin-top:-10px"></div></div> ';
        	strHtml += '<div class="stateRpl"><div class="col-sm-4 mt form-group" > <p for="from">Stop State</p><input type="hidden" id="state_id_package_stop_city[' +packageI+ ']" name="state_id_package_stop_city[' +packageI+ ']"/><input class="form-control" type="text" placeholder="State" id ="state_name_package_stop_city[' +packageI+ ']" name="state_name_package_stop_city[' +packageI+ ']" readonly> </div></div></div>';
        strHtml += '<div class="row"><div class="col-md-12" align="right" style="margin-top:5px"> <button class="btn btn-danger btn-sm package_remove_stop but"> <i class="fa fa-trash" ></i> Remove Stop</button> </div></div></div>';
        $(".package-stops").append(strHtml);
        	packageI++;
        });
        $(document).on("click", ".package_remove_stop", function (e) {
            e.preventDefault();
            packageI--;
            $(this).closest('div.stop').slideUp(function(){
				$(this).remove();
				var gg = 1;
				$( ".stop-title" ).each(function() {
					var htmlString = 'Stop '+gg;
					$( this ).text( htmlString );
					gg++;
				});
			});
        });
    
        var transI = 1;
        $(".transport-stop-add").click(function(e){
				e.preventDefault();
				var strHtml = '<div class="stop col-md-12 main_row" style="margin-top:5px"><hr  style="margin-top: 8px; margin-bottom: 8px;"></hr> <div class="stop-title" style="font-weight:bold"> Stop ' +transI+ ' </div><div class="row main_row">';
				strHtml += '<div class="col-sm-4 mt form-group"><div class="input-field"><p for="from">Stop Locality</p><input class="form-control" type="text" placeholder="Enter Locality, Village or Town" name="stops[' +transI+ ']"></div></div>';
				strHtml += '<div class="col-sm-4 mt form-group"><div class="input-field"><p for="from">Stop City</p><input class="trans_city form-control ctynamerecord city_select" required type="text" noofrows="4" taxboxname="state_id_trasport_stop_city[' +transI+ ']" placeholder="Select City or Nearest City" use_for = "trasport" numCount = ' +transI+ ' id="trasport_stop_city[' +transI+ ']" name="trasport_stop_city[' +transI+ ']"> <input type="hidden" class="ctyIDname city_real" id="id_trasport_stop_city[' +transI+ ']" name="id_trasport_stop_city[' +transI+ ']" /><div class="suggesstion-box" style="margin-top:-10px"></div></div></div>';
				strHtml += '<div class="stateRpl form-group" ><div class="col-sm-4 mt form-group"><div class="input-field  form-group" style="margin-top:5px !important;"><p for="from">Stop State</p><input type="hidden" id="state_id_trasport_stop_city[' +transI+ ']" name="state_id_trasport_stop_city[' +transI+ ']"/><input class="form-control" type="text" placeholder="State" id ="state_name_trasport_stop_city[' +transI+ ']" name="state_name_trasport_stop_city[' +transI+ ']" readonly></div></div></div></div>';
				strHtml += '<div class="row"><div class="col-md-12" align="right" style="margin-top:5px"> <button class="btn btn-danger btn-sm transport_remove_stop but"> <i class="fa fa-trash" ></i> Remove Stop</button> </div></div></div>';
				$(".transport-stops").append(strHtml);
				transI++;
        });

        $(document).on("click", ".transport_remove_stop", function (e) {
            e.preventDefault();
            transI--;
            $(this).closest('div.stop').slideUp(function(){
				$(this).remove();
				var f = 1;
				$( ".stop-title" ).each(function() {
					var htmlString = 'Stop '+f;
					$( this ).text( htmlString );
					f++;
				});
			});
        });
    });
</script>
<script>
	$(window).on("load", function(){
		$("#h_hotel_category").multiselect();
		$("#hotel_category").multiselect();

	});
    $(document).ready(function () {
        var wrapper = $(".input_fields_wrap1");
		$(wrapper).on("click", ".remove_field", function (e) {
            e.preventDefault();
			$(this).closest('div.stop').slideUp(function(){
				$(this).remove();
				
					var l = 1;
			$( ".Destination-title" ).each(function() {
					var htmlString = 'Destination '+l;
					$( this ).text( htmlString );
					l++;
				});
			});
        });
        var max_fields = 10;
        var add_button = $(".add_field_button2");
        var x = 1;
		 
        $(add_button).click(function (e) {
			var masterClick=$(this);
            e.preventDefault();
 			var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'addNewDestinationRow')) ?>";
			var number = Math.floor((Math.random() * 100000) + 1);
			 
			$.ajax({
				url:url,
				type: 'POST',
				data: {"number":number},
				async:false
			}).done(function(result){
				var len = $('input.checkdatefornext').length;
				var new_len=len-1;
 				$(wrapper).append(result);
				//--
				
				$(wrapper).find("input[name='hh_room1["+number+"]']").val($("#room1room").val());
				$(wrapper).find("input[name='hh_room2["+number+"]']").val($("#room2room").val());
				$(wrapper).find("input[name='hh_room3["+number+"]']").val($("#room3room").val());
				$(wrapper).find("input[name='hh_child_with_bed["+number+"]']").val($("#room4room").val());
				$(wrapper).find("input[name='hh_child_without_bed["+number+"]']").val($("#room5room").val());
				
				//--
  				var checkInDatePicker = $(wrapper).find("input:text[name='hh_check_in["+number+"]']");
				var checkOutDatePicker = $(wrapper).find("input:text[name='hh_check_out["+number+"]']");
				var last_date=masterClick.closest('fieldset').find('input.checkdatefornext:eq('+new_len+')').val();
				var newdate=last_date.split('-');
				var day=newdate[0];
				var month=newdate[1];
				var year=newdate[2];
				var spltdate=year+'-'+month+'-'+day;
				var d = new Date(spltdate);
				checkInDatePicker.datepicker({
					autoclose:true,
					minDate:0,
					startDate: d,
				}).on("change", function (e) {
					var selected = $(this).val();
					var checkoutDtaa = checkOutDatePicker.val();
					
					var arrDate = selected.split("-");
					var Ndt=arrDate[2]+'-'+arrDate[1]+'-'+arrDate[0];
					checkOutDateDate = new Date(Ndt); 
					 
					var arrDates = checkoutDtaa.split("-");
					var Ndt=arrDates[2]+'-'+arrDates[1]+'-'+arrDates[0];
					checkInDateDate = new Date(Ndt);
					
					if(checkOutDateDate>=checkInDateDate)
					{
						alert("Please ensure Checkout date is greater than Checkin Date.");
						checkOutDatePicker.val("");
					}
 				});
				checkOutDatePicker.datepicker({
					autoclose:true,
					minDate:0,
					startDate: d,
				}).on("change", function (e) {
					var checkOutDate=checkOutDatePicker.val();
					var checkInDate = checkInDatePicker.val();
					if(checkInDate == "") {
						alert("Please select check-in date first.");
						checkOutDatePicker.val("");
					}
					else{
						var arrDate = checkOutDate.split("-");
						var Ndt=arrDate[2]+'-'+arrDate[1]+'-'+arrDate[0];
						checkOutDateDate = new Date(Ndt);
						 
						var arrDates = checkInDate.split("-");
						var Ndt=arrDates[2]+'-'+arrDates[1]+'-'+arrDates[0];
						checkInDateDate = new Date(Ndt);
						
						if(checkOutDateDate<=checkInDateDate)
						{
							alert("Please ensure Checkout date is greater than Checkin Date.");
							checkOutDatePicker.val("");
						}
					}
				});
				
			});
			var l = 1;
			$( ".Destination-title" ).each(function() {
					var htmlString = 'Destination '+l;
					$( this ).text( htmlString );
					l++;
				});
			return false;
        });
        $(wrapper).on("click", ".remove_field1", function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
		 
        })
		 $(wrapper).on("click", ".remove_field", function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
		
        })
 			
     });
</script>