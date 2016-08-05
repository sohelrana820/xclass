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
            <form>
                <div class="form-group">
                    <label>Title</label>
                    <div class="input text">
                        <input type="text" name="profile" class="form-control" placeholder="Title">
                    </div>
                </div>
                {{task}}
                <div class="form-group">
                    <label>Title</label>
                    <div class="input text">
                        <trix-editor angular-trix ng-model="foo"></trix-editor>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>

<?php
echo $this->start('cssTop');
echo $this->Html->css(['trix']);
echo $this->end();

echo $this->start('jsTop');
echo $this->Html->script(['angular.min', 'trix', 'application']);
echo $this->end();
?>
