<?php echo $this->assign('title', 'Manage Task');?>

<div class="page-header">
    <h2 class="title pull-left">
        Manage Task
    </h2>
    <div class="pull-right btn-areas">
        <?php echo $this->Html->link('New Task', ['controller' => 'tasks', 'action' => 'add'], ['class' => 'btn btn-info'])?>
        <?php echo $this->Html->link('Tasks List', ['controller' => 'tasks', 'action' => 'index'], ['class' => 'btn btn-info'])?>
    </div>
    <div class="clearfix"></div>
</div>

<div ng-controller="TasksCtrl">
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <div class="">

                <div class="task_details" ng-init="view_task = true" ng-show="view_task">
                    <h2>{{TaskObj.task}}</h2>
                    <div>
                        {{TaskObj.description}}
                    </div>
                </div>

                <div class="task_details" ng-show="edit_task_form">
                    <div class="well">
                        <form ng-submit="updateTask()">
                            <div class="form-group">
                                <label>Title</label>
                                <div class="input text">
                                    <input type="text" ng-model="TaskObj.task" class="form-control" placeholder="Title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <div class="input text">
                                    <text-angular ng-model="TaskObj.description" ng-model="htmlVariable"></text-angular>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">Update Task</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row" ng-repeat="comment in taskComments">
                    <div class="col-lg-11 col-lg-offset-1">
                        <div class="user_comments_avatar">
                            <img class="user-photo"  ng-if="comment.user.profile.profile_pic != null" src="/img/profiles/{{comment.user.profile.profile_pic}}">
                            <img class="user-photo"  ng-if="!comment.user.profile.profile_pic" src="/img/profile_avatar.jpg">
                        </div>
                        <div class="panel panel-default comments_panel">
                            <div class="panel-heading">
                                <strong>{{comment.user.profile.first_name}} {{comment.user.profile.last_name}}</strong>
                                <span class="text-muted">
                                    commented {{comment.created | date}} at
                                    ({{comment.created | date : 'HH:m a'}})
                                </span>
                            </div>
                            <div class="panel-body">
                                {{comment.comment}}
                            </div><!-- /panel-body -->
                        </div><!-- /panel panel-default -->
                    </div><!-- /col-sm-5 -->
                </div><!-- /col-sm-5 -->
                <div class="comment_widget well">
                    <form ng-submit="doComment()">
                        <textarea placeholder="Write your comment?" ng-model="commentsObj.comment" class="form-control" rows="7"></textarea>
                        <br/>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-success" ></i> Comment</button>
                            <a ng-show="TaskObj.status == 1 || TaskObj.status == 3" class="btn btn-default" ng-click="changeStatus(2)"></i> Close Task</a>
                            <a ng-show="TaskObj.status == 2" class="btn btn-danger" ng-click="changeStatus(3)"></i> Reopen Task</a>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div><!-- Widget Area -->
            </div>
        </div>
        <div class="col-lg-2 col-md-4">
            <a class="btn btn-success" ng-show="!edit_task_form" ng-click="edit_task_form = true; view_task = false">Edit Task</a>
            <a class="btn btn-info" ng-show="edit_task_form" ng-click="edit_task_form = false; view_task = true">Cancel Task</a>
            <a class="btn btn-danger" ng-click="deleteTask(TaskObj.id)">Delete Task</a>
            <div class="task_sidebar" style="margin-top: 25px">

                <div class="single_block">
                    <h2 class="dropdown-toggle task_operation" id="label" role="button" aria-haspopup="true" aria-expanded="false">
                        Labels
                        <i class="fa fa-gear pull-right"></i>
                    </h2>
                    <small class="red" ng-show="taskLabels.length < 1">Label not set yet!</small>
                    <div class="dropdown">
                        <div class="dropdown-menu custom-dropdown" id="label" aria-labelledby="label">
                            <h2>Apply label <a class="close_dropdown">X</a></h2>
                            <ul class="custom_dropdown_list nav nav-list">
                                <li ng-repeat="(key, label) in labels">
                                    <a ng-click="chooseTaskLabels(label, key, label.checked); quickUpdate('label_event', label.checked)"">{{label.name}} <i ng-show="label.checked" class="fa fa-check pull-right green"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <ul class="task_labels" ng-show="taskLabels.length > 0">
                            <li ng-repeat="taskLabel in taskLabels" style="background: {{taskLabel.color_code}};">{{taskLabel.name}} <span ng-click="removeTaskLabels(taskLabel); quickUpdate('label_event', false)">X</span></li>
                        </ul>
                    </div>
                </div>

                <div class="single_block">
                    <h2 class="dropdown-toggle task_operation" id="label" role="button" aria-haspopup="true" aria-expanded="false">
                        Users
                        <i class="fa fa-gear pull-right"></i>
                    </h2>
                    <small class="red" ng-show="taskUsers.length < 1">User not assigned yet!</small>
                    <div class="dropdown">
                        <div class="dropdown-menu custom-dropdown" id="label" aria-labelledby="label">
                            <h2>Assign task to user <a class="close_dropdown">X</a></h2>
                            <ul class="custom_dropdown_list nav nav-list">
                                <li ng-repeat="(key, user) in users">
                                    <a ng-click="chooseTaskUsers(user, key, user.checked); quickUpdate('user_event', user.checked)"">
                                    <img ng-if="user.profile.profile_pic != null" src="/img/profiles/{{user.profile.profile_pic}}">
                                    <img ng-if="!user.profile.profile_pic" src="/img/profile_avatar.jpg">
                                    {{user.profile.first_name}} {{user.profile.last_name}} {{user.checked}}
                                    <i ng-show="user.checked" class="fa fa-check pull-right green"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <ul class="task_users">
                            <li ng-repeat="user in taskUsers">
                                <img ng-if="user.profile.profile_pic != null" src="/img/profiles/{{user.profile.profile_pic}}">
                                <img ng-if="!user.profile.profile_pic" src="/img/profile_avatar.jpg">
                                {{user.profile.first_name}} {{user.profile.last_name}}
                                <span class="pull-right red" ng-click="removeTaskUsers(user); quickUpdate('user_event', false)">X</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/TasksCtrl', 'src/Comments']);
echo $this->end();
?>
