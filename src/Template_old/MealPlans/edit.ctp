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
                ['action' => 'delete', $mealPlan->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mealPlan->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Meal Plans'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="mealPlans form large-9 medium-8 columns content">
    <?= $this->Form->create($mealPlan) ?>
    <fieldset>
        <legend><?= __('Edit Meal Plan') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('created_on');
            echo $this->Form->input('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
