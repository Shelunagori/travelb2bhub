<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Post Travle Package Report'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Post Travle Packages'), ['controller' => 'PostTravlePackages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post Travle Package'), ['controller' => 'PostTravlePackages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Report Reasons'), ['controller' => 'ReportReasons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Report Reason'), ['controller' => 'ReportReasons', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="postTravlePackageReports index large-9 medium-8 columns content">
    <h3><?= __('Post Travle Package Reports') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('post_travle_package_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('report_reason_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($postTravlePackageReports as $postTravlePackageReport): ?>
            <tr>
                <td><?= $this->Number->format($postTravlePackageReport->id) ?></td>
                <td><?= $postTravlePackageReport->has('post_travle_package') ? $this->Html->link($postTravlePackageReport->post_travle_package->title, ['controller' => 'PostTravlePackages', 'action' => 'view', $postTravlePackageReport->post_travle_package->id]) : '' ?></td>
                <td><?= $postTravlePackageReport->has('user') ? $this->Html->link($postTravlePackageReport->user->last_name, ['controller' => 'Users', 'action' => 'view', $postTravlePackageReport->user->id]) : '' ?></td>
                <td><?= $postTravlePackageReport->has('report_reason') ? $this->Html->link($postTravlePackageReport->report_reason->id, ['controller' => 'ReportReasons', 'action' => 'view', $postTravlePackageReport->report_reason->id]) : '' ?></td>
                <td><?= h($postTravlePackageReport->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $postTravlePackageReport->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $postTravlePackageReport->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $postTravlePackageReport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postTravlePackageReport->id)]) ?>
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
