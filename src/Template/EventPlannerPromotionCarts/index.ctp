<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Event Planner Promotion Cart'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Event Planner Promotions'), ['controller' => 'EventPlannerPromotions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event Planner Promotion'), ['controller' => 'EventPlannerPromotions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="eventPlannerPromotionCarts index large-9 medium-8 columns content">
    <h3><?= __('Event Planner Promotion Carts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event_planner_promotion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventPlannerPromotionCarts as $eventPlannerPromotionCart): ?>
            <tr>
                <td><?= $this->Number->format($eventPlannerPromotionCart->id) ?></td>
                <td><?= $eventPlannerPromotionCart->has('event_planner_promotion') ? $this->Html->link($eventPlannerPromotionCart->event_planner_promotion->id, ['controller' => 'EventPlannerPromotions', 'action' => 'view', $eventPlannerPromotionCart->event_planner_promotion->id]) : '' ?></td>
                <td><?= $eventPlannerPromotionCart->has('user') ? $this->Html->link($eventPlannerPromotionCart->user->last_name, ['controller' => 'Users', 'action' => 'view', $eventPlannerPromotionCart->user->id]) : '' ?></td>
                <td><?= h($eventPlannerPromotionCart->created_on) ?></td>
                <td><?= $this->Number->format($eventPlannerPromotionCart->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $eventPlannerPromotionCart->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $eventPlannerPromotionCart->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $eventPlannerPromotionCart->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventPlannerPromotionCart->id)]) ?>
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
