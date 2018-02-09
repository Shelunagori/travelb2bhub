<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Promotion'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="promotion index large-9 medium-8 columns content">
    <h3><?= __('Promotion') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hotel_rating') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cheap_tariff') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expensive_tariff') ?></th>
                <th scope="col"><?= $this->Paginator->sort('charges') ?></th>
                <th scope="col"><?= $this->Paginator->sort('duration') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expiry_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('accept_date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($promotion as $promotion): ?>
            <tr>
                <td><?= $this->Number->format($promotion->id) ?></td>
                <td><?= $promotion->has('user') ? $this->Html->link($promotion->user->id, ['controller' => 'Users', 'action' => 'view', $promotion->user->id]) : '' ?></td>
                <td><?= $this->Number->format($promotion->hotel_rating) ?></td>
                <td><?= $this->Number->format($promotion->cheap_tariff) ?></td>
                <td><?= $this->Number->format($promotion->expensive_tariff) ?></td>
                <td><?= $this->Number->format($promotion->charges) ?></td>
                <td><?= $this->Number->format($promotion->duration) ?></td>
                <td><?= h($promotion->expiry_date) ?></td>
                <td><?= $this->Number->format($promotion->count) ?></td>
                <td><?= h($promotion->created_at) ?></td>
                <td><?= h($promotion->updated_at) ?></td>
                <td><?= h($promotion->accept_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $promotion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $promotion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $promotion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $promotion->id)]) ?>
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
