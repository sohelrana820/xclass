<?php echo $this->assign('title', 'Project Lists'); ?>

<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Manage Project', ['controller' => 'projects', 'action' => 'index'], ['class' => 'link']);?>
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
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#searchProjectModal">Search Project</button>
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
                                <span class="status-text status-text-info">Progressing</span>
                            <?php elseif ($project->status == 2): ?>
                                <span class="status-text status-text-orange">Paused</span>
                            <?php elseif ($project->status == 3): ?>
                                <span class="status-text status-text-danger">Invalid</span>
                            <?php elseif ($project->status == 4): ?>
                                <span class="status-text status-text-green">Completed</span>
                            <?php else: ?>
                                <span class="status-text status-text-gray">N/A</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo $project->created->format('M d, Y'); ?>
                            (<?php echo $project->created->format('h:i A'); ?>)
                        </td>
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

<div class="modal fade modal-primary" id="searchProjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <?php
        echo $this->Form->create(null,
            [
                'type' => 'get',
                'url' =>
                    [
                        'controller' => 'projects',
                        'action' => 'index',
                    ]
            ]
        );

        ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center text-uppercase" id="myModalLabel">Search Project</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <div class="input text">
                        <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $this->request->query('name') != '' ? $this->request->query('name') : '' ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label>Task Status</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="progressing" <?php if($this->request->query('status') && $this->request->query('status') == 1) {echo 'checked';}?>>Progressing
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="paused" <?php if($this->request->query('status') && $this->request->query('status') == 0) {echo 'checked';}?>>Paused
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="invalid" <?php if($this->request->query('status') && $this->request->query('status') == 0) {echo 'checked';}?>>Invalid
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="completed" <?php if($this->request->query('status') && $this->request->query('status') == 0) {echo 'checked';}?>>Completed
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="search">
                <?php echo $this->Html->link('Reset', ['controller' => 'projects' , 'action' => 'index'], ['class' => 'btn btn-danger']);?>
            </div>
        </div>
        <?php echo $this->Form->end();?>
    </div>
</div>

