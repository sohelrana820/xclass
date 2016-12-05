<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Inflector;
use Cake\Utility\Text;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 */
class ProjectsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $conditions = $this->Utilities->buildProjectListConditions($this->request->query);
        $this->paginate = [
            'conditions' => $conditions,
            'limit' => 10
        ];
        $this->set('projects', $this->paginate($this->Projects));
        $this->set('_serialize', ['projects']);
    }

    /**
     * View method
     *
     * @param string|null $id Project id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $project = $this->Projects->getProjectBySlug($slug);
        $this->set('project', $project);
        $this->set('_serialize', ['project']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function create()
    {
        $project = $this->Projects->newEntity();
        if ($this->request->is('post')) {

            $this->request->data['user_id'] = $this->userID;
            $this->request->data['slug'] = strtolower(Inflector::slug($this->request->data['name']));

            $allAttachments = [];
            if(isset($this->request->data['attachments'])){
                $attachments = $this->request->data['attachments'];
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

            $this->request->data['attachments'] = $allAttachments;
            $project = $this->Projects->patchEntity($project, $this->request->data);
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been successfully!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project could not be created. Please, try again.'));
            }
        }
        $this->set(compact('project'));
        $this->set('_serialize', ['project']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => ['Labels', 'Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->data);
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The project could not be saved. Please, try again.'));
            }
        }
        $labels = $this->Projects->Labels->find('list', ['limit' => 200]);
        $users = $this->Projects->Users->find('list', ['limit' => 200]);
        $this->set(compact('project', 'labels', 'users'));
        $this->set('_serialize', ['project']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($slug = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->getProjectBySlug($slug);
        $project = $this->Projects->get($project->id);
        if ($this->Projects->delete($project)) {
            $this->Flash->success(__('The project has been deleted.'));
        } else {
            $this->Flash->error(__('The project could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
