<?php
/**
 * @Author: Preview ICT Ltd.
 * @URI: http://previewict.com
 * @description: This component is creating doing the some extra work.
 */
namespace App\Controller\Component;
use Cake\Controller\Component;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

class UtilitiesComponent extends Component
{
    public $name = 'Utilities';

    /**
     * @param null $query
     * @return array
     */
    public function buildUsesrListConditions($query = null)
    {
        $conditions = [];

        if(isset($query['gender']) && $query['gender']){
            if($query['gender'] == 'male'){
                $conditions = array_merge($conditions, ['Profiles.gender' => 1]);
            }
            else{
                $conditions = array_merge($conditions, ['Profiles.gender' => 2]);
            }
        }

        return $conditions;
    }

    public function uploadProfilePhoto($path, $documents)
    {
        $uploadFile = $path . '/' . $documents['name'];
        $fileName = $documents['name'];
        if (move_uploaded_file($documents['tmp_name'], $uploadFile)) {
            return $fileName;
        }
        return false;
    }
}
