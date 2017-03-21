<?php
/**
 * @Author: Preview ICT Ltd.
 * @URI: http://previewict.com
 * @description: This component is creating doing the some extra work.
 */
namespace App\Controller\Component;
use Aura\Intl\Exception;
use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Routing\Router;

class EmailComponent extends Component
{
    public $name = 'Email';

    protected $configuration ;

    public function welcomeEmail()
    {
        $app = new AppController();
        $subject = 'Installation Completed - '.$app->appsName;
        $transporter = $this->setEmailTransporter();
        $email = new Email();
        $email->transport($transporter);

        $iniData = parse_ini_file(ROOT.'/Conf/config.ini');

        $user = array(
            'to' => $iniData['ADMIN_EMAIL'],
            'name' => $iniData['ADMIN_NAME']
        );

        $data = array(
            'user' => $user,
            'appName'=> $app->appsName,
        );

        try{
            $email->from([$app->emailFrom => $app->appsName])
                ->to($user['to'])
                ->subject($subject)
                ->theme($app->currentTheme)
                ->template('welcome')
                ->emailFormat('html')
                ->set(['data' => $data])
                ->send();
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

    /**
     * @param $data
     * @param $code
     */
    public function signupConfirmEmail($data, $code)
    {
        $app = new AppController();
        $subject = 'Create Account Confirmation - '.$app->appsName;
        $transporter = $this->setEmailTransporter();
        $email = new Email();
        $email->transport($transporter);
        $link = Router::url('/', true).'/users/verify_email?code='.$code;

        $user = array(
            'to' => $data['username'],
            'name' => $data['profile']['first_name']. ' '.$data['profile']['last_name']
        );

        $data = array(
            'user' => $user,
            'appName'=> $app->appsName,
            'link'=> $link
        );

        $email->from([$app->emailFrom => $app->appsName])
            ->to($user['to'])
            ->subject($subject)
            ->theme($app->currentTheme)
            ->template('signup_confirmation')
            ->emailFormat('html')
            ->set(['data' => $data])
            ->send();
    }

    /**
     * @param $data
     * @param $code
     */
    public function forgotPassEmail($data, $code)
    {
        $app = new AppController();
        $subject = 'Forgot Password Link - '.$app->appsName;
        $transporter = $this->setEmailTransporter();
        $email = new Email();
        $email->transport($transporter);
        $link = Router::url('/', true).'users/reset_password?code='.$code;

        $user = array(
            'to' => $data['username'],
            'name' => $data['profile']['first_name']. ' '.$data['profile']['last_name']
        );

        $data = array(
            'user' => $user,
            'appName'=> $app->appsName,
            'link'=> $link
        );

        $email->from([$app->emailFrom => $app->appsName])
            ->to($user['to'])
            ->subject($subject)
            ->theme($app->currentTheme)
            ->template('forgot_password')
            ->emailFormat('html')
            ->set(['data' => $data])
            ->send();
    }

    /**
     * @param $data
     */
    public function passwordChangedEmail($data)
    {
        $app = new AppController();
        $subject = 'Password Changed - '.$app->appsName;
        $transporter = $this->setEmailTransporter();
        $email = new Email();
        $email->transport($transporter);

        $user = array(
            'to' => $data['username'],
            'name' => $data['profile']['first_name']. ' '.$data['profile']['last_name']
        );

        $data = array(
            'user' => $user,
            'appName'=> $app->appsName,
        );

        $email->from([$app->emailFrom => $app->appsName])
            ->to($user['to'])
            ->subject($subject)
            ->theme($app->currentTheme)
            ->template('changed_password')
            ->emailFormat('html')
            ->set(['data' => $data])
            ->send();
    }

    /**
     * @return string
     */
    protected function setEmailTransporter()
    {
        $iniData = parse_ini_file(ROOT.'/Conf/config.ini');
        if(array_key_exists('SMTP_HOST', $iniData) && array_key_exists('SMTP_PORT', $iniData) && array_key_exists('SMTP_USERNAME', $iniData) && array_key_exists('SMTP_PASSWORD', $iniData)){
            $randName = md5(rand(1, 999));
            Email::configTransport($randName, [
                'className' => 'Smtp',
                'host' => $iniData['SMTP_HOST'],
                'port' => $iniData['SMTP_PORT'],
                'timeout' => 30,
                'username' => $iniData['SMTP_USERNAME'],
                'password' => $iniData['SMTP_PASSWORD'],
            ]);
            return $randName;
        }

        return 'default';
    }
}
