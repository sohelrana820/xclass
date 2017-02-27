<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/21/15
 * Time: 3:38 AM
 */

namespace App\Controller;


/**
 * Class DashboardController
 * @package App\Controller
 */
class DashboardController extends AppController{

    /**
     * @var string
     */
    public $name = 'Dashboard';

    /**
     * Dashboard content
     */
    public function index(){
        $this->loadModel('Projects');
        $projects = $this->Projects->getProjectsForDashboard($this->loggedInUser, 7);
        foreach ($projects as $key => $project)
        {
            $overview = $this->getProjectOverview($project->id);
            $projects[$key]['overview'] = $overview;
        }
        $this->set('projects', $projects);
    }
} 