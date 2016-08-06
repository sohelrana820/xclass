<?php echo $this->assign('title', 'Manage Task');?>

<div class="page-header">
    <h2 class="title pull-left">
        Manage Task
    </h2>
    <div class="pull-right btn-areas">

    </div>
    <div class="clearfix"></div>
</div>

<div ng-controller="LabelsCtrl">
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="">
                <form>
                    <div class="form-group">
                        <label>Name</label>
                        <div class="input text">
                            <input type="text" ng-model="LabelObj.name" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Color Code</label>
                        <div class="input text">
                            <input type="color" ng-model="LabelObj.color_code" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-success" ng-click="saveLabel()">SAVE</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div style="margin-top: 25px">
                <!--<div class="not-found">
                    <h4 class="not-found text-center">Sorry, you don't have any label yet!</h4>
                </div>-->
                <div>
                    <h2 class="md-title">
                        List of Label <br/>
                        <span>50 result found</span>
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
                        <tr ng-repeat="label in labels">
                            <td>
                                <label style="background: {{label.color_code}}">{{label.name}}</label>
                            </td>
                            <td>{{label.color_code}}</td>
                            <td>
                                <span class="green" ng-show="label.status == 1">Active</span>
                                <span class="red" ng-show="label.status == 2">Inactive</span>
                            </td>
                            <td class="text-center">{{label.modified | date}}</td>
                            <td class="text-right">
                                <a href="/users/edit/2" class="icons"><i class="fa fa-pencil"></i></a>
                                <a href="/users/delete/2" class="icons red"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
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
