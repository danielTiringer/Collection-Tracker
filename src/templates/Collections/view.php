<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Collection $collection
 */
?>
<div class="">
    <h3><?= h($collection->name) ?></h3>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <?= $this->Html->image(
                '/img/collection-img/' . $collection->image,
                ['class' => 'height-400', 'alt' => 'No image uploaded.']
            ) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <p><?= __('Name') ?>: <?= h($collection->name) ?></p>
            <?php if (count($collection->elements) == 0): ?>
                <p><?= __('Goal') ?>: <?= h($collection->goal) ?></p>
            <?php else: ?>
                <p><?= __('Progress') ?>: <?= count($collection->elements) ?> / <?= h($collection->goal) ?></p>
            <?php endif; ?>
            <p>
                <?= __('Description') ?>:
                <?= $this->Text->autoParagraph(h($collection->description)) ?>
            </p>
        </div>
    </div>
    <div class="mt-2 d-flex justify-content-between">
        <?= $this->Html->link(
            __('Add to collection'),
            [
                'controller' => 'Elements',
                'action' => 'add',
                'collectionId' => $collection->id,
            ],
            ['class' => 'btn btn-outline-danger']
        ) ?>
        <?= $this->Html->link(
            __('Edit Collection'),
            ['action' => 'edit', $collection->id],
            ['class' => 'btn btn-outline-danger']
        ) ?>
        <?= $this->Form->postLink(
            __('Delete Collection'),
            ['action' => 'delete', $collection->id],
            [
                'confirm' => __('Are you sure you want to delete this collection?'),
                'class' => 'btn btn-outline-danger',
            ]
        ) ?>
        <?= $this->Html->link(
            __('Back'),
            ['action' => 'index'],
            ['class' => 'btn btn-outline-danger']
        ) ?>
    </div>
</div>

<div class="row justify-content-around">
    <?php foreach($collection->elements as $element): ?>
        <div class="card mt-2 col-md-5 col-sm-10">
            <div class="card-body">
                <a
                    href="<?= $this->Url->buildFromPath('Elements::view', [
                        'elementId' => $element->id,
                        'collectionId' => $collection->id,
                    ]) ?>"
                    class="stretched-link"
                ></a>
                <p class="card-text"><strong>Name: </strong><?= $element->name ?></p>
                <p class="card-text"><strong>Description: </strong><?= $element->description ?></p>
                <p class="card-text"><strong>Source: </strong><?= $element->source ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
