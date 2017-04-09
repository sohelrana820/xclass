<?php
namespace App\Model\Table;

use App\Model\Entity\ProjectsUser;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProjectsUsers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Projects
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class ProjectsUsersTable extends Table
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

        $this->table('projects_users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
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
        $rules->add($rules->existsIn(['project_id'], 'Projects'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }

    /**
     * @param $userId
     * @param $projectId
     * @return bool
     */
    public function isUserAlreadyAssigned($userId, $projectId)
    {
        $hasUser = $this->find()
            ->where(['ProjectsUsers.project_id' => $projectId, 'ProjectsUsers.user_id' => $userId])
            ->first();

        if ($hasUser) {
            return true;
        }

        return false;
    }

    /**
     * @param $projectId
     * @return int
     */
    public function countUserByProjectId($projectId)
    {
        $count = $this->find()
            ->where(['ProjectsUsers.project_id' => $projectId])
            ->count();
        return $count;
    }

    /**
     * @param $projectId
     * @param int $limit
     * @return array
     */
    public function getProjectUsers($projectId, $limit = 10)
    {
        $users = $this->find();
        $users->where(['ProjectsUsers.project_id' => $projectId]);
        $users->contain([
            'Users' => function ($q) {
                $q->select(['id', 'username', 'uuid']);
                $q->autoFields(false);
                return $q;
            },
            'Users.Profiles' => function ($q) {
                $q->select(['first_name', 'last_name', 'phone', 'profile_pic',]);
                $q->autoFields(false);
                return $q;
            }
        ]);

        $countUsers = $this->find()
            ->where(['ProjectsUsers.project_id' => $projectId])
            ->count();

        $response = [
            'success' => true,
            'message' => 'List of project users',
            'count' => $countUsers,
            'data' => $users,
        ];

        return $response;
    }


    /**
     * @param $userId
     * @return array
     */
    public function getUsersProjectIds($userId)
    {
        $project = $this->find('list', [
            'conditions' => ['ProjectsUsers.user_id' => $userId],
            'keyField' => 'id',
            'valueField' => 'project_id'])
            ->toArray();

        if (sizeof($project) > 0) {
            return $project;
        }
        return [0];
    }

    /**
     * @param $data
     * @return bool
     */
    public function assignProjectUser($data)
    {
        $projectUser = $this->newEntity($data);
        $isAssigned = $this->save($projectUser);
        if ($isAssigned) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $userId
     * @param $projectId
     * @return bool
     */
    public function removeProjectUser($userId, $projectId)
    {
        $projectUser = $this->find()
            ->where(['ProjectsUsers.user_id' => $userId, 'ProjectsUsers.project_id' => $projectId])
            ->first();
        if ($this->delete($projectUser)) {
            return true;
        }
        return false;
    }
}
