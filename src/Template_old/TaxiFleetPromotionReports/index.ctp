<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion Report'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotions'), ['controller' => 'TaxiFleetPromotions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion'), ['controller' => 'TaxiFleetPromotions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Report Reasons'), ['controller' => 'ReportReasons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Report Reason'), ['controller' => 'ReportReasons', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="taxiFleetPromotionReports index large-9 medium-8 columns content">
    <h3><?= __('Taxi Fleet Promotion Reports') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('taxi_fleet_promotion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('report_reason_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($taxiFleetPromotionReports as $taxiFleetPromotionReport): ?>
            <tr>
                <td><?= $this->Number->format($taxiFleetPromotionReport->id) ?></td>
                <td><?= $taxiFleetPromotionReport->has('taxi_fleet_promotion') ? $this->Html->link($taxiFleetPromotionReport->taxi_fleet_promotion->title, ['controller' => 'TaxiFleetPromotions', 'action' => 'view', $taxiFleetPromotionReport->taxi_fleet_promotion->id]) : '' ?></td>
                <td><?= $taxiFleetPromotionReport->has('user') ? $this->Html->link($taxiFleetPromotionReport->user->last_name, ['controller' => 'Users', 'action' => 'view', $taxiFleetPromotionReport->user->id]) : '' ?></td>
                <td><?= $taxiFleetPromotionReport->has('report_reason') ? $this->Html->link($taxiFleetPromotionReport->report_reason->id, ['controller' => 'ReportReasons', 'action' => 'view', $taxiFleetPromotionReport->report_reason->id]) : '' ?></td>
                <td><?= h($taxiFleetPromotionReport->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $taxiFleetPromotionReport->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $taxiFleetPromotionReport->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $taxiFleetPromotionReport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taxiFleetPromotionReport->id)]) ?>
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
