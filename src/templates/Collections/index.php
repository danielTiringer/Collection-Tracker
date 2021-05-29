<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Collection[]|\Cake\Collection\CollectionInterface $collections
 */
?>
<div class="collections index content">
    <?= $this->Html->link(__('New Collection'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Collections') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('goal') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($collections as $collection): ?>
                <tr>
                    <td><?= $this->Number->format($collection->id) ?></td>
                    <td><?= h($collection->name) ?></td>
                    <?php if ($collection->goal): ?>
                        <td><?= h($collection->goal) ?></td>
                    <? else: ?>
                        <td><?= __('Not defined') ?></td>
                    <? endif; ?>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $collection->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $collection->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $collection->id],
                            ['confirm' => __('Are you sure you want to delete this collection?')]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
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
</div>
