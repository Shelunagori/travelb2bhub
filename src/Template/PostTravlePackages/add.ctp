<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Post Travle Packages'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Currencies'), ['controller' => 'Currencies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Currency'), ['controller' => 'Currencies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Price Masters'), ['controller' => 'PriceMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Price Master'), ['controller' => 'PriceMasters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Post Travle Package Cities'), ['controller' => 'PostTravlePackageCities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post Travle Package City'), ['controller' => 'PostTravlePackageCities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Post Travle Package Rows'), ['controller' => 'PostTravlePackageRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post Travle Package Row'), ['controller' => 'PostTravlePackageRows', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Post Travle Package States'), ['controller' => 'PostTravlePackageStates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post Travle Package State'), ['controller' => 'PostTravlePackageStates', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="postTravlePackages form large-9 medium-8 columns content">
    <?= $this->Form->create($postTravlePackage) ?>
    <fieldset>
        <legend><?= __('Add Post Travle Package') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('duration_night');
            echo $this->Form->input('duration_day');
            echo $this->Form->input('valid_date');
            echo $this->Form->input('currency_id', ['options' => $currencies]);
            echo $this->Form->input('starting_price');
            echo $this->Form->input('country_id', ['options' => $countries]);
            echo $this->Form->input('package_detail');
            echo $this->Form->input('excluded_detail');
            echo $this->Form->input('image');
            echo $this->Form->input('document');
            echo $this->Form->input('price_master_id', ['options' => $priceMasters]);
            echo $this->Form->input('like_count');
            echo $this->Form->input('visible_date');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('created_on');
            echo $this->Form->input('edited_by');
            echo $this->Form->input('edited_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
