<?php 
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/EventPlannerPromotions/EventPlannerViews.json?event_planner_promotion_id=".$event_id."&user_id=".$user_id,
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
	$eventplanner=$List->response_object;
}
// Follow-unfollow Button--------
$post =['user_id' =>$user_id];
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."pages/businessbuddieslistapi?token=MzIxNDU2NjU0NTY0cGhmZmpoZGZqaA==",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
   CURLOPT_POSTFIELDS =>$post,
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 4f8087cd-6560-4ca6-5539-9499d3c5b967"
  ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
$follower_list=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$List=json_decode($response);
	//pr($List); exit;
	$followinglist=$List->response_object;
	foreach ($followinglist as $followinglists){ 
	$follower_list[]=$followinglists->bb_user_id;
	};
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
<div class="row" >
		<div class="col-md-12">
		
		</div>
	</div>
<div class="container-fluid">
	<div class="box box-primary" style="margin-bottom:5px;">
		<div class="row">
			<div class="col-md-12">
				<div class="box-header with-border"> 
					<span class="box-title" style="color:#057F8A;"><b><?= __('Total Views') ?></b></span>
					
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
					if(!empty($eventplanner)){
						foreach ($eventplanner as $eventplanner){ 
						$i++;
						?>
				<tbody>
				<tr>
				<td><?php echo $i;?></td>
				<td>
					<?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$eventplanner->user_id),1);?>
					<a href="<?php echo $hrefurl; ?>"> 
					<?php echo $eventplanner->user->first_name." ".$eventplanner->user->last_name;?>
				</td>
				<td>
				<label><?php echo $eventplanner->user->company_name;?></label>
				</td>
				<td>
				<?php if ($user_id!=$eventplanner->user_id)
					{
						//pr($follower_list);exit;
						if (in_array($eventplanner->user_id,$follower_list))
						{
						?>
					<a follow_id="<?php echo $eventplanner->user_id; ?>" class=" 
				btn btn-danger btn-sm"  data-target="#unfollow<?php echo $eventplanner->id; ?>" data-toggle=modal>Unfollow</a>
				<?php }
					else{
						?>
						<a follow_id="<?php echo $eventplanner->user_id; ?>" class=" 
				btn btn-success btn-md"  data-target="#follow<?php echo $eventplanner->id; ?>" data-toggle=modal>follow</a>
					<?php } } ?>
					<!-------Follow Modal Starti-->
					<div id="unfollow<?php echo $eventplanner->id; ?>" class="modal fade" role="dialog">
						<div class="modal-dialog modal-md" >
						<form method="post" class="formSubmit">
							<input type="hidden" name="follow_id" value="<?php echo $eventplanner->user_id; ?>">
							<!-- Modal content-->
								<div class="modal-content">
								  <div class="modal-header" style="height:100px;">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">
										Are you sure , you want to unfollow this user ?
										</h4>
									</div>
									<div class="modal-footer" style="height:60px;">
										<button type="submit"  class="unfollow btn btn-info" value="yes" name="unfollow_user" >Yes</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-------Follow Modal Start--------->
					<div id="follow<?php echo $eventplanner->id; ?>" class="modal fade" role="dialog">
						<div class="modal-dialog modal-md" >
							<!-- Modal content-->
							<form method="post" class="formSubmit">
							<input type="hidden" name="follow_id" value="<?php echo $eventplanner->user_id; ?>">
								<div class="modal-content">
								  <div class="modal-header" style="height:100px;">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">
										Are you sure , you want to follow this user ?
										</h4>
									</div>
									<div class="modal-footer" style="height:60px;">
										<button type="submit"  class="unfollow btn btn-info" value="yes" name="follow_user" >Yes</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</td>
				<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
						<div id="loader"></div>
						</div>
				</tr><?php }} ?>
				</tbody>
				</table>
				</div>
			</form>
		</fieldset>
	</div>			
</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>	 
  $(document).ready(function(){
		jQuery(".formSubmit").submit(function(){
						jQuery("#loader-1").show();
					});
  });
</script>