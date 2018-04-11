<?php
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/EventPlannerPromotions/getEventPlannersDetails.json?user_id=".$user_id ."&id=".$id,
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
$eventplanner_view=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$List=json_decode($response);
	//pr($List); exit;
	$eventPlannerPromotion=$List->getEventPlannersDetails;
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
	font-size:20px;	
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
	font-size:10px;
}
</style>
<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body"> 
							<?php foreach($eventPlannerPromotion as $eventPlannerPromotion){
							$cityList='';
							$x=0;
								foreach($eventPlannerPromotion->event_planner_promotion_cities as $cities)
								{
									if($x>=1)
									{
									$cityList.=' , ';
									}
									@$cityList.=$cities->city->name;
									$x++;
								}
								
								$stateList='';
								$y=0;
								foreach($eventPlannerPromotion->event_planner_promotion_states as $states)
								{
									if($y>=1)
									{
									$stateList.=' , ';
									}
									$stateList.=$states->state->state_name;
									$y++;
								}
								
								
							?>
				<form method="post" class="formsubmit">
							<div class="row">
								<div class="col-md-12">
									<h3><?= h($eventPlannerPromotion->user->company_name) ?></h3>
								</div>
							<div class="row">
							<div class="col-md-12">
								<div class="col-md-6" >
								<?= $this->Html->image($eventPlannerPromotion->full_image,['style'=>'width:100%;height:300px;']) ?>
								<input type="hidden" name="event_id" value="<?php echo $eventPlannerPromotion->id; ?>">
									<div class="row" style="padding-top:5px;">
									<table  width="100%" style="text-align:center;" >
									<tr>
									<td width="25%" >
										<span>
										<?= $this->Html->image('../images/view.png',['style'=>'height:15px;']) ?>
										 
										<?= h($eventPlannerPromotion->total_views);?></span>
									</td>
									<td width="25%">
										<span ><?php
										//
											$dataUserId=$eventPlannerPromotion->user_id;
											$isLiked=$eventPlannerPromotion->isLiked;
											$issaved=$eventPlannerPromotion->issaved;
											//-- LIKES DISLIKE
											if($isLiked=='no'){
												echo $this->Form->button($this->Html->image('../images/unlike.png',['style'=>'height:15px;']),['class'=>'btn btn-xs likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
											}
											if($isLiked=='yes'){
												echo $this->Form->button($this->Html->image('../images/like.png',['style'=>'height:15px;']),['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#000;border:0px;']);
											}
										?>
										<?= h($eventPlannerPromotion->total_likes);?></span>
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
									 
										<?php echo $this->Html->link($this->Html->image('../images/flag.png',['style'=>'height:15px;']),'#'.$eventPlannerPromotion->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#reportmodal'.$eventPlannerPromotion->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
										<span style="visibility:hidden;">3</span>
									</td>
										<!--------Hidden Field Delete-------------------> 			
											<div style="display:none;">
												<?php 
												if($dataUserId==$user_id){
													echo $this->Html->link('<i class="fa fa-trash" > Delete</i>','api address'.$eventPlannerPromotion->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#deletemodal'.$eventPlannerPromotion->id,'data-toggle'=>'modal'));?>
												<!-------Delete Modal Start--------->
													<div id="deletemodal<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
														<div class="modal-dialog modal-md" >
															<!-- Modal content-->
																<div class="modal-content">
																  <div class="modal-header" style="height:100px;">
																		<button type="button" class="close" data-dismiss="modal">&times;</button>
																		<h4 class="modal-title">
																		Are You Sure, you want to delete this promotion ?
																		</h4>
																	</div>
																	<div class="modal-footer" style="height:60px;">
																		<button type="submit" class="btn btn-danger" name="removeposttravle" value="yes" >Yes</button>
																		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
																	</div>
																</div>
															</div>
														</div>
												<!-------Delete Modal End--------->	
												<?php }?>
											</div>
											<div id="reportmodal<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
												<div class="modal-dialog modal-md">
													<!-- Modal content-->
														<div class="modal-content">
														  <div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h3 class="modal-title">Report</h3>
														  </div>
															<div class="modal-body">
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
																			<textarea class="form-control " rows="3" type="text" placeholder="Enter your reason here..." name="comment"></textarea>	
																			</div>
																		</div>
																	</div>
																</div>
															<span class="help-block"></span>
															</div>
															<div class="modal-footer" style="height:60px;">
																<input type="submit" class="btn btn-info btn-md" name="report_submit" value="Report">
																<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
															</div>
														</div>
													</div>
												</div>
											</tr>
										</table>
									</div>
								</div>
							<div class="col-md-6">
								<div class="row col-md-12">
									<div class="col-md-4 lbwidth">Seller :</div>		
									<div class="col-md-8 lbwidth11"><label>
									<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$eventPlannerPromotion->user_id),1);?>
									<a href="<?php echo $hrefurl; ?>"> 
									<?php echo $eventPlannerPromotion->user->first_name.' '.$eventPlannerPromotion->user->last_name.' ( '.$eventPlannerPromotion->user_rating.' <i class="fa fa-star"></i> )';?>
									</a>
									</label>
									</div>					
								</div>
								<div class="row col-md-12">
									<div class="col-md-4"><?= __('Package Duration') ?>:</div>		
									<div class="col-md-8"><label><?= h($eventPlannerPromotion->price_master->week) ?></label>
								</div>
								</div>
								<div class="row col-md-12">
									<div class="col-md-4"><?= __('Total Charges') ?>:</div>		
									<div class="col-md-8"><label style="color:#FB6542"><?= $this->Number->format($eventPlannerPromotion->price_master->price).' &#8377;'; ?></label>
									</div>
								</div>
								<div class="row col-md-12">
									<div class="col-md-4"><?= __('Visible Date') ?>:</div>
									<div class="col-md-8"><label  style="color:#1295A2"><?= date('d-M-Y',strtotime($eventPlannerPromotion->visible_date) );?> </label>
									</div>
								</div>
								<div class="row col-md-12">
									<div class="col-md-4"><?= __('Cities of Operation') ?>:</div>
									<div class="col-md-8"><label ><?= h($cityList); ?></label>
									</div>
								</div>
								<div class="row col-md-12">
									<div class="col-md-4"><?= __('States') ?>:</div>
									<div class="col-md-8"><label ><?= h($stateList); ?> </label>
									</div>
								</div>
								<div class="row col-md-12">
									<div class="col-md-4"><?= __('Country') ?>:</div>
									<div class="col-md-8"><label ><?= h($eventPlannerPromotion->country->country_name); ?> </label>
									</div>
								</div><br>
								<div class="row col-md-12 text-center">
								<?php
								echo $this->Html->link('<b>Contact Info</b>','address'.$eventPlannerPromotion->id,array('escape'=>false,'class'=>'btn  btn-info btn-md contact','data-target'=>'#sellerdetails'.$eventPlannerPromotion->id,'data-toggle'=>'modal'));?>
								</div>
						<!-------Contact Details Modal --------->
								<div id="sellerdetails<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
										<!-- Modal content-->
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">
													Seller Details
													</h4>
													</div>
												<div class="modal-body">
													<span class="help-block"></span>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-4">Seller Name :</div>
															<div class="col-md-8">
																<label>
																	<?= h($eventPlannerPromotion->user->first_name.' '.$eventPlannerPromotion->user->last_name);?>
																	<?php
																	if($eventPlannerPromotion->user_rating==0)
																	{
																		echo "";
																	}
																	else{
																		echo "( ";
																		for($i=0;$i<$eventPlannerPromotion->user_rating;$i++)
																		{
																			echo "<i class='fa fa-star' style='font-size:10px;color:#efea65;'></i>";
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
													</div>
													<div class="row">
														<div class="col-md-12">
														<div class="col-md-4">Mobile No :</div>
														<div class="col-md-8">
														<label><?= h($eventPlannerPromotion->user->mobile_number);?></label>
														</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-4">Email :</div>
															<div class="col-md-8">
															<label><a href="mailto:<?php echo $eventPlannerPromotion->user->email;?>"><?= h($eventPlannerPromotion->user->email);?></a></label>
															</div>
														</div>
													</div>
													<div class="row" style="display:none;">
														<div class="col-md-12">
															<div class="col-md-4">Location :</div>
															<div class="col-md-8">
															<label><?= h($eventPlannerPromotion->user->location);?></label>
															</div>
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
								</div>
							</div>
						</div>
						</div>
						<hr></hr>					
						<div class="row">
						<div class="col-md-12">
								<label><b><?= __('Event Details') ?></b></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<?= (h($eventPlannerPromotion->event_detail)); ?>
						</div>
					</div>
					
				</form>
				
							<?php }?>
			</div> 
		</div> 
	</div> 
</div>
<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
					<div id="loader"></div>
					</div>
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
		})
				jQuery(".formSubmit").submit(function(){
						jQuery("#loader-1").show();
					});
  });
</script>