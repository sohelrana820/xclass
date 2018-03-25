<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Manage User', ['controller' => 'users', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>Update User</h2>
            <span> Last update:
                <?php echo $this->Time->format($user->profile->modified, 'dd MMM, Y');?>
                (<?php echo $this->Time->format($user->profile->modified, 'h:mm a');?>)
                <span>
        </div>
        <div class="pull-right btn-areas btn-margin">
            <?php
            echo $this->Html->link('New User', ['controller' => 'users', 'action' => 'add'], ['class' => 'btn btn-info']);

            echo $this->Html->link('View User', ['controller' => 'users', 'action' => 'view', $user->uuid], ['class' => 'btn btn-info']);

            echo $this->Html->link('Change Password', ['controller' => 'users', 'action' => 'c_password', $user->uuid], ['class' => 'btn btn-info']);

            echo $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->uuid], ['escape' => false, 'class' => 'btn btn-info', 'confirm' => __('Are you sure you want to delete # {0}?', $user->profile->first_name . ' ' . $user->profile->last_name)]);

            echo $this->Html->link('Users List', ['controller' => 'users', 'action' => 'index'], ['class' => 'btn btn-info']);
            ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <div class="row">
            <!-- left column -->
            <div class="col-md-2 col-sm-4 col-xs-12">
                <?php echo $this->element('user_profile_photo');?>
            </div>
            <!-- edit form column -->
            <div class="col-md-10 col-sm-8 col-xs-12 personal-info">
                <?php echo $this->Form->create(null, ['url' => ['controller' => 'users', 'action' => 'c-password/'.$user->uuid]]);?>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Password</label>
                            <?php echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'label' => false, 'required' => false]);?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Confirm password</label>
                            <?php echo $this->Form->input('cPassword', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirm password', 'label' => false, 'required' => false]);?>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Change Password</button>
                <?php echo $this->Form->end();?>
            </div>
        </div>
    </div>
</div>