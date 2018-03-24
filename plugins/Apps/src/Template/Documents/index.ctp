<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Manage Documents', ['controller' => 'documents', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>


<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>List of documents</h2>
            <span><span><?php echo $this->Paginator->counter('{{count}}');?> result found</span></span>
        </div>
        <div class="pull-right btn-areas">
            <?php echo $this->Html->link('New Document', ['controller' => 'documents', 'action' => 'add'], ['class' => 'btn btn-info'])?>
            <?php echo $this->Html->link('Back to List', ['controller' => 'documents', 'action' => 'index'], ['class' => 'btn btn-info'])?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <?php if(!$documents->isEmpty()):?>
            <table class="table theme-table">
            <thead>
            <tr>
                <th scope="col"><?php echo $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?php echo $this->Paginator->sort('course_id') ?></th>
                <th scope="col"><?php echo $this->Paginator->sort('title') ?></th>
                <th scope="col"><?php echo $this->Paginator->sort('image') ?></th>
                <th scope="col"><?php echo $this->Paginator->sort('name') ?></th>
                <th scope="col"><?php echo $this->Paginator->sort('path') ?></th>
                <th scope="col"><?php echo $this->Paginator->sort('status') ?></th>
                <th scope="col"><?php echo $this->Paginator->sort('created') ?></th>
                <th scope="col"><?php echo $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?php echo __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($documents as $document): ?>
                <tr>
                    <td><?php echo $this->Number->format($document->created_by) ?></td>
                    <td><?php echo $document->has('course') ? $this->Html->link($document->course->name, ['controller' => 'Courses', 'action' => 'view', $document->course->id]) : '' ?></td>
                    <td><?php echo h($document->title) ?></td>
                    <td><?php echo h($document->image) ?></td>
                    <td><?php echo h($document->name) ?></td>
                    <td><?php echo h($document->path) ?></td>
                    <td><?php echo $this->Number->format($document->status) ?></td>
                    <td><?php echo h($document->created) ?></td>
                    <td><?php echo h($document->modified) ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('<i class="fa fa-gear"></i>'), ['action' => 'view', $document->id], ['escape' => false, 'class' => 'icons green']) ?>
                        <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i>'), ['action' => 'edit', $document->id], ['escape' => false, 'class' => 'icons']) ?>
                        <?php echo $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['action' => 'delete', $document->id], ['escape' => false, 'class' => 'icons red', 'confirm' => __('Are you sure you want to delete # {0}?', $document->id)]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <?php echo $this->element('not_found'); ?>
        <?php endif; ?>
    </div>
</div>
