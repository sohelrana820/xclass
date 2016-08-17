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
use Cake\Network\Http\Request;
use Phinx\Config\Config;

class InstallationController extends AppController{

    public $name = 'Installation';

    public $requirementAnalysis = true;

    public $iniFile;

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
        $data = [
            $this->checkPermission(ROOT.'/Conf'),
            $this->checkPermission(ROOT.'/tmp'),
            $this->checkPermission(ROOT.'/logs'),
        ];

        $requirements = [
            'success' => $this->requirementAnalysis,
            'data' => $data
        ];
        $this->set('requirements', $requirements);

        $iniCreated = new File(ROOT.'/Conf/config.ini', true, 0755);
        $iniData['REQUIREMENT_ANALYSIS_RESULT'] = $this->requirementAnalysis;
        $iniData['DATABASE_CONFIGURATION_RESULT'] = false;
        InstallationController::writeToIni($iniData);
    }

    protected function checkPermission($path){
        if(is_writable($path)){
            $result = [
                'mgs' => $path. ' directory is writable',
                'result' => true
            ];
        }
        else{
            $this->requirementAnalysis = false;
            $result = [
                'mgs' => $path. ' directory isn\'t writable',
                'result' => false
            ];
        }

        return $result;
    }

    public function database()
    {
        $iniData = parse_ini_file(ROOT.'/Conf/config.ini');
        if(!$iniData['REQUIREMENT_ANALYSIS_RESULT'] == 1){
            $this->Flash->error(__('Sorry, Requirement analysis failed'));
            return $this->redirect(['action' => 'requirements']);
        }

        if($this->request->is('post')){
            $dbConf = $this->request->data['database'];
            try {
                $dsn = 'mysql://'.$dbConf['username'].':'.$dbConf['password'].'@'.$dbConf['host'].'/'.$dbConf['database_name'].'';
                ConnectionManager::config('application_database', ['url' => $dsn]);
                $connection = ConnectionManager::get('application_database');
                $connection->connect();
                $structureSql = new File(CONFIG.'schema/structure.sql');
                $connection->query($structureSql->read());

                $iniData['DATABASE_HOST'] = $dbConf['host'];
                $iniData['DATABASE_USERNAME'] = $dbConf['username'];
                $iniData['DATABASE_PASSWORD'] = $dbConf['password'];
                $iniData['DATABASE_NAME'] = $dbConf['database_name'];
                $iniData['DATABASE_CONFIGURATION_RESULT'] = true;;
                InstallationController::writeToIni($iniData);
                $this->Flash->success(__('Database configuration completed successfully'));
                return $this->redirect(['action' => 'general']);
            }
            catch(Exception $e){
                $this->Flash->error(__('Sorry, Invalid database configuration'));
                return $this->redirect(['action' => 'database']);
            }
        }
    }

    public static function readIni($fileName)
    {
        return parse_ini_file($fileName);
    }

    public static function writeToIni($array)
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
        if (InstallationController::safeFilereWrite(ROOT.'/Conf/config.ini', implode("\r\n", $res))) {
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
        $iniData = parse_ini_file(ROOT.'/Conf/config.ini');
        if(!$iniData['DATABASE_CONFIGURATION_RESULT'] == 1){
            $this->Flash->error(__('Sorry, database configuration invalid'));
            return $this->redirect(['action' => 'requirements']);
        }

        if($this->request->is('post')){
            $data = $this->request->data['application'];
            $general = [
                'application_name' => $data['name'],
                'application_logo' => base64_encode(file_get_contents($data['logo']['tmp_name']))
            ];

            /**
             * Need to write data into database.
             */
            $iniData['APPLICATION_NAME'] = $general['application_name'];
            $iniData['APPLICATION_LOGO'] = $general['application_logo'];
            InstallationController::writeToIni($iniData);
            $this->Flash->success(__('General configuration completed successfully'));
            return $this->redirect(['action' => 'administrator']);
        }
    }

    public function administrator()
    {

    }

    public function emailConfig()
    {

    }
} 