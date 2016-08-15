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

    <div class="col-lg-12 col-md-12">
        <div class="filter_bar">

            <a class="close_task" ng-click="doFilter(filterQuery.status = 'closed')">
                <i class="fa fa-bell-slash-o red" aria-hidden="true"></i>
                Closed
            </a>

            <a class="open_task" ng-click="doFilter(filterQuery.status = 'open')">
                <i class="fa fa-bell-o green" aria-hidden="true"></i>
                Open
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
                                    <a ng-click="chooseAuthor(user, key, user.checked)"">
                                    <img ng-if="user.profile.profile_pic != null" src="/img/profiles/{{user.profile.profile_pic}}">
                                    <img ng-if="!user.profile.profile_pic" src="/img/profile_avatar.jpg">
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
                                    <a ng-click="chooseAssignee(user, key, user.checked)"">
                                    <img ng-if="user.profile.profile_pic != null" src="/img/profiles/{{user.profile.profile_pic}}">
                                    <img ng-if="!user.profile.profile_pic" src="/img/profile_avatar.jpg">
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
                                    <a ng-click="chooseTaskUsers(user, key, user.checked)"">Newest</a>
                                    <a ng-click="chooseTaskUsers(user, key, user.checked)"">Oldest</a>
                                    <a ng-click="chooseTaskUsers(user, key, user.checked)"">Recently updated</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

        </div>
        <table class="table task_list_table" ng-show="tasks.length > 0">
            <tbody>
            <tr ng-repeat="task in tasks">
                <td style="width: 50px;">
                    <a class="sl" href="/tasks/view/{{task.id}}">#{{task.id}}</a>
                </td>
                <td style="width: 15px; padding-right: 0px;">
                    <i ng-show="task.status == 2" class="fa fa-bell-slash-o red" aria-hidden="true"></i>
                    <i ng-show="task.status != 2"  class="fa fa-bell-o green" aria-hidden="true"></i>
                </td>
                <td>
                    <strong>
                        <a href="/tasks/view/{{task.id}}">{{task.task}}</a>
                        <label ng-repeat="label in task.labels" class="app_label" style="background: {{label.color_code}}">{{label.name}}</label>
                    </strong>
                    <br>
                    <small class="author">Opened by {{task.createdUserProfile.first_name}}
                        {{task.createdUserProfile.first_name}} at
                        {{task.created | date}}.
                        ({{task.created | date : 'HH:m a'}})
                    </small>
                </td>
                <td>
                    <span ng-repeat="user in task.users">
                        <img class="sm_avatar" ng-if="user.profile.profile_pic != null" src="/img/profiles/{{user.profile.profile_pic}}" />
                        <img class="sm_avatar" ng-if="!user.profile.profile_pic" src="/img/profile_avatar.jpg" />
                    </span>
                </td>
                <td>
                    <span>
                        <i class="fa fa-comments"></i> {{task.comments.length}}
                    </span>
                </td>
                <td class="text-right">
                    <a href="/tasks/view/{{task.id}}" class="icons green"><i class="fa fa-gear"></i></a>
                    <a ng-click="deleteTask(task.id)" class="icons red"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            </tbody>
        </table>
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
            <a class="btn btn-success" href="/tasks/add">Create first task</a>
        </div>
    </div>
</div>

<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/TasksCtrl']);
echo $this->end();
?>
