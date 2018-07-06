<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Api Version'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="apiVersions index large-9 medium-8 columns content">
    <h3><?= __('Api Versions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('versions') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($apiVersions as $apiVersion): ?>
            <tr>
                <td><?= $this->Number->format($apiVersion->id) ?></td>
                <td><?= $this->Number->format($apiVersion->versions) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $apiVersion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $apiVersion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $apiVersion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $apiVersion->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
