 <?php echo $this->Html->script(['jquery.validate']);?>
 <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php
use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');
?>
<style>
.blockuser_hidden{
display: none;
}
</style>
<div class="container-fluid">
 <div class="row equal_column">
      <?php echo $this->element('left_panel');?>
	  <?php $this->Flash->render() ?>
    <!--Page Title-->
     <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 padding0">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0 border_bottom"> 
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 ">
                 <h4 class="title">Respond To Request</h4>
            </div>
           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 ">
                <ul class="top-icons-wrap"><ul class="top-icons-wrap">
                       <li>
 <a href="javascript:void(0);" class="link-icon" data-toggle="modal" data-target="#myModal123" ><img src="/img/sortarrow.png" alt=""></a> </li>
                 <li>
 <a href="javascript:void(0);" class="link-icon" data-toggle="modal" data-target="#myModal122" ><img src="/img/white-filter.png" alt=""></a> </li>
					<li class="notification_list">
<a href="javascript:void(0);" id="chat_icon" class="link-icon"><span class="chat_count"><?php echo $chatCount;?></span><img src="/img/notify.png" alt=""></a>
                            <div class="ap-subs">
                                <ul class="list-unstyled msg_list" role="menu">
                  <?php echo $this->element('subheader');?>
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
<li class="col-md-12 col-xs-12 col-sm-12"> <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>?sort=totalbudgethl">Total Budget (High To Low) <span class="arrow"><span></span></span></a> </li>
<li class="col-md-12 col-xs-12 col-sm-12"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>?sort=totalbudgetlh"> Total Budget (Low To High)<span class="arrow"><span></span></span></a></li>
<li class="col-md-12 col-xs-12 col-sm-12"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>?sort=agentaz"> Agent Name (A To Z) <span class="arrow"><span></span></span></a></li>
<li class="col-md-12 col-xs-12 col-sm-12"><a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>?sort=agentza"> Agent Name (Z To A)<span class="arrow"><span></span></span></a></li>
<li class="col-md-12 col-xs-12 col-sm-12"> <a href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>?sort=requesttype">Request Type  <span class="arrow"><span></span></span></a> </li>
                  </ul>
              </div>
          </div>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
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
          <label for="example-text-input" class="col-md-3 col-form-label">Request Type: </label>
          <div class="col-md-9">
          <select name="req_typesearch" class="form-control"><option value="">Select Request Type</option><option value="1" <?php echo (isset($_GET['req_typesearch']) && $_GET['req_typesearch'] =="1")? 'selected':''; ?>>Package</option><option value="3" <?php echo (isset($_GET['req_typesearch']) && $_GET['req_typesearch'] =="2")? 'selected':''; ?>>Hotel</option><option value="2">Transport</option></select>
          </div>
      </div>
               
       <div class="form-group row margin-b10">
          <label for="example-text-input" class="col-md-3 col-form-label">Total Budget: </label>
          <div class="col-md-9">
            <select name="budgetsearch" class="form-control"><option value="">Select Total Budget</option><option value="0-10000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="0-10000")? 'selected':''; ?>>0-10000</option><option value="10000-30000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="10000-30000")? 'selected':''; ?>>10000-30000</option><option value="30000-50000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="30000-50000")? 'selected':''; ?>>30000-50000</option><option value="50000-100000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="50000-100000")? 'selected':''; ?>>50000-100000</option>
             <option value="100000-100000000000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="100000-100000000000")? 'selected':''; ?>>100000-Above</option>
             </select>
          </div>
      </div>
               
       <div class="form-group row margin-b10">
          <label for="example-text-input" class="col-md-3 col-form-label">Start Date: </label>
          <div class="col-md-9">
          <input type="text" id="datepicker1"  name="startdatesearch" value="<?php echo isset($_GET['startdatesearch'])? $_GET['startdatesearch']:''; ?>"  class="form-control">
          </div>
      </div>
               
     <div class="form-group row margin-b10">
          <label for="example-text-input" class="col-md-3 col-form-label">End Date: </label>
          <div class="col-md-9">
              <input type="text" id="datepicker2" name="enddatesearch" value="<?php echo isset($_GET['enddatesearch'])? $_GET['enddatesearch']:''; ?>"  class="form-control" >
          </div>
      </div>
      
<div class="form-group row margin-b10">
          <label for="example-text-input" class="col-md-3 col-form-label">Pickup City: </label>
          <div class="col-md-9">
          <select class="form-control" id="pickup_city" name="pickup_city">
			<option value="">Select</option>
			<?php foreach($allCities1 as $city){?>
			<option <?php if(isset($_GET['pickup_city']) AND $_GET['pickup_city']==$city['value']){ echo 'selected'; }?> value="<?php echo $city['value'];?>">
			<?php echo $city['label'];?></option>
			<?php }?>          
          </select>     
         </div>
        </div>       
      
       <div class="form-group row margin-b10">
          <label for="example-text-input" class="col-md-3 col-form-label">Destination City: </label>
          <div class="col-md-9">
          <select class="form-control" id="destination_city" name="destination_city">
			<option value="">Select</option>
			<?php foreach($allCities1 as $city){?>
			<option <?php if(isset($_GET['destination_city']) AND $_GET['destination_city']==$city['value']){ echo 'selected'; }?> value="<?php echo $city['value'];?>">
			<?php echo $city['label'];?></option>
			<?php }?>          
          </select>     
         </div>
        </div>         
               
     <div class="form-group row margin-b10">
          <label for="example-text-input" class="col-md-3 col-form-label">Reference ID: </label>
          <div class="col-md-9">
              <input type="text" name="refidsearch" value="<?php echo isset($_GET['refidsearch'])? $_GET['refidsearch']:''; ?>"  class="form-control">
          </div>
      </div>   
               
     <div class="form-group row margin-b10">
          <label for="example-text-input" class="col-md-3 col-form-label">Members: </label>
          <div class="col-md-9">
              <input type="text" name="memberssearch" value="<?php echo isset($_GET['memberssearch'])? $_GET['memberssearch']:''; ?>"  class="form-control">
          </div>
      </div>  
               
     <div class="form-group row margin-b10">
          <label for="example-text-input" class="col-md-3 col-form-label">Agent Name: </label>
          <div class="col-md-9">
              <input type="text" name="agentnamesearch" value="<?php echo isset($_GET['agentnamesearch'])? $_GET['agentnamesearch']:''; ?>"  class="form-control">
          </div>
      </div> 
               
     <div class="form-group row margin-b10">
          <label for="example-text-input" class="col-md-3 col-form-label">Following: </label>
          <div class="col-md-9">
              <input type="checkbox" name="followsearch" value="1" <?php echo isset($_GET['followsearch'])? "checked":''; ?>  >
          </div>
      </div> 
              
               
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
       <input type="submit" name="submit" value="Submit"  class="btn btn-primary btn-submit">
       <a class="btn btn-primary btn-submit" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'respondtorequest')) ?>">Reset</a>
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

<?php if(isset($_GET["success"])) {
 echo '<div class="success col-md-12">Your Interest has been submitted!</div>';
}
?>
       <?php 
		if(count($requests) > 0) {
			$m =0;
			foreach($requests as $request){
				$totmem = $request['adult'] +   $request['children']; 
       if(isset($_GET['memberssearch'])  && $_GET['memberssearch']!="" && $_GET['memberssearch'] !=$totmem ){
 continue;
       }
				  if(isset($_GET['followsearch']) && $_GET['followsearch']==1 && !in_array($request['user_id'],$BusinessBuddies)) {
				 continue;
			}

			 $blockuser_class= "";
if($data['blockedUser'][$request['id']]==1 OR  $resdata['responsecount'][$request['id']]>=20) { 

  }else{
			 	if($m%2==0) { echo '<div class="clearfix"></div>'; 
}
			 $m++;
			// echo $resdata['responsecount'][$request['id']];	
			?>
			
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				   <div class="box-event">
                       <ul>
                   <li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <p>
                        <b>Request Type:</b> <?php if($request['category_id']==1){ echo "<img src='../img/slider/package-icon.png'><span class='package'> Package</span>";} if($request['category_id']==2){ echo "<img src='../img/slider/transport-icon.png'><span class='transport'>Transport</span>";}if($request['category_id']==3){ echo "<img src='../img/slider/hotelier-icon.png'><span class='hotel'>Hotel</span>";} ?>
                    </p>
                   </li>
 <li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p>
                            <b>Total Budget:</b> Rs. <?php echo $request['total_budget']; ?>
                       </p>
                   </li>
<li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <p><b>Agent Name:</b> <a href="viewprofile/<?php echo $request['user_id']; ?>"><?php echo $request['user']['first_name']; ?>&nbsp;&nbsp;<?php echo $request['user']['last_name']; ?></a>
                            <?php if(in_array($request['user_id'],$BusinessBuddies)) {  echo $this->Html->image('friend-ico1.png', [ "height"=>28]); } ?>
                            <?php /* $userRating =   $rating[$request['id']] ;

                if($userRating>0){
                    for($i=$userRating; $i>0; $i--){
                        echo '<i class="fa fa-star"></i>';
                    }
                }else{
                    echo '<i class="fa fa-star"></i>';
                }
               */ ?>
                       </p>

                   </li>
                   <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 destination">
                    <?php if($request['category_id']==2){ ?>
                  <p>
                                <b>Pickup City:</b><?php echo ($request['pickup_city'])?$allCities[$request['pickup_city']]:"-- --"; ?><?php echo ($request['pickup_state'])?' ('.$allStates[$request['pickup_state']].')':"";  ?>
                                
                  <?php } else { ?>
                            <p>
                                <b>Destination City:</b> <?php echo ($request['city_id'])?$allCities[$request['city_id']]:"-- --"; ?><?php echo ($request['state_id'])?' ('.$allStates[$request['state_id']].')':""; ?> 	
                                <?php if($request['category_id'] == 1){ 
                               
						if(count($request['hotels']) >1) { 
						
							unset($request['hotels'][0]);?>
								<?php
							foreach($request['hotels'] as $row) { ?>
							<?php echo ($row['city_id'])?', '.$allCities[$row['city_id']]:""; ?><?php echo ($row['state_id'])?' ('.$allStates[$row['state_id']].')':""; ?> 	
							<?php } ?>
							<?php } ?>
							<?php } ?></p>
                     <?php } ?>
                       </li>
					   <?php if($request['category_id'] == 3 ) { ?>
						<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p>
                                <b>Start Date:</b> <?php echo ($request['check_in'])?date('d/m/Y',strtotime($request['check_in'])):"-- --"; ?>
                            </p>
                        </li>
						<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p>
                                <b>End Date:</b> <?php echo ($request['check_out'])?date('d/m/Y',strtotime($request['check_out'])):"-- --"; ?>
                            </p>
                       </li>
					<?php } elseif($request['category_id'] == 1 ) { 
					$sql = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$request['id']."'";
						$stmt = $conn->execute($sql);
						$result = $stmt->fetch('assoc');					
					?>
						<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p>
                                <b>Start Date:</b> <?php echo ($request['check_in'])?date('d/m/Y',strtotime($request['check_in'])):"-- --"; ?>
                            </p>
                         </li>
						<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p>
                        <?php if(!empty($result['TopDate'])) { ?>
                        <b>End Date: </b> <?php echo date('d/m/Y',strtotime($result['TopDate'])); ?>
                        <?php }else{?>
                            <b>End Date: </b> <?php echo ($request['check_out'])?date('d/m/Y',strtotime($request['check_out'])):"-- --"; ?>
                            <?php }?>
                        </p>
                        </li>
					<?php } elseif($request['category_id'] == 2 ) {?>
					<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p>
                                <b>Start Date:</b> <?php echo ($request['start_date'])?date('d/m/Y',strtotime($request['start_date'])):"-- --"; ?>
                            </p>
                        </li>
						<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p>
                                <b>End Date:</b> <?php echo ($request['end_date'])?date('d/m/Y',strtotime($request['end_date'])):"-- --"; ?>
                            </p>
                        </li>
					<?php } ?>
					<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <p>
                                <b>Members:</b> <?php echo $request['adult'] + $request['children']; ?>
                           </p>
                   </li>
                <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 comment">
                     <p><b>Comment:</b><span> <?php echo $request['comment']; ?></span></p>
                 </li>
                      </ul>
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right link padding0">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding0">
						<?php if($users['role_id'] == 3 || $users['role_id'] == 1){
							if(count($request["responses"]) < 20) {?>
							<a data-toggle="modal" data-target="#myModal<?php echo $request['id']; ?>" href="javascript:void(0);" onclick="f1('<?php echo $request['id']; ?>');" id="<?php echo $request['id']; ?>"><?php echo $this->Html->image('tick-ico.png'); ?> Show interest</a>
							<?php }
						}?>
                     </div>
                     <div class="modal fade" id="myModal<?php echo $request['id']; ?>" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Show Interest</h4>
        </div>
        <div class="modal-body">
			<div class="">
				<?php  echo $this->Form->create("Users", ['type' => 'file', 'url' => ['controller' => 'Users', 'action' => 'addresponse'], 'id'=>"UserResponseForm"]); ?>
				<input type="hidden" name="request_id" class="request_id" id="request_id" value=""/>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt margin-b20">
					<div class="input-field">
					  <label for="from">Quote price
                          <span class="asterisk">
                              <img src="/img/Asterisk.png" class="img-responsive">
                          </span>
                      </label>
					  <input type="text" class="form-control" id="quotation_price" name="quotation_price" placeholder="Quote your price"/>
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt margin-b20">
					<div class="input-field">
					  <label for="from">Comment
                           <span class="asterisk">
                              <img src="/img/Asterisk.png" class="img-responsive">
                          </span>
                      </label>
					  <textarea name="comment" class="form-control" id="comment" placeholder="Enter comment here" col="10" row="10"></textarea>
					</div>
				</div>
				<div class="margi1 text-center">
					<input type="submit" name="submit" class="btn btn-primary btn-submit" value="Submit">
				</div>
				</form>
			</div>
        </div>
      </div>
    </div>
  </div>
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding0">
						<a data-toggle="modal" data-target="#myModal1<?php echo $request['id']; ?>" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'viewdetails',$request['id'])) ?>"><?php echo $this->Html->image('detail-ico.png'); ?> Details</a>
                     </div>
						<div class="modal fade" id="myModal1<?php echo $request['id']; ?>" role="dialog">
		<div class="modal-dialog">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Details</h4>
			</div>
			<div class="modal-body">
			</div>
		  </div>
		</div>
	</div>
					</div>
				   </div>
               </div>
			<?php  } } ?>
			<div class="pages"></div>
		<?php }else {?>
			<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center box-event">
                 <?php if(isset($_GET['req_typesearch'])){ echo "No matching data.";}else{ echo "You have not received any requests.";}?>
                </div>
			</div>
		<?php } ?>
      </div>
    </div>
    </div>
    </div>

<?php echo $this->element('footer');?>
<?php echo $this->Html->script(['ap.pagination.js']);?>
<script>
	$("#responsesWrap").apPagination({
		targets: ".box-event",
		pagesWrap: ".pages",
		ulClass: "pagination",
		perPage: 5,
		nextText: '<i class="glyphicon glyphicon-menu-right"></i><i class="glyphicon glyphicon-menu-right"></i>',
		prevText: '<i class="glyphicon glyphicon-menu-left"></i><i class="glyphicon glyphicon-menu-left"></i>'
	});
$('#UserResponseForm').validate({
	rules: {
		"quotation_price": {
			required: true,
			digits: true
		},
		"comment": {
			required: true
		}
	},
	messages: {
		"quotation_price": {
			required: "Please enter number in quote price.",
			digits: "Please enter valid quote price."
		},
	"comment": {
			required: "Please enter comment."
		}
	},
	ignore: ":hidden:not(select)"
});
function f1(val){
	$('.request_id').val(val);
}
</script>