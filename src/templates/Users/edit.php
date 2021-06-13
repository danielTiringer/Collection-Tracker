<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="form-group d-flex justify-content-center">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit Profile') ?></legend>
        <?php
            echo $this->Form->control('name', [
                'class' => 'form-control',
            ]);
            echo $this->Form->control('email', [
                'class' => 'form-control',
            ]);
            echo $this->Form->control('password', [
                'value' => '',
                'class' => 'form-control',
            ]);
            echo $this->Form->control('password_confirm', [
                'type' => 'password',
                'class' => 'form-control',
            ]);
        ?>
    </fieldset>

    <div class="mt-2 d-flex justify-content-between">
        <?= $this->Form->button(__('Submit'), [
            'class' => 'btn btn-outline-danger',
        ]) ?>
        <?= $this->Form->end() ?>
        <?= $this->Form->postLink(
            __('Delete'),
            ['action' => 'delete', $user->id],
            [
                'confirm' => __('Are you sure you want to delete your account?'),
                'class' => 'btn btn-outline-danger',
            ]
        ) ?>
    </div>
</div>
