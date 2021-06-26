<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Element $element
 */
?>
<div class="">
    <h3><?= h($element->name) ?></h3>
    <div class="row">
        <div class="col-md-6 col-sm-12">
        </div>
        <div class="col-md-6 col-sm-12">
            <p><?= __('Name') ?>: <?= h($element->name) ?></p>
            <p><?= __('Goal') ?>: <?= h($element->source) ?></p>
            <p>
                <?= __('Description') ?>:
                <?= $this->Text->autoParagraph(h($element->description)) ?>
            </p>
        </div>
    </div>
    <div class="mt-2 d-flex justify-content-between">
        <?= $this->Html->link(
            __('Edit Element'),
            ['action' => 'edit', $element->id],
            ['class' => 'btn btn-outline-danger']
        ) ?>
        <?= $this->Form->postLink(
            __('Delete Element'),
            [
                'controller' => 'Elements',
                'action' => 'delete',
                $element->id,
            ],
            [
                'confirm' => __('Are you sure you want to delete this element?'),
                'class' => 'btn btn-outline-danger',
            ]
        ) ?>
        <?= $this->Html->link(
            __('Back'),
            [
                'controller' => 'Collections',
                'action' => 'view',
                $element->collection->id,
            ],
            ['class' => 'btn btn-outline-danger']
        ) ?>
    </div>
</div>
