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

        <li class="active">
            <?php echo $this->Html->link('<i class="fa fa-user"></i> My Profile', ['controller' => 'profile', 'action' => 'index'], ['escape' => false]); ?>
        </li>

        <li class="active">
            <?php echo $this->Html->link('<i class="fa fa-user"></i> My Courses', ['controller' => 'profile', 'action' => 'courses'], ['escape' => false]); ?>
        </li>

        <li class="active">
            <?php echo $this->Html->link('<i class="fa fa-book"></i> Available Course', ['controller' => 'courses', 'action' => 'index'], ['escape' => false]); ?>
        </li>

        <li class="active">
            <?php echo $this->Html->link('<i class="fa fa-file"></i> Available Documents', ['controller' => 'documents', 'action' => 'index'], ['escape' => false]); ?>
        </li>

        <li class="active">
            <?php echo $this->Html->link('<i class="fa fa-file"></i> My Download History', ['controller' => 'documents', 'action' => 'download-histories'], ['escape' => false]); ?>
        </li>
    </ul>

    <!-- Copyright area -->
    <footer class="copyright">
        <div class="container-fluid">
            <p class="copy-text">
                <?php echo isset($settings['copyright']) ? $settings['copyright'] : 'Copyright ' . date('Y')?>
            </p>
        </div>
    </footer>
    <!-- /#Copyright area -->
</div>