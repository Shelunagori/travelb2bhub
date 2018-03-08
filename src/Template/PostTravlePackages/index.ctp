<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div id="my_final_responses" class="container-fluid">
	<div class="row equal_column">
		<div class="col-md-12" style="background-color:#fff"> 
			<br>
			<?php echo  $this->Flash->render() ?>
		</div>
		<div class="col-md-12" style="background-color:#fff"> 
			<div class="box box-default">
				<div class="box-header with-border"> 
					<h3 class="box-title" style="padding:5px"><?= __('Post Travle Packages') ?></h3>
					<div class="box-tools pull-right">
 					</div>
 				</div>
				<div class="box-body">
						<table class="table" cellpadding="0" cellspacing="0">
							<thead>
								<tr style="background-color:#709090;color:white;">
									<th scope="col"><?= ('Sr.No') ?></th>
									<th scope="col"><?= ('title') ?></th>
									<th scope="col"><?= ('duration_night') ?></th>
									<th scope="col"><?= ('duration_day') ?></th>
									<th scope="col"><?= ('valid_date') ?></th>
									<th scope="col"><?= ('currency_id') ?></th>
									<th scope="col"><?= ('starting_price') ?></th>
									<th scope="col"><?= ('country_id') ?></th>
									<th scope="col"><?= ('image') ?></th>
									<th scope="col"><?= ('document') ?></th>
									<th scope="col"><?= ('price_master_id') ?></th>
									<th scope="col"><?= ('like_count') ?></th>
									<th scope="col"><?= ('visible_date') ?></th>
									<th scope="col"><?= ('user_id') ?></th>
									<th scope="col"><?= ('created_on') ?></th>
									<th scope="col"><?= ('edited_by') ?></th>
									<th scope="col"><?= ('edited_on') ?></th>
									<th scope="col" class="actions"><?= __('Actions') ?></th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; foreach ($postTravlePackages as $postTravlePackage): ?>
								<tr>
									<td><?= $i; ?></td>
									<td><?= $this->Number->format($postTravlePackage->id) ?></td>
									<td><?= h($postTravlePackage->title) ?></td>
									<td><?= $this->Number->format($postTravlePackage->duration_night) ?></td>
									<td><?= $this->Number->format($postTravlePackage->duration_day) ?></td>
									<td><?= h($postTravlePackage->valid_date) ?></td>
									<td><?= $postTravlePackage->has('currency') ? $this->Html->link($postTravlePackage->currency->name, ['controller' => 'Currencies', 'action' => 'view', $postTravlePackage->currency->id]) : '' ?></td>
									<td><?= $this->Number->format($postTravlePackage->starting_price) ?></td>
									<td><?= $postTravlePackage->has('country') ? $this->Html->link($postTravlePackage->country->country_name, ['controller' => 'Countries', 'action' => 'view', $postTravlePackage->country->id]) : '' ?></td>
									<td><?= h($postTravlePackage->image) ?></td>
									<td><?= h($postTravlePackage->document) ?></td>
									<td><?= $postTravlePackage->has('price_master') ? $this->Html->link($postTravlePackage->price_master->id, ['controller' => 'PriceMasters', 'action' => 'view', $postTravlePackage->price_master->id]) : '' ?></td>
									<td><?= $this->Number->format($postTravlePackage->like_count) ?></td>
									<td><?= h($postTravlePackage->visible_date) ?></td>
									<td><?= $postTravlePackage->has('user') ? $this->Html->link($postTravlePackage->user->last_name, ['controller' => 'Users', 'action' => 'view', $postTravlePackage->user->id]) : '' ?></td>
									<td><?= h($postTravlePackage->created_on) ?></td>
									<td><?= $this->Number->format($postTravlePackage->edited_by) ?></td>
									<td><?= h($postTravlePackage->edited_on) ?></td>
									<td class="actions">
										<?= $this->Html->link(__('View'), ['action' => 'view', $postTravlePackage->id]) ?>
										<?= $this->Html->link(__('Edit'), ['action' => 'edit', $postTravlePackage->id]) ?>
										<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $postTravlePackage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postTravlePackage->id)]) ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
							<div class="paginator">
								<ul class="pagination">
									<?= $this->Paginator->first('<< ' . __('first')) ?>
									<?= $this->Paginator->prev('< ' . __('previous')) ?>
									<?= $this->Paginator->numbers() ?>
									<?= $this->Paginator->next(__('next') . ' >') ?>
									<?= $this->Paginator->last(__('last') . ' >>') ?>
								</ul>
								<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
