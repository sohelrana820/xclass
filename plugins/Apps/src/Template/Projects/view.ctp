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
    <div class="col-lg-9">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-lg-3">
                <div class="app-stats-item bg-orange">
                    <div class="overview-loader ng-hide" ng-show="overview_loader">
                        <img src="http://localhost/task-manager//img/loader-blue.gif" class="md_loader">
                    </div>
                    <div ng-show="!overview_loader" class="">
                        <i class="fa fa-users"></i>
                        <h3 class="app-stats-title">
                            <span class="count-to ng-binding" data-from="0" data-to="1250"><?php echo $overview['total_user']?></span>
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
                        <i class="fa fa-signal"></i>
                        <h3 class="app-stats-title">
                            <span class="count-to ng-binding" data-from="0" data-to="5411"><?php echo $overview['total_task']?></span>
                            <small>Total Task</small>
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
                            <span class="count-to ng-binding" data-from="0" data-to="4151"><?php echo $overview['total_closed_task']?></span>
                            <small>Closed Task</small>
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
                            <span class="count-to ng-binding" data-from="0" data-to="105"><?php echo $overview['total_open_task']?></span>
                            <small>Opened Task</small>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <img src="https://react.rocks/images/converted/react-chartjs.jpg" style="width: 100%; height: 250px;">
        <br/>
        <br/>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget">
                    <div class="widget-header">
                        <h2 class="sm-title">Project Overview</h2>
                    </div>
                    <div class="widget-body">
                        <ul class="data-overview">
                            <li>
                                <strong>Project Name: </strong>
                                <?php
                                if ($project->name) {
                                    echo $this->Html->link($project->name, ['controller' => 'projects', 'action' => 'view', $project->slug], ['class' => 'text-uppercase bold']);
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
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="recent-task">
                            <?php if($project->tasks):?>
                                <div class="col-mob">
                                    <h2 class="sm-title">Recent Opened Tasks</h2>
                                    <?php if($project->tasks):?>
                                        <?php foreach ($project->tasks as $task):?>
                                            <!-- Single Task -->
                                            <div class="ui-item">
                                                <!-- Heading -->
                                                <div class="ui-heading clearfix">
                                                    <h5>
                                                        <?php if ($task->users_tasks): ?>
                                                            <strong class="assigned-to">Assigned To:</strong>
                                                            <?php foreach ($task->users_tasks as $taskUsers): ?>
                                                                <?php echo $this->Html->link($taskUsers->user->profile->first_name. ' '. $taskUsers->user->profile->last_name, [
                                                                    'controller' => 'users',
                                                                    'action' => 'view',
                                                                    $taskUsers->user->uuid
                                                                ]);?>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <strong class="no-assigned">Not Assigned Yet!</strong>
                                                        <?php endif; ?>
                                                    </h5>
                                                </div>
                                                <p>
                                                    <?php echo $this->Html->link($task->task, ['controller' => 'tasks', 'action' => 'view', $project->slug, $task->identity]);?>
                                                </p>
                                                <?php if ($task->tasks_labels): ?>
                                                    <div>
                                                        <?php foreach ($task->tasks_labels as $taskLabel):?>
                                                            <a class="label label-sm d-label" style="color: <?php echo $taskLabel->label->color_code;?>; border: 1px solid <?php echo $taskLabel->label->color_code;?>;">
                                                                <?php echo $taskLabel->label->name;?>
                                                            </a>
                                                        <?php endforeach;?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach;?>
                                    <?php else:?>
                                        <h4 class="sm-not-found">Sorry, task empty</h4>
                                    <?php endif;?>
                                    <div class="clearfix"></div>
                                </div>
                            <?php else:?>
                                <?php
                                echo $this->Html->link('Create First Task', ['controller' => 'tasks', 'action' => 'index', $project->slug], ['class' => 'btn btn-success btn-block']);
                                ?>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <?php if($project->labels):?>
                            <div class="widget">
                                <div class="widget-header">
                                    <h2>Recent Labels</h2>
                                </div>
                                <div class="widget-body">
                                    <?php if($project->labels):?>
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
                                                <?php foreach ($project->labels as $label): ?>
                                                    <tr>
                                                        <td>
                                                            <label class="app_label ng-binding" style="background: <?php echo $label->color_code;?>"><?php echo $label->name?></label>
                                                        </td>
                                                        <td>
                                                            <?php if ($label->status == 1): ?>
                                                                <span class="status-text test status-text-green">Active</span>
                                                            <?php elseif ($label->status == 2): ?>
                                                                <span class="status-text test status-text-danger">Inactive</span>
                                                            <?php else: ?>
                                                                <span class="status-text test status-text-default">N/A</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="text-right">Jan 22, 2017</td>
                                                    </tr>
                                                <?php endforeach;?>
                                                </tbody>
                                            </table>
                                            <?php
                                            if($project->labels >=  5)
                                            {
                                                echo $this->Html->link('Full List', ['controller' => 'labels', 'action' => 'index', $project->slug], ['class' => 'see_more pull-right']);
                                            }
                                            ?>
                                        </div>
                                    <?php else:?>
                                        <h4 class="sm-not-found">Sorry, label empty</h4>
                                    <?php endif;?>

                                </div>
                            </div>
                        <?php else:?>
                            <?php echo $this->Html->link('Create New Label', ['controller' => 'labels', 'action' => 'index', $project->slug], ['class' => 'btn btn-success btn-block']);?>
                        <?php endif;?>
                        <?php if($users):?>
                            <h2 class="sm-title">Recent Users</h2>
                            <div class="project_user_section">
                                <?php if($users):?>
                                    <ul class="project_user_nav_list project_assigned_user_list">
                                        <?php foreach ($users as $user):?>
                                            <li>
                                                <div>
                                                    <?php
                                                    if($user->profile->profile_pic){
                                                        echo $this->Html->image('profiles/' . $user->profile->profile_pic,
                                                            [
                                                                'class' => 'img-thumbnail',
                                                                'alt' => $user->profile->name,
                                                                'url' =>
                                                                    [
                                                                        'controller' => 'users',
                                                                        'action' => 'view',
                                                                        $user->uuid
                                                                    ]
                                                            ]);
                                                    }
                                                    else{
                                                        echo $this->Html->image('profile_avatar.jpg', ['class' => 'avatar img-thumbnail', 'alt' => $user->profile->name, 'url' => ['controller' => 'users', 'action' => 'view', $user->uuid]]);
                                                    }
                                                    ?>
                                                    <div>
                                                        <strong>
                                                            <?php echo $this->Html->link($user->profile->name, ['controller' => 'users', 'action' => 'view', $user->uuid])?>
                                                        </strong>
                                                        <br>
                                                        <small><?php echo $user->username?></small>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach;; ?>
                                    </ul>
                                    <div class="pull-right" style="margin-top: 10px">
                                        <?php echo $this->Html->link('Full List', ['controller' => 'projects', 'action' => 'users', $project->slug], ['class' => 'see_more']);?>
                                    </div>
                                <?php else:?>
                                    <h4 class="sm-not-found">Sorry, user empty</h4>
                                <?php endif;?>
                                <div class="clearfix"></div>
                            </div>
                        <?php else:?>
                            <?php echo $this->Html->link('Assign User', ['controller' => 'projects', 'action' => 'users', $project->slug], ['class' => 'btn btn-success btn-block']);?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="right-sidebar">
            <div ng-controller="FeedsCtrl">
                <div class="timeline-area">
                    <h2 class="sm-title">Project Feeds</h2>
                    <ul class="timeline">
                        <li ng-repeat="feed in feeds.data">
                            <div class="timeline-panel">
                                <p class="timeline-time">
                                    <i class="fa fa-clock-o"></i>
                                    {{feed.created | date}}
                                    <span>({{feed.created | date : 'HH:m a'}})</span>
                                </p>
                                <div class="timeline-body" ng-bind-html="trustAsHtml(feed.title)"></div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
                <div class="pagination_area text-center" ng-show="feeds.count > 0">
                    <a class="pull-left previous_page" ng-click="goPreviousPage()">
                        <span aria-hidden="true">&laquo;</span> Previous
                    </a>
                    <a>
                    <span>
                        showing {{((feeds.currentPage - 1) * feeds.limit) + 1}} -
                        {{feeds.currentPage * feeds.limit > feeds.count ? feeds.count : feeds.currentPage * feeds.limit}}
                        of {{feeds.count}} records
                    </span>
                    </a>
                    <a class="pull-right next_page" ng-click="goNextPage()">
                        Next <span aria-hidden="true">&raquo;</span>
                    </a>
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
echo $this->Html->script(['src/FeedsCtrl']);
echo $this->end();
?>

