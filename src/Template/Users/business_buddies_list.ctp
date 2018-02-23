
<div class=container-fluid id="business_buddies_list">
<div class="row equal_column" > 
    <div class="col-md-12" style="background-color:#fff"> 
		<br>
		<?php echo $this->element('subheader');?>
		<?php echo  $this->Flash->render() ?>
	</div>
	<div class="col-md-12" style="background-color:#fff"> 

<div class="box box-default">
	<div class="box-header with-border"> 
		<h3 class="box-title" style="padding:20px">Following</h3>
		<div class="box-tools pull-right">
			<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
			<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
		</div>
		 
	</div>
	<div class="box-body">
		<div class="row">
		<?php
		if(count($BusinessBuddies) >0) {
			foreach($BusinessBuddies as $row){ ?>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="box-event">
				 <ul>
                    <li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <p>
                            <b>Name :</b> <?php echo $row['user']['first_name']; ?>&nbsp;&nbsp;<?php echo $row['user']['last_name']; ?>
                    </p>
                     </li>
					 <li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <b>Website :</b> <?php echo ($row['user']['website'])?$row['user']['website']:"-- --"; ?>
                        </p>
                 </li>
					 <li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <b>Company Name :</b> <?php echo ($row['user']['company_name'])?$row['user']['company_name']:"-- --"; ?>
                        </p>
                 </li>
                <li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">&nbsp;</li>
                </ul>
					 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right link padding0">
						<a href="javascript:void(0);" class="unfollow" follow_id = "<?php echo $row['id']; ?>"><?php echo $this->Html->image('detail-ico.png'); ?> Unfollow</a>
					</div>
				</div>
              </div>
			<?php } ?>
      <div class="pages"></div>
		<?php } else {?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
         <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 box-event">
                You are not following anyone.
          </div>
			</div>
		<?php } ?>
    <!--  <div class="col-md-5 col-xs-offset-7 right"><ul class="pagination">
    <li><a href="#">&laquo;</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">&raquo;</a></li>
</ul></div>-->
      </div>
    </div>
    </div>
</div>
<?php echo $this->element('footer');?>
<?php echo $this->Html->script(['ap.pagination.js']);?>
<script>
$(document).ready(function () {
$("#responsesWrap").apPagination({
    targets: ".box-event",
    pagesWrap: ".pages",
    ulClass: "pagination",
    perPage: 5,
    nextText: '<i class="glyphicon glyphicon-menu-right"></i><i class="glyphicon glyphicon-menu-right"></i>',
    prevText: '<i class="glyphicon glyphicon-menu-left"></i><i class="glyphicon glyphicon-menu-left"></i>'
  });

	$(".unfollow").click(function (e) {
		e.preventDefault();
		var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'remove-business-buddy')) ?>";
		var follow_id = $(this).attr("follow_id");
		if(confirm("Are you sure want to unfollow this user?")) {
			$.ajax({
				url:url,
				type: 'POST',
				data: {follow_id:follow_id}
			}).done(function(result){
				if(result == 1) {
					alert("This user has been unfollowed successfully.");
					location.reload();
				} else {
					alert("There is some problem, please try again.");
				}
			});
		}
	});
});
</script>