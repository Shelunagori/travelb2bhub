<?php
//-- priceMasters
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/price_masters/index.json?promotion_type_id=1",
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
	//pr($priceMasters);exit;
	$priceMasters=$priceMasters->PriceMasters;
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
//--- Category
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/post_travle_package_categories/index.json",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 39e85539-7745-db54-4f15-121a9d912dc7"
  ),
));
$responsecat = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $Category=json_decode($responsecat);
  $cat=$Category->postTravlePackageCategories;
}
//--- Currency
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/currencies/index.json",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 9e0d9410-0a3d-b8b0-5a55-bca572f01b35"
  ),
));
$responsecrn = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$Currencies=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $currenc=json_decode($responsecrn);
  $Currencies=$currenc->Currencies;
}
?>
<style>
.hr{
	margin-top:25px !important;
}
/*	
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
}*/ 
fieldset{
	margin:10px !important;
}
.col-md-12 {
	margin:5px !important;
}
</style> 
<div class="box-body">
<form action="<?php echo $coreVariable['SiteUrl'];?>api/post_travle_packages/add.json" method="post" enctype="multipart/form-data">	
	<div class="row"> 
		<div class="col-md-12"> 
			<div class="form-box">
				<div class="panel-group" style="background-color:white;">
					<div class="panel panel-default">
						<fieldset>
							<legend style="color:#369FA1;"><b><?= __('Load Package') ?></b></legend>
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-4">
											<p for="from">
												Package Title
												<span class="required">*</span>
											</p>
											<div class="input-field">
												 <?php echo $this->Form->input('title',['class'=>'form-control','label'=>false,'placeholder'=>"Package Title",]);?>
												
											</div>
										</div>
									
										<div class="col-md-4">
											<p for="from">
												Upload Image of the Promotion
												<span class="required">*</span>
											</p>
											
											<div class="input-field">
												<?php  echo $this->Form->input('image',['class'=>'form-control','label'=>false,'type'=>'file']); ?>
											</div>
										</div>
										<div class="col-md-4 ">
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
						<br>
							<fieldset>
								<legend style="color:#369FA1;"><b><?= __('Package Details') ?></b></legend> 
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-4">
												<p for="from">
													Package Category
													<span class="required">*</span>
												</p>
												<div class="input-field">
												<?php 
 
												$options=array();
												foreach($cat as $sts)
												{
													$options[] = ['value'=>$sts->id,'text'=>$sts->name];
												};
												echo $this->Form->control('package_category_id', ['label'=>false,"id"=>"multi_category", "type"=>"select",'options' =>$options, "multiple"=>true , "class"=>"form-control select2","data-placeholder"=>"Select Category ","style"=>"height:125px;"]);?>
												</div>
											</div>
											<div class="col-md-4">
												<p for="from">
													Valid Till
													<span class="required">*</span>
												</p>
												<div class="input-field input-group">
													<?php echo $this->Form->input('valid_date',['class'=>'form-control date-picker date','label'=>false,'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyyy']);?>
													<p class="input-group-addon btn" >
													<span class="fa fa-calendar"></span>
													</p>
												</div>
											</div>
											<div class="col-md-4">
												<p for="from">
													Duration Night
													<span class="required">*</span>
												</p>
												<div class="input-field"> 
													<select name="duration_day_night" class="form-control select2">
													<option value="">Select...</option>
													<option>1 Night 2 Days</option>
													<option>2 Night 3 Days</option>
													<option>3 Night 4 Days</option>
													<option>4 Night 5 Days</option>
													<option>5 Night 6 Days</option>
													<option>6 Night 7 Days</option>
													<option>7 Night 8 Days</option>
													<option>8 Night 9 Days</option>
													<option>9 Night 10 Days</option>
													<option>10 Night 11 Days</option>
													<option>11 Night 12 Days</option>
													<option>12 Night 13 Days</option>
													<option>13 Night 14 Days</option>
													<option>14 Night 15 Days</option>
													<option>More than 15 Days</option>
													</select>
												</div>
											</div>											 
										</div>
									</div>
								<input type="hidden" name="user_id" value="<?php echo $user_id;?>">
								<input type="hidden" name="submitted_from" value="web">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-4">
												<p for="from">
													Starting Price
													<span class="required">*</span>
												</p>
												<div class="input-field">
													<?php echo $this->Form->input('starting_price',['class'=>'form-control','label'=>false,'placeholder'=>'Starting Price']);?>
												</div>
											</div>
											<div class="col-md-4">
												<p for="from">
													Currency
													<span class="required">*</span>
												</p>
												<div class="input-field">
													 <?php $options=array();
													foreach($Currencies as $sdat)
													{
														$options[] = ['value'=>$sdat->id,'text'=>$sdat->name];
													};
													echo $this->Form->input('currency_id',['options' => $options,'class'=>'form-control','label'=>false,'empty'=>'Select...']);?>
													
												</div>
											</div>
										 
											<div class="col-md-4">
												<p for="from">
													Choose Country
													<span class="required">*</span>
												</p>
												<div class="input-field">
												 <?php $options=array();
												foreach($countries as $country)
												{
													$options[] = ['value'=>$country->id,'text'=>$country->country_name];
												};
													echo $this->Form->input('country_id',["class"=>"form-control select2", "multiple"=>true ,'options' => $options,'label'=>false,"data-placeholder"=>"Select City "]);?>
												</div>
												</div>
										</div>
									</div> 
									
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-4">
												<p for="from">
												Choose City
												<span class="required">*</span>
												</p>
												<div class="input-field">
												<?php  
												$options=array();
												foreach($city->citystatefi as $cty)
												{
													$options[] = ['value'=>$cty->cityid,'text'=>$cty->name];
												};
												echo $this->Form->control('city_id', ['label'=>false,"id"=>"multi_city", "type"=>"select",'options' =>$options, "multiple"=>true , "class"=>"form-control select2","data-placeholder"=>"Select City ","style"=>"height:125px;"]);?>
												</div>
											</div>
											<div class="col-md-8">
												<p for="from">
												Package Details				
													<span class="required">*</span>
												</p>
												<div class="input-field">
													 <?php echo $this->Form->textarea('package_detail',['class'=>'form-control','label'=>false,'rows'=>2]);?>
													
												</div>
											</div>
										</div>
									</div> 
									<div class="row">
										<div class="col-md-12">
											 
											<div class="col-md-12">
												<p for="from">
													Excluded Details
												<span class="required">*</span>
												</p>
												<div class="input-field">
													 <?php echo $this->Form->textarea('excluded_detail',['class'=>'form-control','label'=>false,'rows'=>2]);?>
												</div>
											</div>
										</div>
									</div>
									
								</fieldset>
							<br>
				<fieldset>
						<legend style="color:#369FA1;"><b><?= __('Payment ') ?></b></legend> 
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-4">
										<p for="from">
											Payment Duration
										</p>
										<div class="input-field">
												 
										<?php				 
											$options=array();
											foreach($priceMasters as $Price)
											{
												$options[] = ['value'=>$Price->id,'text'=>$Price->week,'priceVal'=>$Price->week,'price'=>$Price->price];
											};
											echo $this->Form->input('price_master_id',['options'=>$options,'class'=>'form-control priceMasters','label'=>false,'empty'=>'Select ...']);?>
										</div>
									</div>
									<div class="col-md-4">
										<p for="from">
													Visibility Date
													<span class="required">*</span>
										</p>
										<div class="input-field">
										<?php echo $this->Form->input('visible_date', ['data-date-format'=>'dd/mm/yyyy','class'=>'form-control visible_date','label'=>false,"placeholder"=>"Visible Date",'readonly'=>'readonly','type'=>'text']); ?>
										</div>
									</div>
									<div class="col-md-4">
										<p for="from">
													Promotion Amount
													<span class="required">*</span>
										</p>
										<div class="input-field">
										<?php echo $this->Form->input('payment_amount', ['class'=>'form-control payment_amount','label'=>false,"placeholder"=>"Payment Amount",'readonly'=>'readonly','type'=>'text']);?> 
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
			</form>
		</div>
	</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
	 
    $(document).ready(function () {
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
$("#multi_city").multiselect();
$("#multi_states").multiselect();
$("#multi_category").multiselect();
});
</script>
