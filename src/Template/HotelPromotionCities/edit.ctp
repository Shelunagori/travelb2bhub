<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $hotelPromotionCity->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionCity->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Hotel Promotion Cities'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="hotelPromotionCities form large-9 medium-8 columns content">
    <?= $this->Form->create($hotelPromotionCity) ?>
    <fieldset>
        <legend><?= __('Edit Hotel Promotion City') ?></legend>
        <?php
            echo $this->Form->input('hotel_promotion_id');
            echo $this->Form->input('city_id', ['options' => $cities]);
            echo $this->Form->input('charges');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
