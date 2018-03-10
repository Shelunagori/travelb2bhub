<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $reportReason->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $reportReason->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Report Reasons'), ['action' => 'index']) ?></li>
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
<div class="reportReasons form large-9 medium-8 columns content">
    <?= $this->Form->create($reportReason) ?>
    <fieldset>
        <legend><?= __('Edit Report Reason') ?></legend>
        <?php
            echo $this->Form->input('promotion_types_id', ['options' => $promotionTypes]);
            echo $this->Form->input('reason');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
