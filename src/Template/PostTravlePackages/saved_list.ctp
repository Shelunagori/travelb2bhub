<?php //echo $this->Html->css('/assets/loader-1.css'); ?>
<?php
//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/PostTravlePackageCarts/postTravlePackageCartlist.json?user_id=".$user_id."&submitted_from=web",
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
	$postTravlePackages=$List->postTravelPackageCarts;
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

fieldset{
	margin-bottom:5px !important;
	border-radius: 6px;
}
.modal-title{
font-size:20px;	
}

.row{
	line-height:15.0px;
}
.btnlayout{
	border-radius:15px !important;
	}
#myImg:hover {opacity: 0.7;}
.bbb{
	padding:0px!important;
	pading-bottom:10px!important;
}
.rowspace{
	padding-top:5px;
	font-size:14px;
}
.rowspacemodal{
	padding:10px;
	font-size:14px;
}
hr{
	margin-top: 15px !important;
    margin-bottom: 4px !important;
}
label{
	color:#676363;
	font-weight:600
}

.col-md-4{
	color:#676363;
	font-weight:600;
	
}

a{
	color:#ac85d6;
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
					<span class="box-title" style="color:#057F8A;"><b>Package Promotions</b></span>
					<div class="box-tools pull-right" style="margin-top:-5px;">
					</div>
				</div>
			</div>
		</div>
	</div>
	 <?php $i=1;
				if(!empty($postTravlePackages)){
					//pr($postTravlePackages);exit;
				foreach ($postTravlePackages as $postTravlePackagess){
					$postTravlePackage=$postTravlePackagess->post_travle_package;
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
									$countryList='';
											$p=0;
											foreach($postTravlePackage->post_travle_package_countries as $countries)
											{
												//pr($cities);exit;
												if($p>=1){
													$countryList.=', ';
												}
												$countryList.=$countries->country->country_name;
												$p++;
											}		
										
									$cityList='';
									$z=0;
									foreach($postTravlePackage->post_travle_package_cities as $cities)
									{
										if($z>=1){
											$cityList.=', ';
										}
										$cityList.=$cities->city->name." ( ".$cities->city->state->state_name." )";
										$z++;
									}
						?>

<div class="box-body bbb">
 <fieldset style="background-color:#fff;">
	<form method="post" class="formSubmit">
		<div class="row">
			<div class="col-md-12" style="padding-top:5px;">
			<span style="font-size:17px;"><?= h($postTravlePackage->title) ?></span>
			</div>
			</div>
			<div class="row ">						
				<div class="col-md-3 rowspace">
				<?= $this->Html->image($postTravlePackage->full_image,['id'=>'myImg','style'=>'width:100%;height:80px;','data-target'=>'#imagemodal'.$postTravlePackage->id,'data-toggle'=>'modal',]) ?>
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
						<input type="hidden" name="posttravle_id" value="<?php echo $postTravlePackage->id; ?>">
							<table  width="100%" style="text-align:center;" >
								<tr>
									<td width="25%" >
										<span>
										<?php echo $Image=$this->Html->image('../images/view.png',['height'=>'13px']);?>
										<?= h($postTravlePackagess->total_views);?></span>
									</td>
									<td width="25%">
										<span ><?php
										//
											$dataUserId=$postTravlePackagess->user_id;
											$isLiked=$postTravlePackagess->isLiked;
											$issaved=$postTravlePackagess->issaved;
											//-- LIKES DISLIKE
											if($isLiked=='no'){
												$Image=$this->Html->image('../images/unlike.png',['height'=>'15px']);
												echo $this->Form->button($Image,['class'=>'btn btn-xs likes','value'=>'button','style'=>'background-color:white;color:#F7F3F4;border:0px;','type'=>'submit','name'=>'LikeEvent']);
											}
											if($isLiked=='yes'){
												$Image=$this->Html->image('../images/like.png',['height'=>'15px']);
												echo $this->Form->button($Image,['class'=>'btn btn-xs likes','value'=>'button','type'=>'submit','style'=>'background-color:white;color:#000;border:0px;','name'=>'LikeEvent']);
											}
										?>
										<?= h($postTravlePackagess->total_likes);?></span>
									</td>
									<td width="25%">
									<?php 
											//-- Save Unsave
											if($issaved=='1'){
												$Image=$this->Html->image('../images/save.png',['height'=>'15px']);
												echo $this->Form->button($Image,['class'=>'btn btn-xs','value'=>'button','type'=>'submit','name'=>'saveposttravle','style'=>'background-color:white;color:black;border:0px;']);
											}
											if($issaved=='0'){
												$Image=$this->Html->image('../images/unsave.png',['height'=>'15px']);
												echo $this->Form->button($Image,['class'=>'btn  btn-xs','value'=>'button','style'=>'background-color:white;color:black;border:0px;','type'=>'submit','name'=>'saveposttravle']);
											}
											?>
											<span style="visibility:hidden;">3</span>
									</td>
									<td width="25%">
										<?php 
										$Image=$this->Html->image('../images/flag.png',['height'=>'15px']);
										echo $this->Html->link($Image,'#'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn  btn-xs','data-target'=>'#reportmodal'.$postTravlePackage->id,'data-toggle'=>'modal','style'=>'background-color:white;color:black;border:0px;'));?>
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
															<span class="modal-title">Report</span>
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
																					echo $this->Form->control('report_reason_id', ['span'=>false, "type"=>"select",'options' =>$options, "class"=>"form-control select2 reason_box","data-placeholder"=>"Select... ","style"=>"height:125px;",'empty'=>"Select..."]);
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
																<span class="help-block"></span>
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
													<span style="color:#1295AB">&#8377; <?php echo number_format(h($postTravlePackage->starting_price)) ;?></span>
													</div>
												</div>
												<div class="row rowspace">
													<div class="col-md-12 "><span style="color:#676363;font-weight:600;">Seller :</span>
													<span>
														<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$postTravlePackage->user_id),1);?>
														<a href="<?php echo $hrefurl; ?>"> 
														<?php echo "<u>".$postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name.'</u> ( '.$postTravlePackagess->user_rating.' <i class="fa fa-star"></i> )';?>
														</a>
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
													<span ><?php echo "India"//$postTravlePackage->country->country_name; ?></span>
													</div>
												</div>
												
					<div class="row "  style="padding-top:15px;">						
					<div class="col-md-12 ">
						<button class="btn btn-info btn-md btnlayout" data-target="#Inclusion<?php echo $postTravlePackage->id;?>" data-toggle="modal" type="button">Inclusion</button>
							<!-------Report Modal Start--------->
							<div id="Inclusion<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-md">
									<!-- Modal content-->
										<div class="modal-content">
										  <div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<span class="modal-title">Including in Package</span>
										  </div>
											<div class="modal-body" >
												<div class="row ">
													<div class="col-md-12" style="padding:15px;">
													<div class="col-md-12">
														<span ><?= h($postTravlePackage->package_detail); ?></span>
													</div>
													</div>
												</div>
											</div>
											<div class="modal-footer" >
												<button type="button" class="btn btn-danger btn-md " data-dismiss="modal">Cancel</button>
											</div>
										</div>
									</div>
								</div>
								<button class="btn btn-warning btn-md btnlayout" data-target="#Exclusion<?php echo $postTravlePackage->id;?>" data-toggle="modal" type="button">Exclusion</button>
								<!-------Report Modal Start--------->
								<div id="Exclusion<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-md">
										<!-- Modal content-->
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<span class="modal-title">Excluded from Package</span>
											  </div>
												<div class="modal-body" >
													<div class="row ">
														<div class="col-md-12" style="padding:15px;">
														<div class="col-md-12">
															<span ><?= h($postTravlePackage->excluded_detail); ?></apan>
														</div>
														</div>
													</div>
												</div>
												<div class="modal-footer" >
													<button type="button" class="btn btn-danger btn-md " data-dismiss="modal">Cancel</button>
												</div>
											</div>
										</div>
									</div>
									<button class="btn btn-danger btn-md  btnlayout" data-target="#contactdetails<?php echo $postTravlePackage->id;?>" data-toggle="modal" type="button">Contact Info</button>
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
																	<div class="row" >
																		<div class="col-md-12"><label>Seller Name :</label>
																		<span style="padding-top:2px;"><u>
																				<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$postTravlePackage->user_id),1);?>
																				<a style="color:#d69d5c" href="<?php echo $hrefurl; ?>"> 
																				<?= h($postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name);?></u>
																				<?php
																				if($postTravlePackagess->user_rating==0)
																				{
																					echo "";
																				}
																				else{
																						echo "(".$postTravlePackagess->user_rating." <i class='fa fa-star'></i> )";
																					}
																				?></a></span>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-12">
																		<label>	Mobile No :</label>
																		<span >
																		<?= h($postTravlePackage->user->mobile_number);?>
																		</span>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-12">
																			<label>Email :</label>
																			<span >
																			<a href="mailto:<?php echo $postTravlePackage->user->email;?>"><?= h($postTravlePackage->user->email);?></a>
																			</span>
																		</div>
																	</div>
																	<div class="row" style="display:none;">
																		<div class="col-md-12">
																			Location :
																			<div >
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
								</form>
							</fieldset>
						</div>
				<?php $i++;}} 
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
			<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
									<div id="loader"></div>
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
			jQuery(".formSubmit").submit(function(){
						jQuery("#loader-1").show();
					});
  });
</script>
