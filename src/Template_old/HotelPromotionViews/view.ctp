<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Hotel Promotion View'), ['action' => 'edit', $hotelPromotionView->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Hotel Promotion View'), ['action' => 'delete', $hotelPromotionView->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionView->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Hotel Promotion Views'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel Promotion View'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="hotelPromotionViews view large-9 medium-8 columns content">
    <h3><?= h($hotelPromotionView->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $hotelPromotionView->has('user') ? $this->Html->link($hotelPromotionView->user->last_name, ['controller' => 'Users', 'action' => 'view', $hotelPromotionView->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($hotelPromotionView->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hotel Promotion Id') ?></th>
            <td><?= $this->Number->format($hotelPromotionView->hotel_promotion_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($hotelPromotionView->created_on) ?></td>
        </tr>
    </table>
</div>
