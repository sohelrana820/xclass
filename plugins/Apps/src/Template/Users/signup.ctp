<?php echo $this->assign('title', 'Signup'); ?>

<?php echo $this->Form->create($user, array('controller' => 'users', 'action' => 'signup', 'class' => 'login_form'));?>

<div class="form-group">
    <label class="text-info">First Name</label>
    <?php echo $this->Form->input('profile.first_name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'First name', 'label' => false, 'required' => false]);?>
</div>

<div class="form-group">
    <label class="text-info">Last Name</label>
    <?php echo $this->Form->input('profile.last_name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Last name', 'label' => false, 'required' => false]);?>
</div>

<div class="form-group">
    <label class="text-info">Email</label>
    <?php echo $this->Form->input('username', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Email Address', 'label' => false, 'required' => false]);?>
</div>

<div class="form-group">
    <label class="text-info">Password</label>
    <?php echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'label' => false, 'required' => false]);?>
</div>

<div class="form-group">
    <label class="text-info">Confirm Password</label>
    <?php echo $this->Form->input('cPassword', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirm password', 'label' => false, 'required' => false]);?>
</div>

<button type="submit" class="btn btn-primary login-button">Create Account</button>
<span class="pull-right message text-right">
                        Already have account
    <?php echo $this->Html->link('click here to signin', ['controller' => 'users', 'action' => 'login']);?>
    <br/>
                    </span>
<?php echo $this->Form->end();?>