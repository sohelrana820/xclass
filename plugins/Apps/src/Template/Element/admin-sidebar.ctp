<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <?php
            if($appsLogo) {
                echo $this->Html->image($appsLogo, ['class' => 'logo', 'url' => ['controller' => 'dashboard', 'action' => 'index']]);
            } else {
                echo $this->Html->image('logo.png', ['class' => 'logo', 'url' => ['controller' => 'dashboard', 'action' => 'index']]);
            }
            ?>
        </li>
        <li class="active">
            <?php echo $this->Html->link('<i class="fa fa-dashboard"></i> Dashboard', ['controller' => 'dashboard', 'action' => 'index'], ['escape' => false]); ?>
        </li>
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
        <li>
            <?php echo $this->Html->link('<i class="fa fa-gears"></i>  General Settings', ['controller' => 'settings', 'action' => 'general'], ['escape' => false]); ?>
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