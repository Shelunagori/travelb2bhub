 <?php echo $this->element('header-back');?>
  <div class="row">
      <?php echo $this->element('left_panel');?>
      <?php $this->Flash->render() ?>
	  <div class="col-md-9 col-sm-8 pro-top">
      <?php if($this->request->session()->read('Auth.User.role_id') == 1){?>
        <div class="col-md-12">
        
          <div class="col-md-3 col-sm-12 col-xs-12">
              <div class="title"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'sendrequest')) ?>"><strong>	Place Request</strong><br>
                      <?php echo (365-$myRequestCount)." out of 365"; ?></a></div>
          </div>
        
          <div class="col-md-3 col-sm-12 col-xs-12">
              <div class="title"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>"><strong> 		My Requests</strong><br>
                      <?php echo $myRequestCount; ?></a></div>
          </div>
      
		 <div class="col-md-3 col-sm-12 col-xs-12">
             <div class="title"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>"> <strong>Respond To Request</strong><br>
                     <?php echo $respondToRequestCount; ?></a></div>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12">
             <div class="title"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'myresponselist')) ?>"> <strong>My Responses</strong><br>
                     <?php echo $myReponseCount; ?></a></div>
          </div>
         
        </div>
        <?php } ?>
        <?php if($this->request->session()->read('Auth.User.role_id') == 3){?>
        <div class="col-md-12">
		 <div class="col-md-3 col-sm-12 col-xs-12">
             <div class="title"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>"> <strong>Respond To Request</strong><br>
                     <?php echo $respondToRequestCount; ?></a></div>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12">
             <div class="title"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'myresponselist')) ?>"> <strong>My Responses</strong><br>
                     <?php echo $myReponseCount; ?></a></div>
          </div>
         
        </div>
        <?php } ?>
        <?php if($this->request->session()->read('Auth.User.role_id') == 2){?>
			<div class="col-sm-12">
			
			  <div class="col-md-3 col-sm-12 col-xs-offset-3 col-xs-12">
				<div class="title"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'sendrequest')) ?>"><strong>	Place Request</strong><br>
						  <?php echo (365-$myRequestCount)." out of 365"; ?></a></div>
			  </div>
			  <div class="col-md-3 col-sm-12 col-xs-12">
				<div class="title"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>"><strong> 		My Requests</strong><br>
						  <?php echo $myRequestCount; ?></a></div>
			  </div>
			</div>
        <?php } ?>
      </div>
      <div class="right-panel col-md-9 col-sm-8 col-xs-12">
	  <div class=" col-md-9 title">User's Unread Chats</div>
        <?php echo $this->element('top_link');?>
      </div>
      <div class="col-md-9 col-sm-8 col-xs-12 right">
		<?php
		if(count($UserChats) >0) {
			foreach($UserChats as $row){ ?>
				<div class="box-event">
					<div class="col-md-4"><b>Name :-</b> <?php echo $row['user']['first_name']; ?>&nbsp;&nbsp;<?php echo $row['user']['last_name']; ?></div>
					<div class="col-md-4"><b>Email :- </b><?php echo ($row['user']['email'])?$row['user']['email']:"-- --"; ?></div>
					<div class="col-md-4"><b>Mobile No. :- </b><?php echo ($row['user']['mobile_number'])?$row['user']['mobile_number']:"-- --"; ?></div>
					<div class="col-md-4"><b>Chat Message :- </b><?php echo ($row['message'])?$row['message']:"-- --"; ?></div>
					<div class="col-md-4"><b>Sent Time :- </b><?php echo ($row["created"])?date("d M Y G:i", strtotime($row["created"])):"-- --"; ?></div>
					<!-- <div class="col-md-5 col-sm-5 right link">
						<a href="javascript:void(0);" class="unblockUser" user_id = "<?php echo $row['user']['id']; ?>"><?php echo $this->Html->image('detail-ico.png'); ?> Unblock User</a>
					</div> -->
				</div>
			<?php }
		} else {?>
			<div class="box-event">
				No Unread Chat Found.
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
    <div id="tra-tours" class="footemail"> <a href="mailto:contactus@travelb2bhub.com">contactus@travelb2bhub.com</a> </div>

<?php echo $this->element('footer');?>