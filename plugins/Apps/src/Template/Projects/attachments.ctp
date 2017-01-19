<?php echo $this->assign('title', $project->name); ?>

<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link($project->name, ['controller' => 'projects', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>



<div class="row">
    <div class="col-lg-12">
        <div class="widget">
            <div class="widget-header">
                <h2>Attachments</h2>
                <span>All attachment list of <strong><?php echo $project->name;?></strong> </span>
            </div>
            <div class="widget-body">
                <?php if (!$attachments->isEmpty()): ?>
                    <?php foreach ($attachments as $attachment):?>
                        <div class="attachment_thumb">
                            <div>
                                <?php if ($this->Utility->getExtension($attachment->name) == 'img'): ?>
                                    <i class="icon fa fa-file-image-o"></i>
                                <?php elseif ($this->Utility->getExtension($attachment->name) == 'pdf'): ?>
                                    <i class="icon fa fa-file-pdf-o"></i>
                                <?php else: ?>
                                    <i class="icon fa fa-question"></i>
                                <?php endif; ?>
                            </div>

                            <p class="name" title="<?php echo $attachment->name;?>"><?php echo $this->Text->truncate($attachment->name, 20);?></p>

                            <div class="attachment_thumb_download">
                                <?php echo $this->Html->link('Download', ['controller' => 'tasks', 'action' => 'download_attachment', $attachment->uuid], ['class' => 'btn-theme-xs-rev']);?>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php else: ?>
                    <?php echo $this->element('not_found'); ?>
                <?php endif; ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<?php
echo $this->start('jsBottom');

echo $this->end();
?>

