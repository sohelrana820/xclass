<?php echo $this->assign('title', __('dashboard_page_title')); ?>

<?php if($projects):?>
<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link(__('dashboard_text'), ['controller' => 'dashboard', 'action' => 'index'], ['class' => 'link']);?>
        <p class="sub-title"><?php echo __('last_opened_project');?></p>
    </h2>
    <div class="pull-right btn-areas">
        <?php echo $this->Html->link(__('project_list_text'), ['controller' => 'projects', 'action' => 'index'], ['class' => 'btn btn-success']);?>
    </div>

    <div class="clearfix"></div>
</div>
<?php endif;?>


<?php if(!$projects):?>
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="empty_block">
            <span class="icon">
                <i class="fa fa-bell-o" aria-hidden="true"></i>
            </span>
            <br/>
            <br/>
            <h2><?php echo __('welcome_to');?> <?php echo $appsName;?>!</h2>
            <?php if($userInfo->role == 1):?>
                <p class="lead"><?php echo __('create_project_to_get_started');?></p>
            <?php else:?>
                <p class="lead red"><?php echo __('your_not_assigned_any_project');?></p>
            <?php endif;?>
            <br/>
            <?php echo $userInfo->role != 2 ? $this->Html->link(__('get_started'), ['controller' => 'projects', 'action' => 'create'], ['class' => 'btn-lg-theme']) : '';?>
        </div>
    </div>
</div>
<?php else:?>
<div class="row">
    <?php if($userInfo->role == 1):?>
        <div class="col-lg-3 col-sm-6">
            <a href="<?php echo $baseUrl;?>projects/create">
                <div class="blank_project_overview_widget">
                    <div class="blank_project_overview_widget_inner">
                        <span class="icon fa fa-plus"></span>
                        <br/>
                        <p class="new"><?php echo __('create_new_project');?></p>
                    </div>
                </div>
            </a>
        </div>
    <?php endif;?>
    <?php foreach ($projects as $project):?>
        <div class="col-lg-3 col-sm-6">
            <div class="project_overview_widget">
                <h3><?php echo $this->Html->link($project->name, ['controller' => 'projects', 'action' => 'view', $project->slug]);?></h3>
                <p><?php echo $this->Text->truncate($project->description, 150);?></p>
                <div class="overview_bottom">
                    <?php if ($project->status == 1): ?>
                        <span class="status-text status-text-info"><?php echo __('status_processing');?></span>
                    <?php elseif ($project->status == 2): ?>
                        <span class="status-text status-text-orange"><?php echo __('status_paused');?></span>
                    <?php elseif ($project->status == 3): ?>
                        <span class="status-text status-text-danger"><?php echo __('status_invalid');?></span>
                    <?php elseif ($project->status == 4): ?>
                        <span class="status-text status-text-green"><?php echo __('status_completed');?></span>
                    <?php else: ?>
                        <span class="status-text status-text-gray"><?php echo __('status_na');?></span>
                    <?php endif; ?>
                    <br/>
                    <small>
                        <i class="fa fa-calendar"></i> <?php echo __('started_at');?> <?php echo $this->Time->format($project->created, 'd MMM, Y');?>
                    </small>
                    <ul class="overview_list">
                        <li><strong><?php echo __('user_assigned');?>:</strong>
                            <?php
                            echo '<span class="bg-black">'.$project->overview['total_user'].'</span>';
                            if($project->overview['total_user'] < 1){
                                echo $this->Html->link(__('assign_user'), ['controller' => 'projects', 'action' => 'users', $project->slug]);
                            }
                            ?>
                        </li>
                        <li><strong><?php echo __('total_labels');?>:</strong>
                            <?php
                            echo '<span class="bg-orange">'.$project->overview['total_label'].'</span>';
                            if($project->overview['total_label'] < 1){
                                echo $this->Html->link(__('create_label'), ['controller' => 'labels', 'action' => 'index', $project->slug]);
                            }
                            ?>
                        </li>
                        <li><strong><?php echo __('total_tasks');?>:</strong>
                            <?php
                            echo '<span class="bg-green">'.$project->overview['total_task'].'</span>';
                            if($project->overview['total_task'] < 1){
                                echo $this->Html->link(__('create_task'), ['controller' => 'tasks', 'action' => 'index', $project->slug]);
                            }
                            ?>
                        </li>
                    </ul>
                    <?php echo $this->Html->link(__('manage_project'), ['controller' => 'projects', 'action' => 'view', $project->slug], ['class' => 'btn btn-success btn-block']);?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php endif;?>


<?php
echo $this->start('jsBottom');
echo $this->end();
?>
