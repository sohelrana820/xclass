<?php echo $this->assign('title', 'Manage Task');?>

<div ng-controller="TasksCtrl">
    <div class="page-header" ng-show="tasks.length > 0">
        <h2 class="title pull-left">
            Manage Task
            <p class="sub-title">
                {{totalTasks}} result found
            </p>
        </h2>
        <div class="pull-right btn-areas">
            <?php echo $this->Html->link('New Task', ['controller' => 'tasks', 'action' => 'add'], ['class' => 'btn btn-info'])?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="col-lg-12 col-md-12" ng-show="tasks.length > 0">
        <div class="row">
            <div class="col-lg-3">
                <div class="widget">
                    <div class="widget-header">
                        <h2 class="title">Filter Task</h2>
                    </div>
                    <div class="widget-body">

                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <table class="table task_list_table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th style="width: 50%">Task</th>
                        <th>Assigned</th>
                        <th>Comments</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="task in tasks">
                        <td>#{{task.id}}</td>
                        <td>
                            <strong>
                                {{task.task}}
                                <label ng-repeat="label in task.labels" class="app_label" style="background: {{label.color_code}}">{{label.name}}</label>
                            </strong>
                            <br>
                            <small class="author">Opened by {{task.user.profile.first_name}} {{task.user.profile.first_name}} at {{task.created | date}}</small>
                        </td>
                        <td>
                        <span ng-repeat="user in task.users">
                            <img class="sm_avatar" ng-if="user.profile.profile_pic != null" src="/img/profiles/{{user.profile.profile_pic}}">
                            <img class="sm_avatar" ng-if="!user.profile.profile_pic" src="/img/profile_avatar.jpg">
                        </span>
                        </td>
                        <td>
                        <span>
                            <i class="fa fa-comments"></i> 2
                        </span>
                        </td>
                        <td class="text-right">
                            <a ng-click="deleteLabel(task.id)" class="icons green"><i class="fa fa-gear"></i></a>
                            <a ng-click="openEditLabel(task.id)" class="icons"><i class="fa fa-pencil"></i></a>
                            <a ng-click="deleteTask(task.id)" class="icons red"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-8 col-lg-offset-2" ng-show="tasks.length < 1">
        <div class="empty_block">
            <span class="icon">
                <i class="fa fa-bullhorn" aria-hidden="true"></i>
            </span>
            <br/>
            <br/>
            <h2>Welcome to Task!</h2>
            <p class="lead">Task are used to manage your tasks list. You can create your task list with proper labelling and then assign into user. After completing each task you can marked them as closed/reopened. It also allowed to comments on task</p>
            <a class="btn btn-success" href="/tasks/add">Create first task</a>
        </div>
    </div>
</div>

<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/TasksCtrl']);
echo $this->end();
?>
