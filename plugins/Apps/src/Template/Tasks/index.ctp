<?php echo $this->assign('title', 'Manage Task');?>

<div class="page-header">
    <h2 class="title pull-left">
        Manage Task
    </h2>
    <div class="pull-right btn-areas">

    </div>
    <div class="clearfix"></div>
</div>

<div ng-controller="TasksCtrl">
    <div class="row">
        <div class="col-lg-3">

        </div>
        <div class="col-lg-9">
            <table class="table label_List">
                <thead>
                <tr>
                    <th>ID</th>
                    <th style="width: 70%">Task</th>
                    <th>Assigned</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="task in tasks">
                    <td>#{{task.id}}</td>
                    <td>
                        <strong>
                            {{task.task}}
                            <label ng-repeat="label in task.labels" class="task-label" style="background: {{label.color_code}}">{{label.name}}</label>
                        </strong>
                        <p>{{task.description}}</p>
                    </td>
                    <td>
                        <span ng-repeat="user in task.users">
                            <img class="task_assigned_user_avater" ng-if="user.profile.profile_pic != null" src="/img/profiles/{{user.profile.profile_pic}}">
                            <img class="task_assigned_user_avater" ng-if="!user.profile.profile_pic" src="/img/profile_avatar.jpg">
                        </span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/TasksCtrl']);
echo $this->end();
?>
