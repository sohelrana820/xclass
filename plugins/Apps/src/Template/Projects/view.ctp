<?php echo $this->assign('title', $project->name); ?>

<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link($project->name, ['controller' => 'projects', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<?php /*echo $this->Html->link('Task Manager', ['controller' => 'tasks', 'action' => 'index', $project->slug]);*/?><!--
<br/>
<?php /*echo $this->Html->link('Task Label', ['controller' => 'labels', 'action' => 'index', $project->slug]);*/?>
<br/>
<?php /*echo $this->Html->link('Task Users', ['controller' => 'projects', 'action' => 'users', $project->slug]);*/?>
<br/>
--><?php /*echo $this->Html->link('Attachments', ['controller' => 'projects', 'action' => 'attachments', $project->slug]);*/?>

<div class="row">
    <div class="col-xs-12 col-sm-6 col-lg-3">
        <div class="app-stats-item bg-orange">
            <div class="overview-loader ng-hide" ng-show="overview_loader">
                <img src="http://localhost/task-manager//img/loader-blue.gif" class="md_loader">
            </div>
            <div ng-show="!overview_loader" class="">
                <i class="fa fa-users"></i>
                <h3 class="app-stats-title">
                    <span class="count-to ng-binding" data-from="0" data-to="1250">4</span>
                    <small>Total Users</small>
                </h3>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-lg-3">
        <div class="app-stats-item bg-green">
            <div class="overview-loader ng-hide" ng-show="overview_loader">
                <img src="http://localhost/task-manager//img/loader-blue.gif" class="md_loader">
            </div>
            <div ng-show="!overview_loader" class="">
                <i class="fa fa-tags"></i>
                <h3 class="app-stats-title">
                    <span class="count-to ng-binding" data-from="0" data-to="5411">0</span>
                    <small>Total Label</small>
                </h3>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-lg-3">
        <div class="app-stats-item bg-red">
            <div class="overview-loader ng-hide" ng-show="overview_loader">
                <img src="http://localhost/task-manager//img/loader-blue.gif" class="md_loader">
            </div>
            <div ng-show="!overview_loader" class="">
                <i class="fa fa-bell-slash-o"></i>
                <h3 class="app-stats-title">
                    <span class="count-to ng-binding" data-from="0" data-to="4151">0</span>
                    <small>Total Closed Task</small>
                </h3>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-lg-3">
        <div class="app-stats-item bg-blue">
            <div class="overview-loader ng-hide" ng-show="overview_loader">
                <img src="http://localhost/task-manager//img/loader-blue.gif" class="md_loader">
            </div>
            <div ng-show="!overview_loader" class="">
                <i class="fa fa-bell-o"></i>
                <h3 class="app-stats-title">
                    <span class="count-to ng-binding" data-from="0" data-to="105">0</span>
                    <small>Total Opened Task</small>
                </h3>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="col-lg-6">
        <ul class="data-overview">
            <li>
                <strong>Name of Project: </strong>
                <?php
                if ($project->name) {
                    echo $project->name;
                } else {
                    echo 'N/A';
                }
                ?>
            </li>
            <li>
                <strong>Description: </strong>
                <?php
                if ($project->description) {
                    echo $project->description;
                } else {
                    echo 'N/A';
                }
                ?>
            </li>
            <li>
                <strong>Note: </strong>
                <?php
                if ($project->note) {
                    echo $project->note;
                } else {
                    echo 'N/A';
                }
                ?>
            </li>
        </ul>
    </div>

    <div class="col-lg-4">
        <div class="ui-kit-9">
            <div class="col-mob">
                <h2>Recent Opened Tasks</h2>
                <!-- Item -->
                <div class="ui-item">
                    <!-- Heading -->
                    <div class="ui-heading clearfix">
                        <h5>
                            <a class="task_user_link">Sohel RAna</a>
                            <label>Not Assigned Yet!</label>
                        </h5>
                    </div>
                    <p>
                        Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus magna justo, lacinia eget consectetur sed, co
                    </p>
                    <div>
                        <a class="label label-sm d-label" style="color: red; border: 1px solid red;">dasd</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/LabelsCtrl']);
echo $this->Html->script(['src/TasksCtrl']);
echo $this->Html->script(['src/Comments']);
echo $this->end();
?>

