<?php echo $this->assign('title', $project->name); ?>

<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link($project->name, ['controller' => 'projects', 'action' => 'view', $project->slug], ['class' => 'link']);?>
        <p class="sub-title">Project started at <?php echo $this->Time->format($project->created, 'd MMM, Y'); ?></p>
    </h2>
    <div class="pull-right">
        <?php echo $this->Html->link('Manage Task', ['controller' => 'tasks', 'action' => 'index', $project->slug], ['class' => 'btn btn-success']);?>
        <?php echo $this->Html->link('Manage Label', ['controller' => 'labels', 'action' => 'index', $project->slug], ['class' => 'btn btn-success']);?>
        <?php echo $this->Html->link('Manage Users', ['controller' => 'projects', 'action' => 'users', $project->slug], ['class' => 'btn btn-success']);?>
        <?php echo $this->Html->link('Attachments', ['controller' => 'projects', 'action' => 'attachments', $project->slug], ['class' => 'btn btn-success']);?>
    </div>
    <div class="clearfix"></div>
</div>

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

<div class="row">
    <div class="col-lg-7">
        <div class="overview_section">
            <h2 class="sm-title">Project Overview</h2>
            <ul class="data-overview">
                <li>
                    <strong>Name of Project: </strong>
                    <?php
                    if ($project->name) {
                        echo $project->name;
                    } else {
                        echo 'N/A';
                    }
                    ?>
                </li>
                <li>
                    <strong>Description: </strong>
                    <?php
                    if ($project->description) {
                        echo $project->description;
                    } else {
                        echo 'N/A';
                    }
                    ?>
                </li>
                <li>
                    <strong>Note: </strong>
                    <?php
                    if ($project->note) {
                        echo $project->note;
                    } else {
                        echo 'N/A';
                    }
                    ?>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget">
                    <div class="widget-header">
                        <h2>Recent Labels</h2>
                    </div>
                    <div class="widget-body">
                        <div>
                            <table class="table label_List">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th class="text-right">Modified</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <label class="app_label ng-binding" style="background: #8B5F5C">New Error</label>
                                        </td>
                                        <td>
                                            <span class="status-text test status-text-green">Active</span>
                                        </td>
                                        <td class="text-right">Jan 22, 2017</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="app_label ng-binding" style="background: #8B5F5C">New Error</label>
                                        </td>
                                        <td>
                                            <span class="status-text test status-text-green">Active</span>
                                        </td>
                                        <td class="text-right">Jan 22, 2017</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="app_label ng-binding" style="background: #8B5F5C">New Error</label>
                                        </td>
                                        <td>
                                            <span class="status-text test status-text-green">Active</span>
                                        </td>
                                        <td class="text-right">Jan 22, 2017</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="app_label ng-binding" style="background: #8B5F5C">New Error</label>
                                        </td>
                                        <td>
                                            <span class="status-text test status-text-green">Active</span>
                                        </td>
                                        <td class="text-right">Jan 22, 2017</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="app_label ng-binding" style="background: #8B5F5C">New Error</label>
                                        </td>
                                        <td>
                                            <span class="status-text test status-text-green">Active</span>
                                        </td>
                                        <td class="text-right">Jan 22, 2017</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a class="see_more pull-right">See More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <h2 class="sm-title">Recent Users</h2>
                <div class="project_user_section">
                    <ul class="project_user_nav_list project_assigned_user_list">
                        <li>
                            <div>
                                <img src="http://localhost/task-manager/img/profiles/aeb3c521-c0d1-448e-a88a-4a13233c01a5/Concurrency-Issues-With-PHP-Session.jpg" class="img-responsive">
                                <div>
                                    <strong><a >Sohel Rana</a></strong>
                                    <br>
                                    <small>me.sohelrana@gmail.com</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div>
                                <img src="http://localhost/task-manager/img/profiles/aeb3c521-c0d1-448e-a88a-4a13233c01a5/Concurrency-Issues-With-PHP-Session.jpg" class="img-responsive">
                                <div>
                                    <strong><a >Sohel Rana</a></strong>
                                    <br>
                                    <small>me.sohelrana@gmail.com</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div>
                                <img src="http://localhost/task-manager/img/profiles/aeb3c521-c0d1-448e-a88a-4a13233c01a5/Concurrency-Issues-With-PHP-Session.jpg" class="img-responsive">
                                <div>
                                    <strong><a >Sohel Rana</a></strong>
                                    <br>
                                    <small>me.sohelrana@gmail.com</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div>
                                <img src="http://localhost/task-manager/img/profiles/aeb3c521-c0d1-448e-a88a-4a13233c01a5/Concurrency-Issues-With-PHP-Session.jpg" class="img-responsive">
                                <div>
                                    <strong><a >Sohel Rana</a></strong>
                                    <br>
                                    <small>me.sohelrana@gmail.com</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div>
                                <img src="http://localhost/task-manager/img/profiles/aeb3c521-c0d1-448e-a88a-4a13233c01a5/Concurrency-Issues-With-PHP-Session.jpg" class="img-responsive">
                                <div>
                                    <strong><a >Sohel Rana</a></strong>
                                    <br>
                                    <small>me.sohelrana@gmail.com</small>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <a class="see_more pull-right" style="margin-top: 10px">See More</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="ui-kit-9">
            <div class="col-mob">
                <h2 class="sm-title">Recent Opened Tasks</h2>
                <!-- Item -->
                <div class="ui-item">
                    <!-- Heading -->
                    <div class="ui-heading clearfix">
                        <h5>
                            <a class="task_user_link">Sohel RAna</a>
                            <label>Not Assigned Yet!</label>
                        </h5>
                    </div>
                    <p>
                        Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus magna justo, lacinia eget consectetur sed, co
                    </p>
                    <div>
                        <a class="label label-sm d-label" style="color: red; border: 1px solid red;">New</a>
                        <a class="label label-sm d-label" style="color: green; border: 1px solid green;">Hello Bangladesh</a>
                    </div>
                </div>
                <div class="ui-item">
                    <!-- Heading -->
                    <div class="ui-heading clearfix">
                        <h5>
                            <a class="task_user_link">Sohel RAna</a>
                            <label>Not Assigned Yet!</label>
                        </h5>
                    </div>
                    <p>
                        Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus magna justo, lacinia eget consectetur sed, co
                    </p>
                    <div>
                        <a class="label label-sm d-label" style="color: red; border: 1px solid red;">New</a>
                        <a class="label label-sm d-label" style="color: green; border: 1px solid green;">Hello Bangladesh</a>
                    </div>
                </div>
                <div class="ui-item">
                    <!-- Heading -->
                    <div class="ui-heading clearfix">
                        <h5>
                            <a class="task_user_link">Sohel RAna</a>
                            <label>Not Assigned Yet!</label>
                        </h5>
                    </div>
                    <p>
                        Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus magna justo, lacinia eget consectetur sed, co
                    </p>
                    <div>
                        <a class="label label-sm d-label" style="color: red; border: 1px solid red;">New</a>
                        <a class="label label-sm d-label" style="color: green; border: 1px solid green;">Hello Bangladesh</a>
                    </div>
                </div>
                <div class="ui-item">
                    <!-- Heading -->
                    <div class="ui-heading clearfix">
                        <h5>
                            <a class="task_user_link">Sohel RAna</a>
                            <label>Not Assigned Yet!</label>
                        </h5>
                    </div>
                    <p>
                        Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus magna justo, lacinia eget consectetur sed, co
                    </p>
                    <div>
                        <a class="label label-sm d-label" style="color: red; border: 1px solid red;">New</a>
                        <a class="label label-sm d-label" style="color: green; border: 1px solid green;">Hello Bangladesh</a>
                    </div>
                </div>
                <div class="ui-item">
                    <!-- Heading -->
                    <div class="ui-heading clearfix">
                        <h5>
                            <a class="task_user_link">Sohel RAna</a>
                            <label>Not Assigned Yet!</label>
                        </h5>
                    </div>
                    <p>
                        Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus magna justo, lacinia eget consectetur sed, co
                    </p>
                    <div>
                        <a class="label label-sm d-label" style="color: red; border: 1px solid red;">New</a>
                        <a class="label label-sm d-label" style="color: green; border: 1px solid green;">Hello Bangladesh</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/LabelsCtrl']);
echo $this->Html->script(['src/TasksCtrl']);
echo $this->Html->script(['src/Comments']);
echo $this->end();
?>

