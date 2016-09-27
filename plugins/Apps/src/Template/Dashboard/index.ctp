<?php echo $this->assign('title', 'My Dashboard'); ?>

<div class="page-header">
    <h2 class="title pull-left">
        Dashboard
        <p class="sub-title"></p>
    </h2>
    <div class="pull-right btn-areas">

    </div>
    <div class="clearfix"></div>
</div>

<!-- content overview -->
<div class="row">
    <div class="col-lg-3">
        <!-- Single block -->
        <div class="overview-block">
            <div class="overview-left pull-left">
                <div class="overview-icon">
                    <i class="fa fa-pie-chart"></i>
                </div>
            </div>
            <div class="overview-right pull-left">
                <h4 class="overview-value">$156060</h4>
                <span class="overview-title">Total Revenue</span>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-lg-3">
        <!-- Single block -->
        <div class="overview-block">
            <div class="overview-left pull-left">
                <div class="overview-icon">
                    <i class="fa fa-bar-chart"></i>
                </div>
            </div>
            <div class="overview-right pull-left">
                <h4 class="overview-value">$156050</h4>
                <span class="overview-title">Total Expense</span>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-lg-3">
        <!-- Single block -->
        <div class="overview-block">
            <div class="overview-left pull-left">
                <div class="overview-icon">
                    <i class="fa fa-bullhorn"></i>
                </div>
            </div>
            <div class="overview-right pull-left">
                <h4 class="overview-value">$1256</h4>
                <span class="overview-title">Total Interest</span>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-lg-3">
        <!-- Single block -->
        <div class="overview-block">
            <div class="overview-left pull-left">
                <div class="overview-icon">
                    <i class="fa fa-briefcase"></i>
                </div>
            </div>
            <div class="overview-right pull-left">
                <h4 class="overview-value">$96652</h4>
                <span class="overview-title">Total Balance</span>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<?php if ($overview['total_user'] < 2): ?>
    <div class="alert alert-warning alert-dismissible fade in text-left static_message" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Create First User:</strong> You didn't create any user yet!.
        Please <?php echo $this->Html->link('click here', ['controller' => 'users', 'action' => 'add']); ?> to create
        your first user.
    </div>
<?php endif; ?>

<?php if ($overview['total_label'] < 1): ?>
    <div class="alert alert-warning alert-dismissible fade in text-left static_message" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Create First Label:</strong> You didn't create any label yet!.
        Please <?php echo $this->Html->link('click here', ['controller' => 'labels', 'action' => 'index']); ?> to create
        your first label
    </div>
<?php endif; ?>

<?php if ($overview['total_open_task'] + $overview['total_closed_task'] < 1): ?>
    <div class="alert alert-warning alert-dismissible fade in text-left static_message" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Create First Task:</strong> You didn't create any task yet!.
        Please <?php echo $this->Html->link('click here', ['controller' => 'tasks', 'action' => 'index']); ?> to create
        your first task
    </div>
<?php endif; ?>

<div ng-controller="TasksCtrl">
    <div class="ui-kit-19">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 cod-pad">
                <!-- Item -->
                <div class="ui-item bg-teal">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h2>{{overview.total_user}}</h2>
                            <h4 class="color-teal-50">
                                <i class="fa fa-user"></i>
                                Total Users
                            </h4>
                        </div>
                        <div class="pull-right">
                            <i class="fa fa-users color-teal-100"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 cod-pad">
                <!-- Item -->
                <div class="ui-item bg-red">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h2>{{overview.total_label}}</h2>
                            <h4 class="color-red-50">
                                <i class="fa fa-tag"></i>
                                Total Label
                            </h4>
                        </div>
                        <div class="pull-right">
                            <i class="fa fa-tags color-red-100"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 cod-pad">
                <!-- Item -->
                <div class="ui-item bg-blue">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h2>{{overview.total_open_task}}</h2>
                            <h4 class="color-blue-50 ">
                                <i class="fa fa-bell-o"></i>
                                Total Open Task
                            </h4>
                        </div>
                        <div class="pull-right">
                            <i class="fa fa-bell-o color-blue-100"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 cod-pad">
                <!-- Item -->
                <div class="ui-item bg-blue-grey">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h2>{{overview.total_closed_task}}</h2>
                            <h4 class="color-blue-grey-50">
                                <i class="fa fa-bell-slash-o"></i>
                                Total Closed Task
                            </h4>
                        </div>
                        <div class="pull-right">
                            <i class="fa fa-bell-slash-o color-blue-grey-100 "></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-7">
                    <div class="widget-body">
                        <form ng-submit="saveTask()">
                            <div class="row">
                                <div class="col-lg-9 col-md-9">
                                    <div class="">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <div class="input text">
                                                <input type="text" ng-model="TaskObj.task" class="form-control" placeholder="Title">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>

                                            <div class="input text">
                                                <text-angular ng-model="TaskObj.description" ta-toolbar="[['h1','h2','h3'],['p', 'bold'], ['ol', 'ul']]" ng-model="htmlVariable"></text-angular>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Attachments</label>

                                            <div class="input text" ng-repeat="key in countAttachments">
                                                <input type="file" class="form-control attachment_field" ngf-select ng-model="TaskObj.file[key]" name="task_attachments" ngf-max-size="20MB"/>
                                            </div>
                                            <a class="btn-theme-xs-rev" ng-click="addMoreAttachment()">Add More Attachment</a>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-success">SAVE</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="task_sidebar" style="margin-top: 25px">

                                        <!-- label block -->
                                        <div class="single_block">
                                            <div class="dropdown">
                                                <h2 id="labelList" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    Labels
                                                    <i class="fa fa-gear pull-right"></i>
                                                </h2>

                                                <div class="dropdown-menu custom-dropdown" id="labelList" aria-labelledby="label">
                                                    <h2 ng-show="!show_create_new_label_form">
                                                        Apply label
                                                        <a class="quick_task">
                                                            <img ng-show="show_label_refresh_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                                            <span class="add_new_label" ng-click="refreshLabelList()" title="Refresh Label List"><i class="fa fa-refresh grey"></i></span>
                                                            <span class="add_new_label" ng-click="show_create_new_label_form = true;" title="Create New Title"><i class="fa fa-plus"></i></span>
                                                        </a>
                                                    </h2>

                                                    <div class="label_quick_operation">
                                                        <div class="create_new_label" ng-show="show_create_new_label_form">
                                                            <!-- Create label-->
                                                            <ng-form name="create_label_form" novalidate>
                                                                <div class="form-group">
                                                                    <label>Label Name</label>

                                                                    <div class="input text">
                                                                        <input type="text" ng-model="LabelObj.name" name="label_name" class="form-control" placeholder="Name of label">
                                                                        <div ng-if="create_label_form.label_name.$dirty || isLabelFormSubmitted">
                                                                            <p ng-show="create_label_form.label_name.$error.required" class="text-danger">Label name isrequired</p>
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
                                                                    <img ng-show="show_label_create_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                                                </div>
                                                            </ng-form>
                                                            <!-- Create label end-->
                                                        </div>

                                                        <div class="search_label" ng-show="!show_create_new_label_form && taskLabels.length > 0">
                                                            <input class="form-control" ng-model="label_query" ng-change="searchLabel(label_query)"
                                                                   placeholder="Search label">
                                                            <img ng-show="show_label_search_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                    <ul class="custom_dropdown_list nav nav-list" ng-show="!show_create_new_label_form">
                                                        <li ng-repeat="(key, label) in labels">
                                                            <a ng-click="chooseTaskLabels(label, key, label.checked)"">{{label.name}}
                                                            <i ng-show="label.checked" class="fa fa-check pull-right green"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <p style="font-size: 10px; margin-top: 10px;" ng-show="labels.length < 1 && !show_create_new_label_form" class="red text-center text-uppercase" ng-show="taskLabels.length < 1">Label list empty</p>
                                                </div>
                                            </div>
                                            <small class="red" ng-show="taskLabels.length < 1">Label not set yet!</small>
                                            <div>
                                                <ul class="task_labels" ng-show="taskLabels.length > 0">
                                                    <li ng-repeat="taskLabel in taskLabels" style="background: {{taskLabel.color_code}};">{{taskLabel.name}}
                                                        <span ng-click="removeTaskLabels(taskLabel)">X</span></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- user block -->
                                        <div class="single_block">
                                            <div class="dropdown">
                                                <h2 id="usersList" data-target="#" href="http://example.com" data-toggle="dropdown" role="button"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    Users
                                                    <i class="fa fa-gear pull-right"></i>
                                                </h2>

                                                <div class="dropdown-menu custom-dropdown" id="usersList" aria-labelledby="label">
                                                    <h2>
                                                        Assign task to user
                                                        <a class="quick_task">
                                                            <img ng-show="show_user_refresh_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                                        <span class="add_new_label" ng-click="refreshUserList()" title="Refresh User List"><i
                                                                class="fa fa-refresh grey"></i></span>
                                                        </a>
                                                    </h2>

                                                    <div class="label_quick_operation">
                                                        <div class="search_label">
                                                            <input class="form-control" ng-model="user_query" ng-change="searchUser(user_query)"
                                                                   placeholder="Search user">
                                                            <img ng-show="show_user_search_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>


                                                    <ul class="custom_dropdown_list nav nav-list">
                                                        <li ng-repeat="(key, user) in users">
                                                            <a ng-click="chooseTaskUsers(user, key, user.checked)"">
                                                            <img ng-if="user.profile.profile_pic != null"
                                                                 src="{{BASE_URL}}/img/profiles/{{user.profile.profile_pic}}">
                                                            <img ng-if="!user.profile.profile_pic" src="{{BASE_URL}}/img/profile_avatar.jpg">
                                                            {{user.profile.first_name}} {{user.profile.last_name}}
                                                            <i ng-show="user.checked" class="fa fa-check pull-right green"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <p style="font-size: 10px; margin-top: 10px;" ng-show="users.length < 1"
                                                       class="red text-center text-uppercase" ng-show="taskLabels.length < 1">User not found</p>
                                                </div>
                                            </div>

                                            <small class="red" ng-show="taskUsers.length < 1">User not assigned yet!</small>
                                            <div>
                                                <ul class="task_users">
                                                    <li ng-repeat="user in taskUsers">
                                                        <img ng-if="user.profile.profile_pic != null"
                                                             src="{{BASE_URL}}/img/profiles/{{user.profile.profile_pic}}">
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
                </div>
                <div class="col-lg-5">
                    <div class="ui-kit-9">
                        <div class="col-mob">
                            <h2>Recent Opened Tasks</h2>
                            <div class="long_loader" ng-show="task_loader">
                                <div class="loader_content">
                                    <img src="{{BASE_URL}}/img/loader-blue.gif" class="md_loader">
                                    <p>Please wait. Loading reloading...</p>
                                </div>
                            </div>
                            <!-- Item -->
                            <div class="ui-item" ng-repeat="task in tasks.data">
                                <!-- Heading -->
                                <div class="ui-heading clearfix">
                                    <h5>
                                        <a ng-show="task.users.length > 0" ng-repeat="user in task.users" href="/users/details{{user.uuuid}}" class="task_user_link">{{user.profile.first_name}} {{user.profile.last_name}}</a>
                                        <label ng-show="task.users.length < 1">Not Assigned Yet!</label>
                                    </h5>
                                </div>
                                <p>
                                    <a href="{{BASE_URL}}/tasks/view/{{task.id}}">{{task.task}}</a>
                                </p>
                                <div>
                                    <a ng-repeat="label in task.labels" class="label label-sm d-label" style="color: {{label.color_code}}; border: 1px solid {{label.color_code}}">{{label.name}}</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ui-kit-21">
                <div class="ui-item">
                    <!-- Comment Center -->
                    <div class="comment-center">
                        <!-- Comment Body -->
                        <div class="comment-body">
                            <!-- User img -->
                            <div class="user-img">
                                <?php echo $this->Html->image($appsLogo, ['class' => 'profile-image']); ?>
                            </div>
                            <!-- Mail Contnet -->
                            <div class="mail-contnet">
                                <h5>Pavan kumar</h5>
                                <!-- Mail -->
                                        <span class="mail-desc">
                                            Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.
                                        </span>
                                <!-- Bottom -->
                                        <span class="bottom">
                                            <div class="pull-right date">
                                                April 14, 2016
                                            </div>
                                        </span>
                            </div>
                        </div>

                        <!-- Comment Body -->
                        <div class="comment-body">
                            <!-- User img -->
                            <div class="user-img">
                                <?php echo $this->Html->image($appsLogo, ['class' => 'profile-image']); ?>
                            </div>
                            <!-- Mail Contnet -->
                            <div class="mail-contnet">
                                <h5>Sonu Nigam</h5>
                                <!-- Mail -->
                                        <span class="mail-desc">
                                            Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.
                                        </span>
                                <!-- Bottom -->
                                        <span class="bottom">
                                            <div class="pull-right date">
                                                Approved
                                            </div>
                                        </span>
                            </div>
                        </div>

                        <!-- Comment Body -->
                        <div class="comment-body">
                            <!-- User img -->
                            <div class="user-img">
                                <?php echo $this->Html->image($appsLogo, ['class' => 'profile-image']); ?>
                            </div>
                            <!-- Mail Contnet -->
                            <div class="mail-contnet">
                                <h5>Sonu Nigam</h5>
                                <!-- Mail -->
                                        <span class="mail-desc">
                                            Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.
                                        </span>
                                <!-- Bottom -->
                                        <span class="bottom">
                                            <div class="pull-right date">
                                                Approved
                                            </div>
                                        </span>
                            </div>
                        </div>

                        <!-- Comment Body -->
                        <div class="comment-body">
                            <!-- User img -->
                            <div class="user-img">
                                <?php echo $this->Html->image($appsLogo, ['class' => 'profile-image']); ?>
                            </div>
                            <!-- Mail Contnet -->
                            <div class="mail-contnet">
                                <h5>Sonu Nigam</h5>
                                <!-- Mail -->
                                        <span class="mail-desc">
                                            Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.
                                        </span>
                                <!-- Bottom -->
                                        <span class="bottom">
                                            <div class="pull-right date">
                                                Approved
                                            </div>
                                        </span>
                            </div>
                        </div>

                        <!-- Comment Body -->
                        <div class="comment-body">
                            <!-- User img -->
                            <div class="user-img">
                                <?php echo $this->Html->image($appsLogo, ['class' => 'profile-image']); ?>
                            </div>
                            <!-- Mail Contnet -->
                            <div class="mail-contnet">
                                <h5>Arijit Sinh</h5>
                                <!-- Mail -->
                                        <span class="mail-desc">
                                            Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.
                                        </span>
                                <!-- Bottom -->
                                        <span class="bottom">
                                            <div class="pull-right date">
                                                April 14, 2016
                                            </div>
                                        </span>
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
echo $this->Html->script(['src/TasksCtrl']);
echo $this->end();
?>
