<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Requests'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Ratings'), ['controller' => 'UserRatings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Rating'), ['controller' => 'UserRatings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Responses'), ['controller' => 'Responses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Response'), ['controller' => 'Responses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hotels'), ['controller' => 'Hotels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hotel'), ['controller' => 'Hotels', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Request Stops'), ['controller' => 'RequestStops', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Request Stop'), ['controller' => 'RequestStops', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="requests form large-9 medium-8 columns content">
    <?= $this->Form->create($request) ?>
    <fieldset>
        <legend><?= __('Add Request') ?></legend>
        <?php
            echo $this->Form->input('category_id');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('final_id');
            echo $this->Form->input('state_id');
            echo $this->Form->input('country_id');
            echo $this->Form->input('locality');
            echo $this->Form->input('reference_id');
            echo $this->Form->input('response_id');
            echo $this->Form->input('total_budget');
            echo $this->Form->input('children');
            echo $this->Form->input('adult');
            echo $this->Form->input('room1');
            echo $this->Form->input('room2');
            echo $this->Form->input('room3');
            echo $this->Form->input('child_with_bed');
            echo $this->Form->input('child_without_bed');
            echo $this->Form->input('hotel_rating');
            echo $this->Form->input('hotel_category');
            echo $this->Form->input('meal_plan');
            echo $this->Form->input('destination_city');
            echo $this->Form->input('check_in');
            echo $this->Form->input('check_out');
            echo $this->Form->input('transport_requirement');
            echo $this->Form->input('pickup_city');
            echo $this->Form->input('pickup_state');
            echo $this->Form->input('pickup_country');
            echo $this->Form->input('pickup_locality');
            echo $this->Form->input('city_id', ['options' => $cities, 'empty' => true]);
            echo $this->Form->input('final_locality');
            echo $this->Form->input('final_city');
            echo $this->Form->input('final_state');
            echo $this->Form->input('final_country');
            echo $this->Form->input('comment');
            echo $this->Form->input('start_date', ['empty' => true]);
            echo $this->Form->input('end_date', ['empty' => true]);
            echo $this->Form->input('stops');
            echo $this->Form->input('status');
            echo $this->Form->input('is_deleted');
            echo $this->Form->input('accept_date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
