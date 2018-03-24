
<?php echo $this->Form->create($user, ['url' => ['controller' => 'users', 'action' => 'signup'], 'class' => 'login_form']);?>

<div class="form-group">
    <label class="text-info"><?php echo __('First name');?></label>
    <?php echo $this->Form->input('profile.first_name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => __('First name'), 'label' => false, 'required' => false]);?>
</div>

<div class="form-group">
    <label class="text-info"><?php echo __('Last name');?></label>
    <?php echo $this->Form->input('profile.last_name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => __('Last name'), 'label' => false, 'required' => false]);?>
</div>

<div class="form-group">
    <label class="text-info"><?php echo __('Email address');?></label>
    <?php echo $this->Form->input('username', ['type' => 'text', 'class' => 'form-control', 'placeholder' => __('Email address'), 'label' => false, 'required' => false]);?>
</div>

<div class="form-group">
    <label class="text-info"><?php echo __('Password');?></label>
    <?php echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => __('password'), 'label' => false, 'required' => false]);?>
</div>

<div class="form-group">
    <label class="text-info"><?php echo __('Confirm password');?></label>
    <?php echo $this->Form->input('cPassword', ['type' => 'password', 'class' => 'form-control', 'placeholder' => __('Confirm password'), 'label' => false, 'required' => false]);?>
</div>

<button type="submit" class="btn btn-primary login-button"><?php echo __('Create Account');?></button>
<span class="pull-right message text-right">
                        <?php echo __('Already have account');?>
    <?php echo $this->Html->link(__('click to login'), ['controller' => 'users', 'action' => 'login']);?>
    <br/>
                    </span>
<?php echo $this->Form->end();?>