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
?>
<style>
.col-md-4{
	
	color:#838784;
	font-weight:bold;
}
.contact{
	border-radius:20px;
	width:130px;
	text-align:center;
	background-color:#1295A2;
	color:white;
}
.fleet{
	font-size:21px;	
	background-color:white;
	color:#909591;
	border:0px;
}
.unfleet{
	font-size:21px;	
	background-color:white;
	color:#d33c44;
	border:0px;
}
p{
	text-align:center;
	font-size:12px;
}
</style>
<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body"> 
				<form method="post">
					<?php foreach($taxiFleetPromotion as $taxiFleetPromotion):
									$vehicleList='';
									$x=0;
									foreach($taxiFleetPromotion->taxi_fleet_promotion_rows as $vehicle)
										{
											if($x>=1){
												$vehicleList.=' , ';
											}
											$vehicleList.=$vehicle->taxi_fleet_car_bus->name;
											$x++;
										}
									$cityList='';
									$y=0;
									foreach($taxiFleetPromotion->taxi_fleet_promotion_cities as $cities)
										{
											if($y>=1){
												$cityList.=' , ';
											}
											@$cityList.=$cities->city->name;
											$y++;
										}
									$stateList='';
									$z=0;
									foreach($taxiFleetPromotion->taxi_fleet_promotion_states as $states)
										{
											if($z>=1){
												$stateList.=' , ';
											}
											$stateList.=$states->state->state_name;
											$z++;
										}
										?>
										<div class="row">
											<div class="col-md-6">
												<h3><?= h($taxiFleetPromotion->title) ?></h3>
											</div>
											<div class="col-md-6">
												<div class="row pull-right text-center">
													<input type="hidden" name="taxifleet_id" value="<?php echo $taxiFleetPromotion->id; ?>">
														<div class="row col-md-12">
														<div class="col-md-3">
														<i class="fa fa-eye fleet" style="font-size:24px;	"></i>
														<p><?= h($taxiFleetPromotion->total_views);?><br>Views</p>
														<?php 
														//echo $this->Html->link('<i class="fa fa-eye fleet"></i>','/TaxiFleetPromotions/view/'.$taxiFleetPromotion->id,array('escape'=>false,'class'=>'btn btn-primary btn-xs ','style'=>'background-color:white;border:0px;'));?>
														</div>
														<div class="col-md-3">
														<?php
														//pr($taxiFleetPromotion);
															$dataUserId=$taxiFleetPromotion->user_id;
															$isLiked=$taxiFleetPromotion->isLiked;
															$issaved=$taxiFleetPromotion->issaved;
															//-- LIKES DISLIKE
															if($isLiked=='no'){
																echo $this->Form->button('<i class="fa fa-heart-o like fleet" > </i>',['class'=>'btn btn-xs likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
															}
															if($isLiked=='yes'){
																echo $this->Form->button('<i class="fa fa-heart-o like unfleet" > </i>',['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#F7F3F4;border:0px;']);
															}
														?><p><?= h($taxiFleetPromotion->total_likes);?><br>Likes</p>
														</div>
														<div class="col-md-3">
															<?php 
															//-- Save Unsave
															if($issaved=='1'){
																echo $this->Form->button('<i class="fa fa-bookmark-o unfleet"></i>',['class'=>'btn  btn-xs  ','value'=>'button','type'=>'submit','name'=>'savetaxifleet','style'=>'background-color:white;color:black;border:0px;']);
															}
															if($issaved=='0'){
																echo $this->Form->button('<i class="fa fa-bookmark-o fleet"></i>',['class'=>'btn btn-primary btn-xs ','value'=>'button','style'=>'background-color:white;color:black;border:0px;','type'=>'submit','name'=>'savetaxifleet']);
															}
															?>
														</div>
														<div class="col-md-3">
														<?php echo $this->Html->link('<i class="fa fa-flag-o fleet"></i>','#'.$taxiFleetPromotion->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#reportmodal'.$taxiFleetPromotion->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
													
														</div>
											</div>
										</div>
												<!-------Report Modal Start--------->
												<div id="reportmodal<?php echo $taxiFleetPromotion->id;?>" class="modal fade" role="dialog">
													<div class="modal-dialog modal-md">
														<!-- Modal content-->
															<div class="modal-content">
															  <div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h3 class="modal-title">Report</h3>
															  </div>
																<div class="modal-body" >
																<span class="help-block"></span>
																	<div class="row">
																		<div class="col-md-12">
																			<div class="col-md-3">
																				<label>
																					Select Reason
																				</label>
																			</div>
																			<div class="col-md-9">
																				<div class="input-field reason_list">
																					<?php 
																						$options=array();
																						foreach($reasonslist as $sts)
																						{
																							$options[] = ['value'=>$sts->id,'text'=>$sts->reason];
																						};
																						echo $this->Form->control('report_reason_id', ['label'=>false, "type"=>"select",'options' =>$options, "class"=>"form-control select2 reason_box","data-placeholder"=>"Select... ","style"=>"height:125px;",'empty'=>"Select..."]);
																					?>
																				</div>
																			</div>
																		</div>
																	</div><br>
																	<div class="row report_text"  style="display:none;">
																		<div class="col-md-12">
																			<div class="col-md-3">
																			</div>
																			<div class="col-md-9">
																				<div >
																				<textarea class="form-control " rows="3" type="text" placeholder="Enter Your Reason..." name="comment"></textarea>	
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="modal-footer" style="height:60px;">
																	<input type="submit" class="btn btn-primary btn-md" name="report_submit" value="Report">
																	<button type="button" class="btn btn-danger btn-md " data-dismiss="modal">Cancle</button>
																</div>
															</div>
														</div>
													</div>
											
											<!-------Report Modal End--------->	
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-6">
												<?= $this->Html->image($taxiFleetPromotion->full_image,['style'=>'width:100%;height:300px;']) ?>
											</div>
										<div class="col-md-6">
										<fieldset>
											<div class="row col-md-12">
												<div class="col-md-4">Seller Name </div><div class="col-md-1">:</div>		
													<div class="col-md-7">
													<label>
													
													<?= h($taxiFleetPromotion->user->first_name.' '.$taxiFleetPromotion->user->last_name);?>
												
														<?php
															if($taxiFleetPromotion->user_rating==0)
															{
																echo "";
															}
															else{
																echo "( ";
																for($i=0;$i<$taxiFleetPromotion->user_rating;$i++)
																{
																	echo "<i class='fa fa-star' style='font-size:10px;color:#959191;'></i>";
																	if($i==0)
																	{
																		echo "";
																	}
																}
																echo " )";
																}
															?>
													</label>
												</div>					
											</div>
											<div class="row col-md-12">
												<div class="col-md-4"><?= __('Vehicle Type') ?></div><div class="col-md-1">:</div>		
												<div class="col-md-7"><label><?= h($vehicleList);?></label>
											</div>
											</div>
											<div class="row col-md-12">
												<div class="col-md-4"><?= __('Duration') ?></div><div class="col-md-1">:</div>		
												<div class="col-md-7"><label style="color:#FB6542"><?= h($taxiFleetPromotion->price_master->week);?></label>
												</div>
											</div>
											<div class="row col-md-12">
												<div class="col-md-4"><?= __('Total Charges') ?></div><div class="col-md-1">:</div>		
												<div class="col-md-7"><label  style="color:#1295A2"><?= h($taxiFleetPromotion->price_master->price);?> &#8377;</label>
												</div>
											</div>
											<div class="row col-md-12">
												<div class="col-md-4"><?= __('Visible Date') ?></div><div class="col-md-1">:</div>		
												<div class="col-md-7"><label ><?= date('d-M-Y',strtotime($taxiFleetPromotion->visible_date)); ?></label>
												</div>
											</div>
											<div class="row col-md-12">
												<div class="col-md-4"><?= __('Cities of Operation') ?></div><div class="col-md-1">:</div>		
												<div class="col-md-7"><label ><?= h($cityList); ?></label>
												</div>
											</div>
											<div class="row col-md-12">
												<div class="col-md-4"><?= __('States') ?></div><div class="col-md-1">:</div>		
												<div class="col-md-7"><label ><?= h($stateList); ?> </label>
												</div>
											</div>
											<div class="row col-md-12">
												<div class="col-md-4"><?= __('Country') ?></div><div class="col-md-1">:</div>		
												<div class="col-md-7"><label ><?= h($taxiFleetPromotion->country->country_name); ?> </label>
												</div>
											</div><br>
											<div class="row col-md-12 text-center">
											<?php
											echo $this->Html->link('<b>Contact Info</b>','address'.$taxiFleetPromotion->id,array('escape'=>false,'class'=>'btn  btn-md contact','data-target'=>'#deletemodal'.$taxiFleetPromotion->id,'data-toggle'=>'modal'));?>
											</div>
												<!-------Contact Details Modal --------->
												<div id="deletemodal<?php echo $taxiFleetPromotion->id;?>" class="modal fade" role="dialog">
													<div class="modal-dialog" style="width:30%">
														<!-- Modal content-->
															<div class="modal-content">
															  <div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title">
																	Seller Details
																	</h4>
																	</div>
																	<div class="modal-body" style="height:100px;">
																	<span class="help-block"></span>
																		<div class="row col-md-12">
																			<div class="col-md-4">Seller Name </div><div class="col-md-1">:</div>		
																			<div class="col-md-7">
																				<label>
																				
																					<?= h($taxiFleetPromotion->user->first_name.' '.$taxiFleetPromotion->user->last_name);?>
																			
																					<?php
																					if($taxiFleetPromotion->user_rating==0)
																					{
																						echo "";
																					}
																					else{
																						echo "( ";
																						for($i=0;$i<$taxiFleetPromotion->user_rating;$i++)
																						{
																							echo "<i class='fa fa-star' style='font-size:10px;color:#959191;'></i>";
																							if($i==0)
																							{
																								echo "";
																							}
																						}
																						echo " )";
																						}
																					?>
																				</label>
																			</div>					
																		</div>
																		<div class="row col-md-12">
																			<div class="col-md-4">Mobile No </div>
																			<div class="col-md-1">:	</div>
																			<div class="col-md-7">
																			<label><?= h($taxiFleetPromotion->user->mobile_number);?></label>
																			</div>
																		</div>
																		<div class="row col-md-12">
																			<div class="col-md-4">Email</div>
																			<div class="col-md-1">:	</div>
																			<div class="col-md-7">
																			<label><?= h($taxiFleetPromotion->user->email);?></label>
																			</div>
																		</div>
																	</div>
																	<div class="modal-footer" style="height:60px;">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancle</button>
																</div>
																</div>
															</div>
														</div>
											<!-------Contact Details Modal End--------->	
												</fieldset>
											</div>
										</div>
									</div><span class="help-block"></span>
								<div class="row">
									<div class="col-md-12">
											<label><b><?= __('Fleet Details') ?></b></label>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?= (h($taxiFleetPromotion->fleet_detail)); ?>
									</div>
								</div>
								</form>
							</div>
						</div>
					</fieldset>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endforeach; ?>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>	 
  $(document).ready(function(){
	  $('.reason_box').on('change', function() {
		  //var b=$(this);
		  var a=$(this).closest("div").find(" option:selected").val();
			if(a == '5')
			  {
				$(".report_text").show();
			  }
			  else
			  {
				$(".report_text").hide();
			  }
		});
  });
</script>
   
