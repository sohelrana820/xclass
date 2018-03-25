<div class="page-header" style="margin-bottom: 0px !important;">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Manage Documents', ['controller' => 'documents', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>


<div class="widget border-less-widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>List of documents</h2>
            <span><span><?php echo $this->Paginator->counter('{{count}}');?> result found</span></span>
        </div>
        <div class="pull-right btn-areas">
            <?php if($userInfo->role == 1):?>
                <?php echo $this->Html->link('New Document', ['controller' => 'documents', 'action' => 'add'], ['class' => 'btn btn-info'])?>
                <?php echo $this->Html->link('Back to List', ['controller' => 'documents', 'action' => 'index'], ['class' => 'btn btn-info'])?>
            <?php endif;?>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#searchDocumentsModal">Search Documents</button>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <?php if(!$documents->isEmpty()):?>
            <div class="row">
                <?php foreach ($documents as $document): ?>

                    <div class="col-lg-6">
                        <div class="media document-list">
                            <div class="media-left">
                                <?php
                                $image = 'dummy.png';
                                if($document->image != '') {
                                    $image = $document->image;
                                }
                                echo $this->Html->image($image, ['class' => 'doc-list-img', 'alt' => $document->title, 'url' => ['action' => 'view', $document->id]]);
                                ?>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <?php echo $this->Html->link($this->Text->truncate($document->title, 80), ['action' => 'view', $document->id])?>
                                </h4>
                                <p><?php echo $this->Text->truncate($document->description, 100)?></p>
                                <div class="doc-sourse">Course: <?php echo $document->course ? $document->course->name : 'N/A';?></div>
                                <div class="status">
                                    <?php if ($document->status == 1): ?>
                                        <strong>Status:</strong> <span class="status-text status-text-success">Active</span>
                                    <?php elseif ($document->status == 0): ?>
                                        <strong>Status:</strong> <span class="status-text status-text-danger">Inactive</span>
                                    <?php else: ?>
                                        <strong>Status:</strong> N/A
                                    <?php endif; ?>
                                </div>
                                <?php if($userInfo->role == 1):?>
                                <div class="doc-buttons">
                                    <?php echo $this->Html->link(__('<i class="fa fa-gear"></i>'), ['action' => 'view', $document->id], ['escape' => false, 'class' => 'icons green']) ?>
                                    <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i>'), ['action' => 'edit', $document->id], ['escape' => false, 'class' => 'icons']) ?>
                                    <?php echo $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['action' => 'delete', $document->id], ['escape' => false, 'class' => 'icons red', 'confirm' => __('Are you sure you want to delete # {0}?', $document->id)]) ?>
                                </div>
                                <?php endif;?>
                            </div>
                            <div class="media-right">
                                <?php echo $this->Html->link('<i class="fa fa-download"></i>', ['action' => 'download', $document->id], ['class' => 'doc-download', 'escape' => false])?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <?php echo $this->element('not_found'); ?>
        <?php endif; ?>
    </div>
</div>



<div class="modal fade modal-primary" id="searchDocumentsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <?php
        echo $this->Form->create(null,
            [
                'type' => 'get',
                'url' =>
                    [
                        'controller' => 'documents',
                        'action' => 'index',
                    ]
            ]
        );
        ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center text-uppercase" id="myModalLabel">Search Documents</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Title</label>
                    <div class="input text">
                        <input type="text" name="title" class="form-control" placeholder="Document title" value="<?php echo $this->request->query('title') != '' ? $this->request->query('title') : '' ?>">
                    </div>
                </div>

                <?php if($userInfo->role == 1):?>
                    <div class="form-group">
                        <label>Status</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="status" value="active" <?php if($this->request->query('status') && $this->request->query('status') == 'active') {echo 'checked';}?>>Active
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="status" value="inactive" <?php if($this->request->query('status') && $this->request->query('status') == 'inactive') {echo 'checked';}?>>Inactive
                            </label>
                        </div>
                    </div>
                <?php endif;?>

                <div class="form-group">
                    <label>Courses</label>
                    <div class="input text">
                        <select type="text" name="course_id" class="form-control">
                            <option value="">Choose Course</option>
                            <?php foreach ($courses as $key => $value): ?>
                                <option value="<?php echo $key;?>" <?php if($this->request->query('course_id') == $key) {echo 'selected="selected"';}?>><?php echo $value;?></option>
                            <?php endforeach;; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="search">
                <?php echo $this->Html->link('Reset', ['controller' => 'documents' , 'action' => 'index'], ['class' => 'btn btn-danger']);?>
            </div>
        </div>
        <?php echo $this->Form->end();?>
    </div>
</div>