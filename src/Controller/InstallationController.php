<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/21/15
 * Time: 3:38 AM
 */

namespace App\Controller;


use Cake\Event\Event;

class InstallationController extends AppController{

    public $name = 'Installation';

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->viewBuilder()
            ->layout('installation')
            ->theme($this->currentTheme);
    }

    public function index(){

    }

    public function requirements()
    {

    }

    public function database()
    {

    }

    public function general()
    {

    }

    public function administrator()
    {

    }

    public function emailConfig()
    {

    }
} 