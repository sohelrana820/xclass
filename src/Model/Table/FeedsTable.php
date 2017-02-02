<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Routing\Router;
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
        }

        $feed = $this->newEntity();
        $feed = $this->patchEntity($feed, $data);
        if ($this->save($feed)) {
            return true;
        } else {
            return false;
        }
    }


    private function generateTitle($event, $data)
    {
        $title = "";
        if($event == 'create_project'){
            $title .= $this->getUserLink($data['user']);
            $title .= ' has been created new project ';
            $title .= $this->getProjectLink($data['project']);
        }
        elseif($event == 'opened_task'){
            $title .= $this->getUserLink($data['user']);
            $title .= ' has been opened new task ';
            $title .= $this->getTaskLink($data['project_slug'], $data['task']);
        }
        return $title;
    }

    private function getUserLink($user)
    {
        $link = "<a href='".Router::url('/', true)."users/view/".$user->uuid."'>{$user->profile->first_name} {$user->profile->last_name}</a>";
        return $link;
    }

    private function getProjectLink($project)
    {
        $link = "<a href='".Router::url('/', true)."projects/view/".$project->slug."'>{$project->name}</a>";
        return $link;
    }

    private function getTaskLink($projectSlug, $task)
    {
        $link = "<a href='".Router::url('/', true)."{$projectSlug}/tasks/".$task->identity."'>{$task->task}</a>";
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
