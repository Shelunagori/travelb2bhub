<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Post Travle Package Cart'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Post Travle Packages'), ['controller' => 'PostTravlePackages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post Travle Package'), ['controller' => 'PostTravlePackages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="postTravlePackageCarts index large-9 medium-8 columns content">
    <h3><?= __('Post Travle Package Carts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('post_travle_package_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($postTravlePackageCarts as $postTravlePackageCart): ?>
            <tr>
                <td><?= $this->Number->format($postTravlePackageCart->id) ?></td>
                <td><?= $postTravlePackageCart->has('post_travle_package') ? $this->Html->link($postTravlePackageCart->post_travle_package->title, ['controller' => 'PostTravlePackages', 'action' => 'view', $postTravlePackageCart->post_travle_package->id]) : '' ?></td>
                <td><?= $postTravlePackageCart->has('user') ? $this->Html->link($postTravlePackageCart->user->last_name, ['controller' => 'Users', 'action' => 'view', $postTravlePackageCart->user->id]) : '' ?></td>
                <td><?= h($postTravlePackageCart->created_on) ?></td>
                <td><?= $this->Number->format($postTravlePackageCart->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $postTravlePackageCart->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $postTravlePackageCart->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $postTravlePackageCart->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postTravlePackageCart->id)]) ?>
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
