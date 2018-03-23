<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Manage Courses', ['controller' => 'courses', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>New Course</h2>
            <span>Provide all valid information to create a new course</span>
        </div>
        <div class="pull-right btn-areas">
            <?php echo $this->Html->link('Back to List', ['controller' => 'courses', 'action' => 'index'], ['class' => 'btn btn-info'])?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <?php echo $this->Form->create($course);?>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Course name</label>
                    <?php echo $this->Form->input('name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Course name', 'label' => false, 'required' => false]);?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="form-group">
                    <label>Description</label>
                    <?php echo $this->Form->input('description', ['type' => 'textarea', 'rows' => '10', 'class' => 'form-control', 'placeholder' => 'Write description', 'label' => false, 'required' => false]);?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Status</label>
                    <?php echo $this->Form->input('status', ['type' => 'select', 'class' => 'form-control', 'options' => ['0' => 'Inactive', '1' => 'Active'], 'label' => false, 'required' => false]);?>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save Course</button>
        <?php echo $this->Form->end();?>
    </div>
</div>
