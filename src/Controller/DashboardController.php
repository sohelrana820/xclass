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
        $projects = $this->Projects->getProjectsForDashboard(7);
        foreach ($projects as $key => $project)
        {
            $overview = $this->getProjectOverview($project->id);
            $projects[$key]['overview'] = $overview;
        }
        $this->set('projects', $projects);
    }
} 