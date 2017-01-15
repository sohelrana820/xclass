<?php echo $this->assign('title', 'Manage User'); ?>

<div ng-controller="ProjectsCtrl">
    <div class="page-header">
        <h2 class="title pull-left">
            <?php echo $this->Html->link($project->name, ['controller' => 'projects', 'action' => 'view', $project->slug], ['class' => 'link']); ?>
        </h2>
        <div class="clearfix"></div>
    </div>

    <div class="row" ng-show="!assignUserMode && projectsUsers.count < 1">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="empty_block">
            <span class="icon">
                <i class="fa fa-bell-o" aria-hidden="true"></i>
            </span>
                <br/>
                <br/>
                <h2>Welcome to Project's Users!</h2>
                <p class="lead">Assign user to project, whom will responsible for accomplish the project. You can
                    distribute your project's task to assigned user for better management of project</p>
                <br/>
                <a class="btn-lg-theme" ng-click="assignUserMode = true">Assign first user</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <div ng-show="assignUserMode || projectsUsers.count > 0">
                <div class="assign_user_title">
                    <h2>Assign new user</h2>
                    <a class="refresh_area">
                        <span class="add_new_label" ng-click="refreshUserList()" title="Refresh User List">
                            <i class="fa fa-refresh grey"></i>
                        </span>
                        <img ng-show="show_user_refresh_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                    </a>
                </div>

                <div class="search_project_user">
                    <input class="form-control" ng-model="user_query" ng-change="searchUser(user_query)" placeholder="Search user">
                    <img ng-show="show_user_search_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                </div>

                <ul class="project_user_nav_list" ng-show="users.length > 0 && user_query">
                    <li ng-repeat="(key, user) in users">
                        <div ng-click="assignProjectUser(user.id); refreshUserList()">
                            <img ng-if="user.profile.profile_pic != null" src="{{BASE_URL}}/img/profiles/{{user.profile.profile_pic}}">
                            <img ng-if="!user.profile.profile_pic" src="{{BASE_URL}}/img/profile_avatar.jpg">
                            <div>
                                <strong><a>{{user.profile.first_name}} {{user.profile.last_name}}</a></strong>
                                <br/>
                                <small>{{user.username}}</small>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </li>
                </ul>
                <p style="font-size: 10px; margin-top: 10px;" ng-show="users.length < 1" class="red text-uppercase not-found" ng-show="taskLabels.length < 1">User not found</p>
                <br/><br/>
            </div>
        </div>

        <div class="col-lg-5" ng-show="projectsUsers.count > 0">
            <div class="assign_user_title" style="margin-bottom: 20px">
                <h2>Assigned User List</h2>
            </div>
            <ul class="project_user_nav_list project_assigned_user_list">
                <li ng-repeat="projectUser in projectsUsers.users">
                    <div ng-click="assignProjectUser(user.id); refreshUserList()">
                        <img ng-show="projectUser.user.profile.profile_pic" src="{{BASE_URL}}img/profiles/{{projectUser.user.profile.profile_pic}}"  class="img-rounded img-responsive"/>
                        <img ng-show="!projectUser.user.profile.profile_pic" src="{{BASE_URL}}img/profile_avatar.jpg" class="img-rounded img-responsive"/>
                        <div>
                            <strong><a>{{projectUser.user.profile.first_name}} {{projectUser.user.profile.last_name}}</a></strong>
                            <br/>
                            <small>{{projectUser.user.username}}</small>
                        </div>
                        <div class="clearfix"></div>
                        <a class="remove_user">X</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/ProjectsCtrl']);
echo $this->end();
?>

