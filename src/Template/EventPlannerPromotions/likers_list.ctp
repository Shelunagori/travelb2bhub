<?php 
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $coreVariable['SiteUrl']."api/EventPlannerPromotions/EventPlannerLikes.json?event_planner_promotion_id=".$event_id."&user_id=".$user_id,
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
$eventplanners=array();
if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$response;
	$List=json_decode($response);
	//pr($List); exit;
	$eventplanners=$List->response_object;
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
input[type=text] {
    width: 218px;
	height:30px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-color:#fff;
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 16px 11px 16px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}
 
</style>
<div class="row" >
	<div class="col-md-12">
	</div>
</div>
<div class="container-fluid">
	<div class="box box-primary" style="margin-bottom:5px;">
		<div class="row" style="padding-bottom:5px;">
			<div class="col-md-12">
				<div class="box-header"> 
					<span class="box-title" style="color:#057F8A;"><b><?= __('Total Likes') ?></b></span>
					<div class="box-tools pull-right " >
					<input type="text" id="search" placeholder="Type Name or Company">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="box-body bbb">
		<fieldset style="background-color:#fff;" id="table">
			<?php $i=0;		
					if(!empty($eventplanners)){
						foreach ($eventplanners as $eventplanner){ 
						$i++;
						?>
				<div class="row col-md-12"> 
					<div class="col-md-4" style="margin-top: 7px;">
						<span style="color:#727e8a">Name </span> : <?php $hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$eventplanner->user_id),1);?>
						<a href="<?php echo $hrefurl; ?>"> 
						<?php echo $eventplanner->user->first_name." ".$eventplanner->user->last_name;?></a>
					</div>
					<div class="col-md-4" style="margin-top: 7px;">
					<span style="color:#727e8a">Company Name</span> : <?php echo $eventplanner->user->company_name;?><br>
					</div>
					<div class="col-md-4">
 						<?php 
				//pr($follower_list);exit;
					if ($user_id!=$eventplanner->user_id)
					{
						if (in_array($eventplanner->user_id,$follower_list))
						{
						?>
					<div class="text-center margin">	
						<a class=" btn btn-danger btn-sm"  data-target="#unfollow<?php echo $eventplanner->id; ?>" data-toggle="modal" >Unfollow</a>
					</div>
					<?php }
					else {
						?>
					<div class="text-center margin">
						<a follow_id="<?php echo $eventplanner->user_id; ?>" class=" 
				btn btn-success btn-sm"  data-target="#follow<?php echo $eventplanner->id; ?>" data-toggle=modal>follow</a>
					</div>
					<?php }}
					else{?>
					<div class="text-center margin" style="visibility:hidden">	
						<a class=" btn btn-danger btn-sm"  data-target="#unfollow<?php echo $eventplanner->id; ?>" data-toggle="modal" >Unfollow</a>
					</div>
					<?php	
					}?>
					 
					<div id="unfollow<?php echo $eventplanner->id; ?>" class="modal fade" role="dialog">
						<div class="modal-dialog modal-md" >
							 
							<form method="post" class="formSubmit">
							<input type="hidden" name="follow_id" value="<?php echo $eventplanner->user_id; ?>">
								<div class="modal-content">
								  <div class="modal-header" style="height:100px;">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">
										Are you sure , you want to Unfollow this user ?
										</h4>
									</div>
									<div class="modal-footer" style="height:60px;">
										<button type="submit"  class="unfollow btn btn-info" value="yes" name="unfollow_user">Yes</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					 
					<div id="follow<?php echo $eventplanner->id; ?>" class="modal fade" role="dialog">
						<div class="modal-dialog modal-md" >
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
								
								</div>
							</form>
						</div>
					</div> 
 				</div>		
				<div class="col-md-12"><hr style="margin-top: 0px !important; "></hr></div> 	
				
				<?php }} ?>
				
			<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
					<div id="loader"></div></div>	
				<!--<table class="table lbwidth table-responsive" style="margin-bottom:0px !important" id="table">	
				<thead>
				<tr style="background-color:#ECDEE5;">
				<th>Sr.No.</th>
				<th>Name</th>
				<th>Company</th>
				<th>Actions</th>
				</tr>
				</thead>
				<?php $i=0;		
					if(!empty($eventplanners)){
						foreach ($eventplanners as $eventplanner){ 
						
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
				<?php 
				//pr($follower_list);exit;
				if ($user_id!=$eventplanner->user_id)
					{
						if (in_array($eventplanner->user_id,$follower_list))
						{
						?>
					<a  class=" btn btn-danger btn-md"  data-target="#unfollow<?php echo $eventplanner->id; ?>" data-toggle="modal" >Unfollow</a>
					<?php }
					else{
						?>
				<a follow_id="<?php echo $eventplanner->user_id; ?>" class=" 
				btn btn-success btn-md"  data-target="#follow<?php echo $eventplanner->id; ?>" data-toggle=modal>follow</a>
					<?php }}?>
					 
					<div id="unfollow<?php echo $eventplanner->id; ?>" class="modal fade" role="dialog">
						<div class="modal-dialog modal-md" >
							 
							<form method="post" class="formSubmit">
							<input type="hidden" name="follow_id" value="<?php echo $eventplanner->user_id; ?>">
								<div class="modal-content">
								  <div class="modal-header" style="height:100px;">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">
										Are you sure , you want to Unfollow this user ?
										</h4>
									</div>
									<div class="modal-footer" style="height:60px;">
										<button type="submit"  class="unfollow btn btn-info" value="yes" name="unfollow_user">Yes</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					 
					<div id="follow<?php echo $eventplanner->id; ?>" class="modal fade" role="dialog">
						<div class="modal-dialog modal-md" >
							 
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
								
								</div>
							</form>
						</div>
					</div>
					</td>
					<div class="loader-wrapper" style="width: 100%;height: 100%;  display: none;  position: fixed; top: 0px; left: 0px;    background: rgba(0,0,0,0.25); display: none; z-index: 1000;" id="loader-1">
					<div id="loader"></div></div>
				</tr><?php }} ?>
				</tbody>
				</table>-->
				</div>
		</fieldset>
	</div>			
</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
 $(document).ready(function () {
 var $rows = $('#table');
	$('#search').keyup(function() { 
		var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
		$rows.show().filter(function() {
			var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
			return !~text.indexOf(val);
		}).hide();
	});
	jQuery(".formSubmit").submit(function(){
		jQuery("#loader-1").show();
	});
					
					
});
</script>
