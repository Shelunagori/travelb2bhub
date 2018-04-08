<?php
//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/TaxiFleetPromotions/getTaxiFleetPromotionReport.json?user_id=".$user_id."&submitted_from=web",
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
	$texifleetpromotion=$List->getTaxifleets;
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
	$priceMasters=$priceMasters->PriceMasters;
}

?>
<style type="text/css">
.lbwidth{
	color:#716D6F;
	font-weight:bold;
	font-size:16px;
	white-space: nowrap;
	}
fieldset{
	margin-bottom:5px !important;
	border-radius: 6px;
}

.btnlayout{
	border-radius:15px !important;
	width:150px;
	}
#myImg:hover {opacity: 0.7;}
.bbb{
	padding:0px!important;
	pading-bottom:10px!important;
}
.unfollow{
	width:70px;
}
</style>
<div class="container-fluid">
	<div class="box box-primary" style="margin-bottom:5px;">
		<div class="row">
			<div class="col-md-12">
				<div class="box-header with-border"> 
					<span class="box-title" style="color:#057F8A;"><b><?= __('Texi/Fleet Reports') ?></b></span>
					<div class="box-tools pull-right" style="margin-top:-5px;">
						<a style="font-size:26px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
						<a style="font-size:26px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php //pr($texifleetpromotion); exit;			
					if(!empty($texifleetpromotion)){
						foreach ($texifleetpromotion as $texifleetpromotion){ 
						?>
	<div class="box-body bbb">
		<fieldset style="background-color:#fff;">
			<form method="post" class="formSubmit">
				<div class="row col-md-12" style="padding:25px;">						
					<div class="col-md-4">
						<?= $this->Html->image($texifleetpromotion->full_image,['id'=>'myImg','style'=>'width:100%;height:150px;','data-target'=>'#imagemodal'.$texifleetpromotion->id,'data-toggle'=>'modal']) ?>
						<div id="imagemodal<?php echo $texifleetpromotion->id;?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-body" >
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<?= $this->Html->image($texifleetpromotion->full_image,['style'=>'width:100%;height:300px;padding:20px;padding-top:0px!important;']) ?>
								</div>
							</div>
							</div>
						</div>
					</div>
					<div class="col-md-4"  style="padding-left:30px;">
						<div class="row">
							<div class="col-md-12 ">
							<span style="color:black;font-size:25px;"><?php echo $texifleetpromotion->title?></span>
							</div>
							<div class="col-md-12 lbwidth">
							Likes :
							<a style="color:#1295AB;" href="likers_list/<?php echo $texifleetpromotion->id?>"><label><?php echo $texifleetpromotion->total_likes;?></label></a>
							</div>
							<div class="col-md-12 lbwidth ">
							Views :
							<a  style="color:#1295AB;" href="viewers_list/<?php echo $texifleetpromotion->id?>"><label><?php echo $texifleetpromotion->total_views;?></label></a>
							</div>
							<div class="col-md-12 lbwidth">
							Date Posted :
							<label style="color:black;"><?php echo date('d-M-y',strtotime($texifleetpromotion->created_on));?></label>
							</div>
							<div class="col-md-12 lbwidth">
							Expiring On :
							<label style="color:#FB6542;"><?php echo date('d-M-y',strtotime($texifleetpromotion->visible_date));?></label>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="row col-md-12">
						<label><button type="button" class="btn btn-info btn-lg btnlayout" data-target="#renew<?php echo $texifleetpromotion->user_id; ?>" data-toggle=modal>Renew</button></label>
						</div>
						<!------------------------- Renew Modal--------------------------->
						<div id="renew<?php echo $texifleetpromotion->user_id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md" >
								<!-- Modal content-->
									<div class="modal-content">
									  <div class="modal-header" >
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h3 class="modal-title">
											Do you want to renew promotion ?
											</h3>
										</div>
										<div class="modal-body" style="height:80px;">
										<br>
											<div class="row">
												<div class="col-md-12">
													<div class="col-md-6">
														<label>
														Select Promotion Duration
														</label>
														</div>
														<div class="col-md-6">
														<div class="input-field">
														<?php				 
															$options=array();
															foreach($priceMasters as $Price)
															{
															 
																$options[] = ['value'=>$Price->id,'text'=>$Price->week.' @ '.$Price->price,'priceVal'=>$Price->week,'price'=>$Price->price];
															};
															echo $this->Form->input('price_master_id',['options'=>$options,'class'=>'form-control priceMasters','label'=>false,'empty'=>'Select ...']);?>
															<?php // echo $this->Form->input('duration', ['options' => $priceMasters,'class'=>'form-control','label'=>false]); ?>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer" style="height:60px;">
											<button type="button"  name="pay_now" class=" btn btn-success btn-md" value="yes" >Pay Now</button>
											<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
										</div>
									</div>
								</div>
							</div>
						<div class="row col-md-12">
						<label>
						<button type="button" class="btn btn-danger btn-lg btnlayout" data-target="#remove<?php echo $texifleetpromotion->user_id; ?>" data-toggle=modal>Remove</button>
						</label>
						</div>
						<!------------------------- Remove Modal--------------------------->
						<div id="remove<?php echo $texifleetpromotion->user_id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md" >
								<!-- Modal content-->
									<div class="modal-content">
									  <div class="modal-header" style="height:100px;">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h3 class="modal-title">
											Are you sure ? You want to delete this
											</h3>
										</div>
										<div class="modal-footer" style="height:60px;">
											<button type="button"  class=" btn btn-success btn-md" value="yes" name="remove_promotion">Yes</button>
											<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
										</div>
									</div>
								</div>
							</div>
						<div class="row col-md-12">
						<label><button type="button" class="btn btn-warning btn-lg btnlayout" data-target="#details<?php echo $texifleetpromotion->user_id; ?>" data-toggle=modal>Details</button></label>
						</div>
						<!------------------------- Details Modal--------------------------->
						<div id="details<?php echo $texifleetpromotion->user_id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md" >
								<!-- Modal content-->
									<div class="modal-content">
									  <div class="modal-header" >
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h3 class="modal-title">
											Details
											</h3>
										</div>
										<div class="modal-body" >
										
										</div>
										<div class="modal-footer" style="height:60px;">
											<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
										</div>
									</div>
								</div>
							</div>
					</div>
				</div>
			</form>
		</fieldset>
	</div>
					<?php }} ?>
</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>