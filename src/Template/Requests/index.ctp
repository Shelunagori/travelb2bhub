<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-list"></i><b>Requests</b>
				</div> 
			 <div class="box-body"> 
				<table class="table table-bordered" cellpadding="0" cellspacing="0" id="main_tble">
						<thead>
							<tr style="background-color:#DFD9C4;">
							<th scope="col"><?= __('Sr.No') ?></th>
							<th scope="col"><?= __('Reference_id') ?></th>
							<th scope="col"><?= __('Agent Name') ?></th>
							<th scope="col"><?= __('Locality') ?></th>
							<th scope="col"><?= __('Total Budget') ?></th>
							<th scope="col"><?= __('Request Type') ?></th>
							<th scope="col"><?= __('Created At') ?></th>
							<th scope="col"><?= __('Status') ?></th>
							<th scope="col"><?= __('Removed') ?></th>
							<th scope="col"><?= __('City') ?></th>
							<th scope="col"><?= __('Status') ?></th>							
							<th scope="col"><?= __('Pickup City') ?></th>							
							<th scope="col"><?= __('Pickup State') ?></th>							
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
        <tbody>
            <?php $i=1;foreach ($requests as $request): ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= h($request->reference_id) ?></td>
                <td><?= $request->has('user') ? $this->Html->link($request->user->first_name.$request->user->last_name, ['controller' => 'Users', 'action' => 'view', $request->user->id]) : '' ?></td>
                <td><?= h($request->locality) ?></td>
                <td><?= $this->Number->format($request->total_budget) ?></td>
                <td><?= h($request->category_id) ?></td>
				<td><?= h($request->created) ?></td>
				<td><?= h($request->status) ?></td>
				<td><?= h($request->status) ?>Open</td>
				<td><?= h($request->city_id) ?></td>
				<td><?= h($request->state_id) ?></td>
				<td><?= h($request->pickup_city) ?></td>
				<td><?= h($request->pickup_state) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $request->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $request->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $request->id], ['confirm' => __('Are you sure you want to delete # {0}?', $request->id)]) ?>
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