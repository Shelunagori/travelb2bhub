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
                ['action' => 'delete', $postTravlePackageCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $postTravlePackageCategory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Post Travle Package Categories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Post Travle Package Rows'), ['controller' => 'PostTravlePackageRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post Travle Package Row'), ['controller' => 'PostTravlePackageRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="postTravlePackageCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($postTravlePackageCategory) ?>
    <fieldset>
        <legend><?= __('Edit Post Travle Package Category') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
