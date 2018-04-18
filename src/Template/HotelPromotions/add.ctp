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
label{
	font-size:13px;
}
</style> 
<section class="content">
<div class="container-fluid">
	<div class="box box-primary">
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
				<form action="<?php echo $coreVariable['SiteUrl'];?>api/hotel_promotions/add.json" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend style="color:#369FA1;"><b> &nbsp; <?= __('Load Hotel Promotion') ?> &nbsp;  </b></legend>
						<div class="row">
							<div class="col-md-12">
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mt form-group">
									<p for="from">
										User Name
									</p>
									<div class="input-field">
									<?php 
									 //pr($userss);exit;
									 echo $this->Form->input('user_name',['class'=>'form-control ','label'=>false,'placeholder'=>"Enter Your Hotel Name",'value'=>$userss['first_name'].$userss['last_name'],'readonly']);?>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mt form-group">
									<p for="from">
										Hotel Name
									</p>
									<div class="input-field">
									<?php 
									 //pr($userss['company_name']);exit;
									 echo $this->Form->input('hotel_name',['class'=>'form-control ','label'=>false,'placeholder'=>"Enter Your Hotel Name",'value'=>$userss['company_name'],'readonly']);?>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mt form-group">
									<p for="from">
										Upload Image of Hotel	
									</p>
									<div class="input-field">
										 <?php echo $this->Form->input('hotel_pic',['class'=>'form-control imgInp requiredfield ','label'=>false,'type'=>'file','id'=>'hotelImg', 'onchange' => 'checkCertificate()']);?>
										  <label style="display:none" class="helpblock error" > This field is required.</label>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">	
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mt form-group">
										<div class="input-field">
												<p for="from">
													Hotel Rating
												</p>
										</div>
										<div style=" width: 200px;" class="stars">
											<input class="requiredfield" style="display:none;" type="radio" checked value="0" name="hotel_rating"/>
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
											   <label style="display:none" class="helpblock error" > This field is required.</label>
										</div>
									</div>								
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mt form-group">
											<p for="from">
												Select Hotel Category
												<span class="required">*</span>
											</p>
											<div class="input-field">
												 <?php
													$options=array();
													foreach($hotelcategory as $cat)
													{
														$options[] = ['value'=>$cat->id,'text'=>$cat->name];
													};
													
													echo $this->Form->input('hotel_category_id',['class'=>'form-control select2 ','options' => $options,'label'=>false,"empty"=>"Select Hotel Category"]);?>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mt form-group">
										<p for="from">
											Cheapest Room Rate
											<span class="required">*</span>
										</p>
										<div class="input-field">
										 <?php echo $this->Form->input('cheap_tariff',['class'=>'form-control requiredfield','label'=>false,'type'=>'number','placeholder'=>"Cheapest Room Rate"]);?>
										 <label style="display:none" class="helpblock error" > This field is required.</label>
											
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mt form-group">
										<p for="from">
											Most Expensive Room Rate
											<span class="required">*</span>
										</p>
										<div class="input-field">
											 <?php echo $this->Form->input('expensive_tariff',['class'=>'form-control requiredfield','label'=>false,'type'=>'number','placeholder'=>"Most Expensive Room Rate"]);?>
											 <label style="display:none" class="helpblock error" > This field is required.</label>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mt form-group">
										<p for="from">
											Hotel Location (Address, City, State)
											<span class="required">*</span>
										</p>
										<div class="input-field">
										 <?php echo $this->Form->input('hotel_location',['class'=>'form-control ','label'=>false,'placeholder'=>"Enter Your Hotel Location (City, State)",'value'=>$userss['adress1'].$userss['locality']]);?>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mt form-group">
										<p for="from">
											Hotel Website
										</p>
										<div class="input-field">
										 <?php echo $this->Form->input('website',['class'=>'form-control','label'=>false,'placeholder'=>"Enter Your Website",'value'=>$userss['web_url']]);?>
										</div>
									</div>
								</div>
							</div> 	
						</fieldset> 
						<fieldset>
							<legend style="color:#369FA1;"><b> &nbsp; <?= __(' Payment Period') ?> &nbsp;  </b></legend>
							<div class="row">
								<div class="col-md-12">
										<div class="col-md-6 form-group">
											<p for="from">
												Select Promotion Duration
												<span class="required">*</span>
											</p>
											<div class="input-field">
												 <?php
														$options=array();
														foreach($pricemaster as $duration)
														{
															$options[] = ['value'=>$duration->id,'text'=>$duration->week,'priceVal'=>$duration->week,'price'=>$duration->price];
														};
												 echo $this->Form->input('price_master_id',['class'=>'form-control  requiredfield duration select2 ','options' => $options,'label'=>false,'empty'=>'Select Options']);?>
												 <label style="display:none" class="helpblock error" > This field is required.</label>
											</div>
										</div>
										<div class="col-md-6 form-group">
											<p for="from">
												Charges
											</p>
											<div class="input-field">
											<?php echo $this->Form->input('total_charges', ['class'=>'form-control charges','label'=>false,"placeholder"=>"Total Charges",'readonly'=>'readonly','type'=>'text']); ?>
											</div>
										</div>
									</div> 	
								</div> 	
								<div class="row">
									<div class="col-md-12">
										<div class="input-field">
											<div class="margin text-center">
											<center>
											<?php echo $this->Form->button('Submit',['class'=>'btn btn-success btn-submit','value'=>'submit','style'=>'background-color:#1295A2']); ?>
											</center>
											<input type="hidden" name="submitted_from" value="web">
											</div>
										</div>
									</div> 
								</div>							
						</fieldset>
						<input type="hidden" name="user_id" value="<?php echo $user_id;?>">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
	 
    $(document).ready(function () {
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
		
		$(document).on('change','.duration',function()
		{
			var p_type=$(this).val();
			var priceVal=$('.duration option:selected').attr('priceVal');
			var price=$('.duration option:selected').attr('price');
			if(p_type!=''){
				var Result = priceVal.split(" ");
				var weeks=Result[0];
				$('.charges').val(price);
			}
			else{
				$('.charges').val(0);
			}
		});
		
	});		
</script>	
	<script type="text/javascript">		
		 	/* function checkCertificate()
			{
				 var file = document.getElementById("hotelImg");
				var file_name = file.value;
				var extension = file_name.split('.').pop().toLowerCase();
				var size = file.files[0].size;
				var allowedFormats = ["jpeg", "jpg", "png"];

				if (!(allowedFormats.indexOf(extension) > -1)) {
					alert("Enter a jpg/jpeg/pdf/png file");

					document.getElementById("sbmtpromotion").disabled = true;
					return false;
				} else if (((size / 1024) / 1024) > 2) {
					alert("Your file should be less than 2MB");
					return false;
				} else {
					document.getElementById("sbmtpromotion").disabled = false;
				}
			} */
	</script>
