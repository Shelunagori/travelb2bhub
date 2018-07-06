<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Post Travle Package Category'), ['action' => 'edit', $postTravlePackageCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Post Travle Package Category'), ['action' => 'delete', $postTravlePackageCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postTravlePackageCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Post Travle Package Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post Travle Package Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Post Travle Package Rows'), ['controller' => 'PostTravlePackageRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post Travle Package Row'), ['controller' => 'PostTravlePackageRows', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="postTravlePackageCategories view large-9 medium-8 columns content">
    <h3><?= h($postTravlePackageCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($postTravlePackageCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($postTravlePackageCategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Deleted') ?></th>
            <td><?= $this->Number->format($postTravlePackageCategory->is_deleted) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Post Travle Package Rows') ?></h4>
        <?php if (!empty($postTravlePackageCategory->post_travle_package_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Post Travle Package Id') ?></th>
                <th scope="col"><?= __('Post Travle Package Category Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($postTravlePackageCategory->post_travle_package_rows as $postTravlePackageRows): ?>
            <tr>
                <td><?= h($postTravlePackageRows->id) ?></td>
                <td><?= h($postTravlePackageRows->post_travle_package_id) ?></td>
                <td><?= h($postTravlePackageRows->post_travle_package_category_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PostTravlePackageRows', 'action' => 'view', $postTravlePackageRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PostTravlePackageRows', 'action' => 'edit', $postTravlePackageRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PostTravlePackageRows', 'action' => 'delete', $postTravlePackageRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postTravlePackageRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
