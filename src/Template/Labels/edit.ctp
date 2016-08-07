<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $label->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $label->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Labels'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="labels form large-9 medium-8 columns content">
    <?= $this->Form->create($label) ?>
    <fieldset>
        <legend><?= __('Edit Label') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('color_code');
            echo $this->Form->input('created_by');
            echo $this->Form->input('status');
            echo $this->Form->input('tasks._ids', ['options' => $tasks]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
