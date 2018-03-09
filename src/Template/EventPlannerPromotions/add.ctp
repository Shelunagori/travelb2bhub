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
.col-md-12 {
	margin:5px !important;
}
</style>

<div id="my_final_responses" class="container-fluid">
	<div class="row equal_column"  style="background-color:#fff">
		<div class="col-md-12"> 
			 
			<?php echo  $this->Flash->render() ?>
		</div>
		<form action="http://konciergesolutions.com/travelb2bhub/api/event_planner_promotions/add.json" method="post" enctype="multipart/form-data">	
		<div class="col-md-12"> 
			<div class="box box-default">
				<div class="box-header with-border"> 
					<h3 class="box-title" style="padding:0px">Event Planner Promotion</h3>
					<div class="box-tools pull-right">
 					</div>
 				</div>
				<div class="box-body">
					<fieldset>
					<legend style="color:#369FA1;"><b> &nbsp; Load Package &nbsp;  </b></legend>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-4">
									<p for="from">
										Company Name
										<span class="required">*</span>
									</p>
									<div class="input-field">
										 <?php echo $this->Form->input('company_name',['class'=>'form-control','label'=>false,'autocomplete'=> "off",'placeholder'=>"Company Name",'readonly'=>'readonly','value'=>$user[0]->company_name]);?>
									</div>
								</div>
								<input type="hidden" name="user_id" value="<?php echo $user_id;?>">
								<input type="hidden" name="submitted_from" value="web">
								<div class="col-md-4">
									<p for="from">
										Upload Image of the Promotion
										<span class="required">*</span>
									</p>
									<div class="input-field">
										<?php  echo $this->Form->input('image',['class'=>'form-control','label'=>false,'type'=>'file']); ?>
									</div>
								</div>
								<div class="col-md-4">
									<p for="from">
										Upload Document
										<span class="required">*</span>
									</p>
									<div class="input-field">
										<?php  echo $this->Form->input('document',['class'=>'form-control','label'=>false,'type'=>'file']); ?>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					<fieldset>
					<legend style="color:#369FA1;"><b> &nbsp; Package Details &nbsp;  </b></legend>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-4">
									<p> Country </p>
									<?php $options=array();
									foreach($countries as $country)
									{
										$options[] = ['value'=>$country->id,'text'=>$country->country_name];
									};echo $this->Form->input('country_id', ['options' => $options,'class'=>'form-control select2','label'=>false,'empty'=>'Select...']); ?> 
								</div>
								
								<div class="col-md-4">
									<p> States <span class="required">*</span></p>
									<?php 
									$options=array();
									foreach($states as $st)
									{
										$options[] = ['value'=>$st->id,'text'=>$st->state_name];
									};
									echo $this->Form->input('state_id', ['options' => $options,'class'=>'form-control select2','label'=>false,"data-placeholder"=>"Select States",'multiple'=>true]); ?> 										 
								</div>
								<div class="col-md-4">
									<p> Cities of Operation </p>
									<?php 
									$options=array();
									foreach($city->citystatefi as $cty)
									{
										$options[] = ['value'=>$cty->cityid,'text'=>$cty->name];
									};
									echo $this->Form->input('city_id', ['options' =>$options,'class'=>'form-control select2','label'=>false,"data-placeholder"=>"Select Cities",'multiple'=>true]); ?> 	 
								</div>
 							</div>
						</div>
						 
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-12">
									<p> Description </p>
									<?php echo $this->Form->textarea('event_detail', ['class'=>'form-control','label'=>false,"placeholder"=>"Please Provide Event Description",'rows'=>3,'style'=>'resize:none']); ?> 	 
								</div>
							</div>
						</div>
					</fieldset>
					<fieldset>
					<legend style="color:#369FA1;"><b> &nbsp; Payment &nbsp;  </b></legend>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6">
									<p> Payment Duration <span class="required">*</span></p>
									<?php
									$options=array();
									foreach($priceMasters as $Price){
										$options[] = ['value'=>$Price->id,'text'=>$Price->week,'priceVal'=>$Price->week];
									}
									echo $this->Form->input('price_master_id',['options'=>$options,'class'=>'form-control priceMasters','label'=>false,'empty'=>'Select ...']); ?>
								</div>
								<div class="col-md-6">
									<p> Visible Date </p>
									<?php echo $this->Form->input('visible_date', ['class'=>'form-control visible_date','label'=>false,"placeholder"=>"Visible Date",'readonly'=>'readonly','type'=>'text']); ?> 	 
								</div>
							</div>
						</div>
					</fieldset>
					 
					<div class="row">
						<div class="col-md-12" align="center">
							<?= $this->Form->button(__('Submit'),['class'=>'btn btn-sm btn-success']) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).ready(function (){
	$(document).on('change','.priceMasters',function(){
		var priceVal=$('.priceMasters option:selected').attr('priceVal');
		var Result = priceVal.split(" ");
		var weeks=Result[0];
		
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
	})
});
</script>
 
