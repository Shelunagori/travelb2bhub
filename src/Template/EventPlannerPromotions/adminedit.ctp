<?php
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
		<div class="row equal_column"  style="background-color:">
				<div class="col-md-12"> 
					<?php echo  $this->Flash->render() ?>
				</div>
				<?= $this->Form->create($eventPlannerPromotion,['type'=>'file','id'=>'TaxtEDIT']); 
 				$cityList=array();
				foreach($eventPlannerPromotion->event_planner_promotion_cities as $cities)
				{ 
					
					if($cities->city_id==0){}
					else{
						@$cityList[]=$cities->city_id;
					}
				}
				
				$stateList=array();
				foreach($eventPlannerPromotion->event_planner_promotion_states as $states)
				{
					$stateList[]=$states->state_id;
				}
				 
				 
				$stateList=array_unique($stateList);
				$cityList=array_unique($cityList);
				$cityListsAry=implode(',',array_unique($cityList));
				$stateListAry=implode(',',array_unique($stateList));
				?>
				
				<form method="post" enctype="multipart/form-data">	
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
										 <?php echo $this->Form->input('company_name',['class'=>'form-control','label'=>false,'autocomplete'=> "off",'placeholder'=>"Company Name",'readonly'=>'readonly','value'=>$eventPlannerPromotion->user->company_name]);?>
									</div>
								</div>
								<input type="hidden" name="user_id" value="<?php echo $eventPlannerPromotion->user->id;?>"> 
								<input type="hidden" name="id" value="<?php echo $eventPlannerPromotion->id;?>"> 
								<div class="col-md-6 form-group ">
									<p for="from">
										Upload Image of Promotion
										<span class="required">*</span>
									</p>
									<div class="input-field">
										<?php  echo $this->Form->input('image',['class'=>'form-control ','label'=>false,'type'=>'file','onchange'=>'checkCertificate()','id'=>'hotelImg']); ?>
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
									</p>
									<div class="input-field">
									 <?php $options=array();
										$options[] = ['value'=>'101','text'=>'India'];
										echo $this->Form->input('country_id',["class"=>"form-control " ,'options' => $options,'label'=>false]);?>
									</div>
								</div>
								<div class="col-md-6 form-group">
									<p> Select States of Operation <span class="required">*</span></p>
									<?php 
									 
									$options=array();
									foreach($allstateslistsss as $st)
									{
										if(in_array($st->id,$stateList)){
											$options[] = ['value'=>$st->id,'text'=>$st->state_name,'selected'];
											 
										}
										else{
											$options[] = ['value'=>$st->id,'text'=>$st->state_name];
										}
									}
									echo $this->Form->input('state_id', ['options' => $options,'class'=>'form-control select2 requiredfield state_list','label'=>false,"data-placeholder"=>"Select Options",'multiple'=>true,'required']); ?>
									<label style="display:none" id="state-id-error" for="state-id" class="helpblock error" > This field is required.</label>									
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
										  <input class="city_type" type="radio" name="package_type" value="0" <?php if(empty($cityList)){?> checked="checked" <?php } ?>/>All Cities
										</label>
										<label class="radio-inline">
										  <input class="city_type" type="radio" name="package_type" <?php if(!empty($cityList)){?> checked="checked" <?php } ?> value="1"/>Specific Cities
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
 							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-12 form-group">
									<p>Enter Description of Your Company </p>
									<?php echo $this->Form->textarea('event_detail', ['class'=>'form-control requiredfield','label'=>false,'rows'=>3,'style'=>'resize:none','required']); ?> 	 
									<label style="display:none" class="helpblock error" > This field is required.</label>
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
														echo $this->Form->input('price_master_id',['options'=>$options,'class'=>'form-control priceMasters requiredfield select2','label'=>false,'empty'=>'Select ...' ,'required']);?>
														<?php // echo $this->Form->input('duration', ['options' => $priceMasters,'class'=>'form-control','label'=>false]); ?>
														<label id="price-master-id-error" for="price-master-id" style="display:none" class="helpblock error" > This field is required.</label>
													</div>
												</div>
												<div class="col-md-6 form-group">
													<p for="from">
																Promotion Amount
																
													</p>
													<div class="input-field">
													<?php echo $this->Form->input('payment_amount', ['class'=>'form-control payment_amount','label'=>false,"placeholder"=>"Payment Amount",'readonly'=>'readonly','type'=>'text','value'=>$eventPlannerPromotion->price]);?> 
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
					<input type="hidden" name="visible_date" class="visible_date" value="<?php echo $eventPlannerPromotion->visible_date;?>">
					<input type="hidden" name="submitted_from" class="" value="web">
				<?= $this->Form->end() ?>
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
 
	var state_id='<?php echo $stateListAry;?>';
	var Cty_id='<?php echo $cityListsAry;?>';
	
	var m_data = new FormData();
	var cur_obj = $(this);
	m_data.append('state_id',state_id);			
	m_data.append('Cty_id',Cty_id);			
	$.ajax({
		url: "<?php echo $this->Url->build(["controller" => "EventPlannerPromotions", "action" => "cityStateListEdit"]); ?>",
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
			$('.city_id').select2();
			cur_obj.closest('form').find('.city_id').select2();
		}
	});
 });
</script>
<script>
$(document).ready(function (){
	/* 	$('form').submit(function () {
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
		}); */
		
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
			echo $this->Form->input('city_id',["class"=>"form-control city_id ","multiple"=>true ,'options' => $options,'label'=>false,'required']);
			?>');
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
 <script type="text/javascript">
    function checkCertificate() {
        var fuData = document.getElementById('hotelImg');
        var FileUploadPath = fuData.value;

//To check if user upload any file
        if (FileUploadPath == '') {
            alert("Please upload an image");

        } else {
            var Extension = FileUploadPath.substring(
                    FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
		//The file uploaded is an image
		if (Extension == "png" || Extension == "jpeg" || Extension == "jpg") {

		// To Display
                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(fuData.files[0]);
                }

            } 
//The file upload is NOT an image
		else {
                alert("Photo only allows file types of PNG, JPG and JPEG.");
				$("#hotelImg").val('');
            }
        }
    }
</script>
<?php echo $this->Html->script(['jquery.validate']);?>
<script>
$('#TaxtEDIT').validate({
	rules: {
		"image" : {
			required : false,
		}
	}, 
	submitHandler: function (form) {
		$("#loader-1").show();
		form[0].submit(); 
	}
});
</script>
