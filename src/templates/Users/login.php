<?php
/**
 * @var \App\View\AppView $this
 */

$this->extend('../Common/form');
$this->assign('title', __('Login'));

$this->start('form-creation');
    echo $this->Form->create();
$this->end();

$this->start('form-fields');
    echo $this->Form->control('email', [
        'class' => 'form-control',
    ]);
    echo $this->Form->control('password', [
        'class' => 'form-control',
    ]);
$this->end();

$this->start('form-end');
    echo $this->Form->button(__('Login'), [
        'class' => 'btn btn-outline-danger mx-2',
    ]);
    echo $this->Form->end();
    echo $this->Html->link(
        "Don't have an account yet?",
        'register',
        ['class' => 'btn btn-outline-danger mx-2']
    );
$this->end();
