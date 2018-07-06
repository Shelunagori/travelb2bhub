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
                ['action' => 'delete', $hotelPromotionCart->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionCart->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Hotel Promotion Carts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Hotel Promotions'), ['controller' => 'HotelPromotions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hotel Promotion'), ['controller' => 'HotelPromotions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="hotelPromotionCarts form large-9 medium-8 columns content">
    <?= $this->Form->create($hotelPromotionCart) ?>
    <fieldset>
        <legend><?= __('Edit Hotel Promotion Cart') ?></legend>
        <?php
            echo $this->Form->input('hotel_promotion_id', ['options' => $hotelPromotions]);
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('created_on');
            echo $this->Form->input('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
