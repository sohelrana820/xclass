<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Manage Documents', ['controller' => 'documents', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

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
