<div class="header">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-6 visible-lg visible-md">
            <div class="search_bar">
                <div class="input-group search_bar_input">
                    <span class="input-group-addon">
                        <button type="submit">
                            <span class="fa fa-search"></span>
                        </button>
                    </span>
                    <input type="text" class="form-control"  placeholder="Search..." >
                    <!--<div class="header_task_list">
                        <div class="not_found"><h4>Sorry, result not found</h4></div>
                        <ul>
                            <li>
                                <p><a>How to work with php remove (,) form last assigned user name remove (,) form last assigned user name</a></p>
                                <small>Opened by Sohel
                                    Sohel at
                                    Oct 15, 2016.
                                    (05:47 AM)
                                </small>
                            </li>

                            <li>
                                <p><a>How to work with php remove (,) form last assigned user name remove (,) fto work with php remove (,) form last assigned user name orm last assigned user name</a></p>
                                <small>Opened by Sohel
                                    Sohel at
                                    Oct 15, 2016.
                                    (05:47 AM)
                                </small>
                            </li>

                            <li>
                                <p><a>How to work with php remove (,) form last assigned user name to work with php remove (,) form last assigned user name  remove (,) form last assigned user name</a></p>
                                <small>Opened by Sohel
                                    Sohel at
                                    Oct 15, 2016.
                                    (05:47 AM)
                                </small>
                            </li>

                            <li>
                                <p><a>How to work with php remove (,) form last assigned user name remove (,) form last assigned user name</a></p>
                                <small>Opened by Sohel
                                    Sohel at
                                    Oct 15, 2016.
                                    (05:47 AM)
                                </small>
                            </li>

                            <li>
                                <p><a>How to work with php remove (,) form last assigned user name remove (,) form last assigned user name</a></p>
                                <small>Opened by Sohel
                                    Sohel at
                                    Oct 15, 2016.
                                    (05:47 AM)
                                </small>
                            </li>

                            <li>
                                <p><a>How to work with php remove (,) form last assigned user name to work with php remove (,) form last assigned user name remove (,) form last assigned user name</a></p>
                                <small>Opened by Sohel
                                    Sohel at
                                    Oct 15, 2016.
                                    (05:47 AM)
                                </small>
                            </li>
                        </ul>
                    </div>-->
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="pull-right">
                <div class="profile-overview">
                    <div class="dropdown customm-dropdown">
                        <?php
                            if($userInfo->profile->profile_pic){
                                echo $this->Html->image('profiles/'.$userInfo->profile->profile_pic, ['class' => 'profile-pic', 'alt' => $userInfo->profile->name]);
                            }
                        else{
                            echo $this->Html->image('profile_avatar.jpg', ['class' => 'profile-pic', 'alt' => $userInfo->profile->name]);
                        }
                        ?>
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <?php echo 'Hi, ', $userInfo->profile->name?>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li>
                                <?php echo $this->Html->link('<i class="fa fa-user"></i> My Profile', ['controller' => null, 'action' => 'profile'], ['escape' => false]);?>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <?php echo $this->Html->link('<i class="fa fa-fw fa-gears"></i> Settings', ['controller' => 'settings', 'action' => 'index'], ['escape' => false]); ?>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <?php echo $this->Html->link('<i class="fa fa-fw fa-power-off"></i> Log Out', ['controller' => 'users', 'action' => 'logout'], ['escape' => false]); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>