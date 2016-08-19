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

        if (isset($query['name']) && $query['name']) {
            $conditions = array_merge(
                $conditions,
                [
                    'OR' =>
                        [
                            'Profiles.first_name LIKE' => '%' . $query['name'] . '%',
                            'Profiles.last_name LIKE' => '%' . $query['name'] . '%'
                        ]
                ]
            );
        }

        if (isset($query['email']) && $query['email']) {
            $conditions = array_merge($conditions, ['Users.username' => $query['email']]);
        }

        if (isset($query['phone']) && $query['phone']) {
            $conditions = array_merge($conditions, ['Profiles.phone LIKE' => '%' . $query['phone'] . '%',]);
        }

        if (isset($query['gender']) && $query['gender']) {
            if ($query['gender'] == 'male') {
                $conditions = array_merge($conditions, ['Profiles.gender' => 1]);
            } elseif ($query['gender'] == 'female') {
                $conditions = array_merge($conditions, ['Profiles.gender' => 2]);
            } else {
                $conditions = array_merge($conditions, ['Profiles.gender' => null]);
            }
        }

        if (isset($query['status'])) {
            $conditions = array_merge($conditions, ['Users.status' => $query['status']]);
        }

        if (isset($query['email_verify'])) {
            $conditions = array_merge($conditions, ['Users.email_verify' => $query['email_verify']]);
        }

        return $conditions;
    }


    /**
     * @param $path
     * @param $documents
     * @return bool
     */
    public function uploadProfilePhoto($path, $documents)
    {
        $uploadFile = $path . '/' . $documents['name'];
        $fileName = $documents['name'];
        if (move_uploaded_file($documents['tmp_name'], $uploadFile)) {
            return $fileName;
        }
        return false;
    }

    public function uploadFile($path, $documents, $customName)
    {
        $temp = explode(".", $documents["name"]);
        $newName = $customName . '.' . end($temp);
        if (move_uploaded_file($documents["tmp_name"], $path.'/' . $newName)) {
            return $newName;
        }
        return false;
    }
}
