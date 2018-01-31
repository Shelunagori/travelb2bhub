<div class="container-fluid">
   <div class="row equal_column">
      <?php echo $this->element('left_panel');?>
        
      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 padding0 ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 border_bottom">
           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 ">
                <h4 class="title">Blocked Users</h2>
           </div>
           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 ">
                    <ul class="top-icons-wrap">

					<li class="notification_list">
 <a href="javascript:void(0);" id="chat_icon" class="link-icon"><span class="chat_count"><?php echo $chatCount;?></span><img src="/img/notify.png" alt=""></a>
                            <div class="ap-subs">
                                <ul class="list-unstyled msg_list" role="menu">
                  <?php echo $this->element('subheader');?>
     
	  <hr class="hr_bordor">
		<?php
		if(count($blockedUsers) >0) { 
			foreach($blockedUsers as $row){ ?>
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
				</div>
			<?php } ?>
      <div class="pages"></div>
		<?php } else {?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 box-event">
                   There are no blocked users.
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