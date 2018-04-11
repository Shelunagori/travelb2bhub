<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php
use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');
?>
<style>
	legend {
		text-align:center;
	}
</style>
<div id="my_final_responses" class="container-fluid">
<div class="row equal_column">
	<div class="col-md-12" style="background-color:"> 
		 
		<?php echo $this->element('subheader');?>
		<?php echo  $this->Flash->render() ?>
	</div>
</div>
<div class="box box-primary">
	<div class="box-header with-border"> 
		<h3 class="box-title" style="padding:5px;">Blocked User</h3>
		<div class="box-tools pull-right">
			
		</div>
	</div>
	<div class="box-body">
	<div id="cat">
		<div class="row">
			<div class="col-md-12">
		<?php
		if(count($blockedUsers) >0) { 
			foreach($blockedUsers as $row){ ?>
							<div class="form-group col-md-12">
								<div class="col-md-3">
									<?php 
										$total_rating=0;
										$rate_count=0;
										$final_rating=0;
										$sql1="Select * from `testimonial` where `user_id`='".$row['user']['id']."' ";
										$stmt1 = $conn->execute($sql1);
										foreach($stmt1 as $bresul){
											$rate_count++;
											$rating=$bresul['rating'];
											$total_rating+=$rating;
										} 
										if($total_rating>0){
											@$final_rating=$total_rating/$rate_count;
										}
										 
										?>
									<?php 
										$hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$row['user']['id']));
									?>
									<b>Name :</b>
									<a href="<?php echo $hrefurl; ?>"> <?php echo $row['user']['first_name']; ?>&nbsp;<?php echo $row['user']['last_name']; ?></a>
									<font color="#1295AB">(<?php echo round($final_rating); ?> <i class="fa fa-star"></i>)</font>
								</div>
								<div class="col-md-3">
									<b>Email :</b> <?php echo ($row['user']['email'])?$row['user']['email']:"-- --"; ?>
								</div>
								<!--div class="col-md-3">
									<b>Mobile No. :</b> <?php echo ($row['user']['mobile_number'])?$row['user']['mobile_number']:"-- --"; ?>
								</div-->
								<div class="col-md-3">
									<b>Company Name :</b> <?php echo ($row['user']['company_name'])?$row['user']['company_name']:"-- --"; ?>
								</div>
								<div class="col-md-3">
									<!--a href="javascript:void(0);" class="unblockUser btn btn-success btn-sm" user_id = "<?php //echo $row['user']['id']; ?>" > Unfollow</a-->
									
									<a style="width:70%" data-toggle="modal" class="btn btn-success btn-sm" data-target="#block<?php echo $row['user']['id']; ?>"  > Unblock User </a>
							<!-------Contact Details Modal --------->
							<div id="block<?php echo $row['user']['id']; ?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-md" >
									<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h3 class="modal-title">
													<h4><font color="green">Are you sure you want to Unblock this user ?</font></h4>
												</h3>
											</div>
												<div class="modal-footer">
													<button type="button"  href="javascript:void(0);" class="unblockUser btn btn-success" user_id = "<?php echo $row['user']['id']; ?>">Unblock</button>
													<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
								<?php } ?>
							
						</div>
					</div>
				</div>
			</div>
		
             <!--div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
               <div class="box-event">
				 <ul>
                    <li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <b>Name :</b> <?php echo $row['user']['first_name']; ?>&nbsp;&nbsp;<?php echo $row['user']['last_name']; ?>
                        </p>
                     </li>
					<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <b>Email :</b> <?php echo ($row['user']['email'])?$row['user']['email']:"-- --"; ?>
                        </p>
                     </li>
					<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <b>Mobile No. :</b> <?php echo ($row['user']['mobile_number'])?$row['user']['mobile_number']:"-- --"; ?>
                        </p>
                     </li>
					<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <b>Company Name :</b> <?php echo ($row['user']['company_name'])?$row['user']['company_name']:"-- --"; ?>
                        </p>
                     </li>
                 </ul>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right link padding0">
						<a href="javascript:void(0);" class="unblockUser" user_id = "<?php echo $row['user']['id']; ?>"><?php echo $this->Html->image('detail-ico.png'); ?> Unblock User</a>
					</div>
				  </div>
				</div-->
		
      <div class="pages"></div>
		<?php } else {?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 box-event" style="text-align:center;">
                   There are no blocked users.
                </div>
			</div>
		<?php } ?>
  
        </div>
      </div>
   </div>
</div>
</div>
<?php echo $this->element('footer');?>
<?php echo $this->Html->script(['ap.pagination.js']);?>
<script>
$(document).ready(function () {
 /*  $("#responsesWrap").apPagination({
    targets: ".box-event",
    pagesWrap: ".pages",
    ulClass: "pagination",
    perPage: 5,
    nextText: '<i class="glyphicon glyphicon-menu-right"></i><i class="glyphicon glyphicon-menu-right"></i>',
    prevText: '<i class="glyphicon glyphicon-menu-left"></i><i class="glyphicon glyphicon-menu-left"></i>'
  }); */
	$(".unblockUser").click(function (e) {
		e.preventDefault();
		var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'unblockUser')) ?>";
		var user_id = $(this).attr("user_id");
	 
			$.ajax({
				url:url,
				type: 'POST',
				data: {user_id:user_id, user_id:user_id}
			}).done(function(result){
				if(result == 1) {
					 
					location.reload();
				} else {
					alert("There is some problem, please try again.");
				}
			});
	 
	});
});
</script>