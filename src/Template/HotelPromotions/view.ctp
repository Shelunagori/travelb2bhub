<?php
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/hotel_promotions/getHotelDetails.json?user_id=".$user_id ."&id=".$id,
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
$hotel_view=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$List=json_decode($response);
	//pr($List); exit;
	$hotelPromotion=$List->getEventPlannersDetails;
	//pr($hotelPromotion);exit;
}
?> 

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
					<fieldset>
						<legend style="color:#369FA1;text-align:center;"><b> &nbsp; <?= __(' Hotel Promotion Details ') ?> &nbsp;  </b></legend>
						<div class="box-body">
						<?php foreach($hotelPromotion as $hotelPromotion):
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
											<?= h($hotelPromotion->user->first_name.' '.$hotelPromotion->user->last_name);?>
											<?php
														if($hotelPromotion->user_rating==0)
														{
															echo "";
														}
														else{
															echo "(";
															for($i=0;$i<$hotelPromotion->user_rating;$i++)
															{
																echo "<i class='fa fa-star' style='font-size:10px;'></i> ";
																if($i==0)
																{
																	echo "";
																}
															}
															echo ")";
															}
													?>
												
											</div>
											<div class="col-md-2">
												<label><?= __('Hotel Name') ?></label>
												</div>
											<div class="col-md-4">
												<?= h($hotelPromotion->hotel_name) ?>
											</div>
										</div>
										<div class="row">
											<div class="col-md-2">
												<label><?= __('Hotel Location') ?></label>
												</div>
											<div class="col-md-4">
												<?= h($hotelPromotion->hotel_location) ?>
											</div>
											<div class="col-md-2">
												<label><?= __('Hotel Category') ?></label>
												</div>
											<div class="col-md-4">
												<?= h($hotelPromotion->hotel_category->name); ?>
											</div>
										</div>
										<div class="row">
											<div class="col-md-2">
												<label><?= __('Website') ?></label>
												</div>
											<div class="col-md-4">
												<?= h($hotelPromotion->website) ?>
											</div>
											<div class="col-md-2">
												<label><?= __('Hotel Rating') ?></label>
												</div>
											<div class="col-md-4">
											<?php
														if($hotelPromotion->user_rating==0)
														{
															echo "No Rating";
														}
														else{
															echo "(";
															for($i=0;$i<$hotelPromotion->user_rating;$i++)
															{
																echo "<i class='fa fa-star' style='font-size:10px;'></i> ";
																if($i==0)
																{
																	echo "";
																}
															}
															echo ")";
															}
													?>
											</div>
										</div>
										<div class="row">
											<div class="col-md-2">
												<label><?= __('Promotion Duration') ?></label>
												</div>
											<div class="col-md-4">
												<?=h($hotelPromotion->price_master->week); ?>
											</div>
											<div class="col-md-2">
												<label><?= __('Visible Date') ?></label>
												</div>
											<div class="col-md-4">
												<?= date('d-M-Y',strtotime($hotelPromotion->visible_date)); ?>
											</div>
										</div>
										<div class="row">
											<div class="col-md-2">
												<label><?= __('Total Charges') ?></label>
												</div>
											<div class="col-md-4">
												<?= $this->Number->format($hotelPromotion->total_charges) ?> &#8377;
											</div>
											<div class="col-md-2">
												<label><?= __('Payment Status') ?></label>
												</div>
											<div class="col-md-4">
												<?= h($hotelPromotion->payment_status) ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php endforeach;?>
						</div>
					</fieldset>
				</div>
			</div>
		</div>
	</section>

							
					