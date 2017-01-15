<?php echo $this->assign('title', 'Manage User'); ?>

<div ng-controller="ProjectsCtrl">
    <div class="page-header">
        <h2 class="title pull-left">
            <?php echo $this->Html->link($project->name, ['controller' => 'projects', 'action' => 'view', $project->slug], ['class' => 'link']); ?>
        </h2>
        <div class="clearfix"></div>
    </div>

    <div ng-show="assignUserMode || projectsUsers.users.length > 0">
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

    <div class="row" ng-show="projectsUsers.users.length < 1">
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

    <div class="widget">
        <div class="widget-header">
            <div class="pull-left">
                <h2>Assigned User List</h2>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="widget-body">
            <div class="row">
                <div class="col-sm-4" ng-repeat="projectUser in projectsUsers.users">
                    <div class="profile-block">
                        <div class="row">
                            <div class="col-md-4">
                                <img ng-show="projectUser.user.profile.profile_pic" src="{{BASE_URL}}img/profiles/{{projectUser.user.profile.profile_pic}}" alt="{{projectUser.user.profile.first_name}} {{projectUser.user.profile.last_name}}" class="img-rounded img-responsive"/>
                                <img ng-show="!projectUser.user.profile.profile_pic" src="{{BASE_URL}}img/profile_avatar.jpg" alt="{{projectUser.user.profile.first_name}} {{projectUser.user.profile.last_name}}" class="img-rounded img-responsive"/>
                            </div>
                            <div class="col-md-8">
                                <h4><a href="{{BASE_URL}}users/view/{{projectUser.user.uuid}}">{{projectUser.user.profile.first_name}} {{projectUser.user.profile.last_name}}</a></h4>
                                <p>
                                    <i class="fa fa-envelope"></i> {{projectUser.user.username}}
                                    <br/>
                                    <i class="fa fa-phone"></i> {{projectUser.user.profile.phone ? projectUser.user.profile.phone : 'N/A'}}
                                    <br/>
                                    <label class="label label-success" ng-show="user.status == 1">Active</label>
                                    <label class="label label-danger" ng-show="user.status == 2">Inacive</label>
                                </p>
                                <!-- Split button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary">Action</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span><span class="sr-only">Action</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Remove</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Disabled</a></li>
                                    </ul>
                                </div>
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
echo $this->Html->script(['src/ProjectsCtrl']);
echo $this->end();
?>

