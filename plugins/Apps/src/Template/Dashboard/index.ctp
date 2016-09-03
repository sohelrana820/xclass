<?php echo $this->assign('title', 'My Dashboard'); ?>

<div class="page-header">
    <h2 class="title pull-left">
        Dashboard
        <p class="sub-title"></p>
    </h2>
    <div class="pull-right btn-areas">

    </div>
    <div class="clearfix"></div>
</div>


<?php if ($overview['total_user'] < 2): ?>
    <div class="alert alert-warning alert-dismissible fade in text-left static_message" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Create First User:</strong> You didn't create any user yet!.
        Please <?php echo $this->Html->link('click here', ['controller' => 'users', 'action' => 'add']); ?> to create
        your first user.
    </div>
<?php endif; ?>

<?php if ($overview['total_label'] < 1): ?>
    <div class="alert alert-warning alert-dismissible fade in text-left static_message" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Create First Label:</strong> You didn't create any label yet!.
        Please <?php echo $this->Html->link('click here', ['controller' => 'labels', 'action' => 'index']); ?> to create
        your first label
    </div>
<?php endif; ?>

<?php if ($overview['total_open_task'] + $overview['total_closed_task'] < 1): ?>
    <div class="alert alert-warning alert-dismissible fade in text-left static_message" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Create First Task:</strong> You didn't create any task yet!.
        Please <?php echo $this->Html->link('click here', ['controller' => 'tasks', 'action' => 'index']); ?> to create
        your first task
    </div>
<?php endif; ?>

<div class="ui-kit-19">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 cod-pad">
            <!-- Item -->
            <div class="ui-item bg-teal">
                <div class="clearfix">
                    <div class="pull-left">
                        <h2><?php echo $overview['total_user'];?></h2>
                        <h4 class="color-teal-50">
                            <i class="fa fa-user"></i>
                            Total Users
                        </h4>
                    </div>
                    <div class="pull-right">
                        <i class="fa fa-users color-teal-100"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 cod-pad">
            <!-- Item -->
            <div class="ui-item bg-red">
                <div class="clearfix">
                    <div class="pull-left">
                        <h2><?php echo $overview['total_label'];?></h2>
                        <h4 class="color-red-50">
                            <i class="fa fa-tag"></i>
                            Total Label
                        </h4>
                    </div>
                    <div class="pull-right">
                        <i class="fa fa-tags color-red-100"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 cod-pad">
            <!-- Item -->
            <div class="ui-item bg-blue">
                <div class="clearfix">
                    <div class="pull-left">
                        <h2><?php echo $overview['total_open_task'];?></h2>
                        <h4 class="color-blue-50 ">
                            <i class="fa fa-bell-o"></i>
                            Total Open Task
                        </h4>
                    </div>
                    <div class="pull-right">
                        <i class="fa fa-bell-o color-blue-100"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 cod-pad">
            <!-- Item -->
            <div class="ui-item bg-blue-grey">
                <div class="clearfix">
                    <div class="pull-left">
                        <h2><?php echo $overview['total_closed_task'];?></h2>
                        <h4 class="color-blue-grey-50">
                            <i class="fa fa-bell-slash-o"></i>
                            Total Closed Task
                        </h4>
                    </div>
                    <div class="pull-right">
                        <i class="fa fa-bell-slash-o color-blue-grey-100 "></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-6">
                <div class="ui-kit-21">
                    <div class="ui-item">
                        <!-- Comment Center -->
                        <div class="comment-center">
                            <!-- Comment Body -->
                            <div class="comment-body">
                                <!-- User img -->
                                <div class="user-img">
                                    <?php echo $this->Html->image($appsLogo, ['class' => 'profile-image']); ?>
                                </div>
                                <!-- Mail Contnet -->
                                <div class="mail-contnet">
                                    <h5>Pavan kumar</h5>
                                    <!-- Mail -->
                                    <span class="mail-desc">
                                        Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.
                                    </span>
                                    <!-- Bottom -->
                                    <span class="bottom">
                                        <div class="pull-right date">
                                            April 14, 2016
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <!-- Comment Body -->
                            <div class="comment-body">
                                <!-- User img -->
                                <div class="user-img">
                                    <?php echo $this->Html->image($appsLogo, ['class' => 'profile-image']); ?>
                                </div>
                                <!-- Mail Contnet -->
                                <div class="mail-contnet">
                                    <h5>Sonu Nigam</h5>
                                    <!-- Mail -->
                                    <span class="mail-desc">
                                        Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.
                                    </span>
                                    <!-- Bottom -->
                                    <span class="bottom">
                                        <div class="pull-right date">
                                            Approved
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <!-- Comment Body -->
                            <div class="comment-body">
                                <!-- User img -->
                                <div class="user-img">
                                    <?php echo $this->Html->image($appsLogo, ['class' => 'profile-image']); ?>
                                </div>
                                <!-- Mail Contnet -->
                                <div class="mail-contnet">
                                    <h5>Sonu Nigam</h5>
                                    <!-- Mail -->
                                    <span class="mail-desc">
                                        Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.
                                    </span>
                                    <!-- Bottom -->
                                    <span class="bottom">
                                        <div class="pull-right date">
                                            Approved
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <!-- Comment Body -->
                            <div class="comment-body">
                                <!-- User img -->
                                <div class="user-img">
                                    <?php echo $this->Html->image($appsLogo, ['class' => 'profile-image']); ?>
                                </div>
                                <!-- Mail Contnet -->
                                <div class="mail-contnet">
                                    <h5>Sonu Nigam</h5>
                                    <!-- Mail -->
                                    <span class="mail-desc">
                                        Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.
                                    </span>
                                    <!-- Bottom -->
                                    <span class="bottom">
                                        <div class="pull-right date">
                                            Approved
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <!-- Comment Body -->
                            <div class="comment-body">
                                <!-- User img -->
                                <div class="user-img">
                                    <?php echo $this->Html->image($appsLogo, ['class' => 'profile-image']); ?>
                                </div>
                                <!-- Mail Contnet -->
                                <div class="mail-contnet">
                                    <h5>Arijit Sinh</h5>
                                    <!-- Mail -->
                                    <span class="mail-desc">
                                        Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.
                                    </span>
                                    <!-- Bottom -->
                                    <span class="bottom">
                                        <div class="pull-right date">
                                            April 14, 2016
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="widget no-border">
                    <div class="widget-body">
                        <table class="table theme-table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <a href="/task-manager/users/view/1e3951ba-7572-4eb1-a8e3-e24d92b5408b">MIta Yesmin</a></td>
                                <td>
                                    mita@previewtechs.com
                                </td>
                                <td class="text-right">
                                    <a href="/task-manager/users/view/1e3951ba-7572-4eb1-a8e3-e24d92b5408b" class="icons green">
                                        <i class="fa fa-gear"></i>
                                    </a>
                                    <a href="/task-manager/users/edit/1e3951ba-7572-4eb1-a8e3-e24d92b5408b" class="icons">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="/task-manager/users/delete/1e3951ba-7572-4eb1-a8e3-e24d92b5408b" class="icons red">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="/task-manager/users/view/1e3951ba-7572-4eb1-a8e3-e24d92b5408b">MIta Yesmin</a></td>
                                <td>
                                    mita@previewtechs.com
                                </td>
                                <td class="text-right">
                                    <a href="/task-manager/users/view/1e3951ba-7572-4eb1-a8e3-e24d92b5408b" class="icons green">
                                        <i class="fa fa-gear"></i>
                                    </a>
                                    <a href="/task-manager/users/edit/1e3951ba-7572-4eb1-a8e3-e24d92b5408b" class="icons">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="/task-manager/users/delete/1e3951ba-7572-4eb1-a8e3-e24d92b5408b" class="icons red">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="/task-manager/users/view/1e3951ba-7572-4eb1-a8e3-e24d92b5408b">MIta Yesmin</a></td>
                                <td>
                                    mita@previewtechs.com
                                </td>
                                <td class="text-right">
                                    <a href="/task-manager/users/view/1e3951ba-7572-4eb1-a8e3-e24d92b5408b" class="icons green">
                                        <i class="fa fa-gear"></i>
                                    </a>
                                    <a href="/task-manager/users/edit/1e3951ba-7572-4eb1-a8e3-e24d92b5408b" class="icons">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="/task-manager/users/delete/1e3951ba-7572-4eb1-a8e3-e24d92b5408b" class="icons red">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="/task-manager/users/view/1e3951ba-7572-4eb1-a8e3-e24d92b5408b">MIta Yesmin</a></td>
                                <td>
                                    mita@previewtechs.com
                                </td>
                                <td class="text-right">
                                    <a href="/task-manager/users/view/1e3951ba-7572-4eb1-a8e3-e24d92b5408b" class="icons green">
                                        <i class="fa fa-gear"></i>
                                    </a>
                                    <a href="/task-manager/users/edit/1e3951ba-7572-4eb1-a8e3-e24d92b5408b" class="icons">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="/task-manager/users/delete/1e3951ba-7572-4eb1-a8e3-e24d92b5408b" class="icons red">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="/task-manager/users/view/1e3951ba-7572-4eb1-a8e3-e24d92b5408b">MIta Yesmin</a></td>
                                <td>
                                    mita@previewtechs.com
                                </td>
                                <td class="text-right">
                                    <a href="/task-manager/users/view/1e3951ba-7572-4eb1-a8e3-e24d92b5408b" class="icons green">
                                        <i class="fa fa-gear"></i>
                                    </a>
                                    <a href="/task-manager/users/edit/1e3951ba-7572-4eb1-a8e3-e24d92b5408b" class="icons">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="/task-manager/users/delete/1e3951ba-7572-4eb1-a8e3-e24d92b5408b" class="icons red">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <a class="see-all pull-right">See all</a>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="widget no-border">
                    <div class="widget-body">
                        <table class="table theme-table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Color</th>
                                <th>Status</th>
                                <th class="text-right">Last Modified</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <label style="background: #1A3E52">Questions</label>
                                </td>
                                <td>#1A3E52</td>
                                <td>
                                    <span class="green">Active</span>
                                </td>
                                <td class="text-right">Sep 3, 2016</td>
                            </tr>
                            <tr>
                                <td>
                                    <label style="background: #1A3E52">Questions</label>
                                </td>
                                <td>#1A3E52</td>
                                <td>
                                    <span class="green">Active</span>
                                </td>
                                <td class="text-right">Sep 3, 2016</td>
                            </tr>
                            <tr>
                                <td>
                                    <label style="background: #1A3E52">Questions</label>
                                </td>
                                <td>#1A3E52</td>
                                <td>
                                    <span class="green">Active</span>
                                </td>
                                <td class="text-right">Sep 3, 2016</td>
                            </tr>
                            <tr>
                                <td>
                                    <label style="background: #1A3E52">Questions</label>
                                </td>
                                <td>#1A3E52</td>
                                <td>
                                    <span class="green">Active</span>
                                </td>
                                <td class="text-right">Sep 3, 2016</td>
                            </tr>
                            <tr>
                                <td>
                                    <label style="background: #1A3E52">Questions</label>
                                </td>
                                <td>#1A3E52</td>
                                <td>
                                    <span class="green">Active</span>
                                </td>
                                <td class="text-right">Sep 3, 2016</td>
                            </tr>
                            </tbody>
                        </table>
                        <a class="see-all pull-right">See all</a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="ui-kit-9">
            <div class="col-mob">
                <!-- Item -->
                <div class="ui-item">
                    <!-- Heading -->
                    <div class="ui-heading clearfix">
                        <h5><a href="#">Sedunde omnis facil</a></h5>
                    </div>
                    <!-- Date -->
                    <span> 14/04/2013 <a href="#" class="label label-sm bg-red">High</a></span>
                    <!-- Paragraph -->
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque et etlaudantium explicabo dolorete.</p>
                </div>

                <!-- Item -->
                <div class="ui-item">
                    <!-- Heading -->
                    <div class="ui-heading clearfix">
                        <h5><a href="#">Sedunde omnis facil</a></h5>
                    </div>
                    <!-- Date -->
                    <span> 14/04/2013 <a href="#" class="label label-sm bg-red">High</a></span>
                    <!-- Paragraph -->
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque et etlaudantium explicabo dolorete.</p>
                </div>

                <!-- Item -->
                <div class="ui-item">
                    <!-- Heading -->
                    <div class="ui-heading clearfix">
                        <h5><a href="#">Sedunde omnis facil</a></h5>
                    </div>
                    <!-- Date -->
                    <span> 14/04/2013 <a href="#" class="label label-sm bg-red">High</a></span>
                    <!-- Paragraph -->
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque et etlaudantium explicabo dolorete.</p>
                </div>

                <!-- Item -->
                <div class="ui-item">
                    <!-- Heading -->
                    <div class="ui-heading clearfix">
                        <h5><a href="#">Sedunde omnis facil</a></h5>
                    </div>
                    <!-- Date -->
                    <span> 14/04/2013 <a href="#" class="label label-sm bg-red">High</a></span>
                    <!-- Paragraph -->
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque et etlaudantium explicabo dolorete.</p>
                </div>

                <!-- Item -->
                <div class="ui-item">
                    <!-- Heading -->
                    <div class="ui-heading clearfix">
                        <h5><a href="#">Sedunde omnis facil</a></h5>
                    </div>
                    <!-- Date -->
                    <span> 14/04/2013 <a href="#" class="label label-sm bg-red">High</a></span>
                    <!-- Paragraph -->
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque et etlaudantium explicabo dolorete.</p>
                </div>
            </div>
        </div>
    </div>
</div>

