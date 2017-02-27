<?php
/**
 * @Author: Preview ICT Ltd.
 * @URI: http://previewict.com
 * @description: This component is creating doing the some extra work.
 */
namespace App\Controller\Component;
use Cake\Controller\Component;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

class EmailComponent extends Component
{
    public $name = 'Email';

    public function generalEmail($to)
    {
        $app = new AppController();
        $subject = 'Create Account Confirmation - '.$app->appsName;
        $email = new Email('default');

        $user = array(
            'to' => $to,
            'name' => 'Sohel Rana'
        );

        $data = array(
            'user' => $user,
            'appName'=> $app->appsName,
        );

        $email->from([$app->emailFrom => $app->appsName])
            ->to($user['to'])
            ->subject($subject)
            ->theme($app->currentTheme)
            ->template('general')
            ->emailFormat('html')
            ->set(['data' => $data])
            ->send();
    }

    /**
     * @param $data
     * @param $code
     */
    public function signupConfirmEmail($data, $code)
    {
        $app = new AppController();
        $subject = 'Create Account Confirmation - '.$app->appsName;
        $email = new Email('default');
        $link = $app->baseUrl.'/users/verify_email?code='.$code;

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
        $email = new Email('default');
        $link = $app->baseUrl.'/users/reset_password?code='.$code;

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
        $email = new Email('default');

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
}
