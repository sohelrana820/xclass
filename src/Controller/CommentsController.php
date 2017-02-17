<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Text;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 */
class CommentsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Tasks']
        ];
        $this->set('comments', $this->paginate($this->Comments));
        $this->set('_serialize', ['comments']);
    }

    /**
     * View method
     *
     * @param string|null $id Comment id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => ['Users', 'Tasks', 'Attachments']
        ]);
        $this->set('comment', $comment);
        $this->set('_serialize', ['comment']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $comment = $this->Comments->newEntity();
        $this->request->data['user_id'] = $this->userID;
        if ($this->request->is('post')) {
            $allAttachments = [];
            if(isset($this->request->data['file'])){
                $attachments = $this->request->data['file'];
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
            $comment = $this->Comments->patchEntity($comment, $this->request->data);
            $saveComment = $this->Comments->save($comment);
            if ($saveComment) {
                $this->loadModel('Tasks');
                $task = $this->Tasks->getTask($this->request->data['task_id']);
                $this->loadModel('Feeds');
                $this->Feeds->storeFeeds($task->project_id, 'commented', ['user' => $this->loggedInUser, 'task' => $task, 'comment' => $saveComment, 'project_slug' => $task->project->slug]);
                $comment->user = $this->loggedInUser;
                $response = [
                    'success' => true,
                    'message' => 'Comments has been saved successfully',
                    'data' => $comment,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Comment could not saved',
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
     * @param string|null $id Comment id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if (!$id) {
            $id = (int)$this->request->data['id'];
        }
        $comment = $this->Comments->get($id,
            [
                'contain' => [
                    'Users' => function ($q) {
                        $q->select(['id', 'uuid', 'username']);
                        $q->autoFields(false);
                        return $q;
                    },
                    'Users.Profiles' => function ($q) {
                        $q->select(['first_name', 'last_name', 'profile_pic']);
                        $q->autoFields(false);
                        return $q;
                    }
                ],
            ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

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

            $this->request->data['attachments'] = $allAttachments;
            $comment = $this->Comments->patchEntity($comment, $this->request->data);
            $updateComment = $this->Comments->save($comment);
            if ($updateComment) {

                $this->loadModel('Tasks');
                $task = $this->Tasks->getTask($this->request->data['task_id']);
                $this->loadModel('Feeds');
                $this->Feeds->storeFeeds($task->project_id, 'update_comment', ['user' => $this->loggedInUser, 'task' => $task, 'comment' => $updateComment, 'project_slug' => $task->project->slug]);
                $response = [
                    'success' => true,
                    'message' => 'Comments has been updated successfully',
                    'data' => $comment,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Comment could not updated',
                ];
            }

            $this->set('result', $response);
            $this->set('_serialize', ['result']);
        }
    }
    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        $deleteComment = $this->Comments->delete($comment);
        if ($deleteComment) {

            $this->loadModel('Tasks');
            $task = $this->Tasks->getTask($comment->task_id);
            $this->loadModel('Feeds');
            $this->Feeds->storeFeeds($task->project_id, 'delete_comment', ['user' => $this->loggedInUser, 'task' => $task, 'comment' => $comment, 'project_slug' => $task->project->slug]);

            $response = [
                'success' => true,
                'message' => 'Comments has been deleted successfully',
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Comment could not deleted',
            ];
        }
        $this->set('result', $response);
        $this->set('_serialize', ['result']);
    }
}
