<?php 
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/TaxiFleetPromotions/TexiPromotionLikes.json?texifleet_promotion_id=".$taxifleet_id."&user_id=".$user_id,
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
	$texifleetpromotion=$List->response_object;
}
?>
<style type="text/css">
.lbwidth{
	color:#716D6F;
	font-weight:bold;
	font-size:18px;
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
.unfollow{
	width:70px;
}
</style>
<div class="container-fluid">
	<div class="box box-primary" style="margin-bottom:5px;">
		<div class="row">
			<div class="col-md-12">
				<div class="box-header with-border"> 
					<span class="box-title" style="color:#057F8A;"><b><?= __('Total Likes') ?></b></span>
					
				</div>
			</div>
		</div>
	</div>
	<div class="box-body bbb">
		<fieldset style="background-color:#fff;">
			<form method="post" class="formSubmit">
				<div class="row col-md-12">
				<table class="table lbwidth">	
				<thead>
				<tr style="background-color:#ECDEE5;">
				<th>Sr.NO</th>
				<th>Name</th>
				<th>Company</th>
				<th>Actions</th>
				</tr>
				</thead>
				<?php $i=0;		
					if(!empty($texifleetpromotion)){
						foreach ($texifleetpromotion as $texifleetpromotion){ 
						$i++;
						?>
				<tbody>
				<tr>
				<td><?php echo $i;?></td>
				<td>
					<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$texifleetpromotion->user_id),1);?>
					<a href="<?php echo $hrefurl; ?>"> 
					<?php echo $texifleetpromotion->user->first_name." ".$texifleetpromotion->user->last_name;?>
				</td>
				<td>
				<label><?php echo $texifleetpromotion->user->company_name;?></label>
				</td>
				<td>
				<a follow_id="<?php echo $texifleetpromotion->user_id; ?>" class=" 
				btn btn-danger btn-sm"  data-target="#unfollow<?php echo $texifleetpromotion->user_id; ?>" data-toggle=modal>Unfollow</a>
		<!-------Follow Modal Start--------->
					<div id="unfollow<?php echo $texifleetpromotion->user_id; ?>" class="modal fade" role="dialog">
						<div class="modal-dialog modal-md" >
						<form method="post">
							<!-- Modal content-->
								<div class="modal-content">
								  <div class="modal-header" style="height:100px;">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">
										Are You Sure, you want to delete this request ?
										</h4>
									</div>
									<div class="modal-footer" style="height:60px;">
										<button type="button" follow_id="<?php echo $texifleetpromotion->user_id; ?>" class="unfollow btn btn-info" value="yes" >Yes</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</td>
				</tr><?php }} ?>
				</tbody>
				</table>
				</div>
			</form>
		</fieldset>
	</div>			
</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
