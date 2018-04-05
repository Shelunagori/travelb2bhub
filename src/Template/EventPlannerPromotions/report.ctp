<?php

//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/EventPlannerPromotions/getEventPlanners.json?isLikedUserId=".$user_id."&higestSort=".$higestSort."&country_id=".$country_id."&city_id=".$city_id."&state_id=".$state_id,
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
        img {
            cursor: pointer;
        transition: -webkit-transform 0.1s ease
        }
    img:focus {
        -webkit-transform: scale(4);
        -ms-transform: scale(2);
    }
	
fieldset{
	margin:10px !important;
	border-radius: 6px;
}

.fleet{
	font-size:15px;	
	background-color:white;
	color:#909591;
	border:0px;
}
.unfleet{
	font-size:15px;	
	background-color:white;
	color:#d33c44;
	border:0px;
}
p{ 
	text-align:center;
	font-size:10px;
}
.lbwidth{
	color:#838784;
	font-weight:bold;
}
</style>
<div class="row" >
	<div class="col-md-12">
	</div>
</div>
<div class="container-fluid">
	<div class="box box-primary ">
		<div class="row" >
			<div class="col-md-12">
				<div class="box-header with-border"> 
					<span class="box-title" style="color:#057F8A;"><b><?= __('Event Promotions') ?></b></span>
					<div class="box-tools pull-right" style="margin-top:-5px;">
						<a style="font-size:26px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
						<a style="font-size:26px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
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
<div class="">
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
			<div class="row form-group margin-b10">
				<div class=col-md-12>
					 <div class=col-md-3>
					  <label class="col-form-label"for=example-text-input>Country</label>
					  </div>
					  <div class=col-md-1>:</div>
					 <div class=col-md-7>
					<?php $options=array();
						foreach($countries as $country)
						{
							$options[] = ['value'=>$country->id,'text'=>$country->country_name];
						};echo $this->Form->input('country_id', ['options' => $options,'class'=>'form-control select2','label'=>false,'empty'=>'Select...']);
					?>
					</div>
				 </div>
				</div>
				<div class="row form-group margin-b10">
					<div class=col-md-12>
						<div class=col-md-3>
							<label class="col-form-label"for=example-text-input>State</label>
						</div>
						<div class=col-md-1>:</div>
						<div class=col-md-7>
						<?php 
							$options=array();
							foreach($states as $st)
							{
								$options[] = ['value'=>$st->id,'text'=>$st->state_name];
							};
							echo $this->Form->input('state_id', ['options' => $options,'class'=>'form-control select2','label'=>false,"data-placeholder"=>"Select States",'empty'=>'Select...']); 
						?> 
						</div>
					 </div>
				 </div>
				<div class="row form-group margin-b10">
					<div class=col-md-12>
					  <div class=col-md-3>
					 <label class="col-form-label" for=example-text-input>City</label>
					 </div>
					<div class=col-md-1>:</div>
					 <div class=col-md-7>
						 <?php 
						$options=array();
						foreach($city->citystatefi as $cty)
						{
							$options[] = ['value'=>$cty->cityid,'text'=>$cty->name];
						};
						echo $this->Form->input('city_id', ['options' =>$options,'class'=>'form-control select2','label'=>false,"data-placeholder"=>"Select Cities",'empty'=>'Select...']); ?>
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
	<div class="row">
		<fieldset style="background-color:#fff;">
			<form method="post">
				<div class="row">
					<div class="col-md-12">
					<span style="font-size:18px;"><b><?php echo $eventPlannerPromotion->user->company_name; ?></b></span>
					</div>
				</div><span class="help-block"></span>
				<div class="row">
					<div class="col-md-3">
					<?= $this->Html->image($eventPlannerPromotion->full_image,['id'=>'myImg','style'=>'width:100%;height:150px;']) ?>
					</div>
					<div class="col-md-9">
						<div class="row ">
							<div class="col-md-4 lbwidth">Seller :</div>		
								<div class="col-md-8 lbwidth11"><label>
								<?php echo $eventPlannerPromotion->user->first_name.' '.$eventPlannerPromotion->user->last_name.' ( '.$eventPlannerPromotion->user_rating.' <i class="fa fa-star"></i> )';?>
								</label>
								</div>
						</div>
						<div class="row ">
							<div class="col-md-4 lbwidth">Cities of Operation :</div>		
								<div class="col-md-8 lbwidth11"><label>
								<?= h($cityList);?> 
								</label>
								</div>
						</div>
						<div class="row ">
							<div class="col-md-4 lbwidth">States of Operation :</div>		
								<div class="col-md-8 lbwidth11"><label>
								<?= h($stateList);?> 
								</label>
								</div>
						</div>
						<div class="row">
							<div class="col-md-4 lbwidth">Country :</div>
							<div class="col-md-8"><label >	<?= h($eventPlannerPromotion->country->country_name);?></label>
							</div>
						</div>
					</div>
				</div>
				<div class="row">						
					<div class="col-md-3">
						<input type="hidden" name="event_id" value="<?php echo $eventPlannerPromotion->id; ?>">
						<table class="table" width="100%" style="text-align:center;" >
								<tr>
								<td width="25%">
									<i class="fa fa-eye fleet" ></i>
									<p><?= h($eventPlannerPromotion->total_views);?><br>Views</p>
								</td>
								<td width="25%">
									<?php
									$dataUserId=$eventPlannerPromotion->user_id;
									$isLiked=$eventPlannerPromotion->isLiked;
									$issaved=$eventPlannerPromotion->issaved;
									//-- LIKES DISLIKE
									if($isLiked=='no'){
										echo $this->Form->button('<i class="fa fa-heart-o like fleet" > </i>',['class'=>'btn btn-xs likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
									}
									if($isLiked=='yes'){
										echo $this->Form->button('<img src="../images/like.png" height="15px"/>',['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#F7F3F4;border:0px;']);
									}
									?>
									<p>
									<?php echo $eventPlannerPromotion->total_likes; ?>
									<br> 
									Likes
									</p>
								</td>
								<td width="25%">
									<?php 
									//-- Save Unsave
									if($issaved=='1'){
										echo $this->Form->button('<img src="../images/save.png" height="15px"/>',['class'=>'btn  btn-xs  ','value'=>'button','type'=>'submit','name'=>'saveeventplanner','style'=>'background-color:white;color:black;border:0px;']);
									}
									if($issaved=='0'){
										echo $this->Form->button('<i class="fa fa-bookmark-o fleet"></i>',['class'=>'btn btn-primary btn-xs ','value'=>'button','style'=>'background-color:white;color:black;border:0px;','type'=>'submit','name'=>'saveeventplanner']);
									}
									?>
									<p><i style="visibility:hidden;">3<br>Likes</i></p>
								</td>
								<td width="25%">
									<?php echo $this->Html->link('<i class="fa fa-flag-o fleet"></i>','#'.$eventPlannerPromotion->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#reportmodal'.$eventPlannerPromotion->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
								<p><i style="visibility:hidden;">3<br>Likes</i></p>
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
												</div>
												<div class="modal-footer" style="height:60px;">
													<input type="submit" class="btn btn-primary btn-md" name="report_submit" value="Report">
													<button type="button" class="btn btn-danger btn-default" data-dismiss="modal">Cancle</button>
												</div>
											</div>
										</div>
									</div>
							<!-------Report Modal End--------->	
						</table>
					</div>
					<div class="col-md-3 pull-right">
					<i class="btn btn-info btn-md fa fa-book" data-target="#eventdetail<?php echo $eventPlannerPromotion->id;?>" data-toggle="modal"> Event Details</i>
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
												<span class="help-block"></span>
												<div class="row">
													<div class="col-md-12">
														<label style="padding:20px;"><?= h($eventPlannerPromotion->event_detail); ?></label>
													</div>
												</div>
											</div>
											<div class="modal-footer" >
												<button type="button" class="btn btn-danger btn-md " data-dismiss="modal">Cancle</button>
											</div>
										</div>
									</div>
								</div>
						<!-------Report Modal End--------->	
						<i class="btn btn-danger btn-md fa fa-phone" data-target="#contactdetails<?php echo $eventPlannerPromotion->id;?>" data-toggle="modal"> Seller Details</i>
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
												<label><?= h($eventPlannerPromotion->user->email);?></label>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Cancle</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</fieldset>
	</div>	
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
	</div>
</div>
</div>
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
});
</script>
