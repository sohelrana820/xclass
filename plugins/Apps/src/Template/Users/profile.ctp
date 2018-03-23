<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Manage Profile', ['controller' => 'profile', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>My Profile</h2>
            <span>Your profile information</span>
        </div>
        <div class="pull-right btn-areas btn-margin">
            <?php
            echo $this->Html->link('My Profile', ['controller' => 'profile', 'action' => 'index'], ['class' => 'btn btn-info', 'escape' => false]);

            echo $this->Html->link('Update Profile', ['controller' => 'profile', 'action' => 'update'], ['class' => 'btn btn-info', 'escape' => false]);

            echo $this->Html->link('Change Password', ['controller' => 'profile', 'action' => 'change_password'], ['class' => 'btn btn-info', 'escape' => false]);
            ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <div class="row">
            <!-- left column -->
            <div class="col-md-2 col-sm-4 col-xs-12">
                <?php echo $this->element('profile_photo');?>
            </div>
            <!-- edit form column -->
            <div class="col-md-10 col-sm-8 col-xs-12 personal-info">
                <ul class="data-list data-list-stripe">
                    <li><strong>Name: </strong> <?php echo $profile->profile->name ? $profile->profile->name : 'N/A';?></li>
                    <li><strong>Email: </strong> <?php echo $profile->username;?></li>
                    <li>
                        <strong>Phone: </strong>
                        <?php
                        if($profile->profile->phone){
                            echo $profile->profile->phone;
                        }
                        else{
                            echo 'N/A';
                        }
                        ?>
                    </li>
                    <li>
                        <strong>Birthday: </strong>
                        <?php
                        if($profile->profile->birthday){
                            echo $this->Time->format($profile->profile->birthday, 'dd MMM, Y');
                        }
                        else{
                            echo 'N/A';
                        }
                        ?>
                    </li>
                    <li>
                        <strong>Gender: </strong>
                        <?php if ($profile->profile->gender == 1): ?>
                            <span class="orange">Male (<i class="fa fa-male"></i>)</span>
                        <?php elseif ($profile->profile->gender == 2): ?>
                            <span class="green">Female (<i class="fa fa-female"></i>)</span>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </li>

                    <li>
                        <strong>Street 1: </strong>
                        <?php
                        if($profile->profile->street_1){
                            echo $profile->profile->street_1;
                        }
                        else{
                            echo 'N/A';
                        }
                        ?>
                    </li>
                    <li>
                        <strong>Street 2: </strong>
                        <?php
                        if($profile->profile->street_2){
                            echo $profile->profile->street_2;
                        }
                        else{
                            echo 'N/A';
                        }
                        ?>
                    </li>
                    <li>
                        <strong>City: </strong>
                        <?php
                        if($profile->profile->city){
                            echo $profile->profile->city;
                        }
                        else{
                            echo 'N/A';
                        }
                        ?>
                    </li>
                    <li>
                        <strong>State: </strong>
                        <?php
                        if($profile->profile->state){
                            echo $profile->profile->state;
                        }
                        else{
                            echo 'N/A';
                        }
                        ?>
                    </li>
                    <li>
                        <strong>Postal code: </strong>
                        <?php
                        if($profile->profile->postal_code){
                            echo $profile->profile->postal_code;
                        }
                        else{
                            echo 'N/A';
                        }
                        ?>
                    </li>
                    <li>
                        <strong>Country: </strong>
                        <?php
                        if($profile->profile->country && $profile->profile->country != '-1'){
                            echo $profile->profile->country;
                        }
                        else{
                            echo 'N/A';
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>