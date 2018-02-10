<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Api Version'), ['action' => 'edit', $apiVersion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Api Version'), ['action' => 'delete', $apiVersion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $apiVersion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Api Versions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Api Version'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="apiVersions view large-9 medium-8 columns content">
    <h3><?= h($apiVersion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($apiVersion->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Versions') ?></th>
            <td><?= $this->Number->format($apiVersion->versions) ?></td>
        </tr>
    </table>
</div>
