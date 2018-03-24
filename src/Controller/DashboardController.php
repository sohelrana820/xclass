<?php

namespace App\Controller;

/**
 * Class DashboardController
 * @package App\Controller
 */
class DashboardController extends AppController
{
    /**
     * @var string
     */
    public $name = 'Dashboard';

    /**
     * Dashboard content
     */
    public function index()
    {
        $this->loadModel('Users');
        $this->loadModel('Documents');
        $this->loadModel('Downloads');
        $this->set('overview', $this->getAdminOverview());
        $this->set('students', $this->Users->recentStudents());
        $this->set('documents', $this->Documents->recentDocuments());
        $this->set('downloads', $this->Downloads->recentDocuments(10));
    }

    /**
     * @return array
     */
    protected function getAdminOverview()
    {
        $this->loadModel('Users');
        $this->loadModel('Documents');
        $this->loadModel('Courses');
        $this->loadModel('Downloads');
        $overview = [
            'total_students' => $this->Users->countStudent(),
            'total_documents' => $this->Documents->countDocuments(),
            'total_courses' => $this->Courses->countCourses(),
            'total_downloads' => $this->Downloads->countDownloads()
        ];
        return $overview;
    }
}
