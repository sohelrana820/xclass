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
                    <span class="count-to">#<?php echo $userInfo->student_id?></span>
                    <small>Student ID</small>
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