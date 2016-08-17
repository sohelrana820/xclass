<?php echo $this->assign('title', 'Database Configuration'); ?>

<div class="text-left">
    <h2 class="text-center">Database Configuration</h2>
    <br/>

    <?php echo $this->Form->create(null, array('controller' => 'installation', 'action' => 'database', 'class' => 'login_form'));?>

    <div class="form-group">
        <label class="text-info">Database Host</label>
        <?php echo $this->Form->input('database.host', ['type' => 'text', 'class' => 'form-control', 'value' => 'localhost', 'label' => false, 'required' => false]);?>
    </div>

    <div class="form-group">
        <label class="text-info">Database Username</label>
        <?php echo $this->Form->input('database.username', ['type' => 'text', 'class' => 'form-control', 'value' => 'root', 'label' => false, 'required' => false]);?>
    </div>

    <div class="form-group">
        <label class="text-info">Database Password</label>
        <?php echo $this->Form->input('database.password', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Database password', 'label' => false, 'required' => false]);?>
    </div>

    <div class="form-group">
        <label class="text-info">Database Name</label>
        <?php echo $this->Form->input('database.database_name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Database name', 'label' => false, 'required' => false]);?>
    </div>

    <button type="submit" class="btn btn-success btn-lg">Next Process</button>
    <?php echo $this->Form->end();?>
</div>