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
        $this->set('labels', $this->paginate($this->Labels));
        $this->set('_serialize', ['labels']);
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
        $this->set('label', $label);
        $this->set('_serialize', ['label']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $label = $this->Labels->newEntity();
        if ($this->request->is('post')) {
            $label = $this->Labels->patchEntity($label, $this->request->data);
            if ($this->Labels->save($label)) {
                $this->Flash->success(__('The label has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The label could not be saved. Please, try again.'));
            }
        }
        $tasks = $this->Labels->Tasks->find('list', ['limit' => 200]);
        $this->set(compact('label', 'tasks'));
        $this->set('_serialize', ['label']);
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
                $this->Flash->success(__('The label has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The label could not be saved. Please, try again.'));
            }
        }
        $tasks = $this->Labels->Tasks->find('list', ['limit' => 200]);
        $this->set(compact('label', 'tasks'));
        $this->set('_serialize', ['label']);
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
            $this->Flash->success(__('The label has been deleted.'));
        } else {
            $this->Flash->error(__('The label could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
