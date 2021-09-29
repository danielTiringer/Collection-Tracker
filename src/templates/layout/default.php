<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = __('Collection Tracker');
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
    >

    <?= $this->Html->css(['app']) ?>
    <?= $this->Html->script(['sweetalert']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark">
        <?= $this->Html->link(
            $cakeDescription,
            ['controller' => 'Collections', 'action' => 'index'],
            ['class' => 'navbar-brand text-danger mx-2']
        ) ?>
        <div class="nav justify-content-end">
            <?php if (!$this->Identity->isLoggedIn()): ?>
                <?= $this->Html->link(
                    __('Login'),
                    ['controller' => 'Users', 'action' => 'login'],
                    ['class' => 'btn btn-outline-danger mx-2']
                ) ?>
                <?= $this->Html->link(
                    __('Register'),
                    ['controller' => 'Users', 'action' => 'add'],
                    ['class' => 'btn btn-outline-danger mx-2']
                ) ?>
            <?php else: ?>
                <?= $this->Html->link(
                    __('Logout'),
                    ['controller' => 'Users', 'action' => 'logout'],
                    ['class' => 'btn btn-outline-danger mx-2']
                ) ?>
                <?= $this->Html->link(
                    __('Profile ({name})', ['name' => $this->Identity->get('name')]),
                    ['controller' => 'Users', 'action' => 'edit', $this->Identity->get('id')],
                    ['class' => 'btn btn-outline-danger mx-2']
                ) ?>
            <?php endif; ?>
        </div>
    </nav>
    <main class="mt-4">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
    <?= $this->Html->script(['app']) ?>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"
    ></script>
</body>
</html>
