<?php echo $this->assign('title', 'Requirements Analysis'); ?>

<div class="text-left" >
    <h2 class="text-center">Requirements Analysis</h2>
    <br/>

    <ul class="nav-list requirement_list">
        <?php foreach($requirements['data'] as $requirement):?>
        <li>
            <?php if ($requirement['result'] == 'success'): ?>
                <a class="install_ok"><i class="fa fa-check"></i></a>
                <?php elseif($requirement['result'] == 'failed'): ?>
                <a class="install_error"><i class="fa fa-times"></i></a>
            <?php endif; ?>
            <?php echo $requirement['mgs']?>
        </li>
        <?php endforeach;?>
    </ul>

    <?php
    if(!$requirements['success']){
        echo $this->Html->link('Check Again!', ['controller' => 'installation', 'action' => 'requirements'], ['class' => 'btn btn-lg-theme']);
    }
    ?>

    <?php if($requirements['success']):?>
        <p class="lead">Congratulation! Your system meets all the requirements and your system is now ready for the installation!</p>
        <?php echo $this->Html->link('Next Process', ['controller' => 'installation', 'action' => 'database'], ['class' => 'btn btn-lg-theme']);?>
    <?php endif;?>
</div>