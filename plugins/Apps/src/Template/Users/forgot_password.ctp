<?php echo $this->assign('title', __('forgot_password_page_title')); ?>

<?php echo $this->Form->create('User', ['url' => ['controller' => 'users', 'action' => 'forgot-password'], 'class' => 'login_form']);?>
    <div class="form-group">
        <label class="text-info"><?php echo __('email_address');?></label>
        <?php echo $this->Form->input('username', ['type' => 'text', 'class' => 'form-control', 'placeholder' => __('email_address'), 'label' => false, 'required' => false]);?>
    </div>
    <button type="submit" class="btn btn-primary login-button"><?php echo __('send_me_email');?></button>
<?php echo $this->Form->end();?>