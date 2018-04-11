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
	//pr($city);exit;
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
.col-md-12 {
	margin:5px !important;
}
</style> 
<div class="container-fluid">
	<div class="box box-primary">
		<div class="box-body">
		<div class="row equal_column"  style="background-color:">
				<div class="col-md-12"> 
					<?php echo  $this->Flash->render() ?>
				</div>
				<form action="<?php echo $coreVariable['SiteUrl'];?>api/event_planner_promotions/add.json" method="post" enctype="multipart/form-data">	
 				</div>
				<div class="box-body">
					<fieldset>
					<legend style="color:#369FA1;"><b>Load Package</b></legend>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6">
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
								<div class="col-md-6">
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
					<legend style="color:#369FA1;"><b>Promotion Details</b></legend>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6">
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
								<div class="col-md-6">
									<p> States <span class="required">*</span></p>
									<?php 
									$options=array();
									foreach($states as $st)
									{
										$options[] = ['value'=>$st->id,'text'=>$st->state_name];
									};
									echo $this->Form->input('state_id', ['options' => $options,'class'=>'form-control select2','label'=>false,"data-placeholder"=>"Select States",'multiple'=>true]); ?> 										 
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6" >
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
								<div class="col-md-6 newlist">
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
								<div class="col-md-6 newlist1" style="display:none;">
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
									<p>Event Details </p>
									<?php echo $this->Form->textarea('event_detail', ['class'=>'form-control','label'=>false,"placeholder"=>"Enter Description of Your Company",'rows'=>3,'style'=>'resize:none']); ?> 	 
								</div>
							</div>
						</div>
					</fieldset>
					<fieldset>
					<legend style="color:#369FA1;"><b> &nbsp; Payment &nbsp;  </b></legend>
								<div class="row">
											<div class="col-md-12">
												<div class="col-md-4">
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
												<div class="col-md-4">
													<p for="from">
																Promotion Amount
																<span class="required">*</span>
													</p>
													<div class="input-field">
													<?php echo $this->Form->input('payment_amount', ['class'=>'form-control payment_amount','label'=>false,"placeholder"=>"Payment Amount",'readonly'=>'readonly','type'=>'text']);?> 
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
				</form>
			</div>
		</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).ready(function (){
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
	$(document).on('click','#city_type', function()
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
});
</script>
 
