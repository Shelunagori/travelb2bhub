<?php
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/TaxiFleetPromotions/getTaxiFleetPromotionsDetails.json?user_id=".$user_id ."&id=".$id,
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
$taxifleet_view=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$List=json_decode($response);
	//pr($List); exit;
	$taxiFleetPromotion=$List->getTaxiFleetPromotionsDetails;
	//pr($hotelPromotion);exit;
}
/// -- REPORT REASON
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/ReportReasons/reportReasonList.json?promotion_type_id=1",
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
	$List=json_decode($response);
	$reasonslist=$List->reasonslist;
}
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

?>
<style>
fieldset{
	margin-bottom:5px !important;
	border-radius: 6px;
}
.modal-title{
font-size:20px;	
}

.row{
	line-height:15.0px;
}
.btnlayout{
	border-radius:15px !important;
	}
#myImg:hover {opacity: 0.7;}
.bbb{
	padding:0px!important;
	pading-bottom:10px!important;
}
.rowspace{
	padding-top:5px;
	font-size:14px;
}
.rowspacemodal{
	padding:10px;
	font-size:14px;
}
hr{
	margin-top: 15px !important;
    margin-bottom: 4px !important;
}
label{
	color:#96989A !important;;
	font-weight: 100;
}
.contact{
	border-radius:20px;
	width:130px;
	text-align:center;
	background-color:#1295A2;
	color:white;
}
a{
	color:#ac85d6;
}
</style>
<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body"> 
					<?php foreach($taxiFleetPromotion as $taxiFleetPromotion):
									$vehicleList='';
									$x=0;
									foreach($taxiFleetPromotion->taxi_fleet_promotion_rows as $vehicle)
										{
											if($x>=1){
												$vehicleList.=', ';
											}
											$vehicleList.=$vehicle->taxi_fleet_car_bus->name;
											$x++;
										}
									$cityList='';
									$y=0;
									foreach($taxiFleetPromotion->taxi_fleet_promotion_cities as $cities)
										{
											if($y>=1){
												$cityList.=', ';
											}
											@$cityList.=$cities->city->name;
											$y++;
										}
									$stateList='';
									$z=0;
									foreach($taxiFleetPromotion->taxi_fleet_promotion_states as $states)
										{
											if($z>=1){
												$stateList.=', ';
											}
											$stateList.=$states->state->state_name;
											$z++;
										}
										?>
				<form method="post" class="formSubmit">
							<div class="row" style="padding-top:5px;">
								<div class="col-md-12" >
									<span style="font-size:18px;"><?= h($taxiFleetPromotion->title) ?></span>
								</div>
							</div>
							<span class="help-block"></span>	
							<div class="row">
							<div class="col-md-12">
							<div class="col-md-3">
					<?= $this->Html->image($taxiFleetPromotion->full_image,['id'=>'myImg','style'=>'width:100%;height:80px;','data-target'=>'#imagemodal'.$taxiFleetPromotion->id,'data-toggle'=>'modal',]) ?>
					<div id="imagemodal<?php echo $taxiFleetPromotion->id;?>" class="modal fade" role="dialog">
					<div class="modal-dialog modal-md">
						<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-body" >
								<button type="button" class="close" data-dismiss="modal" style="padding-right:8px !important;">&times;</button>
								<?= $this->Html->image($taxiFleetPromotion->full_image,['style'=>'width:100%;padding:20px;padding-top:0px!important;']) ?>
								</div>
							</div>
						</div>
					</div>
					<hr></hr>
					<div class="row" style="padding-top:5px;">					
						<input type="hidden" name="taxifleet_id" value="<?php echo $taxiFleetPromotion->id; ?>">
							<table  width="100%" style="text-align:center;" >
								<tr>
									<td width="25%" >
										<span><?= $this->Html->image('../images/view.png',['style'=>'height:13px;']) ?>
											<?= h($taxiFleetPromotion->total_views);?></span> 
									</td>
									<td width="25%" >
										<span><?= $this->Html->image('../images/unlike.png',['style'=>'height:13px;']) ?> 
										<?= h($taxiFleetPromotion->total_likes);?></span>
									</td>
									<td width="25%" >
										<span><?= $this->Html->image('../images/unsave.png',['style'=>'height:13px;']) ?> 
										<?= h($taxiFleetPromotion->total_saved);?></span>
									</td>
									<td width="25%" >
										<span><?= $this->Html->image('../images/flag.png',['style'=>'height:13px;']) ?> 
										<?= h($taxiFleetPromotion->total_flagged);?></span>
									</td>
								</tr>
							</table> 
						</div>
					</div>
					<div class="col-md-9">
								<div class="row col-md-12" style="padding-top:8px;">
									<div class="col-md-12"><span style="color:#96989A;font-weight:100;">Category: </span>
										<?= h($vehicleList); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row rowspace">
										<div class="col-md-12"><span style="color:#96989A;font-weight:100;"><?= __(' Cities of Operation') ?>: </span>
										<span><?= h($cityList); ?></span>
										</div>
									</div>
									<div class="row rowspace">
										<div class="col-md-12"><span style="color:#96989A;font-weight:100;"><?= __(' States of Operation') ?>: </span>
										<span ><?= h($stateList); ?> </span>
										</div>
									</div>
									<div class="row rowspace">
										<div class="col-md-12 ">
										<label>Date Posted: </label>
										<span style="color:#black">  <?php echo date('d-M-Y',strtotime($taxiFleetPromotion->created_on)) ; ?></span>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row rowspace">
										<div class="col-md-12"><span style="color:#96989A;font-weight:100;"><?= __(' Country') ?>: </span>
										<span ><?= h($taxiFleetPromotion->country->country_name); ?> </span>
										</div>
									</div>
									<div class="row rowspace">
										<div class="col-md-12 "><span style="color:#96989A;font-weight:100;"><?= __(' Seller') ?>: </span>	
										<span><u>
											<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'adminviewprofile',$taxiFleetPromotion->user_id),1);?>
											<a style="color:#d69d5c" href="<?php echo $hrefurl; ?>"> 
											<?= h($taxiFleetPromotion->user->first_name.' '.$taxiFleetPromotion->user->last_name);?></u>
											<?php
											if($taxiFleetPromotion->user_rating==0)
											{
												echo "";
											}
											else{
													echo "(".$taxiFleetPromotion->user_rating." <i class='fa fa-star'></i>)";
												}
											?></a>
										</span>
										</div>					
									</div>
									<div class="row rowspace">
											<div class="col-md-12">
											<label>Expiring On: </label>
											<span style="color:#FB6542"> <?php echo date('d-M-Y',strtotime($taxiFleetPromotion->visible_date)) ; ?></span>
											</div>
										</div> 
									<!-----button list-->
							<div class="row" style="padding-top:15px;">
								
							<div id="renew<?php echo $taxiFleetPromotion->id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md" >
								<!-- Modal content-->
								<form method="post" class="formSubmit">
									<div class="modal-content">
									  <div class="modal-header" >
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">
											Do you want to renew promotion ?
											</h4>
										</div>
										<div class="modal-body">
											<div class="row mainrow">
												<div class="col-md-12">
													<div class="col-md-6">
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
													<div class="col-md-6">
														<p for="from">
																	Promotion Amount
																	<span class="required">*</span>
														</p>
														<div class="input-field">
														<?php echo $this->Form->input('payment_amount', ['class'=>'form-control payment_amount','label'=>false,"placeholder"=>"Payment Amount",'readonly'=>'readonly','type'=>'text']);?> 
														</div>
													</div>
												</div>
												<input type="hidden" name="visible_date" class="visible_date" value="">
											</div>
										</div>
										<div class="modal-footer" style="height:60px;">
											<button type="submit"  name="pay_now" class=" btn btn-success btn-md" value="yes" >Pay Now</button>
											<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
										</div>
									</div>
								<input type="hidden" name="texifleet_id" value="<?php echo $taxiFleetPromotion->id; ?>">
								</form>
							</div>
						</div>
						<!------------------------- Remove Modal--------------------------->
						<div id="remove<?php echo $taxiFleetPromotion->id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md" >
								<!-- Modal content-->
								<form method="post" class="formSubmit">
									<div class="modal-content">
									  <div class="modal-header" style="height:100px;">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">
											Are you sure you want to delete this Promotion?
											</h4>
										</div>
										<div class="modal-footer" style="height:60px;">
											<button type="submit" class=" btn btn-success btn-md" value="yes" name="remove_promotion">Yes</button>
											<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
										</div>
									</div>
									<input type="hidden" name="remove_package_id" value="<?php echo $taxiFleetPromotion->id; ?>"/>
								</form>
							</div>
						</div>
											</div><span class="help-block"></span>
											<!-------Contact Details Modal --------->
												<div id="contactdetails<?php echo $taxiFleetPromotion->id;?>" class="modal fade" role="dialog">
													<div class="modal-dialog modal-sm" >
														<!-- Modal content-->
															<div class="modal-content">
															  <div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<span class="modal-title">
																	Seller Details
																	</span>
																	</div>
																	<div class="modal-body" style="padding-left:15px!important;">
																		<div class="row rowspace">
																		<div class="col-md-12">
																			<label>
																			Seller Name: </label>
																				<span><u>
																				<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'adminviewprofile',$taxiFleetPromotion->user_id),1);?>
																				<a style="color:#d69d5c" href="<?php echo $hrefurl; ?>">
																				<?= h($taxiFleetPromotion->user->first_name.' '.$taxiFleetPromotion->user->last_name);?></u>
																				<?php
																				if($taxiFleetPromotion->user_rating==0)
																				{
																					echo "";
																				}
																				else{
																						echo "(".$taxiFleetPromotion->user_rating." <i class='fa fa-star'></i>)";
																					}
																				?></a>
																			</span>
																			</div>					
																		</div>
																		<div class="row rowspace">
																			<div class="col-md-12">
																			<label>Mobile No: </label>
																			<span><?= h($taxiFleetPromotion->user->mobile_number);?></span>
																			</div>
																		</div>
																		<div class="row rowspace">
																			<div class="col-md-12">
																				<label>Email: </label>
																				<span><u><a href="mailto:<?php echo $taxiFleetPromotion->user->email;?>"><?= h($taxiFleetPromotion->user->email);?></a></u></span>
																				</div>
																			</div>
																	</div>
																	<div class="modal-footer">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
																	</div>
																</div>
															</div>
														</div>
														<!-------Contact Details Modal End--------->	
										</div>
									<div class="col-md-12 text-center">
									<?php
										echo $this->Html->link('Contact Info','address'.$taxiFleetPromotion->id,array('escape'=>false,'class'=>'btn  btn-warning btn-md contact','data-target'=>'#contactdetails'.$taxiFleetPromotion->id,'data-toggle'=>'modal'));?>
										
										<button type="button" class="btn btn-info btn-md btnlayout" data-target="#renew<?php echo $taxiFleetPromotion->id; ?>" data-toggle=modal>Renew </button>
									 
										<button type="button" class="btn btn-danger btn-md btnlayout" data-target="#remove<?php echo $taxiFleetPromotion->id; ?>" data-toggle=modal>Remove Promotion</button>
								</div>
										<!----button list end--->
								</div>
							</div>
						</div>
						<hr></hr>	<span class="help-block"></span>					
						<div class="row">
						<div class="col-md-12">
								<span style="color:#96989A;font-weight:100;"><?= __('Fleet Details') ?></span>
						</div>
					</div>
					<div class="row" style="padding-top:2px;">
						<div class="col-md-12">
							<?= (h($taxiFleetPromotion->fleet_detail)); ?>
						</div>
					</div>
					</div>
					</form>
					<?php endforeach; ?>
				</div>
			</div>
	</div>
</div>
</div>
</div>
<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
<div id="loader"></div></div>
</section>

<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
    $(document).ready(function () {
		$(document).on('change','.priceMasters',function()
		{
			var ab=$(this).closest('div').find('.priceMasters option:selected').val();
			//alert(ab);
			if(ab!=0)
			{
			var priceVal=$(this).closest('div').find('.priceMasters option:selected').attr('priceVal');
			var price=$(this).closest('div').find('.priceMasters option:selected').attr('price');
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
			$(this).closest('div.mainrow').find('.visible_date').val(date);
			$(this).closest('div.mainrow').find('.payment_amount').val(price);
			//alert($(this).closest('div.mainrow').html());
			}
			else{
				$(this).closest('div.mainrow').find('.visible_date').val("dd-mm-yyyy");
				$(this).closest('div.mainrow').find('.payment_amount').val(0);
			}
		});
		jQuery(".formSubmit").submit(function(){
				jQuery("#loader-1").show();
			});
		});
</script>
   
