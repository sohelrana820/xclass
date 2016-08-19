<?php
namespace App\Controller;

use App\Controller\AppController;

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

        if( $this->request->params['_ext'] != 'json'){
            $this->set('tasks', $this->paginate($this->Tasks));
            $this->set('_serialize', ['tasks']);
        }
        else {
            if (isset($this->request->query['status'])) {
                $conditions = array_merge($conditions, ['Tasks.status IN' => $this->request->query['status']]);
            }

            if (isset($this->request->query['authors'])) {
                $conditions = array_merge($conditions, ['Tasks.created_by IN' => $this->request->query['authors']]);
            }

            $tasks = $this->Tasks->find();
            $tasks->select(['id', 'task', 'created', 'status',  'createdUser.id', 'createdUser.username', 'createdUserProfile.first_name', 'createdUserProfile.last_name', 'createdUserProfile.profile_pic']);
            $tasks->where($conditions);
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

            if (isset($this->request->query['users']) && is_array($this->request->query['users'])) {
                $tasks->matching('UsersTasks', function ($q) {
                    return $q->where(['UsersTasks.user_id IN' => $this->request->query['users']]);
                });
            }

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
            'contain' => ['Attachments', 'Comments', 'Comments.Users', 'Comments.Users.Profiles', 'Labels', 'Users', 'Users.Profiles']
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
            $this->request->data['uuid'] = 'l';
            $this->request->data['created_by'] = $this->userID;
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



}
