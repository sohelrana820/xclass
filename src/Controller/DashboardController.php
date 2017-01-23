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
        $this->loadModel('Projects');
        $projects = $this->Projects->getProjectLists(7);
        foreach ($projects as $key => $project)
        {
            $overview = $this->getProjectOverview($project->id);
            $projects[$key]['overview'] = $overview;
        }
        $this->set('projects', $projects);
    }

    public function overview()
    {
        $overview = [
            'total_user' => $this->Users->countTotalUser(),
            'total_label' => $this->Labels->countTotalLabel(),
            'total_open_task' => $this->Tasks->countTotalTasks($stauts = 1),
            'total_closed_task' => $this->Tasks->countTotalTasks($stauts = 2)
        ];
        $this->set('result', $overview);
        $this->set('_serialize', ['result']);
    }
} 