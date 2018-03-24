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