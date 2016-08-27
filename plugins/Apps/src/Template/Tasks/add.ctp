<?php echo $this->assign('title', 'Manage Task');?>

<div class="page-header">
    <h2 class="title pull-left">
        New Task
    </h2>
    <div class="pull-right btn-areas">
        <?php echo $this->Html->link('Tasks List', ['controller' => 'tasks', 'action' => 'index'], ['class' => 'btn btn-info'])?>
    </div>
    <div class="clearfix"></div>
</div>

<div ng-controller="TasksCtrl">
    <form ng-submit="saveTask()">
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <div class="well">
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
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Attachments</label>
                            <div class="input text" ng-repeat="key in countAttachments">
                                <input type="file" class="form-control attachment_field"
                                       ngf-select ng-model="TaskObj.file[key]"
                                       name="task_attachments"
                                       ngf-max-size="20MB"
                                    />
                            </div>
                            <a class="btn-theme-xs-rev" ng-click="addMoreAttachment()">Add More Attachment</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success">SAVE</button>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4">
            <div class="task_sidebar" style="margin-top: 25px">
                <div class="single_block">
                    <div class="dropdown">
                        <h2 id="labelList" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Labels
                            <i class="fa fa-gear pull-right"></i>
                        </h2>

                        <div class="dropdown-menu custom-dropdown" id="labelList" aria-labelledby="label">
                            <h2>
                                Apply label
                                <a class="quick_task">
                                    <img ng-show="show_label_refresh_loader" src="{{BASE_URL}}/img/loader-sm.gif" class="sm_loader">
                                    <span class="add_new_label" ng-click="refreshLabelList()" title="Refresh Label List"><i class="fa fa-refresh grey"></i></span>
                                    <span class="add_new_label" ng-click="show_create_new_label_form = true;" title="Create New Title"><i class="fa fa-plus"></i></span>
                                </a>
                            </h2>
                            <div class="label_quick_operation">

                                <div class="create_new_label" ng-show="show_create_new_label_form">
                                    <ng-form name="create_label_form"  novalidate>

                                        <div class="form-group">
                                            <label>Label Name</label>
                                            <div class="input text">
                                                <input type="text" ng-model="LabelObj.name" name="label_name" class="form-control" placeholder="Name of label" required="required">
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
                                            <a class="btn btn-success" ng-click="saveLabel(create_label_form.$valid)">Save</a>
                                            <a class="btn btn-danger" ng-show="!show_label_create_loader" ng-click="show_create_new_label_form = false">Cancel</a>
                                            <img ng-show="show_label_create_loader" src="{{BASE_URL}}/img/loader-sm.gif" class="sm_loader">
                                        </div>
                                    </form>
                                </div>

                                <div class="search_label" ng-show="!show_create_new_label_form">
                                    <input class="form-control" ng-model="label_query" ng-change="searchLabel(label_query)" placeholder="Search label">
                                    <img ng-show="show_label_search_loader" src="{{BASE_URL}}/img/loader-sm.gif" class="sm_loader">
                                </div>
                                <div class="clearfix"></div>

                            </div>

                            <ul class="custom_dropdown_list nav nav-list" ng-show="!show_create_new_label_form">
                                <li ng-repeat="(key, label) in labels">
                                    <a ng-click="chooseTaskLabels(label, key, label.checked)"">{{label.name}} <i ng-show="label.checked" class="fa fa-check pull-right green"></i></a>
                                </li>
                            </ul>
                            <p style="font-size: 9px; margin-top: 10px;" ng-show="labels.length < 1 && !show_create_new_label_form"class="red text-center text-uppercase" ng-show="taskLabels.length < 1">Label not found</p>
                        </div>
                    </div>

                    <small class="red" ng-show="taskLabels.length < 1">Label not set yet!</small>
                    <div>
                        <ul class="task_labels" ng-show="taskLabels.length > 0">
                            <li ng-repeat="taskLabel in taskLabels" style="background: {{taskLabel.color_code}};">{{taskLabel.name}} <span ng-click="removeTaskLabels(taskLabel)">X</span></li>
                        </ul>
                    </div>
                </div>

                <div class="single_block">
                    <div class="dropdown">
                        <h2 id="usersList" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Users
                            <i class="fa fa-gear pull-right"></i>
                        </h2>
                        <div class="dropdown-menu custom-dropdown" id="usersList" aria-labelledby="label">
                            <h2>Assign task to user <a class="close_dropdown">X</a></h2>
                            <ul class="custom_dropdown_list nav nav-list">
                                <li ng-repeat="(key, user) in users">
                                    <a ng-click="chooseTaskUsers(user, key, user.checked)"">
                                    <img ng-if="user.profile.profile_pic != null" src="{{BASE_URL}}/img/profiles/{{user.profile.profile_pic}}">
                                    <img ng-if="!user.profile.profile_pic" src="{{BASE_URL}}/img/profile_avatar.jpg">
                                    {{user.profile.first_name}} {{user.profile.last_name}}
                                    <i ng-show="user.checked" class="fa fa-check pull-right green"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <small class="red" ng-show="taskUsers.length < 1">User not assigned yet!</small>
                    <div>
                        <ul class="task_users">
                            <li ng-repeat="user in taskUsers">
                                <img ng-if="user.profile.profile_pic != null" src="{{BASE_URL}}/img/profiles/{{user.profile.profile_pic}}">
                                <img ng-if="!user.profile.profile_pic" src="{{BASE_URL}}/img/profile_avatar.jpg">
                                {{user.profile.first_name}} {{user.profile.last_name}}
                                <span class="pull-right red" ng-click="removeTaskUsers(user)">X</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>

<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/TasksCtrl']);
echo $this->end();
?>
