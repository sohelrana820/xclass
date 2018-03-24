<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Document'), ['action' => 'edit', $document->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Document'), ['action' => 'delete', $document->id], ['confirm' => __('Are you sure you want to delete # {0}?', $document->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Documents'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Document'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Courses'), ['controller' => 'Courses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course'), ['controller' => 'Courses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Download'), ['controller' => 'Download', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Download'), ['controller' => 'Download', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="documents view large-9 medium-8 columns content">
    <h3><?= h($document->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Uuid') ?></th>
            <td><?= h($document->uuid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Course') ?></th>
            <td><?= $document->has('course') ? $this->Html->link($document->course->name, ['controller' => 'Courses', 'action' => 'view', $document->course->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($document->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($document->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Path') ?></th>
            <td><?= h($document->path) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($document->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($document->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($document->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($document->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($document->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Desctiotion') ?></h4>
        <?= $this->Text->autoParagraph(h($document->desctiotion)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Download') ?></h4>
        <?php if (!empty($document->download)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Document Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($document->download as $download): ?>
            <tr>
                <td><?= h($download->id) ?></td>
                <td><?= h($download->document_id) ?></td>
                <td><?= h($download->user_id) ?></td>
                <td><?= h($download->created) ?></td>
                <td><?= h($download->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Download', 'action' => 'view', $download->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Download', 'action' => 'edit', $download->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Download', 'action' => 'delete', $download->id], ['confirm' => __('Are you sure you want to delete # {0}?', $download->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
