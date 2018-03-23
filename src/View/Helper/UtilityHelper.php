<?php

namespace App\View\Helper;


use Cake\View\Helper;

class UtilityHelper extends Helper
{
    public function getExtension($fileName)
    {
        $extension = explode('.', $fileName);
        if(sizeof($extension) == 2){
            if(in_array('png', $extension) || in_array('jpg', $extension) || in_array('jpeg', $extension) || in_array('gif', $extension)){
                return 'img';
            }
            elseif(in_array('pdf', $extension)){
                return 'pdf';
            }
        }
        return null;
    }
}