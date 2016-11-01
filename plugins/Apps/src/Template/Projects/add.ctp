<?php echo $this->assign('title', 'Manage Label');?>
<div ng-controller="ProjectsCtrl">
    <div>
        <div class="page-header">
            <h2 class="title pull-left">
                Manage Project
            </h2>
            <div class="pull-right btn-areas">

            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <!-- Create project form -->
                <div class="widget">
                    <div class="widget-header">
                        <h2>
                            New Project
                        </h2>
                        <span>Please provide all valid information to create new task TASKS LIST</span>
                    </div>
                    <div class="widget-body">
                        <form name="create_label_form" ng-submit="saveLabel(create_label_form.$valid)" novalidate>
                            <div class="form-group">
                                <label>Name of Project</label>
                                <div class="input text">
                                    <input type="text" ng-model="projectObj.name" name="c_label_name" class="form-control" placeholder="Name of label" required="required">
                                    <div ng-if="create_label_form.c_label_name.$dirty || isLabelFormSubmitted">
                                        <p ng-show="create_label_form.c_label_name.$error.required"  class="error-message">Label name is required</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Project Description</label>
                                <div class="input text">
                                    <textarea ng-model="projectObj.description" rows="8" class="form-control" placeholder="Name of label"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Note</label>
                                <div class="input text">
                                    <textarea ng-model="projectObj.name" rows="4" class="form-control" placeholder="Name of label"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">Create Project</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Create project form -->
            </div>
        </div>
    </div>
</div>
<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/ProjectsCtrl']);
echo $this->end();
?>
