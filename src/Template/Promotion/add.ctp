<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Promotion'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="promotion form large-9 medium-8 columns content">
    <?= $this->Form->create($promotion) ?>
    <fieldset>
        <legend><?= __('Add Promotion') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('hotel_name');
            echo $this->Form->input('hotel_rating');
            echo $this->Form->input('hotel_location');
            echo $this->Form->input('hotel_type');
            echo $this->Form->input('cheap_tariff');
            echo $this->Form->input('expensive_tariff');
            echo $this->Form->input('website');
            echo $this->Form->input('cities');
            echo $this->Form->input('charges');
            echo $this->Form->input('duration');
            echo $this->Form->input('status');
            echo $this->Form->input('hotel_pic');
            echo $this->Form->input('payment_status');
            echo $this->Form->input('citycharge');
            echo $this->Form->input('expiry_date');
            echo $this->Form->input('count');
            echo $this->Form->input('created_at');
            echo $this->Form->input('updated_at');
            echo $this->Form->input('accept_date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
