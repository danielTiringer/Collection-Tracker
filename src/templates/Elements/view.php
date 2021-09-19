<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Element $element
 */
?>
<div class="card">
    <div class="card-body">
        <h3><?= h($element->name) ?></h3>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <?= $this->Html->image(
                    '/img/element-img/' . $element->image,
                    ['class' => 'height-fill width-fill', 'alt' => 'No image uploaded.']
                ) ?>
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
                [
                    'controller' => 'Elements',
                    'action' => 'edit',
                    'collectionId' => $element->collection->id,
                    'elementId' => $element->id,
                ],
                ['class' => 'btn btn-outline-danger']
            ) ?>
            <?= $this->Form->create(
                $element,
                [
                    'type' => 'delete',
                    'url' => [
                        'action' => 'delete',
                        'collectionId' => $element->collection->id,
                        'elementId' => $element->id,
                    ],
                ]
            ) ?>
            <?= $this->Form->button(
                __('Delete Element'),
                ['class' => 'btn btn-outline-danger deletion']
            ) ?>
            <?= $this->Form->end(); ?>
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
</div>
