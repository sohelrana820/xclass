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
        $this->checkPermission($this->isAdmin());
        $this->loadComponent('Paginator');
        $conditions = [

        ];

        if(isset($this->request->query) && $this->request->query)
        {
            $response = $this->Utilities->buildTaskListConditions($this->request->query);
            $conditions = array_merge($conditions, $response);
        }

        var_dump($conditions);

        $tasks = $this->Tasks->find('all', [
            'conditions' => $conditions,
            'fields' => ['Tasks.id', 'Tasks.task', 'Tasks.status', 'Tasks.created', 'createdUser.id', 'createdUser.username', 'createdUserProfile.first_name', 'createdUserProfile.last_name', 'createdUserProfile.profile_pic'],
            'contain' => [
                'Comments' => [
                    'fields'=> ['Comments.task_id'],
                ],
                'Labels' => [
                    'fields'=> ['TasksLabels.task_id', 'name', 'color_code'],
                ],
                'Users' => [
                    'fields'=> ['UsersTasks.task_id', 'id', 'username'],
                ],
                'Users.Profiles' => [
                    'fields'=> ['UsersTasks.task_id', 'id', 'first_name', 'last_name', 'profile_pic'],
                ]
            ],
            'join' => [
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
            ],
            'limit' => $this->paginationLimit,
            'order' => ['Tasks.id' => 'desc']
        ]);

        $result = $tasks->toArray();
        $count = $this->Tasks->find('all', ['conditions' => $conditions])->count();
        var_dump($count);
        var_dump($result);
        die();

        if($this->request->params['_ext'] != 'json'){
            $this->set('tasks', $this->paginate($this->Tasks));
            $this->set('_serialize', ['tasks']);
        }
        else {
            $tasks = $this->Tasks->find('all', [
                'conditions' => $conditions,
                'fields' => ['Tasks.id', 'Tasks.task', 'Tasks.status', 'Tasks.created', 'createdUser.id', 'createdUser.username', 'createdUserProfile.first_name', 'createdUserProfile.last_name', 'createdUserProfile.profile_pic'],
                'contain' => [
                    'Comments' => [
                        'fields'=> ['Comments.task_id'],
                    ],
                    'Labels' => [
                        'fields'=> ['TasksLabels.task_id', 'name', 'color_code'],
                    ],
                    'Users' => [
                        'fields'=> ['UsersTasks.task_id', 'id', 'username'],
                    ],
                    'Users.Profiles' => [
                        'fields'=> ['UsersTasks.task_id', 'id', 'first_name', 'last_name', 'profile_pic'],
                    ]
                ],
                'join' => [
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
                ],
                'limit' => $this->paginationLimit,
                'order' => ['Tasks.id' => 'desc']
            ]);

            $count = $this->Tasks->find('all', ['conditions' => $conditions])->count();
            $response = [
                'success' => true,
                'message' => 'List of tasks',
                'data' => $tasks,
                'count' => $count,
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
