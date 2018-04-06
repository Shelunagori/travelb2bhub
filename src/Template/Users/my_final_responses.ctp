<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>

<?php
use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');
?>
<style>
	legend {
		text-align:center;
	}
	fieldset
	{
		border-radius: 15px;
	}
	.details {color:#000 !important; font-weight: 400;}	
		li > p{
		color:#96989A !important;
		margin: 0 0 4px !important;
	}
</style>
<div id="my_final_responses" class="container-fluid">
	<div class="row equal_column">
	<div class="col-md-12" style="background-color:#"> 
		 
		<?php echo $this->element('subheader');?>
		<?php echo  $this->Flash->render() ?>
	</div>
	</div>
<div class="box box-primary">
	<div class="row">
		<div class="col-md-12">
			<div class="box-header with-border"> 
				<h3 class="box-title" style="padding:5px">Finalized Responses</h3>
				<div class="box-tools pull-right">
					<a style="font-size:26px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
				</div>
			</div>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
		<div class="">
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
			//pr($responses);
			foreach($responses as $row){
			?>
			<div id="cat" >
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
				$created=$row['created'];
				$org_created=date('d-M-Y', strtotime($created));
				?>
				<fieldset>
					<legend><?php echo $image; ?></legend>
					<span style="margin-top:0px;float:right;"><?php echo $org_created; ?></span>
                 <ul>
                 <li >
                    <p>
                        Request Type  : <?php echo $text; ?>
                    </p>
                 </li>
				<li >
					<p>
						Total Budget :  <?php echo ($row['request']['total_budget'])? "Rs. ". $row['request']['total_budget'] :"-- --" ?>
					</p>
				 </li>
				 <li >
					<p>
						Agent Name :  <a href="viewprofile/<?php echo $row['request']['user_id']; ?>/1"><?php echo str_replace(';',' ',$allUsers[$row['request']['user_id']]); ?></a>
					</p>
				</li>
				<li >
					 <p>Quotation Price :  <?php echo ($row['quotation_price'])? " Rs. ".$row['quotation_price']:"-- --" ?></p>
				</li>
                <li class="destination">
				   <?php if($row['request']['category_id']==2){ ?>
                  <p>
                   Pickup City : <span> <?php echo ($row['request']['pickup_city'])?$allCities[$row['request']['pickup_city']]:"-- --"; ?><?php echo ($row['request']['pickup_state'])?' ('.$allStates[$row['request']['pickup_state']].')':"";  ?></span>

                  <?php } else { ?>
                        <p>
                        Destination City :  <span>
						<?php 
							$a=$row['request']['city_id']?$allCities[$row['request']['city_id']]:"-- --"; 
							$b=$row['request']['state_id']?' ('.$allStates[$row['request']['state_id']].')':"";
							echo mb_strimwidth($a.$b, 0,33, "...");?>
							</span>
                        </p>
                        <?php } ?>
                 </li>
				<?php if($row['request']['category_id'] == 3 ) { ?>
					<li >
                        <p>
                            Start Date :  <?php echo ($row['request']['check_in'])?date("d/m/Y", strtotime($row['request']['check_in'])):"-- --"; ?>
                        </p>
                     </li>
					<li >
                        <p>
                            End Date :  <?php echo ($row['request']['check_out'])?date("d/m/Y", strtotime($row['request']['check_out'])):"-- --"; ?>
                        </p>
                    </li>
					<?php } elseif($row['request']['category_id'] == 1 ) {
						$sql = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$row['request']['id']."'";
						$stmt = $conn->execute($sql);
						$result = $stmt ->fetch('assoc');						
					?>
					<li >
                        <p>
                            Start Date :  <?php echo ($row['request']['check_in'])?date("d/m/Y", strtotime($row['request']['check_in'])):"-- --"; ?>
                        </p>
                     </li>
					<li >
                        <p>
                        <?php if(!empty($result['TopDate'])) { ?>
                        End Date :  <?php echo date('d/m/Y',strtotime($result['TopDate'])); ?>
                        <?php }else{?>
                        End Date : <?php echo ($row['request']['check_out'])?date("d/m/Y", strtotime($row['request']['check_out'])):"-- --"; ?>
                        <?php }?>
                            
                        </p>
                     </li>
				<?php } elseif($row['request']['category_id'] == 2 ) { ?>
					<li >
                        <p>
                            Start Date :  <?php echo ($row['request']['start_date'])?date("d/m/Y", strtotime($row['request']['start_date'])):"-- --"; ?>
                        </p>
                    </li>
					<li >
                        <p>
                            End Date :  <?php echo ($row['request']['end_date'])?date("d/m/Y", strtotime($row['request']['end_date'])):"-- --"; ?>
                        </p>
                    </li>
				<?php } ?>
				     <li >
                        <p>
                            Members :  <?php echo $row['request']['adult'] +  $row['request']['children']; ?>
                     </p>
					</li>
					<li>
                       <p> Comment : <span ><?php echo mb_strimwidth($row['comment'], 0, 25, "...");?></span></p>
                    </li>
                   </ul>
				   <hr></hr>
				   <div>
					<table width="100%" style="text-align:center" class>
						<tr>
							<td width="50%">
					 
							<a style="width:99%" data-toggle="modal" class="btn btn-info btn-sm" data-target="#myModal1<?php echo $row['request']['id'];?>" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'viewdetails',$row['request']['id'])) ?>"> Details</a>
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
						 </td>
						 <td width="50%">
						  <?php $reviewi =  $row['request']['user_id']."-".$row['request']['id']; ?>
						   <a style="width:99%" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal1review<?php echo $row['id']; ?>" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'addtestimonial',  $reviewi)) ?>">Review </a>
											   
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
               
			<?php } ?>
			</div>
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
          </div>
      </div>
    </div>
 
	
<?php echo $this->element('footer');?> 
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