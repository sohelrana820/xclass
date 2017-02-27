<?php echo $this->assign('title', 'Email Notification'); ?>

<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Configure Email Notification', ['controller' => 'settings', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<?php echo $this->Form->create(null, ['url' => ['controller' => 'settings', 'action' => 'email'], 'type' => 'file']);?>
<div class="row">
    <div class="col-lg-6">
        <!-- List group -->
        <ul class="list-group">
            <li class="list-group-item">
                Send email when create project?
                <div class="material-switch pull-right">
                    <input name="create_project" type="checkbox" checked value="1"/>
                    <label class="label-success"></label>
                </div>
            </li>
            <li class="list-group-item">
                Send email when update project statue?
                <div class="material-switch pull-right">
                    <input name="update_project_status" type="checkbox" checked value="1"/>
                    <label class="label-success"></label>
                </div>
            </li>
        </ul>
    </div>
</div>
<button type="submit" class="btn btn-success">Update</button>
<?php echo $this->Form->end();?>











