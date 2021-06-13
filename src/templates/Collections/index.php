<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Collection[]|\Cake\Collection\CollectionInterface $collections
 */
?>
<div class="d-flex justify-content-between">
    <h3><?= __('Collections') ?></h3>
    <?= $this->Html->link(
        __('New Collection'),
        ['action' => 'add'],
        ['class' => 'btn btn-outline-danger']
    ) ?>
</div>
<table class="table mt-2">
    <thead class="thead-dark">
        <tr>
            <th><?= __('Name') ?></th>
            <th><?= __('Goal') ?></th>
            <th><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($collections as $collection): ?>
        <tr>
            <td>
                <?= $this->Html->image(
                    '/img/collection-img/' . $collection->image,
                    ['class' => 'height-40', 'alt' => 'No image uploaded.']
                ) ?>
                <?= $this->Html->link(
                    $collection->name,
                    ['action' => 'view', $collection->id],
                    ['class' => 'text-danger']
                ) ?>
            </td>
            <?php if ($collection->goal): ?>
                <td><?= h($collection->goal) ?></td>
            <? else: ?>
                <td><?= __('Not defined') ?></td>
            <? endif; ?>
            <td>
                <?= $this->Html->link(
                    __('View'),
                    ['action' => 'view', $collection->id],
                    ['class' => 'btn btn-outline-danger']
                ) ?>
                <?= $this->Html->link(
                    __('Edit'),
                    ['action' => 'edit', $collection->id],
                    ['class' => 'btn btn-outline-danger']
                ) ?>
                <?= $this->Form->postLink(
                    __('Delete'),
                    ['action' => 'delete', $collection->id],
                    [
                        'confirm' => __('Are you sure you want to delete this collection?'),
                        'class' => 'btn btn-outline-danger',
                    ]
                ) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php if (count($collections) > 10): ?>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
<?php endif; ?>
