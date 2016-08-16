<?php
namespace App\Controller;

use App\Controller\AppController;

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
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'limit' => 50,
            'order' => ['Labels.created' => 'DESC'],
        ];
        $labels = $this->paginate($this->Labels);

        $response = [
            'success' => true,
            'message' => 'List of labels',
            'data' => $labels,
        ];

        $this->set('result', $response);
        $this->set('_serialize', ['result']);
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
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->data['created_by'] = $this->userID;
        $label = $this->Labels->newEntity();

        if ($this->request->is('post')) {
            $label = $this->Labels->patchEntity($label, $this->request->data);
            if ($this->Labels->save($label)) {
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
            if ($this->Labels->save($label)) {

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
