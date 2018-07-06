<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Post Travle Package Report'), ['action' => 'edit', $postTravlePackageReport->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Post Travle Package Report'), ['action' => 'delete', $postTravlePackageReport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postTravlePackageReport->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Post Travle Package Reports'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post Travle Package Report'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Post Travle Packages'), ['controller' => 'PostTravlePackages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post Travle Package'), ['controller' => 'PostTravlePackages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Report Reasons'), ['controller' => 'ReportReasons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Report Reason'), ['controller' => 'ReportReasons', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="postTravlePackageReports view large-9 medium-8 columns content">
    <h3><?= h($postTravlePackageReport->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Post Travle Package') ?></th>
            <td><?= $postTravlePackageReport->has('post_travle_package') ? $this->Html->link($postTravlePackageReport->post_travle_package->title, ['controller' => 'PostTravlePackages', 'action' => 'view', $postTravlePackageReport->post_travle_package->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $postTravlePackageReport->has('user') ? $this->Html->link($postTravlePackageReport->user->last_name, ['controller' => 'Users', 'action' => 'view', $postTravlePackageReport->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Report Reason') ?></th>
            <td><?= $postTravlePackageReport->has('report_reason') ? $this->Html->link($postTravlePackageReport->report_reason->id, ['controller' => 'ReportReasons', 'action' => 'view', $postTravlePackageReport->report_reason->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($postTravlePackageReport->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($postTravlePackageReport->created_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($postTravlePackageReport->comment)); ?>
    </div>
</div>
