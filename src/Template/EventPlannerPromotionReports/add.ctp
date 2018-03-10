<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Event Planner Promotion Reports'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Event Planner Promotions'), ['controller' => 'EventPlannerPromotions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event Planner Promotion'), ['controller' => 'EventPlannerPromotions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Report Reasons'), ['controller' => 'ReportReasons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Report Reason'), ['controller' => 'ReportReasons', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="eventPlannerPromotionReports form large-9 medium-8 columns content">
    <?= $this->Form->create($eventPlannerPromotionReport) ?>
    <fieldset>
        <legend><?= __('Add Event Planner Promotion Report') ?></legend>
        <?php
            echo $this->Form->input('event_planner_promotion_id', ['options' => $eventPlannerPromotions]);
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('report_reason_id', ['options' => $reportReasons]);
            echo $this->Form->input('comment');
            echo $this->Form->input('created_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
