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
use Cake\Utility\Text;
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

        if(file_exists(ROOT.'/Conf/config.ini')){
            $iniData = parse_ini_file(ROOT.'/Conf/config.ini');
            if(isset($iniData['INSTALLATION_RESULT']) && $iniData['INSTALLATION_RESULT']){
                $this->redirect($this->referer());
            }
        }
    }

    public function index(){
        $this->redirect(['action' => 'install']);
    }

    public function install()
    {

    }

    public function requirements()
    {
        $data = [];

        $isConfExists = $this->checkRequireDir(ROOT.'/Conf', 'Conf');
        $data[] = $isConfExists;
        if($isConfExists['result'] == 'success'){
            $data[] = $this->checkPermission(ROOT.'/Conf');
        }

        $isTmpExists = $this->checkRequireDir(ROOT.'/tmp', 'tmp');
        $data[] = $isTmpExists;
        if($isTmpExists['result'] == 'success'){
            $data[] = $this->checkPermission(ROOT.'/tmp');
        }

        $isLogsExists = $this->checkRequireDir(ROOT.'/logs', 'logs');
        $data[] = $isLogsExists;
        if($isLogsExists['result'] == 'success'){
            $data[] = $this->checkPermission(ROOT.'/logs');
        }

        $isProfilesExists = $this->checkRequireDir(ROOT.'/webroot/img/profiles', 'profiles');
        $data[] = $isProfilesExists;
        if($isProfilesExists['result'] == 'success'){
            $data[] = $this->checkPermission(ROOT.'/webroot/img/profiles');
        }

        $isAttachmentsExists = $this->checkRequireDir(ROOT.'/webroot/img/attachments', 'attachments');
        $data[] = $isAttachmentsExists;
        if($isAttachmentsExists['result'] == 'success'){
            $data[] = $this->checkPermission(ROOT.'/webroot/img/attachments');
        }

        if(extension_loaded('intl')){
            $result = [
                'mgs' => 'PHP INTL EXTENSION is enabled',
                'result' => 'success'
            ];
        }
        else{
            $result = [
                'mgs' => 'PHP INTL EXTENSION is disabled or missing',
                'result' => 'success'
            ];
        }
        $data[] = $result;

        $requirements = [
            'success' => $this->requirementAnalysis,
            'data' => $data
        ];
        $this->set('requirements', $requirements);

        if($this->requirementAnalysis){
            $iniCreated = new File(ROOT.'/Conf/config.ini', true, 0755);
            $iniData['REQUIREMENT_ANALYSIS_RESULT'] = $this->requirementAnalysis;
            $iniData['DATABASE_CONFIGURATION_RESULT'] = false;
            $iniData['DATABASE_HOST'] = false;
            $iniData['DATABASE_USERNAME'] = false;
            $iniData['DATABASE_PASSWORD'] = false;
            $iniData['DATABASE_NAME'] = false;
            $iniData['EMAIL_CONFIGURATION_RESULT'] = false;
            InstallationController::writeToIni($iniData);
        }
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

            if (strpos($dbConf['database_name'], '-') !== false) {
                $this->Flash->error(__('Sorry, Invalid database name. (-) not allow in database name'));
                return $this->redirect(['action' => 'database']);
            }

            try {
                $dsn = 'mysql://'.$dbConf['username'].':'.$dbConf['password'].'@'.$dbConf['host'].'/'.$dbConf['database_name'];
                ConnectionManager::config('create_database', ['url' => $dsn]);
                $createDB = ConnectionManager::get('create_database');
                $createDB->connect();
                $createDB->query('CREATE DATABASE IF NOT EXISTS '.$dbConf['database_name']);

                $dsn = 'mysql://'.$dbConf['username'].':'.$dbConf['password'].'@'.$dbConf['host'].'/'.$dbConf['database_name'].'';
                ConnectionManager::config('execute_tables', ['url' => $dsn]);
                $connection = ConnectionManager::get('execute_tables');
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


    public function general()
    {
        $iniData = parse_ini_file(ROOT.'/Conf/config.ini');
        if(!$iniData['DATABASE_CONFIGURATION_RESULT'] == 1){
            $this->Flash->error(__('Sorry, database configuration invalid'));
            return $this->redirect(['action' => 'requirements']);
        }

        if($this->request->is('post')){

            $general = [
                'application_name' => $this->appsName,
                'application_logo' => $this->appsLogo
            ];

            if($this->request->data['application']['logo']['name']){
                $logo = $this->Utilities->uploadFile(WWW_ROOT.'img', $this->request->data['application']['logo'], 'logo');
                $general['application_logo'] = $logo;
            }

            if($this->request->data['application']['name']){
                $name = $this->request->data['application']['name'];
                $general['application_name'] = $name;
            }

            /**
             * Need to write data into database.
             */
            $iniData['APPLICATION_NAME'] = $general['application_name'];
            $iniData['APPLICATION_LOGO'] = $general['application_logo'];
            if(InstallationController::writeToIni($iniData)){
                $this->Flash->success(__('General configuration completed successfully'));
                return $this->redirect(['action' => 'administrator']);
            }
            else {
                $this->Flash->error(__('Sorry! something went wrong'));
            }
        }
    }

    public function administrator()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data['uuid'] = Text::uuid();
            $data['role'] = 1;

            $user = $this->Users->newEntity(
                $data,
                [
                    'associated' => ['Profiles']
                ]
            );

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Administrator setup completed successfully'));
                return $this->redirect(['action' => 'email_config']);
            }
            else {
                $this->Flash->error(__('Sorry! something went wrong'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function emailConfig()
    {

        if($this->request->is('post')){
            $iniData = parse_ini_file(ROOT.'/Conf/config.ini');
            $emilConf = $this->request->data['email'];
            $iniData['EMAIL_HOST'] = $emilConf['host'];
            $iniData['EMAIL_PORT'] = $emilConf['port'];
            $iniData['EMAIL_USERNAME'] = $emilConf['username'];
            $iniData['EMAIL_PASSWORD'] = $emilConf['password'];
            $iniData['EMAIL_CONFIGURATION_RESULT'] = true;
            $iniData['INSTALLATION_RESULT'] = true;
            if(InstallationController::writeToIni($iniData)){
                $this->Flash->success(__('Installation has been completed successfully'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            }
            else{
                $this->Flash->error(__('Sorry! something went wrong'));
            }
        }
    }


    protected function checkRequireDir($path, $dir){
        if(file_exists($path)){
            $result = [
                'mgs' => $path. ' directory is exists',
                'result' => 'success'
            ];
        }
        else{
            $this->requirementAnalysis = false;
            $result = [
                'mgs' => $dir. ' directory does not exists. Please create '. $dir . ' directory inside ' .str_replace($dir, '', $path),
                'result' => 'failed'
            ];
        }

        return $result;
    }

    protected function checkPermission($path){
        if(is_writable($path)){
            $result = [
                'mgs' => $path. ' directory is writable',
                'result' => 'success'
            ];
        }
        else{
            $this->requirementAnalysis = false;
            $result = [
                'mgs' => $path. ' directory isn\'t writable',
                'result' => 'failed'
            ];
        }

        return $result;
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
} 