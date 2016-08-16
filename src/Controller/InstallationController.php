<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/21/15
 * Time: 3:38 AM
 */

namespace App\Controller;


use Cake\Core\Exception\Exception;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;
use Cake\Filesystem\File;

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
        $dbConf = [
            'host' => 'localhost',
            'username' => 'root',
            'password' => 'ltqpsmr7',
            'database' => 'task_manager3',
        ];
        try {
            $dsn = 'mysql://'.$dbConf['username'].':'.$dbConf['password'].'@'.$dbConf['host'].'/';
            ConnectionManager::config('create_database', ['url' => $dsn]);
            $connection = ConnectionManager::get('create_database');
            $connection->query('CREATE DATABASE IF NOT EXISTS '.$dbConf['database']);

            $dsn = 'mysql://'.$dbConf['username'].':'.$dbConf['password'].'@'.$dbConf['host'].'/'.$dbConf['database'].'';
            ConnectionManager::config('application_database', ['url' => $dsn]);
            $connection = ConnectionManager::get('application_database');

            $structureSql = new File(CONFIG.'schema/structure.sql');
            $connection->query($structureSql->read());
        }
        catch(Exception $e){
            var_dump($e->getMessage());
        }
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