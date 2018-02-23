<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php echo $this->Html->script(['jquery.validate']);?>
<?php
use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');
?>
	<div id ="finalized_request_list" class="container-fluid">
<div class="row equal_column" > 
    <div class="col-md-12" style="background-color:#fff"> 
		<br>
		<?php echo $this->element('subheader');?>
		<?php echo  $this->Flash->render() ?>
	</div>
	<div class="col-md-12" style="background-color:#fff"> 

<div class="box box-default">
	<div class="box-header with-border"> 
		<h3 class="box-title" style="padding:20px">Finalized Requests</h3>
		<div class="box-tools pull-right">
			<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal123" data-toggle="modal"> <i class="fa fa-sort-amount-asc"></i></a>
			<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
		</div>
		 
	</div>
	<div class="box-body">
		<div class="row">
	 
<div id="myModal123" class="modal fade form-modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Sorting</h4>
		  </div>
		  <div class="modal-body">
			<table width="90%" class="shotrs">
			<tr>
				<td>
						<a class="btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'finalized-request-list')) ?>?sort=totalbudgethl">Total Budget (High To Low) <span class="arrow"></span></a>
						<a class="btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'finalized-request-list')) ?>?sort=totalbudgetlh"> Total Budget (Low To High)<span class="arrow"></span></a>

						 <a class="btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'finalized-request-list')) ?>?sort=requesttype">Request Type  <span class="arrow"></span></a> </li>
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
      <div class="modal-body">
        <form method="get" class="filter_box">
            
        <div class="col-md-12">
           <div class="col-md-6">            
           <label for="example-text-input" class=" col-form-label">Request Type: </label>
			   <select name="req_typesearch" class="form-control"><option value="">Select Request Type</option><option value="1">Package</option><option value="3">Hotel</option><option value="2">Transport</option></select>
           </div>
         
           
           <div class="col-md-6">
			<label for="example-text-input" class=" col-form-label">Total Budget: </label>
               <select name="budgetsearch" class="form-control"><option value="">Select Total Budget</option><option value="0-10000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="0-10000")? 'selected':''; ?>>0-10000</option><option value="10000-30000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="10000-30000")? 'selected':''; ?>>10000-30000</option><option value="30000-50000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="30000-50000")? 'selected':''; ?>>30000-50000</option><option value="50000-100000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="50000-100000")? 'selected':''; ?>>50000-100000</option>
               <option value="100000-100000000000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="100000-100000000000")? 'selected':''; ?>>100000-Above</option>
               </select>
           </div>
      
           
           <div class="col-md-6">
			<label for="example-text-input" class=" col-form-label">Start Date: </label>
                <input type="text" id="datepicker1"  name="startdatesearch" value="<?php echo isset($_GET['startdatesearch'])? $_GET['startdatesearch']:''; ?>"  class="form-control">
           </div>
        
           <div class="col-md-6">  
			<label for="example-text-input" class=" col-form-label">End Date: </label>           
               <input type="text" id="datepicker2" name="enddatesearch" value="<?php echo isset($_GET['enddatesearch'])? $_GET['enddatesearch']:''; ?>"  class="form-control" >
            </div>
    
           
           <div class="col-md-6">
			<label for="example-text-input" class=" col-form-label">Reference ID: </label>
                <input type="text" name="refidsearch" value="<?php echo isset($_GET['refidsearch'])? $_GET['refidsearch']:''; ?>"  class="form-control">
            </div>
      
          
           <div class="col-md-6">  
			 <label for="example-text-input" class=" col-form-label">Members: </label>		   
                <input type="text" name="memberssearch" value="<?php echo isset($_GET['memberssearch'])? $_GET['memberssearch']:''; ?>"  class="form-control">
           </div>
       </div>
            
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        <input type="submit" name="submit" value="Submit"  class="btn btn-primary btn-submit">
        <a class="btn btn-primary btn-submit" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'finalized-request-list')) ?>">Reset</a>
   </div>
   </form>
   <script>
   $(document).ready(function(){
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
});
		$('#datepicker2').datepicker({
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			minDate: '<?php echo date("d/m/y"); ?>',
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

<?php if(isset($_GET['sort']) && $_GET['sort']=="requesttype") { ?>
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
		<?php  
		if(count($requests) >0) {
			
		 foreach($requests as $request){
		 
		 	$totmem = $request['adult'] +   $request['children']; 
		   if(isset($_GET['memberssearch']) && $_GET['memberssearch']!="" && $_GET['memberssearch'] !=$totmem ){
			continue;
		   }
		 ?>
		 <div id="cat">
						<div class=" req col-lg-4 col-md-4 col-sm-4 col-xs-4" id="<?php if($request['category_id']==1){ echo "1";} if($request['category_id']==2){ echo "3";}if($request['category_id']==3){ echo "2";} ?>">
						<?php 
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
						?>
                <fieldset><legend><?php echo $image; ?></legend>
                    <ul>
                      <li class="col-md-12">
                     <p>
						
                        <b>Request Type :</b> <?php  echo $text; ?>
                    </p>
                    </li>
                    
                     <li class="col-md-12">
                        <p>
                            <b>Total Budget :</b> Rs. <?php echo $request['total_budget']; ?>
                        </p>
                    </li>
                    <li class="col-md-12">
                        <p>
                            <b>Agent Name :</b> <a href="viewprofile/<?php echo $finalresponse[$request['id']]['user_id']; ?>/1"><?php echo str_replace(';',' ',$allUsers[$finalresponse[$request['id']]['user_id']]); ?></a>
                        </p>
                     </li>
                     <li class="col-md-12">
                        <p>
                            <b>Quotation Price :</b> Rs. <?php echo $finalresponse[$request['id']]['quotation_price']; ?>
                        </p>
                    </li>
                   
                    <?php if($request['category_id'] == 3 ) { ?>
                    <li class="col-md-12">
                        <p>
                            <b>Start Date :</b> <?php echo ($request['check_in'])?date('d/m/Y',strtotime($request['check_in'])):"-- --"; ?>
                        </p>
                    </li>
                    <li class="col-md-12">
                        <p>
                            <b>End Date :</b> <?php echo ($request['check_out'])?date('d/m/Y',strtotime($request['check_out'])):"-- --"; ?></p>
                    </li>
                    <?php } elseif($request['category_id'] == 1 ) {
							$sql = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$request['id']."'";
						$stmt = $conn->execute($sql);
						$result = $stmt ->fetch('assoc');	                    	
                    	?>
                    <li class="col-md-12">
                        <p>
                            <b>Start Date :</b> <?php echo ($request['check_in'])?date('d/m/Y',strtotime($request['check_in'])):"-- --"; ?>
                        </p>
                    </li>
                    <li class="col-md-12">
                        <p>
                        <?php if(!empty($result['TopDate'])) { ?>
                        <b>End Date : </b> <?php echo date('d/m/Y',strtotime($result['TopDate'])); ?>
                        <?php }else{?>
                            <b>End Date : </b> <?php echo ($request['check_out'])?date('d/m/Y',strtotime($request['check_out'])):"-- --"; ?>
                            <?php }?>
                        </p>
                    </li>
                    <?php } elseif($request['category_id'] == 2 ) {?>
                    <li class="col-md-12">
                        <p>
                            <b>Start Date :</b> <?php echo ($request['start_date'])?date('d/m/Y',strtotime($request['start_date'])):"-- --"; ?>
                        </p>
                    </li>
                     <li class="col-md-12">
                        <p>
                            <b>End Date :</b> <?php echo ($request['end_date'])?date('d/m/Y',strtotime($request['end_date'])):"-- --"; ?><span class="budy right" style="display:none;"><a href="#" ><?php echo $this->Html->image('friend-ico.png'); ?></a></span>
                        </p>
                    </li>
                    <?php } ?>
							<li class="col-md-12">
                        <p>
                            <b>Reference ID :</b> <?php echo $request['reference_id']; ?>
                        </p>
                    </li>
                     <li class="col-md-12">
                        <p>
                            <b>Members :</b> <?php echo $request['adult'] +   $request['children']; ?>
                        </p>
                    </li>
                    <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 comment">
                        <p><b>Response Comment :</b> <span><?php echo $finalresponse[$request['id']]['comment']; ?></span></p>
                     </li>
                    </ul>
                      <table width="100%" style="text-align:center">
						<tr>
							<td>
                      <a data-toggle="modal"  class="btn btn-info btn-sm" data-target="#myModal1<?php echo $request['id']; ?>" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'viewdetails',$request['id'])) ?>"> Details</a>
                         
						<a data-toggle="modal"  class="btn btn-success btn-sm" data-target="#myModalchat<?php echo $request['id']; ?>" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'userChat',$request['id'], $finalresponse[$request['id']]['user_id'],3)) ?>"> Chat</a>                        
                        
                        
                        
                        <?php $reviewi = $request['responses'][0]['user_id']."-".$request['id']; ?>
                         <a data-toggle="modal" class="btn btn-warning btn-sm" data-target="#myModal1review<?php echo $request['id']; ?>" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'addtestimonial',  $reviewi )) ?>"> Review </a>
                        </div>
                       
						</td>
					</tr>
				</table>
				 <div class="modal fade" id="myModalchat<?php echo $request['id']; ?>" role="dialog">
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
						<div class="modal fade" id="myModal1review<?php echo $request['id']; ?>" role="dialog">
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
	</fieldset>
   </div>
   </div>
			</div>
		<?php } ?>
		<div class="pages"></div>
		<?php }else {?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 text-center box-event">
 <?php if(isset($_GET['req_typesearch'])){ echo "No matching data.";}else{ echo "There are no finalized requests in the mailbox.";}?>
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