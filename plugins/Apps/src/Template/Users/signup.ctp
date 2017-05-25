<?php echo $this->assign('title', __('signup_page_title')); ?>

<?php echo $this->Form->create($user, ['url' => ['controller' => 'users', 'action' => 'signup'], 'class' => 'login_form']);?>

<div class="form-group">
    <label class="text-info"><?php echo __('first_name');?></label>
    <?php echo $this->Form->input('profile.first_name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => __('first_name'), 'label' => false, 'required' => false]);?>
</div>

<div class="form-group">
    <label class="text-info"><?php echo __('last_name');?></label>
    <?php echo $this->Form->input('profile.last_name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => __('last_name'), 'label' => false, 'required' => false]);?>
</div>

<div class="form-group">
    <label class="text-info"><?php echo __('email_address');?></label>
    <?php echo $this->Form->input('username', ['type' => 'text', 'class' => 'form-control', 'placeholder' => __('email_address'), 'label' => false, 'required' => false]);?>
</div>

<div class="form-group">
    <label class="text-info"><?php echo __('password');?></label>
    <?php echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => __('password'), 'label' => false, 'required' => false]);?>
</div>

<div class="form-group">
    <label class="text-info"><?php echo __('confirm_password');?></label>
    <?php echo $this->Form->input('cPassword', ['type' => 'password', 'class' => 'form-control', 'placeholder' => __('confirm_password'), 'label' => false, 'required' => false]);?>
</div>

<button type="submit" class="btn btn-primary login-button"><?php echo __('create_account');?></button>
<span class="pull-right message text-right">
                        <?php echo __('already_have_account');?>
    <?php echo $this->Html->link(__('click_to_login'), ['controller' => 'users', 'action' => 'login']);?>
    <br/>
                    </span>
<?php echo $this->Form->end();?>