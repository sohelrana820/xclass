<?php echo $this->assign('title', 'My Profile'); ?>

    <div class="page-header">
        <h2 class="title pull-left">
            My Profile
            <p class="sub-title"></p>
        </h2>
        <div class="pull-right btn-areas">
            <?php
                    echo $this->Html->link('My Profile', ['controller' => 'users', 'action' => 'profile'], ['class' => 'btn btn-info', 'escape' => false]);

                    echo $this->Html->link('Update Profile', ['controller' => 'users', 'action' => 'update'], ['class' => 'btn btn-info', 'escape' => false]);

                    echo $this->Html->link('Change Password', ['controller' => 'users', 'action' => 'change_password'], ['class' => 'btn btn-info', 'escape' => false]);
            ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="row">
        <!-- left column -->
        <div class="col-md-2 col-sm-4 col-xs-12">
            <?php echo $this->element('profile_photo');?>
        </div>
        <!-- edit form column -->
        <div class="col-md-10 col-sm-8 col-xs-12 personal-info">
            <ul class="data-list data-list-stripe">
                <li><strong>Name: </strong> <?php echo $user->profile->name ? $user->profile->name : 'N/A';?></li>
                <li><strong>Email: </strong> <?php echo $user->username;?></li>
                <li>
                    <strong>Phone: </strong>
                    <?php
                    if($user->profile->phone){
                        echo $user->profile->phone;
                    }
                    else{
                        echo 'N/A';
                    }
                    ?>
                </li>
                <li>
                    <strong>Birthday: </strong>
                    <?php
                    if($user->profile->birthday){
                        echo $this->Time->format($user->profile->birthday, 'dd MMM, Y');
                    }
                    else{
                        echo 'N/A';
                    }
                    ?>
                </li>
                <li>
                    <strong>Gender: </strong>
                    <?php if ($user->profile->gender == 1): ?>
                        <span class="orange">Male (<i class="fa fa-male"></i>)</span>
                    <?php elseif ($user->gender == 2): ?>
                        <span class="green">Female (<i class="fa fa-female"></i>)</span>
                    <?php else: ?>
                        N/A
                    <?php endif; ?>
                </li>

                <li>
                    <strong>Street 1: </strong>
                    <?php
                    if($user->profile->street_1){
                        echo $user->profile->street_1;
                    }
                    else{
                        echo 'N/A';
                    }
                    ?>
                </li>
                <li>
                    <strong>Street 2: </strong>
                    <?php
                    if($user->profile->street_2){
                        echo $user->profile->street_2;
                    }
                    else{
                        echo 'N/A';
                    }
                    ?>
                </li>
                <li>
                    <strong>City: </strong>
                    <?php
                    if($user->profile->city){
                        echo $user->profile->street_2;
                    }
                    else{
                        echo 'N/A';
                    }
                    ?>
                </li>
                <li>
                    <strong>State: </strong>
                    <?php
                    if($user->profile->state){
                        echo $user->profile->state;
                    }
                    else{
                        echo 'N/A';
                    }
                    ?>
                </li>
                <li>
                    <strong>Postal code: </strong>
                    <?php
                    if($user->profile->postal_code){
                        echo $user->profile->postal_code;
                    }
                    else{
                        echo 'N/A';
                    }
                    ?>
                </li>
                <li>
                    <strong>Country: </strong>
                    <?php
                    if($user->profile->country){
                        echo $user->profile->country;
                    }
                    else{
                        echo 'N/A';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>

<?php
$this->start('cssTop');

$this->end();

$this->start('jsTop');

$this->end();

$this->start('jsBottom');

$this->end();
?>