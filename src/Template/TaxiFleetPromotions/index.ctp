<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Price Masters'), ['controller' => 'PriceMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Price Master'), ['controller' => 'PriceMasters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotion Cities'), ['controller' => 'TaxiFleetPromotionCities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion City'), ['controller' => 'TaxiFleetPromotionCities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotion Rows'), ['controller' => 'TaxiFleetPromotionRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion Row'), ['controller' => 'TaxiFleetPromotionRows', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotion States'), ['controller' => 'TaxiFleetPromotionStates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion State'), ['controller' => 'TaxiFleetPromotionStates', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="taxiFleetPromotions index large-9 medium-8 columns content">
    <h3><?= __('Taxi Fleet Promotions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('document') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price_master_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('like_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('visible_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edited_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edited_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($taxiFleetPromotions as $taxiFleetPromotion): ?>
            <tr>
                <td><?= $this->Number->format($taxiFleetPromotion->id) ?></td>
                <td><?= h($taxiFleetPromotion->title) ?></td>
                <td><?= $taxiFleetPromotion->has('country') ? $this->Html->link($taxiFleetPromotion->country->id, ['controller' => 'Countries', 'action' => 'view', $taxiFleetPromotion->country->id]) : '' ?></td>
                <td><?= $this->Number->format($taxiFleetPromotion->image) ?></td>
                <td><?= $this->Number->format($taxiFleetPromotion->document) ?></td>
                <td><?= $taxiFleetPromotion->has('price_master') ? $this->Html->link($taxiFleetPromotion->price_master->week, ['controller' => 'PriceMasters', 'action' => 'view', $taxiFleetPromotion->price_master->id]) : '' ?></td>
                <td><?= $this->Number->format($taxiFleetPromotion->like_count) ?></td>
                <td><?= h($taxiFleetPromotion->visible_date) ?></td>
                <td><?= $taxiFleetPromotion->has('user') ? $this->Html->link($taxiFleetPromotion->user->last_name, ['controller' => 'Users', 'action' => 'view', $taxiFleetPromotion->user->id]) : '' ?></td>
                <td><?= h($taxiFleetPromotion->created_on) ?></td>
                <td><?= $this->Number->format($taxiFleetPromotion->edited_by) ?></td>
                <td><?= h($taxiFleetPromotion->edited_on) ?></td>
                <td><?= $this->Number->format($taxiFleetPromotion->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $taxiFleetPromotion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $taxiFleetPromotion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $taxiFleetPromotion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taxiFleetPromotion->id)]) ?>
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
