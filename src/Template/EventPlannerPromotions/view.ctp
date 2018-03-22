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
?>
<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body"> 
					<fieldset>
						<legend style="color:#369FA1;text-align:center;"><b> &nbsp; <?= __('Event Planner Promotion Details ') ?> &nbsp;  </b></legend>
						<div class="box-body">
							<?php foreach($eventPlannerPromotion as $eventPlannerPromotion):
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
											<div class="row">
												<div class="col-md-12">
													<div class="col-md-4">
														<?= $this->Html->image('../images/PostTravelPackages/8/test/image/8.jpg',['style'=>'width:300px;height:220px;']) ?>
													</div>
													<div class="col-md-8">
														<div class="row">
															<div class="col-md-2">
																<label><?= __('Seller Name') ?></label>
																</div>
															<div class="col-md-4">
																<?= h($eventPlannerPromotion->user->first_name.' '.$eventPlannerPromotion->user->last_name.'( '.$eventPlannerPromotion->user_rating.' )');?>
															</div>
															<div class="col-md-2">
																<label><?= __('Duration') ?></label>
																</div>
															<div class="col-md-4">
																<?= h($eventPlannerPromotion->price_master->week) ?>
															</div>
														</div>
														<div class="row">
															<div class="col-md-2">
																<label><?= __('total Charges') ?></label>
																</div>
															<div class="col-md-4">
																<?= h($eventPlannerPromotion->price_master->price);?>
															</div>
															<div class="col-md-2">
																<label><?= __('Visible Date') ?></label>
																</div>
															<div class="col-md-4">
																<?= date('d-M-Y',strtotime($eventPlannerPromotion->visible_date)); ?>
															</div>
														</div>
														<div class="row">
															<div class="col-md-2">
																<label><?= __('City') ?></label>
																</div>
															<div class="col-md-4">
																<?= h($cityList);?>
															</div>
															<div class="col-md-2">
																<label><?= __('State') ?></label>
															</div>
															<div class="col-md-4">
																<?= h($stateList);?>
															</div>
														</div>
														<div class="row">
															<div class="col-md-2">
																<label><?= __('Country') ?></label>
																</div>
															<div class="col-md-4">
																<?= h($eventPlannerPromotion->country->country_name);?>
															</div>
															<div class="col-md-2">
																<label><?= __('Like Count') ?></label>
															</div>
															<div class="col-md-4">
																<?= $this->Number->format($eventPlannerPromotion->total_likes) ?>
															</div>
														</div>
													</div>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-12">
													<div class="col-md-4">
													</div>
													<div class="col-md-1">
													<label><?= __('Event Details') ?></label>
													</div>
													<div class="col-md-7">
														<p>
														<?= h($eventPlannerPromotion->event_detail);?></p>
													</div>
												</div>
											</div>
										</div> 
									</div> 
								</div> 
							</div>
						</fieldset>
					</div> 
				</div> 
			</div> 
		</div> 
	</section> 
<?php endforeach; ?>
