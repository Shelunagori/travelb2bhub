<?php  //echo $this->Html->css('/assets/loader-1.css'); ?>
<?php
//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/EventPlannerPromotions/getEventPlanners.json?isLikedUserId=".$user_id."&higestSort=".$higestSort."&country_id=".$country_id."&city_id=".$city_id."&state_id=".$state_id."&search=".$search."&submitted_from=web",
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
 	$eventPlannerPromotions=$List->getEventPlanners;
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
	font-weight:600;
	padding-top:3px;
	margin-bottom:0px !important;
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
					<span class="box-title" style="color:#057F8A;"><b><?= __('Event Promotions') ?></b></span>
					<div class="box-tools pull-right" style="margin-top:-5px;">
						<a style="font-size:20px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
						<a style="font-size:20px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
						<a style="font-size:20px" href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'savedList',$user_id),1);?>"  class="btn btn-box-tool" ><i class="fa fa-bookmark"></i> </a>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-------SHORTING FILTERING--------->
<div id="myModal123" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
	<!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Sorting</h4>
	  </div>
			  <form method="get" class="filter_box">
				  <div class="modal-body" style="height:130px;">
					<div class="col-md-12 row form-group ">
						<div class="col-md-12 radio">
							<label>
								<input class="btn btn-info btn-sm" type="radio" name="higestSort" value="user_rating"/>
								User Rating
							</label>
						</div>
					</div>
					<div class="col-md-12 row form-group ">
						<div class="col-md-12 radio">
							<label>
							<input class="btn btn-info btn-sm" type="radio" name="higestSort" value="total_likes"/>
								Likes
							</label>
						</div>
					</div>
					<div class="col-md-12 row form-group ">
						<div class="col-md-12 radio">
							<label>
								<input class="btn btn-info btn-sm" type="radio" name="higestSort" value="total_views"/>
								 Views
							</label>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="height:60px;">
					  <div class="row">
							<div class="col-md-12 text-center">
								<input type="submit" class="btn btn-info btn-sm">
								<a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
							</div>
					  </div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="fade modal form-modal" id="myModal122" role="dialog">
  <div class="modal-dialog modal-md"  >
	 <div class=modal-content>
		<div class=modal-header>
		   <button class="close" data-dismiss="modal" type="button">&times;</button>
		   <h4 class=modal-title>Filter</h4>
		</div>
		<form class="filter_box" method="get">
		<div class="modal-body">
			<span class="help-block"></span>
			
				<div class="row form-group margin-b10">
					<div class=col-md-12>
						<div class=col-md-4>
							 <label class="label1">State:  </label>
						</div>
						<div class=col-md-7>
						<?php 
							$options=array();
							foreach($states as $st)
							{
								$options[] = ['value'=>$st->id,'text'=>$st->state_name];
							};
							echo $this->Form->input('state_id', ['options' => $options,'class'=>'form-control select2','label'=>false,"data-placeholder"=>"Select States",'empty'=>'Select...','multiple'=>true,'data-placeholder'=>'Select Multiple']); 
						?> 
						</div>
					 </div>
				 </div>
				<div class="row form-group margin-b10">
					<div class=col-md-12>
					  <div class=col-md-4>
					  <label class="label1">City:  </label>
					 </div>
					 <div class=col-md-7>
						 <?php 
						$options=array();
						foreach($city->citystatefi as $cty)
						{
							$options[] = ['value'=>$cty->cityid,'text'=>$cty->name];
						};
						echo $this->Form->input('city_id', ['options' =>$options,'class'=>'form-control select2','label'=>false,"data-placeholder"=>"Select Cities",'empty'=>'Select...','multiple'=>true,'data-placeholder'=>'Select Multiple']); ?>
					 </div>
					</div>	
				</div>
			  </div>
			<div class="modal-footer">
				<button class="btn btn-info btn-sm" name="submit" value="Submit" type="submit">Filter</button> 
				<a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
			</div>
		</form>
	 </div>
  </div>
</div>
<form method="get">
	<div class="" style="margin-bottom:5px;">
		<div class="row">
			<div class="col-md-12">
				<div class="">
					<table width="100%"><tr><td width="80%"> 
						<input class="form-control" placeholder="Type Location, State, City etc." name="search"/></td>
						<td width="8%" style="padding-left:5px;"><button style="width:100%" class="btn btn-info btn-sm" name="submit" value="Submit" type="submit">Search</button></td>
						<td width="8%" style="padding-left:5px;"><a href="<?php echo $this->Url->build(array('controller'=>'EventPlannerPromotions','action'=>'report')) ?>"class="btn btn-danger btn-sm" style="width:100%">Reset</a>
						</td></tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</form>		
<?php $i=1;
if(!empty($eventPlannerPromotions)){
foreach ($eventPlannerPromotions as $eventPlannerPromotion){
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
					<?= $this->Html->image($eventPlannerPromotion->full_image,['id'=>'myImg','style'=>'width:100%;height:80px;','data-target'=>'#imagemodal'.$eventPlannerPromotion->id,'data-toggle'=>'modal','promotionid'=>$eventPlannerPromotion->id,'userId'=>$user_id,'class'=>'viewCount']) ?>
					 
					<div id="imagemodal<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
					<div class="modal-dialog modal-md">
						<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-body" >
								<button type="button" class="close" data-dismiss="modal" style="padding-right:8px !important;">&times;</button>
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
									<span><img src="../images/view.png" height="13px"/>
									<?= h($eventPlannerPromotion->total_views);?></span>
								</td>
								<td width="25%">
								<span><?php
									$dataUserId=$eventPlannerPromotion->user_id;
									$isLiked=$eventPlannerPromotion->isLiked;
									$issaved=$eventPlannerPromotion->issaved;
									//-- LIKES DISLIKE
									if($isLiked=='no'){
										echo $this->Form->button('<img src="../images/unlike.png" height="15px"/>',['class'=>'btn btn-xs likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
									}
									if($isLiked=='yes'){
										echo $this->Form->button('<img src="../images/like.png" height="15px"/>',['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#F7F3F4;border:0px;']);
									}
									?>
									<?php echo $eventPlannerPromotion->total_likes; ?>
								</span>
								</td>
								<td width="25%">
									<?php 
									//-- Save Unsave
									if($issaved=='1'){
										echo $this->Form->button('<img src="../images/save.png" height="15px"/>',['class'=>'btn  btn-xs  ','value'=>'button','type'=>'submit','name'=>'saveeventplanner','style'=>'background-color:white;color:black;border:0px;']);
									}
									if($issaved=='0'){
										echo $this->Form->button('<img src="../images/unsave.png" height="15px"/>',['class'=>'btn btn-primary btn-xs ','value'=>'button','style'=>'background-color:white;color:black;border:0px;','type'=>'submit','name'=>'saveeventplanner']);
									}
									?>
									<span style="visibility:hidden;">3</span>
								</td>
								<td width="25%">
									<?php echo $this->Html->link('<img src="../images/flag.png" height="15px"/>','#'.$eventPlannerPromotion->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#reportmodal'.$eventPlannerPromotion->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
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
							</div>
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
												<span class="help-block"></span>
												<div class="row">
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
												<div class="row">
													<div class="col-md-12" >
													<label>Mobile No: </label>
													<span class="label11"><?= h($eventPlannerPromotion->user->mobile_number);?></span>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12" style="padding-top:2px;">
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
						<div class="col-md-12 text-center">
						<div class="row" style="padding-top:15px;">
							<div class="col-md-12">
								<button class="btn btn-info btn-md btnlayout viewCount" data-target="#eventdetail<?php echo $eventPlannerPromotion->id;?>" data-toggle="modal" promotionid="<?php echo $eventPlannerPromotion->id;?>" userId="<?php echo $user_id;?>" type="button">Event Details</button>&nbsp;&nbsp;
								<button class="btn btn-danger btn-md btnlayout viewCount" data-target="#contactdetails<?php echo $eventPlannerPromotion->id;?>" data-toggle="modal" promotionid="<?php echo $eventPlannerPromotion->id;?>" userId="<?php echo $user_id;?>" type="button">Contact Info</button>
								<!-------Contact Details Modal --------->
								
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
	jQuery("form").submit(function(){
		jQuery("#loader-1").show();
	});
	$(document).on('click','.viewCount',function()
	{
		var promotionid=$(this).attr('promotionid');
		var userId=$(this).attr('userId');
		
		var siteUrl='<?php echo $coreVariable['SiteUrl']; ?>';
		var siteUrls="api/EventPlannerPromotions/getEventPlannersDetails.json?id="+promotionid+"&user_id="+userId;
		var mainUrl=siteUrl+siteUrls; 
		$.ajax({
			url: mainUrl,
			processData: false,
			contentType: false,
			type: 'GET',
			success: function(data)
			{
			}
		});
	});	

});
</script>
