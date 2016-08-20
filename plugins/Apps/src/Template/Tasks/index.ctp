<?php echo $this->assign('title', 'Manage Task'); ?>

<div ng-controller="TasksCtrl">

    <div class="page-header" ng-show="count_all > 0">
        <h2 class="title pull-left">
            Manage Task
            <p class="sub-title">
                {{totalTasks}} result found
            </p>
        </h2>
        <div class="pull-right btn-areas">
            <?php echo $this->Html->link('New Task', ['controller' => 'tasks', 'action' => 'add'], ['class' => 'btn btn-info']) ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="col-lg-12 col-md-12" ng-show="count_all > 0">
        <div class="filter_bar">

            <a class="search_item search_item_gray"  ng-click="clearQueryString(); doFilter(filterQuery.status = 'all')">
                <i class="fa fa-signal" aria-hidden="true"></i>
                All
            </a>

            <a class="search_item search_item_red"  ng-click="doFilter(filterQuery.status = 'closed')">
                <i class="fa fa-bell-slash-o" aria-hidden="true"></i>
                Closed
            </a>

            <a class="search_item search_item_theme" ng-click="doFilter(filterQuery.status = 'open')">
                <i class="fa fa-bell-o" aria-hidden="true"></i>
                Open
            </a>

            <a class="search_item search_item_info" ng-click="doFilter(filterQuery.unlabeled = true)">
                <i class="fa fa-tags" aria-hidden="true"></i>
                Unlabeled
            </a>

            <a class="search_item search_item_orange" ng-click="doFilter(filterQuery.unassigned = true)">
                <i class="fa fa-users" aria-hidden="true"></i>
                Unassigned
            </a>

            <div class="pull-right">

                <div class="filter_block">
                    <span class="dropdown-toggle task_operation" id="label" role="button" aria-haspopup="true" aria-expanded="false">
                        Author
                        <b class="caret"></b>
                    </span>
                    <div class="dropdown">
                        <div class="dropdown-menu custom-dropdown" id="label" aria-labelledby="label">
                            <h2>Filter by author <a class="close_dropdown">X</a></h2>
                            <ul class="custom_dropdown_list nav nav-list">
                                <li ng-repeat="(key, user) in users">
                                    <a ng-click="chooseFilterAuthor(user, key, user.checked)"">
                                    <img ng-if="user.profile.profile_pic != null" src="{{BASE_URL}}/img/profiles/{{user.profile.profile_pic}}">
                                    <img ng-if="!user.profile.profile_pic" src="{{BASE_URL}}/img/profile_avatar.jpg">
                                    {{user.profile.first_name}} {{user.profile.last_name}}
                                    <i ng-show="user.checked" class="fa fa-check pull-right green"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="filter_block">
                    <span class="dropdown-toggle task_operation" id="label" role="button" aria-haspopup="true" aria-expanded="false">
                    Labels
                    <b class="caret"></b>
                    </span>
                    <div class="dropdown">
                        <div class="dropdown-menu custom-dropdown" id="label" aria-labelledby="label">
                            <h2>Filter by label <a class="close_dropdown">X</a></h2>
                            <ul class="custom_dropdown_list nav nav-list">
                                <li ng-repeat="(key, label) in labels">
                                    <a ng-click="chooseFilterLabel(label, key, label.checked)"">{{label.name}} <i ng-show="label.checked" class="fa fa-check pull-right green"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="filter_block">
                    <span class="dropdown-toggle task_operation" id="label" role="button" aria-haspopup="true" aria-expanded="false">
                        Assigned
                        <b class="caret"></b>
                    </span>
                    <div class="dropdown">
                        <div class="dropdown-menu custom-dropdown" id="label" aria-labelledby="label">
                            <h2>Filter by who’s assigned <a class="close_dropdown">X</a></h2>
                            <ul class="custom_dropdown_list nav nav-list">
                                <li ng-repeat="(key, user) in users">
                                    <a ng-click="chooseFilterAssignee(user, key, user.checked)"">
                                    <img ng-if="user.profile.profile_pic != null" src="{{BASE_URL}}/img/profiles/{{user.profile.profile_pic}}">
                                    <img ng-if="!user.profile.profile_pic" src="{{BASE_URL}}/img/profile_avatar.jpg">
                                    {{user.profile.first_name}} {{user.profile.last_name}}
                                    <i ng-show="user.checked" class="fa fa-check pull-right green"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="filter_block">
                    <span class="dropdown-toggle task_operation" id="label" role="button" aria-haspopup="true" aria-expanded="false">
                        Sort
                        <b class="caret"></b>
                    </span>
                    <div class="dropdown">
                        <div class="dropdown-menu custom-dropdown" id="label" aria-labelledby="label">
                            <h2>Sort by <a class="close_dropdown">X</a></h2>
                            <ul class="custom_dropdown_list nav nav-list">
                                <li>
                                    <a ng-click="doFilter(filterQuery.sort_by = 'id', filterQuery.order_by = 'DESC')">Newest</a>
                                    <a ng-click="doFilter(filterQuery.sort_by = 'id', filterQuery.order_by = 'ASC')">Oldest</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

        </div>
        <div class="filter_options">
            <div class="filter_option_bar">
                <h2 ng-show="filterLabels.length > 0 || filtterAuthor.length > 0 || filtterAssignee.length > 0 || filterQuery.status == 'closed' || filterQuery.status == 'open' || filterQuery.unlabeled || filterQuery.unassigned">Filtered By:</h2>

                <ul class="filter_user">
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

        <div class="clearfix"></div>
        <table class="table task_list_table" ng-show="tasks.length > 0">
            <tbody>
            <tr ng-repeat="task in tasks">
                <td style="width: 50px;">
                    <a class="sl" href="{{BASE_URL}}tasks/view/{{task.id}}">#{{task.id}}</a>
                </td>
                <td style="width: 15px; padding-right: 0px;">
                    <i ng-show="task.status == 2" class="fa fa-bell-slash-o red" aria-hidden="true"></i>
                    <i ng-show="task.status != 2"  class="fa fa-bell-o green" aria-hidden="true"></i>
                </td>
                <td>
                    <strong>
                        <a href="{{BASE_URL}}tasks/view/{{task.id}}" ng-show="task.task">{{task.task}}</a>
                        <a href="{{BASE_URL}}tasks/view/{{task.id}}" ng-show="!task.task">-</a>
                        <label ng-repeat="label in task.labels" class="app_label" style="background: {{label.color_code}}">{{label.name}}</label>
                    </strong>
                    <br>
                    <small class="author">Opened by {{task.createdUserProfile.first_name}}
                        {{task.createdUserProfile.first_name}} at
                        {{task.created | date}}.
                        ({{task.created | date : 'HH:m a'}})
                    </small>
                </td>
                <td style="width: 10%;">
                    <span ng-repeat="user in task.users">
                        <img class="sm_avatar" ng-if="user.profile.profile_pic != null" src="{{BASE_URL}}/img/profiles/{{user.profile.profile_pic}}" />
                        <img class="sm_avatar" ng-if="!user.profile.profile_pic" src="{{BASE_URL}}/img/profile_avatar.jpg" />
                    </span>
                </td>
                <td class="text-right" style="width: 5%;">
                    <a href="{{BASE_URL}}tasks/view/{{task.id}}" class="icons green"><i class="fa fa-gear"></i></a>
                    <a ng-click="deleteTask(task.id)" class="icons red"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="empty_block" ng-show="tasks.length < 1">
            <span class="icon">
                <i class="fa fa-bullhorn" aria-hidden="true"></i>
            </span>
            <br/>
            <br/>
            <h2>Sorry! no result found</h2>
        </div>
    </div>

    <div class="col-lg-8 col-lg-offset-2" ng-show="count_all < 1">
        <div class="empty_block">
            <span class="icon">
                <i class="fa fa-bullhorn" aria-hidden="true"></i>
            </span>
            <br/>
            <br/>
            <h2>Welcome to Task!</h2>
            <p class="lead">Task are used to manage your tasks list. You can create your task list with proper labelling
                and then assign into user. After completing each task you can marked them as closed/reopened. It also
                allowed to comments on task</p>
            <br/>
            <a class="btn-lg-theme" href="{{BASE_URL}}tasks/add">Create first task</a>
        </div>
    </div>
</div>

<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/TasksCtrl']);
echo $this->end();
?>
