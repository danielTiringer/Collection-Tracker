<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Element $element
 */

$this->extend('../Common/form');
$this->assign('title', __('Add Element'));

$this->start('form-creation');
    echo $this->Form->create($element);
$this->end();

$this->start('form-fields');
    echo $this->Form->control('name', [
        'class' => 'form-control',
    ]);
    echo $this->Form->control('description', [
        'class' => 'form-control',
    ]);
    echo $this->Form->hidden('collection_id', ['value' => $collection->id]);
    echo $this->Form->control('source', [
        'class' => 'form-control',
    ]);
    echo $this->Form->control('image', [
        'type' => 'file',
        'class' => 'form-control',
    ]);
    /* echo $this->Form->control('metadata'); */
$this->end();

$this->start('form-end');
    echo $this->Form->button(__('Submit'), [
        'class' => 'btn btn-outline-danger',
    ]);
    echo $this->Form->end();
    echo $this->Html->link(
        __('Back'),
        [
            'controller' => 'Collections',
            'action' => 'view',
            $collection->id,
        ],
        ['class' => 'btn btn-outline-danger']
    );
$this->end();
