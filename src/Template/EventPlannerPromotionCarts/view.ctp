<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Event Planner Promotion Cart'), ['action' => 'edit', $eventPlannerPromotionCart->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Event Planner Promotion Cart'), ['action' => 'delete', $eventPlannerPromotionCart->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventPlannerPromotionCart->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Event Planner Promotion Carts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event Planner Promotion Cart'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Event Planner Promotions'), ['controller' => 'EventPlannerPromotions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event Planner Promotion'), ['controller' => 'EventPlannerPromotions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="eventPlannerPromotionCarts view large-9 medium-8 columns content">
    <h3><?= h($eventPlannerPromotionCart->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Event Planner Promotion') ?></th>
            <td><?= $eventPlannerPromotionCart->has('event_planner_promotion') ? $this->Html->link($eventPlannerPromotionCart->event_planner_promotion->id, ['controller' => 'EventPlannerPromotions', 'action' => 'view', $eventPlannerPromotionCart->event_planner_promotion->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $eventPlannerPromotionCart->has('user') ? $this->Html->link($eventPlannerPromotionCart->user->last_name, ['controller' => 'Users', 'action' => 'view', $eventPlannerPromotionCart->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($eventPlannerPromotionCart->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($eventPlannerPromotionCart->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($eventPlannerPromotionCart->created_on) ?></td>
        </tr>
    </table>
</div>
