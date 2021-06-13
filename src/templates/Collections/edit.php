<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Collection $collection
 */
?>
<div class="form-group d-flex justify-content-center">
        <?= $this->Form->create($collection, ['type' => 'file']) ?>
        <fieldset>
            <legend><?= __('Edit Collection') ?></legend>
            <?php
                echo $this->Form->control('name', [
                    'class' => 'form-control',
                ]);
                echo $this->Form->control('description', [
                    'class' => 'form-control',
                ]);
                echo $this->Form->control('goal', [
                    'class' => 'form-control',
                ]);
                echo $this->Html->image(
                    '/img/collection-img/' . $collection->image,
                    ['class' => 'height-200 mt-2']
                );
                echo $this->Form->control('image_file', [
                    'type' => 'file',
                    'class' => 'form-control',
                ]);
            ?>
        </fieldset>
        <div class="mt-2 d-flex justify-content-between">
            <?= $this->Form->button(__('Submit'), [
                'class' => 'btn btn-outline-danger',
            ]) ?>
            <?= $this->Form->end() ?>
            <?= $this->Html->link(
                __('Back'),
                ['action' => 'index'],
                ['class' => 'btn btn-outline-danger'])
            ?>
        </div>
</div>
