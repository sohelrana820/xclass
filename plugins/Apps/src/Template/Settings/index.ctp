<?php echo $this->assign('title', 'New User'); ?>

<div class="page-header">
    <h2 class="title pull-left">
        Application Settings
        <p class="sub-title">Manager your application settings</p>
    </h2>
    <div class="clearfix"></div>
</div>

<?php echo $this->Form->create(null, array('controller' => 'users', 'action' => 'add'));?>

<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label>First name</label>
            <div class="input text">
                <input type="text" name="profile[first_name]" class="form-control" placeholder="First name" id="profile-first-name">
            </div>
        </div>
    </div>
</div>


<button type="submit" class="btn btn-success">Save User</button>
<?php echo $this->Form->end();?>

<?php
$this->start('cssTop');

$this->end();

$this->start('jsTop');

$this->end();

$this->start('jsBottom');
echo $this->Html->script(['datepicker']);
?>

<?php $this->end(); ?>













