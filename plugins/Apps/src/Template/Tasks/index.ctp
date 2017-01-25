<?php echo $this->assign('title', 'Task Lists'); ?>

<div ng-controller="TasksCtrl">
    <div class="page-header" ng-show="tasks.count_all > 0 || taskView != 'list'">
        <h2 class="title pull-left">
            <?php echo $this->Html->link($project->name, ['controller' => 'projects', 'action' => 'view', $project->slug], ['class' => 'link']);?>
            <p class="sub-title">
                {{tasks.count}} result found
            </p>
        </h2>
        <div class="pull-right btn-areas">
            <a class="btn btn-info" ng-show="taskView == 'list' || taskView == 'view'" ng-click="switchTaskView('create')">New Task</a>
            <a class="btn btn-info" ng-show="taskView == 'create' || taskView == 'view'" ng-click="switchTaskView('list')">Tasks List</a>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1" ng-show="tasks.count_all < 1 && taskView == 'list'">
            <div class="empty_block">
            <span class="icon">
                <i class="fa fa-bell-o" aria-hidden="true"></i>
            </span>
                <br/>
                <br/>
                <h2>Welcome to Task!</h2>
                <p class="lead">Task are used to manage your tasks list. You can create your task list with proper labeling and then assign to the user. After completing each task you can mark them as closed/reopened. It also allowed to comments on task</p>
                <br/>
                <a class="btn-lg-theme" ng-click="switchTaskView('create')">Create your first task</a>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="page_loader" ng-show="!task_loader">
        <img src="{{BASE_URL}}/img/loader-blue.gif" class="md_loader">
        <h4>Content loading, please wait...</h4>
    </div>

    <!-- Task list -->
    <div ng-show="taskView == 'list'">
        <div class="widget" ng-show="task_loader && tasks.count_all > 0">
            <div class="widget-header">
                <div class="filter_bar">

                    <div class="filter_items pull-left visible-lg">
                        <a class="search_item search_item_gray" ng-click="clearQueryString(); doFilter(filterQuery.status = 'all')">
                            <i class="fa fa-signal" aria-hidden="true"></i>
                            All
                        </a>

                        <a class="search_item search_item_gray" ng-click="doFilter(filterQuery.status = 'closed')">
                            <i class="fa fa-bell-slash-o" aria-hidden="true"></i>
                            Closed
                        </a>

                        <a class="search_item search_item_gray" ng-click="doFilter(filterQuery.status = 'open')">
                            <i class="fa fa-bell-o" aria-hidden="true"></i>
                            Open
                        </a>

                        <a class="search_item search_item_gray" ng-click="doFilter(filterQuery.unlabeled = true)">
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            Unlabeled
                        </a>

                        <a class="search_item search_item_gray" ng-click="doFilter(filterQuery.unassigned = true)">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            Unassigned
                        </a>
                    </div>

                    <div class="pull-right right-side-filter">
                        <div class="filter_block">
                            <div class="dropdown">
                                <span id="labelList" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Labels <b class="caret"></b>
                                </span>

                                <div class="dropdown-menu custom-dropdown" id="labelList" aria-labelledby="label">
                                    <h2>
                                        Filter by label
                                        <a class="quick_task">
                                            <img ng-show="show_label_refresh_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                            <span class="add_new_label" ng-click="refreshLabelList()" title="Refresh Label List"><i class="fa fa-refresh grey"></i></span>
                                        </a>
                                    </h2>

                                    <div class="label_quick_operation">
                                        <div class="search_label">
                                            <input class="form-control" ng-model="label_query" ng-change="searchLabel(label_query)" placeholder="Search label">
                                            <img ng-show="show_label_search_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <ul class="custom_dropdown_list nav nav-list">
                                        <li ng-repeat="(key, label) in labels">
                                            <a ng-click="chooseFilterLabel(label, key, label.checked)">{{label.name}}
                                                <i ng-show="label.checked" class="fa fa-check pull-right green"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="filter_block">
                            <div class="dropdown">
                                <span id="assigneeList" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Assigned <b class="caret"></b>
                                </span>
                                <div class="dropdown-menu custom-dropdown" id="assigneeList" aria-labelledby="label">
                                    <h2>
                                        Filter by who’s assigned
                                        <a class="quick_task">
                                            <img ng-show="show_user_refresh_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                            <span class="add_new_label" ng-click="refreshUserList()" title="Refresh User List">
                                                <i class="fa fa-refresh grey"></i>
                                            </span>
                                        </a>
                                    </h2>

                                    <div class="label_quick_operation" ng-show="users.length > 0">
                                        <div class="search_label">
                                            <input class="form-control" ng-model="user_query" ng-change="searchUser(user_query)" placeholder="Search user">
                                            <img ng-show="show_user_search_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <ul class="custom_dropdown_list nav nav-list">
                                        <li ng-repeat="(key, user) in users">
                                            <a ng-click="chooseFilterAssignee(user, key, user.checked)">
                                                <img ng-if="user.profile.profile_pic != null" src="{{BASE_URL}}/img/profiles/{{user.profile.profile_pic}}">
                                                <img ng-if="!user.profile.profile_pic" src="{{BASE_URL}}/img/profile_avatar.jpg">
                                                {{user.profile.first_name}} {{user.profile.last_name}}
                                                <i ng-show="user.checked" class="fa fa-check pull-right green"></i>
                                            </a>
                                        </li>
                                    </ul>

                                    <p style="font-size: 10px; margin-top: 10px;" ng-show="users.length < 1" class="red text-center text-uppercase" ng-show="taskLabels.length < 1">Assignee not found</p>
                                </div>
                            </div>
                        </div>

                        <div class="filter_block">
                            <div class="dropdown">
                                <span id="assigneeList" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Sort
                                    <b class="caret"></b>
                                </span>
                                <div class="dropdown-menu custom-dropdown" id="assigneeList" aria-labelledby="label">
                                    <ul class="custom_dropdown_list nav nav-list">
                                        <li>
                                            <a ng-click="doFilter(filterQuery.sort_by = 'id', filterQuery.order_by = 'DESC')">Newest</a>
                                            <a ng-click="doFilter(filterQuery.sort_by = 'id', filterQuery.order_by = 'ASC')">Oldest</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="filter_block search_query">
                            <div>
                                <input ng-model="filterQuery.query" class="form-control" placeholder="Search task" ng-change="doFilter()">
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                </div>
            </div>
            <div class="widget-body">
                <div class="filter_options">
                    <div class="filter_option_bar">
                        <h2 ng-show="filterLabels.length > 0 || filtterAuthor.length > 0 || filtterAssignee.length > 0 || filterQuery.status == 'closed' || filterQuery.status == 'open' || filterQuery.unlabeled || filterQuery.unassigned">
                            Filtered By:</h2>

                        <ul class="filter_user">
                            <li ng-show="filterQuery.query">
                                Query: {{filterQuery.query}}
                                <span class="red" ng-click="doFilter(filterQuery.query = null)">X</span>
                            </li>
                            <li ng-show="filterQuery.status == 'closed'">
                                Closed
                                <span class="red" ng-click="doFilter(filterQuery.status = 'all')">X</span>
                            </li>
                            <li ng-show="filterQuery.status == 'open'">
                                Open
                                <span class="red" ng-click="doFilter(filterQuery.status = 'all')">X</span>
                            </li>
                            <li ng-show="filterQuery.unlabeled">
                                Unlabeled
                                <span class="red" ng-click="doFilter(filterQuery.unlabeled = false)">X</span>
                            </li>
                            <li ng-show="filterQuery.unassigned">
                                Unassigned
                                <span class="red" ng-click="doFilter(filterQuery.unassigned = false)">X</span>
                            </li>
                            <li ng-repeat="label in filterLabels">
                                Label: {{label.name}}
                                <span class="red" ng-click="removeFilterLabel(label)">X</span>
                            </li>

                            <li ng-repeat="user in filtterAuthor">
                                Author: {{user.profile.first_name}} {{user.profile.last_name}}
                                <span class="red" ng-click="removeFilterAuthor(user)">X</span>
                            </li>

                            <li ng-repeat="user in filtterAssignee">
                                Assignee: {{user.profile.first_name}} {{user.profile.last_name}}
                                <span class="red" ng-click="removeFilterAssignee(user)">X</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div ng-show="tasks.count_all > 0" block-ui="blockTasksList">
                    <div class="clearfix"></div>
                    <table class="table task_list_table" ng-show="tasks.count > 0">
                        <tbody>
                        <tr ng-repeat="task in tasks.data">
                            <td style="width: 50px;" class="hidden-xs">
                                <a class="sl" href="{{BASE_URL}}{{task.project.slug}}/tasks/{{task.identity}}">#{{task.identity}}</a>
                            </td>
                            <td style="width: 15px; padding-right: 0px;" class="hidden-xs">
                                <i ng-show="task.status == 2" class="fa fa-bell-slash-o red" aria-hidden="true"></i>
                                <i ng-show="task.status != 2" class="fa fa-bell-o green" aria-hidden="true"></i>
                            </td>
                            <td>
                                <div>
                                    <a href="{{BASE_URL}}{{task.project.slug}}/tasks/{{task.identity}}" ng-show="task.task" class="task_title">{{task.task}}</a>
                                    <a href="{{BASE_URL}}{{task.project.slug}}/tasks/{{task.identity}}" ng-show="!task.task">-</a>
                                    <label ng-repeat="label in task.labels" class="app_label" style="color: {{label.color_code}}; border: 1px solid {{label.color_code}};">{{label.name}}</label>
                                </div>
                                <small class="author">Created by
                                    <a href="/users/{{task.createdUser.uuid}}">{{task.createdUserProfile.first_name}} {{task.createdUserProfile.last_name}}</a> at
                                    {{task.created | date}}.
                                    ({{task.created | date : 'HH:m a'}})
                                </small>
                            </td>
                            <td style="width: 10%;">
                                <span ng-repeat="user in task.users" title="{{user.profile.first_name}} {{user.profile.last_name}}">
                                    <img class="sm_avatar" ng-if="user.profile.profile_pic != null" src="{{BASE_URL}}/img/profiles/{{user.profile.profile_pic}}"/>
                                    <img class="sm_avatar" ng-if="!user.profile.profile_pic" src="{{BASE_URL}}/img/profile_avatar.jpg"/>
                                </span>
                            </td>
                            <td style="width: 5%;" class="text-right">
                                <span class="text-muted" ng-show="task.comments.length > 0" title="{{task.comments.length}} comments">
                                    <i class="fa fa-commenting-o"></i> {{task.comments.length}}
                                </span>
                            </td>
                            <td class="text-right" style="width: 10%;">
                                <a ng-click="viewTask(task.id); switchTaskView('view')" class="icons green"><i class="fa fa-gear"></i></a>
                                <a ng-click="deleteTask(task.id); switchTaskView('list')" class="icons red"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="pagination_area text-center" ng-show="tasks.count > 0">
                        <a class="pull-left previous_page" ng-click="goPreviousPage()">
                            <span aria-hidden="true">&laquo;</span> Previous
                        </a>
                        <a>
                            <span>
                                showing {{((tasks.currentPage - 1) * tasks.limit) + 1}} -
                                {{tasks.currentPage * tasks.limit > tasks.count ? tasks.count : tasks.currentPage * tasks.limit}}
                                of {{tasks.count}} records
                            </span>
                        </a>
                        <a class="pull-right next_page" ng-click="goNextPage()">
                            Next <span aria-hidden="true">&raquo;</span>
                        </a>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="not-found" ng-show="tasks.count < 1 && filtered_tasks_list">
                    <h4>Sorry! task not found</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- /Task list -->

    <!-- Saving new task -->
    <div class="widget" ng-show="taskView == 'create'">
        <div class="widget-header">
            <div class="pull-left">
                <h2>New Task</h2>
                <span>Please provide all valid information to create new task</span>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="widget-body">
            <div class="row save_task_btn_section">
                <div class="col-lg-8 col-md-8">
                    <form ng-submit="saveTask()" novalidate>
                        <div>
                            <div class="form-group">
                                <label>Title</label>
                                <div class="input text">
                                    <input type="text" ng-model="TaskObj.task" class="form-control" placeholder="Title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <div class="input text">
                                    <text-angular ng-model="TaskObj.description" ta-toolbar="[['redo', 'undo', 'insertLink'], ['p', 'bold','italics', 'underline'], ['ol', 'ul']]" ng-model="htmlVariable"></text-angular>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Attachments</label>
                                        <div class="input text" ng-repeat="key in countAttachments">
                                            <input type="file" class="form-control attachment_field" ngf-select ng-model="TaskObj.file[key]" name="task_attachments" ngf-max-size="20MB"/>
                                        </div>
                                        <a class="btn-theme-xs-rev" ng-click="addMoreAttachment()">Add More Attachment</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group save_task_btn">
                                <button class="btn btn-success">SAVE TASK</button>
                                <span class="instance-loader" ng-show="save_task_loader">
                                    <img src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader"> Please wait...
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="task_sidebar">
                        <div class="single_block">
                            <div class="dropdown">
                                <h2 id="labelList2" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Set Task Label
                                    <i class="fa fa-gear pull-right"></i>
                                </h2>

                                <div class="dropdown-menu custom-dropdown" id="labelList2" aria-labelledby="label">
                                    <h2 ng-show="!show_create_new_label_form">
                                        Apply label
                                        <a class="quick_task">
                                            <img ng-show="show_label_refresh_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                            <span class="add_new_label" ng-click="refreshLabelList()" title="Refresh Label List">
                                                <i class="fa fa-refresh grey"></i>
                                            </span>
                                            <span class="add_new_label" ng-click="show_create_new_label_form = true;" title="Create New Label">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                        </a>
                                    </h2>
                                    <div class="label_quick_operation">
                                        <div class="create_new_label" ng-show="show_create_new_label_form">
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
                                                    <button class="btn btn-success" ng-click="saveLabel(create_label_form.$valid)">Save</button>
                                                    <a class="btn btn-danger" ng-show="!show_label_create_loader" ng-click="show_create_new_label_form = false">Cancel</a>
                                                    <img ng-show="show_label_create_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                                </div>
                                            </ng-form>
                                        </div>

                                        <div class="search_label" ng-show="!show_create_new_label_form && taskLabels.length > 0">
                                            <input class="form-control" ng-model="label_query" ng-change="searchLabel(label_query)" placeholder="Search label">
                                            <img ng-show="show_label_search_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>

                                    <ul class="custom_dropdown_list nav nav-list" ng-show="!show_create_new_label_form">
                                        <li ng-repeat="(key, label) in labels">
                                            <a ng-click="chooseTaskLabels(label, key, label.checked)">{{label.name}}
                                                <i ng-show="label.checked" class="fa fa-check pull-right green"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <p style="font-size: 10px; margin-top: 10px;" ng-show="labels.length < 1 && !show_create_new_label_form" class="red text-center text-uppercase" ng-show="taskLabels.length < 1">Label list empty</p>
                                </div>
                            </div>

                            <small class="red" ng-show="taskLabels.length < 1">Label not set
                                yet!
                            </small>
                            <div>
                                <ul class="task_labels" ng-show="taskLabels.length > 0">
                                    <li ng-repeat="taskLabel in taskLabels" style="background: {{taskLabel.color_code}};">
                                        {{taskLabel.name}}
                                        <span ng-click="removeTaskLabels(taskLabel)">X</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="single_block">
                            <div class="dropdown">
                                <h2 id="usersList" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Assign User
                                    <i class="fa fa-gear pull-right"></i>
                                </h2>
                                <div class="dropdown-menu custom-dropdown" id="usersList" aria-labelledby="label">
                                    <h2 ng-show="!show_create_new_user_form">
                                        Assign task to user
                                        <a class="quick_task">
                                            <img ng-show="show_user_refresh_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                            <span class="add_new_label" ng-click="refreshUserList()" title="Refresh User List">
                                                <i class="fa fa-refresh grey"></i>
                                            </span>
                                            <span class="add_new_label" ng-click="show_create_new_user_form = true;" title="Create New User">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                        </a>
                                    </h2>

                                    <div class="label_quick_operation">

                                        <div class="create_new_label" ng-show="show_create_new_user_form">
                                            <div>
                                                <form name="createUserForm" class="create-user-form" ng-submit="createUser(); createUserForm.$setPristine()" novalidate>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" ng-model="userObj.profile.first_name" placeholder="First name" name="first_name" required/>
                                                        <div class="error-message" ng-if="!createUserForm.first_name.$pristine || createUserSubmitted">
                                                            <p ng-show="createUserForm.first_name.$error.required">First name is required</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" class="form-control" ng-model="userObj.profile.last_name" placeholder="Last name" name="last_name" required/>
                                                        <div class="error-message" ng-if="!createUserForm.last_name.$pristine || createUserSubmitted">
                                                            <p ng-show="createUserForm.last_name.$error.required">Last name is required</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="email" class="form-control" ng-model="userObj.username" ng-model-options="{ debounce: 1000 }" placeholder="Email address" name="username" required email unique-email/>
                                                        <div class="error-message" ng-if="!createUserForm.username.$pristine || createUserSubmitted">
                                                            <p ng-show="createUserForm.username.$error.required">Email address is required</p>
                                                            <p ng-show="createUserForm.username.$error.email">Invalid email address</p>
                                                            <p ng-show="createUserForm.username.$error.uniqueEmail">This email is already taken</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="password" class="form-control" ng-model="userObj.password" placeholder="Password" name="password" required="required" />
                                                        <div class="error-message" ng-if="!createUserForm.password.$pristine || createUserSubmitted">
                                                            <p ng-show="createUserForm.password.$error.required">Password is required</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="password" class="form-control" name="cPassword" ng-model="userObj.cPassword" placeholder="Confirm password" match-password="userObj.password" required>
                                                        <div class="error-message" ng-if="!createUserForm.cPassword.$pristine || createUserSubmitted">
                                                            <p ng-show="createUserForm.cPassword.$error.required" >Confirm password is required</p>
                                                            <p ng-show="createUserForm.cPassword.$error.matchPassword"  ng-if="!createUserForm.cPassword.$error.required">Confirm password didn't match</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success">Create User</button>
                                                        <a class="btn btn-default" ng-click="visible_assign_box = true">Cancel</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="search_label" ng-show="!show_create_new_user_form && users.length > 0">
                                            <input class="form-control" ng-model="user_query" ng-change="searchUser(user_query)" placeholder="Search user">
                                            <img ng-show="show_user_search_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <ul class="custom_dropdown_list nav nav-list" ng-show="!show_create_new_user_form">
                                        <li ng-repeat="(key, user) in users">
                                            <a ng-click="chooseTaskUsers(user, key, user.checked)">
                                                <img ng-if="user.profile.profile_pic != null" src="{{BASE_URL}}/img/profiles/{{user.profile.profile_pic}}">
                                                <img ng-if="!user.profile.profile_pic" src="{{BASE_URL}}/img/profile_avatar.jpg">
                                                {{user.profile.first_name}}
                                                {{user.profile.last_name}}
                                                <i ng-show="user.checked" class="fa fa-check pull-right green"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <p style="font-size: 10px; margin-top: 10px;" ng-show="!show_create_new_user_form && users.length < 1" class="red text-center text-uppercase" ng-show="taskLabels.length < 1">User not found</p>
                                </div>
                            </div>

                            <small class="red" ng-show="taskUsers.length < 1">User not assigned
                                yet!
                            </small>
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
        </div>
    </div>
    <!-- /Saving new task -->
</div>

<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/TasksCtrl']);
echo $this->end();
?>