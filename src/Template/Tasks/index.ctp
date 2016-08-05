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
        <div class="col-lg-6">
            <div class="well">
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
        <div class="col-lg-4"></div>
    </div>
</div>

<?php
echo $this->start('cssTop');
echo $this->Html->css(['trix']);
echo $this->end();

echo $this->start('jsTop');
echo $this->Html->script(['angular.min']);
?>
<script src='http://cdnjs.cloudflare.com/ajax/libs/textAngular/1.5.0/textAngular-rangy.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/textAngular/1.5.0/textAngular-sanitize.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/textAngular/1.5.0/textAngular.min.js'></script>
<?php
echo $this->Html->script(['application']);
echo $this->end();
?>
