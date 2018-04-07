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
	font-size:20px;
	white-space: nowrap;
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


.btnlayout{
	border-radius:15px !important;
	}
#myImg:hover {opacity: 0.7;}
.bbb{
	padding:0px!important;
	pading-bottom:10px!important;
}
</style>
<div class="container-fluid">
	<div class="box box-primary" style="margin-bottom:5px;">
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
				<div class="row" style="padding-top:5px;">						
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
					</div>
					<div class="col-md-5 ">
						<div class="row">
							<div class="col-md-12 lbwidth">
							<label style="color:black;"><?php echo $postTravlePackage->title?></label>
							</div>
							<div class="col-md-12 lbwidth">
							Likes :
							<a href="likers_list/<?php echo $postTravlePackage->id?>"><label><?php echo $postTravlePackage->total_likes;?></label></a>
							</div>
							<div class="col-md-12 lbwidth">
							Views :
							<a href="likers_list/<?php echo $postTravlePackage->id?>"><label><?php echo $postTravlePackage->total_views;?></label></a>
							</div>
							<div class="col-md-12 lbwidth">
							<?php echo ($postTravlePackage->created_on);?>
							</div>
							<div class="col-md-12 lbwidth">
							</div>
						</div>
					</div>
					<div class="col-md-4 ">
					
					</div>
				</div>
			</form>
		</fieldset>
	</div>
					<?php }} ?>
</div>