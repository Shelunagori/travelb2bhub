<?php
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/PostTravlePackages/getTravelPackageDetails.json?user_id=".$user_id ."&id=".$id,
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
$posttravle_view=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$List=json_decode($response);
	//pr($List); exit;
	$postTravlePackage=$List->getTravelPackageDetails;
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
						<legend style="color:#369FA1;"><b> &nbsp; <?= __('Post Travle Package Details ') ?> &nbsp;  </b></legend>
						<?php foreach($postTravlePackage as $postTravlePackage):?>
						<table class="table">
							<tr>
								<td colspan="2"><?= $this->Html->image('../images/PostTravelPackages/8/test/image/8.jpg',['style'=>'width:300px;margin-top:-10px;height:220px;']) ?></td>
								<td colspan="2">
									<table class="table">
										<tr>
											<th scope="row"><?= __('Seller Name') ?></th>
											<td><?= h($postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name.'( '.$postTravlePackage->user_rating.' )');?></td>
											<th scope="row"><?= __('Title') ?></th>
											<td><?= h($postTravlePackage->title) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Package Duration') ?></th>
											<td><?= h($postTravlePackage->duration_night.'Night '.$postTravlePackage->duration_day.'Days') ?></td>
											<th scope="row"><?= __('Visible Date') ?></th>
											<td><?= date('d-M-Y',strtotime($postTravlePackage->visible_date) );?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Image') ?></th>
											<td><?= h($postTravlePackage->image) ?></td>
										</tr>
										<tr>
											<th scope="row"><?= __('Promotion Duration') ?></th>
											<td><?=h($postTravlePackage->price_master->week)?></td>
											
										</tr>	
										<tr>
											<th scope="row"><?= __('Starting Price') ?></th>
											<td><?= $this->Number->format($postTravlePackage->starting_price).' &#8377;'; ?></td>
											<th scope="row"><?= __('Like Count') ?></th>
											<td><?= $this->Number->format($postTravlePackage->like_count) ?></td>
										</tr>
									
									</table>
								</td>
							</tr>
						</table>
						<div class="row">
							<h4><?= __('Package Detail') ?></h4>
							<?= $this->Text->autoParagraph(h($postTravlePackage->package_detail)); ?>
						</div>
						<div class="row">
							<h4><?= __('Excluded Detail') ?></h4>
							<?= $this->Text->autoParagraph(h($postTravlePackage->excluded_detail)); ?>
						</div>
					<?php endforeach; ?>
								
