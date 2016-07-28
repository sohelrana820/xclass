<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Sheena Kristin A.Eschor</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive"> </div>

            <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
              <dl>
                <dt>DEPARTMENT:</dt>
                <dd>Administrator</dd>
                <dt>HIRE DATE</dt>
                <dd>11/12/2013</dd>
                <dt>DATE OF BIRTH</dt>
                   <dd>11/12/2013</dd>
                <dt>GENDER</dt>
                <dd>Male</dd>
              </dl>
            </div>-->
            <div class=" col-md-9 col-lg-9 ">
                <table class="table table-user-information">
                    <tbody>
                    <tr>
                        <td>Department:</td>
                        <td>Programming</td>
                    </tr>
                    <tr>
                        <td>Hire date:</td>
                        <td>06/23/2013</td>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td>01/24/1988</td>
                    </tr>

                    <tr>
                    </tr><tr>
                        <td>Gender</td>
                        <td>Male</td>
                    </tr>
                    <tr>
                        <td>Home Address</td>
                        <td>Metro Manila,Philippines</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><a href="mailto:info@support.com">info@support.com</a></td>
                    </tr>
                    <tr><td>Phone Number</td>
                        <td>123-4567-890(Landline)<br><br>555-4567-890(Mobile)
                        </td>

                    </tr>

                    </tbody>
                </table>

                <a href="#" class="btn btn-primary">My Sales Performance</a>
                <a href="#" class="btn btn-primary">Team Sales Performance</a>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
    </div>

</div>

<?php echo $this->assign('title', 'Add New User'); ?>

<div class="page-title">
    <span class="title">Add New User</span>
    <div class="description">Provide all information for adding  new user</div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">User Information</div>
                </div>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create($user, array('controller' => 'users', 'action' => 'view/', $userInfo->uuid));?>
                <form>

                    <div class="form-group">
                        <label>First name</label>
                        <?php echo $this->Form->input('profile.first_name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'First name', 'label' => false, 'required' => false]);?>
                    </div>

                    <div class="form-group">
                        <label>Last name</label>
                        <?php echo $this->Form->input('profile.last_name', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Last name', 'label' => false, 'required' => false]);?>
                    </div>

                    <div class="form-group">
                        <label>Gender</label>
                        <div class="radio">
                            <label class="">
                                <div class="iradio_flat checked" style="position: relative;">
                                    <input type="radio" class="input-radio" name="profile[gender]" id="optionsRadios1" value="1" checked="" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                                </div> Male
                            </label>
                        </div>
                        <div class="radio">
                            <label class="hover">
                                <div class="iradio_flat hover" style="position: relative;">
                                    <input type="radio" class="input-radio" name="profile[gender]" id="optionsRadios2" value="2" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                                </div> Female
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Date of Birth</label>
                        <div class="input-group">
                            <input name="profile[birthday]" type="text" class="form-control datepicker" placeholder="Date of birth">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email address</label>
                        <?php echo $this->Form->input('username', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Email address', 'label' => false, 'required' => false]);?>
                    </div>

                    <div class="form-group">
                        <label>Phone number</label>
                        <?php echo $this->Form->input('profile.phone', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Phone number', 'label' => false, 'required' => false]);?>
                    </div>

                    <div class="form-group">
                        <label>Fax</label>
                        <?php echo $this->Form->input('profile.fax', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Fax', 'label' => false, 'required' => false]);?>
                    </div>

                    <div class="form-group">
                        <label>Street 1</label>
                        <?php echo $this->Form->input('profile.street_1', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Street 1', 'label' => false, 'required' => false]);?>
                    </div>

                    <div class="form-group">
                        <label>Street 2</label>
                        <?php echo $this->Form->input('profile.street_2', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Street 2', 'label' => false, 'required' => false]);?>
                    </div>

                    <div class="form-group">
                        <label>Country</label>
                        <select id="country" name="profile[country]" class="form-control select2-form-control">
                            <option>Choose country</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>State</label>
                        <select name="profile[state]" id="state" class="form-control select2-form-control">
                            <option>Choose state</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>City</label>
                        <?php echo $this->Form->input('profile.city', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'City', 'label' => false, 'required' => false]);?>
                    </div>

                    <div class="form-group">
                        <label>Postal Code</label>
                        <?php echo $this->Form->input('profile.postal_code', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Postal Code', 'label' => false, 'required' => false]);?>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <?php echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'label' => false, 'required' => false]);?>
                    </div>

                    <div class="form-group">
                        <label>Confirm password</label>
                        <?php echo $this->Form->input('cPassword', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirm password', 'label' => false, 'required' => false]);?>
                    </div>

                    <button type="submit" class="btn btn-primary">Save User</button>
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
echo $this->Html->script(['select2.full.min', 'datepicker']);
?>

<script language="javascript">
    populateCountries("country", "state");
</script>

<?php $this->end(); ?>













