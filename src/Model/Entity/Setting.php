<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Setting Entity
 *
 * @property int $id
 * @property string $meta
 * @property int $value
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Setting extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    public function registerMetaValues($keys)
    {
        foreach ($keys as $key => $value)
        {
            $this->registerMetaValue($key, $value);
        }
    }

    public function registerMetaValue($key, $value)
    {
        var_dump($key); die();
    }
}
