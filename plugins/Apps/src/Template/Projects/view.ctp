<?php echo $this->assign('title', $project->name); ?>

<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link($project->name, ['controller' => 'projects', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<?php echo $this->Html->link('Task Manager', ['controller' => 'tasks', 'action' => 'index', $project->slug]);?>

<div class="col-md-12">
    <div class="tabbable-panel">
        <div class="tabbable-line">
            <ul class="nav nav-tabs ">
                <div class="pull-right" ng-show="viewMode == 'task' && taskView == 'list'">
                    <a class="btn btn-info" ng-click="switchTaskView('create')">New Task</a>
                </div>
                <li class="active">
                    <a href="#project_overview" data-toggle="tab">Project Overview</a>
                </li>
                <li class="">
                    <a href="#project_tasks" data-toggle="tab" ng-click="openedView('task')">Tasks</a>
                </li>
                <li class="">
                    <a href="#project_labels" data-toggle="tab">Labels</a>
                </li>
                <li class="">
                    <a href="#project_users" data-toggle="tab">Assigned User</a>
                </li>
                <li class="">
                    <a href="#project_attachments" data-toggle="tab">Attachments</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="project_overview">
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

                <div class="tab-pane" id="project_tasks" ng-controller="TasksCtrl">

                    <!-- Task list -->
                    <div ng-show="taskView == 'list'">
                        <div class="row">
                            <div class="col-lg-10 col-lg-offset-1" ng-show="tasks.count_all < 1">
                                <div class="empty_block">
                                    <span class="icon">
                                        <i class="fa fa-bell-o" aria-hidden="true"></i>
                                    </span>
                                    <br/>
                                    <br/>
                                    <h2>Welcome to Task!</h2>
                                    <p class="lead">Task are used to manage your tasks list. You can create your task
                                        list with proper labeling and then assign to the user. After completing each
                                        task you can mark them as closed/reopened. It also allowed to comments on
                                        task</p>
                                    <br/>
                                    <a class="btn-lg-theme" ng-click="switchTaskView('create')">Create your first
                                        task</a>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="page_loader" ng-show="!task_loader">
                            <img src="{{BASE_URL}}/img/loader-blue.gif" class="md_loader">
                            <h4>Content loading, please wait...</h4>
                        </div>

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
                                                <span id="authorList" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    Author
                                                    <b class="caret"></b>
                                                </span>
                                                <div class="dropdown-menu custom-dropdown" id="authorList" aria-labelledby="label">
                                                    <h2> Filter by author
                                                        <a class="quick_task">
                                                            <img ng-show="show_user_refresh_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                                            <span class="add_new_label" ng-click="refreshUserList()" title="Refresh User List">
                                                                <i class="fa fa-refresh grey"></i>
                                                            </span>
                                                        </a>
                                                    </h2>

                                                    <div class="label_quick_operation">
                                                        <div class="search_label">
                                                            <input class="form-control" ng-model="user_query" ng-change="searchUser(user_query)" placeholder="Search user">
                                                            <img ng-show="show_user_search_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                    <ul class="custom_dropdown_list nav nav-list">
                                                        <li ng-repeat="(key, user) in users">
                                                            <a ng-click="chooseFilterAuthor(user, key, user.checked)">
                                                                <img ng-if="user.profile.profile_pic != null" src="{{BASE_URL}}/img/profiles/{{user.profile.profile_pic}}">
                                                                <img ng-if="!user.profile.profile_pic" src="{{BASE_URL}}/img/profile_avatar.jpg">
                                                                {{user.profile.first_name}} {{user.profile.last_name}}
                                                                <i ng-show="user.checked" class="fa fa-check pull-right green"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <p style="font-size: 10px; margin-top: 10px;" ng-show="users.length < 1" class="red text-center text-uppercase" ng-show="taskLabels.length < 1">Author not found</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="filter_block">
                                            <div class="dropdown">
                                                <span id="labelList" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    Labels
                                                    <b class="caret"></b>
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
                                                            <input class="form-control" ng-model="label_query" ng-change="searchLabel(label_query)"
                                                                   placeholder="Search label">
                                                            <img ng-show="show_label_search_loader"
                                                                 src="{{BASE_URL}}/img/loader-blue.gif"
                                                                 class="sm_loader">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                    <ul class="custom_dropdown_list nav nav-list">
                                                        <li ng-repeat="(key, label) in labels">
                                                            <a ng-click="chooseFilterLabel(label, key, label.checked)">{{label.name}}
                                                                <i ng-show="label.checked"
                                                                   class="fa fa-check pull-right green"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="filter_block">
                                            <div class="dropdown">
                                                <span id="assigneeList" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    Assigned
                                                    <b class="caret"></b>
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

                                                    <div class="label_quick_operation">
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
                                <div class="row">
                                    <div class="col-lg-12 col-md-12" ng-show="tasks.count_all > 0" block-ui="blockTasksList">
                                        <div class="clearfix"></div>
                                        <table class="table task-list-table" ng-show="tasks.count > 0">
                                            <tbody>
                                            <tr ng-repeat="task in tasks.data">
                                                <td style="width: 50px;" class="hidden-xs">
                                                    <a class="sl" ng-click="viewTask(task.id); switchTaskView('view')">#{{task.id}}</a>
                                                </td>
                                                <td style="width: 15px; padding-right: 0px;" class="hidden-xs">
                                                    <i ng-show="task.status == 2" class="fa fa-bell-slash-o red" aria-hidden="true"></i>
                                                    <i ng-show="task.status != 2" class="fa fa-bell-o green" aria-hidden="true"></i>
                                                </td>
                                                <td>
                                                    <strong>
                                                        <a ng-click="viewTask(task.id); switchTaskView('view')" ng-show="task.task">{{task.task}}</a>
                                                        <a ng-click="viewTask(task.id); switchTaskView('view')" ng-show="!task.task">-</a>
                                                        <label ng-repeat="label in task.labels" class="app_label" style="color: {{label.color_code}}; border: 1px solid {{label.color_code}};">{{label.name}}</label>
                                                    </strong>
                                                    <br>
                                                    <small class="author">Opened by
                                                        {{task.createdUserProfile.first_name}}
                                                        {{task.createdUserProfile.first_name}} at
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
                                                <td class="text-right" style="width: 10%;">
                                                    <a ng-click="viewTask(task.id); switchTaskView('view')" class="icons green"><i class="fa fa-gear"></i></a>
                                                    <a ng-click="deleteTask(task.id); switchTaskView('list')" class="icons red"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <div class="pagination_area text-center" ng-show="tasks.count > 0">
                                            <a class="pull-left previous_page" ng-click="goPreviousPage()"><span aria-hidden="true">&laquo;</span> Previous</a>
                                            <span>
                                                showing {{((tasks.currentPage - 1) * tasks.limit) + 1}} -
                                                {{tasks.currentPage * tasks.limit > tasks.count ? tasks.count : tasks.currentPage * tasks.limit}}
                                                of {{tasks.count}} records
                                            </span>
                                            <a class="pull-right next_page" ng-click="goNextPage()">Next <span aria-hidden="true">&raquo;</span></a>
                                        </div>
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
                            <div class="pull-right btn-areas">
                                <a ng-click="switchTaskView('list'); fetchTaskLists()" class="btn btn-info">Tasks
                                    List</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget-body">
                            <div>
                                <form ng-submit="saveTask()">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8">
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
                                                        <text-angular ng-model="TaskObj.description" ta-toolbar="[['h1','h2','h3', 'h4' , 'h5', 'h6'],['p', 'bold','italics', 'underline'], ['ol', 'ul'], ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', ]]" ng-model="htmlVariable"></text-angular>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Attachments</label>
                                                            <div class="input text" ng-repeat="key in countAttachments">
                                                                <input type="file" class="form-control attachment_field" ngf-select ng-model="TaskObj.file[key]" name="task_attachments" ngf-max-size="20MB"/>
                                                            </div>
                                                            <a class="btn-theme-xs-rev" ng-click="addMoreAttachment()">Add
                                                                More
                                                                Attachment</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                                    <span class="add_new_label" ng-click="show_create_new_label_form = true;" title="Create New Title">
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
                                                                            <a class="btn btn-success" ng-click="saveLabel(create_label_form.$valid)">Save</a>
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
                                                            <h2>
                                                                Assign task to user
                                                                <a class="quick_task">
                                                                    <img ng-show="show_user_refresh_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                                                    <span class="add_new_label" ng-click="refreshUserList()" title="Refresh User List">
                                                                        <i class="fa fa-refresh grey"></i>
                                                                    </span>
                                                                </a>
                                                            </h2>

                                                            <div class="label_quick_operation">
                                                                <div class="search_label">
                                                                    <input class="form-control" ng-model="user_query" ng-change="searchUser(user_query)" placeholder="Search user">
                                                                    <img ng-show="show_user_search_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>


                                                            <ul class="custom_dropdown_list nav nav-list">
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
                                                            <p style="font-size: 10px; margin-top: 10px;" ng-show="users.length < 1" class="red text-center text-uppercase" ng-show="taskLabels.length < 1">User not found</p>
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
                                    <div class="form-group">
                                        <button class="btn btn-success" ng-click="switchTaskView('list')">SAVE TASK
                                        </button>
                                        <span class="instance-loader" ng-show="save_task_loader">
                                            <img src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader"> Please wait...
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Saving new task -->

                    <!-- Task Details -->
                    <div class="widget" ng-show="taskView == 'view'">
                        <div class="widget-header">
                            <div class="pull-left">
                                <h2 class="title">Task Details</h2>
                            </div>
                            <div class="pull-right btn-areas">
                                <a ng-click="switchTaskView('list'); fetchTaskLists()" class="btn btn-info">Tasks
                                    List</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget-body">
                            <div ng-show="taskView == 'view'">
                                <div class="row">
                                    <div class="col-lg-9 col-md-8">
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
                                                    <a href="{{BASE_URL}}tasks/download_attachment/{{attachment.uuid}}">
                                                        <i class="fa fa-paperclip"></i> {{attachment.name}}
                                                    </a>
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
                                                            <br/>
                                                            <span class="instance-loader" ng-show="update_task_loader">
                                                                <img src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader"> Please wait...
                                                            </span>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <h2 class="commom-title" ng-show="taskComments.length > 0">Comments</h2>
                                            <div class="comments" ng-repeat="comment in taskComments">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="user-photo" ng-if="comment.user.profile.profile_pic != null" src="{{BASE_URL}}/img/profiles/{{comment.user.profile.profile_pic}}">
                                                            <img class="user-photo" ng-if="!comment.user.profile.profile_pic" src="{{BASE_URL}}/img/profile_avatar.jpg">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">
                                                            <strong>
                                                                <a href="{{BASE_URL}}users/view/{{comment.user.uuid}}">
                                                                    {{comment.user.profile.first_name}}
                                                                    {{comment.user.profile.last_name}}
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
                                                                <a href="{{BASE_URL}}tasks/download_attachment/{{attachment.uuid}}">
                                                                    <i class="fa fa-paperclip"></i>
                                                                    {{attachment.name}}
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="comment_widget" ng-show="!edit_task_form">
                                                <form ng-submit="doComment()">
                                                    <textarea placeholder="Write your comment?" ng-model="commentsObj.comment" class="form-control" rows="7" style="resize: none;"></textarea>
                                                    <br/>
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>Attachments</label>
                                                                <div class="input text" ng-repeat="key in countAttachments">
                                                                    <input type="file" class="form-control attachment_field" ngf-select ng-model="commentsObj.file[key]" name="task_attachments" ngf-max-size="20MB"/>
                                                                </div>
                                                                <a class="btn-theme-xs-rev" ng-click="addMoreAttachment()">AddMore Attachment</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br/>
                                                    <div class="pull-left">
                                                        <button type="submit" class="btn btn-success">Comment</button>
                                                        <a ng-show="TaskObj.status == 1 || TaskObj.status == 3" class="btn btn-default" ng-click="changeStatus(2)">Comment &Close Task</a>
                                                        <a ng-show="TaskObj.status == 2" class="btn btn-danger" ng-click="changeStatus(3)">Reopen Task</a>
                                                        <br/>
                                                        <span class="instance-loader" ng-show="task_quick_update_loader">
                                                            <img src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader"> Please wait...
                                                        </span>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </form>
                                            </div><!-- Widget Area -->
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4">
                                        <a class="btn btn-success" ng-show="!edit_task_form" ng-click="edit_task_form = true; view_task = false">Edit Task</a>
                                        <a class="btn btn-danger" ng-show="!edit_task_form" ng-click="deleteTask(TaskObj.id); switchTaskView('list')">Delete Task</a>
                                        <div class="task_sidebar" style="margin-top: 25px">
                                            <div class="single_block">
                                                <div class="dropdown">
                                                    <h2 id="labelList3" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                        Set Task Label <i class="fa fa-gear pull-right"></i>
                                                    </h2>

                                                    <div class="dropdown-menu custom-dropdown" id="labelList3" aria-labelledby="label">
                                                        <h2 ng-show="!show_create_new_label_form">
                                                            Apply label
                                                            <a class="quick_task">
                                                                <img ng-show="show_label_refresh_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                                                <span class="add_new_label" ng-click="refreshLabelList()" title="Refresh Label List"><i class="fa fa-refresh grey"></i></span>
                                                                <span class="add_new_label" ng-click="show_create_new_label_form = true;" title="Create New Title"><i class="fa fa-plus"></i></span>
                                                            </a>
                                                        </h2>
                                                        <div class="label_quick_operation">
                                                            <!-- Create new label -->
                                                            <div class="create_new_label" ng-show="show_create_new_label_form">
                                                                <form name="create_label_form" novalidate>
                                                                    <div class="form-group">
                                                                        <label>Label Name</label>
                                                                        <div class="input text">
                                                                            <input type="text" ng-model="LabelObj.name" name="label_name" class="form-control" placeholder="Name of label">
                                                                            <div ng-if="create_label_form.label_name.$touched || isLabelFormSubmitted">
                                                                                <p ng-show="create_label_form.label_name.$error.required" class="text-danger">Label name is required</p>
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
                                                                        <img ng-show="show_label_create_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <!-- Create new label -->

                                                            <!-- Searching label -->
                                                            <div class="clearfix">
                                                                <div class="search_label" ng-show="!show_create_new_label_form && taskLabels.length > 0">
                                                                    <input class="form-control" ng-model="label_query" ng-change="searchLabel(label_query)" placeholder="Search label">
                                                                    <img ng-show="show_label_search_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                                                </div>

                                                                <ul class="custom_dropdown_list nav nav-list" ng-show="!show_create_new_label_form">
                                                                    <li ng-repeat="(key, label) in labels" ng-init="label = hasLabelAssigned(taskLabels, label)">
                                                                        <a ng-click="chooseTaskLabels(label, key, label.checked); quickUpdate('label_event', label.checked)">{{label.name}}
                                                                            <i ng-show="label.checked" class="fa fa-check pull-right green"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <p style="font-size: 10px; margin-top: 10px;" ng-show="labels.length < 1 && !show_create_new_label_form" class="red text-center text-uppercase" ng-show="taskLabels.length < 1">Label list empty</p>
                                                            </div>
                                                            <!-- /Searching label -->
                                                        </div>
                                                    </div>

                                                    <small class="red" ng-show="taskLabels.length < 1">Label not set
                                                        yet!
                                                    </small>
                                                    <div>
                                                        <ul class="task_labels" ng-show="taskLabels.length > 0">
                                                            <li ng-repeat="taskLabel in taskLabels" style="background: {{taskLabel.color_code}};">
                                                                {{taskLabel.name}}
                                                                <span ng-click="removeTaskLabels(taskLabel); quickUpdate('label_event', false)">X</span>
                                                            </li>
                                                        </ul>
                                                    </div>
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
                                                                <img ng-show="show_user_refresh_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                                                                <span class="add_new_label" ng-click="refreshUserList()" title="Refresh User List">
                                                                    <i class="fa fa-refresh grey"></i>
                                                                </span>
                                                            </a>
                                                        </h2>

                                                        <div class="label_quick_operation">
                                                            <div class="search_label">
                                                                <input class="form-control" ng-model="user_query"
                                                                       ng-change="searchUser(user_query)"
                                                                       placeholder="Search user">
                                                                <img ng-show="show_user_search_loader"
                                                                     src="{{BASE_URL}}/img/loader-blue.gif"
                                                                     class="sm_loader">
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>

                                                        <ul class="custom_dropdown_list nav nav-list">
                                                            <li ng-repeat="(key, user) in users"
                                                                ng-init="user = hasUserAssigned(taskUsers, user)">
                                                                <a ng-click="chooseTaskUsers(user, key, user.checked); quickUpdate('user_event', user.checked)">
                                                                    <img ng-if="user.profile.profile_pic != null"
                                                                         src="{{BASE_URL}}/img/profiles/{{user.profile.profile_pic}}">
                                                                    <img ng-if="!user.profile.profile_pic"
                                                                         src="{{BASE_URL}}/img/profile_avatar.jpg">
                                                                    {{user.profile.first_name}}
                                                                    {{user.profile.last_name}}
                                                                    {{user.checked}}
                                                                    <i ng-show="user.checked"
                                                                       class="fa fa-check pull-right green"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <p style="font-size: 10px; margin-top: 10px;"
                                                           ng-show="users.length < 1"
                                                           class="red text-center text-uppercase"
                                                           ng-show="taskLabels.length < 1">User not found</p>
                                                    </div>
                                                </div>
                                                <small class="red" ng-show="taskUsers.length < 1">User not assigned
                                                    yet!
                                                </small>
                                                <ul class="task_users">
                                                    <li ng-repeat="user in taskUsers">
                                                        <img ng-if="user.profile.profile_pic != null"
                                                             src="{{BASE_URL}}/img/profiles/{{user.profile.profile_pic}}">
                                                        <img ng-if="!user.profile.profile_pic"
                                                             src="{{BASE_URL}}/img/profile_avatar.jpg">
                                                        {{user.profile.first_name}} {{user.profile.last_name}}
                                                        <span class="pull-right red"
                                                              ng-click="removeTaskUsers(user); quickUpdate('user_event', false)">X</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /Task Details -->

                </div>

                <div class="tab-pane" id="project_labels">
                    <div ng-controller="LabelsCtrl">
                        <div class="page_loader" ng-show="!hide_page_loader">
                            <img src="{{BASE_URL}}/img/loader-blue.gif" class="md_loader">
                            <h4>Content loading, please wait...</h4>
                        </div>

                        <div ng-show="hide_page_loader">
                            <div class="row">
                                <div class="col-lg-5 col-md-5"
                                     ng-show="label.count > 0 || show_crate_form || searched_labels">

                                    <!-- Create label form -->
                                    <div ng-show="create_form" class="widget widget widget-boxed">
                                        <div class="widget-header">
                                            <h4 class="title">
                                                New Label
                                            </h4>
                                        </div>
                                        <div class="widget-body">
                                            <form name="create_label_form"
                                                  ng-submit="saveLabel(create_label_form.$valid)" novalidate>
                                                <div class="form-group">
                                                    <label>Label Name</label>
                                                    <div class="input text">
                                                        <input type="text" ng-model="LabelObj.name" name="c_label_name"
                                                               class="form-control" placeholder="Name of label"
                                                               required="required">
                                                        <div
                                                            ng-if="create_label_form.c_label_name.$dirty || isLabelFormSubmitted">
                                                            <p ng-show="create_label_form.c_label_name.$error.required"
                                                               class="error-message">Label name is required</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Label Color</label>
                                                    <div class="input text">
                                                        <color-picker ng-model="LabelObj.color_code"
                                                                      options="color_options"></color-picker>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="checkbox checkbox-theme checkbox-circle">
                                                        <input id="checkbox8" type="checkbox" ng-model="LabelObj.status"
                                                               ng-true-value="1" ng-false-value="2">
                                                        <label for="checkbox8">
                                                            Is Active?
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-success">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /Create label form-->

                                    <!-- Edit label form -->
                                    <div ng-show="edit_form" class="widget">
                                        <div class="widget-header">
                                            <h2 class="title">Update Label</h2>
                                        </div>
                                        <div class="widget-body">
                                            <form name="update_label_form"
                                                  ng-submit="updateLabel(update_label_form.$valid)" novalidate>
                                                <div class="form-group">
                                                    <label>Label Name</label>
                                                    <div class="input text">
                                                        <input type="text" ng-model="LabelObj.name" name="u_label_name"
                                                               class="form-control" placeholder="Name of label"
                                                               required="required">
                                                        <div
                                                            ng-if="update_label_form.u_label_name.$dirty || isLabelFormSubmitted">
                                                            <p ng-show="update_label_form.u_label_name.$error.required"
                                                               class="error-message">Label name is required</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Label Color</label>
                                                    <div class="input text">
                                                        <color-picker ng-model="LabelObj.color_code"
                                                                      options="color_options"></color-picker>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="checkbox checkbox-theme checkbox-circle">
                                                        <input id="checkbox8" type="checkbox" ng-model="LabelObj.status"
                                                               ng-true-value="1" ng-false-value="2">
                                                        <label for="checkbox8">
                                                            Is Active?
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <button class="btn btn-success">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /Edit label form -->
                                </div>

                                <div class="col-lg-7 col-md-7" ng-show="label.count > 0 || searched_labels"
                                     block-ui="myBlockUI">
                                    <div class="widget">
                                        <div class="widget-header">
                                            <div class="pull-left">
                                                <h2>Lists of Label</h2>
                                                <span>{{label.count}} result found</span>
                                            </div>
                                            <div class="filter_block pull-right" style="margin-right: 0px;">
                                                <input class="form-control" ng-model="label_query"
                                                       ng-change="searchLabel(label_query)" placeholder="Search label">
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="widget-body">
                                            <div ng-show="label.count > 0">
                                                <table class="table label_List">
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th class="hidden-xs">Color</th>
                                                        <th>Status</th>
                                                        <th class="hidden-xs">Last Modified</th>
                                                        <th class="text-right">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr ng-repeat="label in label.data">
                                                        <td>
                                                            <label class="app_label"
                                                                   style="background: {{label.color_code}}">{{label.name}}</label>
                                                        </td>
                                                        <td class="hidden-xs">{{label.color_code}}</td>
                                                        <td>
                                                        <span class="status-text test status-text-green"
                                                              ng-show="label.status == 1">Active</span>
                                                            <span class="status-text status-text-danger"
                                                                  ng-show="label.status == 2">Inactive</span>
                                                        </td>
                                                        <td class="hidden-xs">{{label.modified | date}}</td>
                                                        <td class="text-right">
                                                            <a ng-click="openEditLabel(label.id)"
                                                               class="btn-small btn-small-primary">Edit</a>
                                                            <a ng-click="deleteLabel(label.id)"
                                                               class="btn-small btn-small-red">Delete</a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                <div class="pagination_area text-center">
                                                    <a ng-show="label.limit < label.count"
                                                       class="pull-left previous_page"
                                                       ng-click="goPreviousPage()"><span
                                                            aria-hidden="true">&laquo;</span>
                                                        Previous</a>
                                                    <span>
                                                        showing {{((label.currentPage - 1) * label.limit) + 1}} -
                                                        {{label.currentPage * label.limit > label.count ? label.count : label.currentPage * label.limit}}
                                                        of {{label.count}} records
                                                    </span>
                                                    <a ng-show="label.limit < label.count" class="pull-right next_page"
                                                       ng-click="goNextPage()">Next <span
                                                            aria-hidden="true">&raquo;</span></a>
                                                </div>

                                            </div>

                                            <div class="not-found" ng-show="label.count < 1">
                                                <h4>Sorry, label not found!</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-10 col-lg-offset-1"
                                     ng-show="label.count < 1 && !show_crate_form && !searched_labels">
                                    <div class="empty_block">
                                        <span class="icon" style="padding: 24px 13px 18px 17px;">
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                        </span>
                                        <br/>
                                        <br/>
                                        <h2>Welcome to Task Label!</h2>
                                        <p class="lead">Task labels are used to categorized your tasks list. With the
                                            task
                                            label, you can be labeling your task and assign them based on your needs.
                                            And
                                            also it's helpful to filter your task list.</p>
                                        <br/>
                                        <a class="btn-lg-theme" ng-click="show_crate_form = true">Create first label</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="project_users">
                    <h2>Project users</h2>
                </div>
                <div class="tab-pane" id="project_attachments">
                    <?php if (count($project['attachments']) > 0): ?>
                        <strong>Attachments: </strong>
                        <?php foreach ($project['attachments'] as $attachment): ?>
                            <p>
                                <a href="{{BASE_URL}}tasks/download_attachment/<?php echo $attachment->uuid; ?>"><i
                                        class="fa fa-paperclip"></i> <?php echo $attachment->uuid; ?></a>
                            </p>
                        <?php endforeach; ?>
                    <?php endif; ?>
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

