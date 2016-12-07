<?php echo $this->assign('title', $project->name); ?>

<div class="page-header">
    <h2 class="title pull-left">
        Project Management
    </h2>
    <div class="clearfix"></div>
</div>

<div class="col-md-12">
    <div class="tabbable-panel">
        <div class="tabbable-line">
            <ul class="nav nav-tabs ">
                <li class="active">
                    <a href="#project_overview" data-toggle="tab">Project Overview</a>
                </li>
                <li class="">
                    <a href="#project_tasks" data-toggle="tab">Tasks</a>
                </li>
                <li class="">
                    <a href="#project_labels" data-toggle="tab">Labels</a>
                </li>
                <li class="">
                    <a href="#project_users" data-toggle="tab">Assigned User</a>
                </li>
                <li class="">
                    <a href="#project_attachments" data-toggle="tab">Attachments</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="project_overview">
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
                    <ul class="data-overview">
                        <li>
                            <strong>Name of Project: </strong>
                            <?php
                            if($project->name){
                                echo $project->name;
                            }
                            else{
                                echo 'N/A';
                            }
                            ?>
                        </li>
                        <li>
                            <strong>Description: </strong>
                            <?php
                            if($project->description){
                                echo $project->description;
                            }
                            else{
                                echo 'N/A';
                            }
                            ?>
                        </li>
                        <li>
                            <strong>Note: </strong>
                            <?php
                            if($project->note){
                                echo $project->note;
                            }
                            else{
                                echo 'N/A';
                            }
                            ?>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane" id="project_tasks">
                    <h2>Project Tasks</h2>
                </div>
                <div class="tab-pane" id="project_labels">
                    <div ng-controller="LabelsCtrl">
                        <div class="page_loader" ng-show="!hide_page_loader">
                            <img src="{{BASE_URL}}/img/loader-blue.gif" class="md_loader">
                            <h4>Content loading, please wait...</h4>
                        </div>

                        <div ng-show="hide_page_loader">
                            <div class="row">
                                <div class="col-lg-5 col-md-5" ng-show="label.count > 0 || show_crate_form || searched_labels">
                                    <!-- Create label form -->
                                    <div ng-show="create_form" class="widget widget widget-boxed">
                                        <div class="widget-header">
                                            <h4 class="title">
                                                New Label
                                            </h4>
                                        </div>
                                        <div class="widget-body">
                                            <form name="create_label_form" ng-submit="saveLabel(create_label_form.$valid)" novalidate>
                                                <div class="form-group">
                                                    <label>Label Name</label>
                                                    <div class="input text">
                                                        <input type="text" ng-model="LabelObj.name" name="c_label_name" class="form-control" placeholder="Name of label" required="required">
                                                        <div ng-if="create_label_form.c_label_name.$dirty || isLabelFormSubmitted">
                                                            <p ng-show="create_label_form.c_label_name.$error.required"  class="error-message">Label name is required</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Label Color</label>
                                                    <div class="input text">
                                                        <color-picker ng-model="LabelObj.color_code" options="color_options"></color-picker>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="checkbox checkbox-theme checkbox-circle">
                                                        <input id="checkbox8" type="checkbox" ng-model="LabelObj.status" ng-true-value="1" ng-false-value="2">
                                                        <label for="checkbox8">
                                                            Is Active?
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-success">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /Create label form -->
                                    <!-- Edit label form -->
                                    <div ng-show="edit_form" class="widget">
                                        <div class="widget-header">
                                            <h2 class="title">Update Label</h2>
                                        </div>
                                        <div class="widget-body">
                                            <form name="update_label_form" ng-submit="updateLabel(update_label_form.$valid)" novalidate>
                                                <div class="form-group">
                                                    <label>Label Name</label>
                                                    <div class="input text">
                                                        <input type="text" ng-model="LabelObj.name" name="u_label_name" class="form-control" placeholder="Name of label" required="required">
                                                        <div ng-if="update_label_form.u_label_name.$dirty || isLabelFormSubmitted">
                                                            <p ng-show="update_label_form.u_label_name.$error.required"  class="error-message">Label name is required</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Label Color</label>
                                                    <div class="input text">
                                                        <color-picker ng-model="LabelObj.color_code" options="color_options"></color-picker>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="checkbox checkbox-theme checkbox-circle">
                                                        <input id="checkbox8" type="checkbox" ng-model="LabelObj.status" ng-true-value="1" ng-false-value="2">
                                                        <label for="checkbox8">
                                                            Is Active?
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <button class="btn btn-success">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /Edit label form -->
                                </div>

                                <div class="col-lg-7 col-md-7" ng-show="label.count > 0 || searched_labels"  block-ui="myBlockUI">
                                    <div class="widget">
                                        <div class="widget-header">
                                            <div class="pull-left">
                                                <h2>Lists of Label</h2>
                                                <span>{{label.count}} result found</span>
                                            </div>
                                            <div class="filter_block pull-right" style="margin-right: 0px;">
                                                <input class="form-control" ng-model="label_query" ng-change="searchLabel(label_query)" placeholder="Search label">
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="widget-body">
                                            <div ng-show="label.count > 0">
                                                <table class="table label_List">
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th class="hidden-xs">Color</th>
                                                        <th>Status</th>
                                                        <th class="hidden-xs">Last Modified</th>
                                                        <th class="text-right">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr ng-repeat="label in label.data">
                                                        <td>
                                                            <label class="app_label" style="background: {{label.color_code}}">{{label.name}}</label>
                                                        </td>
                                                        <td class="hidden-xs">{{label.color_code}}</td>
                                                        <td>
                                                            <span class="status-text test status-text-green" ng-show="label.status == 1">Active</span>
                                                            <span class="status-text status-text-danger" ng-show="label.status == 2">Inactive</span>
                                                        </td>
                                                        <td class="hidden-xs">{{label.modified | date}}</td>
                                                        <td class="text-right">
                                                            <a ng-click="openEditLabel(label.id)" class="btn-small btn-small-primary">Edit</a>
                                                            <a ng-click="deleteLabel(label.id)" class="btn-small btn-small-red">Delete</a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                <div class="pagination_area text-center">
                                                    <a ng-show="label.limit < label.count" class="pull-left previous_page" ng-click="goPreviousPage()"><span aria-hidden="true">&laquo;</span> Previous</a>
                                                    <span>
                                    showing {{((label.currentPage - 1) * label.limit) + 1}} -
                                    {{label.currentPage * label.limit > label.count ? label.count : label.currentPage * label.limit}}
                                    of {{label.count}} records
                                </span>
                                                    <a ng-show="label.limit < label.count" class="pull-right next_page" ng-click="goNextPage()">Next <span aria-hidden="true">&raquo;</span></a>
                                                </div>

                                            </div>

                                            <div class="not-found" ng-show="label.count < 1">
                                                <h4>Sorry, label not found!</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-10 col-lg-offset-1" ng-show="label.count < 1 && !show_crate_form && !searched_labels">
                                    <div class="empty_block">
                    <span class="icon" style="padding: 24px 13px 18px 17px;">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                    </span>
                                        <br/>
                                        <br/>
                                        <h2>Welcome to Task Label!</h2>
                                        <p class="lead">Task labels are used to categorized your tasks list. With the task label, you can be labeling your task and assign them based on your needs. And also it's helpful to filter your task list.</p>
                                        <br/>
                                        <a class="btn-lg-theme" ng-click="show_crate_form = true">Create first label</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="project_users">
                    <h2>Project users</h2>
                </div>
                <div class="tab-pane" id="project_attachments">
                    <?php if(count($project['attachments']) > 0):?>
                        <strong>Attachments: </strong>
                        <?php foreach ($project['attachments'] as $attachment):?>
                            <p>
                                <a href="{{BASE_URL}}tasks/download_attachment/<?php echo $attachment->uuid;?>"><i class="fa fa-paperclip"></i> <?php echo $attachment->uuid;?></a>
                            </p>
                        <?php endforeach;?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/LabelsCtrl']);
echo $this->end();
?>

