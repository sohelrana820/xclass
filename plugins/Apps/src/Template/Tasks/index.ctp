<?php echo $this->assign('title', 'Manage Task');?>

<div class="page-header">
    <h2 class="title pull-left">
        Manage Task
    </h2>
    <div class="pull-right btn-areas">

    </div>
    <div class="clearfix"></div>
</div>

<div ng-controller="TasksCtrl">
    <div class="row">
        <div class="col-lg-6 col-md-8">
            <div class="">
                <form>
                    <div class="form-group">
                        <label>Title</label>
                        <div class="input text">
                            <input type="text" ng-model="TaskObj.task" class="form-control" placeholder="Title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <div class="input text">
                            <text-angular ng-model="TaskObj.description" ng-model="htmlVariable"></text-angular>
                        </div>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-success" ng-click="saveTask()">SAVE</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-2 col-md-4">
            <div class="task_sidebar" style="margin-top: 25px">

                <div class="single_block">
                    <h2 class="dropdown-toggle task_operation" id="label" role="button" aria-haspopup="true" aria-expanded="false">
                        Labels
                        <i class="fa fa-gear pull-right"></i>
                    </h2>
                    <small class="red" ng-show="taskLabels.length < 1">Label not set yet!</small>
                    <div class="dropdown">
                        <div class="dropdown-menu custom-dropdown" id="label" aria-labelledby="label">
                            <h2>Apply label <a class="close_dropdown">X</a></h2>
                            <ul class="task_label_list nav nav-list">
                                <li ng-repeat="(key, label) in labels">
                                    <a ng-click="chooseTaskLabels(label, key, label.checked)"">{{label.name}} <i ng-show="label.checked" class="fa fa-check pull-right green"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <ul class="task_labels" ng-show="taskLabels.length > 0">
                            <li ng-repeat="taskLabel in taskLabels" style="background: {{taskLabel.color_code}};">{{taskLabel.name}} <span ng-click="removeTaskLabels(taskLabel)">X</span></li>
                        </ul>
                    </div>
                </div>

                <div class="single_block">
                    <h2 class="dropdown-toggle task_operation" id="label" role="button" aria-haspopup="true" aria-expanded="false">
                        Users
                        <i class="fa fa-gear pull-right"></i>
                    </h2>
                    <small class="red">User not assigned yet!</small>
                    <div class="dropdown">
                        <div class="dropdown-menu custom-dropdown" id="label" aria-labelledby="label">
                            <h2>Assign task to user <a class="close_dropdown">X</a></h2>
                            <ul class="task_label_list nav nav-list">
                                <li><a href="#">Action </a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <!--<ul class="task_users">
                            <li><img src="img/profile_avatar.jpg">@Sohel Rana</li>
                            <li><img src="img/profile_avatar.jpg">@Shaharia Azam</li>
                            <li><img src="img/profile_avatar.jpg">@Shaharia Azam</li>
                        </ul>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo $this->start('jsBottom');
echo $this->Html->script(['textAngular-rangy.min.js', 'textAngular-sanitize.min.js', 'textAngular.min.js']);
echo $this->Html->script(['src/TasksCtrl']);
echo $this->end();
?>
