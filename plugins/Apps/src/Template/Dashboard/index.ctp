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
                    <small>Total Task</small>
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
                    <small>Closed Task</small>
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
                    <small>Opened Task</small>
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
</div>