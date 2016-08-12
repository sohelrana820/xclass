<?php echo $this->assign('title', 'Manage Label');?>


<div ng-controller="LabelsCtrl">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="empty_block">
                <span class="icon">
                    <i class="fa fa-bullhorn" aria-hidden="true"></i>
                </span>
                <br/>
                <br/>
                <h2>Welcome to Issues!</h2>
                <p class="lead">Issues are used to track todos, bugs, feature requests, and more. As issues are created, they’ll appear here in a searchable and filterable list. To get started, you should create an issue.</p>
                <a class="btn btn-success">Create first label</a>
            </div>
        </div>
    </div>
</div>

<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/LabelsCtrl']);
echo $this->end();
?>
