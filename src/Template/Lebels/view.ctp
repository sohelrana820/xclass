<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Lebel'), ['action' => 'edit', $lebel->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Lebel'), ['action' => 'delete', $lebel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lebel->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Lebels'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lebel'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="lebels view large-9 medium-8 columns content">
    <h3><?= h($lebel->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($lebel->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Color Code') ?></th>
            <td><?= h($lebel->color_code) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($lebel->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created By') ?></th>
            <td><?= $this->Number->format($lebel->created_by) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($lebel->created) ?></tr>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($lebel->modified) ?></tr>
        </tr>
    </table>
</div>
