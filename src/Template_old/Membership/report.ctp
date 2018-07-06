<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-list"></i> <b>Membership List</b>
				</div> 
				<div class="box-body"> 
					<table class="table table-bordered" cellpadding="0" cellspacing="0" id="main_tble">
						<thead>
							<tr>
								<th scope="col"><?= $this->Paginator->sort('S.No') ?></th>
								<th scope="col"><?= $this->Paginator->sort('membership_name') ?></th>
								<th scope="col"><?= $this->Paginator->sort('price') ?></th>
								<th scope="col"><?= $this->Paginator->sort('duration') ?></th> 
								<th scope="col" class="actions"><?= __('Actions') ?></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($membership as $membership): ?>
							<tr>
								<td><?= $this->Number->format($membership->id) ?></td>
								<td><?= h($membership->membership_name) ?></td>
								<td><?= h($membership->price) ?></td>
								<td><?= h($membership->duration) ?></td> 
								<td class="actions" style="text-align:center">
									<?php echo $this->Html->link('<i class="fa fa-edit"></i>','/Membership/add/'.$membership->id,array('escape'=>false,'class'=>'btn btn-warning btn-xs'));?>
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
