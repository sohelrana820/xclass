<?php echo $this->assign('title', 'Task Details'); ?>

<div ng-controller="ProjectsCtrl">
    <div class="page-header">
        <h2 class="title pull-left">
            <?php echo $this->Html->link($project->name, ['controller' => 'projects', 'action' => 'view', $project->slug], ['class' => 'link']); ?>
        </h2>
        <div class="clearfix"></div>
    </div>

    <div class="row">
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
                <a class="btn-lg-theme" ng-click="switchTaskView('create')">Assign first user</a>
            </div>
        </div>
    </div>

    <div class="col-sm-4" ng-repeat="user in projectsUsers.users">
        <div class="profile-block">
            <div class="row">
                <div class="col-md-4">
                    <img ng-show="user.user.profile.profile_pic" src="{{BASE_URL}}img/profiles/{{user.user.profile.profile_pic}}" alt="{{user.user.profile.first_name}} {{user.user.profile.last_name}}" class="img-rounded img-responsive"/>
                    <img ng-show="!user.user.profile.profile_pic" src="{{BASE_URL}}img/profile_avatar.jpg" alt="{{user.user.profile.first_name}} {{user.user.profile.last_name}}" class="img-rounded img-responsive"/>
                </div>
                <div class="col-md-8">
                    <h4><a href="{{BASE_URL}}users/view/{{user.user.uuid}}">{{user.user.profile.first_name}} {{user.user.profile.last_name}}</a></h4>
                    <p>
                        <i class="fa fa-envelope"></i> {{user.user.username}}
                        <br/>
                        <i class="fa fa-phone"></i> {{user.user.profile.phone ? user.user.profile.phone : 'N/A'}}
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

<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/ProjectsCtrl']);
echo $this->end();
?>

