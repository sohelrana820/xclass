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


    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
    }


    public function index()
    {
        $this->redirect(['action' => 'general']);
    }

    /**
     * @return \Cake\Network\Response|null
     */
    public function general()
    {
        $iniData = parse_ini_file(ROOT.'/Conf/config.ini');
        $this->set('settings', $iniData);

        if($this->request->is('post')){
            $iniData = parse_ini_file(ROOT.'/Conf/config.ini');
            $appName = $iniData['APPLICATION_NAME'];
            $appLogo = $iniData['APPLICATION_LOGO'];

            if(isset($this->request->data['application']['logo']['name']) && $this->request->data['application']['logo']['name']){
                $appLogo = $this->Utilities->uploadFile(WWW_ROOT.'img/attachments', $this->request->data['application']['logo'], 'logo');
            }
            if($this->request->data['application']['name']){
                $appName = $this->request->data['application']['name'];
            }

            $iniData['APPLICATION_NAME'] = $appName;
            $iniData['APPLICATION_LOGO'] = 'attachments/'.$appLogo;

            $emilConf = $this->request->data['email'];
            $iniData['EMAIL_HOST'] = $emilConf['host'];
            $iniData['EMAIL_PORT'] = $emilConf['port'];
            $iniData['EMAIL_USERNAME'] = $emilConf['username'];
            $iniData['EMAIL_PASSWORD'] = $emilConf['password'];

            if(InstallationController::writeToIni($iniData)){
                $this->Flash->success(__('Configuration has been updated successfully'));
            }
            else {
                $this->Flash->error(__('Sorry! something went wrong'));
            }
            return $this->redirect(['controller' => 'settings', 'action' => 'index']);
        }
    }

    /**
     * @return \Cake\Network\Response|null
     */
    public function email()
    {
        if($this->request->is('post')){
            $isModified = $this->Settings->registerMetaValues($this->request->data);
            if($isModified)
            {
                $this->Flash->success('Email notification has been configured successfully');
            }
            else{
                $this->Flash->error('Sorry, something went wrong');
            }
        }
        $metas = $this->Settings->retrieveMetas();
        $this->set('metas', $metas);
    }
};