<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Email Settings', ['controller' => 'settings', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<?php echo $this->Form->create(null, ['url' => ['controller' => 'settings', 'action' => 'email'], 'type' => 'file']);?>
<div class="row">
    <div class="col-lg-6">
        <table class="table">
            <thead>
                <th>Title</th>
                <th>Yes</th>
                <th>No</th>
            </thead>
            <tbody>
                <tr>
                    <td>Send email when new project will create?</td>
                    <td><input type="radio" name="create_project" value="1" <?php if(isset($metas['create_project']) &&  $metas['create_project'] == 1) {echo 'checked';}?>/></td>
                    <td><input type="radio" name="create_project" value="0" <?php if(isset($metas['create_project']) &&  $metas['create_project'] == 0) {echo 'checked';}?>/></td>
                </tr>
                <tr>
                    <td>Send email when project's status will update?</td>
                    <td><input type="radio" name="update_project_status" value="1" <?php if(isset($metas['update_project_status']) &&  $metas['update_project_status'] == 1) {echo 'checked';}?>/></td>
                    <td><input type="radio" name="update_project_status" value="0" <?php if(isset($metas['update_project_status']) &&  $metas['update_project_status'] == 0) {echo 'checked';}?>/></td>
                </tr>
                <tr>
                    <td>Send email when project's status will delete?</td>
                    <td><input type="radio" name="delete_project_status" value="1" <?php if(isset($metas['delete_project_status']) &&  $metas['delete_project_status'] == 1) {echo 'checked';}?>/></td>
                    <td><input type="radio" name="delete_project_status" value="0" <?php if(isset($metas['delete_project_status']) &&  $metas['delete_project_status'] == 0) {echo 'checked';}?>/></td>
                </tr>
                <tr>
                    <td>Send email when open new task?</td>
                    <td><input type="radio" name="open_new_task" value="1" <?php if(isset($metas['open_new_task']) &&  $metas['open_new_task'] == 1) {echo 'checked';}?>/></td>
                    <td><input type="radio" name="open_new_task" value="0" <?php if(isset($metas['open_new_task']) &&  $metas['open_new_task'] == 0) {echo 'checked';}?>/></td>
                </tr>
                <tr>
                    <td>Send email when close task?</td>
                    <td><input type="radio" name="closed_task" value="1" <?php if(isset($metas['closed_task']) &&  $metas['closed_task'] == 1) {echo 'checked';}?>/></td>
                    <td><input type="radio" name="closed_task" value="0" <?php if(isset($metas['closed_task']) &&  $metas['closed_task'] == 0) {echo 'checked';}?>/></td>
                </tr>
                <tr>
                    <td>Send email when reopened task?</td>
                    <td><input type="radio" name="reopened_task" value="1" <?php if(isset($metas['reopened_task']) &&  $metas['reopened_task'] == 1) {echo 'checked';}?>/></td>
                    <td><input type="radio" name="reopened_task" value="0" <?php if(isset($metas['reopened_task']) &&  $metas['reopened_task'] == 0) {echo 'checked';}?>/></td>
                </tr>
                <tr>
                    <td>Send email when assigned user to project?</td>
                    <td><input type="radio" name="assign_user_to_project" value="1" <?php if(isset($metas['assign_user_to_project']) &&  $metas['assign_user_to_project'] == 1) {echo 'checked';}?>/></td>
                    <td><input type="radio" name="assign_user_to_project" value="0" <?php if(isset($metas['assign_user_to_project']) &&  $metas['assign_user_to_project'] == 0) {echo 'checked';}?>/></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<button type="submit" class="btn btn-success">Update Configuration</button>
<?php echo $this->Form->end();?>