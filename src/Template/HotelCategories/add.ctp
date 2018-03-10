<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Hotel Categories'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="hotelCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($hotelCategory) ?>
    <fieldset>
        <legend><?= __('Add Hotel Category') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('is_deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
