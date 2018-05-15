<?php
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/hotel_promotions/getHotelDetails.json?user_id=".$user_id ."&id=".$id,
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
$hotel_view=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$List=json_decode($response);
	//pr($List); exit;
	$hotelPromotion=$List->getEventPlannersDetails;
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
$pricemasters=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$pricemaster=json_decode($response);
	//pr($pricemaster);exit;
	$pricemasters=$pricemaster->PriceMasters;
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
	color:#96989A !important;
	font-weight:100;
}

.col-md-4{
	color:#676363;
	font-weight:600;
}

a{
	color:#ac85d6;
}
</style>
<div class="row" >
	<div class="col-md-12">
		
	</div>
</div>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
					<div class="box-body">
						<?php 
						foreach($hotelPromotion as $hotelPromotion){
							?>
				<form method="post" class="formsubmit">
				<input type="hidden" name="hotel_id" value="<?php echo $hotelPromotion->id; ?>">
					<div class="row">
						<div class="col-md-12" style="padding-top:5px;">
						<span style="font-size:16px;">	<?php echo $hotelPromotion->hotel_name.' ( <i class="fa fa-star" style="color:#efea65;"></i> '.$hotelPromotion->hotel_rating.' Star Hotel )';?></span>
						</div>
					</div>
					<span class="help-block"></span>
					<div class="row">						
					<div class="col-md-3 rowspace">
					<?= $this->Html->image($hotelPromotion->full_image,['id'=>'myImg','style'=>'width:100%;height:80px;','data-target'=>'#imagemodal'.$hotelPromotion->id,'data-toggle'=>'modal',]) ?>
					<div id="imagemodal<?php echo $hotelPromotion->id;?>" class="modal fade" role="dialog">
					<div class="modal-dialog modal-md">
						<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-body" >
								<button type="button" class="close" data-dismiss="modal" style="padding-right:8px !important;">&times;</button>
								<?= $this->Html->image($hotelPromotion->full_image,['style'=>'width:100%;padding:20px;padding-top:0px!important;']) ?>
								</div>
							</div>
						</div>
					</div>
					<hr></hr>
					<div class="row" style="padding-top:5px;">					
						<table  width="100%" style="text-align:center;" >
								<tr>
								<td width="25%" >
								
									<span><?= $this->Html->image('../images/view.png',['style'=>'height:13px;']) ?>
								 
										<?= h($hotelPromotion->total_views);?></span> 
								</td>
								<td width="25%" >
									<span><?= $this->Html->image('../images/unlike.png',['style'=>'height:13px;']) ?> 
									<?= h($hotelPromotion->total_likes);?></span>
								</td>
								<td width="25%" >
									<span><?= $this->Html->image('../images/unsave.png',['style'=>'height:13px;']) ?> 
									<?= h($hotelPromotion->total_saved);?></span>
								</td>
								<td width="25%" >
									<span><?= $this->Html->image('../images/flag.png',['style'=>'height:13px;']) ?> 
									<?= h($hotelPromotion->total_flagged);?></span>
								</td>
							</tr>
						</table>		 
 
					</div>
						</div>	<span class="help-block"></span>
							<div class="col-md-9">
								<div class="col-md-5">
										<div class="row rowspace">
											<div class="col-md-12"><label>Category: </label>
												<span><?= h($hotelPromotion->hotel_category->name); ?></span>
											</div>
										</div>
										<div class="row rowspace">
											<div class="col-md-12"><label>Cheapest Room: </label>
											<span style="color:#1295AB">&#8377;<?= (h($hotelPromotion->cheap_tariff)) ?></span>
											</div>
										</div>
										<div class="row rowspace">
											<div class="col-md-12"><label>Most Expensive Room: </label>
											<span style="color:#1295AB">&#8377;<?= (h($hotelPromotion->expensive_tariff)) ?></span>
											</div>
										</div>
										<div class="row rowspace">
											<div class="col-md-12">
											<label>Date Posted: </label>
											<span style="black">  <?php echo date('d-M-Y',strtotime($hotelPromotion->created_on)) ; ?></span>
											</div>
										</div> 
								</div>
								<div class="col-md-7">
								<div class="row rowspace">
										<div class="col-md-12 "><label><?= __(' Hotelier') ?>: </label>	
										<span><u>
												<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'adminviewprofile',$hotelPromotion->user_id),1);?>
												<a style="color:#d69d5c;" href="<?php echo $hrefurl; ?>"> 
												<?= h($hotelPromotion->user->first_name.' '.$hotelPromotion->user->last_name);?></u>
												<?php
												if($hotelPromotion->user_rating==0)
												{
													echo "";
												}
												else{
														echo "(".$hotelPromotion->user_rating." <i class='fa fa-star'></i>)";
													}
												?></a>
											</span>
										</div>					
									</div>
									<div class="row rowspace">
										<div class="col-md-12"><label><?= __(' Website') ?>: </label>
										<span ><a style="color:blue;" href="http://<?php echo $hotelPromotion->website; ?>" target="blank"><u><?= h($hotelPromotion->website) ?></u></a> </span>
										</div>
									</div>
									<div class="row rowspace">
										<div class="col-md-12"><label><?= __(' Location') ?>: </label>
										<span ><?= h($hotelPromotion->hotel_location) ?></span>
										</div>
									</div>
									<div class="row rowspace">
										<div class="col-md-12">
										<label>Expiring On: </label>
										<span style="color:#FB6542">  <?php echo date('d-M-Y',strtotime($hotelPromotion->visible_date)) ; ?></span>
										</div>
									</div>
								</div>
									<!-----button list-->
							<div class="row" >
								<div class="col-md-12 text-center" style="padding-top:15px;">
									<button  style="margin-top:5px;" class="btn btn-info btn-md btnlayout" data-target="#contactdetails<?php echo $hotelPromotion->id;?>" data-toggle="modal" type="button">Contact Info</button>&nbsp;&nbsp;
									
									<button  style="margin-top:5px;" type="button" class="btn btn-success btn-md btnlayout" data-target="#renew<?php echo $hotelPromotion->id; ?>" data-toggle=modal>Renew</button>&nbsp;&nbsp;
									<!--<a style="margin-top:5px" href="<?php echo $this->Url->build(["controller" => "HotelPromotions",'action'=>'adminedit/'.$hotelPromotion->id]); ?>" class="btn btn-successto btn-md btnlayout" >Edit Event</a>&nbsp;&nbsp;-->
									<button  style="margin-top:5px;" type="button" class="btn btn-danger btn-md btnlayout" data-target="#remove<?php echo $hotelPromotion->id; ?>" data-toggle=modal>Remove Promotion</button>&nbsp;&nbsp;
								</div>
							</div>
						<span class="help-block"></span>
									<!------Contact Details Modal --------->
									<div id="remove<?php echo $hotelPromotion->id; ?>" class="modal fade" role="dialog">
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
											<button type="submit" name="removepackage"  class="unfollow btn btn-success btn-md" value="yes" name="remove_promotion">Yes</button>
											<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
										</div>
									</div>
									<input type="hidden" name="hotel_id" value="<?php echo $hotelPromotion->id; ?>"/>
								</form>
							</div>
						</div>
						<div id="renew<?php echo $hotelPromotion->id; ?>" class="modal fade" role="dialog">
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
															foreach($pricemasters as $Price)
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
								<input type="hidden" name="hotel_id" value="<?php echo $hotelPromotion->id; ?>">
								</form>
							</div>
						</div>
										<div id="contactdetails<?php echo $hotelPromotion->id;?>" class="modal fade" role="dialog">
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
																			<label>Seller Name: </label>
																			<span style="padding-top:2px;">
																				<u>
																					<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'adminviewprofile',$hotelPromotion->user_id),1);?>
																				<a style="color:#d69d5c;" href="<?php echo $hrefurl; ?>"> 
																					<?= h($hotelPromotion->user->first_name.' '.$hotelPromotion->user->last_name);?></u>
																					<?php
																					if($hotelPromotion->user_rating==0)
																					{
																						echo "";
																					}
																					else{
																							echo "(".$hotelPromotion->user_rating." <i class='fa fa-star'></i>)";
																						}
																					?></a>
																				</span>
																			</div>					
																		</div>					
																		<div class="row rowspace">
																			<div class="col-md-12">
																			<label>Mobile No: </label>
																			<span><?= h($hotelPromotion->user->mobile_number);?></span>
																			</div>
																		</div>
																		<div class="row rowspace">
																			<div class="col-md-12">
																				<label>Email: </label>
																				<span><a href="mailto:<?php echo $hotelPromotion->user->email;?>"><?= h($hotelPromotion->user->email);?></a></span>
																				</div>
																		</div>
																		<span class="help-block"></span>
																	</div>
																	<div class="modal-footer">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
																	</div>
																</div>
															</div>
														</div>
														<!-------Contact Details Modal End--------->	
										</div>
										<!----button list end--->
								</div>
							</form>	
									<?php }?>
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
							
					