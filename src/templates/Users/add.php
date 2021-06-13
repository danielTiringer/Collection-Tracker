<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="form-group d-flex justify-content-center">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Register') ?></legend>
        <?php
            echo $this->Form->control('name', [
                'class' => 'form-control',
            ]);
            echo $this->Form->control('email', [
                'class' => 'form-control',
            ]);
            echo $this->Form->control('password', [
                'class' => 'form-control',
            ]);
            echo $this->Form->control('password_confirm', [
                'class' => 'form-control',
                'type' => 'password',
            ]);
        ?>
    </fieldset>

    <div class="mt-2 d-flex justify-content-between">
        <?= $this->Form->button(__('Submit'), [
            'class' => 'btn btn-outline-danger',
        ]) ?>
        <?= $this->Form->end() ?>
        <?= $this->Html->link(
            "Got an account already?",
            'login',
            ['class' => 'text-danger']
        ) ?>
    </div>
</div>
