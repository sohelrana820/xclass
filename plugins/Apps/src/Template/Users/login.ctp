<?php echo $this->assign('title', 'Login'); ?>

<?php echo $this->Form->create('User', ['controller' => 'users', 'action' => 'login', 'class' => 'login_form']);?>
<div class="form-group">
    <label class="text-info">Email</label>
    <?php echo $this->Form->input('username', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Email Address', 'label' => false, 'required' => false]);?>
</div>
<div class="form-group">
    <label class="text-info">Password</label>
    <?php echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'label' => false, 'required' => false]);?>
</div>
    <button type="submit" class="btn btn-primary login-button">Signin</button>
    <span class="pull-right message text-right">
        Don't have account
    <?php echo $this->Html->link('click here to create account', ['controller' => 'users', 'action' => 'signup']);?>
    <br/>
    <?php echo $this->Html->link('Forgot password', ['controller' => 'users', 'action' => 'forgot_password']);?>
    </span>
<?php echo $this->Form->end();?>