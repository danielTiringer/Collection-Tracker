<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Collection $collection
 */
?>
<div class="row">
    <div class="column-responsive column-100">
        <div class="collections view content">
            <h3><?= h($collection->name) ?></h3>
            <div class="row">
                <div class="column-responsive column-50">
                    <?= $this->Html->image(
                        '/img/collection-img/' . $collection->image,
                        ['class' => 'height-400', 'alt' => 'No image uploaded.']
                    ) ?>
                </div>
                <div class="column-responsive column-50">
                    <p><?= __('Name') ?>: <?= h($collection->name) ?></p>
                    <p><?= __('Goal') ?>: <?= h($collection->goal) ?></p>
                    <p><?= __('Description') ?>: <?= $this->Text->autoParagraph(h($collection->description)); ?></p>
                </div>
            </div>
            <div class="flex-space-between">
                <?= $this->Html->link(
                    __('Edit Collection'),
                    ['action' => 'edit', $collection->id],
                    ['class' => 'button']
                ) ?>
                <?= $this->Form->postLink(
                    __('Delete Collection'),
                    ['action' => 'delete', $collection->id],
                    [
                        'confirm' => __('Are you sure you want to delete this collection?'),
                        'class' => 'button',
                    ]
                ) ?>
                <?= $this->Html->link(
                    __('Back'),
                    ['action' => 'index'],
                    ['class' => 'button']
                ) ?>
            </div>
        </div>
    </div>
</div>
