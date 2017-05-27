<?php echo $this->assign('title', __('create_project_page_title')); ?>

<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link(__('manage_project'), ['controller' => 'projects', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<?php echo $this->Form->create($project, ['url' => ['controller' => 'projects', 'action' => 'create'], 'type' => 'file']);?>

<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2><?php echo __('new_project');?></h2>
            <span><?php echo __('provide_info_to_create_project');?></span>
        </div>
        <div class="pull-right btn-areas">
            <?php echo $this->Html->link(__('project_list_text'), ['controller' => 'projects', 'action' => 'index'], ['class' => 'btn btn-info'])?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="widget-body">
        <div class="form-group">
            <label><?php echo __('project_name');?></label>
            <?php echo $this->Form->input('name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => __('name_of_project'), 'label' => false, 'required' => false]);?>
        </div>

        <div class="form-group">
            <label><?php echo __('description');?></label>
            <?php echo $this->Form->input('description', ['type' => 'textarea', 'class' => 'form-control', 'placeholder' => __('description'), 'label' => false, 'required' => false]);?>
        </div>

        <div class="form-group">
            <label><?php echo __('deadline');?></label>
            <div class="input-group">
                <input name="deadline" type="text" class="form-control datepicker" placeholder="<?php echo __('project_deadline');?>">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
            <?php echo $this->Form->error('deadline');?>
        </div>

        <div class="form-group">
            <label><?php echo __('note');?></label>
            <?php echo $this->Form->input('note', ['type' => 'textarea', 'class' => 'form-control', 'placeholder' => __('project_note'), 'label' => false, 'required' => false]);?>
        </div>

        <div class="row">
            <div class="attachment_area col-lg-6">
                <div class="single_attachment">
                    <div class="form-group">
                        <label><?php echo __('attachment_text');?> 1</label>
                        <input type="file" name="attachments[]" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <a class="add_more btn-theme-xs-rev"><?php echo __('add_more_attachment');?></a>
        <br/>
        <br/>
        <br/>
        <div class="clearfix"></div>
        <button type="submit" class="btn btn-success"><?php echo __('create_project');?></button>
        <?php echo $this->Form->end();?>
    </div>
</div>

<?php
$this->start('cssTop');
echo $this->Html->css(array('datepicker'));
$this->end();
?>

<?php
$this->start('jsBottom');
echo $this->Html->script(['datepicker']);
?>

<script type="text/javascript">
    var counterSlider = 1;
    $(".add_more").on("click", function () {
        counterSlider++;
        var newRow = $("");
        var cols = "";
        cols +=
            '<div class="single_attachment">' +
                '<div class="form-group">' +
                    '<label><?php echo __('attachment_text')?> '+counterSlider+'</label>' +
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

    $('.datepicker').datepicker();
</script>
<?php $this->end(); ?>














