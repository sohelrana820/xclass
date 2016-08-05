<?php echo $this->assign('title', 'Manage Task');?>

<div class="page-header">
    <h2 class="title pull-left">
        Manage Task
    </h2>
    <div class="pull-right btn-areas">

    </div>
    <div class="clearfix"></div>
</div>

<div ng-controller="TaskCtrl">
    <div class="row">
        <div class="col-lg-6 col-md-8">
            <div class="wefll">
                <form>
                    <div class="form-group">
                        <label>Title</label>
                        <div class="input text">
                            <input type="text" ng-model="task.task" class="form-control" placeholder="Title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <div class="input text">
                            <text-angular ng-model="task.description" ng-model="htmlVariable"></text-angular>
                        </div>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-success" ng-click="saveTask()">SAVE</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-2 col-md-4">
            <div class="task_sidebar well" style="margin-top: 25px">
                <div class="dropdown">
                    <h2 class="dropdown-toggle" id="label"data-toggle="dropdown" role="button"aria-haspopup="true" aria-expanded="false">
                        Labels
                        <i class="fa fa-gear pull-right"></i>
                    </h2>
                    <div>
                        <small class="red">Not set yet!</small>
                    </div>
                    <ul class="dropdown-menu" id="label" aria-labelledby="label">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <h2 class="dropdown-toggle" id="label"data-toggle="dropdown" role="button"aria-haspopup="true" aria-expanded="false">
                        Labels
                        <i class="fa fa-gear pull-right"></i>
                    </h2>
                    <ul class="dropdown-menu" id="label" aria-labelledby="label">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                    <div>
                        <ul class="old_status">
                            <li style="background: red;">Bug <span ng-click="remove()">X</span></li>
                            <li style="background: yellowgreen">Duplicate <span ng-click="remove()">X</span></li>
                            <li style="background: #000;">Duplicate <span ng-click="remove()">X</span></li>
                        </ul>
                    </div>
                </div>
                <div class="dropdown">
                    <h2 class="dropdown-toggle" id="label"data-toggle="dropdown" role="button"aria-haspopup="true" aria-expanded="false">
                        Labels
                        <i class="fa fa-gear pull-right"></i>
                    </h2>
                    <div>
                        <small class="red">Not set yet!</small>
                    </div>
                    <ul class="dropdown-menu" id="label" aria-labelledby="label">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo $this->start('cssTop');
echo $this->end();

echo $this->start('jsTop');
echo $this->Html->script(['angular.min', 'textAngular-rangy.min.js', 'textAngular-sanitize.min.js', 'textAngular.min.js']);
echo $this->Html->script(['application']);
echo $this->end();
?>
