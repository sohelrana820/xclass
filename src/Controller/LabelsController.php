<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\BadRequestException;
use Cake\Routing\Router;

/**
 * Labels Controller
 *
 * @property \App\Model\Table\LabelsTable $Labels
 */
class LabelsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * @param null $projectSlug
     */
    public function index($projectSlug = null)
    {
        $conditions = [];
        $limit = 5;
        $page = 1;

        $this->loadModel('Projects');
        $projectId = $this->Projects->getProjectIDBySlug($projectSlug);

        if(!$projectId)
        {
            throw new BadRequestException();
        }

        if( $this->request->params['_ext'] != 'json'){
            $project = $this->Projects->getProjectBySlug($projectSlug);
            if($project == null)
            {
                throw new BadRequestException();
            }
            $this->set('project', $project);
            $this->set('_serialize', ['project']);
        }
        else{
            if (isset($projectId) && $projectId) {
                $conditions = array_merge($conditions, ['Labels.project_id' => $projectId]);
            }

            if (isset($this->request->query['name'])) {
                $conditions = array_merge($conditions, ['Labels.name LIKE' => '%'.$this->request->query['name'].'%']);
            }

            if (isset($this->request->query['status'])) {
                $conditions = array_merge($conditions, ['Labels.status' => $this->request->query['status']]);
            }

            if(isset($this->request->query['page']) && $this->request->query['page']){
                $page = $this->request->query['page'];
            }

            if(isset($this->request->query['limit']) && $this->request->query['limit']){
                if($this->request->query['limit'] == 'false'){
                    $limit = null;
                }
                else{
                    $limit = (int) $this->request->query['limit'];
                }
            }

            $labels = $this->Labels->find('all',
                [
                    'conditions' => $conditions,
                    'order' => 'created DESC',
                    'limit' => $limit,
                    'page' => $page
                ]
            );

            $count = $this->Labels->find('all', ['conditions' => $conditions])->count();
            $response = [
                'success' => true,
                'message' => 'List of labels',
                'data' => $labels,
                'count' => $count,
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
     * @param string|null $id Label id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $label = $this->Labels->get($id, [
            'contain' => ['Tasks']
        ]);

        if($label)
        {
            $response = [
                'success' => true,
                'message' => 'Details of label',
                'data' => $label,
            ];
        }
        else{
            $response = [
                'success' => false,
                'message' => 'Record not found',
            ];
        }

        $this->set('result', $response);
        $this->set('_serialize', ['result']);
    }

    /**
     * @param null $projectSlug
     */
    public function add($projectSlug)
    {
        $this->loadModel('Projects');
        $projectId = $this->Projects->getProjectIDBySlug($projectSlug);

        if(!$projectId)
        {
            throw new BadRequestException();
        }

        if(isset($projectId) && $projectId)
        {
            $this->request->data['created_by'] = $this->userID;
            $this->request->data['project_id'] = $projectId;
            $label = $this->Labels->newEntity();

            if ($this->request->is('post')) {
                $label = $this->Labels->patchEntity($label, $this->request->data);
                $saveLabel = $this->Labels->save($label);
                if ($saveLabel) {
                    $this->loadModel('Feeds');
                    $this->Feeds->storeFeeds($projectId, 'create_label', ['user' => $this->loggedInUser, 'label' => $saveLabel]);
                    $response = [
                        'success' => true,
                        'message' => 'New label has been created successfully',
                        'data' => $label,
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Label could not created',
                        'data' => null,
                    ];
                }
            }
        }
        else{
            $response = [
                'success' => false,
                'message' => 'Label could not created',
                'data' => null,
            ];
        }

        $this->set('result', $response);
        $this->set('_serialize', ['result']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Label id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $label = $this->Labels->get($id, [
            'contain' => ['Tasks']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $label = $this->Labels->patchEntity($label, $this->request->data);
            $updateLabel = $this->Labels->save($label);

            if ($updateLabel) {
                $this->loadModel('Feeds');
                $this->Feeds->storeFeeds($updateLabel->project_id, 'update_label', ['user' => $this->loggedInUser, 'label' => $updateLabel]);
                $response = [
                    'success' => true,
                    'message' => 'Label has been updated successfully',
                    'data' => $label,
                ];

            } else {
                $response = [
                    'success' => false,
                    'message' => 'Label could not updated',
                    'data' => null,
                ];
            }
        }
        $this->set('result', $response);
        $this->set('_serialize', ['result']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Label id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $label = $this->Labels->get($id);
        if ($this->Labels->delete($label)) {
            $this->loadModel('Feeds');
            $this->Feeds->storeFeeds($label->project_id, 'delete_label', ['user' => $this->loggedInUser, 'label' => $label]);
            $response = [
                'success' => true,
                'message' => 'Label has been deleted successfully',
                'data' => $label,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Label could not deleted',
                'data' => null,
            ];
        }
        $this->set('result', $response);
        $this->set('_serialize', ['result']);
    }
}
