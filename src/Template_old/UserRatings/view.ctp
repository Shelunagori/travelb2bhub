<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User Rating'), ['action' => 'edit', $userRating->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User Rating'), ['action' => 'delete', $userRating->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userRating->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User Ratings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Rating'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="userRatings view large-9 medium-8 columns content">
    <h3><?= h($userRating->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userRating->has('user') ? $this->Html->link($userRating->user->last_name, ['controller' => 'Users', 'action' => 'view', $userRating->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($userRating->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Request Id') ?></th>
            <td><?= $this->Number->format($userRating->request_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rating') ?></th>
            <td><?= $this->Number->format($userRating->rating) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($userRating->created) ?></td>
        </tr>
    </table>
</div>
