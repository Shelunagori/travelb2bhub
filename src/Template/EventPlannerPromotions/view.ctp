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
									$cityList.=', ';
									}
									@$cityList.=$cities->city->name;
									if($cities->city_id==0){@$cityList.='All Cities';}
									$x++;
								}
								
								$stateList='';
								$y=0;
								foreach($eventPlannerPromotion->event_planner_promotion_states as $states)
								{
									if($y>=1)
									{
									$stateList.=', ';
									}
									$stateList.=$states->state->state_name;
									$y++;
								}
								
								
							?>
				<form method="post" class="formsubmit">
							<div class="row" style="padding-top:5px;">
								<div class="col-md-12">
									<span style="font-size:18px;"><?= h($eventPlannerPromotion->user->company_name) ?></span>
									</div>
								</div>
								<span class="help-block"></span>
							<div class="row">
							<div class="col-md-12">
								<div class="col-md-3">
								<?= $this->Html->image($eventPlannerPromotion->full_image,['id'=>'myImg','style'=>'width:100%;height:100px;','data-target'=>'#imagemodal'.$eventPlannerPromotion->id,'data-toggle'=>'modal',]) ?>
								<div id="imagemodal<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-md">
									<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-body" >
											<button type="button" class="close" data-dismiss="modal" style="padding-right:8px !important;">&times;</button>
											<?= $this->Html->image($eventPlannerPromotion->full_image,['style'=>'width:100%;padding:20px;padding-top:0px!important;']) ?>
											</div>
										</div>
									</div>
								</div><hr></hr>
								<input type="hidden" name="event_id" value="<?php echo $eventPlannerPromotion->id; ?>">
									<div class="row" style="padding-top:5px;">
									<table  width="100%" style="text-align:center;" >
									<tr>
									<td width="25%" >
										<span>
										<?= $this->Html->image('../images/view.png',['style'=>'height:13px;']) ?>
										 
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
												echo $this->Form->button($this->Html->image('../images/save.png',['style'=>'height:15px;']),['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>'saveeventplanner','style'=>'background-color:white;color:#000;border:0px;']);
											}
											if($issaved=='0'){
												echo $this->Form->button($this->Html->image('../images/unsave.png',['style'=>'height:15px;']),['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>'saveeventplanner','style'=>'background-color:white;color:#000;border:0px;']);
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
																			<span>
																				Select Reason
																			</span>
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
							<div class="col-md-9 " style="padding-top:5px;">
								<div class="col-md-6">
									<div class="row rowspace">
										<div class="col-md-12 "><label>Cities of Operation: </label>
										<span ><?= h($cityList); ?></span>
										</div>
									</div>
									<div class="row rowspace">
										<div class="col-md-12 "><label>States of Operation: </label>
										<span class=""><?= h($stateList); ?></span>
										</div>
									</div>
								</div>			
									<div class="col-md-6">
										<div class="row rowspace">
											<div class="col-md-12 "><label>Country: </label>
											<span class=""><?= h($eventPlannerPromotion->country->country_name);?></span>
											</div>
										</div>
										<div class="row rowspace">
											<div class="col-md-12 "><label>Event Planner: </label>
											<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$eventPlannerPromotion->user_id),1);?>
													<span><u><a style="color:#d69d5c;" href="<?php echo $hrefurl; ?>"> 
														<?= h($eventPlannerPromotion->user->first_name.' '.$eventPlannerPromotion->user->last_name);?></u>
												
														<?php
														if($eventPlannerPromotion->user_rating==0)
														{
															echo "";
														}
														else{
																echo "(".$eventPlannerPromotion->user_rating." <i class='fa fa-star'></i>)";
															}
														?></a>
													</span>
											</div>
										</div>
													<div class="row " style="padding-top: 15px;">
														<div class="col-md-12 text-center">
														<button class="btn btn-danger btn-md btnlayout" data-target="#contactdetails<?php echo $eventPlannerPromotion->id;?>" data-toggle="modal" type="button">Contact Info</button>
														</div>
													</div><span class="help-block"></span>
												</div>
											</div>
										</div>	
									</div>
								<!-------Contact Details Modal --------->
								<div id="contactdetails<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-sm" >
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h3 class="modal-title">
											Seller Details
											</h3>
											</div>
											<div class="modal-body" style="padding-left:15px!important;">
												<div class="row rowspace">
													<div class="col-md-12">
														<label>Seller Name: </label>
															<span style="padding-top:2px;">
															<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$eventPlannerPromotion->user_id),1);?>
															<u><a style="color:#d69d5c;" href="<?php echo $hrefurl; ?>"> 
																<?= h($eventPlannerPromotion->user->first_name.' '.$eventPlannerPromotion->user->last_name);?></u>
														
																<?php
																if($eventPlannerPromotion->user_rating==0)
																{
																	echo "";
																}
																else{
																		echo "(".$eventPlannerPromotion->user_rating." <i class='fa fa-star'></i>)";
																	}
																?></a>
														</span>
													</div>					
												</div>
												<div class="row rowspace">
													<div class="col-md-12" >
													<label>Mobile No: </label>
													<span class="label11"><?= h($eventPlannerPromotion->user->mobile_number);?></span>
													</div>
												</div>
												<div class="row rowspace">
													<div class="col-md-12" >
														<label>Email: </label>
														<span class="label11"><a href="mailto:<?php echo $eventPlannerPromotion->user->email;?>"><?= h($eventPlannerPromotion->user->email);?></a></span>
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
						</form>
						<hr></hr>					
						<div class="row">
							<div class="col-md-12">
								<span style="color:#676363;font-weight:600;"><?= __('Event Details') ?></span>
							</div>
						</div>
						<div class="row" style="padding-top:2px;">
							<div class="col-md-12">
								<?= (h($eventPlannerPromotion->event_detail)); ?>
							</div>
						</div>
						</div>
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
				jQuery(".formsubmit").submit(function(){
						jQuery("#loader-1").show();
					});
  });
</script>