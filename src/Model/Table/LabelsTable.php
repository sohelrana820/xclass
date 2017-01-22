<?php
namespace App\Model\Table;

use App\Model\Entity\Label;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Labels Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Tasks
 */
class LabelsTable extends Table
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

        $this->table('labels');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Tasks', [
            'foreignKey' => 'label_id',
            'targetForeignKey' => 'task_id',
            'joinTable' => 'tasks_labels'
        ]);
        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('color_code');

        $validator
            ->add('created_by', 'valid', ['rule' => 'numeric'])
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        return $validator;
    }

    public function countTotalLabelByProjectId($projectId)
    {
        $result = $this->find('all', ['conditions' => ['Labels.project_id' => $projectId]])
            ->count();

        return $result;
    }
}
