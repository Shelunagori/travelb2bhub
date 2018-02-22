<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Post Travle Package'), ['action' => 'edit', $postTravlePackage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Post Travle Package'), ['action' => 'delete', $postTravlePackage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postTravlePackage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Post Travle Packages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post Travle Package'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Currencies'), ['controller' => 'Currencies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Currency'), ['controller' => 'Currencies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Price Masters'), ['controller' => 'PriceMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Price Master'), ['controller' => 'PriceMasters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Post Travle Package Cities'), ['controller' => 'PostTravlePackageCities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post Travle Package City'), ['controller' => 'PostTravlePackageCities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Post Travle Package Rows'), ['controller' => 'PostTravlePackageRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post Travle Package Row'), ['controller' => 'PostTravlePackageRows', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Post Travle Package States'), ['controller' => 'PostTravlePackageStates', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post Travle Package State'), ['controller' => 'PostTravlePackageStates', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="postTravlePackages view large-9 medium-8 columns content">
    <h3><?= h($postTravlePackage->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($postTravlePackage->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= $postTravlePackage->has('currency') ? $this->Html->link($postTravlePackage->currency->name, ['controller' => 'Currencies', 'action' => 'view', $postTravlePackage->currency->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= $postTravlePackage->has('country') ? $this->Html->link($postTravlePackage->country->country_name, ['controller' => 'Countries', 'action' => 'view', $postTravlePackage->country->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($postTravlePackage->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Document') ?></th>
            <td><?= h($postTravlePackage->document) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Master') ?></th>
            <td><?= $postTravlePackage->has('price_master') ? $this->Html->link($postTravlePackage->price_master->id, ['controller' => 'PriceMasters', 'action' => 'view', $postTravlePackage->price_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $postTravlePackage->has('user') ? $this->Html->link($postTravlePackage->user->last_name, ['controller' => 'Users', 'action' => 'view', $postTravlePackage->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($postTravlePackage->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Duration Night') ?></th>
            <td><?= $this->Number->format($postTravlePackage->duration_night) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Duration Day') ?></th>
            <td><?= $this->Number->format($postTravlePackage->duration_day) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Starting Price') ?></th>
            <td><?= $this->Number->format($postTravlePackage->starting_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Like Count') ?></th>
            <td><?= $this->Number->format($postTravlePackage->like_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($postTravlePackage->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valid Date') ?></th>
            <td><?= h($postTravlePackage->valid_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Visible Date') ?></th>
            <td><?= h($postTravlePackage->visible_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($postTravlePackage->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($postTravlePackage->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Package Detail') ?></h4>
        <?= $this->Text->autoParagraph(h($postTravlePackage->package_detail)); ?>
    </div>
    <div class="row">
        <h4><?= __('Excluded Detail') ?></h4>
        <?= $this->Text->autoParagraph(h($postTravlePackage->excluded_detail)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Post Travle Package Cities') ?></h4>
        <?php if (!empty($postTravlePackage->post_travle_package_cities)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Post Travle Package Id') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($postTravlePackage->post_travle_package_cities as $postTravlePackageCities): ?>
            <tr>
                <td><?= h($postTravlePackageCities->id) ?></td>
                <td><?= h($postTravlePackageCities->post_travle_package_id) ?></td>
                <td><?= h($postTravlePackageCities->city_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PostTravlePackageCities', 'action' => 'view', $postTravlePackageCities->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PostTravlePackageCities', 'action' => 'edit', $postTravlePackageCities->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PostTravlePackageCities', 'action' => 'delete', $postTravlePackageCities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postTravlePackageCities->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Post Travle Package Rows') ?></h4>
        <?php if (!empty($postTravlePackage->post_travle_package_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Post Travle Package Id') ?></th>
                <th scope="col"><?= __('Post Travle Package Category Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($postTravlePackage->post_travle_package_rows as $postTravlePackageRows): ?>
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
    <div class="related">
        <h4><?= __('Related Post Travle Package States') ?></h4>
        <?php if (!empty($postTravlePackage->post_travle_package_states)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Post Travle Package Id') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($postTravlePackage->post_travle_package_states as $postTravlePackageStates): ?>
            <tr>
                <td><?= h($postTravlePackageStates->id) ?></td>
                <td><?= h($postTravlePackageStates->post_travle_package_id) ?></td>
                <td><?= h($postTravlePackageStates->state_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PostTravlePackageStates', 'action' => 'view', $postTravlePackageStates->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PostTravlePackageStates', 'action' => 'edit', $postTravlePackageStates->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PostTravlePackageStates', 'action' => 'delete', $postTravlePackageStates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postTravlePackageStates->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>