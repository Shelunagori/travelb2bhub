<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Responses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Testimonial'), ['controller' => 'Testimonial', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Testimonial'), ['controller' => 'Testimonial', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Chats'), ['controller' => 'UserChats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Chat'), ['controller' => 'UserChats', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="responses form large-9 medium-8 columns content">
    <?= $this->Form->create($response) ?>
    <fieldset>
        <legend><?= __('Add Response') ?></legend>
        <?php
            echo $this->Form->input('request_id', ['options' => $requests]);
            echo $this->Form->input('user_id', ['options' => $testimonial]);
            echo $this->Form->input('comment');
            echo $this->Form->input('quotation_price');
            echo $this->Form->input('is_details_shared');
            echo $this->Form->input('status');
            echo $this->Form->input('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
