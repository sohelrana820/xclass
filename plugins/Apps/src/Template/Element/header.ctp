<ul class="nav navbar-right top-nav">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userInfo->profile->name?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li>
                <?php echo $this->Html->link('My Profile', ['controller' => null, 'action' => 'profile']);?>
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
</ul>