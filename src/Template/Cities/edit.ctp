<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $city->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $city->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hotels'), ['controller' => 'Hotels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hotel'), ['controller' => 'Hotels', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Transports'), ['controller' => 'Transports', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Transport'), ['controller' => 'Transports', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cities form large-9 medium-8 columns content">
    <?= $this->Form->create($city) ?>
    <fieldset>
        <legend><?= __('Edit City') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('state_id', ['options' => $states]);
            echo $this->Form->input('price');
            echo $this->Form->input('category');
            echo $this->Form->input('updated_at');
            echo $this->Form->input('created_at');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
