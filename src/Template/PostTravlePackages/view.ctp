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
<style>

.col-md-4{
	
	color:#838784;
	font-weight:bold;
}
.contact{
	border-radius:20px;
	width:130px;
	text-align:center;
	background-color:#1295A2;
	color:white;
}
.fleet{
	font-size:21px;	
	background-color:white;
	color:#909591;
	border:0px;
}

.unfleet{
	font-size:21px;	
	background-color:white;
	color:#d33c44;
	border:0px;
}
p{ 
	text-align:center;
	font-size:10px;
}
</style>
<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body"> 
							<?php
							foreach($postTravlePackage as $postTravlePackage):
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
										<form method="post">
										<div class="row pull-right text-center">
										<input type="hidden" name="posttravle_id" value="<?php echo $postTravlePackage->id; ?>">
										<div>
										<div class="col-md-3">
											<i style="font-size: 24px !important;" class="fa fa-eye fleet"></i>
										<p>
											<?php echo $postTravlePackage->total_views; ?>
											<br> 
											Views
										</p>
										</div>
										<div class="col-md-3">
										<?php
											$dataUserId=$postTravlePackage->user_id;
											$isLiked=$postTravlePackage->isLiked;
											$issaved=$postTravlePackage->issaved;
											//-- LIKES DISLIKE
											if($isLiked=='no'){
												echo $this->Form->button('<i class="fa fa-heart-o like fleet" > </i>',['class'=>'btn btn-xs likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
											}
											if($isLiked=='yes'){
												echo $this->Form->button('<i class="fa fa-heart-o like unfleet" > </i>',['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#F7F3F4;border:0px;']);
											}
										?>
										<p>
										<?php echo $postTravlePackage->total_likes; ?>
										<br> 
										Likes
										</p>
										</div>
										<div class="col-md-3">
											<?php 
											//-- Save Unsave
											if($issaved=='1'){
												echo $this->Form->button('<i class="fa fa-bookmark-o unfleet"></i>',['class'=>'btn  btn-xs  ','value'=>'button','type'=>'submit','name'=>'saveposttravle','style'=>'background-color:white;color:black;border:0px;']);
											}
											if($issaved=='0'){
												echo $this->Form->button('<i class="fa fa-bookmark-o fleet"></i>',['class'=>'btn  btn-xs ','value'=>'button','style'=>'background-color:white;color:black;border:0px;','type'=>'submit','name'=>'saveposttravle']);
											}
											?>
										</div>
										<div class="col-md-3">
										<?php echo $this->Html->link('<i class="fa fa-flag-o fleet"></i>','#'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn btn-xs','data-target'=>'#reportmodal'.$postTravlePackage->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
														 
											</div>
										</div>
									</div>
									<div id="reportmodal<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
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
																	<textarea class="form-control " rows="3" type="text" placeholder="Enter your reason here..." name="comment"></textarea>	
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="modal-footer" style="height:60px;">
														<input type="submit" class="btn btn-primary btn-md" name="report_submit" value="Report">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Cancle</button>
													</div>
												</div>
											</div>
										</div>
										<!-------Report Modal End--------->	
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-6">
											<?= $this->Html->image($postTravlePackage->full_image,['style'=>'width:100%;height:300px;']) ?>
										</div>
										<div class="col-md-6">
											<fieldset>
												<div class="row col-md-12">
													<div class="col-md-4">Seller Name </div><div class="col-md-1">:</div>		
													<div class="col-md-7">
														<label>
															<u >
															<?= h($postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name);?>
															</u>
																<?php
																	if($postTravlePackage->user_rating==0)
																	{
																		echo "";
																	}
																	else{
																		echo "( ";
																		for($i=0;$i<$postTravlePackage->user_rating;$i++)
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
													<div class="col-md-4"><?= __('Category') ?></div>
													<div class="col-md-1">:</div>		
													<div class="col-md-7">
														<label><?= h($CategoryList);?></label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Cities') ?></div>
													<div class="col-md-1">:</div>		
													<div class="col-md-7">
														<label><?= h($cityList); ?></label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Package Duration') ?></div>
													<div class="col-md-1">:</div>		
													<div class="col-md-7">
														<label style="color:#FB6542">	<?= h($postTravlePackage->duration_day_night) ?></label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Starting Price') ?></div>
													<div class="col-md-1">:</div>		
													<div class="col-md-7">
														<label style="color:#1295A2"><?= $this->Number->format($postTravlePackage->starting_price).' &#8377;'; ?></label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Valid Till') ?></div>
													<div class="col-md-1">:</div>		
													<div class="col-md-7">
														<label><?= date('d-M-Y',strtotime($postTravlePackage->valid_date) );?></label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Promotion Duration') ?></div>
													<div class="col-md-1">:</div>		
													<div class="col-md-7">
														<label>	<?=h($postTravlePackage->price_master->week)?></label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Total Charges') ?></div>
													<div class="col-md-1">:</div>		
													<div class="col-md-7">
														<label>	<?= $this->Number->format($postTravlePackage->price_master->price).' &#8377;'?> </label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Visible Date') ?></div>
													<div class="col-md-1">:</div>		
													<div class="col-md-7">
														<label>	<?= date('d-M-Y',strtotime($postTravlePackage->visible_date) );?> </label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Country') ?></div>
													<div class="col-md-1">:</div>		
													<div class="col-md-7">
														<label>	<?= h($countryList); ?></label>
													</div>
												</div>
												<div class="row col-md-12 text-center">
													<?php
													echo $this->Html->link('<b>Contact Info</b>','address'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn  btn-md contact','data-target'=>'#deletemodal'.$postTravlePackage->id,'data-toggle'=>'modal'));?>
												</div>
												<!-------Contact Details Modal --------->
												<div id="deletemodal<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
													<div class="modal-dialog" style="width:30%">
														<!-- Modal content-->
															<div class="modal-content">
															  <div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title">
																	Seller Details
																	</h4>
																	</div>
																	<div class="modal-body" style="height:100px;">
																		<div class="row col-md-12">
																			<div class="col-md-3">Seller Name </div><div class="col-md-1">:</div>		
																			<div class="col-md-8">
																				<label>
																					
																					<?= h($postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name);?>
																					
																					<?php
																					if($postTravlePackage->user_rating==0)
																					{
																						echo "";
																					}
																					else{
																						echo "( ";
																						for($i=0;$i<$postTravlePackage->user_rating;$i++)
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
																			<div class="col-md-3">Mobile No </div>
																			<div class="col-md-1">:	</div>
																			<div class="col-md-8">
																			<label><?= h($postTravlePackage->user->mobile_number);?></label>
																			</div>
																		</div>
																		<div class="row col-md-12">
																			<div class="col-md-3">Email</div>
																			<div class="col-md-1">:	</div>
																			<div class="col-md-8">
																			<label><?= h($postTravlePackage->user->email);?></label>
																			</div>
																		</div>
																	</div>
																	<div class="modal-footer" style="height:60px;">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancle</button>
																</div>
																</div>
															</div>
														</div>
															<!-------Contact Details Modal End--------->	
															</fieldset>
														</div>
													</div>
												</div>
											</div>
											<span class="help-block"></span>
											<div class="row">
												<div class="col-md-12">
														<label><b><?= __('Package Details') ?></b></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<?= h($postTravlePackage->package_detail); ?>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
														<label><b><?= __('Excluded Details') ?></b></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<?= (h($postTravlePackage->excluded_detail)); ?>
												</div>
											</div>
									<?php endforeach; ?>
									</form>
								</fieldset>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
	<script type="text/javascript">	
	
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
		document.addEventListener('DOMContentLoaded', function(){
        var imgs = document.querySelectorAll('img');
        Array.prototype.forEach.call(imgs, function(el, i) {
            if (el.tabIndex <= 0) el.tabIndex = 10000;
        });
    });
  });
</script>		
								
