<?php echo $this->assign('title', 'Users Lists'); ?>

<div class="page-header">
    <h2 class="title pull-left">
        Manage User
    </h2>
    <div class="clearfix"></div>
</div>

<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>Lists of User</h2>
            <span><?php echo $users->count() ?> result found</span>
        </div>
        <div class="pull-right btn-areas">
            <?php echo $this->Html->link('New User', ['controller' => 'users', 'action' => 'add'], ['class' => 'btn btn-info']) ?>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#searchUserModal">Search User
            </button>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <?php if (!$users->isEmpty()): ?>
            <table class="table theme-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>User Type</th>
                    <th>Status</th>
                    <th class="text-right">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <?php echo $this->Html->link($user->profile->name, ['controller' => 'users', 'action' => 'view', $user->uuid]); ?>
                        </td>
                        <td>
                            <?php echo $user->username; ?>
                        </td>
                        <td>
                            <?php
                            if ($user->profile->phone) {
                                echo $user->profile->phone;
                            } else {
                                echo 'N/A';
                            }
                            ?>
                        </td>
                        <td>
                            <?php if ($user->profile->gender == 1): ?>
                                <span class="orange">Male (<i class="fa fa-male"></i>)</span>
                            <?php elseif ($user->profile->gender == 2): ?>
                                <span class="green">Female (<i class="fa fa-female"></i>)</span>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>

                        <td>
                            <?php if ($user->role == 1): ?>
                        <strong class="text-muted">Admin</strong>
                    <?php elseif ($user->role == 2): ?>
                        <span class="text-muted"">General</span>
                    <?php else: ?>
                        N/A
                    <?php endif; ?>
                        </td>

                        <td>
                            <?php if ($user->status == 1): ?>
                                <span class="status-text status-text-success">Active</span>
                            <?php elseif ($user->status == 0): ?>
                                <span class="status-text status-text-danger">Inactive</span>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>


                        <td class="text-right">
                            <?php
                            echo $this->Html->link('<i class="fa fa-gear"></i>', ['controller' => 'users', 'action' => 'view', $user->uuid], ['escape' => false, 'class' => 'icons green']);
                            echo $this->Html->link('<i class="fa fa-pencil"></i>', ['controller' => 'users', 'action' => 'edit', $user->uuid], ['escape' => false, 'class' => 'icons']);
                            echo $this->Html->link('<i class="fa fa-trash"></i>', ['controller' => 'users', 'action' => 'delete', $user->uuid], ['escape' => false, 'class' => 'icons red']);
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="paginator pull-right">
                <ul class="pagination">
                    <?php echo $this->Paginator->prev(__('«')) ?>
                    <?php echo $this->Paginator->numbers() ?>
                    <?php echo $this->Paginator->next(__('»')) ?>
                </ul>
            </div>
        <?php else: ?>
            <?php echo $this->element('not_found'); ?>
        <?php endif; ?>
        <div class="clearfix"></div>
    </div>
</div>

<div class="modal fade modal-primary" id="searchUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <?php
        echo $this->Form->create(null,
            [
                'type' => 'get',
                'url' =>
                    [
                        'controller' => 'users',
                        'action' => 'index',
                    ]
            ]
        );
        ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title text-center text-uppercase" id="myModalLabel">Search User</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <div class="input text">
                            <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $this->request->query('name') != '' ? $this->request->query('name') : '' ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <div class="input text">
                            <input type="email" name="email" class="form-control" placeholder="Email address" value="<?php echo $this->request->query('email') != '' ? $this->request->query('email') : '' ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Phone Number</label>
                        <div class="input text">
                            <input type="text" name="phone" class="form-control" placeholder="Phone number" value="<?php echo $this->request->query('phone') != '' ? $this->request->query('phone') : '' ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>User Status</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="status" value="1" <?php if($this->request->query('status') && $this->request->query('status') == 1) {echo 'checked';}?>>Active
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="status" value="0" <?php if($this->request->query('status') && $this->request->query('status') == 0) {echo 'checked';}?>>Inactive
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Gender</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" value="male" <?php if($this->request->query('gender') == 'male') {echo 'checked';}?>>Male
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" value="female" <?php if($this->request->query('gender') == 'female') {echo 'checked';}?>>Female
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" value="none" <?php if($this->request->query('gender') == 'none') {echo 'checked';}?>>N/A
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email Verified</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="email_verify" value="1" <?php if($this->request->query('email_verify') == '1') {echo 'checked';}?>> Yes
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="email_verify" value="0" <?php if($this->request->query('email_verify') == '0') {echo 'checked';}?>> No
                            </label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="search">
                    <?php echo $this->Html->link('Reset', ['controller' => 'users' , 'action' => 'index'], ['class' => 'btn btn-danger']);?>
                </div>
            </div>
        <?php echo $this->Form->end();?>
    </div>
</div>
