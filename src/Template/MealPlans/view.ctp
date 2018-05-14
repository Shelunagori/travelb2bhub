<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Meal Plan'), ['action' => 'edit', $mealPlan->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Meal Plan'), ['action' => 'delete', $mealPlan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mealPlan->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Meal Plans'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Meal Plan'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mealPlans view large-9 medium-8 columns content">
    <h3><?= h($mealPlan->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($mealPlan->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mealPlan->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($mealPlan->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($mealPlan->created_on) ?></td>
        </tr>
    </table>
</div>
