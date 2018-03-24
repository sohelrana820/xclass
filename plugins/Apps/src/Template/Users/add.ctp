<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Manage User', ['controller' => 'users', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<?php echo $this->Form->create($user, ['url' => ['controller' => 'users', 'action' => 'add']]);?>

<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>New User</h2>
            <span>Provide all valid information to create a new user</span>
        </div>
        <div class="pull-right btn-areas">
            <?php echo $this->Html->link('Back to List', ['controller' => 'users', 'action' => 'index'], ['class' => 'btn btn-info'])?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Student ID</label>
                    <?php echo $this->Form->input('student_id', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Student ID', 'label' => false, 'required' => false]);?>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label>First name</label>
                    <?php echo $this->Form->input('profile.first_name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'First name', 'label' => false, 'required' => false]);?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Last name</label>
                    <?php echo $this->Form->input('profile.last_name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Last name', 'label' => false, 'required' => false]);?>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label>Email address</label>
                    <?php echo $this->Form->input('username', ['type' => 'email', 'class' => 'form-control', 'placeholder' => 'Email address', 'label' => false, 'required' => false]);?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Phone number</label>
                    <?php echo $this->Form->input('profile.phone', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Phone number', 'label' => false, 'required' => false]);?>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label>Date of Birth</label>
                    <div class="input-group">
                        <input name="profile[birthday]" type="text" class="form-control datepicker" placeholder="Date of birth">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Gender</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="profile[gender]" value="1">Male
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="profile[gender]" value="2">Female
                        </label>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label>Street 1</label>
                    <?php echo $this->Form->input('profile.street_1', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Street 1', 'label' => false, 'required' => false]);?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Street 2</label>
                    <?php echo $this->Form->input('profile.street_2', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Street 2', 'label' => false, 'required' => false]);?>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label>Country</label>
                    <select id="country" name="profile[country]" class="form-control">
                        <option>Choose country</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>State</label>
                    <select name="profile[state]" id="state" class="form-control">
                        <option>Choose state</option>
                    </select>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label>City</label>
                    <?php echo $this->Form->input('profile.city', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'City', 'label' => false, 'required' => false]);?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Postal Code</label>
                    <?php echo $this->Form->input('profile.postal_code', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Postal code', 'label' => false, 'required' => false]);?>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label>User Type</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="role" value="1">Admin User
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="role" value="2">Student User
                        </label>
                    </div>
                    <?php echo $this->Form->error('role')?>
                </div>
            </div>
            <div class="clearfix"></div>


            <div class="col-lg-4">
                <div class="form-group">
                    <label>User Status</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="1" <?php if($user->status == 1){echo 'checked';}?>>Active
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="0" <?php if($user->status == 0){echo 'checked';}?>>Inactive
                        </label>
                    </div>
                    <?php echo $this->Form->error('status')?>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label>Choose Courses</label>
                    <?php echo $this->Form->input('courses._ids', ['type' => 'select', 'class' => 'form-control', 'options' => $courses, 'multiple' => 'multiple', 'label' => false, 'required' => false]);?>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label>Password</label>
                    <?php echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'label' => false, 'required' => false]);?>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label>Confirm password</label>
                    <?php echo $this->Form->input('cPassword', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirm password', 'label' => false, 'required' => false]);?>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save User</button>
        <?php echo $this->Form->end();?>
    </div>
</div>

<?php
$this->start('cssTop');
echo $this->Html->css(array('datepicker'));
$this->end();

$this->start('jsTop');
echo $this->Html->script(array('country'));
$this->end();

$this->start('jsBottom');
echo $this->Html->script(['datepicker']);
?>

<script language="javascript">
    populateCountries("country", "state");
    $('.datepicker').datepicker();
</script>

<?php $this->end(); ?>













