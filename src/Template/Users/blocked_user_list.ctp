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
	<div class="col-md-12" style="background-color:#fff"> 
		<br>
		<?php echo $this->element('subheader');?>
		<?php echo  $this->Flash->render() ?>
	</div>
	<div class="col-md-12" style="background-color:#fff"> 
     <div class="box box-default">
	<div class="box-header with-border"> 
		<h3 class="box-title" style="padding:20px">Blocked User</h3>
		<div class="box-tools pull-right">
			
		</div>
	</div>
	<div class="box-body">
		<div class="row">
	  
		<?php
		if(count($blockedUsers) >0) { 
			foreach($blockedUsers as $row){ ?>
			
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-body">
						<div>
							<div class="form-group col-md-12">
								<div class="col-md-8">
									<b>Name :</b> <?php echo $row['user']['first_name']; ?>&nbsp;&nbsp;<?php echo $row['user']['last_name']; ?><br>
									<b>Email :</b> <?php echo ($row['user']['email'])?$row['user']['email']:"-- --"; ?><br>
									<b>Mobile No. :</b> <?php echo ($row['user']['mobile_number'])?$row['user']['mobile_number']:"-- --"; ?><br>
									<b>Company Name :</b> <?php echo ($row['user']['company_name'])?$row['user']['company_name']:"-- --"; ?>
								</div>
								<div class="col-md-4">
									<br><br>
									<a href="javascript:void(0);" class="unblockUser btn btn-success btn-sm" user_id = "<?php echo $row['user']['id']; ?>" > Unfollow</a>
								</div>
							</div>
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
			<?php } ?>
      <div class="pages"></div>
		<?php } else {?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 box-event">
                   There are no blocked users.
                </div>
			</div>
		<?php } ?>
  
        </div>
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
		if(confirm("Are you sure want to unblock this user?")) {
			$.ajax({
				url:url,
				type: 'POST',
				data: {user_id:user_id, user_id:user_id}
			}).done(function(result){
				if(result == 1) {
					alert("This user has been unblocked successfully.");
					location.reload();
				} else {
					alert("There is some problem, please try again.");
				}
			});
		}
	});
});
</script>