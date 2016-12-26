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
        $this->belongsToMany('AssignedUsers', [
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
            ->contain(['Labels', 'Users', 'Attachments', 'Tasks'])
            ->first();

        return $result;
    }

    public function getProjectIDBySlug($slug)
    {
        $result = $this->find()
            ->where(['slug' => $slug])
            ->contain(['Labels', 'Users', 'Attachments', 'Tasks'])
            ->first();

        if($result){
            return $result->id;
        }
        return null;
    }
}
