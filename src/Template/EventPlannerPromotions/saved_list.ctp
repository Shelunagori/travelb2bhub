<?php //echo $this->Html->css('/assets/loader-1.css'); ?>
<?php
//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/EventPlannerPromotionCarts/EventPlannerPromotionsCartlist.json?user_id=".$user_id,
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
	//pr($List);exit;
 	$eventPlannerPromotions=$List->eventPlannerPromotionCarts;
}
//pr($eventPlannerPromotions);
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
 <style type="text/css">
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
	padding-top:0px;
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
<div class="container-fluid">
	<div class="box box-primary" style="margin-bottom:5px;">
		<div class="row" >
			<div class="col-md-12">
				<div class="box-header with-border"> 
					<span class="box-title" style="color:#057F8A;"><b><?= __('Saved Promotions') ?></b></span>
					
				</div>
			</div>
		</div>
	</div>
	<?php $i=1;
				if(!empty($eventPlannerPromotions)){
					//pr($hotelPromotions);exit;
				foreach ($eventPlannerPromotions as $eventPlannerPromotionss){
					$eventPlannerPromotion=$eventPlannerPromotionss->event_planner_promotion;
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
	<div class="box-body bbb">	
		<fieldset style="background-color:#fff;">
			<form method="post" class="formSubmit">
			<input type="hidden" name="event_id" value="<?php echo $eventPlannerPromotion->id; ?>">
				<div class="row">
					<div class="col-md-12" style="padding-top:5px;">
					<span style="font-size:18px;"><?php echo $eventPlannerPromotion->user->company_name; ?></span>
					</div>
					</div>
					<span class="help-block"></span>
				<div class="row">
					<div class="col-md-3">
					<?= $this->Html->image($eventPlannerPromotion->full_image,['id'=>'myImg','style'=>'width:100%;height:80px;','data-target'=>'#imagemodal'.$eventPlannerPromotion->id,'data-toggle'=>'modal',]) ?>
					<div id="imagemodal<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
					<div class="modal-dialog modal-md">
						<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-body" >
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<?= $this->Html->image($eventPlannerPromotion->full_image,['style'=>'width:100%;height:300px;padding:20px;padding-top:0px!important;']) ?>
								</div>
							</div>
						</div>
					</div>
					<hr></hr>
					<div class="row" style="padding-top:5px;">					
						<input type="hidden" name="event_id" value="<?php echo $eventPlannerPromotion->id; ?>">
						<table  width="100%" style="text-align:center;" >
								<tr>
								<td width="25%" >
									<span><?php echo $Image=$this->Html->image('../images/view.png',['height'=>'13px']);?>
									<?= h($eventPlannerPromotionss->total_views);?></span>
								</td>
								<td width="25%">
								<span><?php
									$dataUserId=$eventPlannerPromotionss->user_id;
									$isLiked=$eventPlannerPromotionss->isLiked;
									$issaved=$eventPlannerPromotionss->issaved;
									//-- LIKES DISLIKE
									if($isLiked=='no'){
												$Image=$this->Html->image('../images/unlike.png',['height'=>'15px']);
												echo $this->Form->button($Image,['class'=>'btn btn-xs likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
											}
											if($isLiked=='yes'){
												$Image=$this->Html->image('../images/like.png',['height'=>'15px']);
												echo $this->Form->button($Image,['class'=>'btn  btn-xs likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#F7F3F4;border:0px;']);
											}?>
									<?php echo $eventPlannerPromotionss->total_likes; ?>
								</span>
								</td>
								<td width="25%">
									<?php 
									//-- Save Unsave
									if($issaved=='1'){
										$Image=$this->Html->image('../images/save.png',['height'=>'15px']);
										echo $this->Form->button($Image,['class'=>'btn  btn-xs  ','value'=>'button','type'=>'submit','name'=>'saveeventplanner','style'=>'background-color:white;color:black;border:0px;']);
									}
									if($issaved=='0'){
										$Image=$this->Html->image('../images/unsave.png',['height'=>'15px']);
										echo $this->Form->button($Image,['class'=>'btn btn-primary btn-xs ','value'=>'button','style'=>'background-color:white;color:black;border:0px;','type'=>'submit','name'=>'saveeventplanner']);
									}
									?>
									<span style="visibility:hidden;">3</span>
								</td>
								<td width="25%">
									<?php 
									$Image=$this->Html->image('../images/flag.png',['height'=>'15px']);
									echo $this->Html->link($Image,'#'.$eventPlannerPromotion->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#reportmodal'.$eventPlannerPromotion->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
								<span style="visibility:hidden;">3</span>
								</td>
							</tr>
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
																<textarea class="form-control " rows="3" type="text" placeholder="Enter Your Suggestion here..." name="comment"></textarea>	
																</div>
															</div>
														</div>
													</div>
													<span class="help-block"></span>
												</div>
												<div class="modal-footer" style="height:60px;">
													<input type="submit" class="btn btn-info btn-md" name="report_submit" value="Report">
													<button type="button" class="btn btn-danger btn-default" data-dismiss="modal">Cancel</button>
												</div>
											</div>
										</div>
									</div>
							<!-------Report Modal End--------->	
						</table>
					</div>
					</div>
					<div class="col-md-9">
						<div class="col-md-6">
							<div class="row rowspace">
								<div class="col-md-12 "><label>Cities of Operation :</label>
								<span ><?= h($cityList); ?></span>
								</div>
							</div>
							<div class="row rowspace">
								<div class="col-md-12 "><label>States of Operation </label>
								<span class=""><?= h($stateList); ?></span>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row rowspace">
									<div class="col-md-12 "><label>Country :</label>
									<span class=""><?= h($eventPlannerPromotion->country->country_name);?></span>
									</div>
								</div>
								<div class="row rowspace">
									<div class="col-md-12 "><label>Event Planner :</label>
										<span >
											<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$eventPlannerPromotion->user_id),1);?>
											<u><a href="<?php echo $hrefurl; ?>"> 
												<?= h($eventPlannerPromotion->user->first_name.' '.$eventPlannerPromotion->user->last_name);?></u>
										
												<?php
												if($eventPlannerPromotionss->user_rating==0)
												{
													echo "";
												}
												else{
														echo "( ".$eventPlannerPromotionss->user_rating." <i class='fa fa-star'></i> )";
													}
												?></a>
											</span>
									</div>
								</div>
							</div>
						<div class="col-md-6 pull-right">
						<div class="row" style="padding-top:15px;">
							<div class="col-md-12">
							<button class="btn btn-info btn-md btnlayout" data-target="#eventdetail<?php echo $eventPlannerPromotion->id;?>" data-toggle="modal" type="button">Event Details</button>
								<!-------Report Modal Start--------->
								<div id="eventdetail<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
										<div class="modal-dialog modal-md">
											<!-- Modal content-->
												<div class="modal-content">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h3 class="modal-title">Event Details</h3>
												  </div>
													<div class="modal-body" >
														<div class="row">
															<div class="col-md-12">
															<p style="padding:15px;"><?= h($eventPlannerPromotion->event_detail); ?></p>
															</div>
														</div>
													</div>
													<div class="modal-footer" >
														<button type="button" class="btn btn-danger btn-md " data-dismiss="modal">Cancel</button>
													</div>
												</div>
											</div>
										</div>
								<!-------Report Modal End--------->	
								<button class="btn btn-danger btn-md btnlayout" data-target="#contactdetails<?php echo $eventPlannerPromotion->id;?>" data-toggle="modal" type="button">Contact Info</button>
								<!-------Contact Details Modal --------->
								<div id="contactdetails<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md" >
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h3 class="modal-title">
											Seller Details
											</h3>
											</div>
											<div class="modal-body">
												<span class="help-block"></span>
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-4 label1">Seller Name :</div>
													<div class="col-md-8" style="padding-top:2px;">
															<span >
															<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$eventPlannerPromotion->user_id),1);?>
															<u><a href="<?php echo $hrefurl; ?>"> 
																<?= h($eventPlannerPromotion->user->first_name.' '.$eventPlannerPromotion->user->last_name);?></u>
														
																<?php
																if($eventPlannerPromotionss->user_rating==0)
																{
																	echo "";
																}
																else{
																		echo "( ".$eventPlannerPromotionss->user_rating." <i class='fa fa-star'></i> )";
																	}
																?></a>
															</span>
														</div>					
													</div>
												</div>
												<div class="row">
													<div class="col-md-12" style="padding-top:2px;">
													<div class="col-md-4 label1">Mobile No :</div>
													<div class="col-md-8">
													<span class="label11"><?= h($eventPlannerPromotion->user->mobile_number);?></span>
													</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12" style="padding-top:2px;">
														<div class="col-md-4 label1">Email :</div>
														<div class="col-md-8">
														<span class="label11"><a href="mailto:<?php echo $eventPlannerPromotion->user->email;?>"><?= h($eventPlannerPromotion->user->email);?></a></span>
														</div>
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</fieldset>
</div>
<?php }}					
else
	{
		echo"<div class='row col-md-12 text-center'><tr><th colspan='10' ><span>No Record Found</span></th></tr></div>";
	}							?>
			<!--<div class="paginator">
				<ul class="pagination">
					<?= $this->Paginator->first('<< ' . __('first')) ?>
					<?= $this->Paginator->prev('< ' . __('previous')) ?>
					<?= $this->Paginator->numbers() ?>
					<?= $this->Paginator->next(__('next') . ' >') ?>
					<?= $this->Paginator->last(__('last') . ' >>') ?>
				</ul>
				<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
			</div>--->
		</div>
		<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
		<div id="loader"></div>
		</div>
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
