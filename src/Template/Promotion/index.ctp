<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-list"></i> <b>Promotions List</b>
				</div> 
			 
				<div class="box-body"> 
					<table class="table table-bordered" cellpadding="0" cellspacing="0" id="main_tble">
						<thead>
							<tr style="background-color:#DFD9C4;">
								<th scope="col"><?=__('Sr.No') ?></th>
								<th scope="col"><?=__('Hotelier Name') ?></th>
								<th scope="col"><?=__('Hotelier Email') ?></th>
								<th scope="col"><?=__('Hotel Name') ?></th>
								<th scope="col"><?=__('Duration (In Month)') ?></th>
								<th scope="col"><?=__('Expires On') ?></th>
								<th scope="col"><?= $this->Paginator->sort('Cheap Tariff') ?></th>
								<th scope="col"><?= $this->Paginator->sort('Expensive Tariff') ?></th>
								<th scope="col" class="actions"><?= __('Status') ?></th>
								<th scope="col" class="actions"><?= __('Actions') ?></th>

							</tr>
						</thead>
						<tbody>
							<?php $i=1; foreach ($promotion as $promotion): ?>
							<tr>
								<td><?= $i; ?></td>
								<td><?= h($promotion->user->first_name).h($promotion->user->last_name) ?></td>
								<td><?= h($promotion->user->email) ?></td>
								<td><?= h($promotion->hotel_name) ?></td>
								<td><?= h($promotion->duration) ?></td>
								<td><?= h($promotion->expiry_date) ?></td>
								<td><?= $this->Number->format($promotion->cheap_tariff) ?></td>
								<td><?= $this->Number->format($promotion->expensive_tariff) ?></td>
								<td><?= h($promotion->status) ?></td>
								<td class="actions">
								<?php echo $this->Html->link('<i class="fa fa-edit"></i>','/Promotion/edit/'.$promotion->id,array('escape'=>false,'class'=>'btn btn-warning btn-xs'));?>
								<?php echo $this->Form->PostLink('<i class="fa fa-trash"></i>','/Promotion/delete/'.$promotion->id,array('escape'=>false,'class'=>'btn btn-danger btn-xs','confirm' => __('Are you sure you want to delete # {0}?', $promotion->id)));?>
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
