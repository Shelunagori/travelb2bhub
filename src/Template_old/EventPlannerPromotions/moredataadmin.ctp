<?php $i=1;
if(!empty($eventPlannerPromotions)){
	//-- priceMasters
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/price_masters/index.json?promotion_type_id=3",
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
	//pr($priceMasters);exit;
	$priceMasters=$priceMasters->PriceMasters;
}
 
foreach ($eventPlannerPromotions as $eventPlannerPromotion){
		$cityList=array();
		foreach($eventPlannerPromotion->event_planner_promotion_cities as $cities)
		{ 
			if($cities->city_id==0){@$cityList[]='All Cities';}
			else{
				@$cityList[]=$cities->city->name;
			}
		}
		
		$stateList=array();
		foreach($eventPlannerPromotion->event_planner_promotion_states as $states)
		{
			$stateList[]=$states->state->state_name;
		}
		$stateLists=implode(', ',array_unique($stateList));
		$cityLists=implode(', ',array_unique($cityList));
		//pr($eventPlannerPromotion);
	?>
	<div class="box-body bbb">	
		<fieldset style="background-color:#fff;">
			<form method="post" class="formSubmit">
			<input type="hidden" name="event_id" value="<?php echo $eventPlannerPromotion->id; ?>">
				<div class="row">
					<div class="col-md-12" style="padding-top:5px;">
					<span style="font-size:18px;"><?php echo $eventPlannerPromotion->user->company_name; ?></span>
					</div>
					<div class="pull-right">
						<button class="close" style="margin-top: -28px; font-size:20px;font-size: 26px;   margin-right: 17px;" type="button" data-target="#remove<?php echo $eventPlannerPromotion->id; ?>" data-toggle=modal>&times;</button>
					</div>
					</div>
					<span class="help-block"></span>
				<div class="row">
					<div class="col-md-3">
					<?= $this->Html->image($eventPlannerPromotion->full_image,['id'=>'myImg','style'=>'width:100%;height:109px;','data-target'=>'#imagemodal'.$eventPlannerPromotion->id,'data-toggle'=>'modal','promotionid'=>$eventPlannerPromotion->id,'userId'=>$user_id,'class'=>'viewCount']) ?>
					 
					<div id="imagemodal<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
					<div class="modal-dialog modal-md">
						<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-body" >
								<button type="button" class="close" data-dismiss="modal" style="padding-right:8px !important;">&times;</button>
								<?= $this->Html->image($eventPlannerPromotion->full_image,['style'=>'width:100%;;padding:20px;padding-top:0px!important;']) ?>
								</div>
							</div>
						</div>
					</div>
					<hr style="margin-top:4px !important"></hr>
					<div class="row" style="padding-top:5px;">					
						<input type="hidden" name="event_id" value="<?php echo $eventPlannerPromotion->id; ?>">
							<table  width="100%" style="text-align:center;" >
								<tr>
								<td width="25%" >
									<span><img src="../images/view.png" height="13px"/>
									<?= h($eventPlannerPromotion->total_views);?></span>
								</td>
								<td width="25%" >
									<span><img src="../images/unlike.png" height="13px"/>
									<?= h($eventPlannerPromotion->total_likes);?></span>
								</td>
								<td width="25%" >
									<span><img src="../images/unsave.png" height="14px"/>
									<?= h($eventPlannerPromotion->total_saved);?></span>
								</td>
								<td width="25%" >
									<span><a target="blank" href="flagreport?promotion_type_id=<?php echo $eventPlannerPromotion->id ;?>"><img src="../images/flag.png" height="15px"/></a>
									<?= h($eventPlannerPromotion->total_flagged);?></span>
								</td>
							</tr>
						</table>
					</div>
					<hr></hr>
					</div>
					<div class="col-md-9 " style="padding-top:5px;">
						<div class="col-md-6">
							<div class="row rowspace">
								<div class="col-md-12 "><label>Cities of Operation: </label>
								<span ><?= h($cityLists); ?></span>
								</div>
							</div>
							<div class="row rowspace">
								<div class="col-md-12 "><label>States of Operation: </label>
								<span class=""><?= h($stateLists); ?></span>
								</div>
							</div>
							<div class="row rowspace">
								<div class="col-md-12 "><label>Country: </label>
								<span class=""><?= h($eventPlannerPromotion->country->country_name);?></span>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row rowspace">
								<div class="col-md-12 "><label>Posted Date: </label>
								<span style="black"><?= h(date('d-m-Y',strtotime($eventPlannerPromotion->created_on)));?></span>
								</div>
							</div>
							<div class="row rowspace">
								<div class="col-md-12 "><label>Expiring On: </label>
								<span style="color:#FB6542"><?= h(date('d-m-Y',strtotime($eventPlannerPromotion->visible_date)));?></span>
								</div>
							</div>
							<div class="row rowspace">
								<div class="col-md-12 "><label>Event Planner: </label>
									<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'adminviewprofile',$eventPlannerPromotion->user_id),1);?>
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
											?> Event Planner </a>
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
												<div class="row rowspace">
													<div class="col-md-12">
														<label>Seller Name: </label>
															<span style="padding-top:2px;">
															<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'adminviewprofile',$eventPlannerPromotion->user_id),1);?>
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
												<h3 class="modal-title">Event Planner Details</h3>
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
								<button style="margin-top:5px" class="btn btn-info btn-md btnlayout" data-target="#eventdetail<?php echo $eventPlannerPromotion->id;?>" data-toggle="modal" promotionid="<?php echo $eventPlannerPromotion->id;?>" userId="<?php echo $user_id;?>" type="button">Planner Details</button>&nbsp;&nbsp;
								
								<button style="margin-top:5px" class="btn btn-danger btn-md btnlayout" data-target="#contactdetails<?php echo $eventPlannerPromotion->id;?>" data-toggle="modal" promotionid="<?php echo $eventPlannerPromotion->id;?>" userId="<?php echo $user_id;?>" type="button">Contact Info</button>&nbsp;&nbsp;
								
								 
								<button  style="margin-top:5px" type="button" class="btn btn-success btn-md btnlayout" data-target="#renew<?php echo $eventPlannerPromotion->id; ?>" data-toggle=modal>Renew</button>&nbsp;&nbsp;
								
								<a style="margin-top:5px" href="<?php echo $this->Url->build(["controller" => "EventPlannerPromotions",'action'=>'adminedit/'.$eventPlannerPromotion->id]); ?>" class="btn btn-successto btn-md btnlayout" >Edit </a>&nbsp;&nbsp;
								
								<button style="margin-top:5px;" class="btn btn-warning btn-md btnlayout viewCount" data-target="#Priority<?php echo $eventPlannerPromotion->id;?>" data-toggle="modal" type="button">Priority</button>&nbsp;&nbsp;
								 
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<div id="Priority<?php echo $eventPlannerPromotion->id;?>" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md" >
		<!-- Modal content-->
		<form method="post" class="formSubmit">
			<div class="modal-content">
			  <div class="modal-header" >
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">
						Do you want to set Priority ?
					</h4>
				</div>
				<div class="modal-body">
					<div class="row mainrow" style="padding: 12px;">
						<div class="col-md-12">
							 
							<div class="col-md-6">
								<p for="from">
									Select Position
								</p>
								<div class="input-field">
									<select class="form-control" name="position">
										<option value="">Select...</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11 (Default)</option>
									</select>
								</div>
							</div> 
						</div>
						 
					</div>
				</div>
				<div class="modal-footer" style="height:60px;">
					<button type="submit"  name="setpriority" class=" btn btn-success btn-md" value="yes" >Submit</button>
					<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
				</div>
			</div>
			<input type="hidden" name="event_id" value="<?php echo $eventPlannerPromotion->id; ?>">
		</form>
	</div>
</div>
				<div id="renew<?php echo $eventPlannerPromotion->id; ?>" class="modal fade" role="dialog">
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
								<input type="hidden" name="event_id" value="<?php echo $eventPlannerPromotion->id; ?>">
								</form>
							</div>
						</div>
				<div id="remove<?php echo $eventPlannerPromotion->id; ?>" class="modal fade" role="dialog">
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
									<div class="modal-footer" >
										<button type="submit"  class="unfollow btn btn-success btn-md" value="yes" name="remove_promotion">Yes</button>
										<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
									</div>
								</div>
								<input type="hidden" name="remove_package_id" value="<?php echo $eventPlannerPromotion->id; ?>"/>
							</form>
						</div>
					</div>

	</fieldset>
</div>
<?php }
?> 
<div class="maintbl<?php echo $page+1?>"></div><?php 
}?>