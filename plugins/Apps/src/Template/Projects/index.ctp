<?php echo $this->assign('title', 'Project Lists'); ?>

<div class="page-header">
    <h2 class="title pull-left">
        Manage Project
    </h2>
    <div class="clearfix"></div>
</div>

<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>Lists of Project</h2>
            <span><?php echo $projects->count() ?> result found</span>
        </div>
        <div class="pull-right btn-areas">
            <?php echo $this->Html->link('New Project', ['controller' => 'projects', 'action' => 'create'], ['class' => 'btn btn-info']) ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <?php if (!$projects->isEmpty()): ?>
            <table class="table theme-table">
                <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('name') ?></th>
                    <th><?php echo $this->Paginator->sort('status') ?></th>
                    <th><?php echo $this->Paginator->sort('created') ?></th>
                    <th class="text-right"><?php echo __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td><?php echo $this->Html->link(h($project->name), ['controller' => 'projects', 'action' => 'view', $project->slug]); ?></td>
                        <td>
                            <?php if ($project->status == 1): ?>
                                <span class="status-text status-text-gray">Progressing</span>
                            <?php elseif ($project->status == 2): ?>
                                <span class="status-text status-text-orange">Paused</span>
                            <?php elseif ($project->status == 3): ?>
                                <span class="status-text status-text-danger">Invalid</span>
                            <?php elseif ($project->status == 4): ?>
                                <span class="status-text status-text-green">Completed</span>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td><?php echo h($project->created) ?></td>
                        <td class="text-right">
                            <?php echo $this->Html->link(__('<i class="fa fa-gear"></i>'), ['action' => 'view', $project->slug], ['escape' => false, 'class' => 'icons green']) ?>
                            <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i>'), ['action' => 'edit', $project->slug], ['escape' => false, 'class' => 'icons']) ?>
                            <?php echo $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['action' => 'delete', $project->slug], ['escape' => false, 'class' => 'icons red'], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>


            <div class="paginator pull-right">
                <ul class="pagination">
                    <?php echo $this->Paginator->prev(__('«')) ?>
                    <?php echo $this->Paginator->numbers() ?>
                    <?php echo $this->Paginator->next(__('»')) ?>
                </ul>
            </div>
        <?php else: ?>
            <?php echo $this->element('not_found'); ?>
        <?php endif; ?>
        <div class="clearfix"></div>
    </div>
</div>



