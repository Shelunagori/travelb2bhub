<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Hotel Promotion Like'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="hotelPromotionLikes index large-9 medium-8 columns content">
    <h3><?= __('Hotel Promotion Likes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hotel_promotion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hotelPromotionLikes as $hotelPromotionLike): ?>
            <tr>
                <td><?= $this->Number->format($hotelPromotionLike->id) ?></td>
                <td><?= $this->Number->format($hotelPromotionLike->hotel_promotion_id) ?></td>
                <td><?= $hotelPromotionLike->has('user') ? $this->Html->link($hotelPromotionLike->user->last_name, ['controller' => 'Users', 'action' => 'view', $hotelPromotionLike->user->id]) : '' ?></td>
                <td><?= h($hotelPromotionLike->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $hotelPromotionLike->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $hotelPromotionLike->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $hotelPromotionLike->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionLike->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
