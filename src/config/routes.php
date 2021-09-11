<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/*
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
 */

/** @var RouteBuilder $routes */
$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $routes) {
    $routes->connect('/', [
        'controller' => 'Collections',
        'action' => 'index',
    ]);

    $routes->connect('/{id}/view', [
        'controller' => 'Collections',
        'action' => 'view',
    ])
        ->setPass(['id'])
        ->setPatterns(['id' => '[0-9]+']);

    $routes->connect('/{id}/edit', [
        'controller' => 'Collections',
        'action' => 'edit',
    ])
        ->setPass(['id'])
        ->setPatterns(['id' => '[0-9]+']);

    $routes->connect('/{id}/delete', [
        'controller' => 'Collections',
        'action' => 'delete',
    ])
        ->setPass(['id'])
        ->setPatterns(['id' => '[0-9]+']);

    $routes->connect('/{collectionId}/elements/add', [
        'controller' => 'Elements',
        'action' => 'add',
    ])
        ->setPass(['collectionId'])
        ->setPatterns(['collectionId' => '[0-9]+']);

    $routes->connect('/{collectionId}/elements/{elementId}', [
        'controller' => 'Elements',
        'action' => 'view',
    ])
        ->setPass(['collectionId', 'elementId'])
        ->setPatterns([
            'collectionId' => '[0-9]+',
            'elementId' => '[0-9]+',
        ]);

    $routes->connect('/{collectionId}/elements/{elementId}/edit', [
        'controller' => 'Elements',
        'action' => 'edit',
    ])
        ->setPass(['collectionId', 'elementId'])
        ->setPatterns([
            'collectionId' => '[0-9]+',
            'elementId' => '[0-9]+',
        ]);

    $routes->connect('/{collectionId}/elements/{elementId}/delete', [
        'controller' => 'Elements',
        'action' => 'delete',
    ])
        ->setPass(['collectionId', 'elementId'])
        ->setPatterns([
            'collectionId' => '[0-9]+',
            'elementId' => '[0-9]+',
        ]);

    $routes->connect('/:controller/:action/*', []);
});

$routes->connect(
    '/login',
    ['controller' => 'Users', 'action' => 'login'],
    ['_name' => 'login']
);

$routes->connect(
    '/logout',
    ['controller' => 'Users', 'action' => 'logout'],
    ['_name' => 'logout']
);

$routes->connect(
    '/register',
    ['controller' => 'Users', 'action' => 'add'],
    ['_name' => 'register']
);

$routes->connect(
    '/profile/{id}',
    ['controller' => 'Users', 'action' => 'edit']
)
->setPass(['id']);

/*
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * $routes->scope('/api', function (RouteBuilder $builder) {
 *     // No $builder->applyMiddleware() here.
 *     
 *     // Parse specified extensions from URLs
 *     // $builder->setExtensions(['json', 'xml']);
 *     
 *     // Connect API actions here.
 * });
 * ```
 */
