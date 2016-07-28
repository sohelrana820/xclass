<?php

namespace App\Controller;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Text;

class UsersController extends AppController{

    public $name = 'Users';

    /**
     * @return \Cake\Network\Response|void
     * With this function user will login into the application.
     */
    public function login()
    {
        $this->checkAuthentication();
        $this->viewBuilder()->layout('login');

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    /**
     * @return \Cake\Network\Response|void
     * This function is for create account. After create account user will get a email confirmation email.
     */
    public function signup()
    {
        $this->viewBuilder()
            ->layout('login');
        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['uuid'] = Text::uuid();
            $verifyCode = substr(Text::uuid(), 0, 32);
            $data['email_verifying_code'] = $verifyCode;

            $user = $this->Users->newEntity(
                $data,
                [
                    'associated' => ['Profiles']
                ]
            );

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Signup successful! Please check your email to verify your email'));
                $this->Email->signupConfirmEmail($data, $verifyCode);
                return $this->redirect($this->Auth->redirectUrl());
            }
            else {
                $this->Flash->error(__('Sorry! something went wrong'));
            }
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * @return \Cake\Network\Response|void
     * This function is for verify the user's email address after creating account.
     */
    public function verifyEmail()
    {
        if(!isset($this->request->query['code']) && !$this->request->query['code'])
        {
            throw new BadRequestException;
        }

        $code = $this->request->query['code'];
        $userInfo = $this->Users->getUserByEmailCode($code);
        if(!$userInfo)
        {
            throw new BadRequestException;
        }

        if($userInfo->email_verify != 1){
            $user = $this->Users->find('all')->where(['id' => $userInfo->id])->first();
            $user->email_verify = 1;
            $user->email_verifying_code = null;
            if($this->Users->save($user)){
                $this->Flash->success(__('Your email address has been verified successfully'));
            }
            else{
                $this->Flash->error(__('Sorry! something went wrong'));
            }
        }
        else{
            $this->Flash->success(__('Your email is already verified'));
        }
        return $this->redirect(['controller' => 'users', 'action' => 'login']);
    }

    /**
     * @return \Cake\Network\Response|void
     */
    public function forgotPassword()
    {
        $this->checkAuthentication();
        $this->viewBuilder()
            ->layout('login');

        if ($this->request->is('post')) {

            if(!$this->request->data['username'])
            {
                $this->Flash->error(__('Please enter email address'));
                return $this->redirect(['controller' => 'users', 'action' => 'forgot-password']);
            }

            $userInfo = $this->Users->getUserByEmail($this->request->data['username']);
            if(!$userInfo)
            {
                $this->Flash->error(__('Sorry! this email is not registered'));
                return $this->redirect(['controller' => 'users', 'action' => 'forgot-password']);
            }

            $user = $this->Users->find('all')->where(['id' => $userInfo->id])->first();
            $forgotPassCode = substr(Text::uuid(), 0, 32);;
            $user->forgot_pass_code = $forgotPassCode;

            if($this->Users->save($user)){
                $this->Email->forgotPassEmail($userInfo, $forgotPassCode);
                $this->Flash->success(__('A reset password link has been sent to your email'));
                return $this->redirect(['controller' => 'users', 'action' => 'forgot-password']);
            }
            else{
                $this->Flash->error(__('Sorry! something went wrong'));
            }
        }
    }

    /**
     * @return \Cake\Network\Response|void
     */
    public function resetPassword()
    {
        $this->checkAuthentication();
        $this->viewBuilder()
            ->layout('login');

        if (!isset($this->request->query['code']) && !$this->request->query['code']) {
            throw new BadRequestException;
        }

        $code = $this->request->query['code'];
        $userInfo = $this->Users->getUserByForgotCode($code);
        if(!$userInfo)
        {
            throw new BadRequestException;
        }

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {

            $user = $this->Users->newEntity(
                $this->request->data,
                [
                    'associated' => ['Profiles'],
                    'validate' => 'ResetPassword'
                ]
            );
            $user->id = $userInfo->id;
            $user->forgot_pass_code = null;

            if ($this->Users->save($user)) {
                $this->Email->passwordChangedEmail($userInfo);
                $this->Flash->success(__('Password has been changed successfully'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            } else {
                $this->Flash->error(__('Sorry! something went wrong'));
            }
        }

        $this->set(compact('user', 'code'));
        $this->set('_serialize', ['user']);
    }

    /**
     *
     */
    public function index()
    {
        $this->loadComponent('Paginator');
        $this->loadComponent('Utilities');

        $conditions = [
            'Users.status' => 1
        ];

        if(isset($this->request->query) && $this->request->query)
        {
            $response = $this->Utilities->buildUsesrListConditions($this->request->query);
            $conditions = array_merge($conditions, $response);
        }

        $this->paginate = [
            'conditions' => $conditions,
            'fields' => ['Users.id', 'Users.uuid',  'Users.username', 'Users.status', 'Users.role', 'Profiles.first_name', 'Profiles.last_name', 'Profiles.phone', 'Profiles.city', 'Profiles.gender'],
            'contain' => [
                'Profiles' => [
                    'fields'=> []
                ]
            ],
            'limit' => $this->paginationLimit,
            'order' => ['Users.id' => 'desc']
        ];

        $users = $this->paginate($this->Users);
        $this->set('users', $users);
        $this->set('_serialize', ['users']);
    }

    /**
     * @return \Cake\Network\Response|void
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data['uuid'] = Text::uuid();
            $data['profile']['created_by'] = $this->userID;
            $verifyCode = substr(Text::uuid(), 0, 32);
            $data['email_verifying_code'] = $verifyCode;

            if(isset($data['profile']['birthday']) && $data['profile']['birthday'])
            {
                $data['profile']['birthday'] = date('Y-m-d', strtotime($data['profile']['birthday']));
            }

            $user = $this->Users->newEntity(
                $data,
                [
                    'associated' => ['Profiles']
                ]
            );

            if ($this->Users->save($user)) {
                $this->Email->signupConfirmEmail($data, $verifyCode);
                $this->Flash->success(__('New user has been created successfully'));
                return $this->redirect(['controller' => 'users', 'action' => 'index']);
            }
            else {
                $this->Flash->error(__('Sorry! something went wrong'));
            }
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * @param $uuid
     * @return \Cake\Network\Response|void
     */
    public function edit($uuid)
    {
        if (empty($uuid)) {
            throw new NotFoundException;
        }

        if (!is_numeric($uuid)) {
            $userID = $this->Users->getIDbyUUID($uuid);
        } else {
            $userID = $uuid;
        }

        $user = $this->Users->get($userID, [
            'contain' => ['Profiles']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('User has been updated successfully'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Sorry, something went wrong'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * @param $uuid
     * @return \Cake\Network\Response|void
     */
    public function view($uuid)
    {
        if(empty($uuid))
        {
            throw new NotFoundException;
        }

        if(!is_numeric($uuid)){
            $userID = $this->Users->getIDbyUUID($uuid);
        }
        else{
            $userID = $uuid;
        }

        $user = $this->Users->get($userID, ['contain' => ['Profiles']]);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * @return \Cake\Network\Response|void
     */
    public function profile()
    {
        $user = $this->Users->get($this->userID, ['contain' => ['Profiles']]);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * @return \Cake\Network\Response|void
     */
    public function update()
    {
        $user = $this->Users->get($this->userID, [
            'contain' => ['Profiles']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your profile is updated'));
                return $this->redirect(['users' > 'users', 'action' => 'profile']);
            } else {
                $this->Flash->error(__('Sorry, something went wrong'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function changePassword()
    {
        $user = $this->Users->get($this->userID);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity(
                $user,
                $this->request->data,
                [
                    'validate' => 'ChangePassword'
                ]
            );
            $user->password = $this->request->data['new_password'];
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Password changes successfully'));
                return $this->redirect(['users' > 'users', 'action' => 'profile']);
            } else {
                $this->Flash->error(__('Sorry, something went wrong'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function changePhoto()
    {
        $directory = strtolower(str_replace(' ', '-', $this->userID));
        $rootDir = WWW_ROOT . 'img/profiles';
        $path = $rootDir . '/' . $directory;
        $folder = new Folder();
        if (!is_dir($path)) {
            $folder->create($path);
        }

        $profileImg['profile']['profile_pic'] = '';
        if (isset($this->request->data['photo']['name']) && $this->request->data['photo']['name']) {
            $profileImg['profile']['profile_pic'] = $this->userID . '/' . $this->Utilities->uploadProfilePhoto($path, $this->request->data['photo']);
        }

        $user = $this->Users->get($this->userID, [
            'contain' => ['Profiles']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $profileImg);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your profile photo updated successfully'));
            } else {
                $this->Flash->error(__('Sorry, something went wrong'));
            }
        }

        return $this->redirect(['users' > 'users', 'action' => 'profile']);
    }

    /**
     * @param null $id
     * @return \Cake\Network\Response|void
     */
    public function delete($id = null)
    {
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->error(__('The user has been deleted'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * @return \Cake\Network\Response|void
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}