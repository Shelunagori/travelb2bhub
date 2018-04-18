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
					<legend style="color:#369FA1;"><b>Load Event Planner Promotion</b></legend>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6 form-group">
									<p for="from">
										Company Name
 									</p>
									<div class="input-field">
										 <?php echo $this->Form->input('company_name',['class'=>'form-control','label'=>false,'autocomplete'=> "off",'placeholder'=>"Company Name",'readonly'=>'readonly','value'=>$user[0]->company_name]);?>
									</div>
								</div>
								<input type="hidden" name="user_id" value="<?php echo $user_id;?>">
								<input type="hidden" name="submitted_from" value="web">
								<div class="col-md-6 form-group ">
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
					<legend style="color:#369FA1;"><b>Promotion Details</b></legend>
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
									<p> Select States of Operation <span class="required">*</span></p>
									<?php 
									$options=array();
									foreach($states as $st)
									{
										$options[] = ['value'=>$st->id,'text'=>$st->state_name];
									};
									echo $this->Form->input('state_id', ['options' => $options,'class'=>'form-control select2 requiredfield state_list','label'=>false,"data-placeholder"=>"Select Options",'multiple'=>true]); ?>
									<label style="display:none" class="helpblock error" > This field is required.</label>									
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
										Choose City
										<span class="required">*</span>
									</p>
									<div class="input-field replacedata">
									</div>
								</div>
								<div class="col-md-6 form-group newlist1" style="display:none;">
									<p> Cities of Operation <span class="required">*</span></p>
									<?php 
									$options=array();
									foreach($city->citystatefi as $cty)
									{
										$options[] = ['value'=>$cty->cityid,'text'=>$cty->name];
									};
									echo $this->Form->input('city_id', ['options' =>$options,'class'=>'form-control select2 requiredfield','label'=>false,"data-placeholder"=>"Select Cities",'multiple'=>true]); ?>
							<label style="display:none" class="helpblock error" > This field is required.</label>									
								</div>
 							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-12">
									<p>Enter Description of Your Company </p>
									<?php echo $this->Form->textarea('event_detail', ['class'=>'form-control','label'=>false,'rows'=>3,'style'=>'resize:none']); ?> 	 
								</div>
							</div>
						</div>
					</fieldset>
					<fieldset>
					<legend style="color:#369FA1;"><b> &nbsp; Payment Period &nbsp;  </b></legend>
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
														echo $this->Form->input('price_master_id',['options'=>$options,'class'=>'form-control priceMasters requiredfield','label'=>false,'empty'=>'Select ...']);?>
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
					<input type="hidden" name="user_id" value="<?php echo $user_id;?>">
				</form>
				<div id="selectbox" style="display:none;"> </div>
			</div>
		</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).ready(function (){
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
				?>');
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
				url: "<?php echo $this->Url->build(["controller" => "EventPlannerPromotions", "action" => "cityStateList"]); ?>",
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
});
</script>
 
