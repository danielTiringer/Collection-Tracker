<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Collection[]|\Cake\Collection\CollectionInterface $collections
 */
?>
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h3><?= __('Collections') ?></h3>
            <?= $this->Html->link(
                __('New Collection'),
                ['action' => 'add'],
                ['class' => 'btn btn-outline-danger']
            ) ?>
        </div>
        <div class="table-responsive">
            <table class="table mt-2 table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th class="col-6"><?= __('Name') ?></th>
                        <th class="col-3"><?= __('Goal') ?></th>
                        <th class="col-3"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($collections as $collection): ?>
                    <tr>
                        <td class="col-6">
                            <?php if ($collection->image): ?>
                                <?= $this->Html->image(
                                    '/img/collection-img/' . $collection->image,
                                    ['class' => 'height-40', 'alt' => '']
                                ) ?>
                            <?php else: ?>
                                <i class="bi bi-image"></i>
                            <?php endif; ?>
                            <?= $this->Html->link(
                                $collection->name,
                                ['action' => 'view', $collection->id],
                                ['class' => 'text-danger']
                            ) ?>
                        </td class="col-3">
                        <?php if ($collection->goal): ?>
                            <td><?= h($collection->goal) ?></td>
                        <?php else: ?>
                            <td><?= __('Not defined') ?></td>
                        <?php endif; ?>
                        <td class="col-3">
                            <div class="d-flex justify-content-between">
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
                            <?= $this->Form->create(
                                $collection,
                                [
                                    'type' => 'delete',
                                    'url' => ['action' => 'delete', $collection->id],
                                ]
                            ) ?>
                            <?= $this->Form->button(
                                __('Delete'),
                                ['class' => 'btn btn-outline-danger deletion']
                            ) ?>
                            <?= $this->Form->end(); ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
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
