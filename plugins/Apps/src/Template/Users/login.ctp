<?php echo $this->Form->create('User', ['url' => ['controller' => 'users', 'action' => 'login'], 'class' => 'login_form']);?>
<div class="form-group">
    <label class="text-info">Email</label>
    <?php echo $this->Form->input('email_or_student_id', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Email Address or Student ID', 'label' => false, 'required' => false]);?>
</div>
<div class="form-group">
    <label class="text-info">Password</label>
    <?php echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'label' => false, 'required' => false]);?>
</div>
    <button type="submit" class="btn btn-primary login-button"><?php echo __('Login')?></button>
    <span class="pull-right message text-right">
        <?php echo __('Do not have account?');?>
    <?php echo $this->Html->link(__('Click to create account'), ['controller' => 'users', 'action' => 'signup']);?>
    <br/>
    <?php /*echo $this->Html->link(__('Forgot password'), ['controller' => 'users', 'action' => 'forgot_password']);*/?>
    </span>
<?php echo $this->Form->end();?>