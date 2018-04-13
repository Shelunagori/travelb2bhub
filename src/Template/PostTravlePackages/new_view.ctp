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
.lbwidth{
	color:#716D6F;
	font-weight:bold;
	white-space: nowrap;
	font-size:16px;
	}
	label{
	font-weight: 100;
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
					<form method="post" class="formsubmit">
					<input type="hidden" name="posttravle_id" value="<?php echo $postTravlePackage->id; ?>"/>
						<div class="col-md-12">
							<h3><?= h($postTravlePackage->title) ?></h3>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6" >
								<?= $this->Html->image($postTravlePackage->full_image,['id'=>'myImg','style'=>'width:95%;height:200px;','data-target'=>'#imagemodal'.$postTravlePackage->id,'data-toggle'=>'modal',]) ?>
								<div id="imagemodal<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-md">
									<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-body" >
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<?= $this->Html->image($postTravlePackage->full_image,['style'=>'width:100%;height:300px;padding:20px;padding-top:0px!important;']) ?>
											</div>
										</div>
									</div>
								</div>
								<div class="row" style="padding-top:5px;">
								<table  width="100%" style="text-align:center;" >
									<tr>
									<td width="15%" >
										<span>
										<?= $this->Html->image('../images/view.png',['style'=>'height:15px;']) ?>
										 
										<?= h($postTravlePackage->total_views);?></span>
									</td>
									<td width="15%">
										<span ><?php
										//
											$dataUserId=$postTravlePackage->user_id;
											$isLiked=$postTravlePackage->isLiked;
											$issaved=$postTravlePackage->issaved;
											//-- LIKES DISLIKE
											if($isLiked=='no'){
												echo $this->Form->button($this->Html->image('../images/unlike.png',['style'=>'height:15px;']),['class'=>'btn btn-xs likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
											}
											if($isLiked=='yes'){
												echo $this->Form->button($this->Html->image('../images/like.png',['style'=>'height:15px;']),['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>'LikeEvent','style'=>'background-color:white;color:#000;border:0px;']);
											}
										?>
										<?= h($postTravlePackage->total_likes);?></span>
									</td>
									<td width="15%">
									<?php 
											//-- Save Unsave
											if($issaved=='1'){
												echo $this->Form->button($this->Html->image('../images/save.png',['style'=>'height:15px;']),['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>' saveposttravle','style'=>'background-color:white;color:#000;border:0px;']);
											}
											if($issaved=='0'){
												echo $this->Form->button($this->Html->image('../images/unsave.png',['style'=>'height:15px;']),['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>'saveposttravle','style'=>'background-color:white;color:#000;border:0px;']);
												
												//echo $this->Html->link($this->Html->image('../images/unsave.png',['style'=>'height:15px;']),'#'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#reportmodal'.$postTravlePackage->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;','name'=>'saveposttravle'));
											}
											?>
											<span style="visibility:hidden;">3</span>
									</td>
									<td width="15%">
									 
										<?php echo $this->Html->link($this->Html->image('../images/flag.png',['style'=>'height:15px;']),'#'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#reportmodal'.$postTravlePackage->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
										<span style="visibility:hidden;">3</span>
									</td>
										<!--------Hidden Field Delete-------------------> 			
											<div style="display:none;">
												<?php 
												if($dataUserId==$user_id){
													echo $this->Html->link('<i class="fa fa-trash" > Delete</i>','api address'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#deletemodal'.$postTravlePackage->id,'data-toggle'=>'modal'));?>
												<!-------Delete Modal Start--------->
													<div id="deletemodal<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
														<div class="modal-dialog modal-md" >
															<!-- Modal content-->
																<div class="modal-content">
																  <div class="modal-header" style="height:100px;">
																		<button type="button" class="close" data-dismiss="modal">&times;</button>
																		<h4 class="modal-title">
																		Are You Sure, you want to delete this promotion ?
																		</h4>
																	</div>
																	<div class="modal-footer" style="height:60px;">
																		<button type="submit" class="btn btn-danger" name="removeposttravle" value="yes" >Yes</button>
																		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
																	</div>
																</div>
															</div>
														</div>
												<!-------Delete Modal End--------->	
												<?php }?>
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
																<input type="submit" class="btn btn-info btn-md" name="report_submit" value="Report">
																<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
															</div>
														</div>
													</div>
												</div>
												<td width="40%" >
												
													<?php
													echo $this->Html->link('<b>Contact Info</b>','address'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn  btn-info btn-md contact','data-target'=>'#sellerdetails'.$postTravlePackage->id,'data-toggle'=>'modal'));?>
												
												</td>
											</tr>
										</table>
										
										</div>
										</div><br>
										<div class="col-md-6">
												<div class="row col-md-12">
													<div class="col-md-4 ">Seller :</div>		
													<div class="col-md-8 "><label>
													<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$postTravlePackage->user_id),1);?>
													<a href="<?php echo $hrefurl; ?>"> 
													<?php echo $postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name.' ( '.$postTravlePackage->user_rating.' <i class="fa fa-star"></i> )';?>
													</a>
													</label>
													</div>					
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Category') ?>:</div>
													<div class="col-md-8">
														<label><?= h($CategoryList);?></label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Cities') ?>:</div>
													<div class="col-md-8">
														<label><?= h($cityList); ?></label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Package Duration') ?>:</div>
													<div class="col-md-8">
														<label style="color:#FB6542">	<?= h($postTravlePackage->duration_day_night) ?></label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Starting Price') ?>:</div>
													<div class="col-md-8">
														<label style="color:#1295A2"><?= $this->Number->format($postTravlePackage->starting_price).' &#8377;'; ?></label>
													</div>
												</div>
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Valid Till') ?>:</div>
													<div class="col-md-8">
														<label><?= date('d-M-Y',strtotime($postTravlePackage->valid_date) );?></label>
													</div>
												</div>
												
												<div class="row col-md-12">
													<div class="col-md-4"><?= __('Country') ?>:</div>
													<div class="col-md-8">
														<label>	<?= h($countryList); ?></label>
													</div>
												</div>
												
												<!-------Contact Details Modal --------->
												<div id="sellerdetails<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
													<div class="modal-dialog modal-md" >
														<!-- Modal content-->
															<div class="modal-content">
															  <div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title">
																	Seller Details
																	</h4>
																	</div>
																<div class="modal-body">
																	<span class="help-block"></span>
																	<div class="row">
																		<div class="col-md-12">
																			<div class="col-md-4">Seller Name :</div>
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
																							echo "<i class='fa fa-star' style='font-size:10px;color:#efea65;'></i>";
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
																	</div>
																	<div class="row">
																		<div class="col-md-12">
																		<div class="col-md-4">Mobile No :</div>
																		<div class="col-md-8">
																		<label><?= h($postTravlePackage->user->mobile_number);?></label>
																		</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-12">
																			<div class="col-md-4">Email :</div>
																			<div class="col-md-8">
																			<label><a href="mailto:<?php echo $postTravlePackage->user->email;?>"><?= h($postTravlePackage->user->email);?></a></label>
																			</div>
																		</div>
																	</div>
																	<div class="row" style="display:none;">
																		<div class="col-md-12">
																			<div class="col-md-4">Location :</div>
																			<div class="col-md-8">
																			<label><?= h($postTravlePackage->user->location);?></label>
																			</div>
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
														</div>
													</div>
												</div>
											</form>
											</div>
											<hr></hr>
											<div class="row">
												<div class="col-md-12 lbwidth">
														<label><?= __('Including in Package') ?></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<?= h($postTravlePackage->package_detail); ?>
												</div>
											</div><hr></hr>
											<div class="row">
												<div class="col-md-12 lbwidth">
														<label><?= __('Excluded from Package') ?></label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<?= (h($postTravlePackage->excluded_detail)); ?>
												</div>
											</div>
									<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
				<div id="loader"></div></div>
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
	jQuery(".formSubmit").submit(function(){
						jQuery("#loader-1").show();
					});
  });
</script>		
								
