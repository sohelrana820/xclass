<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\FeedsTable;
use Cake\Network\Exception\BadRequestException;
use Cake\Utility\Text;

/**
 * Tasks Controller
 *
 * @property \App\Model\Table\FeedsTable $Feeds;
 * @property \App\Model\Table\TasksTable $Tasks
 */
class TasksController extends AppController
{

    /**
     * @var null
     */
    public $projectId = null;

    /**
     *
     */
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }

    /**
     * @param $projectSlug
     */
    public function index($projectSlug = null)
    {
        //$this->checkPermission($this->isAdmin());
        $conditions = [];
        $sortBy = 'Tasks.id';
        $orderBy = 'DESC';
        $limit = 10;
        $page = 1;

        $this->loadModel('Projects');
        if ($projectSlug) {
            $projectId = $this->Projects->getProjectIDBySlug($projectSlug);
            $conditions = array_merge($conditions, ['Tasks.project_id' => $projectId]);
        } elseif ($this->loggedInUser->role == 2) {
            $this->loadModel('ProjectsUsers');
            $projectIds = $this->ProjectsUsers->getUsersProjectIds($this->loggedInUser->id);
            $conditions = array_merge($conditions, ['Tasks.project_id IN' => $projectIds]);
        }

        if ($this->request->params['_ext'] != 'json') {
            $project = $this->Projects->getProjectBySlug($projectSlug);
            if ($project == null) {
                throw new BadRequestException();
            }
            $this->set('project', $project);
            $this->set('_serialize', ['project']);
        } else {
            if (isset($this->request->query['page']) && $this->request->query['page']) {
                $page = $this->request->query['page'];
            }

            if (isset($this->request->query['sort_by'])) {
                if ($this->request->query['sort_by'] == 'id') {
                    $sortBy = 'Tasks.id';
                }
            }

            if (isset($this->request->query['limit'])) {
                $limit = $this->request->query['limit'];
            }

            if (isset($this->request->query['order_by'])) {
                $orderBy = $this->request->query['order_by'];
            }

            if (isset($this->request->query['query'])) {
                $conditions = array_merge($conditions, [
                    'or' => [
                        'Tasks.task LIKE' => '%' . $this->request->query['query'] . '%',
                        'Tasks.id' => $this->request->query['query']
                    ]
                ]);
            }

            if (isset($this->request->query['status'])) {
                $conditions = array_merge($conditions, ['Tasks.status IN' => $this->request->query['status']]);
            }

            if (isset($this->request->query['authors'])) {
                $conditions = array_merge($conditions, ['Tasks.created_by IN' => $this->request->query['authors']]);
            }

            $tasks = $this->Tasks->find();
            $tasks->select(['id', 'identity', 'task', 'created', 'status', 'createdUser.id', 'createdUser.uuid', 'createdUser.username', 'createdUserProfile.first_name', 'createdUserProfile.last_name', 'createdUserProfile.profile_pic']);
            $tasks->where($conditions);
            $tasks->order([$sortBy => $orderBy]);
            $tasks->limit($limit);
            $tasks->page($page);
            $tasks->contain(
                [
                    'Projects' => function ($q) {
                        $q->select(['name', 'slug']);
                        $q->autoFields(false);
                        return $q;
                    },
                    'Users' => function ($q) {
                        $q->select(['uuid', 'username']);
                        $q->autoFields(false);
                        return $q;
                    },
                    'Users.Profiles' => function ($q) {
                        $q->select(['first_name', 'last_name', 'profile_pic']);
                        $q->autoFields(false);
                        return $q;
                    },
                    'Labels' => function ($q) {
                        $q->select(['name', 'color_code']);
                        $q->autoFields(false);
                        return $q;
                    },
                    'Comments' => function ($q) {
                        $q->select(['id', 'task_id']);
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
            $countAll = $this->Tasks->find('all', ['conditions' => $conditions])->count();

            $response = [
                'success' => true,
                'message' => 'List of tasks',
                'count' => $tasks->count(),
                'data' => $tasks,
                'count_all' => $countAll,
                'limit' => $limit,
                'page' => $page,
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
    public function create($slug = null)
    {
    }

    /**
     * @param $projectSlug
     * @param $identity
     */
    public function view($projectSlug, $identity)
    {
        $this->loadModel('Projects');
        $projectId = $this->Projects->getProjectIDBySlug($projectSlug);
        $details = $this->Tasks->getDetails($projectId, $identity);

        if ($this->request->params['_ext'] != 'json') {
            if ($details == null) {
                throw new BadRequestException();
            }
            $this->set('task', $details);
            $this->set('_serialize', ['project']);
        } else {
            $response = [
                'success' => true,
                'message' => 'Task details',
                'data' => $details,
            ];

            $this->set('result', $response);
            $this->set('_serialize', ['result']);
        }
    }

    /**
     * @param $projectSlug
     */
    public function add($projectSlug)
    {
        $this->loadModel('Projects');
        $projectId = $this->Projects->getProjectIDBySlug($projectSlug);
        $task = $this->Tasks->newEntity();
        if ($this->request->is('post')) {
            if (isset($projectId) && $projectId) {
                $allAttachments = [];
                if (isset($this->request->data['file'])) {
                    $attachments = $this->request->data['file'];
                    foreach ($attachments as $attachment) {
                        if (isset($attachment['name']) && $attachment['name']) {
                            $result = $this->Utilities->uploadFile(WWW_ROOT . 'img/attachments', $attachment, Text::uuid());
                            $allAttachments[] = [
                                'uuid' => Text::uuid(),
                                'name' => $attachment['name'],
                                'path' => $result,
                            ];
                        }
                    }
                }

                $identity = ($this->Tasks->countTaskByProject($projectId) + 1);
                $this->request->data['uuid'] = Text::uuid();
                $this->request->data['project_id'] = $projectId;
                $this->request->data['identity'] = $identity;
                $this->request->data['created_by'] = $this->userID;
                $this->request->data['attachments'] = $allAttachments;
                $task = $this->Tasks->patchEntity($task, $this->request->data);
                $savedTask = $this->Tasks->save($task);
                if ($savedTask) {
                    $this->loadModel('Feeds');
                    $labels = [];
                    if (isset($this->request->data['labels'])) {
                        $labels = $this->request->data['labels']['_ids'];
                    }
                    $users = [];
                    if (isset($this->request->data['users'])) {
                        $users = $this->request->data['users']['_ids'];
                    }
                    $this->Feeds->storeFeeds($projectId, 'opened_task', ['user' => $this->loggedInUser, 'task' => $savedTask, 'labels' => $labels, 'users' => $users, 'project_slug' => $projectSlug]);
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
            'contain' => ['Projects']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            unset($this->request->data['createdUserProfile']);
            unset($this->request->data['createdUser']);
            unset($this->request->data['created']);
            $task = $this->Tasks->patchEntity($task, $this->request->data);

            $updateTask = $this->Tasks->save($task);
            if ($updateTask) {
                $this->loadModel('Feeds');
                $options = [
                    'user' => $this->loggedInUser,
                    'task' => $updateTask,
                    'project_slug' => $task->project->slug,
                    'edit_type' => null,
                    'edit_status' => null,
                    'action_on_label' => null,
                    'action_on_user' => null
                ];

                if (isset($this->request->data['edit_type'])) {
                    $options['edit_type'] = $this->request->data['edit_type'];
                }

                if (isset($this->request->data['edit_status'])) {
                    $options['edit_status'] = $this->request->data['edit_status'];
                }

                if (isset($this->request->data['action_on_label'])) {
                    $options['action_on_label'] = $this->request->data['action_on_label'];
                }

                if (isset($this->request->data['action_on_user'])) {
                    $options['action_on_user'] = $this->request->data['action_on_user'];
                }

                $this->Feeds->storeFeeds($task->project_id, 'edit_task', $options);
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


    /**
     * @param $uuid
     * @return \Cake\Network\Response|null
     */
    public function downloadAttachment($uuid)
    {
        $this->autoRender = false;
        $this->loadModel('Attachments');
        $attachments = $this->Attachments->getAttachmentByUUID($uuid);
        $path = WWW_ROOT . 'img/attachments/' . $attachments->path;
        $this->response->file($path, array(
            'download' => true,
            'name' => $attachments->name
        ));
        return $this->response;
    }

    /**
     * @param $uuid
     */
    public function removeAttachment($uuid)
    {
        $this->loadModel('Attachments');
        $attachment = $this->Attachments->getAttachmentByUUID($uuid);
        $attachment = $this->Attachments->get($attachment->id);

        $isTrashed = false;
        if ($this->Attachments->delete($attachment)) {
            if (file_exists(WWW_ROOT . 'img/attachments/' . $attachment->path)) {
                unlink(WWW_ROOT . 'img/attachments/' . $attachment->path);
            }
            $isTrashed = true;
        }

        if ($isTrashed) {
            $response = [
                'success' => true,
                'message' => 'Attachment has been deleted successfully',
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Attachment could not deleted',
            ];
        }

        if ($this->request->params['_ext'] != 'json') {
            if ($isTrashed) {
                $this->Flash->success('Attachment has been removed successfully');
            } else {
                $this->Flash->error('Attachment could not deleted');
            }
            $this->redirect($this->referer());
        } else {
            $this->set('result', $response);
            $this->set('_serialize', ['result']);
        }
    }
}
