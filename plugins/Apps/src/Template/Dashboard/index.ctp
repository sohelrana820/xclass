<?php echo $this->assign('title', 'My Dashboard'); ?>

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


<div class="row">
    <?php if($projects):?>
        <?php  foreach ($projects as $project):?>
        <div class="col-lg-3 col-sm-6">
            <div class="project_overview_widget">
                <h3><?php echo $this->Html->link($project->name, ['controller' => 'projects', 'action' => 'view', $project->slug]);?></h3>
                <p><?php echo $this->Text->truncate($project->description, 150);?></p>
                <div class="overview_bottom">
                    <small><i class="fa fa-calendar"></i> Started at <?php echo $this->Time->format($project->created, 'd MMM, Y');?></small>
                    <ul class="overview_list">
                        <li><strong>User Assigned:</strong>
                            <?php
                            if($project->overview['total_user'] > 0){
                                echo '<span class="bg-black">'.$project->overview['total_user'].'</span>';
                            }
                            else{
                                echo $this->Html->link('Assign User', ['controller' => 'projects', 'action' => 'users', $project->slug]);
                            }
                            ?>
                        </li>
                        <li><strong>Total Labels:</strong>
                            <?php
                            if($project->overview['total_label'] > 0){
                                echo '<span class="bg-orange">'.$project->overview['total_label'].'</span>';
                            }
                            else{
                                echo $this->Html->link('Create Label', ['controller' => 'labels', 'action' => 'index', $project->slug]);
                            }
                            ?>
                        </li>
                        <li><strong>Total Tasks:</strong>
                            <?php
                            if($project->overview['total_task'] > 0){
                                echo '<span class="bg-green">'.$project->overview['total_task'].'</span>';
                            }
                            else{
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
    <?php endif;?>
</div>

<?php
echo $this->start('jsBottom');
echo $this->end();
?>
