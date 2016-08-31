<?php echo $this->assign('title', 'Manage Label');?>
<div ng-controller="LabelsCtrl">
    <div class="page-header" ng-show="label.count > 0  || show_crate_form">
        <h2 class="title pull-left">
            Manage Application Labels
        </h2>
        <div class="pull-right btn-areas">

        </div>
        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-lg-5 col-md-5" ng-show="label.count > 0 || show_crate_form">
            <!-- Create label form -->
            <div ng-show="create_form" class="widget">
                <div class="widget-header">
                    <h2 class="title">New Label</h2>
                </div>
                <div class="widget-body">
                    <form name="create_label_form" ng-submit="saveLabel(create_label_form.$valid)" novalidate>
                        <div class="form-group">
                            <label>Label Name</label>
                            <div class="input text">
                                <input type="text" ng-model="LabelObj.name" name="c_label_name" class="form-control" placeholder="Name of label" required="required">
                                <div ng-if="create_label_form.c_label_name.$touched || isLabelFormSubmitted">
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
                                <div ng-if="update_label_form.u_label_name.$touched || isLabelFormSubmitted">
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
        <div class="col-lg-7 col-md-7" ng-show="label.count > 0"  block-ui="myBlockUI">
            <div ng-show="label.count > 0">
                <h2 class="md-header">
                    List of Label <br/>
                    <span>{{label.count}} result found</span>
                </h2>

                <table class="table label_List">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Status</th>
                        <th class="text-center">Last Modified</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="label in label.data">
                        <td>
                            <label class="app_label" style="background: {{label.color_code}}">{{label.name}}</label>
                        </td>
                        <td>{{label.color_code}}</td>
                        <td>
                            <span class="green" ng-show="label.status == 1">Active</span>
                            <span class="red" ng-show="label.status == 2">Inactive</span>
                        </td>
                        <td class="text-center">{{label.modified | date}}</td>
                        <td class="text-right">
                            <a ng-click="openEditLabel(label.id)" class="icons"><i class="fa fa-pencil"></i></a>
                            <a ng-click="deleteLabel(label.id)" class="icons red"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="pagination_area text-center">
                    <a class="pull-left previous_page" ng-click="goPreviousPage()"><span aria-hidden="true">&laquo;</span> Previous</a>
                    <span>
                        showing {{((label.currentPage - 1) * label.limit) + 1}} -
                        {{label.currentPage * label.limit > label.count ? label.count : label.currentPage * label.limit}}
                        of {{label.count}} records
                    </span>
                    <a class="pull-right next_page" ng-click="goNextPage()">Next <span aria-hidden="true">&raquo;</span></a
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-lg-offset-2" ng-show="label.count < 1 && !show_crate_form">
            <div class="empty_block">
                <span class="icon">
                    <i class="fa fa-bullhorn" aria-hidden="true"></i></span>
                <br/>
                <br/>
                <h2>Welcome to Task Label!</h2>
                <p class="lead">Task labels are used to categorized the your tasks list. With the task label you can labelling your task and assign them based on your needs. And also it's helpful to search your task list.</p>
                <br/>
                <a class="btn-lg-theme" ng-click="show_crate_form = true">Create first label</a>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/LabelsCtrl']);
echo $this->end();
?>
