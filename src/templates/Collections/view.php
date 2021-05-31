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
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($collection->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Goal') ?></th>
                    <td><?= h($collection->goal) ?></td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td>
                        <?= $this->Html->image(
                            '/img/collection-img/' . $collection->image,
                            ['class' => 'height-400', 'alt' => 'No image uploaded.']
                        ) ?>
                    </td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($collection->description)); ?>
                </blockquote>
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
