<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Hotel Promotion Like'), ['action' => 'edit', $hotelPromotionLike->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Hotel Promotion Like'), ['action' => 'delete', $hotelPromotionLike->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionLike->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Hotel Promotion Likes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel Promotion Like'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="hotelPromotionLikes view large-9 medium-8 columns content">
    <h3><?= h($hotelPromotionLike->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $hotelPromotionLike->has('user') ? $this->Html->link($hotelPromotionLike->user->last_name, ['controller' => 'Users', 'action' => 'view', $hotelPromotionLike->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($hotelPromotionLike->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hotel Promotion Id') ?></th>
            <td><?= $this->Number->format($hotelPromotionLike->hotel_promotion_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($hotelPromotionLike->created_on) ?></td>
        </tr>
    </table>
</div>
