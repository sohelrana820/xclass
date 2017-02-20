<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <?php echo $this->Html->image($appsLogo, ['class' => 'logo', 'url' => ['controller' => 'dashboard', 'action' => 'index'], ['class' => 'navbar-brand']]);?>
        </li>
        <li class="active">
            <?php echo $this->Html->link('<i class="fa fa-dashboard"></i> Dashboard', ['controller' => 'dashboard', 'action' => 'index'], ['escape' => false]); ?>
        </li>
        <?php if($userInfo->role == 1):?>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-users"></i> Users <i class="fa fa-caret-down"></i></a>
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
            <?php echo $this->Html->link('<i class="fa fa-feed"></i> Feeds', ['controller' => 'feeds', 'action' => 'index'], ['escape' => false]); ?>
        </li>
        <?php if($userInfo->role == 1):?>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#projects"><i class="fa fa-leaf"></i> Projects <i class="fa fa-caret-down"></i></a>
            <ul id="projects" class="submenu collapse">
                <li>
                    <?php echo $this->Html->link('Create', ['controller' => 'projects', 'action' => 'create'], ['escape' => false]); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('List', ['controller' => 'projects', 'action' => 'index'], ['escape' => false]); ?>
                </li>
            </ul>
        </li>
        <?php else:?>
            <li>
                <?php echo $this->Html->link('<i class="fa fa-leaf"></i> My Projects', ['controller' => 'Projects', 'action' => 'index'], ['escape' => false]); ?>
            </li>
        <?php endif?>
        <li>
            <?php echo $this->Html->link('<i class="fa fa-gears"></i> Settings', ['controller' => 'settings', 'action' => 'index'], ['escape' => false]); ?>
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