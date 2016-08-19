<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/21/15
 * Time: 3:38 AM
 */

namespace App\Controller;


class DashboardController extends AppController{

    public $name = 'Dashboard';

    public function index(){
        $overview = [
            'total_user' => $this->Users->countTotalUser(),
            'total_label' => $this->Labels->countTotalLabel(),
            'total_task' => $this->Tasks->countTotalTasks()
        ];
        $this->set('overview', $overview);
    }
} 