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
                <legend><?= __('Edit Collection') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('description');
                    echo $this->Form->control('goal');
                    echo $this->Form->control('image_file', [
                        'type' => 'file',
                    ]);
                ?>
            </fieldset>
            <div class="flex-space-between">
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
                <?= $this->Html->link(
                    __('Back'),
                    ['action' => 'index'],
                    ['class' => 'button'])
                ?>
            </div>
        </div>
    </div>
</div>
