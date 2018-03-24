<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Manage Documents', ['controller' => 'documents', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>


<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>New Document</h2>
            <span>Provide all valid information to create a new document</span>
        </div>
        <div class="pull-right btn-areas">
            <?php echo $this->Html->link('Back to List', ['controller' => 'documents', 'action' => 'index'], ['class' => 'btn btn-info'])?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <?php echo $this->Form->create($document, ['type' => 'file']);?>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Choose courses</label>
                    <?php echo $this->Form->input('course_id', ['type' => 'select', 'class' => 'form-control', 'options' => $courses, 'label' => false, 'empty' => true, 'empty' => 'Choose a course']);?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Title</label>
                    <?php echo $this->Form->input('title', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Document title', 'label' => false, 'required' => false]);?>
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
                    <label>Image</label>
                    <?php echo $this->Form->input('image', ['type' => 'file', 'class' => 'form-control', 'label' => false, 'required' => false]);?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Document</label>
                    <?php echo $this->Form->input('document', ['type' => 'file', 'class' => 'form-control', 'label' => false, 'required' => true]);?>
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
        <button type="submit" class="btn btn-success">Save Document</button>
        <?php echo $this->Form->end();?>
    </div>
</div>
