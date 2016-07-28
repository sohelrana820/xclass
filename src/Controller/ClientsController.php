<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Utility\Text;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 */
class ClientsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'conditions' => ['Clients.status' => 1],
            'fields' => ['Clients.id', 'Clients.uuid',  'Clients.email', 'Clients.status', 'Clients.name', 'Clients.phone', 'Clients.city', 'Clients.website'],
            'recursive' => -1,
            'limit' => $this->paginationLimit,
            'order' => ['Clients.id' => 'desc']
        ];

        $this->set('clients', $this->paginate($this->Clients));
        $this->set('_serialize', ['clients']);
    }

    /**
     * @param $uuid
     * @throws NotFoundException
     */
    public function view($uuid)
    {
        if(empty($uuid))
        {
            throw new NotFoundException;
        }

        if(!is_numeric($uuid)){
            $clientID = $this->Clients->getIDbyUUID($uuid);
        }
        else{
            $clientID = $uuid;
        }

        $client = $this->Clients->get($clientID, [
            'contain' => []
        ]);
        $this->set('client', $client);
        $this->set('_serialize', ['client']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $client = $this->Clients->newEntity();
        if ($this->request->is('post')) {

            $this->request->data['uuid'] = Text::uuid();
            $this->request->data['created_by'] = $this->userID;

            $client = $this->Clients->patchEntity($client, $this->request->data);
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved successfully'));
                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error(__('The client could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('client'));
        $this->set('_serialize', ['client']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Client id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($uuid = null)
    {
        if(empty($uuid))
        {
            throw new NotFoundException;
        }

        if(!is_numeric($uuid)){
            $clientID = $this->Clients->getIDbyUUID($uuid);
        }
        else{
            $clientID = $uuid;
        }

        $client = $this->Clients->get($clientID, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $client = $this->Clients->patchEntity($client, $this->request->data);
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been updated successfully'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The client could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('client'));
        $this->set('_serialize', ['client']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Client id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $client = $this->Clients->get($id);
        if ($this->Clients->delete($client)) {
            $this->Flash->success(__('The client has been deleted.'));
        } else {
            $this->Flash->error(__('The client could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
