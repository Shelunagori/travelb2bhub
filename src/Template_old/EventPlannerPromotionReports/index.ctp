<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Event Planner Promotion Report'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Event Planner Promotions'), ['controller' => 'EventPlannerPromotions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event Planner Promotion'), ['controller' => 'EventPlannerPromotions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Report Reasons'), ['controller' => 'ReportReasons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Report Reason'), ['controller' => 'ReportReasons', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="eventPlannerPromotionReports index large-9 medium-8 columns content">
    <h3><?= __('Event Planner Promotion Reports') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event_planner_promotion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('report_reason_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventPlannerPromotionReports as $eventPlannerPromotionReport): ?>
            <tr>
                <td><?= $this->Number->format($eventPlannerPromotionReport->id) ?></td>
                <td><?= $eventPlannerPromotionReport->has('event_planner_promotion') ? $this->Html->link($eventPlannerPromotionReport->event_planner_promotion->id, ['controller' => 'EventPlannerPromotions', 'action' => 'view', $eventPlannerPromotionReport->event_planner_promotion->id]) : '' ?></td>
                <td><?= $eventPlannerPromotionReport->has('user') ? $this->Html->link($eventPlannerPromotionReport->user->last_name, ['controller' => 'Users', 'action' => 'view', $eventPlannerPromotionReport->user->id]) : '' ?></td>
                <td><?= $eventPlannerPromotionReport->has('report_reason') ? $this->Html->link($eventPlannerPromotionReport->report_reason->id, ['controller' => 'ReportReasons', 'action' => 'view', $eventPlannerPromotionReport->report_reason->id]) : '' ?></td>
                <td><?= h($eventPlannerPromotionReport->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $eventPlannerPromotionReport->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $eventPlannerPromotionReport->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $eventPlannerPromotionReport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventPlannerPromotionReport->id)]) ?>
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
