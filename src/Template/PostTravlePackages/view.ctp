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
<style>
.col-md-3{
	
	color:#838784;
	font-weight:bold;
}
.contact{
	border-radius:20px;
	width:130px;
	text-align:center;
	background-color:#1295A2;
}
.fleet{
	font-size:25px;	
	background-color:white;
	color:#909591;
	border:0px;
}
</style>
<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body"> 
						<div class="box-body">
						<?php foreach($postTravlePackage as $postTravlePackage):
									$CategoryList='';
									$x=0;
									foreach($postTravlePackage->post_travle_package_rows as $category)
										{
											if($x>=1){
												$CategoryList.=' , ';
											}
											$CategoryList.=$category->post_travle_package_category->name;
											$x++;
										}
											$countryList='';
											$y=0;
											foreach($postTravlePackage->post_travle_package_countries as $country)
											{
												if($y>=1){
													$countryList.=' , ';
												}
												$countryList.=$country->country->country_name;
												$y++;
											}
										
											$cityList='';
											$z=0;
											foreach($postTravlePackage->post_travle_package_cities as $cities)
											{
												if($z>=1){
													$cityList.=' , ';
												}
												$cityList.=$cities->city->name;
												$z++;
											}
									?>
									<div class="row">
										<div class="col-md-6">
											<h3><?= h($postTravlePackage->title) ?></h3>
										</div>
										<div class="col-md-6">
											<div class="row pull-right">
											<input type="hidden" name="taxifleet_id" value="<?php echo $postTravlePackage->id; ?>">
														<div class="row col-md-12">
														<div class="col-md-3">
														<?php 
														echo $this->Html->link('<i class="fa fa-eye fleet"></i>','/PostTravlePackages/view/'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn btn-primary btn-xs ','style'=>'background-color:white;border:0px;'));?>
														</div>
														<div class="col-md-3">
														<?php
														//pr($postTravlePackage);
															$dataUserId=$postTravlePackage->user_id;
															$isLiked=$postTravlePackage->isLiked;
															$issaved=$postTravlePackage->issaved;
															//-- LIKES DISLIKE
															if($isLiked=='no'){
																echo $this->Form->button('<i class="fa fa-heart-o like fleet" > </i>',['class'=>'btn btn-xs likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
															}
															if($isLiked=='yes'){
																echo $this->Form->button('<i class="fa fa-heart-o like fleet" > </i>',['class'=>'btn btn-danger btn-xs likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#F7F3F4;border:0px;']);
															}
														?>
														</div>
														<div class="col-md-3">
															<?php 
															//-- Save Unsave
															if($issaved=='1'){
																echo $this->Form->button('<i class="fa fa-bookmark-o fleet"></i>',['class'=>'btn btn-danger btn-xs  ','value'=>'button','type'=>'submit','name'=>'savetaxifleet','style'=>'background-color:white;color:black;border:0px;']);
															}
															if($issaved=='0'){
																echo $this->Form->button('<i class="fa fa-bookmark-o fleet"></i>',['class'=>'btn btn-primary btn-xs ','value'=>'button','style'=>'background-color:white;color:black;border:0px;','type'=>'submit','name'=>'savetaxifleet']);
															}
															?>
														</div>
														<div class="col-md-3">
											<?php echo $this->Html->link('<i class="fa fa-flag-o fleet"></i>','#'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','data-target'=>'#reportmodal'.$postTravlePackage->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
															<!-------Report Modal Start--------->
												<div id="reportmodal<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
													<div class="modal-dialog modal-md">
														<!-- Modal content-->
															<div class="modal-content">
															  <div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h3 class="modal-title">Report</h3>
															  </div>
																<div class="modal-body" style="height:150px;margin-top:30px;">
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
																	<a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'report')) ?>"class="btn btn-danger btn-md">Cancle</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											<!-------Report Modal End--------->	
												</div>
											</div>
										</div>
									</div>
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-4">
											<?= $this->Html->image($postTravlePackage->full_image,['style'=>'width:100%;height:300px;']) ?>
										</div>
										<div class="col-md-8">
											<div class="row">
												<div class="col-md-2">
													<label><?= __('Seller Name') ?></label>
													</div>
												<div class="col-md-4">
													<?= h($postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name);?>
													<?php
														if($postTravlePackage->user_rating==0)
														{
														echo "";
														}
														else{
														echo "(";
														for($i=0;$i<$postTravlePackage->user_rating;$i++)
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
													<?= h($postTravlePackage->duration_day_night) ?>
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
													<?= $this->Number->format($postTravlePackage->price_master->price).' &#8377;'?> 
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
								<div class="col-md-4">
								</div>
								<div class="col-md-1">
									<label><?= __('Package Detail') ?></label>
								</div>
								<div class="col-md-7">
									<?= $this->Text->autoParagraph(h($postTravlePackage->package_detail)); ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
								</div>
									<div class="col-md-1">
									<label><?= __('Excluded Detail') ?></label>
									</div>
									<div class="col-md-7">
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
		
								
