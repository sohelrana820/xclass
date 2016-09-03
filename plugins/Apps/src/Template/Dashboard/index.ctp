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

<?php if ($overview['total_task'] < 1): ?>
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
                        <h2>1230</h2>
                        <h4 class="color-teal-50">
                            <i class="fa fa-plus"></i>
                            New Users
                        </h4>
                    </div>
                    <div class="pull-right">
                        <i class="fa fa-user-plus color-teal-100"></i>
                    </div>
                </div>
                <!-- progress -->
                <div class="progress">
                    <div class="progress-bar bg-teal-100" style="width:72%;"></div>
                </div>
                <h5 class="color-teal-50">Progress<span>72%</span></h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 cod-pad">
            <!-- Item -->
            <div class="ui-item bg-red">
                <div class="clearfix">
                    <div class="pull-left">
                        <h2>5613</h2>
                        <h4 class="color-red-50">
                            <i class="fa fa-plus"></i>
                            New Messages
                        </h4>
                    </div>
                    <div class="pull-right">
                        <i class="fa fa-envelope color-red-100"></i>
                    </div>
                </div>
                <!-- progress -->
                <div class="progress">
                    <div class="progress-bar bg-red-100 " style="width:80%;"></div>
                </div>
                <h5 class="color-red-50">Unread<span>80%</span></h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 cod-pad">
            <!-- Item -->
            <div class="ui-item bg-blue">
                <div class="clearfix">
                    <div class="pull-left">
                        <h2>343</h2>
                        <h4 class="color-blue-50 ">
                            <i class="fa fa-plus"></i>
                            Orders
                        </h4>
                    </div>
                    <div class="pull-right">
                        <i class="fa fa-shopping-cart color-blue-100"></i>
                    </div>
                </div>
                <!-- progress -->
                <div class="progress">
                    <div class="progress-bar bg-blue-100" style="width:45%;"></div>
                </div>
                <h5 class="color-blue-50">Unread<span>45%</span></h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 cod-pad">
            <!-- Item -->
            <div class="ui-item bg-blue-grey">
                <div class="clearfix">
                    <div class="pull-left">
                        <h2>152</h2>
                        <h4 class="color-blue-grey-50">
                            <i class="fa fa-plus"></i>
                            New Subscribers</h4>
                    </div>
                    <div class="pull-right">
                        <i class="fa fa-rss color-blue-grey-100 "></i>
                    </div>
                </div>
                <!-- progress -->
                <div class="progress">
                    <div class="progress-bar bg-blue-grey-100 " style="width:80%;"></div>
                </div>
                <h5 class="color-blue-grey-50">Unread<span>80%</span></h5>
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
                        <!-- Heading -->
                        <h3 class="Heading">
                            Recent Comments
                        </h3>
                        <!-- Comment Center -->
                        <div class="comment-center">
                            <!-- Comment Body -->
                            <div class="comment-body">
                                <!-- User img -->
                                <div class="user-img">
                                    <?php echo $this->Html->image($appsLogo, ['class' => 'img-circle']); ?>
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
                                        <div class="pull-left">
                                            <a href="#" class="btn bt-lbule">Pending</a>
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <!-- Comment Body -->
                            <div class="comment-body">
                                <!-- User img -->
                                <div class="user-img">
                                    <?php echo $this->Html->image($appsLogo, ['class' => 'img-circle']); ?>
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
                                        <div class="pull-left">
                                            <a href="#" class="btn bt-red">Pending</a>
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <!-- Comment Body -->
                            <div class="comment-body">
                                <!-- User img -->
                                <div class="user-img">
                                    <?php echo $this->Html->image($appsLogo, ['class' => 'img-circle']); ?>
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
                                        <div class="pull-left">
                                            <a href="#" class="btn bt-green">Pending</a>
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <!-- Comment Body -->
                            <div class="comment-body">
                                <!-- User img -->
                                <div class="user-img">
                                    <?php echo $this->Html->image($appsLogo, ['class' => 'img-circle']); ?>
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
                                        <div class="pull-left">
                                            <a href="#" class="btn bt-yellow">Pending</a>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <table class="table theme-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>User Type</th>
                        <th>Status</th>
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
                        <td>
                            515 599 6566
                        </td>
                        <td>
                            <span class="orange">Male (<i class="fa fa-male"></i>)</span>
                        </td>

                        <td>
                            <strong class="text-muted">Admin</strong>
                        </td>

                        <td>
                            <span class="green">Active</span>
                        </td>


                        <td class="text-right">
                            <a href="/task-manager/users/view/1e3951ba-7572-4eb1-a8e3-e24d92b5408b" class="icons green"><i
                                    class="fa fa-gear"></i></a><a href="/task-manager/users/edit/1e3951ba-7572-4eb1-a8e3-e24d92b5408b"
                                                                  class="icons"><i class="fa fa-pencil"></i></a><a
                                href="/task-manager/users/delete/1e3951ba-7572-4eb1-a8e3-e24d92b5408b" class="icons red"><i
                                    class="fa fa-trash"></i></a></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="/task-manager/users/view/32eaa120-278c-46ef-9f4b-0c776ca7dd1d">Shahariba Ronon</a></td>
                        <td>
                            shaharba@previewtechs.com
                        </td>
                        <td>
                            515 599 6566
                        </td>
                        <td>
                            N/A
                        </td>

                        <td>
                            <span class="text-muted" "="">General</span>
                        </td>

                        <td>
                            <span class="green">Active</span>
                        </td>


                        <td class="text-right">
                            <a href="/task-manager/users/view/32eaa120-278c-46ef-9f4b-0c776ca7dd1d" class="icons green"><i
                                    class="fa fa-gear"></i></a><a href="/task-manager/users/edit/32eaa120-278c-46ef-9f4b-0c776ca7dd1d"
                                                                  class="icons"><i class="fa fa-pencil"></i></a><a
                                href="/task-manager/users/delete/32eaa120-278c-46ef-9f4b-0c776ca7dd1d" class="icons red"><i
                                    class="fa fa-trash"></i></a></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="/task-manager/users/view/a7f77c41-6f60-442c-a0ed-093c892058a4">Shaharia Azam</a></td>
                        <td>
                            shaharia@previewtechs.com
                        </td>
                        <td>
                            515 599 6566
                        </td>
                        <td>
                            <span class="orange">Male (<i class="fa fa-male"></i>)</span>
                        </td>

                        <td>
                            <span class="text-muted" "="">General</span>
                        </td>

                        <td>
                            <span class="green">Active</span>
                        </td>


                        <td class="text-right">
                            <a href="/task-manager/users/view/a7f77c41-6f60-442c-a0ed-093c892058a4" class="icons green"><i
                                    class="fa fa-gear"></i></a><a href="/task-manager/users/edit/a7f77c41-6f60-442c-a0ed-093c892058a4"
                                                                  class="icons"><i class="fa fa-pencil"></i></a><a
                                href="/task-manager/users/delete/a7f77c41-6f60-442c-a0ed-093c892058a4" class="icons red"><i
                                    class="fa fa-trash"></i></a></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="/task-manager/users/view/3d7bb5f7-f226-4dd5-91ee-a9bedf1d3d1b">Faysal Khal</a></td>
                        <td>
                            faisal@previewtechs.com
                        </td>
                        <td>
                            515 599 6566
                        </td>
                        <td>
                            <span class="orange">Male (<i class="fa fa-male"></i>)</span>
                        </td>

                        <td>
                            <span class="text-muted" "="">General</span>
                        </td>

                        <td>
                            <span class="green">Active</span>
                        </td>


                        <td class="text-right">
                            <a href="/task-manager/users/view/3d7bb5f7-f226-4dd5-91ee-a9bedf1d3d1b" class="icons green"><i
                                    class="fa fa-gear"></i></a><a href="/task-manager/users/edit/3d7bb5f7-f226-4dd5-91ee-a9bedf1d3d1b"
                                                                  class="icons"><i class="fa fa-pencil"></i></a><a
                                href="/task-manager/users/delete/3d7bb5f7-f226-4dd5-91ee-a9bedf1d3d1b" class="icons red"><i
                                    class="fa fa-trash"></i></a></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="/task-manager/users/view/02817bda-74b9-4ee1-be4e-c16387afbcb0">Ariful Islam</a></td>
                        <td>
                            ariful@previewtechs.com
                        </td>
                        <td>
                            515 599 6566
                        </td>
                        <td>
                            <span class="orange">Male (<i class="fa fa-male"></i>)</span>
                        </td>

                        <td>
                            <strong class="text-muted">Admin</strong>
                        </td>

                        <td>
                            <span class="green">Active</span>
                        </td>


                        <td class="text-right">
                            <a href="/task-manager/users/view/02817bda-74b9-4ee1-be4e-c16387afbcb0" class="icons green"><i
                                    class="fa fa-gear"></i></a><a href="/task-manager/users/edit/02817bda-74b9-4ee1-be4e-c16387afbcb0"
                                                                  class="icons"><i class="fa fa-pencil"></i></a><a
                                href="/task-manager/users/delete/02817bda-74b9-4ee1-be4e-c16387afbcb0" class="icons red"><i
                                    class="fa fa-trash"></i></a></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="/task-manager/users/view/b4e55359-dfe0-40d8-913b-4dfb44917b7c">Sohel Rana</a></td>
                        <td>
                            me.sohelrana@gmail.com
                        </td>
                        <td>
                            N/A
                        </td>
                        <td>
                            N/A
                        </td>

                        <td>
                            <strong class="text-muted">Admin</strong>
                        </td>

                        <td>
                            <span class="green">Active</span>
                        </td>


                        <td class="text-right">
                            <a href="/task-manager/users/view/b4e55359-dfe0-40d8-913b-4dfb44917b7c" class="icons green"><i
                                    class="fa fa-gear"></i></a><a href="/task-manager/users/edit/b4e55359-dfe0-40d8-913b-4dfb44917b7c"
                                                                  class="icons"><i class="fa fa-pencil"></i></a><a
                                href="/task-manager/users/delete/b4e55359-dfe0-40d8-913b-4dfb44917b7c" class="icons red"><i
                                    class="fa fa-trash"></i></a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="ui-kit-9">
            <h2>Tasks</h2>

            <div class="col-md-12 col-sm-12 col-xs-12 col-mob">
                <!-- Item -->
                <div class="ui-item">
                    <!-- Heading -->
                    <div class="ui-heading clearfix">
                        <h5><a href="#">Sedunde omnis facil</a></h5>
                    </div>
                    <!-- Date -->
                    <span> 14/04/2013 <a href="#" class="label label-sm bg-red">High</a></span>
                    <!-- Paragraph -->
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque et et
                        laudantium explicabo dolorete.</p>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 col-mob">
                <!-- Item -->
                <div class="ui-item clearfix">
                    <!-- Heading -->
                    <div class="ui-heading clearfix">
                        <h5><a href="#">Atvero eoset accusa</a></h5>
                    </div>
                    <!-- Date -->
                    <span> 10/12/2013 <a href="#" class="label  label-sm bg-red">High</a></span>
                    <!-- Paragraph -->
                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                        deleniti atque corr.</p>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 col-mob">
                <!-- Item -->
                <div class="ui-item clearfix">
                    <!-- Heading -->
                    <div class="ui-heading clearfix">
                        <h5><a href="#">Earum quidem rerum</a></h5>
                    </div>
                    <!-- Date -->
                    <span> 09/11/2013 <a href="#" class="label label-sm bg-orange">Low</a></span> <!-- Paragraph -->
                    <p>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis
                        est eligendi optio cumque.</p>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 col-mob">
                <!-- Item -->
                <div class="ui-item clearfix">
                    <!-- Heading -->
                    <div class="ui-heading clearfix">
                        <h5><a href="#">Facilis Earum quidem </a></h5>
                    </div>
                    <!-- Date -->
                    <span> 01/03/2013 <a href="#" class="label label-sm bg-green">Medium</a></span>
                    <!-- Paragraph -->
                    <p>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis
                        est eligendi optio cumque.</p>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 col-mob">
                <!-- Item -->
                <div class="ui-item clearfix">
                    <!-- Heading -->
                    <div class="ui-heading clearfix">
                        <h5><a href="#">Righteous Indignation</a></h5>
                    </div>
                    <!-- Date -->
                    <span> 27/11/2013 <a href="#" class="label label-sm bg-orange">High</a></span> <!-- Paragraph -->
                    <p>Righteous indignation and dislike men who are so beguiled and demoralized of pleasure of the
                        moment.</p>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 col-mob">
                <!-- Item -->
                <div class="ui-item clearfix">
                    <!-- Heading -->
                    <div class="ui-heading clearfix">
                        <h5><a href="#">Nemo Enim Ipsam</a></h5>
                    </div>
                    <!-- Date -->
                    <span> 16/01/2013 <a href="#" class="label label-sm bg-green">Medium</a></span>
                    <!-- Paragraph -->
                    <p>Nemoipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit conseq magni dolores eos qui
                        ratione.</p>
                </div>
            </div>
        </div>
    </div>
</div>

