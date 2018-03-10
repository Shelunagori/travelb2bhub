<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Hotel Category'), ['action' => 'edit', $hotelCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Hotel Category'), ['action' => 'delete', $hotelCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotelCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Hotel Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel Category'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="hotelCategories view large-9 medium-8 columns content">
    <h3><?= h($hotelCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($hotelCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($hotelCategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($hotelCategory->is_deleted) ?></td>
        </tr>
    </table>
</div>
