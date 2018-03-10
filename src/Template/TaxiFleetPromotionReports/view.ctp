<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Taxi Fleet Promotion Report'), ['action' => 'edit', $taxiFleetPromotionReport->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Taxi Fleet Promotion Report'), ['action' => 'delete', $taxiFleetPromotionReport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taxiFleetPromotionReport->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotion Reports'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion Report'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotions'), ['controller' => 'TaxiFleetPromotions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion'), ['controller' => 'TaxiFleetPromotions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Report Reasons'), ['controller' => 'ReportReasons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Report Reason'), ['controller' => 'ReportReasons', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="taxiFleetPromotionReports view large-9 medium-8 columns content">
    <h3><?= h($taxiFleetPromotionReport->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Taxi Fleet Promotion') ?></th>
            <td><?= $taxiFleetPromotionReport->has('taxi_fleet_promotion') ? $this->Html->link($taxiFleetPromotionReport->taxi_fleet_promotion->title, ['controller' => 'TaxiFleetPromotions', 'action' => 'view', $taxiFleetPromotionReport->taxi_fleet_promotion->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $taxiFleetPromotionReport->has('user') ? $this->Html->link($taxiFleetPromotionReport->user->last_name, ['controller' => 'Users', 'action' => 'view', $taxiFleetPromotionReport->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Report Reason') ?></th>
            <td><?= $taxiFleetPromotionReport->has('report_reason') ? $this->Html->link($taxiFleetPromotionReport->report_reason->id, ['controller' => 'ReportReasons', 'action' => 'view', $taxiFleetPromotionReport->report_reason->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($taxiFleetPromotionReport->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($taxiFleetPromotionReport->created_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($taxiFleetPromotionReport->comment)); ?>
    </div>
</div>
