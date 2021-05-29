<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Collection $collection
 */
?>
<div class="row">
    <div class="column-responsive column-100">
        <div class="collections form content">
            <?= $this->Form->create($collection) ?>
            <fieldset>
                <legend><?= __('Add Collection') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('description');
                    echo $this->Form->control('goal');
                ?>
            </fieldset>
            <div class="flex-space-between">
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
                <?= $this->Html->link(
                    __('Back'),
                    ['action' => 'index'],
                    ['class' => 'side-nav-item']
                ) ?>
            </div>
        </div>
    </div>
</div>
