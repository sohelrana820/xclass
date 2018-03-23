<?php echo $this->assign('title', 'My Dashboard'); ?>

<div ng-controller="FeedsCtrl">
    <div class="page-header">
        <h2 class="title pull-left">
            <?php echo $this->Html->link('Application Feeds', ['controller' => 'dashboard', 'action' => 'index'], ['class' => 'link', 'escape' => false]);?>
        </h2>
        <div class="clearfix"></div>

        <div class="center_loader" ng-show="feed_loader">
            <h4>Please wait...</h4>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-10 col-lg-offset-1" ng-show="feeds.count_all < 1">
            <div class="empty_block">
            <span class="icon">
                <i class="fa fa-bell-o" aria-hidden="true"></i>
            </span>
                <br/>
                <br/>
                <h2>Welcome to Feeds!</h2>
                <p class="lead red">Sorry, no feeds found!</p>
                <br/>
            </div>
        </div>
    </div>

    <div class="project-feeds col-lg-12" ng-show="feeds.count_all > 0">
        <div class="timeline-area">
            <h2 class="sm-title">
                Project Feeds
                <span class="interval-loader" ng-show="feed_loader">
                    <img  ng-src="{{BASE_URL}}/img/loader2.gif">
                </span>
            </h2>
            <div class="select_profile-feeds">
                <select ng-change="chooseProject(slug)" ng-model="slug" ng-init="slug = 'all'" class="form-control">
                    <option value="all">All Project</option>
                    <option ng-repeat="project in projects" value="{{project.slug}}">{{project.name}}</option>
                </select>
            </div>
            <ul class="timeline">
                <li ng-repeat="feed in feeds.data">
                    <div class="timeline-panel">
                        <p class="timeline-time">
                            <i class="fa fa-clock-o"></i>
                            {{feed.created | date}}
                            <span>({{feed.created | date : 'HH:m a'}})</span>
                        </p>
                        <div class="timeline-body" ng-bind-html="trustAsHtml(feed.title)"></div>
                        <a href="{{BASE_URL}}projects/{{feed.project.slug}}" class="label label-info project-btn">{{feed.project.name}}</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <br/>
        <br/>
        <div class="pagination_area text-center" ng-show="feeds.count > 0">
            <a class="pull-left previous_page" ng-click="goPreviousPage()">
                <span aria-hidden="true">&laquo;</span> Previous
            </a>
            <a>
            <span>
                showing {{((feeds.currentPage - 1) * feeds.limit) + 1}} -
                {{feeds.currentPage * feeds.limit > feeds.count ? feeds.count : feeds.currentPage * feeds.limit}}
                of {{feeds.count}} records
            </span>
            </a>
            <a class="pull-right next_page" ng-click="goNextPage()">
                Next <span aria-hidden="true">&raquo;</span>
            </a>
        </div>
        <br/>
        <br/>
    </div>
</div>

<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/FeedsCtrl']);
echo $this->end();
?>
