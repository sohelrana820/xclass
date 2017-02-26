<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\ProjectsUsersTable;
use Cake\Network\Exception\BadRequestException;
use Cake\Utility\Inflector;
use Cake\Utility\Text;
use Composer\Package\Archiver\ZipArchiver;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 * @property \App\Model\Table\ProjectsUsersTable $ProjectsUsers;
 * @property \App\Model\Table\UsersTable $Users;
 * @property \App\Controller\Component\UtilitiesComponent $Utilities
 */
class ProjectsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $conditions = $this->Utilities->buildProjectListConditions($this->request->query);
        $containConditions = [];

        if($this->loggedInUser->role == 2){
            $this->loadModel('ProjectsUsers');
            $projectIds = $this->ProjectsUsers->getUsersProjectIds($this->loggedInUser->id);
            $conditions = array_merge($conditions, ['Projects.id IN' => $projectIds]);
        }

        $this->paginate = [
            'conditions' => $conditions,
            'limit' => 20,
            'order' => ['Projects.id' => 'DESC']
        ];
        $this->set('projects', $this->paginate($this->Projects));
        $this->set('searchConditions', $conditions);
        $this->set('_serialize', ['projects']);
    }

    /**
     * View method
     *
     * @param string|null $id Project id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $project = $this->Projects->getProjectDetailsBySlug($slug);
        if($project == null)
        {
            throw new BadRequestException();
        }
        $this->Projects->updateOpenedTime($project->id);

        $conditions = ['ProjectsUsers.project_id' => $project->id];
        $result = $this->Users->ProjectsUsers->find()
            ->select(['Users.id', 'Users.uuid', 'Users.username', 'Profiles.first_name', 'Profiles.last_name', 'Profiles.profile_pic'])
            ->where($conditions)
            ->contain(['Users', "Users.Profiles"])
            ->limit(5);

        $users = [];
        foreach ($result as $user) {
            $users[] = $user['Users'];
        }
        $overview = $this->getProjectOverview($project->id);

        $this->set('project', $project);
        $this->set('users', $users);
        $this->set('overview', $overview);
        $this->set('_serialize', ['project']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function create()
    {
        $this->checkPermission($this->isAdmin());

        $project = $this->Projects->newEntity();
        if ($this->request->is('post')) {

            $this->request->data['user_id'] = $this->userID;
            $this->request->data['slug'] = strtolower(Inflector::slug($this->request->data['name']));
            $this->request->data['deadline'] = $this->request->data['deadline'];
            $allAttachments = [];
            if(isset($this->request->data['attachments'])){
                $attachments = $this->request->data['attachments'];
                foreach($attachments as $attachment){
                    if(isset($attachment['name']) && $attachment['name']){
                        $result = $this->Utilities->uploadFile(WWW_ROOT . 'img/attachments', $attachment, Text::uuid());
                        $allAttachments[] = [
                            'uuid' => Text::uuid(),
                            'name' => $attachment['name'],
                            'path' => $result,
                        ];
                    }
                }
            }

            $this->request->data['attachments'] = $allAttachments;
            $project = $this->Projects->patchEntity($project, $this->request->data);
            $isCreated = $this->Projects->save($project);
            if ($isCreated) {
                $this->loadModel('Feeds');
                $this->Feeds->storeFeeds($isCreated->id, 'create_project', ['user' => $this->loggedInUser, 'project' => $isCreated]);
                $this->Flash->success(__('Project has been  created successfully!'));
                return $this->redirect(['action' => 'view', $isCreated->slug]);
            } else {
                $this->Flash->error(__('Project could not be created. Please, try again.'));
            }
        }
        $this->set(compact('project'));
        $this->set('_serialize', ['project']);
    }

    /**
     * Edit method
     *
     * @param string|null $slug Project id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($slug = null)
    {
        $project = $this->Projects->getProjectBySlug($slug);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $allAttachments = [];
            if(isset($this->request->data['attachments'])){
                $attachments = $this->request->data['attachments'];
                foreach($attachments as $attachment){
                    if(isset($attachment['name']) && $attachment['name']){
                        $result = $this->Utilities->uploadFile(WWW_ROOT . 'img/attachments', $attachment, Text::uuid());
                        $allAttachments[] = [
                            'uuid' => Text::uuid(),
                            'name' => $attachment['name'],
                            'path' => $result,
                        ];
                    }
                }
            }

            $this->request->data['attachments'] = $allAttachments;
            $project = $this->Projects->patchEntity($project, $this->request->data);
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('Project has been updated successfully'));
                return $this->redirect(['action' => 'view', $slug]);
            } else {
                $this->Flash->error(__('The project could not be saved. Please, try again.'));
            }
        }
        $labels = $this->Projects->Labels->find('list', ['limit' => 200]);
        $users = $this->Projects->Users->find('list', ['limit' => 200]);
        $this->set(compact('project', 'labels', 'users'));
        $this->set('_serialize', ['project']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($slug = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->getProjectBySlug($slug);
        $project = $this->Projects->get($project->id);
        if ($this->Projects->delete($project)) {
            $this->Flash->success(__('The project has been deleted.'));
        } else {
            $this->Flash->error(__('The project could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    public function users($slug)
    {
        $this->loadModel('ProjectsUsers');
        $this->loadModel('Users');
        if ($this->request->params['_ext'] != 'json') {
            $project = $this->Projects->getProjectBySlug($slug);
            if ($project == null) {
                throw new BadRequestException();
            }
            $this->set('project', $project);
            $this->set('_serialize', ['project']);
        } else {
            $limit = null;
            $project = $this->Projects->getProjectBySlug($slug);
            $conditions = ['ProjectsUsers.project_id' => $project->id];

            if (isset($this->request->query['limit']) && $this->request->query['limit']) {
                if ($this->request->query['limit'] != 'false') {
                    $limit = (int)$this->request->query['limit'];
                }
            }

            if (isset($this->request->query['name']) && $this->request->query['name']) {
                $name = $this->request->query['name'];
                $conditions = array_merge($conditions, ['OR' => ['Profiles.first_name LIKE' => '%'.$name.'%', 'Profiles.last_name LIKE' => '%'.$name.'%']]);
            }

            $users = $this->Users->ProjectsUsers->find()
                ->select(['Users.id', 'Users.uuid', 'Users.username', 'Profiles.first_name', 'Profiles.last_name', 'Profiles.profile_pic'])
                ->where($conditions)
                ->order(['ProjectsUsers.created' => 'DESC'])
                ->contain(['Users', "Users.Profiles"])
                ->limit($limit);

            $result = [];
            foreach ($users as $user) {
                $result[] = $user['Users'];
            }

            $countUsers = $this->Users->ProjectsUsers->find()
                ->where($conditions)
                ->contain(['Users', "Users.Profiles"])
                ->count();

            $response = [
                'success' => true,
                'message' => 'List of project users',
                'count' => $countUsers,
                'data' => $result,
            ];
            $this->set('result', $response);
            $this->set('_serialize', ['result']);
        }
    }


    public function assignUser()
    {
        $projectId = $this->Projects->getProjectIDBySlug($this->request->data['slug']);
        $data['user_id'] = $this->request->data['user_id'];
        $data['project_id'] = $projectId;

        if (!$projectId) {
            $response = [
                'success' => false,
                'message' => 'Sorry, something went wrong',
            ];
        } else {
            $this->loadModel('ProjectsUsers');
            $isAlreadyAssigned = $this->ProjectsUsers->isUserAlreadyAssigned($data['user_id'], $data['project_id']);
            if (!$isAlreadyAssigned) {
                $this->loadModel('Users');
                $isAssigned = $this->ProjectsUsers->assignProjectUser($data);
                if ($isAssigned) {

                    $this->loadModel('Feeds');
                    $project = $this->Projects->getProjectById($projectId);
                    $users[] = $this->request->data['user_id'];
                    $this->Feeds->storeFeeds($projectId, 'add_contributor', ['user' => $this->loggedInUser,  'users' => $users, 'project' => $project]);
                    $response = [
                        'success' => true,
                        'message' => 'User has been assigned successfully',
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Sorry, something went wrong',
                    ];
                }
            } else {
                $response = [
                    'success' => true,
                    'message' => 'This user is already assigned',
                ];
            }
        }

        $this->set('result', $response);
        $this->set('_serialize', ['result']);
    }

    public function removeUser()
    {
        $this->loadModel('ProjectsUsers');
        $projectId = $this->Projects->getProjectIDBySlug($this->request->data['slug']);
        $userId = $this->request->data['user_id'];
        $isRemoved = $this->ProjectsUsers->removeProjectUser($userId, $projectId);
        if ($isRemoved) {

            $this->loadModel('Feeds');
            $project = $this->Projects->getProjectById($projectId);
            $users[] = $this->request->data['user_id'];
            $this->Feeds->storeFeeds($projectId, 'remove_contributor', ['user' => $this->loggedInUser,  'users' => $users, 'project' => $project]);
            $response = [
                'success' => true,
                'message' => 'User has been removed successfully',
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Sorry, something went wrong',
            ];
        }

        $this->set('result', $response);
        $this->set('_serialize', ['result']);
    }

    public function attachments($productSlug)
    {
        $this->loadModel('ProjectsUsers');
        $this->loadModel('Attachments');
        $this->loadComponent('Paginator');
        $project = $this->Projects->getProjectBySlug($productSlug);
        if ($project == null) {
            throw new BadRequestException();
        }

        $tasksIds = $this->Projects->Tasks->find('list', [
            'conditions' => ['Tasks.project_id' => $project->id],
            'valueField' => 'id'
        ]);
        $commentsIds = $this->Tasks->Comments->find('list', [
            'conditions' => ['Comments.task_id IN' => $tasksIds],
            'valueField' => 'id'
        ]);

        $conditions = [
            'or' => [
                'Attachments.project_id' => $project->id,
                'Attachments.task_id IN' => $tasksIds,
                'Attachments.comment_id IN' => $commentsIds
            ]
        ];
        if(isset($this->request->query['attachment_name']) && $this->request->query['attachment_name'])
        {
            $conditions = array_merge($conditions, ['Attachments.name LIKE' => '%' . $this->request->query['attachment_name'] . '%',]);
        }

        $this->paginate = [
            'conditions' => $conditions,
            'limit' => 50,
            'order' => ['Attachments.created' => 'DESC']
        ];
        $attachments = $this->paginate($this->Attachments);
        $this->set(compact('attachments', 'project'));
    }

    /**
     * @param $productSlug
     */
    public function downloadAttachmentsZip($productSlug)
    {
        $this->loadModel('ProjectsUsers');
        $this->loadModel('Attachments');
        $this->loadComponent('Paginator');
        $project = $this->Projects->getProjectBySlug($productSlug);
        if ($project == null) {
            throw new BadRequestException();
        }

        $tasksIds = $this->Projects->Tasks->find('list', [
            'conditions' => ['Tasks.project_id' => $project->id],
            'valueField' => 'id'
        ]);
        $commentsIds = $this->Tasks->Comments->find('list', [
            'conditions' => ['Comments.task_id IN' => $tasksIds],
            'valueField' => 'id'
        ]);

        $conditions = [
            'or' => [
                'Attachments.project_id' => $project->id,
                'Attachments.task_id IN' => $tasksIds,
                'Attachments.comment_id IN' => $commentsIds
            ]
        ];
        if (isset($this->request->query['attachment_name']) && $this->request->query['attachment_name']) {
            $conditions = array_merge($conditions, ['Attachments.name LIKE' => '%' . $this->request->query['attachment_name'] . '%',]);
        }

        $attachments = $this->Attachments->find('list', [
            'conditions' => $conditions,
            'keyField' => 'name',
            'valueField' => 'path'
        ]);

        $zipName = 'attachment_of_'.strtolower(Text::slug($project->name)) . '.zip';
        $this->Utilities->zipFilesAndDownload($attachments, $zipName, WWW_ROOT . 'img/attachments/');
    }
}