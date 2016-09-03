<ul class="nav navbar-right top-nav hidden-sm hidden-xs">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userInfo->profile->name?> <b class="caret"></b></a>
        <ul class="dropdown-menu header_nav">
            <li>
                <?php echo $this->Html->link('<i class="fa fa-user"></i> My Profile', ['controller' => null, 'action' => 'profile'], ['escape' => false]);?>
            </li>
            <li class="divider"></li>
            <li>
                <?php echo $this->Html->link('<i class="fa fa-fw fa-gears"></i> Settings', ['controller' => 'settings', 'action' => 'index'], ['escape' => false]); ?>
            </li>
            <li class="divider"></li>
            <li>
                <?php echo $this->Html->link('<i class="fa fa-fw fa-power-off"></i> Log Out', ['controller' => 'users', 'action' => 'logout'], ['escape' => false]); ?>
            </li>
        </ul>
    </li>
</ul>