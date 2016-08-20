<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Text;

/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 */
class TasksController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        //$this->checkPermission($this->isAdmin());
        $this->loadComponent('Paginator');
        $conditions = [];
        $sortBy = 'Tasks.id';
        $orderBy = 'DESC';

        if( $this->request->params['_ext'] != 'json'){
            $this->set('tasks', $this->paginate($this->Tasks));
            $this->set('_serialize', ['tasks']);
        }
        else {

            if (isset($this->request->query['sort_by'])) {
                if($this->request->query['sort_by'] == 'id'){
                    $sortBy = 'Tasks.id';
                }
            }

            if (isset($this->request->query['order_by'])) {
                $orderBy = $this->request->query['order_by'];
            }

            if (isset($this->request->query['status'])) {
                $conditions = array_merge($conditions, ['Tasks.status IN' => $this->request->query['status']]);
            }

            if (isset($this->request->query['authors'])) {
                $conditions = array_merge($conditions, ['Tasks.created_by IN' => $this->request->query['authors']]);
            }

            $tasks = $this->Tasks->find();
            $tasks->select(['id', 'task', 'created', 'status',  'createdUser.id', 'createdUser.username', 'createdUserProfile.first_name', 'createdUserProfile.last_name', 'createdUserProfile.profile_pic']);
            $tasks->where($conditions);
            $tasks->order([$sortBy => $orderBy]);
            $tasks->contain(
                [
                    'Users' => function($q){
                        $q->select(['uuid', 'username']);
                        $q->autoFields(false);
                        return $q;
                    },
                    'Users.Profiles' => function($q){
                        $q->select(['first_name', 'last_name', 'profile_pic']);
                        $q->autoFields(false);
                        return $q;
                    },
                    'Labels' => function($q){
                        $q->select(['name', 'color_code']);
                        $q->autoFields(false);
                        return $q;
                    },
                    'Comments' => function($q){
                        $q->select(['id']);
                        $q->autoFields(false);
                        return $q;
                    },
                    'Attachments' => function($q){
                        $q->select(['id', 'path', 'name']);
                        $q->autoFields(false);
                        return $q;
                    }
                ]
            );

            $tasks->join(
                [
                    'createdUser' => [
                        'table' => 'users',
                        'type' => 'LEFT',
                        'conditions' => 'createdUser.id = Tasks.created_by'
                    ],
                    'createdUserProfile' => [
                        'table' => 'profiles',
                        'type' => 'LEFT',
                        'conditions' => 'createdUserProfile.id = Tasks.created_by'
                    ],
                ]
            );

            if (isset($this->request->query['labels']) && is_array($this->request->query['labels'])) {
                $tasks->matching('TasksLabels', function ($q) {
                    return $q->where(['TasksLabels.label_id IN' => $this->request->query['labels']]);
                });
            }

            if (isset($this->request->query['unlabeled']) && $this->request->query['unlabeled'] != 'false') {
                $tasks->notMatching('TasksLabels', function ($q) {
                    return $q;
                });
            }

            if (isset($this->request->query['users']) && is_array($this->request->query['users'])) {
                $tasks->matching('UsersTasks', function ($q) {
                    return $q->where(['UsersTasks.user_id IN' => $this->request->query['users']]);
                });
            }

            if (isset($this->request->query['unassigned']) && $this->request->query['unassigned'] != 'false') {
                $tasks->notMatching('UsersTasks', function ($q) {
                    return $q;
                });
            }

            $tasks->group(['Tasks.id']);
            $tasks->all();
            $countAll = $this->Tasks->find('all')->count();

            $response = [
                'success' => true,
                'message' => 'List of tasks',
                'count' => $tasks->count(),
                'data' => $tasks,
                'count_all' => $countAll,
            ];
            $this->set('result', $response);
            $this->set('_serialize', ['result']);
        }
    }

    /**
     * View method
     *
     * @param string|null $id Task id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => ['Attachments', 'Comments', 'Comments.Users', 'Comments.Users.Profiles', 'Labels', 'Users', 'Users.Profiles', 'Comments.Attachments']
        ]);

        $response = [
            'success' => true,
            'message' => 'Task details',
            'data' => $task,
        ];

        $this->set('result', $response);
        $this->set('_serialize', ['result']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $task = $this->Tasks->newEntity();
        if ($this->request->is('post')) {

            $allAttachments = [];
            if(isset($this->request->data['file'])){
                $attachments = $this->request->data['file'];
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

            $this->request->data['uuid'] =  Text::uuid();
            $this->request->data['created_by'] = $this->userID;
            $this->request->data['attachments'] = $allAttachments;
            $task = $this->Tasks->patchEntity($task, $this->request->data);
            if ($this->Tasks->save($task)) {
                $response = [
                    'success' => true,
                    'message' => 'New task has been created successfully',
                    'data' => $task,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Task could not created',
                    'data' => null,
                ];
            }
            $this->set('result', $response);
            $this->set('_serialize', ['result']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->Tasks->patchEntity($task, $this->request->data);
            if ($this->Tasks->save($task)) {
                $response = [
                    'success' => true,
                    'message' => 'Task has been updated successfully',
                    'data' => $task,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Task could not updated',
                    'data' => null,
                ];
            }
            $this->set('result', $response);
            $this->set('_serialize', ['result']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $task = $this->Tasks->get($id);
        if ($this->Tasks->delete($task)) {
            $response = [
                'success' => true,
                'message' => 'Task has been deleted successfully',
                'data' => $task,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Task could not deleted',
                'data' => null,
            ];
        }
        $this->set('result', $response);
        $this->set('_serialize', ['result']);
    }


    public function downloadAttachment($uuid)
    {
        $this->autoRender = false;
        $this->loadModel('Attachments');
        $attachments = $this->Attachments->getAttachmentByUUID($uuid);
        $path = WWW_ROOT.'img/attachments/'.$attachments->path;
        $this->response->file($path, array(
            'download' => true,
            'name' => $attachments->name
        ));
        return $this->response;
    }
}
