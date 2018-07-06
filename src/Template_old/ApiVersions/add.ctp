<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Api Versions'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="apiVersions form large-9 medium-8 columns content">
    <?= $this->Form->create($apiVersion) ?>
    <fieldset>
        <legend><?= __('Add Api Version') ?></legend>
        <?php
            echo $this->Form->input('versions');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
