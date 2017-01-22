<?php echo $this->assign('title', $project->name); ?>

<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link($project->name, ['controller' => 'projects', 'action' => 'view', $project->slug], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>



<div class="row">
    <div class="col-lg-12">
        <div class="widget">
            <div class="widget-header">
                <div class="pull-left">
                    <h2>Attachments</h2>
                    <span><?php echo $this->Paginator->counter('{{count}}');?> result found</span>
                </div>
                <div class="pull-right">
                    <form class="form-inline" action="" method="get">
                        <?php echo $this->Html->link('Download Attachment', ['controller' => 'projects', 'action' => 'download_attachments', $project->slug], ['class' => 'btn btn-success']);?>
                        <div class="form-group">
                            <label class="sr-only">Email address</label>
                            <input type="text" name="attachment_name" class="form-control"  placeholder="Search attachment...">
                        </div>
                        <button type="submit" class="btn btn-default">Search</button>
                    </form>
                </div>
                <div class="clearfix"></div>
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
                                    <i class="icon fa fa-file-o"></i>
                                <?php endif; ?>
                            </div>

                            <p class="name" title="<?php echo $attachment->name;?>"><?php echo $this->Text->truncate($attachment->name, 20);?></p>

                            <div class="attachment_thumb_download">
                                <?php echo $this->Html->link('Download', ['controller' => 'tasks', 'action' => 'download_attachment', $attachment->uuid], ['class' => 'btn-theme-xs-rev']);?>
                            </div>
                        </div>
                    <?php endforeach;?>
                    <div class="clearfix"></div>
                    <?php echo $this->element('pagination');?>
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

