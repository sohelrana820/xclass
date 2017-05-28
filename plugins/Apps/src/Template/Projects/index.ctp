<?php echo $this->assign('title', __('project_list_page_title')); ?>

<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link(__('manage_project'), ['controller' => 'projects', 'action' => 'index'], ['class' => 'link']);?>
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
                <h2><?php echo __('welcome_to')?> <?php echo $appsName;?>!</h2>
                <?php if($userInfo->role == 1):?>
                    <p class="lead"><?php echo __('create_project_to_get_started');?></p>
                <?php else:?>
                    <p class="lead red"><?php echo __('your_not_assigned_any_project');?>!</p>
                <?php endif;?>
                <br/>
                <?php echo $userInfo->role != 2 ? $this->Html->link(__('get_started'), ['controller' => 'projects', 'action' => 'create'], ['class' => 'btn-lg-theme']) : '';?>
            </div>
        </div>
    </div>
<?php else:?>
<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2><?php echo __('lists_of_project')?></h2>
            <span><?php echo $projects->count() ?> <?php echo __('result_found');?></span>
        </div>
        <?php if($userInfo->role == 1):?>
        <div class="pull-right btn-areas">
            <?php echo $this->Html->link(__('new_project'), ['controller' => 'projects', 'action' => 'create'], ['class' => 'btn btn-info']) ?>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#searchProjectModal"><?php echo __('search_project')?></button>
        </div>
        <?php endif;?>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <?php if (!$projects->isEmpty()): ?>
            <table class="table theme-table">
                <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort(__('name')) ?></th>
                    <th><?php echo $this->Paginator->sort(__('status')) ?></th>
                    <th><?php echo $this->Paginator->sort(__('deadline')) ?></th>
                    <th class="text-right"><?php echo __(__('actions')) ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td><?php echo $this->Html->link(h($project->name), ['controller' => 'projects', 'action' => 'view', $project->slug]); ?></td>
                        <td>
                            <?php if ($project->status == 1): ?>
                                <span class="status-text status-text-info"><?php echo __('progressing')?></span>
                            <?php elseif ($project->status == 2): ?>
                                <span class="status-text status-text-orange"><?php echo __('paused')?></span>
                            <?php elseif ($project->status == 3): ?>
                                <span class="status-text status-text-danger"><?php echo __('invalid')?></span>
                            <?php elseif ($project->status == 4): ?>
                                <span class="status-text status-text-green"><?php echo __('completed')?></span>
                            <?php else: ?>
                                <span class="status-text status-text-gray"><?php echo __('n_a')?></span>
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
                <h4 class="modal-title text-center text-uppercase" id="myModalLabel"><?php echo __('search_project');?></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label><?php echo __('name')?></label>
                    <div class="input text">
                        <input type="text" name="name" class="form-control" placeholder="<?php echo __('name')?>" value="<?php echo $this->request->query('name') != '' ? $this->request->query('name') : '' ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label><?php echo __('task_status');?></label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="progressing" <?php if($this->request->query('status') && $this->request->query('status') == 1) {echo 'checked';}?>><?php echo __('progressing');?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="paused" <?php if($this->request->query('status') && $this->request->query('status') == 0) {echo 'checked';}?>><?php echo __('paused');?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="invalid" <?php if($this->request->query('status') && $this->request->query('status') == 0) {echo 'checked';}?>><?php echo __('invalid');?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="completed" <?php if($this->request->query('status') && $this->request->query('status') == 0) {echo 'checked';}?>><?php echo __('completed');?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="<?php echo __('search')?>">
                <?php echo $this->Html->link(__('reset'), ['controller' => 'projects' , 'action' => 'index'], ['class' => 'btn btn-danger']);?>
            </div>
        </div>
        <?php echo $this->Form->end();?>
    </div>
</div>

