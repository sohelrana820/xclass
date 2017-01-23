<?php
namespace App\Model\Table;

use App\Model\Entity\Project;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Projects Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $Attachments
 * @property \Cake\ORM\Association\HasMany $Tasks
 * @property \Cake\ORM\Association\BelongsToMany $Labels
 * @property \Cake\ORM\Association\BelongsToMany $AssignedUsers
 */
class ProjectsTable extends Table
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

        $this->table('projects');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Attachments', [
            'foreignKey' => 'project_id'
        ]);
        $this->hasMany('Tasks', [
            'foreignKey' => 'project_id'
        ]);
        $this->hasMany('Labels', [
            'foreignKey' => 'project_id',
        ]);
        $this->hasMany('Tasks', [
            'foreignKey' => 'project_id',
        ]);
        $this->belongsToMany('ProjectsUsers', [
            'foreignKey' => 'project_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'projects_users'
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
            ->requirePresence('name', 'create', 'Name must be required!')
            ->notEmpty('name', 'Name must be required!')
            ->add('name', 'unique', ['rule' => 'ValidateUnique', 'provider' => 'table', 'message' => 'Sorry, this project is already created']);

        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug', 'Slug must be required!')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        return $validator;
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }

    public function getProjectBySlug($slug)
    {
        $result = $this->find()
            ->where(['slug' => $slug])
            ->first();

        return $result;
    }

    public function getProjectDetailsBySlug($slug)
    {
        $result = $this->find()
            ->where(['slug' => $slug])
            ->contain([
                'Labels' => function($q){
                    $q->select(['id', 'project_id', 'name', 'color_code', 'status', 'created']);
                    $q->autoFields(false);
                    $q->limit(5);
                    $q->order(['Labels.created' => 'DESC']);
                    return $q;
                },
                'Tasks' => function($q){
                    $q->select(['id', 'task', 'project_id', 'identity']);
                    $q->autoFields(false);
                    $q->limit(5);
                    $q->order(['Tasks.created' => 'DESC']);
                    return $q;
                },
                'Tasks.TasksLabels' => function($q){
                    $q->select(['id', 'task_id', 'label_id']);
                    $q->autoFields(false);
                    return $q;
                },
                'Tasks.TasksLabels.Labels' => function($q){
                    $q->select(['id', 'name', 'color_code']);
                    $q->autoFields(false);
                    return $q;
                },
                'Tasks.UsersTasks' => function($q){
                    $q->select(['id', 'task_id', 'user_id']);
                    $q->autoFields(false);
                    return $q;
                },
                'Tasks.UsersTasks.Users' => function($q){
                    $q->select(['id', 'username', 'uuid']);
                    $q->autoFields(false);
                    return $q;
                },
                'Tasks.UsersTasks.Users.Profiles' => function($q){
                    $q->select(['user_id', 'first_name', 'last_name']);
                    $q->autoFields(false);
                    return $q;
                }
            ])
            ->first();

        return $result;
    }

    public function getProjectIDBySlug($slug)
    {
        $result = $this->find()
            ->where(['slug' => $slug])
            ->first();

        if($result){
            return $result->id;
        }
        return null;
    }

    public function getProjectLists($limit = 5)
    {
        $result = $this->find()
            ->select(['id', 'slug', 'name', 'description', 'status', 'created'])
            ->limit($limit)
            ->order(['Projects.created' => 'DESC'])
            ->all();

        if($result){
            return $result->toArray();
        }
        return null;
    }
}
