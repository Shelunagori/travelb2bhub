<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Event Planner Promotion Report'), ['action' => 'edit', $eventPlannerPromotionReport->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Event Planner Promotion Report'), ['action' => 'delete', $eventPlannerPromotionReport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventPlannerPromotionReport->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Event Planner Promotion Reports'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event Planner Promotion Report'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Event Planner Promotions'), ['controller' => 'EventPlannerPromotions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event Planner Promotion'), ['controller' => 'EventPlannerPromotions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Report Reasons'), ['controller' => 'ReportReasons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Report Reason'), ['controller' => 'ReportReasons', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="eventPlannerPromotionReports view large-9 medium-8 columns content">
    <h3><?= h($eventPlannerPromotionReport->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Event Planner Promotion') ?></th>
            <td><?= $eventPlannerPromotionReport->has('event_planner_promotion') ? $this->Html->link($eventPlannerPromotionReport->event_planner_promotion->id, ['controller' => 'EventPlannerPromotions', 'action' => 'view', $eventPlannerPromotionReport->event_planner_promotion->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $eventPlannerPromotionReport->has('user') ? $this->Html->link($eventPlannerPromotionReport->user->last_name, ['controller' => 'Users', 'action' => 'view', $eventPlannerPromotionReport->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Report Reason') ?></th>
            <td><?= $eventPlannerPromotionReport->has('report_reason') ? $this->Html->link($eventPlannerPromotionReport->report_reason->id, ['controller' => 'ReportReasons', 'action' => 'view', $eventPlannerPromotionReport->report_reason->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($eventPlannerPromotionReport->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($eventPlannerPromotionReport->created_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($eventPlannerPromotionReport->comment)); ?>
    </div>
</div>
