<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Lebels Controller
 *
 * @property \App\Model\Table\LebelsTable $Lebels
 */
class LebelsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('lebels', $this->paginate($this->Lebels));
        $this->set('_serialize', ['lebels']);
    }

    /**
     * View method
     *
     * @param string|null $id Lebel id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lebel = $this->Lebels->get($id, [
            'contain' => []
        ]);
        $this->set('lebel', $lebel);
        $this->set('_serialize', ['lebel']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lebel = $this->Lebels->newEntity();
        if ($this->request->is('post')) {
            $lebel = $this->Lebels->patchEntity($lebel, $this->request->data);
            if ($this->Lebels->save($lebel)) {
                $this->Flash->success(__('The lebel has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The lebel could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('lebel'));
        $this->set('_serialize', ['lebel']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Lebel id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lebel = $this->Lebels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lebel = $this->Lebels->patchEntity($lebel, $this->request->data);
            if ($this->Lebels->save($lebel)) {
                $this->Flash->success(__('The lebel has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The lebel could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('lebel'));
        $this->set('_serialize', ['lebel']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Lebel id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lebel = $this->Lebels->get($id);
        if ($this->Lebels->delete($lebel)) {
            $this->Flash->success(__('The lebel has been deleted.'));
        } else {
            $this->Flash->error(__('The lebel could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
