 <?php echo $this->Html->script(['jquery.validate']);?>
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
		<h3 class="box-title" style="padding:20px">Respond To Request</h3>
		<div class="box-tools pull-right">
			<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
			<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
		</div>
		 
	</div>
	<div class="box-body">
		<div class="row">
   
 
          <div id="myModal123" class="modal fade form-modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sorting</h4>
      </div>
      <div class="modal-body">   
		<table width="90%" class="shotrs">
			<tr>
				<td>
					<a class="btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>?sort=totalbudgethl">Total Budget (High To Low) <span class="arrow"><span></span></span></a> 
					
					<a class="btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>?sort=totalbudgetlh"> Total Budget (Low To High)<span class="arrow"><span></span></span></a> 
					
					<a class="btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>?sort=agentaz"> Agent Name (A To Z) <span class="arrow"><span></span></span></a> 
					
					<a class="btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>?sort=agentza"> Agent Name (Z To A)<span class="arrow"><span></span></span></a>
					
					<a class="btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'respondtorequest')) ?>?sort=requesttype">Request Type  <span class="arrow"><span></span></span></a>
                 </td>
			</tr>
		</table>    
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
      <div class="modal-body" style="height:180px">
           <form method="get" class="filter_box" style="margin-top:5px">
               
       <div class="col-md-12">
          <div class="col-md-6">
			  <label for="example-text-input" class="  col-form-label">Request Type: </label>
			  <select name="req_typesearch" class="form-control"><option value="">Select Request Type</option><option value="1" <?php echo (isset($_GET['req_typesearch']) && $_GET['req_typesearch'] =="1")? 'selected':''; ?>>Package</option><option value="3" <?php echo (isset($_GET['req_typesearch']) && $_GET['req_typesearch'] =="2")? 'selected':''; ?>>Hotel</option><option value="2">Transport</option></select>
          </div>
       
          <div class="col-md-6">
			<label for="example-text-input" class="  col-form-label">Total Budget: </label>
			<select name="budgetsearch" class="form-control"><option value="">Select Total Budget</option><option value="0-10000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="0-10000")? 'selected':''; ?>>0-10000</option><option value="10000-30000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="10000-30000")? 'selected':''; ?>>10000-30000</option><option value="30000-50000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="30000-50000")? 'selected':''; ?>>30000-50000</option><option value="50000-100000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="50000-100000")? 'selected':''; ?>>50000-100000</option>
             <option value="100000-100000000000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="100000-100000000000")? 'selected':''; ?>>100000-Above</option>
             </select>
          </div>
        
          <div class="col-md-6">
			<label for="example-text-input" class="  col-form-label">Start Date: </label>
			<input type="text" id="datepicker1"  name="startdatesearch" value="<?php echo isset($_GET['startdatesearch'])? $_GET['startdatesearch']:''; ?>"  class="form-control">
          </div>
        
          <div class="col-md-6">
			<label for="example-text-input" class="  col-form-label">End Date: </label>
              <input type="text" id="datepicker2" name="enddatesearch" value="<?php echo isset($_GET['enddatesearch'])? $_GET['enddatesearch']:''; ?>"  class="form-control" >
          </div>
        
          <div class="col-md-6">
			<label for="example-text-input" class="  col-form-label">Pickup City: </label>
			<select class="form-control" id="pickup_city" name="pickup_city">
			<option value="">Select</option>
			<?php foreach($allCities1 as $city){?>
			<option <?php if(isset($_GET['pickup_city']) AND $_GET['pickup_city']==$city['value']){ echo 'selected'; }?> value="<?php echo $city['value'];?>">
			<?php echo $city['label'];?></option>
			<?php }?>          
          </select>     
         </div>
         
          <div class="col-md-6">
			<label for="example-text-input" class="  col-form-label">Destination City: </label>
			<select class="form-control" id="destination_city" name="destination_city">
			<option value="">Select</option>
			<?php foreach($allCities1 as $city){?>
			<option <?php if(isset($_GET['destination_city']) AND $_GET['destination_city']==$city['value']){ echo 'selected'; }?> value="<?php echo $city['value'];?>">
			<?php echo $city['label'];?></option>
			<?php }?>          
          </select>     
         </div>
         
          <div class="col-md-6">
				<label for="example-text-input" class="  col-form-label">Reference ID: </label>
              <input type="text" name="refidsearch" value="<?php echo isset($_GET['refidsearch'])? $_GET['refidsearch']:''; ?>"  class="form-control">
          </div>
        
          <div class="col-md-6">
				<label for="example-text-input" class="  col-form-label">Members: </label>
              <input type="text" name="memberssearch" value="<?php echo isset($_GET['memberssearch'])? $_GET['memberssearch']:''; ?>"  class="form-control">
          </div>
        
          <div class="col-md-6">
				<label for="example-text-input" class="  col-form-label">Agent Name: </label>
              <input type="text" name="agentnamesearch" value="<?php echo isset($_GET['agentnamesearch'])? $_GET['agentnamesearch']:''; ?>"  class="form-control">
          </div>
        
          <div class="col-md-6">
				<label for="example-text-input" class="col-form-label">Following: </label>
              <input type="checkbox" name="followsearch" value="1" <?php echo isset($_GET['followsearch'])? "checked":''; ?>  >
          </div>
      </div> 
              
               
    <div class="col-md-12 text-center">
		<hr></hr>
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
				
				if($request['category_id']==1){ 
					$image=$this->Html->image('/img/slider/package-icon.png');
					$text="<span class='requestType'>Package</span>";
				} 
				if($request['category_id']==2){
					$image= $this->Html->image('/img/slider/transport-icon.png');
					$text="<span class='requestType'>Transport</span>";
				}
				if($request['category_id']==3){
					$image= $this->Html->image('/img/slider/hotelier-icon.png');
					$text="<span class='requestType'>Hotel</span>";
				} 
				
				$totmem = $request['adult'] +   $request['children']; 
				if(isset($_GET['memberssearch'])  && $_GET['memberssearch']!="" && $_GET['memberssearch'] !=$totmem ){
					continue;
				}
				if(isset($_GET['followsearch']) && $_GET['followsearch']==1 && !in_array($request['user_id'],$BusinessBuddies)) {
					continue;
				}
				$blockuser_class= "";
				if($data['blockedUser'][$request['id']]==1 OR  $resdata['responsecount'][$request['id']]>=20) { 

				}
				else{
					if($m%2==0) {
						echo '<div class="clearfix"></div>'; 
					}
				$m++;
			// echo $resdata['responsecount'][$request['id']];	
			?>
			<div class="col-md-4"> 
				<fieldset>
				<legend><?php echo @$image; ?></legend>
                 <ul>
					<li class="col-md-12">
						<p>
							<b>Request Type  : </b> <?php echo $text; ?>
						</p>
					</li>
					<li class="col-md-12">
						<p>
							<b>Total Budget : </b> <?php echo ($request['total_budget'])? "Rs. ". $request['total_budget'] :"-- --" ?>
						</p>
				 </li>
				 
					<li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<p>
							<b>Agent Name:</b> <a href="viewprofile/<?php echo $request['user_id']; ?>"><?php echo $request['user']['first_name']; ?>&nbsp;&nbsp;<?php echo $request['user']['last_name']; ?></a>
							<?php if(in_array($request['user_id'],$BusinessBuddies)) {  echo $this->Html->image('friend-ico1.png', [ "height"=>28]); } ?>
						</p>
					</li>
					<li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 destination">
					<?php if($request['category_id']==2){ ?>
						<p>
							<b>Pickup City:</b><?php echo ($request['pickup_city'])?$allCities[$request['pickup_city']]:"-- --"; ?><?php echo ($request['pickup_state'])?' ('.$allStates[$request['pickup_state']].')':"";  ?>
						<?php } else { ?>
						<p>
							<b>Destination City:</b> <?php echo ($request['city_id'])?$allCities[$request['city_id']]:"-- --"; ?>
							<?php echo ($request['state_id'])?' ('.$allStates[$request['state_id']].')':""; ?> 	
							<?php if($request['category_id'] == 1){
								if(count($request['hotels']) >1) {
								unset($request['hotels'][0]);?>
								<?php
								foreach($request['hotels'] as $row) { ?>
									<?php echo ($row['city_id'])?', '.$allCities[$row['city_id']]:""; ?><?php echo ($row['state_id'])?' ('.$allStates[$row['state_id']].')':""; ?> 	
								<?php } ?>
								<?php } ?>
							<?php } ?>
						</p>
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
			<a data-toggle="modal" class="btn btn-success btn-sm" data-target="#myModal<?php echo $request['id']; ?>" href="javascript:void(0);" onclick="f1('<?php echo $request['id']; ?>');" id="<?php echo $request['id']; ?>"> Show interest</a>
			<?php } } ?>
		</div>
				<div id="myModal<?php echo $request['id']; ?>" class="modal fade form-modal" role="dialog">
			  <div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Sorting</h4>
				  </div>
				  <?php  echo $this->Form->create("Users", ['type' => 'file', 'url' => ['controller' => 'Users', 'action' => 'addresponse'], 'id'=>"UserResponseForm"]); ?>
				  <div class="modal-body">   
					
					<input type="hidden" name="request_id" class="request_id" id="request_id" value=""/><br>
					<table width="90%" class="shotrs">
						<tr>
							<td>
								 Quote price
							 </td>
							 <td>
								  <input type="text" class="form-control" id="quotation_price" name="quotation_price" placeholder="Quote your price"/>
							 </td>
						</tr>
						<tr>
							<td>
								 Comment
							 </td>
							 <td>
								  <textarea name="comment" class="form-control" id="comment" placeholder="Enter comment here" col="10" row="10"></textarea>
							 </td>
						</tr>
					</table>
				  </div>
				  <div class="modal-footer">
					 <div style="float:right">
						<input type="submit" name="submit" class="btn btn-info btn-sm" width="20px" style="width:70px !important;" value="Submit">
					 </div>
				  </div>
				  </form>
				</div>
			  </div>
			</div>	
		 
			 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding0">
				<a data-toggle="modal" class="btn btn-info btn-sm"  data-target="#myModal1<?php echo $request['id']; ?>" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'viewdetails',$request['id'])) ?>"> Details</a>
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
		</fieldset>
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