<?php echo $this->assign('title', 'Task Details');?>

<div class="page-header">
    <h2 class="title pull-left">
        Manage Task
    </h2>
    <div class="clearfix"></div>
</div>

<div class="widget" ng-controller="TasksCtrl">
    <div class="widget-header">
        <div class="pull-left">
            <h2>Task Details</h2>
            <span>Details of task ID: #{{TaskObj.id}}</span>
        </div>
        <div class="pull-right btn-areas">
            <?php echo $this->Html->link('New Task', ['controller' => 'tasks', 'action' => 'add'], ['class' => 'btn btn-info'])?>
            <?php echo $this->Html->link('Tasks List', ['controller' => 'tasks', 'action' => 'index'], ['class' => 'btn btn-info'])?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <div>
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="">

                        <span ng-show="TaskObj.status != 2" class="status-button status-success">Status: Open</span>
                        <span ng-show="TaskObj.status == 2" class="status-button status-danger">Status: Closed</span>
                        <br/>
                        <br/>
                        <div class="task_details" ng-init="view_task = true" ng-show="view_task">
                            <h2>{{TaskObj.task}}</h2>
                            <div ng-bind-html="TaskObj.description"></div>
                        </div>
                        <div class="show_attachments" ng-show="taskAttachments.length > 0">
                            <h4>Attachments</h4>
                            <p ng-repeat="attachment in taskAttachments">
                                <a href="{{BASE_URL}}tasks/download_attachment/{{attachment.uuid}}"><i class="fa fa-paperclip"></i> {{attachment.name}}</a>
                            </p>
                        </div>
                        <br/>

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
                                            <text-angular ng-model="TaskObj.description" ta-toolbar="[['h1','h2','h3', 'h4' , 'h5', 'h6'],['p', 'bold','italics', 'underline'], ['ol', 'ul'], ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', ]]" ng-model="htmlVariable"></text-angular>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success">Update Task</button>
                                        <a class="btn btn-info" ng-show="edit_task_form" ng-click="edit_task_form = false; view_task = true">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <h2 class="commom-title" ng-show="taskComments.length > 0">Comments</h2>
                        <div class="comments" ng-repeat="comment in taskComments">
                            <div class="media"> <div class="media-left">
                                    <a href="#">
                                        <img class="user-photo"  ng-if="comment.user.profile.profile_pic != null" src="{{BASE_URL}}/img/profiles/{{comment.user.profile.profile_pic}}">
                                        <img class="user-photo"  ng-if="!comment.user.profile.profile_pic" src="{{BASE_URL}}/img/profile_avatar.jpg">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <strong>
                                            <a href="{{BASE_URL}}users/view/{{comment.user.uuid}}">
                                                {{comment.user.profile.first_name}} {{comment.user.profile.last_name}}
                                            </a>
                                        </strong>
                                        <span>
                                            commented {{comment.created | date}} at
                                            ({{comment.created | date : 'HH:m a'}})
                                        </span>
                                    </h4>
                                    {{comment.comment}}
                                    <div ng-show="comment.changing_status">
                                        - Task marked as
                                        <label class="label label-default" ng-show="comment.changing_status == 'closed'">Closed</label>
                                        <label class="label label-danger" ng-show="comment.changing_status == 'reopened'">Reopened</label>
                                    </div>
                                    <div class="show_attachments" ng-show="comment.attachments.length > 0">
                                        <h4>Attachments</h4>
                                        <p ng-repeat="attachment in comment.attachments">
                                            <a href="{{BASE_URL}}tasks/download_attachment/{{attachment.uuid}}"><i class="fa fa-paperclip"></i> {{attachment.name}}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="comment_widget">
                            <form ng-submit="doComment()">
                                <textarea placeholder="Write your comment?" ng-model="commentsObj.comment" class="form-control" rows="7" style="resize: none;"></textarea>
                                <br/>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Attachments</label>
                                            <div class="input text" ng-repeat="key in countAttachments">
                                                <input type="file" class="form-control attachment_field"
                                                       ngf-select ng-model="commentsObj.file[key]"
                                                       name="task_attachments"
                                                       ngf-max-size="20MB"
                                                    />
                                            </div>
                                            <a class="btn-theme-xs-rev" ng-click="addMoreAttachment()">Add More Attachment</a>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="pull-left">
                                    <button type="submit" class="btn btn-success" ></i> Comment</button>
                                    <a ng-show="TaskObj.status == 1 || TaskObj.status == 3" class="btn btn-default" ng-click="changeStatus(2)"></i> Comment & Close Task</a>
                                    <a ng-show="TaskObj.status == 2" class="btn btn-danger" ng-click="changeStatus(3)"></i> Reopen Task</a>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div><!-- Widget Area -->
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <a class="btn btn-success" ng-show="!edit_task_form" ng-click="edit_task_form = true; view_task = false">Edit Task</a>
                    <a class="btn btn-danger" ng-show="!edit_task_form"  ng-click="deleteTask(TaskObj.id)">Delete Task</a>
                    <div class="task_sidebar" style="margin-top: 25px">

                        <div class="single_block">
                            <div class="dropdown">
                                <h2 id="labelList" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Set Task Label
                                    <i class="fa fa-gear pull-right"></i>
                                </h2>

                                <div class="dropdown-menu custom-dropdown" id="labelList" aria-labelledby="label">
                                    <h2 ng-show="!show_create_new_label_form">
                                        Apply label
                                        <a class="quick_task">
                                            <img ng-show="show_label_refresh_loader" src="{{BASE_URL}}/img/loader-sm.gif" class="sm_loader">
                                            <span class="add_new_label" ng-click="refreshLabelList()" title="Refresh Label List"><i class="fa fa-refresh grey"></i></span>
                                            <span class="add_new_label" ng-click="show_create_new_label_form = true;" title="Create New Title"><i class="fa fa-plus"></i></span>
                                        </a>
                                    </h2>
                                    <div class="label_quick_operation">

                                        <div class="create_new_label" ng-show="show_create_new_label_form">
                                            <form name="create_label_form"  novalidate>

                                                <div class="form-group">
                                                    <label>Label Name</label>
                                                    <div class="input text">
                                                        <input type="text" ng-model="LabelObj.name" name="label_name" class="form-control" placeholder="Name of label">
                                                        <div ng-if="create_label_form.label_name.$touched || isLabelFormSubmitted">
                                                            <p ng-show="create_label_form.label_name.$error.required"  class="text-danger">Label name is required</p>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Label Color</label>
                                                    <div class="input text">
                                                        <color-picker ng-model="LabelObj.color_code" options="color_options"></color-picker>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <a class="btn btn-success" ng-click="saveLabel(create_label_form.$valid, true)">Save</a>
                                                    <a class="btn btn-danger" ng-show="!show_label_create_loader" ng-click="show_create_new_label_form = false">Cancel</a>
                                                    <img ng-show="show_label_create_loader" src="{{BASE_URL}}/img/loader-sm.gif" class="sm_loader">
                                                </div>
                                            </form>
                                        </div>

                                        <div class="search_label" ng-show="!show_create_new_label_form && taskLabels.length > 0"">
                                        <input class="form-control" ng-model="label_query" ng-change="searchLabel(label_query)" placeholder="Search label">
                                        <img ng-show="show_label_search_loader" src="{{BASE_URL}}/img/loader-sm.gif" class="sm_loader">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <ul class="custom_dropdown_list nav nav-list" ng-show="!show_create_new_label_form">
                                    <li ng-repeat="(key, label) in labels">
                                        <a ng-click="chooseTaskLabels(label, key, label.checked); quickUpdate('label_event', label.checked)"">{{label.name}} <i ng-show="label.checked" class="fa fa-check pull-right green"></i></a>
                                    </li>
                                </ul>
                                <p style="font-size: 10px; margin-top: 10px;" ng-show="labels.length < 1 && !show_create_new_label_form"class="red text-center text-uppercase" ng-show="taskLabels.length < 1">Label list empty</p>
                            </div>
                        </div>

                        <small class="red" ng-show="taskLabels.length < 1">Label not set yet!</small>
                        <div>
                            <ul class="task_labels" ng-show="taskLabels.length > 0">
                                <li ng-repeat="taskLabel in taskLabels" style="background: {{taskLabel.color_code}};">{{taskLabel.name}} <span ng-click="removeTaskLabels(taskLabel); quickUpdate('label_event', false)">X</span></li>
                            </ul>
                        </div>
                    </div>


                    <div class="single_block">
                        <div class="dropdown">
                            <h2 id="usersList" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                Assign Task User
                                <i class="fa fa-gear pull-right"></i>
                            </h2>
                            <div class="dropdown-menu custom-dropdown" id="usersList" aria-labelledby="label">
                                <h2>
                                    Assign task to user
                                    <a class="quick_task">
                                        <img ng-show="show_user_refresh_loader" src="{{BASE_URL}}/img/loader-sm.gif" class="sm_loader">
                                        <span class="add_new_label" ng-click="refreshUserList()" title="Refresh User List"><i class="fa fa-refresh grey"></i></span>
                                    </a>
                                </h2>

                                <div class="label_quick_operation">
                                    <div class="search_label">
                                        <input class="form-control" ng-model="user_query" ng-change="searchUser(user_query)" placeholder="Search user">
                                        <img ng-show="show_user_search_loader" src="{{BASE_URL}}/img/loader-sm.gif" class="sm_loader">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <ul class="custom_dropdown_list nav nav-list">
                                    <li ng-repeat="(key, user) in users">
                                        <a ng-click="chooseTaskUsers(user, key, user.checked); quickUpdate('user_event', user.checked)"">
                                        <img ng-if="user.profile.profile_pic != null" src="{{BASE_URL}}/img/profiles/{{user.profile.profile_pic}}">
                                        <img ng-if="!user.profile.profile_pic" src="{{BASE_URL}}/img/profile_avatar.jpg">
                                        {{user.profile.first_name}} {{user.profile.last_name}} {{user.checked}}
                                        <i ng-show="user.checked" class="fa fa-check pull-right green"></i>
                                        </a>
                                    </li>
                                </ul>
                                <p style="font-size: 10px; margin-top: 10px;" ng-show="users.length < 1"class="red text-center text-uppercase" ng-show="taskLabels.length < 1">User not found</p>
                            </div>
                        </div>

                        <small class="red" ng-show="taskUsers.length < 1">User not assigned yet!</small>
                        <div>
                            <ul class="task_users">
                                <li ng-repeat="user in taskUsers">
                                    <img ng-if="user.profile.profile_pic != null" src="{{BASE_URL}}/img/profiles/{{user.profile.profile_pic}}">
                                    <img ng-if="!user.profile.profile_pic" src="{{BASE_URL}}/img/profile_avatar.jpg">
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
    </div>
</div>

<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/TasksCtrl', 'src/Comments']);
echo $this->end();
?>
