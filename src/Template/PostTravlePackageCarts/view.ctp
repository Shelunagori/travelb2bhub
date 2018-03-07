<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Post Travle Package Cart'), ['action' => 'edit', $postTravlePackageCart->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Post Travle Package Cart'), ['action' => 'delete', $postTravlePackageCart->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postTravlePackageCart->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Post Travle Package Carts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post Travle Package Cart'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Post Travle Packages'), ['controller' => 'PostTravlePackages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post Travle Package'), ['controller' => 'PostTravlePackages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="postTravlePackageCarts view large-9 medium-8 columns content">
    <h3><?= h($postTravlePackageCart->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Post Travle Package') ?></th>
            <td><?= $postTravlePackageCart->has('post_travle_package') ? $this->Html->link($postTravlePackageCart->post_travle_package->title, ['controller' => 'PostTravlePackages', 'action' => 'view', $postTravlePackageCart->post_travle_package->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $postTravlePackageCart->has('user') ? $this->Html->link($postTravlePackageCart->user->last_name, ['controller' => 'Users', 'action' => 'view', $postTravlePackageCart->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($postTravlePackageCart->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($postTravlePackageCart->is_deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($postTravlePackageCart->created_on) ?></td>
        </tr>
    </table>
</div>
