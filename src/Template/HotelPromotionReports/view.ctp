<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Hotel Promotion Report'), ['action' => 'edit', $hotelPromotionReport->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Hotel Promotion Report'), ['action' => 'delete', $hotelPromotionReport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionReport->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Hotel Promotion Reports'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel Promotion Report'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hotel Promotions'), ['controller' => 'HotelPromotions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel Promotion'), ['controller' => 'HotelPromotions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="hotelPromotionReports view large-9 medium-8 columns content">
    <h3><?= h($hotelPromotionReport->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Hotel Promotion') ?></th>
            <td><?= $hotelPromotionReport->has('hotel_promotion') ? $this->Html->link($hotelPromotionReport->hotel_promotion->id, ['controller' => 'HotelPromotions', 'action' => 'view', $hotelPromotionReport->hotel_promotion->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $hotelPromotionReport->has('user') ? $this->Html->link($hotelPromotionReport->user->last_name, ['controller' => 'Users', 'action' => 'view', $hotelPromotionReport->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($hotelPromotionReport->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Report Reason Id') ?></th>
            <td><?= $this->Number->format($hotelPromotionReport->report_reason_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($hotelPromotionReport->created_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($hotelPromotionReport->comment)); ?>
    </div>
</div>
