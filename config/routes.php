<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\Router;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass('DashedRoute');

Router::scope('/', function ($routes) {
    $routes->extensions(['json', 'xml', 'html']);

    $routes->connect('/', ['controller' => 'dashboard', 'action' => 'index', 'home']);

    $routes->connect('/profile', ['controller' => 'users', 'action' => 'profile']);
    $routes->connect('/profile/update', ['controller' => 'users', 'action' => 'updateProfile']);
    $routes->connect('/profile/change-password', ['controller' => 'users', 'action' => 'changeProfilePassword']);
    $routes->connect('/projects/create', ['controller' => 'projects', 'action' => 'create']);
    $routes->connect('/projects/:slug', ['controller' => 'projects', 'action' => 'view'], ['pass' => ['slug']]);

    $routes->connect('/:slug/tasks', ['controller' => 'tasks', 'action' => 'index'], ['pass' => ['slug']]);
    $routes->connect('/:slug/tasks/create', ['controller' => 'tasks', 'action' => 'add'], ['pass' => ['slug']]);
    $routes->connect('/:slug/tasks/:id', ['controller' => 'tasks', 'action' => 'view'], ['pass' => ['slug', 'id']]);

    $routes->connect('/:slug/labels', ['controller' => 'labels', 'action' => 'index'], ['pass' => ['slug']]);
    $routes->connect('/:slug/labels/create', ['controller' => 'labels', 'action' => 'add'], ['pass' => ['slug']]);

    $routes->connect('/:slug/feeds', ['controller' => 'feeds', 'action' => 'index'], ['pass' => ['slug']]);

    $routes->connect('/users/save', ['controller' => 'users', 'action' => 'add']);
    $routes->connect('/:slug/users', ['controller' => 'projects', 'action' => 'users'], ['pass' => ['slug']]);
    $routes->connect('/:slug/assign_user', ['controller' => 'projects', 'action' => 'assign_user'], ['pass' => ['slug']]);
    $routes->connect('/:slug/remove_user', ['controller' => 'projects', 'action' => 'remove_user'], ['pass' => ['slug']]);
    $routes->connect('/:slug/attachments', ['controller' => 'projects', 'action' => 'attachments'], ['pass' => ['slug']]);
    $routes->connect('/:slug/download_attachments', ['controller' => 'projects', 'action' => 'download_attachments'], ['pass' => ['slug']]);

    $routes->fallbacks('DashedRoute');
});


Router::scope('/', function ($routes) {
    $routes->extensions(['json']);
    $routes->resources('Labels');
    $routes->resources('Tasks');
    $routes->resources('Comments');
    $routes->resources('Projects');
});
/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
