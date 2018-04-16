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
	color:#676363;
	font-weight:600
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
				<form method="post" class="formSubmit">
							<div class="row">
								<div class="col-md-12">
									<h3><?= h($taxiFleetPromotion->title) ?></h3>
								</div>
							<div class="row">
							<div class="col-md-12">
							<div class="col-md-3">
					<?= $this->Html->image($taxiFleetPromotion->full_image,['id'=>'myImg','style'=>'width:100%;height:80px;','data-target'=>'#imagemodal'.$taxiFleetPromotion->id,'data-toggle'=>'modal',]) ?>
					<div id="imagemodal<?php echo $taxiFleetPromotion->id;?>" class="modal fade" role="dialog">
					<div class="modal-dialog modal-md">
						<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-body" >
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<?= $this->Html->image($taxiFleetPromotion->full_image,['style'=>'width:100%;height:300px;padding:20px;padding-top:0px!important;']) ?>
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
								<td width="25%">
									<span>
									<span ><?php
										//
											$dataUserId=$taxiFleetPromotion->user_id;
											$isLiked=$taxiFleetPromotion->isLiked;
											$issaved=$taxiFleetPromotion->issaved;
											//-- LIKES DISLIKE
											if($isLiked=='no'){
												echo $this->Form->button($this->Html->image('../images/unlike.png',['style'=>'height:15px;']),['class'=>'btn btn-xs likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
											}
											if($isLiked=='yes'){
												echo $this->Form->button($this->Html->image('../images/like.png',['style'=>'height:15px;']),['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#000;border:0px;']);
											}
										?>
										<?= h($taxiFleetPromotion->total_likes);?></span>
								</td>
								<td width="25%">
										<?php 
											//-- Save Unsave
											if($issaved=='1'){
												echo $this->Form->button($this->Html->image('../images/save.png',['style'=>'height:15px;']),['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>' savetaxifleet','style'=>'background-color:white;color:#000;border:0px;']);
											}
											if($issaved=='0'){
												echo $this->Form->button($this->Html->image('../images/unsave.png',['style'=>'height:15px;']),['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>'savetaxifleet','style'=>'background-color:white;color:#000;border:0px;']);
											}
											?>
									<span style="visibility:hidden;">3</span>
								</td>
								<td width="25%">
							
								<?php echo $this->Html->link($this->Html->image('../images/flag.png',['style'=>'height:15px;']),'#'.$taxiFleetPromotion->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#reportmodal'.$taxiFleetPromotion->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
								<span style="visibility:hidden;">3</span>
								</td>
								</tr>
								</table>
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
															<textarea class="form-control " rows="3" type="text" placeholder="Enter Your Reason here..." name="comment"></textarea>	
															</div>
														</div>
													</div>
												</div>
												<span class="help-block"></span>
											</div>
											<div class="modal-footer" style="height:60px;">
												<input type="submit" class="btn btn-info btn-md" name="report_submit" value="Report">
												<button type="button" class="btn btn-danger btn-md " data-dismiss="modal">Cancel</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<div class="col-md-9 " style="padding-top:8px;">
								<div class="row col-md-12">
									<div class="col-md-12"><span style="color:#676363;font-weight:600;">Category :</span>
										<?= h($vehicleList); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row rowspace">
										<div class="col-md-12"><span style="color:#676363;font-weight:600;"><?= __(' Cities of Operation') ?> :</span>
										<span><?= h($cityList); ?></span>
										</div>
									</div>
									<div class="row rowspace">
										<div class="col-md-12"><span style="color:#676363;font-weight:600;"><?= __(' States of Operation') ?> :</span>
										<span ><?= h($stateList); ?> </span>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row rowspace">
										<div class="col-md-12"><span style="color:#676363;font-weight:600;"><?= __(' Country') ?> :</span>
										<span ><?= h($taxiFleetPromotion->country->country_name); ?> </span>
										</div>
									</div>
									<div class="row rowspace">
										<div class="col-md-12 "><span style="color:#676363;font-weight:600;"><?= __(' Seller') ?> :</span>	
										<span><u>
											<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$taxiFleetPromotion->user_id),1);?>
											<a href="<?php echo $hrefurl; ?>"> 
											<?= h($taxiFleetPromotion->user->first_name.' '.$taxiFleetPromotion->user->last_name);?></u>
											<?php
											if($taxiFleetPromotion->user_rating==0)
											{
												echo "";
											}
											else{
													echo "(".$taxiFleetPromotion->user_rating." <i class='fa fa-star'></i> )";
												}
											?></a>
										</span>
										</div>					
									</div>
									<!-----button list-->
							<div class="row" style="padding-top:15px;">
								<div class="col-md-12 ">
									<?php
										echo $this->Html->link('<b>Contact Info</b>','address'.$taxiFleetPromotion->id,array('escape'=>false,'class'=>'btn  btn-info btn-md contact','data-target'=>'#contactdetails'.$taxiFleetPromotion->id,'data-toggle'=>'modal'));?>
									
									<!-------Contact Details Modal --------->
												<div id="contactdetails<?php echo $taxiFleetPromotion->id;?>" class="modal fade" role="dialog">
													<div class="modal-dialog modal-md" >
														<!-- Modal content-->
															<div class="modal-content">
															  <div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<span class="modal-title">
																	Seller Details
																	</span>
																	</div>
																	<div class="modal-body">
																		<span class="help-block"></span>
																		<div class="row">
																			<div class="col-md-12">
																				<div class="col-md-4">
																				<label>
																				Seller Name :</label></div>
																				<div class="col-md-8">
																					<span><u>
																					<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$taxiFleetPromotion->user_id),1);?>
																					<a href="<?php echo $hrefurl; ?>"> 
																					<?= h($taxiFleetPromotion->user->first_name.' '.$taxiFleetPromotion->user->last_name);?></u>
																					<?php
																					if($taxiFleetPromotion->user_rating==0)
																					{
																						echo "";
																					}
																					else{
																							echo "(".$taxiFleetPromotion->user_rating." <i class='fa fa-star'></i> )";
																						}
																					?></a>
																				</span>
																				</div>					
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-12">
																			<div class="col-md-4"><label>Mobile No :</label></div>
																			<div class="col-md-8">
																			<span><?= h($taxiFleetPromotion->user->mobile_number);?></span>
																			</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-12">
																				<div class="col-md-4"><label>Email :</label></div>
																				<div class="col-md-8">
																				<span><u><a href="mailto:<?php echo $taxiFleetPromotion->user->email;?>"><?= h($taxiFleetPromotion->user->email);?></a></u></span>
																				</div>
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
											</div>
										</div>
										<!----button list end--->
								</div>
							</div>
						</div>
						</div>
						<hr></hr>	<span class="help-block"></span>					
						<div class="row">
						<div class="col-md-12">
								<span style="color:#676363;font-weight:600;"><?= __('Fleet Details') ?></span>
						</div>
					</div>
					<div class="row rowspace">
						<div class="col-md-12">
							<?= (h($taxiFleetPromotion->fleet_detail)); ?>
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
				jQuery(".formSubmit").submit(function(){
						jQuery("#loader-1").show();
					});
  });
</script>
   
