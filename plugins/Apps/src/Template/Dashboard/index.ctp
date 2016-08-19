<?php echo $this->assign('title', 'My Dashboard'); ?>

<div class="page-header">
    <h2 class="title pull-left">
        Dashboard
        <p class="sub-title"></p>
    </h2>
    <div class="pull-right btn-areas">

    </div>
    <div class="clearfix"></div>
</div>


<?php if($overview['total_user'] < 2):?>
<div class="alert alert-warning alert-dismissible fade in text-left static_message" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong>Create First User:</strong>  You didn't create any user yet!. Please <?php echo $this->Html->link('click here', ['controller' => 'users', 'action' => 'add']);?> to create your first user.
</div>
<?php endif;?>

<?php if($overview['total_label'] < 1):?>
    <div class="alert alert-warning alert-dismissible fade in text-left static_message" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>Create First Label:</strong>  You didn't create any label yet!. Please <?php echo $this->Html->link('click here', ['controller' => 'labels', 'action' => 'index']);?> to create your first label
    </div>
<?php endif;?>

<?php if($overview['total_task'] < 1):?>
    <div class="alert alert-warning alert-dismissible fade in text-left static_message" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>Create First Task:</strong>  You didn't create any task yet!. Please <?php echo $this->Html->link('click here', ['controller' => 'tasks', 'action' => 'index']);?> to create your first task
    </div>
<?php endif;?>
