<?php
if($userInfo->role == 1) {
    echo $this->element('admin_dashboard');
} else {
    echo $this->element('user_dashboard');
}
?>

