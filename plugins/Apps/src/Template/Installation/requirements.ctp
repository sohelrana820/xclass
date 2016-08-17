<?php echo $this->assign('title', 'Requirements Analysis'); ?>

<div class="text-left" >
    <h2 class="text-center">Requirements Analysis</h2>
    <br/>

    <ul class="nav-list requirement_list">
        <?php foreach($requirements['data'] as $requirement):?>
        <li>
            <?php if($requirement['result']):?>
                <a class="install_ok"><i class="fa fa-check"></i></a>
            <?php else:?>
                <a class="install_error"><i class="fa fa-times"></i></a>
            <?php endif;?>
            <?php echo $requirement['mgs']?>
        </li>
        <?php endforeach;?>
    </ul>

    <a class="btn btn-success btn-lg" href="/installation/requirements">Check Again!</a>

    <?php if($requirements['success']):?>
        <a class="btn btn-success btn-lg" href="/installation/database">Next Process</a>
    <?php endif;?>
</div>