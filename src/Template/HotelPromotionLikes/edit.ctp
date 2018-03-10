<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $hotelPromotionLike->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionLike->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Hotel Promotion Likes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="hotelPromotionLikes form large-9 medium-8 columns content">
    <?= $this->Form->create($hotelPromotionLike) ?>
    <fieldset>
        <legend><?= __('Edit Hotel Promotion Like') ?></legend>
        <?php
            echo $this->Form->input('hotel_promotion_id');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('created_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
