<?php echo $this->assign('title', 'Manage Task');?>

<div class="page-header">
    <h2 class="title pull-left">
        Manage Task
    </h2>
    <div class="pull-right btn-areas">
        <?php echo $this->Html->link('New User', ['controller' => 'users', 'action' => 'add'], ['class' => 'btn btn-info']) ?>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#searchUserModal">Search User
        </button>
    </div>
    <div class="clearfix"></div>
</div>

<div ng-controller="TaskCtrl">
    {{task}}
</div>

<?php
echo $this->start('jsBottom');
echo $this->Html->script(['angular.min']);
echo $this->Html->script(['application.js']);
echo $this->end();
?>
