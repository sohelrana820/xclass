<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li class="active">
            <?php echo $this->Html->link('<i class="fa fa-fw fa-dashboard"></i> Dashboard', ['controller' => 'dashboard', 'action' => 'index'], ['escape' => false]); ?>
        </li>
        <?php if($userInfo->role == 1):?>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo" class="collapse">
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
    </ul>
</div>