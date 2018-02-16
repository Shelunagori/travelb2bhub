<?php use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');
$lastword=  substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1);


                                 $countchat = count($allunreadchat);
                                 if($countchat > 0) {
                                foreach($allunreadchat as $allchat) {
										if($allchat['notification']==1) { 
										if(strpos($allchat['message'],"accepted")){
$req_id = $allchat['request_id'];
		$sql = "SELECT re.id,rs.id as responseid FROM requests as re inner join `responses` as rs on rs.request_id=re.id 
		where re.id='".$req_id."' and re.status=2";
		$stmt = $conn->execute($sql);
			$results = $stmt ->fetch('assoc');
$res_userid = 	$allchat['user_id'].'-'.$req_id;
?>
 <li>
<a data-target="#myModal1review<?php echo $allchat['id']; ?>" 
href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'addtestimonial',  $res_userid)) ?>"
                       data-toggle="modal"
                        class="chat_notification chat_message" ><?php echo $allchat['message']; ?></a>
                                        </li> 
<div class="modal fade" id="myModal1review<?php echo $allchat['id']; ?>" role="dialog">
		<div class="modal-dialog">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Review</h4>
			</div>
			<div class="modal-body">
			</div>
		  </div>
		</div>
	</div>                         
    <?php }else{ ?>
                                <li>
                       <a class="chat_notification" href="#"><?php echo $allchat['message']; ?></a>
                                        </li>
                                <?php } }else{?>
                                
													<li>
						<?php
														if($allchat['screen_id']==1)
											  {
												  $c=2;
											 $res_text = "Please go to MY RESPONSES to view it.";
											  }elseif($allchat['screen_id']==2)
											  {
												  $c=1;
											  $res_text = "Please go to CHECK RESPONSES to view it.";
											  }else{
												  $c=0;
											  $res_text = "";
											  }
														?>								
                       <a data-toggle="modal" class="chat_message" data-target="#myModal<?php echo $allchat['request_id']; ?>" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'userChat', $allchat['request_id'], $allchat["user_id"],$c)) ?>">
                       <?php $userid = $allchat['user_id'];
			$sql = "SELECT first_name,last_name FROM users	where id='".$userid."'";
			$stmt = $conn->execute($sql);
			$result = $stmt ->fetch('assoc');   
			$name = $result['first_name'].' '.$result['last_name'];
											  
                        echo "You have received a CHAT MESSAGE from: <span class='rec_name'>$name</span>. $res_text"; ?></a>
                                        </li>
                                        <div class="modal fade" id="myModal<?php echo $allchat['request_id']; ?>" role="dialog">
		<div class="modal-dialog">
		<!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Chat</h4>
			</div>
			<div class="modal-body">
			</div>
		  </div>
		  </div>
	</div>
	<?php  } }} else { ?>
                                        
                                        <?php } ?>
                                
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 right-panel pro-top">
		
		
		
		<div class="row">
		
		<div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner col-md-4">
				<i class="fa fa-send" style="font-size:50px;"></i> 
            </div>
            <div class="inner col-md-8">
				<p>sdfdfsdf</p>
				<p>20</p>
            </div>
			
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
		
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h4>
				<b>
					<?php echo (($reqcount['value']-$myRequestCount)-($myRequestCountdel+ $myfinalCount))." <span class='hidden-xs'> out of ".$reqcount['value']." Requests Remaining </span>"; ?>
				</b>
			  </h4>
              <p>Place Request</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
      </div>
        
        <?php if($lastword=="dashboard"  ) { ?>
         
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top_box text-center padding0 mobile_bar">  
               <?php if($users['role_id'] == 1){ ?>
               <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 top_box text-center place_request <?php if($lastword=="sendrequest") { echo "active"; } ?>">
                    <div class="thumbnail event">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'sendrequest')) ?>">
                        <div class="caption <?php if($lastword=="sendrequest") { echo "active"; } ?>">
                            <p>Click here to fill your Requirement for Travel Package, Hotel or Transportation.</p>
                            <p><?php echo $this->Html->image('white-place-request-icon.png'); ?>     <?php //echo $number; ?>
                                Place Request
                             </p>
                        </div>

                        <div class="description padding0">
                            <div class="icon">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('place-request-icon.png'); ?>    
                                    <?php echo $this->Html->image('place-request-icon-white.png'); ?>   
                                    <?php //echo $number; ?>
                                </div>
                                <h3>Place Request</h3>

                                 <p><?php echo (($reqcount['value']-$myRequestCount)-($myRequestCountdel+ $myfinalCount))." <span class='hidden-xs'> out of ".$reqcount['value']." Requests Remaining </span>"; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 top_box text-center my_requests <?php if($lastword=="requestlist") { echo "active"; } ?>">
                    <div class="thumbnail event">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>">
                        <div class="caption  <?php if($lastword=="requestlist") { echo "active"; } ?>">
                            <p>Click here to view the list of all currently Open requests placed by you.</p>
                             <p><?php echo $this->Html->image('white-my-request-icon.png'); ?>     <?php //echo $number; ?>
                               My Requests
                             </p>
                        </div>

                        <div class="description padding0">
                            <div class="icon">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('my-request-icon.png'); ?>    
                                    <?php echo $this->Html->image('my-request-icon-white.png'); ?> 
                                    <?php //echo $number; ?>
                                </div>
                                <h3>My Requests</h3>
                                <p class="myrequestcount_mobile"><?php echo $myRequestCount; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 top_box text-center respond_to_request <?php if($lastword=="respondtorequest" || $lastword=="respondtorequest?success") { echo "active"; } ?>">            
                    <div class="thumbnail event">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>">
                        <div class="caption  <?php if($lastword=="respondtorequest" || $lastword=="respondtorequest?success") { echo "active"; } ?>">
                            <p>Click here to view, And Respond to Requirements placed by other users.</p>
                            <p><?php echo $this->Html->image('white-back-icon.png'); ?>
                              Respond To Request
                             </p>
                        </div>

                        <div class="description padding0">
                            <div class="icon">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('back-icon.png'); ?> 
                                    <?php echo $this->Html->image('back-icon-white.png'); ?>
                                </div>
                                <h3>Respond To Request</h3>
                                <p class="respondrequestcount_mobile"><?php echo $respondToRequestCount; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 top_box text-center my_responses <?php if($lastword=="myresponselist") { echo "active"; } ?>">            
                    <div class="thumbnail event">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'myresponselist')) ?>">
                        <div class="caption  <?php if($lastword=="myresponselist") { echo "active"; } ?>">
                            <p>Click here to view all currently open Requests, You have Respoded to.</p>
                             <p><?php echo $this->Html->image('white-my-resposes-head.png'); ?>     <?php //echo $number; ?>
                             My Responses                     
                             </p>
                        </div>

                        <div class="description padding0">
                            <div class="icon">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('my-resposes-head.png'); ?> 
                                    <?php echo $this->Html->image('my-resposes-head-white.png'); ?> 
                                    <?php //echo $number; ?>
                                </div>
                                <h3>My Responses</h3>
                                <p class="myresponsecount_mobile"><?php echo $myReponseCount; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
               <?php } ?>


                <?php if($users['role_id'] == 3 ){?>
               <div class="col-lg-3 bormob col-md-3 col-sm-3 col-xs-6 top_box text-center respond_to_request <?php if($lastword=="respondtorequest") { echo "active"; } ?>">            
                    <div class="thumbnail event">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>">
                        <div class="caption <?php if($lastword=="respondtorequest" || $lastword=="respondtorequest?success") { echo "active"; } ?>">
                            <p>Click here to view, And Respond to Requirements placed by other users.</p>
                            <p><?php echo $this->Html->image('white-back-icon.png'); ?>     <?php //echo $number; ?>
                              Respond To Request
                             </p>
                        </div>

                        <div class="description padding0">
                            <div class="icon">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('back-icon.png'); ?>
                                    <?php echo $this->Html->image('back-icon-white.png'); ?>
                                    <?php //echo $number; ?>
                                </div>
                                <h3>Respond To Request</h3>
                                <p class="respondrequestcount_mobile"><?php echo $respondToRequestCount; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                 
                 <div class="col-lg-3 bormob col-md-3 col-sm-3 col-xs-6 top_box text-center my_responses <?php if($lastword=="myresponselist") { echo "active"; } ?>">            
                    <div class="thumbnail event">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'myresponselist')) ?>">
                        <div class="caption <?php if($lastword=="myresponselist") { echo "active"; } ?>">
                            <p>Click here to view all currently open Requests, You have Respoded to.</p>
                             <p><?php echo $this->Html->image('white-my-resposes-head.png'); ?>     <?php //echo $number; ?>
                             My Responses
                             </p>
                        </div>

                        <div class="description padding0">
                            <div class="icon">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('my-resposes-head.png'); ?>
                                    <?php echo $this->Html->image('my-resposes-head-white.png'); ?>
                                </div>
                                <h3>My Responses</h3>
                                <p class="myresponsecount_mobile"><?php echo $myReponseCount; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <?php } ?>
		<?php if($users['role_id'] == 2 ){ ?>
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 bormob top_box text-center place_request <?php if($lastword=="sendrequest") { echo "active"; } ?>">
                    <div class="thumbnail event">  
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'sendrequest')) ?>">
                        <div class="caption <?php if($lastword=="sendrequest") { echo "active"; } ?>">
                            <p>Click here to fill your Requirement for Travel Package, Hotel or Transportation.</p>
                            <p><?php echo $this->Html->image('white-place-request-icon.png'); ?>     <?php //echo $number; ?>
                                Place Request
                             </p>
                        </div>

                        <div class="description padding0">
                            <div class="icon">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('place-request-icon.png'); ?>
                                    <?php echo $this->Html->image('place-request-icon-white.png'); ?>
                                </div>
                                <h3>Place Request</h3>
                                 <p><?php echo (($reqcount['value']-$myRequestCount)-($myRequestCountdel+ $myfinalCount))." <span class='hidden-xs'> out of ".$reqcount['value']." Requests Remaining </span>"; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                 
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 bormob top_box text-center my_requests <?php if($lastword=="requestlist") { echo "active"; } ?>">
                    <div class="thumbnail event">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>">
                        <div class="caption <?php if($lastword=="requestlist") { echo "active"; } ?>">
                            <p>Click here to view the list of all currently Open requests placed by you.</p>
                             <p><?php echo $this->Html->image('white-my-request-icon.png'); ?>     <?php //echo $number; ?>
                               My Requests
                             </p>
                        </div>

                        <div class="description padding0">
                            <div class="icon">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('my-request-icon.png'); ?>  .
                                    <?php echo $this->Html->image('my-request-icon-white.png'); ?> 
                                    <?php //echo $number; ?>
                                </div>
                                <h3>My Requests</h3>
                                <p class="myrequestcount_mobile"><?php echo $myRequestCount; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                 <?php } ?></div>    
<?php } else { ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top_box text-center padding0 mobile_bar hidden-md hidden-lg hidden-sm ">  
               <?php if($users['role_id'] == 1){ ?>
               <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 top_box text-center place_request <?php if($lastword=="sendrequest") { echo "active"; } ?>">
                    <div class="thumbnail event <?php if($lastword=="sendrequest") { echo "active"; } ?>">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'sendrequest')) ?>">
                        <div class="caption <?php if($lastword=="sendrequest") { echo "active"; } ?>">
                            <p>Click here to fill your Requirement for Travel Package, Hotel or Transportation.</p>
                            <p><?php echo $this->Html->image('white-place-request-icon.png'); ?>     <?php //echo $number; ?>
                                Place Request
                             </p>
                        </div>

                        <div class="description padding0">
                            <div class="icon">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('place-request-icon.png'); ?>    
                                    <?php echo $this->Html->image('place-request-icon-white.png'); ?>   
                                    <?php //echo $number; ?>
                                </div>
                                <h3>Place Request</h3>
                                 <p><?php echo (($reqcount['value']-$myRequestCount)-($myRequestCountdel+ $myfinalCount))." <span class='hidden-xs'> out of ".$reqcount['value']." Requests Remaining </span>"; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 top_box text-center my_requests <?php if($lastword=="requestlist") { echo "active"; } ?>">
                    <div class="thumbnail event <?php if($lastword=="requestlist") { echo "active"; } ?>">

                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>">
                        <div class="caption  <?php if($lastword=="requestlist") { echo "active"; } ?>">
                            <p>Click here to view the list of all currently Open requests placed by you.</p>
                             <p><?php echo $this->Html->image('white-my-request-icon.png'); ?>     <?php //echo $number; ?>
                               My Requests
                             </p>
                        </div>

                        <div class="description padding0">
                            <div class="icon">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('my-request-icon.png'); ?>    
                                    <?php echo $this->Html->image('my-request-icon-white.png'); ?> 
                                    <?php //echo $number; ?>
                                </div>
                                <h3>My Requests</h3>
                                <p class="myrequestcount_mobile"><?php echo $myRequestCount; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 top_box text-center respond_to_request <?php if($lastword=="respondtorequest" || $lastword=="respondtorequest?success" ) { echo "active"; } ?>">            
                    <div class="thumbnail event <?php if($lastword=="respondtorequest") { echo "active"; } ?>">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>">
                        <div class="caption  <?php if($lastword=="respondtorequest" || $lastword=="respondtorequest?success") { echo "active"; } ?>">
                            <p>Click here to view, And Respond to Requirements placed by other users.</p>
                            <p><?php echo $this->Html->image('white-back-icon.png'); ?>
                              Respond To Request
                             </p>
                        </div>

                        <div class="description padding0">
                            <div class="icon">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('back-icon.png'); ?> 
                                    <?php echo $this->Html->image('back-icon-white.png'); ?>
                                </div>
                                <h3>Respond To Request</h3>
                                <p class="respondrequestcount_mobile"><?php echo $respondToRequestCount; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
    
                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 top_box text-center my_responses <?php if($lastword=="myresponselist") { echo "active"; } ?>">            
                    <div class="thumbnail event <?php if($lastword=="myresponselist") { echo "active"; } ?>">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'myresponselist')) ?>">
                        <div class="caption  <?php if($lastword=="myresponselist") { echo "active"; } ?>">
                            <p>Click here to view all currently open Requests, You have Respoded to.</p>
                             <p><?php echo $this->Html->image('white-my-resposes-head.png'); ?>     <?php //echo $number; ?>
                             My Responses
                             </p>
                        </div>
					<div class="description padding0">
                            <div class="icon">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('my-resposes-head.png'); ?> 
                                    <?php echo $this->Html->image('my-resposes-head-white.png'); ?> 
                                    <?php //echo $number; ?>
                                </div>
                                <h3>My Responses</h3>
                                <p class="myresponsecount_mobile"><?php echo $myReponseCount; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
               <?php } ?>


                <?php if($users['role_id'] == 3 ){?>
               <div class="col-lg-6 bormob col-md-6 col-sm-6 col-xs-6 top_box text-center respond_to_request <?php if($lastword=="respondtorequest") { echo "active"; } ?>">            
                    <div class="thumbnail event <?php if($lastword=="respondtorequest") { echo "active"; } ?>">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>">
                        <div class="caption <?php if($lastword=="respondtorequest" || $lastword=="respondtorequest?success") { echo "active"; } ?>">
                            <p>Click here to view, And Respond to Requirements placed by other users.</p>
                            <p><?php echo $this->Html->image('white-back-icon.png'); ?>     <?php //echo $number; ?>
                              Respond To Request
                             </p>
                        </div>

                        <div class="description padding0">
                            <div class="icon">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('back-icon.png'); ?>
                                    <?php echo $this->Html->image('back-icon-white.png'); ?>
                                    <?php //echo $number; ?>
                                </div>
                                <h3>Respond To Request</h3>
                                <p class="respondrequestcount_mobile"><?php echo $respondToRequestCount; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 bormob col-md-6 col-sm-6 col-xs-6 top_box text-center my_responses <?php if($lastword=="myresponselist") { echo "active"; } ?>"> 
                    <div class="thumbnail event <?php if($lastword=="myresponselist") { echo "active"; } ?>">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'myresponselist')) ?>">
                        <div class="caption <?php if($lastword=="myresponselist") { echo "active"; } ?>">
                            <p>Click here to view all currently open Requests, You have Respoded to.</p>
                             <p><?php echo $this->Html->image('white-my-resposes-head.png'); ?>     <?php //echo $number; ?>
                             My Responses
                             </p>
                        </div>

                        <div class="description padding0">
                            <div class="icon">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('my-resposes-head.png'); ?>
                                    <?php echo $this->Html->image('my-resposes-head-white.png'); ?>
                                </div>
                                <h3>My Responses</h3>
                                <p class="myresponsecount_mobile"><?php echo $myReponseCount; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <?php } ?>
					<?php if($users['role_id'] == 2 ){ ?>
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 bormob  top_box text-center place_request <?php if($lastword=="sendrequest") { echo "active"; } ?>">
                    <div class="thumbnail event <?php if($lastword=="sendrequest") { echo "active"; } ?>">  
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'sendrequest')) ?>">
                        <div class="caption <?php if($lastword=="sendrequest") { echo "active"; } ?>">
                            <p>Click here to fill your Requirement for Travel Package, Hotel or Transportation.</p>
                            <p><?php echo $this->Html->image('white-place-request-icon.png'); ?>     <?php //echo $number; ?>
                                Place Request
                             </p>
                        </div>

                        <div class="description padding0">
                            <div class="icon">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('place-request-icon.png'); ?>
                                    <?php echo $this->Html->image('place-request-icon-white.png'); ?>
                                </div>
                                <h3>Place Request</h3>
                                 <p><?php echo (($reqcount['value']-$myRequestCount)-($myRequestCountdel+ $myfinalCount))." <span class='hidden-xs'>out of ".$reqcount['value'] ." Requests Remaining</span>"; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 bormob  col-sm-3 col-xs-6 top_box text-center my_requests <?php if($lastword=="requestlist") { echo "active"; } ?>">
                    <div class="thumbnail event <?php if($lastword=="requestlist") { echo "active"; } ?>">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>">
                        <div class="caption <?php if($lastword=="requestlist") { echo "active"; } ?>">
                            <p>Click here to view the list of all currently Open requests placed by you.</p>
                             <p><?php echo $this->Html->image('white-my-request-icon.png'); ?>     <?php //echo $number; ?>
                               My Requests
                             </p>
                        </div>

                        <div class="description padding0">
                            <div class="icon">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('my-request-icon.png'); ?>  .
                                    <?php echo $this->Html->image('my-request-icon-white.png'); ?> 
                                    <?php //echo $number; ?>
                                </div>
                                <h3>My Requests</h3>
                                <p class="myrequestcount"><?php echo $myRequestCount; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                 <?php } ?>
   </div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top_box text-center padding0 small_box hidden-xs">
               <?php if($users['role_id'] == 1){ ?>
               <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 top_box text-center place_request">
                    <div class="thumbnail event">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'sendrequest')) ?>">    <div class="description padding0">
                            <div class="icon <?php if($lastword=="sendrequest") { echo "active"; } ?>">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('place-request-icon.png'); ?>    
                                    <?php echo $this->Html->image('place-request-icon-white.png'); ?>   
                                    <?php //echo $number; ?>
                                </div>
                                <h3>Place Request</h3>
(<?php 


echo (($reqcount['value']-$myRequestCount)-($myRequestCountdel+ $myfinalCount)); ?>) 
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 top_box text-center my_requests">
                    <div class="thumbnail event">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>">
                        <div class="description padding0">
                            <div class="icon  <?php if($lastword=="requestlist") { echo "active"; } ?>">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('my-request-icon.png'); ?>    
                                    <?php echo $this->Html->image('my-request-icon-white.png'); ?> 
                                    <?php //echo $number; ?>
                                </div>
                                <h3>My Requests</h3>
<p class="myrequestcount"><?php echo $myRequestCount; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 top_box text-center respond_to_request">            
                    <div class="thumbnail event">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>">
                        <div class="description padding0">
                            <div class="icon <?php if($lastword=="respondtorequest" || $lastword=="respondtorequest?success") { echo "active"; } ?>">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('back-icon.png'); ?> 
                                    <?php echo $this->Html->image('back-icon-white.png'); ?>
                                    <?php //echo $number; ?>
                                </div>
                                <h3>Respond To Request</h3> 
<p class="respondrequestcount"><?php echo $respondToRequestCount; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 top_box text-center my_responses">
                    <div class="thumbnail event">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'myresponselist')) ?>">
                         <div class="description padding0">
                            <div class="icon <?php if($lastword=="myresponselist") { echo "active"; } ?>">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('my-resposes-head.png'); ?> 
                                    <?php echo $this->Html->image('my-resposes-head-white.png'); ?> 
                                    <?php //echo $number; ?>
                                </div>
                                <h3>My Responses</h3>
<p class="myresponsecount"><?php echo $myReponseCount; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
               <?php } ?>


                <?php if($users['role_id'] == 3 ){ ?>
               <div class="col-lg-3 bormob col-md-3 col-sm-3 col-xs-6 top_box text-center respond_to_request">
                    <div class="thumbnail event">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>">
                         <div class="description padding0">
                            <div class="icon  <?php if($lastword=="respondtorequest" || $lastword=="respondtorequest?success") { echo "active"; } ?>">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('back-icon.png'); ?>
                                    <?php echo $this->Html->image('back-icon-white.png'); ?>
                                    <?php //echo $number; ?>
                                </div>
                                <h3>Respond To Request</h3>
								<p class="respondrequestcount"><?php echo $respondToRequestCount; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                 <div class="col-lg-3 bormob col-md-3 col-sm-3 col-xs-6 top_box text-center my_responses">
                    <div class="thumbnail event">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'myresponselist')) ?>">
                         <div class="description padding0">
                            <div class="icon  <?php if($lastword=="myresponselist") { echo "active"; } ?>">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('my-resposes-head.png'); ?>
                                    <?php echo $this->Html->image('my-resposes-head-white.png'); ?>
                                    <?php //echo $number; ?>
                                </div>
                                <h3>My Responses</h3> <p class="myresponsecount"><?php echo $myReponseCount; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <?php } ?>
					<?php if($users['role_id'] == 2 ){ ?>
             <div class="col-lg-3 col-md-3 col-sm-3 bormob col-xs-3 top_box text-center place_request">
                    <div class="thumbnail event">  
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'sendrequest')) ?>">
                         <div class="description padding0">
                            <div class="icon  <?php if($lastword=="sendrequest") { echo "active"; } ?>">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('place-request-icon.png'); ?>    
                                    <?php echo $this->Html->image('place-request-icon-white.png'); ?>  
                                    <?php //echo $number; ?>
                                </div>
                                <h3>Place Request</h3>(<?php echo (($reqcount['value']-$myRequestCount)-($myRequestCountdel+ $myfinalCount)); ?>)
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 bormob col-xs-3 top_box text-center my_requests">
                    <div class="thumbnail event">
                        <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'requestlist')) ?>">     <div class="description padding0">
                            <div class="icon  <?php if($lastword=="requestlist") { echo "active"; } ?>">
                                <div class="icon-head">
                                    <?php echo $this->Html->image('my-request-icon.png'); ?>  
                                    <?php echo $this->Html->image('my-request-icon-white.png'); ?> 
                                    <?php //echo $number; ?>
                                </div>
                                <h3>My Requests</h3><p class="myrequestcount"><?php echo $myRequestCount; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                 <?php } ?>
   </div>

<?php } ?>