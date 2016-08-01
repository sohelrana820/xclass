<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Faker\Factory;


class FakerController extends AppController
{
    public function addUser()
    {
        $this->autoRender = false;
        $faker = Factory::create();

        for($count = 0; $count < 100; $count++){
            $data = [
                'username' => $faker->email,
                'password' => '123456',
                'cPassword' => '123456',
                'profile' => [
                    'first_name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    /*'gender' => $faker->lastName,*/
                    /*'birthday' => $faker->lastName,*/
                    'street_1' => $faker->address,
                    'street_2' => $faker->secondaryAddress,
                    'phone' => $faker->phoneNumber,
                    'city' => $faker->city,
                    'postal_code	' => $faker->postcode,
                ]
            ];


            $data['uuid'] = $faker->randomDigit;
            $data['profile']['created_by'] = $this->userID;
            $user = $this->Users->newEntity(
                $data,
                [
                    'associated' => ['Profiles']
                ]
            );
            $this->Users->save($user);
        }

        echo $count. ' user saved';
    }
}
