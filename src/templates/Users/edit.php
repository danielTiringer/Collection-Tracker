<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="column-responsive column-100">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Edit Profile') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('email');
                    echo $this->Form->control('password', [
                        'value' => '',
                    ]);
                    echo $this->Form->control('password_confirm', [
                        'type' => 'password',
                    ]);
                ?>
            </fieldset>

            <div class="flex-space-between">
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
                <?= $this->Form->postLink(
                    __('Delete'),
                    ['action' => 'delete', $user->id],
                    [
                        'confirm' => __('Are you sure you want to delete your account?'),
                        'class' => 'button',
                    ]
                ) ?>
            </div>
        </div>
    </div>
</div>
