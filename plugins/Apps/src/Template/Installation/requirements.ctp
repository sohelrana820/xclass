<div class="text-center" >
    <h2>Checking Requirements!</h2> {{test}}
    <br/>

    <ul class="nav-list text-left requirement_list">
        <li>
            <a ng-show="creating_config_file" class="install_ok"><i class="fa fa-check"></i></a>
            <img ng-show="!creating_config_file" src="/img/default.gif" class="loader"/>
            Config.ini file created (/var/www/condif/config.ini)
        </li>

        <li>
            <a ng-show="set_perm_config_file" class="install_ok"><i class="fa fa-check"></i></a>
            <img ng-show="!set_perm_config_file" src="/img/default.gif" class="loader"/>
            Set write permission (755) to config.ini
        </li>
        <li>
            <a ng-show="creating_profile_dir" class="install_ok"><i class="fa fa-check"></i></a>
            <img ng-show="!creating_profile_dir" src="/img/default.gif" class="loader"/>
            profiles directory created (/var/www/webroot)
        </li>
        <li>
            <a ng-show="ser_perm_profile_dir" class="install_ok"><i class="fa fa-check"></i></a>
            <img ng-show="!ser_perm_profile_dir" src="/img/default.gif" class="loader"/>
            Set write permission (755) to profiles directory
        </li>
        <li>
            <a ng-show="ser_perm_log_dir" class="install_error"><i class="fa fa-times"></i></a>
            <img ng-show="!ser_perm_log_dir" src="/img/default.gif" class="loader"/>
            Set write permission (755) to logs directory directory
        </li>
        <li>
            <a ng-show="ser_perm_tmp_dir" class="install_ok"><i class="fa fa-check"></i></a>
            <img ng-show="!ser_perm_tmp_dir" src="/img/default.gif" class="loader"/>
            Set write permission (755) to temp directory directory
        </li>
    </ul>

    <a class="btn btn-success btn-lg" href="/installation/database">Next</a>
</div>