<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Post Travle Package'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Currencies'), ['controller' => 'Currencies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Currency'), ['controller' => 'Currencies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Price Masters'), ['controller' => 'PriceMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Price Master'), ['controller' => 'PriceMasters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Post Travle Package Cities'), ['controller' => 'PostTravlePackageCities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post Travle Package City'), ['controller' => 'PostTravlePackageCities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Post Travle Package Rows'), ['controller' => 'PostTravlePackageRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post Travle Package Row'), ['controller' => 'PostTravlePackageRows', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Post Travle Package States'), ['controller' => 'PostTravlePackageStates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post Travle Package State'), ['controller' => 'PostTravlePackageStates', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="postTravlePackages index large-9 medium-8 columns content">
    <h3><?= __('Post Travle Packages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('duration_night') ?></th>
                <th scope="col"><?= $this->Paginator->sort('duration_day') ?></th>
                <th scope="col"><?= $this->Paginator->sort('valid_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('starting_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('document') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price_master_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('like_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('visible_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edited_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edited_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($postTravlePackages as $postTravlePackage): ?>
            <tr>
                <td><?= $this->Number->format($postTravlePackage->id) ?></td>
                <td><?= h($postTravlePackage->title) ?></td>
                <td><?= $this->Number->format($postTravlePackage->duration_night) ?></td>
                <td><?= $this->Number->format($postTravlePackage->duration_day) ?></td>
                <td><?= h($postTravlePackage->valid_date) ?></td>
                <td><?= $postTravlePackage->has('currency') ? $this->Html->link($postTravlePackage->currency->name, ['controller' => 'Currencies', 'action' => 'view', $postTravlePackage->currency->id]) : '' ?></td>
                <td><?= $this->Number->format($postTravlePackage->starting_price) ?></td>
                <td><?= $postTravlePackage->has('country') ? $this->Html->link($postTravlePackage->country->country_name, ['controller' => 'Countries', 'action' => 'view', $postTravlePackage->country->id]) : '' ?></td>
                <td><?= h($postTravlePackage->image) ?></td>
                <td><?= h($postTravlePackage->document) ?></td>
                <td><?= $postTravlePackage->has('price_master') ? $this->Html->link($postTravlePackage->price_master->id, ['controller' => 'PriceMasters', 'action' => 'view', $postTravlePackage->price_master->id]) : '' ?></td>
                <td><?= $this->Number->format($postTravlePackage->like_count) ?></td>
                <td><?= h($postTravlePackage->visible_date) ?></td>
                <td><?= $postTravlePackage->has('user') ? $this->Html->link($postTravlePackage->user->last_name, ['controller' => 'Users', 'action' => 'view', $postTravlePackage->user->id]) : '' ?></td>
                <td><?= h($postTravlePackage->created_on) ?></td>
                <td><?= $this->Number->format($postTravlePackage->edited_by) ?></td>
                <td><?= h($postTravlePackage->edited_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $postTravlePackage->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $postTravlePackage->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $postTravlePackage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postTravlePackage->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
