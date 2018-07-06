<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Promotion'), ['action' => 'edit', $promotion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Promotion'), ['action' => 'delete', $promotion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $promotion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Promotion'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Promotion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="promotion view large-9 medium-8 columns content">
    <h3><?= h($promotion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $promotion->has('user') ? $this->Html->link($promotion->user->id, ['controller' => 'Users', 'action' => 'view', $promotion->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($promotion->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hotel Rating') ?></th>
            <td><?= $this->Number->format($promotion->hotel_rating) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cheap Tariff') ?></th>
            <td><?= $this->Number->format($promotion->cheap_tariff) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expensive Tariff') ?></th>
            <td><?= $this->Number->format($promotion->expensive_tariff) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Charges') ?></th>
            <td><?= $this->Number->format($promotion->charges) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Duration') ?></th>
            <td><?= $this->Number->format($promotion->duration) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Count') ?></th>
            <td><?= $this->Number->format($promotion->count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expiry Date') ?></th>
            <td><?= h($promotion->expiry_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($promotion->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($promotion->updated_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Accept Date') ?></th>
            <td><?= h($promotion->accept_date) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Hotel Name') ?></h4>
        <?= $this->Text->autoParagraph(h($promotion->hotel_name)); ?>
    </div>
    <div class="row">
        <h4><?= __('Hotel Location') ?></h4>
        <?= $this->Text->autoParagraph(h($promotion->hotel_location)); ?>
    </div>
    <div class="row">
        <h4><?= __('Hotel Type') ?></h4>
        <?= $this->Text->autoParagraph(h($promotion->hotel_type)); ?>
    </div>
    <div class="row">
        <h4><?= __('Website') ?></h4>
        <?= $this->Text->autoParagraph(h($promotion->website)); ?>
    </div>
    <div class="row">
        <h4><?= __('Cities') ?></h4>
        <?= $this->Text->autoParagraph(h($promotion->cities)); ?>
    </div>
    <div class="row">
        <h4><?= __('Status') ?></h4>
        <?= $this->Text->autoParagraph(h($promotion->status)); ?>
    </div>
    <div class="row">
        <h4><?= __('Hotel Pic') ?></h4>
        <?= $this->Text->autoParagraph(h($promotion->hotel_pic)); ?>
    </div>
    <div class="row">
        <h4><?= __('Payment Status') ?></h4>
        <?= $this->Text->autoParagraph(h($promotion->payment_status)); ?>
    </div>
    <div class="row">
        <h4><?= __('Citycharge') ?></h4>
        <?= $this->Text->autoParagraph(h($promotion->citycharge)); ?>
    </div>
</div>
