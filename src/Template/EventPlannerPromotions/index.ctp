<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Event Planner Promotion'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Price Masters'), ['controller' => 'PriceMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Price Master'), ['controller' => 'PriceMasters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Event Planner Promotion Cities'), ['controller' => 'EventPlannerPromotionCities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event Planner Promotion City'), ['controller' => 'EventPlannerPromotionCities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Event Planner Promotion States'), ['controller' => 'EventPlannerPromotionStates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event Planner Promotion State'), ['controller' => 'EventPlannerPromotionStates', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="eventPlannerPromotions index large-9 medium-8 columns content">
    <h3><?= __('Event Planner Promotions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('document') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price_master_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('visible_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('like_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edited_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edited_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventPlannerPromotions as $eventPlannerPromotion): ?>
            <tr>
                <td><?= $this->Number->format($eventPlannerPromotion->id) ?></td>
                <td><?= $this->Number->format($eventPlannerPromotion->country_id) ?></td>
                <td><?= h($eventPlannerPromotion->image) ?></td>
                <td><?= h($eventPlannerPromotion->document) ?></td>
                <td><?= $eventPlannerPromotion->has('price_master') ? $this->Html->link($eventPlannerPromotion->price_master->week, ['controller' => 'PriceMasters', 'action' => 'view', $eventPlannerPromotion->price_master->id]) : '' ?></td>
                <td><?= h($eventPlannerPromotion->visible_date) ?></td>
                <td><?= $this->Number->format($eventPlannerPromotion->like_count) ?></td>
                <td><?= $eventPlannerPromotion->has('user') ? $this->Html->link($eventPlannerPromotion->user->last_name, ['controller' => 'Users', 'action' => 'view', $eventPlannerPromotion->user->id]) : '' ?></td>
                <td><?= h($eventPlannerPromotion->created_on) ?></td>
                <td><?= $this->Number->format($eventPlannerPromotion->edited_by) ?></td>
                <td><?= h($eventPlannerPromotion->edited_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $eventPlannerPromotion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $eventPlannerPromotion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $eventPlannerPromotion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventPlannerPromotion->id)]) ?>
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
