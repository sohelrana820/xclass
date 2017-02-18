<?php
namespace App\Model\Table;

use App\Model\Entity\Task;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tasks Model
 *
 * @property \Cake\ORM\Association\HasMany $Attachments
 * @property \Cake\ORM\Association\HasMany $Comments
 * @property \Cake\ORM\Association\BelongsToMany $Labels
 * @property \Cake\ORM\Association\BelongsToMany $Users
 */
class TasksTable extends Table
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

        $this->table('tasks');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Attachments', [
            'foreignKey' => 'task_id'
        ]);
        $this->hasMany('Comments', [
            'foreignKey' => 'task_id'
        ]);
        $this->belongsToMany('Labels', [
            'foreignKey' => 'task_id',
            'targetForeignKey' => 'label_id',
            'joinTable' => 'tasks_labels'
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'task_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'users_tasks'
        ]);

        $this->hasMany('TasksLabels', [
            'foreignKey' => 'task_id'
        ]);

        $this->hasMany('UsersTasks', [
            'foreignKey' => 'task_id'
        ]);
        $this->belongsTo("Projects", [
           'foreign_key' => 'project_id'
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('uuid', 'create')
            ->notEmpty('uuid');

        $validator
            ->add('created_by', 'valid', ['rule' => 'numeric'])
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->allowEmpty('description');


        return $validator;
    }

    /**
     * @param $status
     * @return int
     */
    public function countTotalTasksByProjectId($projectId, $status = null)
    {
        $conditions = ['Tasks.project_id' => $projectId];
        if($status)
        {
            $conditions = array_merge($conditions, ['Tasks.status IN' => $status]);
        }

        $result = $this->find('all', ['conditions' => $conditions])
            ->count();

        return $result;
    }

    /**
     * @param $projectId
     * @return int]
     */
    public function countTaskByProject($projectId)
    {
        $result = $this->find('all', ['conditions' => ['Tasks.project_id' => $projectId]])
            ->count();

        return $result;
    }

    /**
     * @param int $limit
     * @return Query
     */
    public function getRecentTasks($limit = 5)
    {
        $result = $this->find('all', [
            'fields' => ['id', 'uuid', 'task', 'description', 'created'],
            'contain' => [
                'Labels' => [
                    'fields' => ['id', 'TasksLabels.task_id','name', 'color_code']
                ],
                'Users' => [
                    'fields' => ['id', 'UsersTasks.task_id','uuid']
                ],
                'Users.Profiles' => [
                    'fields' => ['id', 'UsersTasks.task_id', 'first_name', 'last_name', 'profile_pic']
                ]
            ],
            'limit' => $limit,
            'order' => 'Tasks.created DESC'
        ]);
        return $result;
    }

    /**
     * @param $projectId
     * @param $identity
     * @return mixed
     */
    public function getDetails($projectId, $identity)
    {
        $task = $this->find();
        $task->where(['Tasks.project_id' => $projectId, 'Tasks.identity' => $identity]);
        $task->select(['id', 'task', 'identity', 'description', 'created', 'status',  'createdUser.id', 'createdUser.uuid', 'createdUser.username', 'createdUserProfile.first_name', 'createdUserProfile.last_name', 'createdUserProfile.profile_pic']);
        $task->contain(
            [
                'Projects' => function($q){
                    $q->select(['name', 'slug']);
                    $q->autoFields(false);
                    return $q;
                },
                'Comments' => function($q){
                    $q->select(['id', 'user_id', 'task_id', 'comment', 'created']);
                    $q->autoFields(false);
                    return $q;
                },
                'Comments.Users' => function($q){
                    $q->select(['id', 'uuid']);
                    $q->autoFields(false);
                    return $q;
                },
                'Comments.Users.Profiles' => function($q){
                    $q->select(['user_id', 'first_name', 'last_name', 'profile_pic']);
                    $q->autoFields(false);
                    return $q;
                },
                'Comments.Attachments' => function($q){
                    $q->select(['uuid', 'comment_id', 'name']);
                    $q->autoFields(false);
                    return $q;
                },
                'Labels' => function($q){
                    $q->select(['id', 'name', 'color_code']);
                    $q->autoFields(false);
                    return $q;
                },
                'Users' => function($q){
                    $q->select(['id', 'uuid', 'username']);
                    $q->autoFields(false);
                    return $q;
                },
                'Users.Profiles' => function($q){
                    $q->select(['first_name', 'last_name', 'profile_pic']);
                    $q->autoFields(false);
                    return $q;
                },
                'Attachments' => function($q){
                    $q->select(['uuid', 'task_id', 'name']);
                    $q->autoFields(false);
                    return $q;
                },
            ]
        );
        $task->join([
            'createdUser' => [
                'table' => 'users',
                'type' => 'LEFT',
                'conditions' => 'createdUser.id = Tasks.created_by'
            ],
            'createdUserProfile' => [
                'table' => 'profiles',
                'type' => 'LEFT',
                'conditions' => 'createdUserProfile.id = Tasks.created_by'
            ],
        ]);

        return $task->first();
    }

    public function getTask($id)
    {
        $task = $this->find();
        $task->where(['Tasks.id' => $id]);
        $task->contain('Projects');
        return $task->first();
    }
}
