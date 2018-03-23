<?php echo $this->Form->create('User', ['url' => ['controller' => 'users', 'action' => 'login'], 'class' => 'login_form']);?>
<div class="form-group">
    <label class="text-info">Email</label>
    <?php echo $this->Form->input('username', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Email Address', 'label' => false, 'required' => false]);?>
</div>
<div class="form-group">
    <label class="text-info">Password</label>
    <?php echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'label' => false, 'required' => false]);?>
</div>
    <button type="submit" class="btn btn-primary login-button"><?php echo __('login_btn')?></button>
    <span class="pull-right message text-right">
        <?php echo __('do_not_have_account');?>
    <?php echo $this->Html->link(__('click_to_create_account'), ['controller' => 'users', 'action' => 'signup']);?>
    <br/>
    <?php echo $this->Html->link(__('forgot_password'), ['controller' => 'users', 'action' => 'forgot_password']);?>
    </span>
<?php echo $this->Form->end();?>