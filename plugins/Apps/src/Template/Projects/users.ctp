<?php echo $this->assign('title', 'Task Details');?>

<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link($project->name, ['controller' => 'projects', 'action' => 'view', $project->slug], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="empty_block">
            <span class="icon">
                <i class="fa fa-bell-o" aria-hidden="true"></i>
            </span>
            <br/>
            <br/>
            <h2>Welcome to Project's Users!</h2>
            <p class="lead">Assign user to project, whom will responsible for accomplish the project. You can distribute your project's task to assigned user for better management of project</p>
            <br/>
            <a class="btn-lg-theme" ng-click="switchTaskView('create')">Assign first user</a>
        </div>
    </div>
</div>

<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>Manage User</h2>
            <span>Manage user of project <strong><?php echo $this->Html->link($project->name, ['controller' => 'projects', 'action' => 'view', $project->slug], ['class' => 'link']);?></strong></span>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">

    </div>
</div>


