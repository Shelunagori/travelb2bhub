<?php
//-- List
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/PostTravlePackages/getPostTravelPackageReport.json?user_id=".$user_id."&submitted_from=web",
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
	$postTravlePackages=$List->getPostTravelPackages;
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
</style>
<div class="container-fluid">
	<div class="box box-primary" >
		<div class="row">
			<div class="col-md-12">
				<div class="box-header with-border"> 
					<span class="box-title" style="color:#057F8A;"><b><?= __('Package Reports') ?></b></span>
					
				</div>
			</div>
		</div>
	</div>
	<?php //pr($postTravlePackages); exit;			
					if(!empty($postTravlePackages)){
						foreach ($postTravlePackages as $postTravlePackage){ 
						?>
	<div class="box-body bbb">
		<fieldset style="background-color:#fff;">
			<form method="post" class="formSubmit">
				<div class="row col-md-12" style="padding-top:10px;padding-bottom:10px;">						
					<div class="col-md-3">
						<?= $this->Html->image($postTravlePackage->full_image,['id'=>'myImg','style'=>'width:100%;height:150px;','data-target'=>'#imagemodal'.$postTravlePackage->id,'data-toggle'=>'modal',]) ?>
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
					</div>
					<div class="col-md-5"  style="padding-left:30px;">
						<div class="row">
							<div class="col-md-12 ">
							<span style="color:black;font-size:25px;"><?php echo $postTravlePackage->title?></span>
							</div>
							<div class="col-md-12 lbwidth">
							Likes :
							<a style="color:#1295AB;" href="likers_list/<?php echo $postTravlePackage->id?>"><label><?php echo $postTravlePackage->total_likes;?></label></a>
							</div>
							<div class="col-md-12 lbwidth ">
							Views :
							<a  style="color:#1295AB;" href="likers_list/<?php echo $postTravlePackage->id?>"><label><?php echo $postTravlePackage->total_views;?></label></a>
							</div>
							<div class="col-md-12 lbwidth">
							Date Posted :
							<label style="color:black;"><?php echo date('d-M-y',strtotime($postTravlePackage->created_on));?></label>
							</div>
							<div class="col-md-12 lbwidth">
							Expiring On :
							<label style="color:#FB6542;"><?php echo date('d-M-y',strtotime($postTravlePackage->visible_date));?></label>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="row col-md-12">
						<label><button type="button" class="btn btn-info btn-lg btnlayout">Renew</button></label>
						</div>
						<div class="row col-md-12">
						<label><button type="button" class="btn btn-danger btn-lg btnlayout">Remove</button></label>
						</div>
						<div class="row col-md-12">
						<label><button type="button" class="btn btn-warning btn-lg btnlayout">Details</button></label>
						</div>
					</div>
				</div>
			</form>
		</fieldset>
	</div>
					<?php }} ?>
</div>