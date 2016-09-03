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
        $iniData = parse_ini_file(ROOT.'/Conf/config.ini');
        $this->set('settings', $iniData);
    }

    public function update()
    {
        if($this->request->is('post')){
            $iniData = parse_ini_file(ROOT.'/Conf/config.ini');
            $appName = $iniData['APPLICATION_NAME'];
            $appLogo = $iniData['APPLICATION_LOGO'];

            if(isset($this->request->data['application']['logo']['name']) && $this->request->data['application']['logo']['name']){
                var_dump(111111111111);
                $appLogo = $this->Utilities->uploadFile(WWW_ROOT.'img', $this->request->data['application']['logo'], 'logo');
            }
            if($this->request->data['application']['name']){
                $appName = $this->request->data['application']['name'];
            }

            $iniData['APPLICATION_NAME'] = $appName;
            $iniData['APPLICATION_LOGO'] = $appLogo;

            $emilConf = $this->request->data['email'];
            $iniData['EMAIL_HOST'] = $emilConf['host'];
            $iniData['EMAIL_PORT'] = $emilConf['port'];
            $iniData['EMAIL_USERNAME'] = $emilConf['username'];
            $iniData['EMAIL_PASSWORD'] = $emilConf['password'];

            if(InstallationController::writeToIni($iniData)){
                $this->Flash->success(__('Configuration has been successfully'));
            }
            else {
                $this->Flash->error(__('Sorry! something went wrong'));
            }
            return $this->redirect(['controller' => 'settings', 'action' => 'index']);
        }
    }
};