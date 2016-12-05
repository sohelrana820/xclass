<?php echo $this->assign('title', 'New Project'); ?>

<div class="page-header">
    <h2 class="title pull-left">
        Manage Project
    </h2>
    <div class="clearfix"></div>
</div>

<?php echo $this->Form->create($project, array('controller' => 'projects', 'action' => 'create', 'type' => 'file'));?>

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

        <div class="row">
            <div class="attachment_area col-lg-6">
                <div class="single_attachment">
                    <div class="form-group">
                        <label>Attachment 1</label>
                        <input type="file" name="attachments[]" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <a class="add_more btn-theme-xs-rev">Add More Attachment</a>
        <br/>
        <br/>
        <br/>
        <div class="clearfix"></div>
        <button type="submit" class="btn btn-success">Create Project</button>
        <?php echo $this->Form->end();?>
    </div>
</div>

<?php $this->start('jsBottom'); ?>

<script type="text/javascript">
    var counterSlider = 1;
    $(".add_more").on("click", function () {
        counterSlider++;
        var newRow = $("");
        var cols = "";
        cols +=
            '<div class="single_attachment">' +
                '<div class="form-group">' +
                    '<label>Attachment '+counterSlider+'</label>' +
                    '<input type="file" name="attachments[]" class="form-control">' +
                '</div>' +
                '<a class="deleteKeywordRow"> x </a>' +
            '</div>';
        newRow.append(cols);
        $(".attachment_area").append(cols);
    });

    $("div").on("click", "a.deleteKeywordRow", function (event) {
        $(this).closest("div").remove();
    });
</script>
<?php $this->end(); ?>












