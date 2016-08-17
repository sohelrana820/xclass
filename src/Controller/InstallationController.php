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
use Cake\Filesystem\Folder;
use Phinx\Config\Config;

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
        $dir = new File(ROOT.'/Conf/config.ini', true, 0755);
        $requirements = [
            'config_file_exiest' => false,
            'config_file_writable' => false,
            'profile_dir_exiest' => false,
            'profile_dir_writeble' => false,
        ];
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
            /*$dsn = 'mysql://'.$dbConf['username'].':'.$dbConf['password'].'@'.$dbConf['host'].'/'.$dbConf['database'].'';
            ConnectionManager::config('application_database', ['url' => $dsn]);
            $connection = ConnectionManager::get('application_database');
            $structureSql = new File(CONFIG.'schema/structure.sql');
            $connection->query($structureSql->read());*/


            $iniConf = parse_ini_file(CONFIG.'config.ini');
            var_dump($iniConf);

            $iniData = InstallationController::readIni(CONFIG . 'config.ini');
            //$iniData['DATABASE_HOST'] = $dbConf['host'];
           // $iniData['DATABASE_NAME'] = $dbConf['database'];
           // $iniData['DATABASE_USERNAME'] = $dbConf['username'];
            $iniData['HELLO'] = $dbConf['password'];

            var_dump(InstallationController::writeToIni($iniData, CONFIG . 'config.ini'));
        }

        catch(Exception $e){
            var_dump($e->getMessage());
        }
    }

    public static function readIni($fileName)
    {
        return parse_ini_file($fileName);
    }

    public static function writeToIni($array, $file)
    {
        $res = array();
        foreach ($array as $key => $val) {
            if (is_array($val)) {
                $res[] = "[$key]";
                foreach ($val as $skey => $sval) {
                    $res[] = "$skey = " . (is_numeric($sval) ? $sval : '"' . $sval . '"');
                }
            } else {
                $res[] = "$key = " . (is_numeric($val) ? $val : '"' . $val . '"');
            }
        }
        if (InstallationController::safeFilereWrite($file, implode("\r\n", $res))) {
            return true;
        }
        return false;
    }


    public static function safeFilereWrite($fileName, $dataToSave)
    {
        if ($fp = fopen($fileName, 'w')) {
            $startTime = microtime();
            do {
                $canWrite = flock($fp, LOCK_EX);
                if (!$canWrite) {
                    usleep(round(rand(0, 100) * 1000));
                }
            } while ((!$canWrite)and((microtime() - $startTime) < 1000));
            if ($canWrite) {
                fwrite($fp, $dataToSave);
                flock($fp, LOCK_UN);
            }
            fclose($fp);
            return true;
        }
        return false;
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