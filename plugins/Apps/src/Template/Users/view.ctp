<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Manage User', ['controller' => 'users', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>User Detail</h2>
            <span>Details of <?php echo $user->profile->name;?></span>
        </div>
        <div class="pull-right btn-areas btn-margin">
            <?php
            echo $this->Html->link('New User', ['controller' => 'users', 'action' => 'add'], ['class' => 'btn btn-info']);

            echo $this->Html->link('Edit User', ['controller' => 'users', 'action' => 'edit', $user->uuid], ['class' => 'btn btn-info']);

            echo $this->Html->link('Change Password', ['controller' => 'users', 'action' => 'change_password', $user->uuid], ['class' => 'btn btn-info']);

            echo $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->uuid], ['escape' => false, 'class' => 'btn btn-info', 'confirm' => __('Are you sure you want to delete # {0}?', $user->profile->first_name . ' ' . $user->profile->last_name)]);

            echo $this->Html->link('Users List', ['controller' => 'users', 'action' => 'index'], ['class' => 'btn btn-info']);
            ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <div class="row">
            <!-- left column -->
            <div class="col-md-2 col-sm-4 col-xs-12">
                <?php echo $this->element('user_profile_photo');?>
            </div>
            <!-- edit form column -->
            <div class="col-md-10 col-sm-8 col-xs-12 personal-info">
                <?php  if($user->role == 2):?>
                    <span class="status-button status-gray">ID: <?php echo $user->student_id;?></span>
                <?php elseif($user->role == 1):?>
                    <span class="status-button status-success">Type: Admin User</span>
                <?php endif;?>
                <?php  if($user->status == 0):?>
                    <span class="status-button status-danger">Status: Inactive</span>
                <?php elseif($user->status == 1):?>
                    <span class="status-button status-success">Status: Active</span>
                <?php endif;?>
                <br/>
                <br/>
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
                        <?php elseif ($user->profile->gender == 2): ?>
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
                            echo $user->profile->city;
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
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="widget">
            <div class="widget-header">
                <h2>Courses</h2>
            </div>
            <div class="widget-body">
                <?php if($user->courses):?>
                    <?php foreach ($user->courses as $key => $course):?>
                        <p class="text-muted"><?php echo '(' . ($key + 1) .') ' .$course->name;?></p>
                    <?php endforeach;?>
                <?php else:?>
                    <?php echo $this->element('not_found')?>
                <?php endif?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="widget">
            <div class="widget-header">
                <h2>Download Documents</h2>
            </div>
            <div class="widget-body">
                <?php if (!empty($user->downloads)): ?>
                    <table class="table theme-table">
                        <thead>
                        <tr>
                            <th scope="col">Course Name</th>
                            <th scope="col">Document Name</th>
                            <th scope="col">Download Time</th>
                            <th scope="col" class="actions"><?php echo __('Actions') ?></th>
                        </tr>
                        </thead>
                        <?php foreach ($user->downloads as $download): ?>
                            <tr>
                                <td><?php echo $download->document->course ? $download->document->course->name : 'N/A'; ?></td>
                                <td><?php echo $download->document->title ? $this->Text->truncate($download->document->title, 50) : 'N/A'; ?></td>
                                <td>
                                    <?php echo $this->Time->format($download->created, 'MMM d, Y') ?>
                                    <span class="sm-time">(<?php echo date('H:i A', strtotime($download->created)) ?>)</span>
                                </td>
                                <td class="actions">
                                    <?php echo $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['controller' => 'Download', 'action' => 'delete', $download->id], ['class' => 'icons red', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $download->id)]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else: ?>
                    <?php echo $this->element('not_found'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>