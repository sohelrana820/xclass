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

        if($this->request->params['_ext'] != 'json'){
            $this->set('tasks', $this->paginate($this->Tasks));
            $this->set('_serialize', ['tasks']);
        }
        else {
            $tasks = $this->Tasks->find('all', [
                'conditions' => $conditions,
                'fields' => [],
                'contain' => [
                    'Labels' => [
                        'fields'=> []
                    ],
                    'Users' => [
                        'fields'=> []
                    ],
                    'Users.Profiles' => [
                        'fields'=> []
                    ]
                ],
                'limit' => $this->paginationLimit,
                'order' => ['Tasks.id' => 'desc']
            ]);

            $response = [
                'success' => true,
                'message' => 'List of users',
                'data' => $tasks,
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
            'contain' => ['Attachments', 'Comments']
        ]);
        $this->set('task', $task);
        $this->set('_serialize', ['task']);
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
                $this->Flash->success(__('The task has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The task could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('task'));
        $this->set('_serialize', ['task']);
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
            $this->Flash->success(__('The task has been deleted.'));
        } else {
            $this->Flash->error(__('The task could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
