<?php echo $this->assign('title', 'Change Password'); ?>

    <div class="page-header">
        <h2 class="title pull-left">
            <?php echo $this->Html->link('Manage Profile', ['controller' => 'profile', 'action' => 'index'], ['class' => 'link']);?>
        </h2>
        <div class="clearfix"></div>
    </div>
    <div class="widget">
        <div class="widget-header">
            <div class="pull-left">
                <h2>Change Password</h2>
                <span>Change your password</span>
            </div>
            <div class="pull-right btn-areas btn-margin">
                <?php
                echo $this->Html->link('My Profile', ['controller' => 'profile', 'action' => 'index'], ['class' => 'btn btn-info', 'escape' => false]);

                echo $this->Html->link('Update Profile', ['controller' => 'profile', 'action' => 'update'], ['class' => 'btn btn-info', 'escape' => false]);

                echo $this->Html->link('Change Password', ['controller' => 'profile', 'action' => 'change_password'], ['class' => 'btn btn-info', 'escape' => false]);
                ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="widget-body">
            <div class="row">
                <!-- left column -->
                <div class="col-md-2 col-sm-4 col-xs-12">
                    <?php echo $this->element('profile_photo');?>
                </div>
                <!-- edit form column -->
                <div class="col-md-10 col-sm-8 col-xs-12 personal-info">
                    <div class="card-body">
                        <?php
                        echo $this->Form->create($profile,
                            [
                                'url' => [
                                    'controller' => 'users',
                                    'action' => 'changeProfilePassword',
                                ],
                                'class' => 'login_form'
                            ]
                        );
                        ?>
                        <div class="form-group">
                            <label>Current Password</label>
                            <?php
                            echo $this->Form->input('current_password',
                                [
                                    'type' => 'password',
                                    'class' => 'form-control',
                                    'placeholder' => 'Current password',
                                    'label' => false,
                                    'required' => false
                                ]
                            );
                            ?>

                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <?php
                            echo $this->Form->input('new_password',
                                [
                                    'type' => 'password',
                                    'class' => 'form-control',
                                    'placeholder' => 'New password',
                                    'label' => false,
                                    'required' => false,
                                ]
                            );
                            ?>

                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <?php
                            echo $this->Form->input('new_cPassword',
                                [
                                    'type' => 'password',
                                    'class' => 'form-control',
                                    'placeholder' => 'New password confirm',
                                    'label' => false,
                                    'required' => false,
                                ]
                            );
                            ?>
                        </div>

                        <div class="login-button">
                            <input type="submit" class="btn btn-success" value="Change Password">
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php
$this->start('cssTop');
$this->end();

$this->start('jsTop');
$this->end();

$this->start('jsBottom');
?>

<?php $this->end(); ?>