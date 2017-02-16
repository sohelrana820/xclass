<?php echo $this->assign('title', 'My Dashboard'); ?>

<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Application Feeds', ['controller' => 'dashboard', 'action' => 'index'], ['class' => 'link', 'escape' => false]);?>
    </h2>
    <div class="clearfix"></div>
</div>

<div ng-controller="FeedsCtrl">
    <div class="timeline-area">
        <h2 class="sm-title">
            Project Feeds
            <span class="interval-loader" ng-show="feed_loader">
                <img  ng-src="{{BASE_URL}}/img/loader2.gif">
            </span>
        </h2>
        <ul class="timeline">
            <li ng-repeat="feed in feeds.data">
                <div class="timeline-panel">
                    <p class="timeline-time">
                        <i class="fa fa-clock-o"></i>
                        {{feed.created | date}}
                        <span>({{feed.created | date : 'HH:m a'}})</span>
                    </p>
                    <div class="timeline-body" ng-bind-html="trustAsHtml(feed.title)"></div>
                    <a href="{{BASE_URL}}projects/{{feed.project.slug}}" class="label label-info" style="margin-top: 10px; display: inline-block; padding: 2px 10px">{{feed.project.name}}</a>
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

<?php
echo $this->start('jsBottom');
echo $this->Html->script(['src/FeedsCtrl']);
echo $this->end();
?>
