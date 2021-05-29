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
                    ['action' => 'edit', $collection->id]
                ) ?>
                <?= $this->Form->postLink(
                    __('Delete Collection'),
                    ['action' => 'delete', $collection->id],
                    [
                        'confirm' => __('Are you sure you want to delete this collection?'),
                    ]
                ) ?>
                <?= $this->Html->link(
                    __('Back'),
                    ['action' => 'index'],
                    ['class' => 'side-nav-item']
                ) ?>
            </div>
        </div>
    </div>
</div>
