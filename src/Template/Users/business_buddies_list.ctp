
<div class="container-fluid" id="business_buddies_list">
<div class="row equal_column" > 
    <div class="col-md-12" > 
		 
		<?php echo $this->element('subheader');?>
		<?php echo  $this->Flash->render() ?>
	</div>
</div>
 <div class="box box-primary">
		<div class="box-header with-border"> 
		<h3 class="box-title" style="padding:5px;">Following</h3>
			<div class="box-tools pull-right">
			</div>
		</div>
	<div class="box-body">
					<?php
						use Cake\Datasource\ConnectionManager; 
						$conn = ConnectionManager::get('default');
						if(count($BusinessBuddies) >0) {
							foreach($BusinessBuddies as $row){
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
							 
					<div id="cat" >
						<div class="row">
							<div class="form-group col-md-12">
							
								 <div class="col-md-3">
									<b>Name :</b> <a href="<?php echo $hrefurl; ?>"> <?php echo $row['user']['first_name']; ?>&nbsp;<?php echo $row['user']['last_name']; ?></a>
									<?php if($final_rating>0){ ?>
										<font color="#1295AB">(<?php echo round($final_rating); ?> <i class="fa fa-star"></i>)</font> 
									<?php } ?> 
									<br>
									
								</div>
								<div class="col-md-3">
								<b>Company Name :</b> <?php echo ($row['user']['company_name'])?$row['user']['company_name']:"-- --"; ?>
							 
								</div>
								<div class="col-md-3">
								<b>Website :</b> <?php echo ($row['user']['web_url'])?$row['user']['web_url']:"-- --"; ?> 
								</div>
								<div class="col-md-3" align="center" >
									<a style="margin-top: 2px !important;" follow_id="<?php echo $row['id']; ?>" class=" btn btn-danger btn-xs"  data-target="#unfollow<?php echo $row['id']; ?>" data-toggle=modal>Unfollow</a>
									<!-------Delete Modal Start--------->
												<div id="unfollow<?php echo $row['id']; ?>" class="modal fade" role="dialog">
													<div class="modal-dialog modal-md" >
													<form method="post">
														<!-- Modal content-->
															<div class="modal-content">
															  <div class="modal-header"  >
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title"  align="left">
																	Are You Sure, you want to Unfollow ?
																	</h4>
																</div>
																<div class="modal-footer" >
																	<button type="button" follow_id="<?php echo $row['id']; ?>" class="unfollow btn btn-danger" value="yes" >Yes</button>
																	<button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
																</div>
															</div>
														</form>
													</div>
												</div>
											<!-------Delete Modal End--------->
								</div>
							</div>
						</div><hr></hr>
						<?php } ?>
					</div>
				</div>
			</div>
			
      <div class="pages"></div>
		<?php } else {?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
				<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 box-event">
				You are not following anyone.
				</div>
			</div>
		<?php } ?>
    <!--<div class="col-md-5 col-xs-offset-7 right">
	<ul class="pagination">
    <li><a href="#">&laquo;</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">&raquo;</a></li>
	</ul>
	</div>-->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).ready(function () {
	$(".unfollow").click(function (e) {
		e.preventDefault();
		var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'remove-business-buddy')) ?>";
		var follow_id = $(this).attr("follow_id");
		$.ajax({
			url:url,
			type: 'POST',
			data: {follow_id:follow_id}
		}).done(function(result){
			if(result == 1) {
				$('.modal').toggle();
				location.reload();
			} else {
				alert("There is some problem, please try again.");
			}
		});
		 
	});
});
</script>