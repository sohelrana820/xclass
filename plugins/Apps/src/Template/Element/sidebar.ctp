<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <?php echo $this->Html->image($appsLogo, ['class' => 'logo', 'url' => ['controller' => 'dashboard', 'action' => 'index'], ['class' => 'navbar-brand']]);?>
        </li>
        <li class="active">
            <?php echo $this->Html->link('<i class="fa fa-fw fa-dashboard"></i> Dashboard', ['controller' => 'dashboard', 'action' => 'index'], ['escape' => false]); ?>
        </li>
        <?php if($userInfo->role == 1):?>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="users" class="submenu collapse">
                    <li>
                        <?php echo $this->Html->link('Add', ['controller' => 'users', 'action' => 'add'], ['escape' => false]); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link('List', ['controller' => 'users', 'action' => 'index'], ['escape' => false]); ?>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
        <li>
            <?php echo $this->Html->link('<i class="fa fa-fw fa-tags"></i> Task Label', ['controller' => 'labels', 'action' => 'index'], ['escape' => false]); ?>
        </li>
        <li>
            <?php echo $this->Html->link('<i class="fa fa-fw fa-signal"></i> Task', ['controller' => 'tasks', 'action' => 'index'], ['escape' => false]); ?>
        </li>
        <li class="dropdown visible-xs visible-sm">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userInfo->profile->name?> <b class="caret"></b></a>
            <ul class="dropdown-menu header_nav">
                <li>
                    <?php echo $this->Html->link('<i class="fa fa-user"></i> My Profile', ['controller' => null, 'action' => 'profile'], ['escape' => false]);?>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <?php echo $this->Html->link('<i class="fa fa-fw fa-power-off"></i> Log Out', ['controller' => 'users', 'action' => 'logout'], ['escape' => false]); ?>
                </li>
            </ul>
        </li>
        <li>
            <?php echo $this->Html->link('<i class="fa fa-fw fa-gears"></i> Settings', ['controller' => 'settings', 'action' => 'index'], ['escape' => false]); ?>
        </li>
    </ul>

    <!-- Copyright area -->
    <footer class="copyright">
        <div class="container-fluid">
            <p class="copy-text">Copyright <?php echo $appsName;?> © <?php echo date('Y')?></p>
        </div>
    </footer>
    <!-- /#Copyright area -->
</div>