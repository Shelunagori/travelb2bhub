 <link rel="stylesheet" href="../../css/jquery-ui.css">
 <link rel="stylesheet" href="../../css/ap-filters.css">
  <?php echo $this->Html->script(['jquery.validate']);?>
<?php
use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');
?>
  <div class="container-fluid" id="checkresponses">
    <div class="row equal_column">
      <?php echo $this->element('left_panel');?>
	  <!--Page Title-->
		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 padding0 ">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 border_bottom">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 ">
                     <h4 class="title">Check Responses</h4>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 ">
                        <!--<a href="javascript:void(0)" onclick="window.history.back();">Go Back</a>-->
                                                <!-- <a href="/users/dashboard" class="link-icon"><img src="/img/arrow.png" alt=""/></a> -->
                       <ul class="top-icons-wrap">
 <li>
 <a href="javascript:void(0);" class="link-icon" data-toggle="modal" data-target="#myModal123" >
 <img src="/img/sortarrow.png" alt=""></a> </li>
 
 <!--a title="Quotation price higher to lower" 
 href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'checkresponses', $requestidval)) ?>?sort=quotationprice&order=DESC"  >
 <img src="/img/down.png" alt="down"></a> 
  
 <a title="Quotation price lower to higher" 
 href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'checkresponses', $requestidval)) ?>?sort=quotationprice&order=ASC"  >
 <img src="/img/up.png" alt="up"></a--> 
  <li>
 <a href="javascript:void(0);" class="link-icon" data-toggle="modal" data-target="#myModal122" ><img src="/img/white-filter.png" alt=""></a> </li>
					<li class="notification_list">
<a href="javascript:void(0);" id="chat_icon" class="link-icon"><span class="chat_count"><?php echo $chatCount;?></span><img src="/img/notify.png" alt=""></a>
                            <div class="ap-subs">
                                <ul class="list-unstyled msg_list" role="menu">
                  <?php echo $this->element('subheader');?>
	  <!--ap top filters-->
      <hr class="hr_bordor">
      
      <div id="myModal123" class="modal fade form-modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sorting</h4>
      </div>
      <div class="modal-body">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-event">
     <ul class="sorting_ul">     
<li class="col-md-12 col-xs-12 col-sm-12"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$responseid)) ?>?sort=totalbudgethl">Total Budget (High To Low) <span class="arrow"><span></span></span></a> </li>
<li class="col-md-12 col-xs-12 col-sm-12"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$responseid)) ?>?sort=totalbudgetlh"> Total Budget (Low To High)<span class="arrow"><span></span></span></a></li>
<li class="col-md-12 col-xs-12 col-sm-12"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$responseid)) ?>?sort=quotedpricehl">Quoted Price (High To Low) <span class="arrow"><span></span></span></a> </li>
<li class="col-md-12 col-xs-12 col-sm-12"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$responseid)) ?>?sort=quotedpricelh"> Quoted Price (Low To High)<span class="arrow"><span></span></span></a></li>
<li class="col-md-12 col-xs-12 col-sm-12"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$responseid)) ?>?sort=chatshl">Chats (High To Low) <span class="arrow"><span></span></span></a> </li>
<li class="col-md-12 col-xs-12 col-sm-12"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$responseid)) ?>?sort=chatslh"> Chats (Low To High)<span class="arrow"><span></span></span></a></li>
<li class="col-md-12 col-xs-12 col-sm-12"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$responseid)) ?>?sort=agentaz"> Agent Name (A To Z) <span class="arrow"><span></span></span></a></li>
<li class="col-md-12 col-xs-12 col-sm-12"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'checkresponses',$responseid)) ?>?sort=agentza"> Agent Name (Z To A)<span class="arrow"><span></span></span></a></li>
            </ul>
              </div>
          </div>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
 
      
	   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center margin-b10">
		  
		  <a data-toggle="modal" data-target="#detailModal" href="#" class="btn btn-submit">Details</a>
        </div>
      <!--ap filters-->
  <div id="myModal122" class="modal fade form-modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Filter</h4>
      </div>
      <div class="modal-body">
           <form method="get" class="filter_box">
               
      <div class="form-group row margin-b10">
           <label for="example-text-input" class="col-md-3 col-form-label">Name: </label> 
           <div class="col-md-9">             
               <input type="text" name="agentname" value="<?php echo isset($_GET['agentname'])? $_GET['agentname']:''; ?>"  class="form-control">
           </div>
      </div>
         
       <div class="form-group row margin-b10">
           <label for="example-text-input" class="col-md-3 col-form-label">Reference ID: </label>
           <div class="col-md-9">           
               <input type="text" name="refidsearch" value="<?php echo isset($_GET['refidsearch'])? $_GET['refidsearch']:''; ?>"  class="form-control">
          </div>
      </div>
               
               
      <div class="form-group row margin-b10">
           <label for="example-text-input" class="col-md-3 col-form-label">Budget: </label> 
           <div class="col-md-9">           
               <select name="budgetsearch" class="form-control"><option value="">Select Budget</option><option value="0-10000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="0-10000")? 'selected':''; ?>>0-10000</option><option value="10000-30000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="10000-30000")? 'selected':''; ?>>10000-30000</option><option value="30000-50000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="30000-50000")? 'selected':''; ?>>30000-50000</option><option value="50000-100000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="50000-100000")? 'selected':''; ?>>50000-100000</option></select>
           </div>
     </div>
               
               
      <div class="form-group row margin-b10">
           <label for="example-text-input" class="col-md-3 col-form-label">Quoted Price: </label>
           <div class="col-md-9">            
               <select name="quotesearch" class="form-control"><option value="">Select Quoted Price</option><option value="0-10000" <?php echo (isset($_GET['quotesearch']) && $_GET['quotesearch'] =="0-10000")? 'selected':''; ?>>0-10000</option><option value="10000-30000" <?php echo (isset($_GET['quotesearch']) && $_GET['quotesearch'] =="10000-30000")? 'selected':''; ?>>10000-30000</option><option value="30000-50000" <?php echo (isset($_GET['quotesearch']) && $_GET['quotesearch'] =="30000-50000")? 'selected':''; ?>>30000- 50000</option><option value="50000-100000" <?php echo (isset($_GET['quotesearch']) && $_GET['quotesearch'] =="50000-100000")? 'selected':''; ?>>50000-100000</option></select>
            </div>
     </div>
     <div class="form-group row margin-b10">
           <label for="example-text-input" class="col-md-3 col-form-label">Chat With: </label>
           <div class="col-md-9">            
               <select name="chatwith" class="form-control"><option value="">Select Chat With</option>
               <?php if(!empty($UserResponse)){ 
					foreach($UserResponse as $user){               
               ?>
               <option <?php echo (isset($_GET['chatwith']) && $_GET['chatwith'] ==$user['user']['id'])? 'selected':''; ?> value="<?php echo $user['user']['id']?>"><?php echo $user['user']['first_name'].' '.$user['user']['last_name']?></option>
               <?php }}?>
               </select>
            </div>
     </div>
     <div class="form-group row margin-b10">
           <label for="example-text-input" class="col-md-3 col-form-label">Following: </label> 
           <div class="col-md-9">          
               <input type="checkbox" name="followsearch" value="1" <?php echo isset($_GET['followsearch'])? "checked":''; ?>  >
           </div>
       </div>
        <div class="form-group row margin-b10">
           <label for="example-text-input" class="col-md-3 col-form-label">Shared Details: </label> 
           <div class="col-md-9">          
               <input type="checkbox" name="shared_details" value="1" <?php echo isset($_GET['shared_details'])? "checked":''; ?>  >
           </div>
       </div>
               
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        <input type="submit" name="submit" value="Submit"  class="btn btn-primary btn-submit">
        <a class="btn btn-primary btn-submit" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'checkresponses',$responseid)) ?>">Reset</a>
   </div>
   </form>
   <script>
   $('#datepicker1').datepicker({
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			minDate: '<?php echo date("d/m/Y"); ?>',
			onSelect: function(selected) {
				$( "#datepicker2" ).datepicker( "option", "minDate",selected);
				$('#datepicker2').val("");
			}
		});
		$('#datepicker2').datepicker({
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			minDate: '<?php echo date("d/m/Y"); ?>',
			onSelect: function(selected) {
				var checkInDate = $('#datepicker1').val();
				if(checkInDate == "") {
					alert("Please select check-in date first.");
					$('#datepicker2').val("");
				}
			}
		});
		</script>
</div>
      <div class="modal-footer">

      </div>
    </div>

  </div>
</div>
		<?php
		if(count($responses) >0) { 
			foreach($responses as $row){ ?>
			<div id="cat">
            <?php if(isset($_GET['sort']) && $_GET['sort']=="requesttype") { ?>
			<div class=" req col-lg-6 col-md-6 col-sm-12 col-xs-12" id="<?php if($row['request']['category_id']==1){ echo "1";} if($row['request']['category_id']==2){ echo "3";}if($row['request']['category_id']==3){ echo "2";} ?>">
			<?php } else { ?>
            <div class=" req col-lg-6 col-md-6 col-sm-12 col-xs-12" id="<?php echo $data['chat_count'][$row['id']]; ?>">
			   <?php } ?>
				<div class="box-event event-list text-center">
					<ul>
					<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <p>
                        <b>Request Type :</b> <?php if($row['request']['category_id']==1){ echo "<img src='../../img/slider/package-icon.png'><span class='package'> Package</span>";} if($row['request']['category_id']==2){ echo "<img src='../../img/slider/transport-icon.png'><span class='transport'>Transport</span>";}if($row['request']['category_id']==3){ echo "<img src='../../img/slider/hotelier-icon.png'><span class='hotel'>Hotel</span>";} ?>
                    </p>
               </li>
                 <li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p>
                                <b>Total Budget :</b> <?php echo "Rs. ".$row['request']['total_budget']; ?>
                            </p>
                 </li>
                        <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php if($row['response']['is_details_shared']==1){
								$hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$row['user']['id'],1));                    
                        }else{
								$hrefurl =  $this->Url->build(array('controller'=>'users','action'=>'viewprofile',$row['user']['id'],1));                   
                        }?>
                            <p>
                                <b>Agent Name :</b> <a href="<?php echo $hrefurl; ?>"> <?php echo $row['user']['first_name']; ?>&nbsp;<?php echo $row['user']['last_name']; ?> </a>
                            </p>
                        </li>
                        <li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p>
                                <b>Reference ID :</b> <?php echo $row['request']['reference_id']; ?>
                            </p>
                        </li>

                                               
                        <li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p>
                                <b>Quoted Price :</b> <?php echo ($row['quotation_price'])?"Rs. ".$row['quotation_price']:"-- --" ?>
                            </p>
                        </li>
                <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 destination">
				   <?php if($row['request']['category_id']==2){ ?>
                  <p>
                                <b>Pickup City :</b><span> <?php echo ($row['request']['pickup_city'])?$allCities[$row['request']['pickup_city']]:"-- --"; ?><?php echo ($row['request']['pickup_state'])?' ('.$allStates[$row['request']['pickup_state']].')':"";  ?></span>

                  <?php } else { ?>
                        <p>
                        <b>Destination City :</b> <span><?php echo ($row['request']['city_id'])?$allCities[$row['request']['city_id']]:"-- --"; ?> <?php echo ($row['request']['state_id'])?' ('.$allStates[$row['request']['state_id']].')':""; ?>
                        <?php if($row['request']['category_id'] == 1){
						if(count($row['request']['hotels']) >1) {
							unset($row['request']['hotels'][0]);
							//unset($details['hotels'][0]);?>
							<?php foreach($row['request']['hotels'] as $rowc) { ?>
							<?php echo ($rowc['city_id'])?','.$allCities[$rowc['city_id']]:""; ?><?php echo ($rowc['state_id'])?' ('.$allStates[$rowc['state_id']].')':""; ?>
							<?php } ?>
							<?php } ?>
							<?php } ?></span>
                        </p>
                        <?php } ?>
                 </li>
                        <?php if($row['request']['category_id'] == 3 ) { ?>
					<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <b>Start Date :</b> <?php echo ($row['request']['check_in'])?date("d/m/Y", strtotime($row['request']['check_in'])):"-- --"; ?>
                        </p>
                     </li>
					<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <b>End Date :</b> <?php echo ($row['request']['check_out'])?date("d/m/Y", strtotime($row['request']['check_out'])):"-- --"; ?>
                        </p>
                    </li>
				<?php } elseif($row['request']['category_id'] == 1 ) {?>
					<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <b>Start Date :</b> <?php echo ($row['request']['check_in'])?date("d/m/Y", strtotime($row['request']['check_in'])):"-- --"; ?>
                        </p>
                     </li>
					<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <b>End Date :</b> <?php echo ($row['request']['check_out'])?date("d/m/Y", strtotime($row['request']['check_out'])):"-- --"; ?>
                        </p>
                     </li>
				<?php } elseif($row['request']['category_id'] == 2 ) { ?>
					<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <b>Start Date :</b> <?php echo ($row['request']['start_date'])?date("d/m/Y", strtotime($row['request']['start_date'])):"-- --"; ?>
                        </p>
                    </li>
					<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <b>End Date :</b> <?php echo ($row['request']['end_date'])?date("d/m/Y", strtotime($row['request']['end_date'])):"-- --"; ?>
                        </p>
                    </li>
				<?php } ?>
				<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <b>Members :</b> <?php echo $row['request']['adult'] +  $row['request']['children']; ?>
                     </p>
                 </li>
                         <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 comment">
                            <p>
                                <b>Comment :</b> <span> <?php echo $row['comment']; ?></span>
                            </p>
                        </li>
                    </ul>
					<?php if(empty($row['request']['final_id'])) { ?>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right link padding0">
							<?php $id = $row['id'];?>
                        <div class="buttons padding0"> 
							<a id="chatcounts_<?php echo $row['id'];?>" data-toggle="modal" data-target="#myModal11<?php echo  $row['request']['id']; ?>" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'userChat', $row['request']['id'], $row["user_id"],1)) ?>">
							<?php echo $this->Html->image('chat-ico.png'); ?> Chat ( <strong><?php echo $data['chat_count'][$row['id']]; ?> </strong> )</a>
                        </div>
                        <div class="modal fade" id="myModal11<?php echo  $row['request']['id']; ?>" role="dialog">
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
							<?php
$sql="Select count(*) as block_count from blocked_users where blocked_user_id='".$row['user']['id']."' AND blocked_by='".$row['request']['user_id']."'";
$stmt = $conn->execute($sql);
$bresult = $stmt ->fetch('assoc'); 
if($bresult['block_count']>0){
$blocked = 1;
}else{
$blocked = 0;
}
							?>
                        <div class="buttons padding0"> 
							<?php if($row['is_details_shared'] != 1) { ?>
								<a href="javascript:void(0);" user_id="<?php echo $row['user']['id']; ?>" class="shareDetails" request_id = "<?php echo $row['request']['id']; ?>" response_id = "<?php echo $row['id']; ?>"><?php echo $this->Html->image('share-ico.png'); ?> Share Details</a>
							<?php } ?>
                         </div>
                        <div class="buttons padding0"> 
							<a href="javascript:void(0);" class="acceptOffer" request_id = "<?php echo $row['request']['id']; ?>" response_id = "<?php echo $row['id']; ?>"><?php echo $this->Html->image('accept-offer-ico.png'); ?> Accept Offer</a>
                         </div>
                         <div class="buttons padding0">
							 <?php if($blocked==1){?>
							 <a href="javascript:void(0);" class="unblockUser" user_id = "<?php echo $row['user']['id']; ?>"><?php echo $this->Html->image('block-user-ico.png'); ?> Blocked </a>
							 <?php }else{?>
							<a href="javascript:void(0);" class="blockUser" user_id = "<?php echo $row['user']['id']; ?>"><?php echo $this->Html->image('block-user-ico.png'); ?> Block User </a>
						  <?php }?>
							 <?php $reviewi =  $row['user']['id']."-".$row['request']['id']; ?>
						 <a data-toggle="modal" style="display:none;" data-target="#myModal_accept<?php echo $row['id']; ?>" id="add_review"
href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'addtestimonial',  $reviewi)) ?>">
Test</a>
						 </div>
							<?php if( !array_key_exists($row["user"]["id"], $BusinessBuddies)) {?>
                    <div class="buttons padding0">  
						<span class="budy right"><a href="javascript:void(0);" class="businessBuddy" user_id = "<?php echo $row["user"]["id"]; ?>"><?php echo $this->Html->image('friend-ico.png'); ?></a></span>
                    </div>
					<?php } ?>
						</div>
		<div class="modal fade" id="myModal_accept<?php echo $row['id']; ?>" role="dialog">
		<div class="modal-dialog">
		<!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Add Review</h4>
			</div>
			<div class="modal-body">
			
			</div>
		  </div>
		</div>
	</div>
					<?php } ?>
				    </div>
				</div>
			<?php } ?>
			<div class="pages"></div>
		<?php }else {?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-event">
<?php if(isset($_GET['req_typesearch'])){ echo "No matching data.";}else{ echo "There are no responses in mailbox.";}?>
                </div>
			</div>
		<?php } ?>
      </div>
      </div>
      </div>
    </div>
</div>
	<div class="modal fade" id="myModal2" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Rating</h4>
			</div>
			<div class="modal-body">
				<div class="form text-center">
					<?php  echo $this->Form->create("Users", ['type' => 'file', 'url' => ['controller' => 'Users', 'action' => 'rateUser'],'onSubmit' => 'return UserRatingForm();', 'id'=>"UserRatingForm"]); ?>
					<input type="hidden" name="rating_request_id" id="rating_request_id">
					<input type="hidden" name="rating_user_id" id="rating_user_id">
					<h2>Select Rating</h2>
                    <fieldset id='demo1' class="rating">
                        <input class="stars" type="radio" id="star5" name="rating" value="5" />
                        <label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input class="stars" type="radio" id="star4" name="rating" value="4" />
                        <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input class="stars" type="radio" id="star3" name="rating" value="3" />
                        <label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input class="stars" type="radio" id="star2" name="rating" value="2" />
                        <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input class="stars" type="radio" id="star1" name="rating" value="1" />
                        <label class = "full" for="star1" title="Sucks big time - 1 star"></label>

                    </fieldset>
					<div style='clear:both;'></div>
					<!-- <div class="margi1">
						<input type="submit" name="submit" class="btn btn-primary btn-block " value="Submit">
					</div> -->
					</form>
				</div>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		  </div>
		</div>
	</div>

	<!--modal-->
	<div class="modal fade" id="detailModal" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button>
<?php if($requestDetails['category_id'] == 1){ ?><h4 class="modal-title">Package Details</h4><?php } ?>
<?php if($requestDetails['category_id'] == 2){ ?><h4 class="modal-title">Transport Details</h4><?php } ?>
<?php if($requestDetails['category_id'] == 3){ ?><h4 class="modal-title">Hotel Details</h4><?php }?>
</div>
<div class="modal-body"><div class="container-fluid" id="profile"><div class="row tra-section-gray equal_column">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 ">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 general_requirements"><h2 class="text-center">General Requirements</h2>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-event ">
<ul>                  <li class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                        <p><b>Reference ID: </b> <?php echo $requestDetails['reference_id']; ?></p>
                   </li>
<li class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><p><b>Total Budget: </b> <?php echo $requestDetails['total_budget']." Rs."; ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-6"><p><b>Adult: </b> <?php echo $requestDetails['adult']; ?></p></li>
<li class="col-lg-6 col-md-6 col-sm-6	 col-xs-6"><p><b>Children below 6: </b> <?php echo $requestDetails['children']; ?></p></li>
				<?php if($requestDetails['category_id'] == 1 || $requestDetails['category_id'] == 3){ ?>
</ul></div></div>
<?php if($requestDetails['category_id'] == 1){
						if(count($requestDetails['hotels']) >=1) { 
							//unset($requestDetails['hotels'][0]);?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 stay_requirements">
                 <h2 class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">Stay Requirements <!--Another Destination Details--></h2>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-event stay_requirements">
							<?php
							$ds_count = 1;
							foreach($requestDetails['hotels'] as $row) { ?>
							<h4 class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">Destination <?php echo $ds_count; ?></h4>
<ul>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><p><b>Single: </b> <?php if($row['room1'] != ''){ echo $row['room1'];}else{ echo "--";} ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><p><b>Double: </b> <?php if($row['room2'] != ''){ echo $row['room2'];}else{ echo "--";} ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><p><b>Triple: </b> <?php if($row['room3'] != ''){ echo $row['room3'];}else{ echo "--";} ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><p><b>Child With Bed: </b> <?php if($row['child_with_bed'] != ''){ echo $row['child_with_bed'];}else{ echo "-- --";} ?>
</p></li>
<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<p><b>Child Without Bed: </b> <?php if($row['child_without_bed'] != ''){ echo $row['child_without_bed'];}else{ echo "-- --";} ?></p></li>
<li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<p><b>Hotel Category: </b> 
<?php if(!empty($row['hotel_category'])) {
                                                $result = explode(",", $row['hotel_category']);
                                                $count = 1;
                                                $hotel_category = "";
                                                foreach($result as $row1) {
                                                    $hotel_category .= "".$hotelCategories[$row1]." or ";
                                                    //echo $count.". ".$hotelCategories[$row1].", ";
                                                    $count++;
                                                }
                                              echo substr($hotel_category, 0, -3);
                                            } else {
                                                echo "-- --";	
                                            }?>
                                        </p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
<p><b>Hotel Rating:</b> <?php
                   
                if($row['hotel_rating']>0){
               
                    for($i=$row['hotel_rating']; $i>0; $i--){
                        echo '<i class="fa fa-star"></i>';
                    }
                }else{
                  
                }
                ?></p>

</li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-offset-right-1">
<p><b>Meal: </b> <?php echo ($row['meal_plan'])?$mealPlanArray[$row['meal_plan']]:"-- --"; ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-6"><p><b>Check In: </b> <?php echo ($row['check_in'])?date("d/m/Y", strtotime($row['check_in'])):"-- --"; ?>
                                         </p></li>
<li class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><p><b>Check Out: </b> <?php echo ($row['check_out'])?date("d/m/Y", strtotime($row['check_out'])):"-- --"; ?>
</p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><p><b>Locality: </b> <?php echo ($row['locality'])?$row['locality']:"-- --"; ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><p><b>Destination City: </b> <?php echo ($row['city_id'])?$allCities[$row['city_id']]:"-- --"; ?> </p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><p><b>Destination State: </b> <?php echo ($row['state_id'])?$allStates[$row['state_id']]:"-- --"; ?>
</p></li>

</ul>
							<?php $ds_count++; } ?>
								</div></div>
						<?php } ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 transport_requirements">
                <h2 class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">Transport Requirements</h2>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center box-event">
<ul><li class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
<p><b>Transport: </b> <?php echo ($requestDetails['transport_requirement'])?$transpoartRequirmentArray[$requestDetails['transport_requirement']]:"-- --"; ?></p></li>
<li class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
<p><b>Start Date: </b> <?php echo ($requestDetails['start_date'])?date("d/m/Y", strtotime($requestDetails['start_date'])):"-- --"; ?></p></li>
<li class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
<p><b>End Date: </b> <?php echo ($requestDetails['end_date'])?date("d/m/Y", strtotime($requestDetails['end_date'])):"-- --"; ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><p><b>Pickup Locality: </b> <?php echo ($requestDetails['pickup_locality'])?$requestDetails['pickup_locality']:"-- --"; ?>
</p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
<p><b>Pickup City: </b> <?php echo ($requestDetails['pickup_city'])?$allCities[$requestDetails['pickup_city']]:"-- --"; ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><p><b>Pickup State: </b> <?php echo ($requestDetails['pickup_state'])?$allStates[$requestDetails['pickup_state']]:"-- --"; ?>
                            </p></li>

						<?php if(!empty($requestDetails['request_stops'])) { ?>
							<!--h4 class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">Stops</h4-->
							<?php $stop_count=1; foreach($requestDetails['request_stops'] as $stops) {?>
							<li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 stops_count">Stop <?php echo $stop_count;?></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-6"><p>
<b>Stop Locality: </b> <?php echo ($stops['locality'])?$stops['locality']:"-- --"; ?>
</p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-6"><p><b>Stop City: </b> <?php echo ($stops['city_id'])?$allCities[$stops['city_id']]:"-- --"; ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-6"><p><b>Stop State: </b>  <?php echo ($stops['state_id'])?$allStates[$stops['state_id']]:"-- --"; ?></p></li>

                        <hr>
							<?php $stop_count++; }
						} ?>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><p>
<b>Final Locality: </b> <?php echo ($requestDetails['final_locality'])?$requestDetails['final_locality']:"-- --"; ?>
</p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><p>
<b>Final City: </b> <?php echo ($requestDetails['final_city'])?$allCities[$requestDetails['final_city']]:"-- --"; ?>
</p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><p><b>Final State: </b> <?php echo ($requestDetails['final_state'])?$allStates[$requestDetails['final_state']]:"-- --"; ?>
                         </p></li>
                     </ul>
					<?php }elseif($requestDetails['category_id'] == '3'){?>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 stay_requirements">
				<h2 class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">Stay Requirements</h2>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-event stay_requirements">
							<?php
							$ds_count = 1;
							foreach($requestDetails['hotels'] as $row) { ?>
<ul>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><p><b>Single: </b> <?php if($row['room1'] != ''){ echo $row['room1'];}else{ echo "--";} ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><p><b>Double: </b> <?php if($row['room2'] != ''){ echo $row['room2'];}else{ echo "--";} ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><p><b>Triple: </b> <?php if($row['room3'] != ''){ echo $row['room3'];}else{ echo "--";} ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><p><b>Child With Bed: </b> <?php if($row['child_with_bed'] != ''){ echo $row['child_with_bed'];}else{ echo "-- --";} ?>
</p></li>
<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<p><b>Child Without Bed: </b> <?php if($row['child_without_bed'] != ''){ echo $row['child_without_bed'];}else{ echo "-- --";} ?></p></li>

<li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<p><b>Hotel Category: </b> 
<?php if(!empty($row['hotel_category'])) {
                                                $result = explode(",", $row['hotel_category']);
                                                $count = 1;
                                                $hotel_category = "";
                                                foreach($result as $row1) {
                                                    $hotel_category .= "".$hotelCategories[$row1]." or ";
                                                    //echo $count.". ".$hotelCategories[$row1].", ";
                                                    $count++;
                                                }
                                              echo substr($hotel_category, 0, -3);
                                            } else {
                                                echo "-- --";	
                                            }?>
                                        </p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
<p><b>Hotel Rating:</b> <?php
                   
                if($row['hotel_rating']>0){
               
                    for($i=$row['hotel_rating']; $i>0; $i--){
                        echo '<i class="fa fa-star"></i>';
                    }
                }else{
                  
                }
                ?></p>

</li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-offset-right-1">
<p><b>Meal: </b> <?php echo ($row['meal_plan'])?$mealPlanArray[$row['meal_plan']]:"-- --"; ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-6"><p><b>Check In: </b> <?php echo ($row['check_in'])?date("d/m/Y", strtotime($row['check_in'])):"-- --"; ?>
                                         </p></li>
<li class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><p><b>Check Out: </b> <?php echo ($row['check_out'])?date("d/m/Y", strtotime($row['check_out'])):"-- --"; ?>
</p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><p><b>Locality: </b> <?php echo ($row['locality'])?$row['locality']:"-- --"; ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><p><b>Destination City: </b> <?php if(empty($row['city_id'])){
echo $allCities[$requestDetails['city_id']];
}else{ $allCities[$row['city_id']]; } ?> </p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><p><b>Destination State: </b> 
<?php if(empty($row['state_id'])){
echo $allStates[$requestDetails['state_id']];
}else{ $allStates[$row['state_id']]; } ?>
</p></li>

</ul>
							<?php $ds_count++; } ?>
								</div>
				</div>
				<?php }
				} else if($requestDetails['category_id'] == 2){ ?>
	
                <h2 class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">Transport Requirements</h2>
            
                <ul>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
<p><b>Transport: </b> <?php echo ($requestDetails['transport_requirement'])?$transpoartRequirmentArray[$requestDetails['transport_requirement']]:"-- --"; ?>
</p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
<p><b>Start Date: </b> <?php echo ($requestDetails['start_date'])?date("d/m/Y", strtotime($requestDetails['start_date'])):"-- --"; ?>
</p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
<p><b>End Date: </b> <?php echo ($requestDetails['end_date'])?date("d/m/Y", strtotime($requestDetails['end_date'])):"-- --"; ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
<p><b>Pickup Locality: </b> <?php echo ($requestDetails['pickup_locality'])?$requestDetails['pickup_locality']:"-- --"; ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
<p><b>Pickup City: </b> <?php echo ($requestDetails['pickup_city'])?$allCities[$requestDetails['pickup_city']]:"-- --"; ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
<p><b>Pickup State: </b> <?php echo ($requestDetails['pickup_state'])?$allStates[$requestDetails['pickup_state']]:"-- --"; ?></p></li>

                
					<?php if(!empty($requestDetails['request_stops'])) { ?>
						<!--h2 class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">Stops</h2-->
						<?php $stop_count=1; foreach($requestDetails['request_stops'] as $stops) {?>
						<li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 stops_count">Stop <?php echo $stop_count;?></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-6"><p><b>Stop Locality: </b> <?php echo ($stops['locality'])?$stops['locality']:"-- --"; ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-6"><p><b>Stop City: </b> <?php echo ($stops['city_id'])?$allCities[$stops['city_id']]:"-- --"; ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-6"><p><b>Stop State: </b> <?php echo ($stops['state_id'])?$allStates[$stops['state_id']]:"-- --"; ?></p></li>
                          
							<hr>
						<?php $stop_count++; }
					} ?>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><p>
<b>Final Locality: </b> <?php echo ($requestDetails['final_locality'])?$requestDetails['final_locality']:"-- --"; ?>
</p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
<p><b>Final City: </b> <?php echo ($requestDetails['final_city'])?$allCities[$requestDetails['final_city']]:"-- --"; ?></p></li>
<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><p>
<b>Final State: </b> <?php echo ($requestDetails['final_state'])?$allStates[$requestDetails['final_state']]:"-- --"; ?></p></li>
</ul>
				<?php } ?>
				
			     </div></div>
			     <?php if(!empty($requestDetails['comment'])){
if($requestDetails['category_id'] == 2 || $requestDetails['category_id'] == 1){$comment_class="tcomments";}else{$comment_class="comments";}			     
			     ?>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 <?php echo $comment_class;?> ">
		<h2 class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">Comments</h2>
		<ul style="list-style: none;padding: 0;">
<li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left comment" style="display: inline-block;padding: 0 5px!important;">
<p style="margin-bottom: 0;"><?php echo $requestDetails['comment']; ?></p></li>		
		</ul>
		</div><?php }?>    
			     </div></div></div>			
			</div></div>
		</div>
	</div>
	<!--/modal-->
<?php echo $this->element('footer');?>
<?php echo $this->Html->script(['https://code.jquery.com/ui/1.12.1/jquery-ui.js']);?>
<?php echo $this->Html->script(['jquery-ui-slider-pips.js']);?>
<?php echo $this->Html->script(['ap.pagination.js']);?>
<?php if(isset($_GET['sort']) && $_GET['sort']=="chatslh") { ?>
<script>
$(document).ready(function(){

$(".req").sort(function (a, b) {
    return parseInt(a.id) > parseInt(b.id);
}).each(function () {
    var elem = $(this);
    elem.remove();
    $(elem).appendTo("#cat");
});
   })
</script>
<?php } ?>

<?php if(isset($_GET['sort']) && $_GET['sort']=="chatshl") { ?>
<script>
$(document).ready(function(){

$(".req").sort(function (a, b) {
    return parseInt(a.id) < parseInt(b.id);
}).each(function () {
    var elem = $(this);
    elem.remove();
    $(elem).appendTo("#cat");
});

   })
</script>
<?php } ?>

<script>
$(document).ready(function () {
	$(".blockUser").click(function (e) {
		e.preventDefault();
		var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'blockUser')) ?>";
		var user_id = $(this).attr("user_id");
		if(confirm("Are you sure want to block this user?")) {
			$.ajax({
				url:url,
				type: 'POST',
				data: {user_id:user_id}
			}).done(function(result){
				if(result == 1) {
					alert("This user has been blocked successfully.");
					location.reload();
				}else if(result == 2){
				alert("This user has already blocked.");
				} else {
					alert("There is some problem, please try again.");
				}
			});
		}
	});
	
	$(".businessBuddy").click(function (e) {
		e.preventDefault();
		var __this = $(this);
		var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'addBusinessBuddy')) ?>";
		var user_id = $(this).attr("user_id");
		if(confirm("Are you sure want to follow this user?")) {
			$.ajax({
				url:url,
				type: 'POST',
				data: {user_id:user_id}
			}).done(function(result){
				if(result == 1) {
					alert("This user has been added to your following list successfully.");
					__this.parent().remove();
				} else {
					alert("There is some problem, please try again.");
				}
			});
		}
	});
	
	$(".acceptOffer").click(function (e) {
		e.preventDefault();
		var __this = $(this);
		var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'acceptOffer')) ?>";
		var request_id = $(this).attr("request_id");
		var response_id = $(this).attr("response_id");
		if(confirm("Are you sure want to accept this offer?")) {
			$.ajax({
				url:url,
				type: 'POST',
				data: {request_id:request_id, response_id:response_id}
			}).done(function(result){
				if(result == 1) {
					alert("This offer has been accepted successfully.");
					//$('#myModal_accept').modal('show');
					$('#add_review').click();
					__this.remove();
				} else {
					alert("There is some problem, please try again.");
				}
			});
		}
	});
	$(".shareDetails").click(function (e) {
		e.preventDefault();
		var __this = $(this);
		var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'shareDetails')) ?>";
		var request_id = $(this).attr("request_id");
		var response_id = $(this).attr("response_id");
		var user_id = $(this).attr("user_id");
		if(confirm("Are you sure want to share your details with this user?")) {
			$.ajax({
				url:url,
				type: 'POST',
				data: {request_id:request_id, response_id:response_id,user_id:user_id}
			}).done(function(result){
				if(result == 1) {
					alert("Your details has been shared successfully.");
					__this.remove();
				} else {
					alert("There is some problem, please try again.");
				}
			});
		}
	});
});
</script>
<script>
$('#UserChatForm').validate({
	rules: {
		"message" : {
			required : true
		}
	},
	messages: {
		"message" : {
			required : "Please enter message."
		}
	},
	ignore: ":hidden:not(select)"
});
$('#addtestimonial').validate({
	rules: {
		"rating" : {
			required : true
		}
	},
	messages: {
		"rating" : {
			required : "Please select rating."
		}
	}
});
function f1(res){
	var result = res.split(",");
	$('#chat_request_id').val(result[0]);
	$('#chat_user_id').val(result[1]);
}
</script>


<script>
// Rating
$(document).ready(function () {
	$("#demo1 .stars").click(function (e) {
		e.preventDefault();
		var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'rateUser')) ?>";
		var rating = $(this).val();
		var request_id = $("#rating_request_id").val();
		var user_id = $("#rating_user_id").val();
		if(confirm("Are you sure want to rate this user?")) {
			$.ajax({
				url:url,
				type: 'POST',
				data: {request_id:request_id, user_id:user_id, rating:rating}
			}).done(function(result){
				if(result == 1) {
					alert("Thank you for rating.");
					location.reload();
				} else {
					alert("There is some problem, please try again.");
				}
			});
		}
	});
	
	getcheckresponselists(5000);
	function getcheckresponselists(){
		var requestid = "<?php echo $responseid;?>";
	var url = "<?php echo $this->Url->build(array('controller'=>'users','action'=>'getcheckresponselists')) ?>";
	$.ajax({ url:url,
			 type: 'POST',
			 data: {request_id:requestid}
			}).done(function(result){
		var object = JSON.parse(result);
		$.each(object, function(index, value) {
			var chres_id = "#chatcounts_"+index;
			if(value>0)
			{
			var res_html = '<?php echo $this->Html->image("chat-ico.png"); ?> Chat ( <strong>'+value+'</strong> )';
			$(chres_id).html(res_html);	
			}
			
			});
		});
    setTimeout(getcheckresponselists, 5000);
		}
	
});
$('#UserRatingForm').validate({
	rules: {
		"rating" : {
			required : true
		}
	},
	messages: {
		"rating" : {
			required : "Please select rating."
		}
	},
	ignore: ":hidden:not(select)"
});


function UserRatingForm() {
    var radios = document.getElementsByName("rating");
    var formValid = false;

    var i = 0;
    while (!formValid && i < radios.length) {
        if (radios[i].checked) formValid = true;
        i++;        
    }

    if (!formValid) alert("Please Select Rating!");
    return formValid;
}	

function f2(res){
	var result = res.split(",");
	$('#rating_request_id').val(result[0]);
	$('#rating_user_id').val(result[1]);
}
</script>