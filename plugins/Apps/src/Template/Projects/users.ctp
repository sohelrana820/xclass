<?php echo $this->assign('title', 'Task Details');?>

<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link($project->name, ['controller' => 'projects', 'action' => 'view', $project->slug], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>Lists of Project</h2>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">

    </div>
</div>


