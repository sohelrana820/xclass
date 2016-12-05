<?php echo $this->assign('title', 'Project Details'); ?>

<div class="page-header">
    <h2 class="title pull-left">
        Project Management
    </h2>
    <div class="clearfix"></div>
</div>

<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>Project Overview</h2>
            <span>Details of <?php echo $project->name;?></span>
        </div>
        <div class="pull-right btn-areas btn-margin">
            <?php
            echo $this->Html->link('Project Tasks', ['controller' => 'tasks',  $project->slug], ['class' => 'btn btn-info']);
            echo $this->Html->link('Project Label', ['controller' => 'labels', 'action' => 'index', $project->slug], ['class' => 'btn btn-info']);
            echo $this->Html->link('New Project', ['controller' => 'projects', 'action' => 'create'], ['class' => 'btn btn-info']);
            ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <ul class="data-list data-list-stripe">
            <li>
                <strong>Name of Project: </strong>
                <?php
                if($project->name){
                    echo $project->name;
                }
                else{
                    echo 'N/A';
                }
                ?>
            </li>
            <li>
                <strong>Description: </strong>
                <?php
                if($project->description){
                    echo $project->description;
                }
                else{
                    echo 'N/A';
                }
                ?>
            </li>
            <li>
                <strong>Note: </strong>
                <?php
                if($project->note){
                    echo $project->note;
                }
                else{
                    echo 'N/A';
                }
                ?>
            </li>
            <?php if(count($project['attachments']) > 0):?>
            <li>
                <strong>Attachments: </strong>
                <?php foreach ($project['attachments'] as $attachment):?>
                    <p>
                        <a href="{{BASE_URL}}tasks/download_attachment/<?php echo $attachment->uuid;?>"><i class="fa fa-paperclip"></i> <?php echo $attachment->uuid;?></a>
                    </p>
                <?php endforeach;?>
            </li>
            <?php endif;?>
        </ul>
    </div>
</div>