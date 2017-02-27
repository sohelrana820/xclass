<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * Feeds Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Projects
 * @property \Cake\ORM\Association\BelongsTo $Tasks
 *
 * @method \App\Model\Entity\Feed get($primaryKey, $options = [])
 * @method \App\Model\Entity\Feed newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Feed[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Feed|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Feed patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Feed[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Feed findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FeedsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('feeds');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id'
        ]);
        $this->belongsTo('Tasks', [
            'foreignKey' => 'task_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('event', 'create')
            ->notEmpty('event');

        return $validator;
    }

    /**
     * @param $projectId
     * @param $event
     * @param $content
     * @return bool
     */
    public function storeFeeds($projectId, $event, $content)
    {
        $data = [
            'project_id' => $projectId,
            'event' => $event,
            'title' => $this->generateTitle($event, $content),
        ];

        if($event == 'opened_task'){
            $data['task_id'] = $content['task']->id;
            if($this->add($data))
            {
                if(isset($content['labels']) && sizeof($content['labels']) > 0)
                {
                    $title = $this->generateTitle('added_label', $content);
                    $data['title'] = $title;
                    $data['event'] = 'added_label';
                    $this->add($data);
                }

                if(isset($content['users']) && sizeof($content['users']) > 0)
                {
                    $title = $this->generateTitle('assigned_user', $content);
                    $data['title'] = $title;
                    $data['event'] = 'assigned_user';
                    $this->add($data);
                }
            }
        }
        elseif($event == 'edit_task'){
            $data['task_id'] = $content['task']->id;
            if($content['edit_type'] == 'label_event'){
                if($content['edit_status']){
                    $data['event'] = 'added_label_to_task';
                }
                else{
                    $data['event'] = 'removed_label_form_task';
                }
            }
            elseif($content['edit_type'] == 'user_event'){
                if($content['edit_status']){
                    $data['event'] = 'assigned_user';
                }
                else{
                    $data['event'] = 'removed_user';
                }
            }
            elseif($content['edit_type'] == 'change_status'){
                if($content['edit_status'] == 2){
                    $data['event'] = 'task_closed';
                }
                else{
                    $data['event'] = 'task_reopened';
                }
            }
            $this->add($data);
        }
        elseif($event == 'commented'){
            if(array_key_exists('comment', $content) && $content['comment']->comment)
            {
                $this->add($data);
            }
        }
        else{
            $this->add($data);
        }
    }

    /**
     * @param $data
     * @return bool
     */
    public function add($data)
    {
        $feed = $this->newEntity();
        $feed = $this->patchEntity($feed, $data);
        if ($this->save($feed)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $event
     * @param $data
     * @return string
     */
    private function generateTitle($event, $data)
    {
        $title = "";
        if($event == 'create_project'){
            $title .= $this->getUserLink($data['user']);
            $title .= ' has been created new project ';
            $title .= $this->getProjectLink($data['project']);
        }
        if($event == 'create_label'){
            $title .= $this->getUserLink($data['user']);
            $title .= ' has been created new label ';
            $title .= "<label style='border: 1px solid {$data['label']->color_code}; color: {$data['label']->color_code}'>{$data['label']->name}</label>";
        }
        if($event == 'update_label'){
            $title .= $this->getUserLink($data['user']);
            $title .= ' has been updated label ';
            $title .= "<label style='border: 1px solid {$data['label']->color_code}; color: {$data['label']->color_code}'>{$data['label']->name}</label>";
        }
        if($event == 'delete_label'){
            $title .= $this->getUserLink($data['user']);
            $title .= ' has been deleted label ';
            $title .= "<label style='border: 1px solid {$data['label']->color_code}; color: {$data['label']->color_code}'>{$data['label']->name}</label>";
        }
        elseif($event == 'opened_task'){
            $title .= $this->getUserLink($data['user']);
            $title .= ' has been opened new task ';
            $title .= $this->getTaskLink($data['project_slug'], $data['task']);
        }
        elseif($event == 'edit_task'){
            if($data['edit_type'] == 'label_event'){
                if($data['edit_status']){
                    $title .= "  <label style='border: 1px solid {$data['action_on_label']['color_code']}; color: {$data['action_on_label']['color_code']}'>{$data['action_on_label']['name']}</label> has been added to ";
                }
                else{
                    $title .= "  <label style='border: 1px solid {$data['action_on_label']['color_code']}; color: {$data['action_on_label']['color_code']}'>{$data['action_on_label']['name']}</label> has been removed from ";
                }
            }
            elseif($data['edit_type'] == 'user_event'){
                if($data['edit_status']){
                    $title .= " {$this->getUserLink($data['action_on_user'])} has been assigned to ";
                }
                else{
                    $title .= " {$this->getUserLink($data['action_on_user'])} has been removed from ";
                }
            }
            elseif($data['edit_type'] == 'change_status'){
                $title .= $this->getUserLink($data['user']);
                if($data['edit_status'] == 2){
                    $title .= " <strong class='label label-default'>closed</strong> task ";
                }
                else{
                    $title .= "  <strong class='label label-danger'>reopened</strong> task ";
                }
            }
            else{
                $title .= $this->getUserLink($data['user']);
                $title .= ' has been edited task ';
            }
            $title .= $this->getTaskLinkWithID($data['project_slug'], $data['task']);
        }
        elseif($event == 'added_label'){
            $labelTable = TableRegistry::get('Labels');
            $labels = $labelTable->findLabels($data['labels']);
            foreach ($labels as $label)
            {
                $title .= "<label style='border: 1px solid {$label->color_code}; color: {$label->color_code}'>{$label->name}</label>";
            }
            $title .= ' label has been added to ';
            $title .= $this->getTaskLink($data['project_slug'], $data['task']);
        }
        elseif($event == 'assigned_user'){
            $userTable = TableRegistry::get('Users');
            $users = $userTable->findUsers($data['users']);
            foreach ($users as $user)
            {
                $title .= $this->getUserLink($user);
            }
            $title .= ' assigned to ';
            $title .= $this->getTaskLink($data['project_slug'], $data['task']);
        }
        elseif($event == 'add_contributor'){
            $userTable = TableRegistry::get('Users');
            $users = $userTable->findUsers($data['users']);
            foreach ($users as $user)
            {
                $title .= $this->getUserLink($user);
            }
            $title .= ' has been added to ';
            $title .= $this->getProjectLink($data['project']);
        }
        elseif($event == 'remove_contributor'){
            $userTable = TableRegistry::get('Users');
            $users = $userTable->findUsers($data['users']);
            foreach ($users as $user)
            {
                $title .= $this->getUserLink($user);
            }
            $title .= ' is removed from ';
            $title .= $this->getProjectLink($data['project']);
        }
        elseif($event == 'commented'){
            $title .= $this->getUserLink($data['user']);
            $title .= ' commented "'.$this->getCommentLink($data['project_slug'], $data['task'], $data['comment']).'"" on ';
            $title .= $this->getTaskLinkWithID($data['project_slug'], $data['task']);
        }
        elseif($event == 'update_comment'){
            $title .= $this->getUserLink($data['user']);
            $title .= ' update comment "'.Text::truncate($data['comment']->comment, 50).'"" on ';
            $title .= $this->getTaskLinkWithID($data['project_slug'], $data['task']);
        }
        elseif($event == 'delete_comment'){
            $title .= $this->getUserLink($data['user']);
            $title .= ' delete comment "'.Text::truncate($data['comment']->comment, 50).'"" on ';
            $title .= $this->getTaskLinkWithID($data['project_slug'], $data['task']);
        }
        return $title;
    }

    /**
     * @param $user
     * @return string
     */
    private function getUserLink($user)
    {
        if(is_object($user)){
            $link = "<a class='author_link' href='".Router::url('/', true)."users/view/".$user->uuid."'>{$user->profile->first_name} {$user->profile->last_name}</a>";
        }
        else{
            $link = "<a class='author_link' href='".Router::url('/', true)."users/view/".$user['uuid']."'>{$user['profile']['first_name']} {$user['profile']['last_name']}</a>";
        }
        return $link;
    }

    /**
     * @param $project
     * @return string
     */
    private function getProjectLink($project)
    {
        $link = "<a class='project_link' href='".Router::url('/', true)."projects/{$project->slug}'>{$project->name}</a>";
        return $link;
    }

    /**
     * @param $projectSlug
     * @param $task
     * @return string
     */
    private function getTaskLink($projectSlug, $task)
    {
        $link = "<a class='project_link' href='".Router::url('/', true)."{$projectSlug}/tasks/{$task->identity}'>".Text::truncate($task->task, 50)."</a>";
        return $link;
    }

    /**
     * @param $projectSlug
     * @param $task
     * @return string
     */
    private function getTaskLinkWithID($projectSlug, $task)
    {
        $link = "<a class='project_link' href='".Router::url('/', true)."{$projectSlug}/tasks/{$task->identity}'>Task #{$task->id}</a>";
        return $link;
    }

    /**
     * @param $projectSlug
     * @param $task
     * @param $comment
     * @return string
     */
    private function getCommentLink($projectSlug, $task, $comment)
    {
        $link = "<a class='project_link' href='".Router::url('/', true)."{$projectSlug}/tasks/{$task->identity}#/{$comment->uuid}'>".Text::truncate($comment->comment, 70)."</a>";
        return $link;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['project_id'], 'Projects'));
        $rules->add($rules->existsIn(['task_id'], 'Tasks'));

        return $rules;
    }
}
