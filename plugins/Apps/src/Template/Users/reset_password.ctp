<?php echo $this->Form->create($user, ['class' => 'login_form']);?>
    <div class="form-group">
        <label class="text-info"><?php echo __('password');?></label>
        <?php echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => __('password'), 'label' => false, 'required' => false]);?>
    </div>
    <div class="form-group">
        <label class="text-info"><?php echo __('confirm_password');?></label>
        <?php echo $this->Form->input('cPassword', ['type' => 'password', 'class' => 'form-control', 'placeholder' => __('confirm_password'), 'label' => false, 'required' => false]);?>
    </div>
    <button type="submit" class="btn btn-primary login-button"><?php echo __('reset_password_btn');?></button>
<?php echo $this->Form->end();?>