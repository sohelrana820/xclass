<?php echo $this->assign('title', 'General Settings'); ?>

<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('General Configuration', ['controller' => 'settings', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<div class="widget">
    <div class="widget-header">
        <h2>General Configuration</h2>
        <span>Manager your application general configuration</span>
    </div>
    <div class="widget-body">
        <?php echo $this->Form->create(null, ['url' => ['controller' => 'settings', 'action' => 'general'], 'type' => 'file']);?>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <div>
                        <?php echo $this->Html->image($appsLogo, ['class' => 'application_logo']);?>
                    </div>
                    <label class="text-info">Change Logo</label>
                    <?php echo $this->Form->input('application.logo', ['type' => 'file', 'class' => 'form-control', 'label' => false, 'required' => false]);?>
                </div>

                <div class="form-group">
                    <label class="text-info">Name of Application</label>
                    <?php echo $this->Form->input('application.name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Application name', 'label' => false, 'required' => false, 'value' => $settings['APPLICATION_NAME']]);?>
                </div>


                <div class="form-group">
                    <label class="text-info">Host</label>
                    <?php echo $this->Form->input('email.host', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Host', 'label' => false, 'required' => false, 'value' => $settings['EMAIL_HOST']]);?>
                </div>

                <div class="form-group">
                    <label class="text-info">Port</label>
                    <?php echo $this->Form->input('email.port', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Port', 'label' => false, 'required' => false, 'value' => $settings['EMAIL_PORT']]);?>
                </div>

                <div class="form-group">
                    <label class="text-info">Username</label>
                    <?php echo $this->Form->input('email.username', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Username', 'label' => false, 'required' => false, 'value' => $settings['EMAIL_USERNAME']]);?>
                </div>

                <div class="form-group">
                    <label class="text-info">Password</label>
                    <?php echo $this->Form->input('email.password', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Password', 'label' => false, 'required' => false, 'value' => $settings['EMAIL_PASSWORD']]);?>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <?php echo $this->Form->end();?>

    </div>
</div>












