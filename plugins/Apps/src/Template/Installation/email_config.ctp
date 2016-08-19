<?php echo $this->assign('title', 'Email Configuration'); ?>

<div class="text-left">
    <h2 class="text-center">Email Configuration</h2>
    <br/>

    <?php echo $this->Form->create(null, array('controller' => 'installation', 'action' => 'email_config', 'class' => 'login_form'));?>

    <div class="form-group">
        <label class="text-info">Host</label>
        <?php echo $this->Form->input('email.host', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Host', 'label' => false, 'required' => false]);?>
    </div>

    <div class="form-group">
        <label class="text-info">Port</label>
        <?php echo $this->Form->input('email.port', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Port', 'label' => false, 'required' => false]);?>
    </div>

    <div class="form-group">
        <label class="text-info">Username</label>
        <?php echo $this->Form->input('email.username', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Username', 'label' => false, 'required' => false]);?>
    </div>

    <div class="form-group">
        <label class="text-info">Password</label>
        <?php echo $this->Form->input('email.password', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Password', 'label' => false, 'required' => false]);?>
    </div>

    <button type="submit" class="btn btn-lg-theme">Submit</button>
    <?php echo $this->Form->end();?>
</div>