<?php echo $this->assign('title', 'Forgot Password'); ?>

<?php echo $this->Form->create('User', ['controller' => 'users', 'action' => 'forgot-password', 'class' => 'login_form']);?>
    <div class="form-group">
        <label class="text-info">Email</label>
        <?php echo $this->Form->input('username', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Email Address', 'label' => false, 'required' => false]);?>
    </div>
    <button type="submit" class="btn btn-primary login-button">Send me Email</button>
<?php echo $this->Form->end();?>