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
				<!--<div class="box-header with-border">
					<i class="fa fa-plus"></i> <b>View Hotel Promotion</b>
				</div> -->
				<div class="box-body"> 
					<center><fieldset>
						<legend style="color:#369FA1;"><b> &nbsp; <?= __(' Hotel Promotion Details ') ?> &nbsp;  </b></legend>
							<table class="table">
							<?php foreach($hotelPromotion as $hotelPromotion):
								?>
								<tbody>
								<tr>
									<td colspan="2"><?= $this->Html->image('../images/PostTravelPackages/8/test/image/8.jpg',['style'=>'width:300px;margin-top:-10px;height:220px;']) ?></td>	
									<td colspan="2">
									<table class="table">
									<tr>
									<th ><?= __('Seller Name') ?></th>
									<td><?= h($hotelPromotion->user->first_name.' '.$hotelPromotion->user->last_name.'( '.$hotelPromotion->user_rating.' )');?></td>
									<th ><?= __('Hotel Name') ?></th>
									<td><?= h($hotelPromotion->hotel_name) ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Hotel Location') ?></th>
									<td><?= h($hotelPromotion->hotel_location) ?></td>
									<th scope="row"><?= __('Hotel Category') ?></th>
									<td><?= h($hotelPromotion->hotel_category->name); ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Website') ?></th>
									<td><?= h($hotelPromotion->website) ?></td>
									<th scope="row"><?= __('Hotel Rating') ?></th>
									<td><?= $this->Number->format($hotelPromotion->hotel_rating) ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Promotion Duration') ?></th>
									<td><?=h($hotelPromotion->price_master->week); ?></td>
									<th scope="row"><?= __('Visible Date') ?></th>
									<td><?= date('d-M-Y',strtotime($hotelPromotion->visible_date)); ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Cheap Tariff') ?></th>
									<td><?= $this->Number->format($hotelPromotion->cheap_tariff) ?></td>
									<th scope="row"><?= __('Expensive Tariff') ?></th>
									<td><?= $this->Number->format($hotelPromotion->expensive_tariff) ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Total Charges') ?></th>
									<td><?= $this->Number->format($hotelPromotion->total_charges) ?></td>
									<th scope="row"><?= __('Payment Status') ?></th>
									<td><?= h($hotelPromotion->payment_status) ?></td>
								</tr>
							</table></td></tr><?php endforeach; ?></tbody>
							</table>
						</fieldset>
					</center>
				</div>
			</div>
		</div>
	</div>
</section>


							