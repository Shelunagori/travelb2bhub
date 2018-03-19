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
					<fieldset>
						<legend style="color:#369FA1;text-align:center;"><b> &nbsp; <?= __('TaxiFleet Promotion Details ') ?> &nbsp;  </b></legend>
					<div class="box-body">
					<?php foreach($taxiFleetPromotion as $taxiFleetPromotion):
									$vehicleList='';
									$x=0;
									foreach($taxiFleetPromotion->taxi_fleet_promotion_rows as $vehicle)
										{
											
											$vehicleList.=$vehicle->taxi_fleet_car_bus->name;
											if($x>1){
												$vehicleList.=' , ';
											}
											$x++;
										}
									$cityList='';
									$y=0;
									foreach($taxiFleetPromotion->taxi_fleet_promotion_cities as $cities)
										{
											
											$cityList.=$cities->city->name;
											if($y>1){
												$cityList.=' , ';
											}
											$y++;
										}
									$stateList='';
									$z=0;
									foreach($taxiFleetPromotion->taxi_fleet_promotion_states as $states)
										{
											
											$stateList.=$states->state->state_name;
											if($z>1){
												$stateList.=' , ';
											}
											$z++;
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
													<?= h($taxiFleetPromotion->user->first_name.' '.$taxiFleetPromotion->user->last_name.'( '.$taxiFleetPromotion->user_rating.' )');?>
												</div>
												<div class="col-md-2">
													<label><?= __('Title') ?></label>
													</div>
												<div class="col-md-4">
													<?= h($taxiFleetPromotion->title) ?>
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
									</div>
								</div>
										<br>
											<div class="row">
												<div class="col-md-12">
												<div class="col-md-2">
													<label><?= __('Fleet Details') ?></label>
													</div>
												<div class="col-md-10">
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

   
