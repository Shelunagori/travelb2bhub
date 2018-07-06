<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Report Reason'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Promotion Types'), ['controller' => 'PromotionTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Promotion Type'), ['controller' => 'PromotionTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Event Planner Promotion Reports'), ['controller' => 'EventPlannerPromotionReports', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event Planner Promotion Report'), ['controller' => 'EventPlannerPromotionReports', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Post Travle Package Reports'), ['controller' => 'PostTravlePackageReports', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post Travle Package Report'), ['controller' => 'PostTravlePackageReports', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotion Reports'), ['controller' => 'TaxiFleetPromotionReports', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion Report'), ['controller' => 'TaxiFleetPromotionReports', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="reportReasons index large-9 medium-8 columns content">
    <h3><?= __('Report Reasons') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('promotion_types_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reason') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reportReasons as $reportReason): ?>
            <tr>
                <td><?= $this->Number->format($reportReason->id) ?></td>
                <td><?= $reportReason->has('promotion_type') ? $this->Html->link($reportReason->promotion_type->name, ['controller' => 'PromotionTypes', 'action' => 'view', $reportReason->promotion_type->id]) : '' ?></td>
                <td><?= h($reportReason->reason) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $reportReason->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $reportReason->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $reportReason->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reportReason->id)]) ?>
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
