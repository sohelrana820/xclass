<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/21/15
 * Time: 3:38 AM
 */

namespace App\Controller;

use Cake\Event\Event;

class SettingsController extends AppController
{
    public $name = 'Settings';

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
    }

    public function index()
    {

    }
};