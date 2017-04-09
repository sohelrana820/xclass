<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Settings Model
 *
 * @method \App\Model\Entity\Setting get($primaryKey, $options = [])
 * @method \App\Model\Entity\Setting newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Setting[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Setting|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Setting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Setting[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Setting findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SettingsTable extends Table
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

        $this->table('settings');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->requirePresence('meta', 'create')
            ->notEmpty('meta');

        $validator
            ->integer('value')
            ->requirePresence('value', 'create')
            ->notEmpty('value');

        return $validator;
    }

    /**
     * @param $data
     * @return bool
     */
    public function registerMetaValues($data)
    {
        $countMeta = sizeof($data);
        $counter = 0;
        foreach ($data as $key => $value) {
            if ($this->registerMetaValue($key, $value)) {
                $counter++;
            }
        }
        if ($countMeta == $counter) {
            return true;
        }

        return false;
    }

    /**
     * @param $key
     * @param $value
     * @return \App\Model\Entity\Setting|bool
     */
    public function registerMetaValue($key, $value)
    {
        $hasKey = $this->retrieveMeta($key);

        if (!$hasKey) {
            $entity = $this->newEntity();
            $entity->meta = $key;
            $entity->value = $value;
            return $this->save($entity);
        } else {
            $meta = $this->get($hasKey->id);
            $meta->value = $value;
            return $this->save($meta);
        }
    }

    /**
     * @param $key
     * @return mixed
     */
    public function retrieveMeta($key)
    {
        return $this->find()->where(['meta' => $key])->first();
    }

    /**
     * @return array
     */
    public function retrieveMetas()
    {
        return $this->find('list', ['keyField' => 'meta', 'valueField' => 'value'])->toArray();
    }
}
