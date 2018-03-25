<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Manage Documents', ['controller' => 'documents', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>


<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>Download Histories</h2>
        </div>
        <div class="pull-right btn-areas">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#searchDownloadModal">Search Download</button>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <?php if (!$downloads->isEmpty()): ?>
            <table class="table theme-table">
                <thead>
                <tr>
                    <th scope="col">Student Name</th>
                    <th scope="col">Document Name</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Download Time</th>
                    <?php if($userInfo->role == 1):?>
                        <th scope="col" class="actions"><?php echo __('Actions') ?></th>
                    <?php endif;?>
                </tr>
                </thead>
                <?php foreach ($downloads as $download): ?>
                    <tr>
                        <td><?php echo $this->Html->link($download->user->profile->first_name .' ' . $download->user->profile->last_name, ['controller' => 'users', 'action' => 'view', $download->user->uuid] ) ; ?></td>
                        <td><?php echo $this->Html->link($download->document->title, ['controller' => 'documents', 'action' => 'view', $download->document->id] ) ; ?></td>
                        <td><?php echo $download->document->course ? $download->document->course->name : 'N/A' ?></td>
                        <td>
                            <?php echo $this->Time->format($download->created, 'MMM d, Y') ?>
                            <span class="sm-time">(<?php echo date('H:i A', strtotime($download->created)) ?>)</span>
                        </td>
                        <?php if($userInfo->role == 1):?>
                        <td class="actions">
                            <?php echo $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['controller' => 'Download', 'action' => 'delete', $download->id], ['class' => 'icons red', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $download->id)]) ?>
                        </td>
                        <?php endif;?>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php echo $this->element('pagination');?>
        <?php else: ?>
            <?php echo $this->element('not_found'); ?>
        <?php endif; ?>
    </div>
</div>


<div class="modal fade modal-primary" id="searchDownloadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <?php
        echo $this->Form->create(null,
            [
                'type' => 'get',
                'url' =>
                    [
                        'controller' => 'documents',
                        'action' => 'download-histories',
                    ]
            ]
        );
        ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center text-uppercase" id="myModalLabel">Search Download</h4>
            </div>
            <div class="modal-body">
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

                <?php if($userInfo->role == 1):?>
                <div class="form-group">
                    <label>Users</label>
                    <div class="input text">
                        <select type="text" name="user_id" class="form-control">
                            <option value="">Choose User</option>
                            <?php foreach ($users as $key => $value): ?>
                                <option value="<?php echo $key;?>" <?php if($this->request->query('user_id') == $key) {echo 'selected="selected"';}?>><?php echo $value;?></option>
                            <?php endforeach;; ?>
                        </select>
                    </div>
                </div>
                <?php endif;?>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="search">
                <?php echo $this->Html->link('Reset', ['controller' => 'documents' , 'action' => 'download-histories'], ['class' => 'btn btn-danger']);?>
            </div>
        </div>
        <?php echo $this->Form->end();?>
    </div>
</div>