<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Manage Documents', ['controller' => 'documents', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<div class="documents view large-9 medium-8 columns content">
    <h3><?php echo h($document->title) ?></h3>
    <table class="table vertical-table">
        <tr>
            <th scope="row"><?php echo __('Course') ?></th>
            <td><?php echo $document->course->name; ?></td>
        </tr>
        <tr>
            <th scope="row"><?php echo __('Title') ?></th>
            <td><?php echo h($document->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?php echo __('Description') ?></th>
            <td><?php echo $this->Text->autoParagraph(h($document->description)); ?></td>
        </tr>
        <tr>
            <th scope="row"><?php echo __('Image') ?></th>
            <td><?php echo h($document->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?php echo __('Status') ?></th>
            <td><?php echo $this->Number->format($document->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?php echo __('Created') ?></th>
            <td><?php echo h($document->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?php echo __('Modified') ?></th>
            <td><?php echo h($document->modified) ?></td>
        </tr>
    </table>

    <div class="related">
        <h4><?php echo __('Related Download') ?></h4>
        <?php if (!empty($document->downloads)): ?>
        <table class="table theme-table">
            <tr>
                <th scope="col"><?php echo __('Id') ?></th>
                <th scope="col"><?php echo __('Document Id') ?></th>
                <th scope="col"><?php echo __('User Id') ?></th>
                <th scope="col"><?php echo __('Created') ?></th>
                <th scope="col"><?php echo __('Modified') ?></th>
                <th scope="col" class="actions"><?php echo __('Actions') ?></th>
            </tr>
            <?php foreach ($document->downloads as $download): ?>
            <tr>
                <td><?php echo h($download->id) ?></td>
                <td><?php echo h($download->document_id) ?></td>
                <td><?php echo h($download->user_id); ?></td>
                <td><?php echo h($download->created) ?></td>
                <td><?php echo h($download->modified) ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), ['controller' => 'Download', 'action' => 'view', $download->id]) ?>
                    <?php echo $this->Html->link(__('Edit'), ['controller' => 'Download', 'action' => 'edit', $download->id]) ?>
                    <?php echo $this->Form->postLink(__('Delete'), ['controller' => 'Download', 'action' => 'delete', $download->id], ['confirm' => __('Are you sure you want to delete # {0}?', $download->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
