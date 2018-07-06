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
                ['action' => 'delete', $postTravlePackageCart->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $postTravlePackageCart->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Post Travle Package Carts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Post Travle Packages'), ['controller' => 'PostTravlePackages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post Travle Package'), ['controller' => 'PostTravlePackages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="postTravlePackageCarts form large-9 medium-8 columns content">
    <?= $this->Form->create($postTravlePackageCart) ?>
    <fieldset>
        <legend><?= __('Edit Post Travle Package Cart') ?></legend>
        <?php
            echo $this->Form->input('post_travle_package_id', ['options' => $postTravlePackages]);
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('created_on');
            echo $this->Form->input('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
