<?php echo $this->assign('title', 'Users List'); ?>

<div class="page-header">
    <h2 class="title pull-left">
        Users List
        <p class="sub-title"><?php echo $users->count() ?> result found</p>
    </h2>
    <div class="pull-right btn-areas">
        <?php echo $this->Html->link('New User', ['controller' => 'users', 'action' => 'add'], ['class' => 'btn btn-info']) ?>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#searchUserModal">Search User
        </button>
    </div>
    <div class="clearfix"></div>
</div>

<?php if (!$users->isEmpty()): ?>
    <table class="table theme-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Street</th>
            <th>City</th>
            <th>State</th>
            <th>Postal Code</th>
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
                    <?php elseif ($user->gender == 2): ?>
                        <span class="green">Female (<i class="fa fa-female"></i>)</span>
                    <?php else: ?>
                        N/A
                    <?php endif; ?>
                </td>

                <td>
                    <?php
                    if ($user->profile->street_1) {
                        echo $user->profile->street_1;
                    } elseif ($user->profile->street_2) {
                        echo $user->profile->street_2;
                    } else {
                        echo 'N/A';
                    }
                    ?>
                </td>

                <td>
                    <?php
                    if ($user->profile->city) {
                        echo $user->profile->city;
                    } else {
                        echo 'N/A';
                    }
                    ?>
                </td>

                <td>
                    <?php
                    if ($user->profile->state && $user->profile->state != 'Choose state') {
                        echo $user->profile->state;
                    } else {
                        echo 'N/A';
                    }
                    ?>
                </td>

                <td>
                    <?php
                    if ($user->profile->postal_code) {
                        echo $user->profile->postal_code;
                    } else {
                        echo 'N/A';
                    }
                    ?>
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
        <p><?php echo $this->Paginator->counter() ?></p>
    </div>
<?php else: ?>
    <?php echo $this->element('not_found'); ?>
<?php endif; ?>

<div class="modal fade modal-primary" id="searchUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <?php
        echo $this->Form->create(null,
            [
                'type' => 'get',
                'url' =>
                    [
                        'controller' => 'Users',
                        'action' => 'index',
                    ]
            ]
        );
        ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center text-uppercase" id="myModalLabel">Search User</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="input text">
                        <input type="text"
                               name="email"
                               class="form-control"
                               placeholder="E-mail address"
                               value="<?php echo $this->request->query('email') != '' ? $this->request->query('email') : '' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input text">
                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="Name"
                               value="<?php echo $this->request->query('name') != '' ? $this->request->query('name') : '' ?>">

                    </div>
                </div>
                <div class="form-group">
                    <label for="">User Status</label>
                    <br>
                    <div class="radio3 radio-check radio-success radio-inline">
                        <input type="radio" id="radio5" name="status" id="optionsRadios2" value="1" style="position: absolute; opacity: 0;">
                        <label for="radio5">
                            Active
                        </label>
                    </div>
                    <div class="radio3 radio-check radio-success radio-inline">
                        <input type="radio" id="radio6" name="status" id="optionsRadios2" value="0"
                               style="position: absolute; opacity: 0;">
                        <label for="radio6">
                            Inactive
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Email Verified</label>
                    <br>

                    <div class="radio3 radio-check radio-success radio-inline">
                        <input type="radio" id="verify1" name="email_verify" id="optionsRadios2" value="1"
                               style="position: absolute; opacity: 0;">
                        <label for="verify1">
                            Yes
                        </label>
                    </div>
                    <div class="radio3 radio-check radio-success radio-inline">
                        <input type="radio" id="verify0" name="email_verify" id="optionsRadios2" value="0"
                               style="position: absolute; opacity: 0;">
                        <label for="verify0">
                            No
                        </label>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="search">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        </form>
    </div>
</div>
