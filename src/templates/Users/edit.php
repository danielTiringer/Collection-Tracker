<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->extend('../Common/form');
$this->assign('title', __('Edit Profile'));

$this->start('form-creation');
    echo $this->Form->create($user);
$this->end();

$this->start('form-fields');
    echo $this->Form->control('name', [
        'class' => 'form-control',
    ]);
    echo $this->Form->control('email', [
        'class' => 'form-control',
    ]);
    echo $this->Form->control('password', [
        'value' => '',
        'class' => 'form-control',
    ]);
    echo $this->Form->control('password_confirm', [
        'type' => 'password',
        'class' => 'form-control',
    ]);
$this->end();

$this->start('form-end');
    echo $this->Form->button(__('Submit'), [
        'class' => 'btn btn-outline-danger mx-2',
    ]);
    echo $this->Form->end();

    echo $this->Form->create(
        $user,
        [
            'type' => 'delete',
            'url' => ['action' => 'delete', $user->id],
        ]
    );
    echo $this->Form->button(
        __('Delete'),
        ['class' => 'btn btn-outline-danger deletion']
    );
    echo $this->Form->end();
    echo $this->Html->link(
        __('Back'),
        ['controller' => 'collections', 'action' => 'index'],
        ['class' => 'btn btn-outline-danger mx-2']
    );
$this->end();
