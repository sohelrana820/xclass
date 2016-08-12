<?php echo $this->assign('title', 'Manage Task');?>

<div ng-controller="TasksCtrl">
    <div class="page-header">
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

    <div>
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
                            <a ng-click="deleteLabel(label.id)" class="icons green"><i class="fa fa-gear"></i></a>
                            <a ng-click="openEditLabel(label.id)" class="icons"><i class="fa fa-pencil"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/TasksCtrl']);
echo $this->end();
?>
