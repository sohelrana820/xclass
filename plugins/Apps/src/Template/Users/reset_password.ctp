<?php echo $this->assign('title', 'Reset Password'); ?>

<?php echo $this->Form->create($user, ['class' => 'login_form']);?>
    <div class="form-group">
        <label class="text-info">Password</label>
        <?php echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'label' => false, 'required' => false]);?>
    </div>
    <div class="form-group">
        <label class="text-info">Confirm Password</label>
        <?php echo $this->Form->input('cPassword', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirm password', 'label' => false, 'required' => false]);?>
    </div>
    <button type="submit" class="btn btn-primary login-button">Reset Password</button>
<?php echo $this->Form->end();?>