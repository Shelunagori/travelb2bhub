<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Meal Plan'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mealPlans index large-9 medium-8 columns content">
    <h3><?= __('Meal Plans') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mealPlans as $mealPlan): ?>
            <tr>
                <td><?= $this->Number->format($mealPlan->id) ?></td>
                <td><?= h($mealPlan->name) ?></td>
                <td><?= h($mealPlan->created_on) ?></td>
                <td><?= $this->Number->format($mealPlan->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mealPlan->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mealPlan->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mealPlan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mealPlan->id)]) ?>
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
