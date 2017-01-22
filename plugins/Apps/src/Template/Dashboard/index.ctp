<?php echo $this->assign('title', 'My Dashboard'); ?>

<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Dashboard', ['controller' => 'dashboard', 'action' => 'index'], ['class' => 'link']);?>
        <p class="sub-title">Most recent projects</p>
    </h2>
    <div class="pull-right btn-areas">
        <?php echo $this->Html->link('Project List', ['controller' => 'projects', 'action' => 'index'], ['class' => 'btn btn-success']);?>
    </div>

    <div class="clearfix"></div>
</div>


<div class="row">
    <div class="col-lg-3">
        <div class="project_overview_widget">
            <h3>Preview Technologies Limited</h3>
            <p>Vestibulum ac diam sit amet quamlum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Sed porttitor lectus nibh. Praesent sapien massa, convallis a pe</p>
            <small><i class="fa fa-calendar"></i> Started at 25 Jan 2017</small>
            <ul class="overview_list">
                <li><strong>User Assigned:</strong> <span class="bg-black">5</span></li>
                <li><strong>Total Label:</strong> <span class="bg-orange">5</span></li>
                <li><strong>Open Task:</strong> <span class="bg-green">5</span></li>
                <li><strong>Closed Task:</strong> <span><a>Not Yet</a></span></li>
            </ul>
            <a class="btn btn-success btn-block">Manage Project</a>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="project_overview_widget">
            <h3>Preview Technologies Limited</h3>
            <p>Vestibulum ac diam sit amet quamlum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Sed porttitor lectus nibh. Praesent sapien massa, convallis a pe</p>
            <small><i class="fa fa-calendar"></i> Started at 25 Jan 2017</small>
            <ul class="overview_list">
                <li><strong>User Assigned:</strong> <span class="bg-black">5</span></li>
                <li><strong>Total Label:</strong> <span class="bg-orange">5</span></li>
                <li><strong>Open Task:</strong> <span class="bg-green">5</span></li>
                <li><strong>Closed Task:</strong> <span><a>Not Yet</a></span></li>
            </ul>
            <a class="btn btn-success btn-block">Manage Project</a>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="project_overview_widget">
            <h3>Preview Technologies Limited</h3>
            <p>Vestibulum ac diam sit amet quamlum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Sed porttitor lectus nibh. Praesent sapien massa, convallis a pe</p>
            <small><i class="fa fa-calendar"></i> Started at 25 Jan 2017</small>
            <ul class="overview_list">
                <li><strong>User Assigned:</strong> <span class="bg-black">5</span></li>
                <li><strong>Total Label:</strong> <span class="bg-orange">5</span></li>
                <li><strong>Open Task:</strong> <span class="bg-green">5</span></li>
                <li><strong>Closed Task:</strong> <span><a>Not Yet</a></span></li>
            </ul>
            <a class="btn btn-success btn-block">Manage Project</a>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="project_overview_widget">
            <h3>Preview Technologies Limited</h3>
            <p>Vestibulum ac diam sit amet quamlum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Sed porttitor lectus nibh. Praesent sapien massa, convallis a pe</p>
            <small><i class="fa fa-calendar"></i> Started at 25 Jan 2017</small>
            <ul class="overview_list">
                <li><strong>User Assigned:</strong> <span class="bg-black">5</span></li>
                <li><strong>Total Label:</strong> <span class="bg-orange">5</span></li>
                <li><strong>Open Task:</strong> <span class="bg-green">5</span></li>
                <li><strong>Closed Task:</strong> <span><a>Not Yet</a></span></li>
            </ul>
            <a class="btn btn-success btn-block">Manage Project</a>
        </div>
    </div>
</div>

<?php
echo $this->start('jsBottom');
echo $this->end();
?>
