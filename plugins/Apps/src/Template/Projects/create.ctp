<?php echo $this->assign('title', 'New Project'); ?>

<div class="page-header">
    <h2 class="title pull-left">
        Manage Project
    </h2>
    <div class="clearfix"></div>
</div>

<?php echo $this->Form->create($project, array('controller' => 'projects', 'action' => 'create'));?>

<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>New Project</h2>
            <span>Provide all valid information to create a new project</span>
        </div>
        <div class="pull-right btn-areas">
            <?php echo $this->Html->link('Project List', ['controller' => 'projects', 'action' => 'index'], ['class' => 'btn btn-info'])?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="widget-body">
        <div class="form-group">
            <label>Project Name</label>
            <?php echo $this->Form->input('name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Name of project', 'label' => false, 'required' => false]);?>
        </div>

        <div class="form-group">
            <label>Descrition</label>
            <?php echo $this->Form->input('description', ['type' => 'textarea', 'class' => 'form-control', 'placeholder' => 'Description', 'label' => false, 'required' => false]);?>
        </div>

        <div class="form-group">
            <label>Note</label>
            <?php echo $this->Form->input('note', ['type' => 'textarea', 'class' => 'form-control', 'placeholder' => 'Project note', 'label' => false, 'required' => false]);?>
        </div>

        <div class="form-group">
            <label>Assign User</label>
            <?php echo $this->Form->input('users._ids', ['options' => $users, 'class' => 'form-control', 'label' => false, 'required' => false]); ?>
        </div>

        <div class="form-group">
            <label>Assign Label</label>
            <?php echo $this->Form->input('labels._ids', ['options' => $labels, 'class' => 'form-control', 'label' => false, 'required' => false]);?>
        </div>
        <button type="submit" class="btn btn-success">Save User</button>
        <?php echo $this->Form->end();?>
    </div>
</div>

<?php
$this->start('cssTop');
echo $this->Html->css(array('datepicker'));
$this->end();

$this->start('jsTop');
echo $this->Html->script(array('country'));
$this->end();

$this->start('jsBottom');
echo $this->Html->script(['datepicker']);
?>

<script language="javascript">
    populateCountries("country", "state");
    $('.datepicker').datepicker();
</script>

<?php $this->end(); ?>













