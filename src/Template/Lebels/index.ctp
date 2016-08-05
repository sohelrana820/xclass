<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Lebel'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="lebels index large-9 medium-8 columns content">
    <h3><?= __('Lebels') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('color_code') ?></th>
                <th><?= $this->Paginator->sort('created_by') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lebels as $lebel): ?>
            <tr>
                <td><?= $this->Number->format($lebel->id) ?></td>
                <td><?= h($lebel->name) ?></td>
                <td><?= h($lebel->color_code) ?></td>
                <td><?= $this->Number->format($lebel->created_by) ?></td>
                <td><?= h($lebel->created) ?></td>
                <td><?= h($lebel->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $lebel->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lebel->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lebel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lebel->id)]) ?>
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
