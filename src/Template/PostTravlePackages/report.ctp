<?php
//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/PostTravlePackages/getTravelPackages.json?isLikedUserId=".$user_id."&higestSort=".$higestSort."&country_id=".$country_id."&category_id=".$category_id."&duration_day_night=".$duration_day_night."&starting_price=".$starting_price."&submitted_from=web",
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
	//pr($List); exit;
	$postTravlePackages=$List->getTravelPackages;
}
//pr($postTravlePackages); exit;
//--- COUNTRY STATE & CITY
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."pages/masterCountry",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 39e47dc1-a66a-2347-2fc6-3b5e0160d26d"
  ),
));
$masterCountry = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$countries=array();
$states=array();
$city=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$masterCountry=json_decode($masterCountry);
	$countries=$masterCountry->countryData->ResponseObject;
	$states=$masterCountry->stateData->ResponseObject;
	$city=$masterCountry->cityData->ResponseObject;
}
//--- Category
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/post_travle_package_categories/index.json",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 39e85539-7745-db54-4f15-121a9d912dc7"
  ),
));
$responsecat = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $Category=json_decode($responsecat);
  $cat=$Category->postTravlePackageCategories;
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
<style type="text/css">
.lbwidth{
	color:#838784;
	font-weight:bold;

	}
fieldset{
	margin-bottom:5px !important;
	border-radius: 6px;
}
.
p{
	text-align:center;
	font-size:10px;
}

.row{
	line-height:15.0px;
}
.btnlayout{
	border-radius:20px !important;
	}
#myImg:hover {opacity: 0.7;}
.bbb{
	padding:0px!important;
	pading-bottom:10px!important;
}
</style>
<div class="row" >
	<div class="col-md-12">
	</div>
</div>
<div class="container-fluid">
	<div class="box box-primary" style="margin-bottom:5px;">
		<div class="row">
			<div class="col-md-12">
				<div class="box-header with-border"> 
					<span class="box-title" style="color:#057F8A;"><b><?= __('Package Promotions') ?></b></span>
					<div class="box-tools pull-right" style="margin-top:-5px;">
						<a style="font-size:26px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
						<a style="font-size:26px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="myModal123" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-sm">
				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Sorting</h4>
				  </div>
				  <form method="get" class="filter_box">
				  <div class="modal-body" style="height:130px;">
					<div class="col-md-12 row form-group ">
						<div class="col-md-12 radio">
							<label>
								<input class="btn btn-info btn-sm" type="radio" name="higestSort" value="user_rating"/>
								User Rating
							</label>
						</div>
					</div>
					<div class="col-md-12 row form-group ">
						<div class="col-md-12 radio">
							<label>
							<input class="btn btn-info btn-sm" type="radio" name="higestSort" value="total_likes"/>
								 Likes
							</label>
						</div>
					</div>
					 
					
					<div class="col-md-12 row form-group ">
						<div class="col-md-12 radio">
							<label>
								<input class="btn btn-info btn-sm" type="radio" name="higestSort" value="total_views"/>
								 Views
							</label>
						</div>
					</div>
					
				</div>
				<div class="modal-footer" style="height:60px;">
					  <div class="row">
							<div class="col-md-12 text-center">
								<input type="submit" class="btn btn-info btn-sm">
								<a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'report')) ?>"class="btn btn-danger  btn-sm">Reset</a>
							</div>
					  </div>
				</div>
				</form>
				</div>
				</div>
			</div>
			<div class="fade modal form-modal" id="myModal122" role="dialog">
			  <div class="modal-dialog modal-md">
				 <div class=modal-content>
					<div class=modal-header>
					   <button class="close" data-dismiss="modal" type="button">&times;</button>
					   <h4 class=modal-title>Filter</h4>
					</div>
					<form class="filter_box" method="get">
					<div class="modal-body">
						<div class="row form-group margin-b10">
							<div class=col-md-12>
								 <div class=col-md-3>
								  <label class="col-form-label"for=example-text-input>Country</label>
								  </div>
								  <div class=col-md-1>:</div>
								 <div class=col-md-7>
								<?php $options=array();
									foreach($countries as $country)
									{
										$options[] = ['value'=>$country->id,'text'=>$country->country_name];
									};echo $this->Form->input('country_id', ['options' => $options,'class'=>'form-control select2','label'=>false,'empty'=>'Select...']);
								?>
								</div>
							 </div>
							</div>
							<div class="row form-group margin-b10">
								<div class=col-md-12>
								  <div class=col-md-3>
								 <label class="col-form-label" for=example-text-input>Package Category</label>
								 </div>
								<div class=col-md-1>:</div>
								 <div class=col-md-7>
									<?php 
										$options=array();
										foreach($cat as $sts)
										{
											$options[] = ['value'=>$sts->id,'text'=>$sts->name];
										};
										echo $this->Form->control('category_id', ['label'=>false,"id"=>"multi_category", "type"=>"select",'options' =>$options, "class"=>"form-control select2","data-placeholder"=>"Select... ","style"=>"height:125px;",'empty'=>'Select...']);?>
								 </div>
								</div>	
							</div>
							<div class="row form-group margin-b10">
								<div class=col-md-12>
								  <div class=col-md-3>
								 <label class="col-form-label" for=example-text-input>Duration Night</label>
								 </div>
								<div class=col-md-1>:</div>
								 <div class=col-md-7>
									<select name="duration_day_night" class="form-control select2">
										<option value="">Select...</option>
										<option>1 Night 2 Days</option>
										<option>2 Night 3 Days</option>
										<option>3 Night 4 Days</option>
										<option>4 Night 5 Days</option>
										<option>5 Night 6 Days</option>
										<option>6 Night 7 Days</option>
										<option>7 Night 8 Days</option>
										<option>8 Night 9 Days</option>
										<option>9 Night 10 Days</option>
										<option>10 Night 11 Days</option>
										<option>11 Night 12 Days</option>
										<option>12 Night 13 Days</option>
										<option>13 Night 14 Days</option>
										<option>14 Night 15 Days</option>
										<option>More than 15 Days</option>
									</select>
								 </div>
								</div>	
							</div>
							<div class="row form-group margin-b10">
								<div class=col-md-12>
								  <div class=col-md-3>
								 <label class="col-form-label" for=example-text-input>Starting Price</label>
								 </div>
								<div class=col-md-1>:</div>
								 <div class=col-md-7>
									 <?php echo $this->Form->input('starting_price',['class'=>'form-control','label'=>false,'placeholder'=>'Starting Price']);?> 
								 </div>
								</div>	
							</div>
						  </div>
						<div class="modal-footer">
							<button class="btn btn-info btn-sm" name="submit" value="Submit" type="submit">Filter</button> 
							<a href="<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'report')) ?>"class="btn btn-danger  btn-sm">Reset</a>
						</div>
					</form>
				</div>
			  </div>
			</div>
		<?php $i=1;
					//pr($postTravlePackages); exit;			
					if(!empty($postTravlePackages)){
						foreach ($postTravlePackages as $postTravlePackage): 
							$CategoryList='';
							$x=0;
							foreach($postTravlePackage->post_travle_package_rows as $category)
								{
									if($x>=1){
										$CategoryList.=', ';
									}
									$CategoryList.=$category->post_travle_package_category->name;
									$x++;
								}
											
										
											$cityList='';
											$z=0;
											foreach($postTravlePackage->post_travle_package_cities as $cities)
											{
												if($z>=1){
													$cityList.=', ';
												}
												$cityList.=$cities->city->name;
												$z++;
											}
						?>

<div class="box-body bbb">
 <fieldset style="background-color:#fff;">
	<form method="post">
		<div class="row" >
			<div class="col-md-5" style="padding-top:5px;">
			<span style="font-size:18px;"><b><?= h($postTravlePackage->title) ?></b></span>
			</div>
			<div class="col-md-4 pull-right" >
			<div class="row" style="padding-top:5px;">						
					<div class="col-md-12 ">
						<button class="btn btn-info btn-md btnlayout" data-target="#Inclusion<?php echo $postTravlePackage->id;?>" data-toggle="modal">&nbsp;&nbsp;Inclusion</button>
							<!-------Report Modal Start--------->
							<div id="Inclusion<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-md">
									<!-- Modal content-->
										<div class="modal-content">
										  <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h3 class="modal-title"> Including in Package</h3>
										  </div>
											<div class="modal-body" >
												<span class="help-block"></span>
												<div class="row">
													<div class="col-md-12">
														<label style="padding:20px;"><?= h($postTravlePackage->package_detail); ?></label>
													</div>
												</div>
											</div>
											<div class="modal-footer" >
												<button type="button" class="btn btn-danger btn-md " data-dismiss="modal">Cancel</button>
											</div>
										</div>
									</div>
								</div>
								<button class="btn btn-danger btn-md btnlayout" data-target="#Exclusion<?php echo $postTravlePackage->id;?>" data-toggle="modal">&nbsp;&nbsp;Exclusion</button>
								<!-------Report Modal Start--------->
								<div id="Exclusion<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md">
										<!-- Modal content-->
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h3 class="modal-title"> Excluded from Package</h3>
											  </div>
												<div class="modal-body" >
													<span class="help-block"></span>
													<div class="row">
														<div class="col-md-12">
															<label style="padding:20px;"><?= h($postTravlePackage->excluded_detail); ?></label>
														</div>
													</div>
												</div>
												<div class="modal-footer" >
													<button type="button" class="btn btn-danger btn-md " data-dismiss="modal">Cancel</button>
												</div>
											</div>
										</div>
									</div>
									<button class="btn btn-warning btn-md  btnlayout" data-target="#contactdetails<?php echo $postTravlePackage->id;?>" data-toggle="modal">&nbsp;&nbsp;Contact Info</button>
											<!-------Contact Details Modal --------->
											<div id="contactdetails<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
												<div class="modal-dialog modal-md" >
													<!-- Modal content-->
														<div class="modal-content">
														  <div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h3 class="modal-title">
																Seller Details
																</h3>
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
																			<label><?= h($postTravlePackage->user->email);?></label>
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
	
			<div class="row">						
				<div class="col-md-3">
				<?= $this->Html->image($postTravlePackage->full_image,['id'=>'myImg','style'=>'width:100%;height:120px;','data-target'=>'#imagemodal'.$postTravlePackage->id,'data-toggle'=>'modal',]) ?>
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
						<input type="hidden" name="posttravle_id" value="<?php echo $postTravlePackage->id; ?>">
							<table  width="100%" style="text-align:center;" >
								<tr>
									<td width="25%" >
										<span><img src="../images/view.png" height="15px"/>
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
												echo $this->Form->button('<img src="../images/unlike.png" height="15px"/>',['class'=>'btn btn-xs likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
											}
											if($isLiked=='yes'){
												echo $this->Form->button('<img src="../images/like.png" height="15px"/>',['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','name'=>' ','style'=>'background-color:white;color:#000;border:0px;']);
											}
										?>
										<?= h($postTravlePackage->total_likes);?></span>
									</td>
									<td width="25%">
									<?php 
											//-- Save Unsave
											if($issaved=='1'){
												echo $this->Form->button('<img src="../images/save.png" height="15px"/>',['class'=>'btn btn-xs','value'=>'button','type'=>'submit','name'=>'saveposttravle','style'=>'background-color:white;color:black;border:0px;']);
											}
											if($issaved=='0'){
												echo $this->Form->button('<img src="../images/unsave.png" height="15px"/>',['class'=>'btn  btn-xs','value'=>'button','style'=>'background-color:white;color:black;border:0px;','type'=>'submit','name'=>'saveposttravle']);
											}
											?>
											<span style="visibility:hidden;">3</span>
									</td>
									<td width="25%">
										<?php echo $this->Html->link('<img src="../images/flag.png" height="15px"/>','#'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#reportmodal'.$postTravlePackage->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
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
											</tr>
										</table>
									</div>
								</div>
										<!--------------------image modal--------------------->
										<div id="myModal" class="modal1" style="display:none;">
											  <span class="close">&times;</span>
											  <img class="modal-content1" id="img01">
											  <div id="caption"></div>
										</div>
										<!--------------------image modal End--------------------->
										<div class="col-md-9" style="padding-top:5px;">
											<div class="col-md-6">
												<div class="row ">
													<div class="col-md-4 lbwidth">Category :</div>		
													<div class="col-md-8 lbwidth11"><label><?= h($CategoryList); ?></label>
													</div>
												</div>
												<div class="row ">
													<div class="col-md-4 lbwidth">Duration :</div>		
													<div class="col-md-8 lbwidth11"><label style="color:#FB6542"><?= h($postTravlePackage->duration_day_night) ?></label>
													</div>
												</div>
												<div class="row ">
													<div class="col-md-4 lbwidth">Starting Price :</div>
													<div class="col-md-8 lbwidth11"><label style="color:#1295AB">&#8377; <?php echo number_format(h($postTravlePackage->starting_price)) ;?></label>
													</div>
												</div>
												<div class="row ">
													<div class="col-md-4 lbwidth">Valid Till :</div>	
													<div class="col-md-8 lbwidth11"><label><?= h(date('d-M-Y',strtotime($postTravlePackage->valid_date))); ?></label>
													</div>					
												</div>	
											</div>
											<div class="col-md-6">
												<div class="row ">
													<div class="col-md-4 lbwidth">Cities :</div>		
													<div class="col-md-8 lbwidth11"><label ><?= h($cityList); ?></label>
													</div>
												</div>
												<div class="row ">
													<div class="col-md-4 lbwidth">Country :</div>		
													<div class="col-md-8 lbwidth11"><label >India<?php //echo $postTravlePackage->country->country_name; ?></label>
													</div>
												</div>
												<div class="row ">
													<div class="col-md-4 lbwidth">Seller :</div>		
													<div class="col-md-8 lbwidth11"><label>
													<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$postTravlePackage->user_id),1);?>
													<a href="<?php echo $hrefurl; ?>"> 
													<?php echo $postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name.' ( '.$postTravlePackage->user_rating.'<i class="fa fa-star"></i> )';?>
													</a>
													</label>
													</div>					
												</div>
											</div>
										</div>
									</div>
								</form>
							</fieldset>
						</div>
					<?php $i++; endforeach; }
						else
					{
						echo"<div class='row col-md-12 text-center'><tr><th colspan='10' ><span>No Record Found</span></th></tr></div>";
					}							?>
			<table class="maintbl" width="100%">
				<tbody>
				</tbody>
			</table>
			<div class="col-md-12 text-center loading" style="display:none">
				<?=  $this->Html->image('/img/loading.gif', ['style'=>'width:5%;']) ?> .
			</div>
				</div>
			</div>
<input type="hidden" id="page" value="2">
<input type="hidden" value="<?php $user_id; ?>" id="user_id">
<input type="hidden" value="<?php $higestSort; ?>" id="higestSort">
<input type="hidden" value="<?php $country_id; ?>" id="country_id">
<input type="hidden" value="<?php $category_id; ?>" id="category_id">
<input type="hidden" value="<?php $duration_day_night; ?>" id="duration_day_night">
<input type="hidden" value="<?php $starting_price; ?>" id="starting_price">
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script type="text/javascript">	
	
	$(document).ready(function(){
		/*$(window).scroll(function() {
			var schorll = $(this).scrollTop();
			var scrollTop = $(window).scrollTop();
			var docHeight = $(document).height();
			var winHeight = $(window).height();
			var scrollPercent = (scrollTop) / (docHeight - winHeight);
			var scrollPercentRounded = Math.round(scrollPercent*100);
 			if ( scrollPercentRounded == 70 ) {
 				var t = $("#page").val();
				$('.loading').show();
 				var starting_price = $("#starting_price").val();
				var duration_day_night = $("#duration_day_night").val();
				var category_id = $("#category_id").val();
				var country_id = $("#country_id").val();
				var higestSort = $("#higestSort").val();
				var user_id = $("#user_id").val();
				$.ajax({
					url: "<?php echo $this->Url->build(array('controller'=>'PostTravlePackages','action'=>'moredata')) ?>",
					type: "POST",
					data: {
						user_id: user_id,
						higestSort: higestSort,
						country_id: country_id,
						category_id: category_id,
						duration_day_night: duration_day_night,
						starting_price: starting_price, 
						page: t
					}
				}).done(function(e) {
 					$('.loading').hide();
					var pagenew = parseInt(t)+1;
					if(e=='No More Data'){
					}
					else{
					$('.maintbl').find('tbody').append(e);
					}
					$("#page").val(pagenew);
				});
			}
		});*/
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
