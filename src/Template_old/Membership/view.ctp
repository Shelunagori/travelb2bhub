<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Membership'), ['action' => 'edit', $membership->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Membership'), ['action' => 'delete', $membership->id], ['confirm' => __('Are you sure you want to delete # {0}?', $membership->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Membership'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Membership'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="membership view large-9 medium-8 columns content">
    <h3><?= h($membership->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= h($membership->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($membership->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($membership->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($membership->updated_at) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Membership Name') ?></h4>
        <?= $this->Text->autoParagraph(h($membership->membership_name)); ?>
    </div>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($membership->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Duration') ?></h4>
        <?= $this->Text->autoParagraph(h($membership->duration)); ?>
    </div>
    <div class="row">
        <h4><?= __('Status') ?></h4>
        <?= $this->Text->autoParagraph(h($membership->status)); ?>
    </div>
</div>
