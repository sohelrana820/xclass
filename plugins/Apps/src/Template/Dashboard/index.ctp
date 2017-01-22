<?php echo $this->assign('title', 'My Dashboard'); ?>

<?php if($projects):?>
<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Dashboard', ['controller' => 'dashboard', 'action' => 'index'], ['class' => 'link']);?>
        <p class="sub-title">Most recent active projects</p>
    </h2>
    <div class="pull-right btn-areas">
        <?php echo $this->Html->link('Project List', ['controller' => 'projects', 'action' => 'index'], ['class' => 'btn btn-success']);?>
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
            <h2>Welcome to <?php echo $appsName;?>!</h2>
            <p class="lead">Create your project to get started. This application is for assign user to project, manage project's task, manage project's labels. Fell comfort to manage your project</p>
            <br/>
            <?php echo $this->Html->link('Get Started', ['controller' => 'projects', 'action', 'create'], ['class' => 'btn-lg-theme']);?>
        </div>
    </div>
</div>
<?php else:?>
<div class="row">
    <div class="col-lg-3 col-sm-6">
        <a href="<?php echo $baseUrl;?>projects/create">
            <div class="blank_project_overview_widget">
                <div class="blank_project_overview_widget_inner">
                    <span class="icon fa fa-plus"></span>
                    <br/>
                    <p class="new">Create New Project</p>
                </div>
            </div>
        </a>
    </div>

    <?php foreach ($projects as $project):?>
        <div class="col-lg-3 col-sm-6">
            <div class="project_overview_widget">
                <h3><?php echo $this->Html->link($project->name, ['controller' => 'projects', 'action' => 'view', $project->slug]);?></h3>
                <p><?php echo $this->Text->truncate($project->description, 150);?></p>
                <div class="overview_bottom">
                    <small><i class="fa fa-calendar"></i> Started at <?php echo $this->Time->format($project->created, 'd MMM, Y');?></small>
                    <ul class="overview_list">
                        <li><strong>User Assigned:</strong>
                            <?php
                            echo '<span class="bg-black">'.$project->overview['total_user'].'</span>';
                            if($project->overview['total_user'] < 1){
                                echo $this->Html->link('Assign User', ['controller' => 'projects', 'action' => 'users', $project->slug]);
                            }
                            ?>
                        </li>
                        <li><strong>Total Labels:</strong>
                            <?php
                            echo '<span class="bg-orange">'.$project->overview['total_label'].'</span>';
                            if($project->overview['total_label'] < 1){
                                echo $this->Html->link('Create Label', ['controller' => 'labels', 'action' => 'index', $project->slug]);
                            }
                            ?>
                        </li>
                        <li><strong>Total Tasks:</strong>
                            <?php
                            echo '<span class="bg-green">'.$project->overview['total_task'].'</span>';
                            if($project->overview['total_task'] < 1){
                                echo $this->Html->link('Create Task', ['controller' => 'tasks', 'action' => 'index', $project->slug]);
                            }
                            ?>
                        </li>
                    </ul>
                    <?php echo $this->Html->link('Manage Project', ['controller' => 'projects', 'action' => 'view', $project->slug], ['class' => 'btn btn-success btn-block']);?>
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
