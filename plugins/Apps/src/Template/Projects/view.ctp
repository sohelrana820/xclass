<?php echo $this->assign('title', 'Project Details'); ?>

<div class="page-header">
    <h2 class="title pull-left">
        Project Management
    </h2>
    <div class="clearfix"></div>
</div>

<div class="col-md-12">
    <div class="tabbable-panel">
        <div class="tabbable-line">
            <ul class="nav nav-tabs ">
                <li class="active">
                    <a href="#project_overview" data-toggle="tab">Project Overview</a>
                </li>
                <li class="">
                    <a href="#project_tasks" data-toggle="tab">Tasks</a>
                </li>
                <li class="">
                    <a href="#project_labels" data-toggle="tab">Labels</a>
                </li>
                <li class="">
                    <a href="#project_users" data-toggle="tab">Assigned User</a>
                </li>
                <li class="">
                    <a href="#project_attachments" data-toggle="tab">Attachments</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="project_overview">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="app-stats-item bg-orange">
                                <div class="overview-loader ng-hide" ng-show="overview_loader">
                                    <img src="http://localhost/task-manager//img/loader-blue.gif" class="md_loader">
                                </div>
                                <div ng-show="!overview_loader" class="">
                                    <i class="fa fa-users"></i>
                                    <h3 class="app-stats-title">
                                        <span class="count-to ng-binding" data-from="0" data-to="1250">4</span>
                                        <small>Total Users</small>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="app-stats-item bg-green">
                                <div class="overview-loader ng-hide" ng-show="overview_loader">
                                    <img src="http://localhost/task-manager//img/loader-blue.gif" class="md_loader">
                                </div>
                                <div ng-show="!overview_loader" class="">
                                    <i class="fa fa-tags"></i>
                                    <h3 class="app-stats-title">
                                        <span class="count-to ng-binding" data-from="0" data-to="5411">0</span>
                                        <small>Total Label</small>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="app-stats-item bg-red">
                                <div class="overview-loader ng-hide" ng-show="overview_loader">
                                    <img src="http://localhost/task-manager//img/loader-blue.gif" class="md_loader">
                                </div>
                                <div ng-show="!overview_loader" class="">
                                    <i class="fa fa-bell-slash-o"></i>
                                    <h3 class="app-stats-title">
                                        <span class="count-to ng-binding" data-from="0" data-to="4151">0</span>
                                        <small>Total Closed Task</small>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="app-stats-item bg-blue">
                                <div class="overview-loader ng-hide" ng-show="overview_loader">
                                    <img src="http://localhost/task-manager//img/loader-blue.gif" class="md_loader">
                                </div>
                                <div ng-show="!overview_loader" class="">
                                    <i class="fa fa-bell-o"></i>
                                    <h3 class="app-stats-title">
                                        <span class="count-to ng-binding" data-from="0" data-to="105">0</span>
                                        <small>Total Opened Task</small>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="data-overview">
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
                    </ul>
                </div>
                <div class="tab-pane" id="project_tasks">
                    <h2>Project Tasks</h2>
                </div>
                <div class="tab-pane" id="project_labels">
                    <h2>Project Labels</h2>
                </div>
                <div class="tab-pane" id="project_users">
                    <h2>Project users</h2>
                </div>
                <div class="tab-pane" id="project_attachments">
                    <?php if(count($project['attachments']) > 0):?>
                        <strong>Attachments: </strong>
                        <?php foreach ($project['attachments'] as $attachment):?>
                            <p>
                                <a href="{{BASE_URL}}tasks/download_attachment/<?php echo $attachment->uuid;?>"><i class="fa fa-paperclip"></i> <?php echo $attachment->uuid;?></a>
                            </p>
                        <?php endforeach;?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>

