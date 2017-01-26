<?php echo $this->assign('title', 'Manage User'); ?>

<div ng-controller="ProjectsCtrl">
    <div class="page-header">
        <h2 class="title pull-left">
            <?php echo $this->Html->link($project->name, ['controller' => 'projects', 'action' => 'view', $project->slug], ['class' => 'link']); ?>
        </h2>
        <div class="clearfix"></div>
        <div class="center_loader" ng-show="show_center_loader">
            <h4>Please wait...</h4>
        </div>
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
                            <img ng-if="show_user_refresh_loader" ng-src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                        </a>

                        <a class="add_more btn-theme-xs-rev pull-right" ng-click="visible_assign_box = false">
                            New User <i class="fa fa-plus"></i>
                        </a>
                    </div>

                    <div class="search_project_user">
                        <input class="form-control" ng-model="user_query" ng-change="searchUser(user_query)" placeholder="Search user">
                        <img ng-if="show_user_search_loader" ng-src="{{BASE_URL}}/img/loader-blue.gif" class="sm_loader">
                    </div>

                    <div class="project_user_section">
                        <ul class="project_user_nav_list" ng-show="users.length > 0 && user_query">
                            <li ng-repeat="(key, user) in users">
                                <div ng-click="assignProjectUser(user.id);">
                                    <img ng-if="user.profile.profile_pic != null" ng-src="{{BASE_URL}}/img/profiles/{{user.profile.profile_pic}}">
                                    <img ng-if="!user.profile.profile_pic" ng-src="{{BASE_URL}}/img/profile_avatar.jpg">
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
                            <img ng-if="projectUser.profile.profile_pic" ng-src="{{BASE_URL}}img/profiles/{{projectUser.profile.profile_pic}}"  class="img-responsive"/>
                            <img ng-if="!projectUser.profile.profile_pic" ng-src="{{BASE_URL}}img/profile_avatar.jpg" class="img-responsive"/>
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
echo $this->Html->script(['src/ProjectsCtrl']);
echo $this->end();
?>

