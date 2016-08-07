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
 * @property \Cake\ORM\Association\BelongsToMany $Comments
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
        $this->belongsToMany('Comments', [
            'foreignKey' => 'task_id',
            'targetForeignKey' => 'comment_id',
            'joinTable' => 'tasks_comments'
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
            ->requirePresence('task', 'create')
            ->notEmpty('task');

        $validator
            ->allowEmpty('description');

        $validator
            ->add('status', 'valid', ['rule' => 'numeric'])
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
}
