<div class="page-header">
    <h2 class="title pull-left">
        <?php echo $this->Html->link('Manage Profile', ['controller' => 'profile', 'action' => 'index'], ['class' => 'link']);?>
    </h2>
    <div class="clearfix"></div>
</div>

<div class="widget">
    <div class="widget-header">
        <div class="pull-left">
            <h2>Update Profile</h2>
            <span>Please provide all valid information</span>
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
                <?php echo $this->Form->create($profile, array('url' => ['controller' => 'profile', 'action' => 'update_profile']));?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>First name</label>
                            <?php echo $this->Form->input('profile.first_name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'First name', 'label' => false, 'required' => false]);?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Last name</label>
                            <?php echo $this->Form->input('profile.last_name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Last name', 'label' => false, 'required' => false]);?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="text" class="form-control" readonly value="<?php echo $profile->username;?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Phone number</label>
                            <?php echo $this->Form->input('profile.phone', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Phone number', 'label' => false, 'required' => false]);?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <div class="input-group">
                                <input name="profile[birthday]" type="text" class="form-control datepicker" value="<?php echo $this->Time->format($profile->profile->birthday, 'dd MMM, Y');?>">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Gender</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="profile[gender]" value="1" <?php if($profile->profile->gender == 1){echo 'checked';}?> >Male
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="profile[gender]" value="2" <?php if($profile->profile->gender == 2){echo 'checked';}?>>Female
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Street 1</label>
                            <?php echo $this->Form->input('profile.street_1', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Street 1', 'label' => false, 'required' => false]);?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Street 2</label>
                            <?php echo $this->Form->input('profile.street_2', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Street 2', 'label' => false, 'required' => false]);?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>City</label>
                            <?php echo $this->Form->input('profile.city', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'City', 'label' => false, 'required' => false]);?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Postal Code</label>
                            <?php echo $this->Form->input('profile.postal_code', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Postal code', 'label' => false, 'required' => false]);?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Country</label>
                            <select id="country" name="profile[country]" class="form-control" country="<?php echo $profile->profile->country;?>" state="<?php echo $profile->profile->state;?>"></select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>State</label>
                            <select name="profile[state]" id="state" class="form-control select2-form-control">
                                <option><?php echo $profile->profile->state;?></option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Update Profile</button>
                <?php echo $this->Form->end();?>
            </div>
        </div>
    </div>
</div>


<?php
$this->start('cssTop');
echo $this->Html->css(array('select2.min', 'datepicker','all'));
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