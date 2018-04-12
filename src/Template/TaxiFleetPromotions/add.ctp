<?php
//-- priceMasters
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/price_masters/index.json?promotion_type_id=2",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 4f8087cd-6560-4ca6-5539-9499d3c5b967"
  ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$priceMasters=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$priceMasters=json_decode($response);
	$priceMasters=$priceMasters->PriceMasters;
}

//-- BUSES LIST 
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/taxi_fleet_car_buses/index.json",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: f0bdc3fd-dd35-cc7d-9c8b-a8ebdcf4b05e"
  ),
));
$Result = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$TaxiFleetCarBuses=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
$TaxiFleetCarBuses=json_decode($Result);
$TaxiFleetCarBuses=$TaxiFleetCarBuses->TaxiFleetCarBuses;
}
//---- Company Name
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/users/index.json?user_id=".$user_id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: cf69b1e0-6e33-3968-c6ab-c750e8131c5f"
  ),
));
$cmpnynm = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$user='';
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$Users=json_decode($cmpnynm);
	$user=$Users->Users;	
}
//--- COUNTRY STATE & CITY
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."pages/masterCountry",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 39e47dc1-a66a-2347-2fc6-3b5e0160d26d"
  ),
));
$masterCountry = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$countries=array();
$states=array();
$city=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$masterCountry=json_decode($masterCountry);
	$countries=$masterCountry->countryData->ResponseObject;
	$states=$masterCountry->stateData->ResponseObject;
	$city=$masterCountry->cityData->ResponseObject;
}

?>
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
</style> 
<div class="container-fluid">
	<div class="box box-primary">
			<div class="box-body">
				<form action="<?php echo $coreVariable['SiteUrl'];?>api/taxi_fleet_promotions/add.json" method="post" enctype="multipart/form-data">	
				<div class="row"> 
					<div class="col-md-12"> 
						<div class="form-box">
							<div class="panel-group" style="background-color:white;">
								<div class="panel">
									<fieldset>
										<legend style="color:#369FA1;"><b><?= __('Load Package') ?></b></legend> 
								<div class="row">
									<div class="col-md-12">
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mt form-group">
											<p for="from">
												Company Name
												<span class="required">*</span>
											</p>
											<div class="input-field">
												 <?php
												 echo $this->Form->input('company_name',['class'=>'form-control','label'=>false,'autocomplete'=> "off",'placeholder'=>"Company Name",'readonly'=>'readonly','value'=>$user[0]->company_name]);?>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mt form-group">
											<p for="from">
												Promotion Title
												<span class="required">*</span>
											</p>
											<div class="input-field">
												 <?php echo $this->Form->input('title',['class'=>'form-control','label'=>false,'placeholder'=>"Enter Promotion Title"]);?>
											</div>
										</div>
										<input type="hidden" name="user_id" value="<?php echo $user_id;?>">
										<input type="hidden" name="submitted_from" value="web">
										<div class="col-md-4 form-group">
											<p for="from">
												Upload Image of the Promotion
												<span class="required">*</span>
											</p>
											
											<div class="input-field">
												<?php  echo $this->Form->input('image',['class'=>'form-control','label'=>false,'type'=>'file']); ?>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
							 
						<fieldset>
						<legend style="color:#369FA1;"><b><?= __('Area of Operation ') ?></b></legend> 
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6 form-group">
									<p for="from">
										Country
										<span class="required">*</span>
									</p>
									<div class="input-field">
									 <?php $options=array();
										$options[] = ['value'=>'101','text'=>'India'];
										echo $this->Form->input('country_id',["class"=>"form-control " ,'options' => $options,'label'=>false]);?>
									</div>
								</div>
								<div class="col-md-6 form-group">
									<p for="from">
												Choose State
												<span class="required">*</span>
									</p>
									
									<div class="input-field">
								
										<?php 
										$options=array();
										foreach($states as $st)
										{
											$options[] = ['value'=>$st->id,'text'=>$st->state_name];
										};
										echo $this->Form->control('state_id', ['label'=>false,"id"=>"multi_states", "type"=>"select",'options' =>$options, "multiple"=>true , "class"=>"form-control select2","data-placeholder"=>"Select State","style"=>"height:125px;"]);?>
										
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6 form-group" >
									<p for="from">
									Select Option
									</p>
									<div class="input-field">
										 <label class="radio-inline">
										  <input id="city_type" type="radio" name="package_type" value="0" checked="checked"/>All Cities
										</label>
										<label class="radio-inline">
										  <input id="city_type" type="radio" name="package_type" value="1"/>Specific Cities
										</label>
									</div>
								</div>
								<div class="col-md-6 newlist form-group" >
									<p for="from">
										Cities of Operation
										<span class="required">*</span>
									</p>
									<div class="input-field">
									 <?php $options=array();
										$options[] = ['value'=>'0','text'=>'All Cities'];
										echo $this->Form->input('city_id',["class"=>"form-control " ,'options' => $options,'label'=>false]);?>
									</div>
								</div>
								<div class="col-md-6 newlist1 form-group" style="display:none;>
									<p for="from">
												Cities of Operation
												<span class="required">*</span>
									</p>
									<div class="input-field">
									<?php 
										$options=array();
										foreach($city->citystatefi as $cty)
										{
											$options[] = ['value'=>$cty->cityid,'text'=>$cty->name];
											
										};
										$options[] = ['value'=>'0','text'=>'All Cities'];
										echo $this->Form->control('city_id', ['label'=>false,"id"=>"multi_city", "type"=>"select",'options' =>$options, "multiple"=>true , "class"=>"form-control select2","data-placeholder"=>"Select City ","style"=>"height:125px;"]);?>
										
									</div>
								</div>
							</div>
						</div>
						</fieldset>
						<fieldset>
						<legend style="color:#369FA1;"><b><?= __('Promotion Details') ?></b></legend> 
								<div class="row">
								<div class="col-md-12">
									<div class="col-md-12 form-group">
										<p for="from">
											Select Cars or Buses in the Fleet
											<span class="required">*</span>
										</p>
										<div class="input-field">
											<?php 
											$options=array();
											foreach($TaxiFleetCarBuses as $Buses)
											{
												$options[] = ['value'=>$Buses->id,'text'=>$Buses->name];
											};
											echo $this->Form->control('vehicle_type', ['label'=>false,"id"=>"multi_vehicle", "type"=>"select",'options' =>$options, "multiple"=>true , "class"=>"form-control select2","data-placeholder"=>"Select Options ","style"=>"height:125px;"]);?>
										</div>
									</div>
								</div>  
								</div>  
								<div class="row">
									<div class="col-md-12 ">
									<div class="col-md-12 form-group">
										<p for="from">
											Fleet Details
											
										</p>
										<div class="input-field">
											<?php echo $this->Form->input('fleet_detail',['class'=>'form-control','label'=>false,'rows'=>'2']);?>
										</div>
									</div>
									</div>
								</div>
							</fieldset> 
								<fieldset>
									<legend style="color:#369FA1;"><b><?= __('Promotion Period ') ?></b></legend> 
										<div class="row">
											<div class="col-md-12">
												<div class="col-md-4 form-group">
													<p for="from">
													Select Duration of Promotion
													</p>
													<div class="input-field">
															 
													<?php				 
														$options=array();
														foreach($priceMasters as $Price)
														{
														 
															$options[] = ['value'=>$Price->id,'text'=>$Price->week,'priceVal'=>$Price->week,'price'=>$Price->price];
														};
														echo $this->Form->input('price_master_id',['options'=>$options,'class'=>'form-control priceMasters','label'=>false,'empty'=>'Select ...']);?>
														<?php // echo $this->Form->input('duration', ['options' => $priceMasters,'class'=>'form-control','label'=>false]); ?>
													</div>
												</div>
												<div class="col-md-4 form-group">
													<p for="from">
																Promotion Amount
																<span class="required">*</span>
													</p>
													<div class="input-field">
													<?php echo $this->Form->input('payment_amount', ['class'=>'form-control payment_amount','label'=>false,"placeholder"=>"Payment Amount",'readonly'=>'readonly','type'=>'text']);?> 
													</div>
												</div>
												<div class="col-md-4 form-group">
													<p for="from">
																Visibility Date
																<span class="required">*</span>
													</p>
													<div class="input-field">
													<?php echo $this->Form->input('visible_date', ['data-date-format'=>'dd/mm/yyyy','class'=>'form-control visible_date','label'=>false,"placeholder"=>"Visible Date",'readonly'=>'readonly','type'=>'text']); ?>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
											<div class="row">
												<div class="col-md-12">
													<div class="input-field">
														<div class="margin text-center">
														<center>
														<?php echo $this->Form->button('Submit',['class'=>'btn btn-primary btn-submit','value'=>'submit','style'=>'background-color:#1295A2']); ?>
														</center>
														</div>
													</div>
												</div> 
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="user_id" value="<?php echo $user_id;?>">
				</form>
			</div>
		</div>
	</div>
 <?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
	 
    $(document).ready(function ()
	{
		$('form').submit(function () {
 			var name = $.trim($('#price_master_id').val());
 			if (name  === '') {
				alert('Text-field is empty.');
				return false;
			}
		});
		$(document).on('change','.priceMasters',function()
		{
			var priceVal=$('.priceMasters option:selected').attr('priceVal');
			var price=$('.priceMasters option:selected').attr('price');
			var Result = priceVal.split(" ");
			var Result1 = price.split(" ");
			var weeks=Result[0];
			var price=Result1[0];
			
			var todaydate = new Date(); // Parse date
			for(var x=0; x < weeks; x++){
				todaydate.setDate(todaydate.getDate() + 7); // Add 7 days
			}
			var dd = todaydate .getDate();
			var mm = todaydate .getMonth()+1; //January is 0!
			var yyyy = todaydate .getFullYear();
			if(dd<10){  dd='0'+dd } 
			if(mm<10){  mm='0'+mm } 
			var date = dd+'-'+mm+'-'+yyyy;	
			$('.visible_date').val(date);
			$('.payment_amount').val(price);
		})
		$(document).on('change','#city_type',function()
		{
			var city_type=$(this).val();
			//alert(city_type);
			if(city_type==0)
			{
				$(".newlist").show();
				$(".newlist1").hide();				
			}	
			else{
				$(".newlist1").show();
				$(".newlist").hide();
				}	
		})
$("#multi_city").multiselect();
$("#multi_states").multiselect();
$("#multi_vehicle").multiselect();
	});
</script>