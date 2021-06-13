<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Collection $collection
 */

$this->extend('../Common/form');
$this->assign('title', __('Edit Collection'));

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
    echo $this->Html->image(
        '/img/collection-img/' . $collection->image,
        ['class' => 'height-200 mt-2']
    );
    echo $this->Form->control('image_file', [
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
