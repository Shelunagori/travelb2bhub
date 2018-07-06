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
										<legend style="color:#369FA1;"><b><?= __('Load Taxi/Fleet Promotion') ?></b></legend> 
								<div class="row">
									<div class="col-md-12">
										<div class="col-lg-4 col-md-4 col-sm-4  mt form-group">
											<p for="from">
												Your Company Name
												<span class="required">*</span>
											</p>
											<div class="input-field">
												 <?php
												 echo $this->Form->input('company_name',['class'=>'form-control requiredfield','label'=>false,'autocomplete'=> "off",'placeholder'=>"Company Name",'readonly'=>'readonly','value'=>$user[0]->company_name]);?>
												<label style="display:none;" class="helpblock error" > This field is required.</label>
											</div>
										</div>
										<div class="col-md-4 form-group">
											<p for="from">
												Enter Promotion Title
												<span class="required">*</span>
											</p>
											<div class="input-field">
												 <?php echo $this->Form->input('title',['class'=>'form-control requiredfield','label'=>false,'placeholder'=>"Enter Promotion Title"]);?>
												 <label style="display:none;margin-top:-20px;" class="helpblock error" > This field is required.</label>
											</div>
										</div>
										<input type="hidden" name="user_id" value="<?php echo $user_id;?>">
										<input type="hidden" name="submitted_from" value="web">
										<div class="col-md-4 form-group">
											<p for="from">
												Upload Image of Promotion
												<span class="required">*</span>
											</p>
											<div class="input-field">
												<?php  echo $this->Form->input('image',['class'=>'form-control requiredfield','label'=>false,'type'=>'file','onchange'=>'checkCertificate()','id'=>'hotelImg']); ?>
												<label style="display:none" class="helpblock error" > This field is required.</label>
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
										echo $this->Form->input('country_id',["class"=>"form-control requiredfield" ,'options' => $options,'label'=>false]);?>
										<label style="display:none" class="helpblock error" > This field is required.</label>
									</div>
								</div>
								<div class="col-md-6 form-group">
									<p for="from">
												Select States of Operation
												<span class="required">*</span>
									</p>
									
									<div class="input-field">
								
										<?php 
										$options=array();
										foreach($states as $st)
										{
											$options[] = ['value'=>$st->id,'text'=>$st->state_name];
										};
										echo $this->Form->control('state_id', ['label'=>false,"id"=>"multi_states", "type"=>"select",'options' =>$options, "multiple"=>true , "class"=>"form-control select2 requiredfield state_list","data-placeholder"=>"Select Options","style"=>"height:125px;"]);?>
										<label style="display:none" class="helpblock error" > This field is required.</label>
										
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
										  <input class="city_type" type="radio" name="package_type" value="0" checked="checked"/>All Cities
										</label>
										<label class="radio-inline">
										  <input class="city_type" type="radio" name="package_type" value="1"/>Specific Cities
										</label>
									</div>
								</div>
								<div class="col-md-6  form-group" >
									<p for="from" id="newlist" style="display:none;">
										Select Cities of Operation
										<span class="required">*</span>
									</p>
									<div class="input-field replacedata">
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
											echo $this->Form->control('vehicle_type', ['label'=>false,"id"=>"multi_vehicle", "type"=>"select",'options' =>$options, "multiple"=>true , "class"=>"form-control select2 requiredfield","data-placeholder"=>"Select Options ","style"=>"height:125px;"]);?>
											<label style="display:none" class="helpblock error" > This field is required.</label>
										</div>
									</div>
								</div>  
								</div>  
								<div class="row">
									<div class="col-md-12 ">
									<div class="col-md-12 form-group">
										<p for="from">
											Fleet Description <span class="required">*</span>
											
										</p>
										<div class="input-field">
											<?php echo $this->Form->input('fleet_detail',['class'=>'form-control requiredfield','label'=>false,'rows'=>'2']);?>
											<label style="display:none" class="helpblock error" > This field is required.</label>
										</div>
									</div>
									</div>
								</div>
							</fieldset> 
								<fieldset>
									<legend style="color:#369FA1;"><b><?= __('Promotion Period ') ?></b></legend> 
										<div class="row">
											<div class="col-md-12">
												<div class="col-md-6 form-group">
													<p for="from">
													Select Duration of Promotion <span class="required">*</span>
													</p>
													<div class="input-field">
															 
													<?php				 
														$options=array();
														foreach($priceMasters as $Price)
														{
														 
															$options[] = ['value'=>$Price->id,'text'=>$Price->week,'priceVal'=>$Price->week,'price'=>$Price->price];
														};
														echo $this->Form->input('price_master_id',['options'=>$options,'class'=>'form-control priceMasters requiredfield select2','label'=>false,'empty'=>'Select ...']);?>
														<?php // echo $this->Form->input('duration', ['options' => $priceMasters,'class'=>'form-control','label'=>false]); ?>
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
						<input type="hidden" name="visible_date" class="visible_date" value="">
				</form>
			</div>
			<div id="selectbox" style="display:none;"> </div>
		</div>
	</div>
<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
	<div id="loader"></div>
</div>
 <?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
 <?php echo $this->Html->script(['jquery.validate']);?>	
<script>
	 
    $(document).ready(function ()
	{
		$('form').submit(function () {
			var x=0;
			$( ".requiredfield" ).each(function() {
				if($(this).val()!=''){ 
 					$(this).closest('div.form-group').find('.helpblock').hide();
				}
  				if($(this).val()==''){ 
 					$(this).closest('div.form-group').find('.helpblock').show();
					x = 1;
 				}
				if($(this).val()==null){
 					$(this).closest('div.form-group').find('.helpblock').show();
					x = 1;
				}
 			});
			
			if(x==1){
				$('html, body').animate({scrollTop:0}, 'slow');
				return false;
			}
			$("#loader-1").show();
		});
		
		$(document).on('change','.priceMasters',function()
		{
			var blank=$(this).val();
			var priceVal=$('.priceMasters option:selected').attr('priceVal');
			var price=$('.priceMasters option:selected').attr('price');
			if(blank!=''){
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
			}
			else{
				$('.payment_amount').val(0);
			}
		});
		$("#newlist").show();
		$(".replacedata").html('<?php $options=array();
				$options[] = ['value'=>'0','text'=>'All Cities','selected'];
				echo $this->Form->input('city_id',["class"=>"form-control city_id requiredfield","multiple"=>true ,'options' => $options,'label'=>false]);
				?><label style="display:none" class="helpblock error" > This field is required.</label>');
		$('.city_id').select2();
		$(document).on('change','.city_type',function()
		{
			var city_type=$(this).val();
			var selectbox=$('#selectbox').html();
			if(city_type==1){
				$("#newlist").show();
				$(".replacedata").html(selectbox);
			}
			else{
				$("#newlist").show();
				$(".replacedata").html('<?php $options=array();
				$options[] = ['value'=>'0','text'=>'All Cities','selected'];
				echo $this->Form->input('city_id',["class"=>"form-control city_id requiredfield","multiple"=>true ,'options' => $options,'label'=>false]);
				?><label style="display:none" class="helpblock error" > This field is required.</label>');
			}
			$(this).closest('form').find('.city_id').select2();
		});
		$(document).on('change','.state_list',function()
		{
			var state_id=$(this).val();
			var m_data = new FormData();
			var cur_obj = $(this);
			m_data.append('state_id',state_id);			
			$.ajax({
				url: "<?php echo $this->Url->build(["controller" => "TaxiFleetPromotions", "action" => "cityStateList"]); ?>",
				data: m_data,
				processData: false,
				contentType: false,
				type: 'POST',
				dataType:'text',
				success: function(data)
				{
					if($("input[name='package_type']:checked").val()==1){
						$(".replacedata").html(data);
						$('#selectbox').html(data);
					}
					else{
						$('#selectbox').html(data);
					}
					cur_obj.closest('form').find('.city_id').select2();
				}
			});
		});
$("#multi_city").multiselect();
$("#multi_states").multiselect();
$("#multi_vehicle").multiselect();
	});
</script>
<script type="text/javascript">
    function checkCertificate() {
        var fuData = document.getElementById('hotelImg');
        var FileUploadPath = fuData.value;
        if (FileUploadPath == '') {
            alert("Please upload an image");
        } else {
            var Extension = FileUploadPath.substring(
                    FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
			if ( Extension == "png" ||  Extension == "jpeg" || Extension == "jpg") {

                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(fuData.files[0]);
                }

            } 
		else {
                alert("Photo only allows file types of PNG, JPG and JPEG.");
				$("#hotelImg").val('');
            }
        }
    }
</script>