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
            <div ng-init="visible_assign_box = true;" ng-show="visible_assign_box">
                <div ng-show="assignUserMode || projectsUsers.count > 0">
                    <div class="assign_user_title">
                        <h2>Assign new user</h2>
                        <a class="refresh_area">
                        <span class="add_new_label" ng-click="refreshUserList()" title="Refresh User List">
                            <i class="fa fa-refresh grey"></i>
                        </span>
                            <img ng-show="show_user_refresh_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                        </a>

                        <a class="add_more btn-theme-xs-rev pull-right" ng-click="visible_assign_box = false">
                            New User <i class="fa fa-plus"></i>
                        </a>
                    </div>

                    <div class="search_project_user">
                        <input class="form-control" ng-model="user_query" ng-change="searchUser(user_query)" placeholder="Search user">
                        <img ng-show="show_user_search_loader" src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                    </div>

                    <div class="project_user_section">
                        <ul class="project_user_nav_list" ng-show="users.length > 0 && user_query">
                            <li ng-repeat="(key, user) in users">
                                <div ng-click="assignProjectUser(user.id);">
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
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="widget" ng-show="!visible_assign_box">
                <div class="widget-header">
                    <h2>Create & Assign User</h2>
                </div>
                <div class="widget-body">
                    <form ng-submit="createUser()">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>First name</label>
                                    <div class="input text">
                                        <input type="text" name="first_name" ng-model="userObj.profile.first_name" class="form-control" required placeholder="First name" maxlength="20">
                                        <div class="error-message" ng-show="createUsersErrors.profile.first_name">
                                            <span ng-repeat="message in createUsersErrors.profile.first_name">{{message}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Last name</label>
                                    <div class="input text">
                                        <input type="text" name="last_name" ng-model="userObj.profile.last_name" class="form-control" required placeholder="Last name" maxlength="20">
                                        <div class="error-message" ng-show="createUsersErrors.profile.last_name">
                                            <span ng-repeat="message in createUsersErrors.profile.last_name">{{message}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email address</label>
                                    <div class="input text">
                                        <input type="email" name="username" ng-model="userObj.username" class="form-control" required placeholder="Email address">
                                        <div class="error-message" ng-show="createUsersErrors.username">
                                            <span ng-repeat="message in createUsersErrors.username">{{message}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <div class="input text">
                                        <input type="text" name="phone" ng-model="userObj.phone" class="form-control" placeholder="Phone number">
                                        <div class="error-message" ng-show="createUsersErrors.phone">
                                            <span ng-repeat="message in createUsersErrors.phone">{{message}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input password">
                                        <input type="password" ng-model="userObj.password" class="form-control" required placeholder="Password">
                                        <div class="error-message" ng-show="createUsersErrors.password">
                                            <span ng-repeat="message in createUsersErrors.password">{{message}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Confirm password</label>
                                    <div class="input password">
                                        <input type="password" ng-model="userObj.cPassword" class="form-control" required placeholder="Confirm password">
                                        <div class="error-message" ng-show="createUsersErrors.cPassword">
                                            <span ng-repeat="message in createUsersErrors.cPassword">{{message}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Save User</button>
                        <button type="submit" class="btn btn-default" ng-click="visible_assign_box = true">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-5" ng-show="projectsUsers.count > 0">
            <div class="assign_user_title" style="margin-bottom: 20px">
                <h2>Assigned User List ({{projectsUsers.count}} user assigned)</h2>
            </div>
            <div class="clearfix"></div>
            <div class="project_user_section">
                <ul class="project_user_nav_list project_assigned_user_list">
                    <li ng-repeat="projectUser in projectsUsers.users">
                        <div>
                            <img ng-show="projectUser.profile.profile_pic" src="{{BASE_URL}}img/profiles/{{projectUser.profile.profile_pic}}"  class="img-responsive"/>
                            <img ng-show="!projectUser.profile.profile_pic" src="{{BASE_URL}}img/profile_avatar.jpg" class="img-responsive"/>
                            <div>
                                <strong><a>{{projectUser.profile.first_name}} {{projectUser.profile.last_name}}</a></strong>
                                <br/>
                                <small>{{projectUser.username}}</small>
                            </div>
                            <div class="clearfix"></div>
                            <a class="remove_user" ng-click="removeProjectUser(projectUser.id)">X</a>
                        </div>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>



<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/ProjectsCtrl', 'src/UsersCtrl']);
echo $this->end();
?>

