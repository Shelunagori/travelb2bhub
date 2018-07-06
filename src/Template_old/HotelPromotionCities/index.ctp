<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Hotel Promotion City'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="hotelPromotionCities index large-9 medium-8 columns content">
    <h3><?= __('Hotel Promotion Cities') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hotel_promotion_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('charges') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hotelPromotionCities as $hotelPromotionCity): ?>
            <tr>
                <td><?= $this->Number->format($hotelPromotionCity->id) ?></td>
                <td><?= $this->Number->format($hotelPromotionCity->hotel_promotion_id) ?></td>
                <td><?= $hotelPromotionCity->has('city') ? $this->Html->link($hotelPromotionCity->city->name, ['controller' => 'Cities', 'action' => 'view', $hotelPromotionCity->city->id]) : '' ?></td>
                <td><?= $this->Number->format($hotelPromotionCity->charges) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $hotelPromotionCity->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $hotelPromotionCity->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $hotelPromotionCity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelPromotionCity->id)]) ?>
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
