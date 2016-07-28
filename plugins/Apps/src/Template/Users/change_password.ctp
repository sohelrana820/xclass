<?php echo $this->assign('title', 'Change Password'); ?>




<?php echo $this->assign('title', 'My Profile'); ?>

    <div class="page-title">
        <span class="title">Change Password</span>
        <div class="description">Change your old password</div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <?php
                        echo $this->Html->link('My Profile', ['controller' => 'users', 'action' => 'profile'], ['class' => 'btn btn-primary btn-theme', 'escape' => false]);

                        echo $this->Html->link('Update Profile', ['controller' => 'users', 'action' => 'update'], ['class' => 'btn btn-primary btn-theme', 'escape' => false]);

                        echo $this->Html->link('Change Password', ['controller' => 'users', 'action' => 'change_password'], ['class' => 'btn btn-primary btn-theme', 'escape' => false]);
                        ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <?php echo $this->element('profile_photo');?>
                        </div>
                        <!-- edit form column -->
                        <div class="col-md-9 col-sm-6 col-xs-12 personal-info">
                            <div class="card-body">
                                <?php
                                echo $this->Form->create($user,
                                    [
                                        'controller' => 'users',
                                        'action' => 'change_password',
                                        'class' => 'login_form'
                                    ]
                                );
                                ?>
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->input('current_password',
                                        [
                                            'type' => 'password',
                                            'class' => 'form-control',
                                            'placeholder' => 'Old Password',
                                            'label' => false,
                                            'required' => false
                                        ]
                                    );
                                    ?>
                                    <p class="help-text">Hints: Current Password <span class="red">(required)</span></p>

                                </div>
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->input('new_password',
                                        [
                                            'type' => 'password',
                                            'class' => 'form-control',
                                            'placeholder' => 'New Password',
                                            'label' => false,
                                            'required' => false,
                                        ]
                                    );
                                    ?>
                                    <p class="help-text">Hints: New password <span class="red">(required)</span></p>

                                </div>
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->input('new_cPassword',
                                        [
                                            'type' => 'password',
                                            'class' => 'form-control',
                                            'placeholder' => 'New Password Confirm',
                                            'label' => false,
                                            'required' => false,
                                        ]
                                    );
                                    ?>
                                    <p class="help-text">Hints: Confirm new password <span class="red">(required)</span></p>

                                </div>

                                <div class="login-button">
                                    <input type="submit" class="btn btn-primary" value="Change Password">
                                </div>
                                </form>
                            </div>

                        </div>
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