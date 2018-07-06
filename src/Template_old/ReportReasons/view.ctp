<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Report Reason'), ['action' => 'edit', $reportReason->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Report Reason'), ['action' => 'delete', $reportReason->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reportReason->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Report Reasons'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Report Reason'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Promotion Types'), ['controller' => 'PromotionTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Promotion Type'), ['controller' => 'PromotionTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Event Planner Promotion Reports'), ['controller' => 'EventPlannerPromotionReports', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event Planner Promotion Report'), ['controller' => 'EventPlannerPromotionReports', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Post Travle Package Reports'), ['controller' => 'PostTravlePackageReports', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post Travle Package Report'), ['controller' => 'PostTravlePackageReports', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Taxi Fleet Promotion Reports'), ['controller' => 'TaxiFleetPromotionReports', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Taxi Fleet Promotion Report'), ['controller' => 'TaxiFleetPromotionReports', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="reportReasons view large-9 medium-8 columns content">
    <h3><?= h($reportReason->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Promotion Type') ?></th>
            <td><?= $reportReason->has('promotion_type') ? $this->Html->link($reportReason->promotion_type->name, ['controller' => 'PromotionTypes', 'action' => 'view', $reportReason->promotion_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reason') ?></th>
            <td><?= h($reportReason->reason) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($reportReason->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Event Planner Promotion Reports') ?></h4>
        <?php if (!empty($reportReason->event_planner_promotion_reports)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Event Planner Promotion Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Report Reason Id') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($reportReason->event_planner_promotion_reports as $eventPlannerPromotionReports): ?>
            <tr>
                <td><?= h($eventPlannerPromotionReports->id) ?></td>
                <td><?= h($eventPlannerPromotionReports->event_planner_promotion_id) ?></td>
                <td><?= h($eventPlannerPromotionReports->user_id) ?></td>
                <td><?= h($eventPlannerPromotionReports->report_reason_id) ?></td>
                <td><?= h($eventPlannerPromotionReports->comment) ?></td>
                <td><?= h($eventPlannerPromotionReports->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EventPlannerPromotionReports', 'action' => 'view', $eventPlannerPromotionReports->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EventPlannerPromotionReports', 'action' => 'edit', $eventPlannerPromotionReports->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EventPlannerPromotionReports', 'action' => 'delete', $eventPlannerPromotionReports->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventPlannerPromotionReports->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Post Travle Package Reports') ?></h4>
        <?php if (!empty($reportReason->post_travle_package_reports)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Post Travle Package Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Report Reason Id') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($reportReason->post_travle_package_reports as $postTravlePackageReports): ?>
            <tr>
                <td><?= h($postTravlePackageReports->id) ?></td>
                <td><?= h($postTravlePackageReports->post_travle_package_id) ?></td>
                <td><?= h($postTravlePackageReports->user_id) ?></td>
                <td><?= h($postTravlePackageReports->report_reason_id) ?></td>
                <td><?= h($postTravlePackageReports->comment) ?></td>
                <td><?= h($postTravlePackageReports->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PostTravlePackageReports', 'action' => 'view', $postTravlePackageReports->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PostTravlePackageReports', 'action' => 'edit', $postTravlePackageReports->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PostTravlePackageReports', 'action' => 'delete', $postTravlePackageReports->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postTravlePackageReports->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Taxi Fleet Promotion Reports') ?></h4>
        <?php if (!empty($reportReason->taxi_fleet_promotion_reports)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Taxi Fleet Promotion Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Report Reason Id') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($reportReason->taxi_fleet_promotion_reports as $taxiFleetPromotionReports): ?>
            <tr>
                <td><?= h($taxiFleetPromotionReports->id) ?></td>
                <td><?= h($taxiFleetPromotionReports->taxi_fleet_promotion_id) ?></td>
                <td><?= h($taxiFleetPromotionReports->user_id) ?></td>
                <td><?= h($taxiFleetPromotionReports->report_reason_id) ?></td>
                <td><?= h($taxiFleetPromotionReports->comment) ?></td>
                <td><?= h($taxiFleetPromotionReports->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TaxiFleetPromotionReports', 'action' => 'view', $taxiFleetPromotionReports->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TaxiFleetPromotionReports', 'action' => 'edit', $taxiFleetPromotionReports->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TaxiFleetPromotionReports', 'action' => 'delete', $taxiFleetPromotionReports->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taxiFleetPromotionReports->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
