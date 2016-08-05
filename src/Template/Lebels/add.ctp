<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Lebels'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="lebels form large-9 medium-8 columns content">
    <?= $this->Form->create($lebel) ?>
    <fieldset>
        <legend><?= __('Add Lebel') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('color_code');
            echo $this->Form->input('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
