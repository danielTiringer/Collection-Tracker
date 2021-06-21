<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */


$this->extend('../Common/form');
$this->assign('title', __('Register'));

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
        'class' => 'form-control',
    ]);
    echo $this->Form->control('password_confirm', [
        'class' => 'form-control',
        'type' => 'password',
    ]);
$this->end();

$this->start('form-end');
    echo $this->Form->button(__('Submit'), [
        'class' => 'btn btn-outline-danger mx-2',
    ]);
    echo $this->Form->end();
    echo $this->Html->link(
        "Got an account already?",
        'login',
        ['class' => 'btn btn-outline-danger mx-2']
    );
$this->end();
