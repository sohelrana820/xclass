<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <?php echo $this->Html->image($appsLogo, ['class' => 'logo', 'url' => ['controller' => 'dashboard', 'action' => 'index'], ['class' => 'navbar-brand']]);?>
        </li>
        <li class="active">
            <?php echo $this->Html->link('<i class="fa fa-dashboard"></i> Dashboard', ['controller' => 'dashboard', 'action' => 'index'], ['escape' => false]); ?>
        </li>
        <li>
            <?php echo $this->Html->link('<i class="fa fa-feed"></i> Feeds', ['controller' => 'feeds', 'action' => 'index'], ['escape' => false]); ?>
        </li>
        <li>
            <?php echo $this->Html->link('<i class="fa fa-leaf"></i> My Projects', ['controller' => 'Projects', 'action' => 'index'], ['escape' => false]); ?>
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