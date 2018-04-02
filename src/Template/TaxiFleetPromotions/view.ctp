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
?>
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
											if($y>1){
												$cityList.=' , ';
											}
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
										<div class="col-md-12">
											<h3><?= h($taxiFleetPromotion->title) ?></h3>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-6">
												<?= $this->Html->image('../images/8.jpg',['style'=>'width:100%;']) ?>
											</div>
										
										<div class="col-md-6">
										<fieldset>
												<div class="row col-md-12">
													<div class="col-md-3">Seller Name </div><div class="col-md-1">:</div>		
														<div class="col-md-8"><label><u>
														<?= h($taxiFleetPromotion->user->first_name.' '.$taxiFleetPromotion->user->last_name);?></u>
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
												<div class="col-md-2"><?= __('Vehicle Type') ?></div><div class="col-md-1">:</div>		
												<div class="col-md-9"><label style="color:#1295A2"><?= h($taxiFleetPromotion->price_master->price);?> &#8377;</label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-2">
													<label><?= __('Vehicle Type') ?></label>
													</div>
												<div class="col-md-4">
													<?= h($vehicleList);?>
												</div>
												<div class="col-md-2">
													<label><?= __('Promotion Duration') ?></label>
													</div>
												<div class="col-md-4">
													<?= h($taxiFleetPromotion->price_master->week); ?>
												</div>
											</div>
											<div class="row">
												<div class="col-md-2">
													<label><?= __('Total Charges') ?></label>
													</div>
												<div class="col-md-4">
													<?= h($taxiFleetPromotion->price_master->price); ?> &#8377;
												</div>
												<div class="col-md-2">
													<label><?= __('Visible Date') ?></label>
													</div>
												<div class="col-md-4">
													<?= date('d-M-Y',strtotime($taxiFleetPromotion->visible_date)); ?>
												</div>
											</div>
											<div class="row">
												<div class="col-md-2">
													<label><?= __('Cities') ?></label>
													</div>
												<div class="col-md-4">
													<?= h($cityList); ?> 
													</div>
												<div class="col-md-2">
													<label><?= __('State') ?></label>
													</div>
												<div class="col-md-4">
													<?= h($stateList); ?> 
												</div>
											</div>
											<div class="row">
												<div class="col-md-2">
													<label><?= __('Country') ?></label>
													</div>
												<div class="col-md-4">
													<?= h($taxiFleetPromotion->country->country_name); ?>
												</div>
												<div class="col-md-2">
													<label><?= __('Total Likes') ?></label>
													</div>
												<div class="col-md-4">
													<?= h($taxiFleetPromotion->total_likes); ?>
												</div>
											</div>
										</div>
									</fieldset>
								</div>
							</div>
											<div class="row">
												<div class="col-md-12">
												<div class="col-md-4">
												</div>
												<div class="col-md-1">
													<label><?= __('Fleet Details') ?></label>
												</div>
												<div class="col-md-7">
													<?= $this->Text->autoParagraph(h($taxiFleetPromotion->fleet_detail)); ?>
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

   
