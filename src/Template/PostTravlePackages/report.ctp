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
									<th scope="col"><?= ('Title') ?></th>
									<th scope="col"><?= ('Duration Night') ?></th>
									<th scope="col"><?= ('Duration Day') ?></th>
									<th scope="col"><?= ('Valid Date') ?></th>
									<th scope="col"><?= ('Currency') ?></th>
									<th scope="col"><?= ('Starting Price') ?></th>
									<th scope="col"><?= ('Country') ?></th>
									<th scope="col"><?= ('Image') ?></th>
									<th scope="col"><?= ('Document') ?></th>
									<th scope="col"><?= ('Duration') ?></th>
									<th scope="col"><?= ('Likes') ?></th>
									<th scope="col"><?= ('Visible Date') ?></th>
									<th scope="col"><?= ('User Name') ?></th>
									
									<th scope="col" class="actions"><?= __('Actions') ?></th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; foreach ($postTravlePackages as $postTravlePackage): ?>
								<tr>
									<td><?= $i; ?></td>
									<td><?= h($postTravlePackage->title) ?></td>
									<td><?= $this->Number->format($postTravlePackage->duration_night) ?></td>
									<td><?= $this->Number->format($postTravlePackage->duration_day) ?></td>
									<td><?= h($postTravlePackage->valid_date) ?></td>
									<td><?= h($postTravlePackage->currency->name);?></td>
									<td><?= $this->Number->format($postTravlePackage->starting_price) ?></td>
									<td><?= h($postTravlePackage->country->country_name);?></td>
									<td><?= h($postTravlePackage->image) ?></td>
									<td><?= h($postTravlePackage->document) ?></td>
									<td><?= $postTravlePackage->has('price_master') ? $this->Html->link($postTravlePackage->price_master->id, ['controller' => 'PriceMasters', 'action' => 'view', $postTravlePackage->price_master->id]) : '' ?></td>
									<td><?= $this->Number->format($postTravlePackage->like_count) ?></td>
									<td><?= h($postTravlePackage->visible_date) ?></td>
									<td><?= $postTravlePackage->has('user') ? $this->Html->link($postTravlePackage->user->last_name, ['controller' => 'Users', 'action' => 'view', $postTravlePackage->user->id]) : '' ?></td>
									
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
