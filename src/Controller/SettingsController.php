<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/21/15
 * Time: 3:38 AM
 */

namespace App\Controller;

use Cake\Event\Event;

/**
 * Class SettingsController
 * @package App\Controller
 */
class SettingsController extends AppController
{
    /**
     * @var string
     */
    public $name = 'Settings';


    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    public function index()
    {
        $this->redirect(['action' => 'general']);
    }
}
