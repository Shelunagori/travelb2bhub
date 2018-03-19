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
				<div class="box-body"> 
					<fieldset>
						<legend style="color:#369FA1;text-align:center;"><b> &nbsp; <?= __('Post Travle Package Details ') ?> &nbsp;  </b></legend>
						<div class="box-body">
						<?php foreach($postTravlePackage as $postTravlePackage):
									$CategoryList='';
									$x=0;
									foreach($postTravlePackage->post_travle_package_rows as $category)
										{
											
											$CategoryList.=$category->post_travle_package_category->name;
											if($x>1){
												$CategoryList.=' , ';
											}
											$x++;
										}
											$countryList='';
											$y=0;
											foreach($postTravlePackage->post_travle_package_countries as $country)
											{
												
												$countryList.=$country->country->country_name;
												if($y>1){
													$countryList.=' , ';
												}
												$y++;
											}
										
											$cityList='';
											$z=0;
											foreach($postTravlePackage->post_travle_package_cities as $cities)
											{
												
												$cityList.=$cities->city->name;
												if($z>1){
													$cityList.=' , ';
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
													<?= h($postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name.'( '.$postTravlePackage->user_rating.' )');?>
												</div>
												<div class="col-md-2">
													<label><?= __('Title') ?></label>
													</div>
												<div class="col-md-4">
													<?= h($postTravlePackage->title) ?>
												</div>
											</div>
											<div class="row">
												<div class="col-md-2">
													<label><?= __('Package Category') ?></label>
													</div>
												<div class="col-md-4">
													<?= h($CategoryList);?>
												</div>
												<div class="col-md-2">
													<label><?= __('Valid Date') ?></label>
													</div>
												<div class="col-md-4">
													<?= date('d-M-Y',strtotime($postTravlePackage->valid_date) );?>
												</div>
											</div>
											<div class="row">
												<div class="col-md-2">
													<label><?= __('Package Duration') ?></label>
													</div>
												<div class="col-md-4">
													<?= h($postTravlePackage->duration_night.'Night '.$postTravlePackage->duration_day.'Days') ?>
												</div>
												<div class="col-md-2">
													<label><?= __('Starting Price') ?></label>
													</div>
												<div class="col-md-4">
													<?= $this->Number->format($postTravlePackage->starting_price).' &#8377;'; ?>
												</div>
											</div>
											<div class="row">
												<div class="col-md-2">
													<label><?= __('Promotion Duration') ?></label>
													</div>
												<div class="col-md-4">
													<?=h($postTravlePackage->price_master->week)?>
												</div>
												<div class="col-md-2">
													<label><?= __('Total Charges') ?></label>
													</div>
												<div class="col-md-4">
													<?=h($postTravlePackage->price_master->price)?>
												</div>
											</div>
											<div class="row">
												<div class="col-md-2">
													<label><?= __('Visible Date') ?></label>
													</div>
												<div class="col-md-4">
													<?= date('d-M-Y',strtotime($postTravlePackage->visible_date) );?>
												</div>
												<div class="col-md-2">
													<label><?= __('Like Count') ?></label>
													</div>
												<div class="col-md-4">
													<?= $this->Number->format($postTravlePackage->like_count) ?>
												</div>
											</div>
											<div class="row">
												<div class="col-md-2">
													<label><?= __('Country') ?></label>
													</div>
												<div class="col-md-4">
													<?= h($countryList); ?>
												</div>
												<div class="col-md-2">
													<label><?= __('City') ?></label>
													</div>
												<div class="col-md-4">
													<?= h($cityList); ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
										<label><?= __('Package Detail') ?></label>
									</div>
									<div class="col-md-10">
										<p>	Mellissa Dunn won a silver medal for the Australia women's national wheelchair basketball team at the 2000 Sydney Paralympics. Following this, she went on to qualify as a lawyer and took a job at a law firm. Three years later, she purchased the firm.</p>
										<?= $this->Text->autoParagraph(h($postTravlePackage->package_detail)); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-2">
									<label><?= __('Excluded Detail') ?></label>
									</div>
									<div class="col-md-10">
										<p>	Mellissa Dunn won a silver medal for the Australia women's national wheelchair basketball team at the 2000 Sydney Paralympics. Following this, she went on to qualify as a lawyer and took a job at a law firm. Three years later, she purchased the firm.</p>
											<?= $this->Text->autoParagraph(h($postTravlePackage->excluded_detail)); ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</fieldset>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
		
								
