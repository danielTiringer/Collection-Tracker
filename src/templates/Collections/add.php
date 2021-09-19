<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Collection $collection
 */

$this->extend('../Common/form');
$this->assign('title', __('Add Collection'));

$this->start('form-creation');
    echo $this->Form->create($collection, ['type' => 'file']);
$this->end();

$this->start('form-fields');
    echo $this->Form->control('name', [
        'class' => 'form-control',
    ]);
    echo $this->Form->control('description', [
        'class' => 'form-control',
    ]);
    echo $this->Form->control('goal', [
        'class' => 'form-control',
    ]);
    echo $this->Form->control('image', [
        'type' => 'file',
        'class' => 'form-control',
    ]);
$this->end();

$this->start('form-end');
    echo $this->Form->button(__('Submit'), [
        'class' => 'btn btn-outline-danger',
    ]);
    echo $this->Form->end();
    echo $this->Html->link(
        __('Back'),
        ['action' => 'index'],
        ['class' => 'btn btn-outline-danger']
    );
$this->end();
