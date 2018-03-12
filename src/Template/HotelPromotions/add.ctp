<?php
//-- hotelcategory
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/hotel_categories/HotelCategoriesList.json",
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
$hotelcategory=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$hotelcategory=json_decode($response);
	//pr($hotelcategory);exit;
	$hotelcategory=$hotelcategory->hotelCategories;
}
//-- hotel Cities
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."pages/getHotelCities?token=MzIxNDU2NjU0NTY0cGhmZmpoZGZqaA==",
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
$hotelcities=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$hotelcities=json_decode($response);
	//pr($hotelcities);exit;
	$hotelcities=$hotelcities->response_object;
}
//-- pricemaster
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/price_masters/index.json?promotion_type_id=4",
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
$pricemaster=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$pricemaster=json_decode($response);
	//pr($pricemaster);exit;
	$pricemaster=$pricemaster->PriceMasters;
}

?>
<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-plus"></i> <b> Hotel Promotion</b>
				</div> 
				<div class="box-body"> 
				<form action="<?php echo $coreVariable['SiteUrl'];?>api/hotel_promotions/add.json" method="post" enctype="multipart/form-data">
					<fieldset>
						<legend><?= __('Add Hotel Promotion') ?></legend>
							<div class="row">
								<div class="col-md-12">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
											Hotel Name
											<span class="required">*</span>
										</p>
										<div class="input-field">
											 <?php echo $this->Form->input('hotel_name',['class'=>'form-control','label'=>false]);?>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
											Hotel Category
											<span class="required">*</span>
										</p>
										<div class="input-field">
											 <?php
												$options=array();
												foreach($hotelcategory as $cat)
												{
													$options[] = ['value'=>$cat->id,'text'=>$cat->name];
												};
												
												echo $this->Form->input('hotel_category_id',['class'=>'form-control select2','options' => $options,'label'=>false,"empty"=>"Select Hotel Category"]);?>
										</div>
									</div>
								</div>
							</div> 
							<div class="row">
								<div class="col-md-12">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
											Hotel Location
											<span class="required">*</span>
										</p>
										<div class="input-field">
										 <?php echo $this->Form->input('hotel_location',['class'=>'form-control','label'=>false]);?>
											
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
											Hotel Website
											<span class="required">*</span>
										</p>
										<div class="input-field">
										 <?php echo $this->Form->input('website',['class'=>'form-control','label'=>false]);?>
											
										</div>
									</div>
									
								</div>
							</div> 
							<div class="row">
								<div class="col-md-12">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
											Tariff of Cheapest Room
											<span class="required">*</span>
										</p>
										<div class="input-field">
										 <?php echo $this->Form->input('cheap_tariff',['class'=>'form-control','label'=>false]);?>
											
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
											Tariff of Most Expensive Room
											<span class="required">*</span>
										</p>
										<div class="input-field">
											 <?php echo $this->Form->input('expensive_tariff',['class'=>'form-control','label'=>false]);?>
										</div>
									</div>
								</div>
							</div> 
							<div class="row">
								<div class="col-md-12">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
											Total Charges
											<span class="required">*</span>
										</p>
										<div class="input-field">
										 <?php echo $this->Form->input('total_charges',['class'=>'form-control','label'=>false]);?>
											
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
										Hotel Rating
											<span class="required">*</span>
										</p>
										<div class="input-field">
										 <?php echo $this->Form->input('hotel_rating',['class'=>'form-control','label'=>false]);?>
											
										</div>
									</div>
									
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
											City
											<span class="required">*</span>
										</p>
										<div class="input-field">
										 <?php
											$options=array();
												foreach($hotelcities as $cities)
												{
													$options[] = ['value'=>$cities->value,'text'=>$cities->label.' ('.$cities->state_name.') ('.$cities->usercount.') - Rs.'.$cities->price ];
												}
										 echo $this->Form->input('city_id',['class'=>'form-control select2 ',"multiple"=>true ,'label'=>false,'options' => $options,"data-placeholder"=>"Select City ",'id'=>'city']);?>
											
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
											<p for="from">
												Promotion Duration
												<span class="required">*</span>
											</p>
											<div class="input-field">
												 <?php
														$options=array();
														foreach($pricemaster as $duration)
														{
															$options[] = ['value'=>$duration->id,'text'=>$duration->week];
														};
												 echo $this->Form->input('price_master_id',['class'=>'form-control select2','options' => $options,'label'=>false]);?>
											</div>
										</div>
								</div>
							</div> 
							<div class="row">
								<div class="col-md-12">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
											<p for="from">
												Charges
												<span class="required"></span>
											</p>
											<div class="input-field">
										<?php echo $this->Form->input('charges', ['class'=>'form-control charges','label'=>false,"placeholder"=>"Total Charges",'readonly'=>'readonly','type'=>'text']); ?>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
											<p for="from">
												Visible Date
												<span class="required">*</span>
											</p>
											<div class="input-field">
										<?php echo $this->Form->input('visible_date', ['data-date-format'=>'dd/mm/yyyy','class'=>'form-control visible_date','label'=>false,"placeholder"=>"Visibility Date",'readonly'=>'readonly','type'=>'text']); ?>
										</div>
									</div>
								</div>
							</div> 	
							<div class="row">
								<div class="col-md-12">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<p for="from">
											Photograph of the Hotel	
											<span class="required">*</span>
										</p>
										<div class="input-field">
											 <?php echo $this->Form->input('hotel_pic',['class'=>'form-control','label'=>false,'type'=>'file']);?>
											  <span style="color: red;font-size: 13px;"><b>File Type:</b> jpeg/jpg/png</span>&nbsp;&nbsp;&nbsp;<span style="color: red;font-size: 13px;"><b>Max Size:</b> 2 MB</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt">
										<div class="input-field">
											<p for="from">
												Hotel Rating
											</p>
										</div>
										<div style=" width: 200px;" class="stars">
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
							</div> 
							<div class="row">
								<div class="col-md-12">
									<div class="input-field">
										<div class="margin text-center">
										<center>
										<?php echo $this->Form->button('Submit',['class'=>'btn btn-primary btn-submit','value'=>'submit']); ?>
										</center>
										</div>
									</div>
								</div> 
							</div>							
					</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<script>

function charges1(price){
price = String(price);
var price = price.substr(price.indexOf("-") + 1);
if(price==""){ price =0;}
duration = $('#duration').val();
if(duration==""){duration = 1 }
getcharge = $('#charges').val();
if(getcharge==""){getcharge = 0; }
totalcharge =  (parseInt(getcharge)) + (parseInt(price) * parseInt(duration))	;
$('#charges').val(totalcharge);
hiddencharges = $('#hiddencharges').val();
if(hiddencharges==""){hiddencharges = 0; }
totalcharge1 =  parseInt(hiddencharges)+ parseInt(price);
$('#hiddencharges').val(totalcharge1);
$('#charges1').html(totalcharge1);
$('#charges2').html(totalcharge1);
}	

function charges(price){
price = String(price);
var price = price.substr(price.indexOf("-") + 1);
if(price==""){ price =0;}
duration = $('#duration').val();
if(duration==""){duration = 1 }
getcharge = $('#charges').val();
if(getcharge==""){getcharge = 0; }
//totalcharge =  (parseInt(getcharge)) + (parseInt(price) * parseInt(duration))	;
totalcharge =  (parseInt(getcharge)) + 6(parseInt(price) * parseInt(duration))	;
$('#charges').val(totalcharge)
hiddencharges = $('#hiddencharges').val()
if(hiddencharges==""){hiddencharges = 0; }
totalcharge1 =  parseInt(hiddencharges)+ parseInt(price);
$('#hiddencharges').val(totalcharge1)
$('#charges1').html(totalcharge1)
$('#charges2').html(totalcharge1)
}

function removecharges(price){
price = String(price);
var price = price.substr(price.indexOf("-") + 1)

if(price==""){ price =0;}
duration = $('#duration').val();
if(duration==""){duration = 1 }
getcharge = $('#charges').val();
if(getcharge==""){getcharge = 0; }
totalcharge =  (parseInt(getcharge)) - (parseInt(price) * parseInt(duration))	;
$('#charges').val(totalcharge)
hiddencharges = $('#hiddencharges').val()
if(hiddencharges==""){hiddencharges = 0; }
totalcharge1 =  parseInt(hiddencharges)- parseInt(price);
$('#hiddencharges').val(totalcharge1)
$('#charges1').html(totalcharge1)
$('#charges2').html(totalcharge1)
}	
</script>
