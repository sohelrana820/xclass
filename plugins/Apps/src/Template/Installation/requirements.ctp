<div class="text-center" ng-controller="Requirements">
    <h2>Checking Requirements!</h2> {{test}}
    <br/>

    <ul class="nav-list text-left">
        <li>Config.ini file created (/var/www/condif/config.ini)</li>
        <li>Set write permission (755) to config.ini</li>
        <li>profiles directory created (/var/www/webroot)</li>
        <li>Set write permission (755) to profiles directory</li>
        <li>Set write permission (755) to logs directory directory</li>
        <li>Set write permission (755) to temp directory directory</li>
    </ul>

    <a class="btn btn-success btn-lg" href="/installation/database">Next</a>
</div>