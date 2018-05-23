<?php
use Cake\Datasource\ConnectionManager; 
$conn = ConnectionManager::get('default');
?> 
<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<b>Requests</b>
					<div class="box-tools pull-right">
						<a style="font-size:19px;  margin-top: -6px;" class="btn btn-box-tool" data-target="#myModal122" data-toggle="collapse"> <i class="fa fa-filter"></i></a>
					</div>
				</div> 
			 <div class="box-body"> 
			 			<div class="box-body">
			<form method="get" class="loadingshow">
				<div class="collapse"  id="myModal122" aria-expanded="false"> 
				<fieldset style="text-align:left;"><legend>Filter</legend>
					<div class="col-md-12 ">
							<div class="col-md-3">
								<label class="control-label">Reference Id</label>
								<?php echo $this->Form->input('RefID',[
								'label' => false,'class'=>'form-control ','placeholder'=>'Enter Reference Id']);?>
							</div>
							 
							<div class="col-md-3">
								<label class="control-label">Select Status</label>
								<select name="status" class="form-control select2" placeholder="Select...">
									<option value="">Select...</option>
									<option value="1">Open</option>
									<option value="2">Finalized</option>
								</select>
							</div>
							<div class="col-md-3">
								<label class="control-label">Remove Status</label>
								<select name="removed" class="form-control select2" placeholder="Select...">
									<option value="">Select...</option>
									<option value="2">Open</option>
									<option value="1">Removed</option>
								</select>
							</div>
							<div class="col-md-3">
								<label class="control-label">Request Type</label>
								<?php echo $this->Form->input('category',['options' =>$CategoriesList,'label' => false,'class'=>'form-control select2','empty'=> 'Select...']);?>	 
							</div>
							<div class="col-md-12" align="center">
								<hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
								<a href="<?php echo $this->Url->build(array('controller'=>'Requests','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
								<label class="control-label col-md-12">&nbsp;</label>
								<?php echo $this->Form->button('Search',['class'=>'btn btn-sm btn-success','id'=>'submit_member','name'=>'search_report']); ?> 
							</div> 
						</div>
					</div>
				</fieldset>
			</form>
			<div class="col-md-12" align="right">
				<a style="margin:2px" href="<?php echo $this->Url->build(array('controller'=>'Requests','action'=>'excelDownload?Refid='.$RefID.'&status='.$status.'&removed='.$removed.'&category='.$category)) ?>" title="Download Excel" class="btn btn-info btn-xs"  ><i class="fa fa-download"></i> Excel</i> </a>
			</div>
				<table class="table table-bordered" cellpadding="0" cellspacing="0" id="main_tble">
						<thead>
							<tr style="background-color:#DFD9C4;">
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Reference_id') ?></th>
							<th scope="col"><?= __('User ID') ?></th>
							<th scope="col"><?= __('Agent Name') ?></th>
							<th scope="col"><?= __('Locality') ?></th>
							<th scope="col"><?= __('Total Budget') ?></th>
							<th scope="col"><?= __('Request Type') ?></th>
							<th scope="col"><?= __('Created date') ?></th>
							<th scope="col"><?= __('Start Date') ?></th>
							<th scope="col"><?= __('End Date') ?></th>
							<th scope="col"><?= __('Status') ?></th>
							<th scope="col"><?= __('Removed') ?></th>
							<th scope="col"><?= __('City') ?></th>
							<th scope="col"><?= __('Action') ?></th> 							
							<!--<th scope="col"><?= __('Pickup State') ?></th>							
							<th scope="col" class="actions"><?= __('Actions') ?></th>-->
						</tr>
					</thead>
        <tbody>
            <?php $i=1;foreach ($requests as $request):
				$status=$request->status;
				$is_deleted=$request->is_deleted;
				if($status==2){ $showStatus="Finalized";}
				if($status==0){ $showStatus="Open";}
				if($is_deleted==0){ $is_deletedShow="Open";}
				if($is_deleted==1){ $is_deletedShow="Removed";}
				
				
					
				$category_id=$request->category_id;
				
				if($category_id == 3 ) { 
					$start_date=date('d-m-Y',strtotime($request->check_in));
					$end_date=date('d-m-Y',strtotime($request->check_out));
								 
				} 
				if($request['category_id'] == 1 ) {
					$sql = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$request->id."'";
					$stmt = $conn->execute($sql);
					$result = $stmt->fetch('assoc');
					$start_date=date('d-m-Y',strtotime($request->check_in));
					if(!empty($result['TopDate'])) {
						$end_date=date('d-m-Y',strtotime($result['TopDate']));
					}
					else{
						$end_date=date('d-m-Y',strtotime($request->check_out));
					}
							 
				}
				if($request['category_id'] == 2 ) { 
					$start_date=date('d-m-Y',strtotime($request->start_date));
					$end_date=date('d-m-Y',strtotime($request->end_date));
				}
				$total_response=$request->total_response;
				$current_date=strtotime(date('Y-m-d'));
				$start_datess=strtotime(date('Y-m-d',strtotime($start_date))); 
				//echo $start_datess.'---'.$current_date.'<br>';
				if($request['category_id']==2){
					if($start_datess <= $current_date){
						if($total_response==0){
							$is_deletedShow='Expired';
						}
					}
				}
				if($request['category_id']!=2){
					if($start_datess <= $current_date){
						if($total_response==0){
							$is_deletedShow='Expired';
						}
					}
				}
			?>
				
			 
            <tr>
                <td><?= $i; ?></td>
                <td><?= h($request->reference_id) ?></td>
                <td><?= h($request->user_id) ?></td>
                <td><?= h($request->user->first_name.' '.$request->user->last_name) ?></td>
                <td><?= h($request->locality) ?></td>
                <td><?= h($request->total_budget) ?></td>
                <td><?= h($request->category->name) ?></td>
				<td><?= h(date('d-m-Y',strtotime($request->created))); ?></td>
				<td><?php echo $start_date; ?></td>
				<td><?php echo $end_date; ?></td>
				<td><?php echo $showStatus; ?></td>
				<td><?php echo $is_deletedShow; ?></td>
				<td><?= h($request->city->name) ?></td>
				<td>
					<a data-toggle="modal" class="btn btn-info btn-xs" title="View Details" data-target="#myModal1<?php echo $request->id; ?>" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'viewdetails',$request->id)) ?>"><i class="fa fa-book"></i></a>
					 <div class="modal fade" id="myModal1<?php echo $request->id; ?>" role="dialog">
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
					<a style="margin-top:2px" class=" btn btn-danger btn-xs" title="Delete Request" data-target="#deletemodal<?php echo $request->id; ?>" data-toggle=modal><i class="fa fa-trash"></i></a>
							<div id="deletemodal<?php echo $request->id; ?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-md" >
									<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Requests','action'=>'delete',$request->id)) ?>">
										<div class="modal-content">
										  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">
												Are you sure you want to remove this request?
												</h4>
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn  btn-sm btn-info">Yes</button>
												<button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Cancel</button>
											</div>
										</div>
									</form>
								</div>
							</div>
				</td>
            </tr>
            <?php $i++;endforeach; ?>
        </tbody>
    </table>
					<div class="paginator">
						<ul class="pagination">
							<?= $this->Paginator->prev('< ' . __('previous')) ?>
							<?= $this->Paginator->numbers() ?>
							<?= $this->Paginator->next(__('next') . ' >') ?>
						</ul>
						<p><?= $this->Paginator->counter() ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
jQuery(".loadingshow").submit(function(){
	jQuery("#loader-1").show();
});
</script>