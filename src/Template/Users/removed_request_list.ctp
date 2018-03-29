<?php
use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');
?>
<style>
	legend {
		text-align:center;
	}
	.details {color:#000 !important; font-weight: 400;}
li > p{
		color:#96989A !important;
		margin: 0 0 4px !important;
	}	
</style>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<div id="removed_request_list" class="container-fluid">
<div class="row equal_column" > 
<div class="col-md-12" > 
    <div class="col-md-12" style="background-color:#fff"> 
		<br>
		<?php echo $this->element('subheader');?>
		<?php echo  $this->Flash->render() ?>
	</div>
	
<div class="box box-default">
	<div class="box-header with-border"> 
		<h3 class="box-title" style="padding:20px">Removed Requests</h3>
		<div class="box-tools pull-right">
 			<a style="font-size:33px" class="btn btn-box-tool" data-target="#myModal122" data-toggle="modal"> <i class="fa fa-filter"></i></a>
		</div>
		 
	</div>
	<div class="box-body">
		<div class="row">
		<div class="col-md-12">
         
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
						<label for="example-text-input" class="col-form-label">Request Type: </label>		   
								   <select name="req_typesearch" class="form-control"><option value="">Select Request Type</option><option value="1">Package</option><option value="3">Hotel</option><option value="2">Transport</option></select>
							   </div>
						   
							   
							<div class="col-md-6">
							 <label for="example-text-input" class="col-form-label">Total Budget: </label>           
								   <select name="budgetsearch" class="form-control"><option value="">Select Total Budget</option><option   value="0-10000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="0-10000")? 'selected':''; ?>>0-10000</option><option value="10000-30000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="10000-30000")? 'selected':''; ?>>10000-30000</option><option value="30000-50000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="30000-50000")? 'selected':''; ?>>30000-50000</option><option value="50000-100000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="50000-100000")? 'selected':''; ?>>50000-100000</option>
								   <option value="100000-100000000000" <?php echo (isset($_GET['budgetsearch']) && $_GET['budgetsearch'] =="100000-100000000000")? 'selected':''; ?>>100000-Above</option>
								   </select>
							   </div>
						   
							   
							   <div class="col-md-6">     
					<label for="example-text-input" class="col-form-label">Start Date: </label>		   
								   <input type="text" id="datepicker1"  name="startdatesearch" value="<?php echo isset($_GET['startdatesearch'])? $_GET['startdatesearch']:''; ?>"  class="form-control">
							   </div>
						
								
							   <div class="col-md-6"> 
					<label for="example-text-input" class="col-form-label">End Date: </label>           
								   <input type="text" id="datepicker2" name="enddatesearch" value="<?php echo isset($_GET['enddatesearch'])? $_GET['enddatesearch']:''; ?>"  class="form-control" >
							  </div>
						
							   
							   <div class="col-md-6">   
							<label for="example-text-input" class="col-form-label">Reference ID: </label>		   
								   <input type="text" name="refidsearch" value="<?php echo isset($_GET['refidsearch'])? $_GET['refidsearch']:''; ?>"  class="form-control">
							   </div>
						  </div>
								  
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
							<input type="submit" name="submit" value="Submit"  class="btn btn-primary btn-submit">
							<a class="btn btn-primary btn-submit" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'removed-request-list')) ?>">Reset</a>
					   </div>
					   </form>
					 
							   </div>
						  <div class="modal-footer">
						  
						  </div>
						</div>

					  </div>
					</div>

		<?php
		if(count($requests) >0) {
$m =0;
			foreach($requests as $request){
			if($m%3==0) { echo '<div class="clearfix"></div>'; 
                  }
                  $m++;	
 ?>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
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
                        Request Type : <span class="details"> <?php  echo $text ; ?></span>
                    </p>
                </li>
				 <li class="col-md-12">
                     <p>
                        Total Budget : <span class="details">  Rs. <?php echo $request['total_budget']; ?></span>
                     </p>
                 </li>
				<?php if($request['category_id'] == 3 ) { ?>
					<li class="col-md-12">
                        <p>
                            Start Date :<span class="details"> <?php echo ($request['check_in'])?date('d/m/Y',strtotime($request['check_in'])):"-- --"; ?></span>
                        </p>
                     </li>
					<li class="col-md-12">
                        <p>
                            End Date :<span class="details"> <?php echo ($request['check_out'])?date('d/m/Y',strtotime($request['check_out'])):"-- --"; ?></span>
                        </p>
                     </li>
				<?php } elseif($request['category_id'] == 1 ) {
$sql = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$request['id']."'";
                                 $stmt = $conn->execute($sql);
                                 $result = $stmt ->fetch('assoc');
?>
					<li class="col-md-12">
                        <p>
                            Start Date :<span class="details"> <?php echo ($request['check_in'])?date('d/m/Y',strtotime($request['check_in'])):"-- --"; ?></span>
                        </p>
                     </li>
					<li class="col-md-12">
                        <p><?php if(!empty($result['TopDate'])) { ?>End Date : <span class="details"> <?php echo date('d/m/Y',strtotime($result['TopDate'])); ?></span><?php }else{?>End Date : <span class="details"><?php echo ($request['check_out'])?date('d/m/Y',strtotime($request['check_out'])):"-- --"; ?><?php }?></span>
                   </li>
				<?php } elseif($request['category_id'] == 2 ) {?>
					<li class="col-md-12">
                        <p>
                            Start Date :<span class="details"> <?php echo ($request['start_date'])?date('d/m/Y',strtotime($request['start_date'])):"-- --"; ?></span>
                        </p>
                     </li>
					<li class="col-md-12">
                        <p>
                            End Date :<span class="details"> <?php echo ($request['end_date'])?date('d/m/Y',strtotime($request['end_date'])):"-- --"; ?></span>
                        </p>
                   </li>
			<?php } ?>

				
				<li class="col-md-12">
                    <p>
                        Reference ID : <span class="details"> <?php echo $request['reference_id']; ?></span>
                    </p>
                 </li>
               <li class="col-md-12">
                     <p>
                        Members : <span class="details"> <?php echo $request['adult'] +   $request['children']; ?> </span> 
                     </p>
                 </li>
               
                     <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 destination">
                  <?php if($request['category_id']==2){ ?>
                  <p>
                      Pickup City:<span class="details"> <span><?php echo ($request['pickup_city'])?$allCities[$request['pickup_city']]:"-- --"; ?><?php echo ($request['pickup_state'])?' ('.$allStates[$request['pickup_state']].')':"";  ?></span></span>
                  <?php } else { ?>
                            <p>
                                Destination City: <span class="details"> <span>
								<?php 
									$a=$request['city_id']?$allCities[$request['city_id']]:"-- --"; 
									$b=$request['state_id']?' ('.$allStates[$request['state_id']].')':"";
									echo mb_strimwidth($a.$b, 0,20, "...");?>
								
													<?php  /*if($request['category_id'] == 1){
													if(count($request['hotels']) >1) {
													unset($request['hotels'][0]);?>
													<?php foreach($request['hotels'] as $row) { ?>
													<?php echo ($row['city_id'])?', '.$allCities[$row['city_id']]:""; ?>
													<?php echo ($row['state_id'])?' ('.$allStates[$row['state_id']].')':""; ?>
													<?php } ?>
													<?php } ?>
													<?php } ?> */?>
                               
                            <?php } ?> </span></span>
                            </p>
                       </li>

             
                     <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 comment">
                         <p>Comment :<span class="details">
					 
						 <?php echo mb_strimwidth($request['comment'], 0, 25, "...");?></span></p>
                     </li>
                  </ul>
						<div class=" " >
							<table width="100%" style="text-align:center">
							<tr>
								<td >
									<a style="width:100%" class="viewdetail btn btn-info btn-sm" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'viewdetails',$request['id'])) ?>"data-target="#myModal1<?php echo $request['id']; ?>" data-toggle=modal> Details</a>
									
								</td>
							</tr>
							</table>
								<div class="fade modal"id="myModal1<?php echo $request['id']; ?>"role=dialog>
									<div class=modal-dialog>
										<div class=modal-content>
										   <div class=modal-header>
											  <button class=close data-dismiss=modal type=button>×</button>
											  <h4 class=modal-title>Details</h4>
										   </div>
										   <div class=modal-body></div>
										</div>
									</div>
								</div>
							</div>				
				</fieldset>
			</div>
	
       <?php } ?>
       <div class="pages"></div>
	   <?php } else {?>
	   <div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-event">
                    There are no Removed Requests. 
                </div>
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
</div>
  
<?php echo $this->element('footer');?>
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
	});	
		</script> 
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
  </script>
 