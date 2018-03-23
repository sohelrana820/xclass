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
     * @param $query
     * @return array
     */
    public function buildProjectListConditions($query)
    {
        $conditions = [];
        if (isset($query['name']) && $query['name']) {
            $conditions = array_merge($conditions, ['Projects.name Like' => '%' . $query['name'] . '%']);
        }

        if (isset($query['status']) && $query['status']) {
            $status = $query['status'];
            if ($status == 'progressing') {
                $conditions = array_merge($conditions, ['Projects.status' => 1]);
            } elseif ($status == 'paused') {
                $conditions = array_merge($conditions, ['Projects.status' => 2]);
            } elseif ($status == 'invalid') {
                $conditions = array_merge($conditions, ['Projects.status' => 3]);
            } elseif ($status == 'completed') {
                $conditions = array_merge($conditions, ['Projects.status' => 4]);
            }
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
        if (move_uploaded_file($documents["tmp_name"], $path . '/' . $newName)) {
            return $newName;
        }
        return false;
    }

    /**
     * @param $url
     * @return bool
     */
    public function getProjectSlug($url)
    {
        $explodedUrl = explode('projects/', $url);
        if (isset($explodedUrl[1]) && $explodedUrl[1]) {
            return $explodedUrl[1];
        }
        return false;
    }

    /**
     * @param $files
     * @param $zipFileName
     * @param $filesDirectory
     */
    public function zipFilesAndDownload($files, $zipFileName, $filesDirectory)
    {
        // Create instance of ZipArchive. and open the zip folder.
        $zip = new \ZipArchive();
        if ($zip->open($zipFileName, \ZipArchive::CREATE) !== true) {
            exit("cannot open <$zipFileName>\n");
        }

        // Adding every attachments files into the ZIP.
        foreach ($files as $key => $file) {
            $zip->addFile($filesDirectory . $file, $key);
        }
        $zip->close();

        // Download the created zip file
        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename = $zipFileName");
        header("Pragma: no-cache");
        header("Expires: 0");
        readfile("$zipFileName");
        unlink(WWW_ROOT . $zipFileName);
        exit;
    }
}
