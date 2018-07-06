<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Hotel Promotion City'), ['action' => 'edit', $hotelPromotionCity->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Hotel Promotion City'), ['action' => 'delete', $hotelPromotionCity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionCity->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Hotel Promotion Cities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel Promotion City'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="hotelPromotionCities view large-9 medium-8 columns content">
    <h3><?= h($hotelPromotionCity->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= $hotelPromotionCity->has('city') ? $this->Html->link($hotelPromotionCity->city->name, ['controller' => 'Cities', 'action' => 'view', $hotelPromotionCity->city->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($hotelPromotionCity->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hotel Promotion Id') ?></th>
            <td><?= $this->Number->format($hotelPromotionCity->hotel_promotion_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Charges') ?></th>
            <td><?= $this->Number->format($hotelPromotionCity->charges) ?></td>
        </tr>
    </table>
</div>
