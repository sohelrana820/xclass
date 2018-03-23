<?php echo $this->assign('title', 'Setup Administrator User'); ?>

    <h2 class="text-center">Setup Administrator User</h2>

<?php echo $this->Form->create($user, ['url' => ['controller' => 'installation', 'action' => 'administrator'], 'class' => 'login_form']);?>

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
    <?php echo $this->Form->input('username', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Email address', 'label' => false, 'required' => false]);?>
</div>

<div class="form-group">
    <label class="text-info">Password</label>
    <?php echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'label' => false, 'required' => false]);?>
</div>

<div class="form-group">
    <label class="text-info">Confirm Password</label>
    <?php echo $this->Form->input('cPassword', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirm password', 'label' => false, 'required' => false]);?>
</div>

<button type="submit" class="btn btn-lg-theme">Create Administrator</button>

<?php echo $this->Form->end();?>