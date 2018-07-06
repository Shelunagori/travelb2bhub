<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Price Master'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Promotion Types'), ['controller' => 'PromotionTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Promotion Type'), ['controller' => 'PromotionTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Event Planner Promotions'), ['controller' => 'EventPlannerPromotions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event Planner Promotion'), ['controller' => 'EventPlannerPromotions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Post Travle Packages'), ['controller' => 'PostTravlePackages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post Travle Package'), ['controller' => 'PostTravlePackages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotions'), ['controller' => 'TaxiFleetPromotions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion'), ['controller' => 'TaxiFleetPromotions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="priceMasters index large-9 medium-8 columns content">
    <h3><?= __('Price Masters') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('promotion_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('week') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($priceMasters as $priceMaster): ?>
            <tr>
                <td><?= $this->Number->format($priceMaster->id) ?></td>
                <td><?= $priceMaster->has('promotion_type') ? $this->Html->link($priceMaster->promotion_type->name, ['controller' => 'PromotionTypes', 'action' => 'view', $priceMaster->promotion_type->id]) : '' ?></td>
                <td><?= $this->Number->format($priceMaster->price) ?></td>
                <td><?= h($priceMaster->week) ?></td>
                <td><?= $this->Number->format($priceMaster->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $priceMaster->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $priceMaster->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $priceMaster->id], ['confirm' => __('Are you sure you want to delete # {0}?', $priceMaster->id)]) ?>
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
