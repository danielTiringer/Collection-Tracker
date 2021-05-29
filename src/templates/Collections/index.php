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
                    <th><?= $this->Paginator->sort('users_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($collections as $collection): ?>
                <tr>
                    <td><?= $this->Number->format($collection->id) ?></td>
                    <td><?= h($collection->name) ?></td>
                    <td><?= $collection->has('user') ? $this->Html->link($collection->user->name, ['controller' => 'Users', 'action' => 'view', $collection->user->id]) : '' ?></td>
                    <td><?= h($collection->created) ?></td>
                    <td><?= h($collection->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $collection->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $collection->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $collection->id], ['confirm' => __('Are you sure you want to delete # {0}?', $collection->id)]) ?>
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
