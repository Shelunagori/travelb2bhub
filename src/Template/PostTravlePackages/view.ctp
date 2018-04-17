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

.contact{
	border-radius:20px;
	width:130px;
	text-align:center;
	background-color:#1295A2;
	color:white;
}

p{ 
	text-align:center;
	font-size:10px;
}

label{
	color:#676363;
	font-weight:600
}
hr{
	margin-top: 15px !important;
    margin-bottom: 4px !important;
}

.col-md-4{
	color:#676363;
	font-weight:600;
	 white-space: nowrap;
}

a{
	color:#ac85d6;
}
.modal-title{
font-size:20px;	
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
												$cityList.=$cities->city->name." ( ".$cities->city->state->state_name." )";
												$z++;
											}
									?>
					<div class="row">
					<form method="post" class="formSubmit">
					<input type="hidden" name="posttravle_id" value="<?php echo $postTravlePackage->id; ?>"/>
						<div class="col-md-12">
							<h3><?= h($postTravlePackage->title) ?></h3>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-3" >
								<?= $this->Html->image($postTravlePackage->full_image,['id'=>'myImg','style'=>'width:95%;height:80px;','data-target'=>'#imagemodal'.$postTravlePackage->id,'data-toggle'=>'modal',]) ?>
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
								</div><hr></hr>
								<div class="row" style="padding-top:5px;">
								<table  width="100%" style="text-align:center;" >
									<tr>
									<td width="25%" >
										<span>
										<?= $this->Html->image('../images/view.png',['style'=>'height:13px;']) ?>
										 
										<?= h($postTravlePackage->total_views);?></span>
									</td>
									<td width="25%">
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
									<td width="25%">
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
									<td width="25%">
									 
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
															</div><span class="help-block"></span>
															<div class="modal-footer" style="height:60px;">
																<input type="submit" class="btn btn-info btn-md" name="report_submit" value="Report">
																<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
															</div>
														</div>
													</div>
												</div>
											</tr>
										</table>
										</div>
									</div>
									<div class="col-md-9">
											<div class="row col-md-12 rowspace">
													<div class="col-md-12">
													<span style="color:#676363;font-weight:600;">Category :</span>
													<span ><?= h($CategoryList); ?></span>
													</div>
											</div>
											<div class="col-md-5">
												<div class="row rowspace">
													<div class="col-md-12 "><span style="color:#676363;font-weight:600;">Duration :</span> 
													<span style="color:#FB6542"><?= h($postTravlePackage->duration_day_night) ?></span>
													</div>
												</div>
												<div class="row rowspace">
													<div class="col-md-12 ">
													<span style="color:#676363;font-weight:600;"> Starting Price :</span>
													<span style="color:#1295AB">&#8377; <?php echo (h($postTravlePackage->starting_price)) ;?></span>
													</div>
												</div>
												<div class="row rowspace">
													<div class="col-md-12 "><span style="color:#676363;font-weight:600;">Seller :</span>
													<span><u>
															<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$postTravlePackage->user_id),1);?>
															<a style="color:#d69d5c" href="<?php echo $hrefurl; ?>"> 
															<?= h($postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name);?></u>
															<?php
															if($postTravlePackage->user_rating==0)
															{
																echo "";
															}
															else{
																	echo "(".$postTravlePackage->user_rating." <i class='fa fa-star'></i> )";
																}
															?></a>
														</span>
													</div>					
												</div>
											</div>
											<div class="col-md-7">
												<div class="row rowspace">
													<div class="col-md-12"><span style="color:#676363;font-weight:600;">Valid Till :</span>
													<span><?= h(date('d-M-Y',strtotime($postTravlePackage->valid_date))); ?></span>
													</div>					
												</div>	
												<div class="row rowspace">
													<div class="col-md-12 "><span style="color:#676363;font-weight:600;">Cities :</span>
													<span ><?= h($cityList); ?></span>
													</div>
												</div>
												<div class="row rowspace">
													<div class="col-md-12"><span style="color:#676363;font-weight:600;">Country :</span>	
													<span ><?=h($countryList); ?></span>
													</div>
												</div>
												
								<div class="row "  style="padding-top:15px;">						
									<div class="col-md-12 ">
									<?php
										echo $this->Html->link('<b>Contact Info</b>','address'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn  btn-info btn-md contact','data-target'=>'#contactdetails'.$postTravlePackage->id,'data-toggle'=>'modal'));?>
											<!-------Contact Details Modal --------->
											<div id="contactdetails<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
												<div class="modal-dialog modal-sm" >
													<!-- Modal content-->
														<div class="modal-content">
														  <div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
																<span class="modal-title">
																Seller Details
																</span>
																</div>
																<div class="modal-body" style="padding-left:15px!important;">
																	<span class="help-block"></span>
																	<div class="row">
																		<div class="col-md-12">
																			<label>Seller Name :<label>
																			<span style="padding-top:2px;">
																			<u>
																				<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$postTravlePackage->user_id),1);?>
																				<a style="color:#d69d5c" href="<?php echo $hrefurl; ?>"> 
																				<?= h($postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name);?></u>
																				<?php
																				if($postTravlePackage->user_rating==0)
																				{
																					echo "";
																				}
																				else{
																						echo "(".$postTravlePackage->user_rating." <i class='fa fa-star'></i> )";
																					}
																				?></a>
																			</span>
																			</div>					
																		</div>
																	<div class="row">
																		<div class="col-md-12">
																		<label>Mobile No :</label>
																		<span>
																		<?= h($postTravlePackage->user->mobile_number);?>
																		</span>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-12">
																			<label>Email :</label>
																			<span>
																			<a href="mailto:<?php echo $postTravlePackage->user->email;?>"><?= h($postTravlePackage->user->email);?></a>
																			</span>
																		</div>
																	</div>
																	<div class="row" style="display:none;">
																		<div class="col-md-12">
																			<div class="col-md-4">Location :</div>
																			<div class="col-md-8">
																			<?= h($postTravlePackage->user->location);?>
																			</div>
																		</div>
																	</div>
																	<span class="help-block"></span>
																</div>
																<div class="modal-footer">
																<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
																</div>
															</div>
														</div>
													</div>
										<!-------Contact Details Modal End--------->
												</div>
											</div>
										</div>
									</div>
													</div>
												</div>
											</form>
											</div>
											<hr></hr>
											<div class="row">
												<div class="col-md-12 ">
													<span style="color:#676363;font-weight:600;"><?= __('Including in Package') ?></span>
												</div>
											</div>
											<div class="row" style="padding-top:2px;">
												<div class="col-md-12">
													<?= h($postTravlePackage->package_detail); ?>
												</div>
											</div><hr></hr>
											<div class="row" style="padding-top:2px;">
												<div class="col-md-12 ">
														<span style="color:#676363;font-weight:600;"><?= __('Excluded from Package') ?></span>
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
								
