<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Text;

/**
 * Documents Controller
 *
 * @property \App\Model\Table\DocumentsTable $Documents
 */
class DocumentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $query = $this->request->getQuery();
        $conditions = [];

        if (isset($query['title']) && $query['title']) {
            $conditions = array_merge(
                $conditions,
                [
                    'Documents.title LIKE' => '%' . $query['title'] . '%',
                ]
            );
        }

        if (isset($query['status'])) {
            if($query['status']  == 'active') {
                $conditions = array_merge($conditions, ['Documents.status' => 1]);
            } else {
                $conditions = array_merge($conditions, ['Documents.status' => 0]);
            }
        }

        if (isset($query['course_id']) && $query['course_id']) {
            $conditions = array_merge($conditions, ['Documents.course_id' => (int) $query['course_id']]);
        }

        $this->paginate = [
            'conditions' => $conditions,
            'contain' => ['Courses'],
            'order' => ['Documents.id' => 'desc']
        ];
        $documents = $this->paginate($this->Documents);

        $courses = $this->Documents->Courses->find('list', ['limit' => 200]);
        $this->set(compact('documents', 'courses'));
        $this->set('_serialize', ['documents']);
    }

    /**
     * View method
     *
     * @param string|null $id Document id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $document = $this->Documents->get($id, [
            'contain' => ['Courses', 'Downloads', 'Downloads.Users', 'Downloads.Users.Profiles']
        ]);

        $this->set('document', $document);
        $this->set('_serialize', ['document']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $document = $this->Documents->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $uuid = Text::uuid();
            $data['uuid'] = $uuid;
            $data['created_by'] = $this->userID;
            // Upload image
            if(isset($data['image']) && $data['image']['size'] > 0) {
                $uploadedImage = $this->Utilities->uploadFile(WWW_ROOT . 'img/attachments', $data['image'], Text::uuid() . '_img');
                $data['image'] = 'attachments/' . $uploadedImage['name'];
            }

            // Upload document
            $uploadedDoc = $this->Utilities->uploadFile(WWW_ROOT . 'img/attachments', $data['document'], Text::uuid() . '_doc');
            if($uploadedDoc) {
                $data['name'] = $data['document']['name'];
                $data['path'] = $uploadedDoc['path'];
            }

            $document = $this->Documents->patchEntity($document, $data);
            if ($this->Documents->save($document)) {
                $this->Flash->success(__('The document has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The document could not be saved. Please, try again.'));
            }
        }
        $courses = $this->Documents->Courses->find('list', ['limit' => 200]);
        $this->set(compact('document', 'courses'));
        $this->set('_serialize', ['document']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Document id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $document = $this->Documents->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->data;
            var_dump($data);
            // Upload image
            if(isset($data['image']) && $data['image']['size'] > 0) {
                $uploadedImage = $this->Utilities->uploadFile(WWW_ROOT . 'img/attachments', $data['image'], Text::uuid() . '_img');
                $data['image'] = 'attachments/' . $uploadedImage['name'];
            } else {
                $data['image'] = $document->image;
            }

            // Upload document
            if(isset($data['document']) && $data['document']['size'] > 0) {
                $uploadedDoc = $this->Utilities->uploadFile(WWW_ROOT . 'img/attachments', $data['document'], Text::uuid() . '_doc');
                $data['name'] = $data['document']['name'];
                $data['path'] = $uploadedDoc['path'];
            }

            $document = $this->Documents->patchEntity($document, $data);
            if ($this->Documents->save($document)) {
                $this->Flash->success(__('The document has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The document could not be saved. Please, try again.'));
            }
        }
        $courses = $this->Documents->Courses->find('list', ['limit' => 200]);
        $this->set(compact('document', 'courses'));
        $this->set('_serialize', ['document']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Document id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $document = $this->Documents->get($id);
        if ($this->Documents->delete($document)) {
            $this->Flash->success(__('The document has been deleted.'));
        } else {
            $this->Flash->error(__('The document could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @param null $id
     */
    public function download($id = null)
    {
        $document = $this->Documents->get($id);
        if(!$document) {
            $this->redirect($this->referer());
        }

        try {
            $this->loadModel('Downloads');
            $downloadObj = $this->Downloads->newEntity();
            $downloadObj->user_id = $this->userID;
            $downloadObj->document_id = $document->id;
            $this->Downloads->save($downloadObj);
        } catch (\Exception $exception) {

        }

        //header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename = $document->title");
        header("Pragma: no-cache");
        header("Expires: 0");
        readfile("$document->path");
        unlink(WWW_ROOT . $document->path);
        exit;
    }
}
