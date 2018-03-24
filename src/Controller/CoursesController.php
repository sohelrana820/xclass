<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Courses Controller
 *
 * @property \App\Model\Table\CoursesTable $Courses
 */
class CoursesController extends AppController
{

    /**
     *
     */
    public function index()
    {
        $conditions = [];
        if(!$this->isAdmin()) {
            $conditions = array_merge($conditions, ['Courses.status' => 1]);
        }
        $this->paginate = [
            'conditions' => $conditions,
            'order' => ['Courses.id' => 'desc']
        ];
        $courses = $this->paginate($this->Courses);
        $this->set(compact('courses'));
        $this->set('_serialize', ['courses']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->checkPermission($this->isAdmin());
        $course = $this->Courses->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['created_by'] = $this->userID;
            $course = $this->Courses->patchEntity($course, $this->request->data);
            if ($this->Courses->save($course)) {
                $this->Flash->success(__('The course has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The course could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('course'));
        $this->set('_serialize', ['course']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Course id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->checkPermission($this->isAdmin());
        $course = $this->Courses->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $course = $this->Courses->patchEntity($course, $this->request->data);
            if ($this->Courses->save($course)) {
                $this->Flash->success(__('The course has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The course could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('course', 'users'));
        $this->set('_serialize', ['course']);
    }

    /**
     * @param null $id
     * @return \Cake\Http\Response|null
     */
    public function delete($id = null)
    {
        $this->checkPermission($this->isAdmin());
        $this->request->allowMethod(['post', 'delete']);
        $course = $this->Courses->get($id);
        if ($this->Courses->delete($course)) {
            $this->Flash->success(__('The course has been deleted.'));
        } else {
            $this->Flash->error(__('The course could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
