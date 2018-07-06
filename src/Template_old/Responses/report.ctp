 
<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<b>Response</b>
					<div class="box-tools pull-right">
					<a style="font-size:19px;  margin-top: -6px;" class="btn btn-box-tool" data-target="#myModal122" data-toggle="collapse"> <i class="fa fa-filter"></i></a>
				</div>
			</div> 
			<div class="box-body">
			<form method="get" class="loadingshow">
				<div class="collapse"  id="myModal122" aria-expanded="false"> 
				<fieldset style="text-align:left;"><legend>Filter</legend>
					<div class="col-md-12 ">
						<div class="row"> 
							<div class="col-md-2">
								<label class="control-label">Reference Id</label>
								<?php echo $this->Form->input('ReqID',[
								'label' => false,'class'=>'form-control ','placeholder'=>'Reference Id']);?>
							</div>
							
							<div class="col-md-2">
								<label class="control-label">Request Type</label>
								<select name="category_id" class="form-control select2" placeholder="Select...">
									<option value="">Select...</option>
									<option value="1">Package</option>
									<option value="3">Hotel</option>
									<option value="2">Transport</option>
								</select>
							</div>
							<div class="col-md-2">
								<label class="control-label">Quotation Price</label>
								<?php echo $this->Form->input('Quotation',[
								'label' => false,'class'=>'form-control ','placeholder'=>'Quotation Price']);?>
							</div>
							 
							<div class="col-md-2">
								<label class="control-label">Select Status</label>
								<select name="status" class="form-control select2" placeholder="Select...">
									<option value="">Select...</option>
									<option value="1">Open</option>
									<option value="2">Finalized</option>
								</select>
							</div>
							<div class="col-md-2">
								<label class="control-label">Remove Status</label>
								<select name="removed" class="form-control select2" placeholder="Select...">
									<option value="">Select...</option>
									<option value="2">Open</option>
									<option value="1">Removed</option>
								</select>
							</div>
							<div class="col-md-2">
								<label class="control-label">Detail Shared</label>
								<select name="is_details_shared" class="form-control select2" placeholder="Select...">
									<option value="">Select...</option>
									<option value="1">Shared</option>
									<option value="0">Not Shared</option>
								</select>
							</div>
							 
							<div class="col-md-12" align="center">
								<hr style="margin-top: 12px;margin-bottom: 10px;"></hr>
								<a href="<?php echo $this->Url->build(array('controller'=>'Responses','action'=>'report')) ?>"class="btn btn-danger btn-sm">Reset</a>
								<label class="control-label col-md-12">&nbsp;</label>
								<?php echo $this->Form->button('Search',['class'=>'btn btn-sm btn-success','id'=>'submit_member','name'=>'search_report']); ?> 
							</div> 
						</div>
					</div>
				</fieldset>
				</div>
			</form>
			<div class="col-md-12" align="right">
				<a style="margin:2px" href="<?php echo $this->Url->build(array('controller'=>'Responses','action'=>'excelDownload?reqid='.$ReqID.'&category_id='.$category_id.'&quotation='.$Quotation.'&status='.$status.'&removed='.$removed.'&is_details_shared='.$is_details_shared.'&id='.$id."&search_report=")) ?>" title="Download Excel" class="btn btn-info btn-xs"  ><i class="fa fa-download"></i> Excel</i> </a>
			</div>
				<table class="table table-bordered" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th scope="col"><?= ('S.No') ?></th>
							<th scope="col"><?= h('Rreference ID') ?></th>
							<th scope="col"><?= h('Request Type') ?></th>
							<th scope="col"><?= h('User ID') ?></th>
							<th scope="col"><?= h('Response By') ?></th>
							<th scope="col"><?= h('Quotation Price') ?></th>
							<th scope="col"><?= ('Detail Shared') ?></th>
							<th scope="col"><?= ('created') ?></th>
							<th scope="col"><?= ('status') ?></th> 
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $d=0; foreach ($responses as $response): 
							$status= $response->status;
							$d++;
							if($status==0){$showStatus='Open';}
							if($status==1){$showStatus='Finalized';} 
							$is_details_shared= $response->is_details_shared;
							if($is_details_shared==0){$showis_details_shared='Not Shared';}
							if($is_details_shared==1){$showis_details_shared='Shared';}
							$category_id=$response->request->category_id;
							if($category_id==1){ 
								$text="Package";
							} 
							if($category_id==2){
								$text="Transport";
							}
							if($category_id==3){
								$text="Hotel";
							}
						?>
						<tr>
							<td><?= h($d) ?></td>
							<td><?= $response->request->reference_id ?></td>
							<td><?= h($text) ?></td>
							<td><?php echo $response->user_id; ?></td>
							<td><?php echo $response->user->first_name.' '.$response->user->last_name; ?></td>
							<td><?= h($response->quotation_price) ?></td>
							<td><?php echo $showis_details_shared; ?></td>
							<td><?= h(date('d-m-Y',strtotime($response->created))) ?></td>
							<td><?php echo $showStatus; ?></td> 
							 <td class="actions">
							 <a data-toggle="modal" class="btn btn-info btn-xs" title="View Details" data-target="#myModal1<?php echo $response->id; ?>" href="<?php echo $this->Url->build(array('controller'=>'users','action'=>'viewdetails',$response->request->id)) ?>"><i class="fa fa-book"></i></a>
							 <div class="modal fade" id="myModal1<?php echo $response->id; ?>" role="dialog">
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
							<a style="margin-top:2px" class=" btn btn-danger btn-xs" title="Delete Response" data-target="#deletemodal<?php echo $response->id; ?>" data-toggle=modal><i class="fa fa-trash"></i></a>
							<div id="deletemodal<?php echo $response->id; ?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-md" >
									<form method="post" action="<?php echo $this->Url->build(array('controller'=>'Responses','action'=>'delete',$response->id)) ?>">
										<div class="modal-content">
										  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">
												Are you sure you want to remove this response?
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
								<?php $this->Html->link(__('View'), ['action' => 'view', $response->id]) ?>
								<?php $this->Html->link(__('Edit'), ['action' => 'edit', $response->id]) ?>
								<?php $this->Form->postLink(__('Delete'), ['action' => 'delete', $response->id], ['confirm' => __('Are you sure you want to delete # {0}?', $response->id)]) ?>
							</td> 
						</tr>
						<?php endforeach; ?>
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