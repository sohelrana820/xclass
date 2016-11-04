<?php echo $this->assign('title', 'New Project');?>
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
                        <span>Please provide all valid information to create new project</span>
                    </div>
                    <div class="widget-body">
                        <?php echo $this->Form->create($project, ['controller' => 'projects', 'action' => 'add']);?>
                            <div class="form-group">
                                <label>Name of Project</label>
                                <div class="input text">
                                    <?php echo $this->Form->input('project.name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Name of project', 'label' => false, 'required' => false]);?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Project Slug</label>
                                <div class="input text">
                                    <input type="text" name="project[slug]" class="form-control" placeholder="Project slug">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Project Description</label>
                                <div class="input text">
                                    <textarea name="project[description]" rows="8" class="form-control" placeholder="Project description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Note</label>
                                <div class="input text">
                                    <textarea name="project[note]" rows="4" class="form-control" placeholder="Project note"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <div class="input text">
                                    <select name="project[status]" class="form-control">
                                        <option value="">Choose status</option>
                                        <option value="1">Progressing</option>
                                        <option value="2">Paused</option>
                                        <option value="3">Invalid</option>
                                        <option value="4">Completed</option>
                                    </select>
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
