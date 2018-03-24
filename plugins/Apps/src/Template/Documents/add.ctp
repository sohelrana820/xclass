<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Documents'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Courses'), ['controller' => 'Courses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Course'), ['controller' => 'Courses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Download'), ['controller' => 'Download', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Download'), ['controller' => 'Download', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="documents form large-9 medium-8 columns content">
    <?= $this->Form->create($document) ?>
    <fieldset>
        <legend><?= __('Add Document') ?></legend>
        <?php
            echo $this->Form->input('uuid');
            echo $this->Form->input('created_by');
            echo $this->Form->input('course_id', ['options' => $courses, 'empty' => true]);
            echo $this->Form->input('title');
            echo $this->Form->input('image');
            echo $this->Form->input('description');
            echo $this->Form->input('name');
            echo $this->Form->input('path');
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
