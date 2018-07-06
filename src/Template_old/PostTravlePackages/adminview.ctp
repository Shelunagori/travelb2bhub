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
//-- priceMasters
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/price_masters/index.json?promotion_type_id=2",
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
	$priceMasters=json_decode($response);
	//pr($priceMasters);exit;
	$priceMasters=$priceMasters->PriceMasters;
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
	color:#96989A !important;
	font-weight:100
}
hr{
	margin-top: 15px !important;
    margin-bottom: 4px !important;
}

.col-md-4{
	color:#96989A;
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
												$CategoryList.=', ';
											}
											$CategoryList.=$category->post_travle_package_category->name;
											$x++;
										}
											$countryList='';
											$y=0;
											foreach($postTravlePackage->post_travle_package_countries as $country)
											{
												if($y>=1){
													$countryList.=', ';
												}
												$countryList.=$country->country->country_name;
												$y++;
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
					<div class="row">
					 
					<input type="hidden" name="posttravle_id" value="<?php echo $postTravlePackage->id; ?>"/>
						<div class="col-md-12">
							<h3><?= h($postTravlePackage->title) ?></h3>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-3" >
								<?= $this->Html->image($postTravlePackage->full_image,['id'=>'myImg','style'=>'width:95%;height:100px;','data-target'=>'#imagemodal'.$postTravlePackage->id,'data-toggle'=>'modal',]) ?>
								<div id="imagemodal<?php echo $postTravlePackage->id;?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-md">
									<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-body" >
								<button type="button" class="close" data-dismiss="modal" style="padding-right:8px !important;">&times;</button>
											<?= $this->Html->image($postTravlePackage->full_image,['style'=>'width:100%;padding:20px;padding-top:0px!important;']) ?>
											</div>
										</div>
									</div>
								</div><hr></hr>
								<div class="row" style="padding-top:5px;">
									<table  width="100%" style="text-align:center;" >
										<tr>
											<td width="25%" >
												<span><?= $this->Html->image('../images/view.png',['style'=>'height:13px;']) ?>
													<?= h($postTravlePackage->total_views);?></span> 
											</td>
											<td width="25%" >
												<span><?= $this->Html->image('../images/unlike.png',['style'=>'height:13px;']) ?> 
												<?= h($postTravlePackage->total_likes);?></span>
											</td>
											<td width="25%" >
												<span><?= $this->Html->image('../images/unsave.png',['style'=>'height:13px;']) ?> 
												<?= h($postTravlePackage->total_saved);?></span>
											</td>
											<td width="25%" >
												<span><?= $this->Html->image('../images/flag.png',['style'=>'height:13px;']) ?> 
												<?= h($postTravlePackage->total_flagged);?></span>
											</td>
										</tr>
									</table>
								</div>
							</div>
									<div class="col-md-9" style="padding-top:15px;">
											<div class="row col-md-12 rowspace">
													<div class="col-md-12">
													<label >Category: </label>
													<span ><?= h($CategoryList); ?></span>
													</div>
											</div>
											<div class="col-md-5">
												<div class="row rowspace">
													<div class="col-md-12 "><label>Duration: </label> 
													<span style="color:#FB6542"><?= h($postTravlePackage->duration_day_night) ?></span>
													</div>
												</div>
												<div class="row rowspace">
													<div class="col-md-12 ">
													<label>Starting Price: </label>
													<span style="color:#1295AB">&#8377; <?php echo (h($postTravlePackage->starting_price)) ;?></span>
													</div>
												</div>
												<div class="row rowspace">
													<div class="col-md-12 "><label>Seller: </label>
													<span><u>
															<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'adminviewprofile',$postTravlePackage->user_id),1);?>
															<a style="color:#d69d5c" href="<?php echo $hrefurl; ?>"> 
															<?= h($postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name);?></u>
															<?php
															if($postTravlePackage->user_rating==0)
															{
																echo "";
															}
															else{
																	echo "(".$postTravlePackage->user_rating." <i class='fa fa-star'></i>)";
																}
															?></a>
														</span>
													</div>					
												</div>
												<div class="row rowspace">
													<div class="col-md-12 ">
													<label>Date Posted: </label>
													<span style="color:#black">  <?php echo date('d-M-Y',strtotime($postTravlePackage->created_on)) ; ?></span>
													</div>
												</div>
												<div class="row rowspace">
													<div class="col-md-12">
													<label>Expiring On: </label>
													<span style="color:#FB6542"> <?php echo date('d-M-Y',strtotime($postTravlePackage->visible_date)) ; ?></span>
													</div>
												</div> 
											</div>
											<div class="col-md-7">
												<div class="row rowspace">
													<div class="col-md-12"><label>Valid Till: </label>
													<span><?= h(date('d-M-Y',strtotime($postTravlePackage->valid_date))); ?></span>
													</div>					
												</div>	
												<div class="row rowspace">
													<div class="col-md-12 "><label>Cities: </label>
													<span ><?= h($cityList); ?></span>
													</div>
												</div>
												<div class="row rowspace">
													<div class="col-md-12"><label>Country: </label>	
													<span ><?=h($countryList); ?></span>
													</div>
												</div>
												
								<div class="row "  style="padding-top:15px;">						
									<div class="col-md-12 text-center">
										<?php
										echo $this->Html->link('<b>Contact Info</b>','address'.$postTravlePackage->id,array('escape'=>false,'class'=>'btn  btn-info btn-md contact','data-target'=>'#contactdetails'.$postTravlePackage->id,'data-toggle'=>'modal','style'=>'margin-top:5px;'));?>&nbsp;&nbsp;
										
										<!--<a style="margin-top:5px" href="<?php echo $this->Url->build(["controller" => "PostTravlePackages",'action'=>'adminedit/'.$postTravlePackage->id]); ?>" class="btn btn-successto btn-md " >Edit Event</a>&nbsp;&nbsp;-->
										
										<button style="margin-top:5px;" type="button" class="btn btn-success btn-md contact" data-target="#renew<?php echo $postTravlePackage->id; ?>" data-toggle=modal>Renew</button>
										&nbsp;&nbsp;
										
										<button style="margin-top:5px;" type="button" class="btn btn-danger btn-md contact" data-target="#remove<?php echo $postTravlePackage->id; ?>" data-toggle=modal>Remove Package</button>
									</div>
									<div id="renew<?php echo $postTravlePackage->id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md" >
								<!-- Modal content-->
								<form method="post" class="formSubmit">
									<div class="modal-content">
									  <div class="modal-header" >
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">
											Do you want to renew promotion ?
											</h4>
										</div>
										<div class="modal-body">
											<div class="row mainrow">
												<div class="col-md-12">
													<div class="col-md-6">
														<label for="from">
															Payment Duration
														</label>
														<div class="input-field">
														<?php				 
															$options=array();
															foreach($priceMasters as $Price)
															{
																$options[] = ['value'=>$Price->id,'text'=>$Price->week,'priceVal'=>$Price->week,'price'=>$Price->price];
															};
															echo $this->Form->input('price_master_id',['options'=>$options,'class'=>'form-control priceMasters','label'=>false,'empty'=>'Select ...']);?>
														</div>
													</div>
													<div class="col-md-6">
														<label for="from">
																	Promotion Amount
														</label>
														<div class="input-field">
														<?php echo $this->Form->input('payment_amount', ['class'=>'form-control payment_amount','label'=>false,"placeholder"=>"Payment Amount",'readonly'=>'readonly','type'=>'text']);?> 
														</div>
													</div>
												</div>
												<input type="hidden" name="visible_date" class="visible_date" value="">
											</div>
										</div>
										<div class="modal-footer" style="height:60px;">
											<button type="submit"  name="pay_now" class=" btn btn-success btn-md" value="yes" >Pay Now</button>
											<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
										</div>
									</div>
								<input type="hidden" name="post_travel_id" value="<?php echo $postTravlePackage->id; ?>">
								</form>
							</div>
						</div>
									<div id="remove<?php echo $postTravlePackage->id; ?>" class="modal fade" role="dialog">
										<div class="modal-dialog modal-md" >
											<!-- Modal content-->
											<form method="post" class="formSubmit">
												<div class="modal-content">
												  <div class="modal-header" style="height:100px;">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">
														Are you sure you want to delete this Promotion?
														</h4>
													</div>
													<div class="modal-footer" >
														<button type="submit"  class="unfollow btn btn-success btn-md" value="yes" name="removepackage">Yes</button>
														<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
													</div>
												</div>
												<input type="hidden" name="remove_package_id" value="<?php echo $postTravlePackage->id; ?>"/>
											</form>
										</div>
									</div>
								</div><span class="help-block"></span>
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
																	<div class="row rowspace">
																		<div class="col-md-12">
																			<label>Seller Name: </label>
																			<span style="padding-top:2px;">
																				<u>
																				<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'adminviewprofile',$postTravlePackage->user_id),1);?>
																				<a style="color:#d69d5c" href="<?php echo $hrefurl; ?>"> 
																				<?= h($postTravlePackage->user->first_name.' '.$postTravlePackage->user->last_name);?></u>
																				<?php
																				if($postTravlePackage->user_rating==0)
																				{
																					echo "";
																				}
																				else{
																						echo "(".$postTravlePackage->user_rating." <i class='fa fa-star'></i>)";
																					}
																				?></a>
																			</span>
																			</div>					
																		</div>
																	<div class="row rowspace">
																		<div class="col-md-12">
																		<label>Mobile No: </label>
																		<span>
																		<?= h($postTravlePackage->user->mobile_number);?>
																		</span>
																		</div>
																	</div>
																	<div class="row rowspace">
																		<div class="col-md-12">
																			<label>Email: </label>
																			<span>
																			<a href="mailto:<?php echo $postTravlePackage->user->email;?>"><?= h($postTravlePackage->user->email);?></a>
																			</span>
																		</div>
																	</div>
																	<div class="row" style="display:none;">
																		<div class="col-md-12">
																			<div class="col-md-4">Location: </div>
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
											<hr></hr>
											<div class="row">
												<div class="col-md-12 ">
													<label><?= __('Including in Package') ?></label>
												</div>
											</div>
											<div class="row" style="padding-top:2px;">
												<div class="col-md-12">
													<?= h($postTravlePackage->package_detail); ?>
												</div>
											</div><hr></hr>
											<div class="row" style="padding-top:2px;">
												<div class="col-md-12 ">
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
<script>
    $(document).ready(function () {
		$(document).on('change','.priceMasters',function()
		{
			var ab=$(this).closest('div').find('.priceMasters option:selected').val();
			 
			if(ab!=0)
			{
			var priceVal=$(this).closest('div').find('.priceMasters option:selected').attr('priceVal');
			var price=$(this).closest('div').find('.priceMasters option:selected').attr('price');
			var Result = priceVal.split(" ");
			var Result1 = price.split(" ");
			var weeks=Result[0];
			var price=Result1[0];
			var todaydate = new Date(); // Parse date
			for(var x=0; x < weeks; x++){
				todaydate.setDate(todaydate.getDate() + 7); // Add 7 days
			}
			var dd = todaydate .getDate();
			var mm = todaydate .getMonth()+1; //January is 0!
			var yyyy = todaydate .getFullYear();
			if(dd<10){  dd='0'+dd } 
			if(mm<10){  mm='0'+mm } 
			var date = dd+'-'+mm+'-'+yyyy;	
			$(this).closest('div.mainrow').find('.visible_date').val(date);
			$(this).closest('div.mainrow').find('.payment_amount').val(price);
			//alert($(this).closest('div.mainrow').html());
			}
			else{
				$(this).closest('div.mainrow').find('.visible_date').val("dd-mm-yyyy");
				$(this).closest('div.mainrow').find('.payment_amount').val(0);
			}
		});
		jQuery(".formSubmit").submit(function(){
			jQuery("#loader-1").show();
		});
	});
</script>		
								
