<?php echo $this->assign('title', 'Project Lists'); ?>

<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Manage Project', ['controller' => 'projects', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<?php if($projects->isEmpty() && sizeof($searchConditions) < 1):?>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="empty_block">
            <span class="icon">
                <i class="fa fa-bell-o" aria-hidden="true"></i>
            </span>
                <br/>
                <br/>
                <h2>Welcome to <?php echo $appsName;?>!</h2>
                <?php if($userInfo->role == 1):?>
                    <p class="lead">Create your project to get started. This application is for assign user to project, manage project's task, manage project's labels. Fell comfort to manage your project</p>
                <?php else:?>
                    <p class="lead red">You are not assigned any project yet!</p>
                <?php endif;?>
                <br/>
                <?php echo $userInfo->role != 2 ? $this->Html->link('Get Started', ['controller' => 'projects', 'action' => 'create'], ['class' => 'btn-lg-theme']) : '';?>
            </div>
        </div>
    </div>
<?php else:?>
<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>Lists of Project</h2>
            <span><?php echo $projects->count() ?> result found</span>
        </div>
        <?php if($userInfo->role == 1):?>
        <div class="pull-right btn-areas">
            <?php echo $this->Html->link('New Project', ['controller' => 'projects', 'action' => 'create'], ['class' => 'btn btn-info']) ?>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#searchProjectModal">Search Project</button>
        </div>
        <?php endif;?>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <?php if (!$projects->isEmpty()): ?>
            <table class="table theme-table">
                <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('name') ?></th>
                    <th><?php echo $this->Paginator->sort('status') ?></th>
                    <th><?php echo $this->Paginator->sort('deadline') ?></th>
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
                            <?php
                            if($project->deadline){
                                echo $this->Time->format($project->deadline, 'dd MMM , Y');
                            }
                            else{
                                echo 'N/A';
                            }
                            ?>
                        </td>
                        <td class="text-right">
                            <?php echo $this->Html->link(__('<i class="fa fa-gear"></i>'), ['action' => 'view', $project->slug], ['escape' => false, 'class' => 'icons green']) ?>
                            <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i>'), ['action' => 'edit', $project->slug], ['escape' => false, 'class' => 'icons']) ?>
                            <?php echo $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['action' => 'delete', $project->slug], ['escape' => false, 'class' => 'icons red'], ['confirm' => __('Are you sure you want to delete # {0}?', $project->slug)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php echo $this->element('pagination');?>
        <?php else: ?>
            <?php echo $this->element('not_found'); ?>
        <?php endif; ?>
        <div class="clearfix"></div>
    </div>
</div>
<?php endif;?>

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

