<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Dashboard', ['controller' => 'dashboard', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-6 col-lg-3">
        <div class="app-stats-item bg-orange">
            <div>
                <i class="fa fa-users"></i>
                <h3 class="app-stats-title">
                    <span class="count-to"><?php echo $overview['total_students']?></span>
                    <small>Total Students</small>
                </h3>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-lg-3">
        <div class="app-stats-item bg-green">
            <div>
                <i class="fa fa-book"></i>
                <h3 class="app-stats-title">
                    <span class="count-to"><?php echo $overview['total_courses']?></span>
                    <small>Total Courses</small>
                </h3>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-lg-3">
        <div class="app-stats-item bg-red">
            <div>
                <i class="fa fa-file"></i>
                <h3 class="app-stats-title">
                    <span class="count-to"><?php echo $overview['total_documents']?></span>
                    <small>Total Documents</small>
                </h3>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-lg-3">
        <div class="app-stats-item bg-blue">
            <div>
                <i class="fa fa-download"></i>
                <h3 class="app-stats-title">
                    <span class="count-to"><?php echo $overview['total_downloads']?></span>
                    <small>Total Downloads</small>
                </h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="widget">
            <div class="widget-header">
                <div class="pull-left">
                    <h2>Recent Student</h2>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="widget-body">
                <?php if (!$students->isEmpty()): ?>
                    <table class="table theme-table">
                        <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td>
                                    <?php echo $student->student_id ? $student->student_id : 'N/A'; ?>
                                </td>
                                <td>
                                    <?php echo $this->Html->link($student->profile->name, ['controller' => 'users', 'action' => 'view', $student->uuid]); ?>
                                </td>
                                <td>
                                    <?php if ($student->status == 1): ?>
                                        <span class="status-text status-text-success">Active</span>
                                    <?php elseif ($student->status == 0): ?>
                                        <span class="status-text status-text-danger">Inactive</span>
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                                <td class="text-right">
                                    <?php
                                    echo $this->Html->link('<i class="fa fa-gear"></i>', ['controller' => 'users', 'action' => 'view', $student->uuid], ['escape' => false, 'class' => 'icons green']);
                                    echo $this->Html->link('<i class="fa fa-pencil"></i>', ['controller' => 'users', 'action' => 'edit', $student->uuid], ['escape' => false, 'class' => 'icons']);
                                    echo $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['action' => 'delete', $student->uuid], ['escape' => false, 'class' => 'icons red', 'confirm' => __('Are you sure you want to delete # {0}?', $student->profile->first_name . ' ' . $student->profile->last_name)]);
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <?php echo $this->element('not_found'); ?>
                <?php endif; ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="widget">
            <div class="widget-header">
                <div class="pull-left">
                    <h2>Recent Documents</h2>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="widget-body">
                <?php if (!$documents->isEmpty()): ?>
                    <table class="table theme-table">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($documents as $document): ?>
                            <tr>
                                <td>
                                    <?php echo $this->Html->link($this->Text->truncate($document->title, 50), ['controller' => 'documents', 'action' => 'view', $document->id])?>
                                </td>
                                <td>
                                    <?php echo $document->course ? $document->course->name : 'N/A';?>
                                </td>
                                <td>
                                    <?php if ($document->status == 1): ?>
                                        <span class="status-text status-text-success">Active</span>
                                    <?php elseif ($document->status == 0): ?>
                                        <span class="status-text status-text-danger">Inactive</span>
                                    <?php else: ?>
                                        </strong> N/A
                                    <?php endif; ?>
                                </td>
                                <td class="text-right">
                                    <?php echo $this->Html->link(__('<i class="fa fa-gear"></i>'), ['action' => 'view', $document->id], ['escape' => false, 'class' => 'icons green']) ?>
                                    <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i>'), ['action' => 'edit', $document->id], ['escape' => false, 'class' => 'icons']) ?>
                                    <?php echo $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['action' => 'delete', $document->id], ['escape' => false, 'class' => 'icons red', 'confirm' => __('Are you sure you want to delete # {0}?', $document->id)]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <?php echo $this->element('not_found'); ?>
                <?php endif; ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="widget">
            <div class="widget-header">
                <h2>Recent Downloads</h2>
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
                <?php else: ?>
                    <?php echo $this->element('not_found'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>