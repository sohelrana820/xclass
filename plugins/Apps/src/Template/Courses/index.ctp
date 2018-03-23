<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Manage Courses', ['controller' => 'courses', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>List of course</h2>
            <span><span><?php echo $this->Paginator->counter('{{count}}');?> result found</span></span>
        </div>
        <div class="pull-right btn-areas">
            <?php echo $this->Html->link('New Course', ['controller' => 'courses', 'action' => 'add'], ['class' => 'btn btn-info'])?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <table class="table theme-table">
            <thead>
            <tr>
                <th scope="col"><?php echo $this->Paginator->sort('id', 'Course ID') ?></th>
                <th scope="col"><?php echo $this->Paginator->sort('name') ?></th>
                <th scope="col"><?php echo $this->Paginator->sort('status') ?></th>
                <th scope="col"><?php echo $this->Paginator->sort('modified', 'Last Modified') ?></th>
                <th scope="col" class="text-right"><?php echo __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td><?php echo $this->Number->format($course->id) ?></td>
                    <td><?php echo h($course->name) ?></td>
                    <td>
                        <?php if ($course->status == 1): ?>
                            <span class="status-text status-text-success">Active</span>
                        <?php elseif ($course->status == 0): ?>
                            <span class="status-text status-text-danger">Inactive</span>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                    <td><?php echo $this->Time->format($course->modified, 'MMM d, Y') ?></td>
                    <td class="text-right">
                        <?php echo $this->Html->link(__('<i class="fa fa-gear"></i>'), ['action' => 'view', $course->id], ['escape' => false, 'class' => 'icons green']) ?>
                        <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i>'), ['action' => 'edit', $course->id], ['escape' => false, 'class' => 'icons']) ?>
                        <?php echo $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['action' => 'delete', $course->id], ['escape' => false, 'class' => 'icons red'], ['confirm' => __('Are you sure you want to delete # {0}?', $course->id)]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $this->element('pagination');?>
    </div>
</div>
