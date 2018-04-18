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
	//pr($masterCountry);exit;
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
  // pr($currenc);exit;
  $Currencies=$currenc->Currencies;
}
?>
<style>
.select2-container--default .select2-results__option[aria-disabled=true] {
    display: none;
}

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
			<form action="<?php echo $coreVariable['SiteUrl'];?>api/post_travle_packages/add.json" method="post" enctype="multipart/form-data">	
				<div class="row"> 
					<div class="col-md-12"> 
						<div class="form-box">
									<fieldset>
										<legend style="color:#369FA1;"><b><?= __('Load Package Promotion') ?></b></legend>
											<div class="row">
												<div class="col-md-12">
													<div class="col-md-4 form-group">
														<p for="from">
															Enter Package Title
															<span class="required">*</span>
														</p>
														<div class="input-field">
															 <?php echo $this->Form->input('title',['class'=>'form-control requiredfield','label'=>false,'placeholder'=>"Enter Package Title",]);?>
															 <label style="display:none" class="helpblock error" > This field is required.</label>
														</div>
													</div>
													<div class="col-md-4 form-group">
																<p for="from">
																	Select Package Category
																</p>
																<div class="input-field">
																<?php 
																$options=array();
																foreach($cat as $sts)
																{
																	$options[] = ['value'=>$sts->id,'text'=>$sts->name];
																};
																echo $this->Form->control('package_category_id', ['label'=>false,"id"=>"multi_category", "type"=>"select",'options' =>$options, "multiple"=>true , "class"=>"form-control select2","data-placeholder"=>"Select Options ","style"=>"height:125px;"]);?>
																</div>
															</div>
														<div class="col-md-4 form-group">
															<p for="from">
																Upload Image of Promotion
																<span class="required">*</span>
															</p>
															
															<div class="input-field">
																<?php  echo $this->Form->input('image',['class'=>'form-control requiredfield','label'=>false,'type'=>'file']); ?>
																<label style="display:none" class="helpblock error" > This field is required.</label>
															</div>
														</div>
													</div>
												</div>
											</fieldset>
										
										
											<fieldset>
												<legend style="color:#369FA1;"><b><?= __('Package Details') ?></b></legend> 
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-4 form-group">
																<p for="from">
																	Duration of Package
																	<span class="required">*</span>
																</p>
																<div class="input-field"> 
																	<select name="duration_day_night" class="form-control select2 requiredfield">
																	<option value="">Select...</option>
																	<option>1 N/2 D</option>
																	<option>2 N/3 D</option>
																	<option>3 N/4 D</option>
																	<option>4 N/5 D</option>
																	<option>5 N/6 D</option>
																	<option>6 N/7 D</option>
																	<option>7 N/8 D</option>
																	<option>8 N/9 D</option>
																	<option>9 N/10 D</option>
																	<option>10 N/11 D</option>
																	<option>11 N/12 D</option>
																	<option>12 N/13 D</option>
																	<option>13 N/14 D</option>
																	<option>14 N/15 D</option>
																	<option>More than 15 Days</option>
																	</select>
																	<label style="display:none" class="helpblock error" > This field is required.</label>
																</div>
															</div>			
															<div class="col-md-4 form-group">
																<p for="from">
																	Package Valid Till
																	<span class="required">*</span>
																</p>
																<div class="input-field">
																	<?php echo $this->Form->input('valid_date',['class'=>'form-control date-picker date requiredfield','label'=>false,'data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyyy','value'=>date('d-m-Y')]);?>
																	<label style="display:none" class="helpblock error" > This field is required.</label>
																</div>
															</div>
																<div class="col-md-4 form-group">
																<p for="from">
																	Package Starting Price
																	<span class="required">*</span>
																</p>
																<div class="input-field">
																	<?php echo $this->Form->input('starting_price',['class'=>'form-control requiredfield','label'=>false,'placeholder'=>'Starting Price']);?>
																	<label style="display:none" class="helpblock error" > This field is required.</label>
																</div>
															</div>							 
														</div>
													</div>
												<input type="hidden" name="user_id" value="<?php echo $user_id;?>">
												<input type="hidden" name="submitted_from" value="web">
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-4 form-group">
																<p for="from">
																Package Type
																</p>
																<div class="input-field">
																	 <label class="radio-inline">
																	  <input id="pack_type" type="radio" name="package_type" value="0" checked="checked"/>Domestic
																	</label>
																	<label class="radio-inline">
																	  <input id="pack_type" type="radio" name="package_type" value="1"/>International
																	</label>
																</div>
															</div>
															<div class="col-md-4 newlist form-group" >
																<p for="from">
																	Select Countries
																	<span class="required">*</span>
																</p>
																<div class="input-field replacedata">
																</div>
															</div>
 																<div class="col-md-4 form-group">
																<p for="from">
																Select Cities
																<span class="required">*</span>
																</p>
																<div class="input-field" id="mcity">
																<?php  
																// pr($city);
																$options=array();
																foreach($city->citystatefi as $cty)
																{
																	$options[] = ['value'=>$cty->cityid,'text'=>$cty->name, 'country_id'=>$cty->country_id];
																};
																echo $this->Form->control('city_id', ['label'=>false,"id"=>"multi_city", "type"=>"select",'options' =>$options, "multiple"=>true , "class"=>"form-control select2 requiredfield max_limit","data-placeholder"=>"Select City ","style"=>"height:125px;"]);?>
																<label style="display:none" class="helpblock error" > This field is required.</label>
																</div>
															</div>
														</div>
													</div> 
													<div class="row">
														<div class="col-md-12 form-group">
															<div class="col-md-12 ">
															<p for="from">
																Included In Package
																</p>
																 
																<div class="input-field">
																	 <?php echo $this->Form->textarea('package_detail',['class'=>'form-control requiredfield','label'=>false,'rows'=>2]);?>
																	<label style="display:none" class="helpblock error" > This field is required.</label>
																</div>
															</div>
														</div>
														</div>
													<div class="row">
														<div class="col-md-12 form-group">
															<div class="col-md-12 ">
															<p for="from">
																	Excluded From Package
															</p>
															 
																<div class="input-field">
																	 <?php echo $this->Form->textarea('excluded_detail',['class'=>'form-control','label'=>false,'rows'=>2]);?>
																</div>
															</div>
														</div>
													</div>
												</fieldset>
											
									<fieldset>
										<legend style="color:#369FA1;"><b><?= __('Payment Period') ?></b></legend> 
											<div class="row">
												<div class="col-md-12">
													<div class="col-md-6 form-group">
														<p for="from">
															Payment Duration <span class="required">*</span>
														</p>
														<div class="input-field">
																 
														<?php				 
															$options=array();
															foreach($priceMasters as $Price)
															{
																$options[] = ['value'=>$Price->id,'text'=>$Price->week,'priceVal'=>$Price->week,'price'=>$Price->price];
															};
															echo $this->Form->input('price_master_id',['options'=>$options,'class'=>'form-control priceMasters requiredfield select2','label'=>false,'empty'=>'Select Options']);?>
															<label style="display:none" class="helpblock error" > This field is required.</label>
														</div>
													</div>
													<div class="col-md-6 form-group">
														<p for="from">
																	Promotion Amount
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
								<input type="hidden" name="user_id" value="<?php echo $user_id;?>">
							</form>
						</div>
					</div>
				</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
	 
    $(document).ready(function () {
		 var pack_type=$('#pack_type').val();
			//alert(pack_type);
			if(pack_type==1){
				$(".replacedata").html('<?php $options=array();
				foreach($countries as $country)
				{
					if($country->id==101){
						continue;
					}
					$options[] = ['value'=>$country->id,'text'=>$country->country_name];
				};
				echo $this->Form->input('country_id',["class"=>"form-control select2 requiredfield cntry", "multiple"=>true ,'options' => $options,'label'=>false,"data-placeholder"=>"Select Countries "]);?>');
			}
			else{
				$(".replacedata").html('<?php $options=array();
				$options[] = ['value'=>'101','text'=>'India','selected'];
				echo $this->Form->input('country_id',["class"=>"form-control select2 requiredfield cntry","multiple"=>true ,'options' => $options,'label'=>false]);
				?>');
			}
			$('.select2').select2();
			
			
		$('form').submit(function () {
			var x=0;
			$( ".requiredfield" ).each(function() {
  				if($(this).val()==''){
 					$(this).closest('div.form-group').find('.helpblock').show();
					x = 1;
				}
			});
			if(x==1){
				$('html, body').animate({scrollTop:0}, 'slow');
				return false;
			}
		});
		
		$(document).on('change','.cntry',function()
		{
			var country_id=$('option:selected', this).val();
			
		var countries = [];
        $.each($(".cntry option:selected"), function(){
             countries.push($(this).val());
        });
         
		 
		 
		 var m_data = new FormData();
			m_data.append('country_id',countries);			
			$.ajax({
				url: "<?php echo $this->Url->build(["controller" => "PostTravlePackages", "action" => "ajax_city"]); ?>",
				data: m_data,
				processData: false,
				contentType: false,
				type: 'POST',
				dataType:'text',
				success: function(data)
				{
					$('#mcity').html('<select name="city_id" multiple="multiple" class="form-control select2 requiredfield max_limit" data-placeholder="Select City" id="multi_city" style="height:125px;">'+data+'</select>');
					$("#multi_city").select2();
				}
			});
		  
			 
		});	
		
		
	 
		$(document).on('change','.priceMasters',function()
		{
			var p_type=$(this).val();
			var priceVal=$('.priceMasters option:selected').attr('priceVal');
			var price=$('.priceMasters option:selected').attr('price');
			if(p_type!=''){
			var Result = priceVal.split(" ");
			var Result1 = price.split(" ");
			var weeks=Result[0];
			var price=Result1[0];
			$('.payment_amount').val(price);
			}
			else{
				$('.payment_amount').val(0);
			}
		})
		$(document).on('change','#pack_type',function()
		{
			var pack_type=$(this).val();
			//alert(pack_type);
			 
			if(pack_type==1){
				$('#mcity').html('<select name="city_id" multiple="multiple" class="form-control select2 requiredfield max_limit" data-placeholder="Select City" id="multi_city" style="height:125px;"><option value="">Select Please </option></select>');
				$(".replacedata").html('<?php $options=array();
				foreach($countries as $country)
				{
					if($country->id==101){
						continue;
					}
					$options[] = ['value'=>$country->id,'text'=>$country->country_name];
				};
				echo $this->Form->input('country_id',["class"=>"form-control select2 requiredfield cntry", "multiple"=>true ,'options' => $options,'label'=>false,"data-placeholder"=>"Select Countries "]);?>');
			}
			else{
				$('#mcity').html('<select name="city_id" multiple="multiple" class="form-control select2 requiredfield max_limit" data-placeholder="Select City" id="multi_city" style="height:125px;"><option value="">Select Please </option></select>');
					$("#multi_city").select2();
				$(".replacedata").html('<?php $options=array();
				$options[] = ['value'=>'101','text'=>'India'];
				echo $this->Form->input('country_id',["class"=>"form-control select2 requiredfield cntry","multiple"=>true ,'options' => $options,'label'=>false]);
				?>');
			}
			$('.select2').select2();
		});
$("#multi_city").multiselect();
$("#multi_states").multiselect();
$("#multi_category").multiselect();
});
</script>

