<?php echo $this->assign('title', 'General Configuration'); ?>

<div class="text-left">
    <h2 class="text-center">General Configuration</h2>
    <br/>

    <?php echo $this->Form->create(null, ['url' => ['controller' => 'installation', 'action' => 'general'], 'class' => 'login_form', 'type' => 'file']);?>

    <div class="form-group">
        <label class="text-info">Application Logo</label>
        <?php echo $this->Form->input('application.logo', ['type' => 'file', 'class' => 'form-control', 'label' => false, 'required' => false]);?>
    </div>

    <div class="form-group">
        <label class="text-info">Name of Application</label>
        <?php echo $this->Form->input('application.name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Application name', 'label' => false, 'required' => false]);?>
    </div>

    <button type="submit" class="btn btn-lg-theme">Next Process</button>
    <?php echo $this->Form->end();?>
</div>