<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-list"></i> <b>User List</b>
				</div> 
				<div class="box-body"> 
				<form method="get">
					<fieldset><legend><button type="button" class="btn btn-xs btn-info collapsed" data-toggle="collapse" data-target="#demo" aria-expanded="false">Click here to search</button></legend>
						<div class="col-md-12 collapse"  id="demo" aria-expanded="false">
							<div class="row"> 
								<div class="col-md-4">
									<label class="control-label">Hotel Name</label>
									<?php echo $this->Form->input('hotelNM',[
									'label' => false,'class'=>'form-control ','placeholder'=>'Enter Hotel Name']);?>
								</div>
								<div class="col-md-3">
									<label class="control-label">Select </label>
									<div class="form-group">
										<div class="radio">
											<label><input type="radio" name="statusWise" value="1">Activate</label>
											<label><input type="radio" name="statusWise" value="2">Deactivate</label>
										</div>
									</div>	 
								</div>
								<div class="col-md-4" align="center">
									<label class="control-label col-md-12">&nbsp;</label>
									<?php echo $this->Form->button('Search',['class'=>'btn btn-sm btn-success','id'=>'submit_member','name'=>'search_report']); ?> 
								</div> 
							</div>
						</div>
					</fieldset>
				</form>
					<table class="table table-bordered" cellpadding="0" cellspacing="0" id="main_tble">
						<thead>
							<tr>
								<th><?= $this->Paginator->sort('id') ?></th> 
								<th><?= $this->Paginator->sort('email') ?></th>
								<th><?= $this->Paginator->sort('first_name') ?></th>
								<th><?= $this->Paginator->sort('last_name') ?></th> 
								<th><?= $this->Paginator->sort('mobile') ?></th>
								<th class="actions"><?= __('Actions') ?></th>
							</tr>
						</thead>
						<tbody>
							<?php $x=0; foreach ($users as $user): $x++; ?>
							<tr>
								<td><?= $x; ?></td> 
								<td><?= h($user->email) ?></td>
								<td><?= h($user->first_name) ?></td>
								<td><?= h($user->last_name) ?></td> 
								<td><?= h($user->mobile) ?></td>
								<td class="actions">
									<?php echo $this->Html->link('<i class="fa fa-edit"></i>','/Users/add/'.$membership->id,array('escape'=>false,'class'=>'btn btn-warning btn-xs'));?>
									<?php echo $this->Form->PostLink('<i class="fa fa-trash"></i>','/Membership/delete/'.$membership->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','confirm' => __('Are you sure you want to delete # {0}?', $membership->id)));?>
								</td>
								<td class="actions">
									<?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
									<?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
									<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
