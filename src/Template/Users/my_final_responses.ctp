<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>

<?php
use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');
?>
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
		<h3 class="box-title" style="padding:20px">Finalized Responses</h3>
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
				<a class="btn btn-info btn-sm"href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'my-final-responses')) ?>?sort=totalbudgethl">Total Budget (High To Low) <span class="arrow"></span></a>

				<a class="btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'my-final-responses')) ?>?sort=totalbudgetlh"> Total Budget (Low To High)<span class="arrow"></span></a>
				
				<a class="btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'my-final-responses')) ?>?sort=quotationhl">Quoted Price (High To Low) <span class="arrow"></span></a>
				
				<a class="btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'my-final-responses')) ?>?sort=quotationlh"> Quoted Price (Low To High)<span class="arrow"></span></a>
				
				<a class="btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'my-final-responses')) ?>?sort=chatshl">Chats (High To Low) <span class="arrow"></span></a>
				
				<a class="btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'my-final-responses')) ?>?sort=chatslh"> Chats (Low To High)<span class="arrow"></span></a>
				
				<a class="btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'my-final-responses')) ?>?sort=agentaz"> Agent Name (A To Z) <span class="arrow"></span></a>
				
				<a class="btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'my-final-responses')) ?>?sort=agentza"> Agent Name (Z To A)<span class="arrow"></span></a>
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
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Filter</h4>
      </div>
      <div class="modal-body" style="height:180px">
		   <form method="get" class="filter_box" style="margin-top:5px">
		   <div class="col-md-12">
			   <label for="example-text-input" class="col-md-3 col-form-label">Agent Name: </label> 
			   <div class="col-md-9">           
				   <input type="text" name="agentnamesearch" value="<?php echo isset($_GET['agentnamesearch'])? $_GET['agentnamesearch']:''; ?>"  class="form-control">
			   </div>
		   </div>
		   <div class="col-md-12">
			   <label for="example-text-input" class="col-md-3 col-form-label">Total Budget: </label>
			   <div class="col-md-9">             
				   <select name="budgetsearch" class="form-control"><option value="">Select Total Budget</option><option value="0-10000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="0-10000")? 'selected':''; ?>>0-10000</option><option value="10000-30000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="10000-30000")? 'selected':''; ?>>10000-30000</option><option value="30000-50000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="30000-50000")? 'selected':''; ?>>30000-50000</option><option value="50000-100000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="50000-100000")? 'selected':''; ?>>50000-100000</option></select>
			   </div>
		   </div>
				   
		   <div class="col-md-12">
			   <label for="example-text-input" class="col-md-3 col-form-label">Quoted Price: </label> 
			   <div class="col-md-9">            
				   <select name="quotesearch" class="form-control"><option value="">Select Quoted Price</option><option value="0-10000" <?php echo (isset($_GET['quotesearch']) && $_GET['quotesearch'] =="0-10000")? 'selected':''; ?>>0-10000</option><option value="10000-30000" <?php echo (isset($_GET['quotesearch']) && $_GET['quotesearch'] =="10000-30000")? 'selected':''; ?>>10000-30000</option><option value="30000-50000" <?php echo (isset($_GET['quotesearch']) && $_GET['quotesearch'] =="30000-50000")? 'selected':''; ?>>30000-50000</option><option value="50000-100000" <?php echo (isset($_GET['quotesearch']) && $_GET['quotesearch'] =="50000-100000")? 'selected':''; ?>>50000-100000</option>
				   <option value="100000-100000000000" <?php echo (isset($_GET['quotesearch']) && $_GET['quotesearch'] =="100000-100000000000")? 'selected':''; ?>>100000-Above</option>
					</select>
			   </div>
		   </div>
				   
		<div class="col-md-12 text-center">
		<hr></hr>
		  <input type="submit" name="submit" value="Submit"  class="btn btn-primary btn-submit">
		   <a class="btn btn-primary btn-submit" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'my-final-responses')) ?>">Reset</a>
	   </div>
	   </form>
		</div>
		<div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!------------ Main -------------->	
	<?php 
		if(count($responses) >0) {
			foreach($responses as $row){
			?>
            <div class="col-md-4">
			<?php 
               if($row['request']['category_id']==1){ 
					$image=$this->Html->image('/img/slider/package-icon.png');
					$text="<span class='requestType'>Package</span>";
				} 
				if($row['request']['category_id']==2){
					$image= $this->Html->image('/img/slider/transport-icon.png');
					$text="<span class='requestType'>Transport</span>";
				}
				if($row['request']['category_id']==3){
					$image= $this->Html->image('/img/slider/hotelier-icon.png');
					$text="<span class='requestType'>Hotel</span>";
				} 
				?>
				<fieldset>
					<legend><?php echo $image; ?></legend>
                 <ul>
                 <li class="col-md-12">
                    <p>
                        <b>Request Type  : </b> <?php echo $text; ?>
                    </p>
                 </li>
				<li class="col-md-12">
					<p>
						<b>Total Budget : </b> <?php echo ($row['request']['total_budget'])? "Rs. ". $row['request']['total_budget'] :"-- --" ?>
					</p>
				 </li>
				 <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<p>
						<b>Agent Name : </b> <a href="viewprofile/<?php echo $row['request']['user_id']; ?>/1"><?php echo str_replace(';',' ',$allUsers[$row['request']['user_id']]); ?></a>
					</p>
				</li>
				<li class="col-md-12">
					 <p><b>Quotation Price : </b> <?php echo ($row['quotation_price'])? " Rs. ".$row['quotation_price']:"-- --" ?></p>
				</li>
                <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 destination">
				   <?php if($row['request']['category_id']==2){ ?>
                  <p>
                   <b>Pickup City : </b><span> <?php echo ($row['request']['pickup_city'])?$allCities[$row['request']['pickup_city']]:"-- --"; ?><?php echo ($row['request']['pickup_state'])?' ('.$allStates[$row['request']['pickup_state']].')':"";  ?></span>

                  <?php } else { ?>
                        <p>
                        <b>Destination City : </b> <span><?php echo ($row['request']['city_id'])?$allCities[$row['request']['city_id']]:"-- --"; ?> <?php echo ($row['request']['state_id'])?' ('.$allStates[$row['request']['state_id']].')':""; ?>
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
					<li class="col-md-12">
                        <p>
                            <b>Start Date : </b> <?php echo ($row['request']['check_in'])?date("d/m/Y", strtotime($row['request']['check_in'])):"-- --"; ?>
                        </p>
                     </li>
					<li class="col-md-12">
                        <p>
                            <b>End Date : </b> <?php echo ($row['request']['check_out'])?date("d/m/Y", strtotime($row['request']['check_out'])):"-- --"; ?>
                        </p>
                    </li>
				<?php } elseif($row['request']['category_id'] == 1 ) {
$sql = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$row['request']['id']."'";
						$stmt = $conn->execute($sql);
						$result = $stmt ->fetch('assoc');						
					?>
					<li class="col-md-12">
                        <p>
                            <b>Start Date : </b> <?php echo ($row['request']['check_in'])?date("d/m/Y", strtotime($row['request']['check_in'])):"-- --"; ?>
                        </p>
                     </li>
					<li class="col-md-12">
                        <p>
                        <?php if(!empty($result['TopDate'])) { ?>
                        <b>End Date : </b> <?php echo date('d/m/Y',strtotime($result['TopDate'])); ?>
                        <?php }else{?>
                        <b>End Date :</b> <?php echo ($row['request']['check_out'])?date("d/m/Y", strtotime($row['request']['check_out'])):"-- --"; ?>
                        <?php }?>
                            
                        </p>
                     </li>
				<?php } elseif($row['request']['category_id'] == 2 ) { ?>
					<li class="col-md-12">
                        <p>
                            <b>Start Date : </b> <?php echo ($row['request']['start_date'])?date("d/m/Y", strtotime($row['request']['start_date'])):"-- --"; ?>
                        </p>
                    </li>
					<li class="col-md-12">
                        <p>
                            <b>End Date : </b> <?php echo ($row['request']['end_date'])?date("d/m/Y", strtotime($row['request']['end_date'])):"-- --"; ?>
                        </p>
                    </li>
				<?php } ?>
				                <li class="col-md-12">
                        <p>
                            <b>Members : </b> <?php echo $row['request']['adult'] +  $row['request']['children']; ?>
                     </p>
                 </li>
				 
				
	
					
                   <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 comment">
                       <p> <b>Comment :</b><span><?php echo $row['comment']; ?></span></p>
                     </li>
                   </ul>
				   <div class="col-md-12">
					<table width="100%" style="text-align:center">
						<tr>
							<td>
					 
							<a data-toggle="modal" class="btn btn-info btn-sm" data-target="#myModal1<?php echo $row['request']['id'];?>" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'viewdetails',$row['request']['id'])) ?>"> Details</a>
							<div class="modal fade" id="myModal1<?php echo $row['request']['id'];?>" role="dialog">
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
						 
						  <?php $reviewi =  $row['request']['user_id']."-".$row['request']['id']; ?>
						   <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal1review<?php echo $row['id']; ?>" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'addtestimonial',  $reviewi)) ?>">Review </a>
											   
						<div class="modal fade" id="myModal1review<?php echo $row['id']; ?>" role="dialog">
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
						</td>
					</tr>
				</table>
				</div>
				</fieldset>
                  </div>
               </div>
			<?php } ?>
			<div class="pages"></div>
		
		<?php 
		}
		else 
		{
			?>
			 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                 <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 text-center box-event">
					<?php if(isset($_GET['agentnamesearch'])){ echo "No matching data.";}else{ echo "There are no finalized responses in the mailbox.";}?>
                </div>
             </div>
		<?php 
		} 
		?>

          </div>
      </div>
    </div>
</div>
 
	<div class="modal fade" id="myModal" role="dialog">
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
function f1(res){
	var result = res.split(",");
	$('#chat_request_id').val(result[0]);
	$('#chat_user_id').val(result[1]);
}
</script>