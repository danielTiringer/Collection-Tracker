<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Element $element
 */
?>
<div class="row">
    <div class="column-responsive column-100">
        <div class="elements form content">
            <?= $this->Form->create($element) ?>
            <fieldset>
                <legend><?= __('Add Element') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('description');
                    echo $this->Form->hidden('collection_id', ['value' => $collection->id]);
                    echo $this->Form->control('source');
                    /* echo $this->Form->control('metadata'); */
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
