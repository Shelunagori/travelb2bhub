<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Post Travle Package Category'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Post Travle Package Rows'), ['controller' => 'PostTravlePackageRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post Travle Package Row'), ['controller' => 'PostTravlePackageRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="postTravlePackageCategories index large-9 medium-8 columns content">
    <h3><?= __('Post Travle Package Categories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($postTravlePackageCategories as $postTravlePackageCategory): ?>
            <tr>
                <td><?= $this->Number->format($postTravlePackageCategory->id) ?></td>
                <td><?= h($postTravlePackageCategory->name) ?></td>
                <td><?= $this->Number->format($postTravlePackageCategory->is_deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $postTravlePackageCategory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $postTravlePackageCategory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $postTravlePackageCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postTravlePackageCategory->id)]) ?>
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
