 
<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-list"></i><b>Response</b>
				</div> 
			 <div class="box-body"> 
			 			<div class="box-body">
			<form method="get">
				<fieldset><legend><button type="button" class="btn btn-xs btn-info collapsed" data-toggle="collapse" data-target="#demo" aria-expanded="false">Click here to search</button></legend>
					<div class="col-md-12 collapse"  id="demo" aria-expanded="false">
						<div class="row"> 
							<div class="col-md-3">
								<label class="control-label">Request Id</label>
								<?php echo $this->Form->input('ReqID',[
								'label' => false,'class'=>'form-control ','placeholder'=>'Enter Request Id']);?>
							</div>
							<div class="col-md-3">
								<label class="control-label">Quotation Price</label>
								<?php echo $this->Form->input('Quotation',[
								'label' => false,'class'=>'form-control ','placeholder'=>'Enter Quotation Price']);?>
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
							 
							<div class="col-md-12" align="center">
								<label class="control-label col-md-12">&nbsp;</label>
								<?php echo $this->Form->button('Search',['class'=>'btn btn-sm btn-success','id'=>'submit_member','name'=>'search_report']); ?> 
							</div> 
						</div>
					</div>
				</fieldset>
			</form>

				<table class="table table-bordered" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th scope="col"><?= ('S.No') ?></th>
							<th scope="col"><?= $this->Paginator->sort('request_id') ?></th>
							<th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
							<th scope="col"><?= $this->Paginator->sort('quotation_price') ?></th>
							<th scope="col"><?= $this->Paginator->sort('is_details_shared') ?></th>
							<th scope="col"><?= $this->Paginator->sort('created') ?></th>
							<th scope="col"><?= $this->Paginator->sort('status') ?></th>
							<th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
							<!---<th scope="col" class="actions"><?= __('Actions') ?></th>-->
						</tr>
					</thead>
					<tbody>
						<?php foreach ($responses as $response): 
							$status= $response->status;
							if($status==0){$showStatus='Open';}
							if($status==1){$showStatus='Finalized';}
							$is_deleted= $response->is_deleted;
							if($is_deleted==0){$showis_deleted='Open';}
							if($is_deleted==1){$showis_deleted='Removed';}
							$is_details_shared= $response->is_details_shared;
							if($is_details_shared==0){$showis_details_shared='Not Shared';}
							if($is_details_shared==1){$showis_details_shared='Shared';}
						?>
						<tr>
							<td><?= $this->Number->format($response->id) ?></td>
							<td><?= $response->has('request') ? $this->Html->link($response->request->id, ['controller' => 'Requests', 'action' => 'view', $response->request->id]) : '' ?></td>
							<td><?php echo $response->user->first_name.$response->user->last_name; ?></td>
							<td><?= $this->Number->format($response->quotation_price) ?></td>
							<td><?php echo $showis_details_shared; ?></td>
							<td><?= h($response->created) ?></td>
							<td><?php echo $showStatus; ?></td>
							<td><?php echo $showis_deleted; ?></td>
							<!---<td class="actions">
								<?= $this->Html->link(__('View'), ['action' => 'view', $response->id]) ?>
								<?= $this->Html->link(__('Edit'), ['action' => 'edit', $response->id]) ?>
								<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $response->id], ['confirm' => __('Are you sure you want to delete # {0}?', $response->id)]) ?>
							</td>--->
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