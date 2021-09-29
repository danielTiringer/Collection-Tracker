<?php
/**
 * @var \App\Model\Entity\User $user
 */
?>
<!-- Button trigger modal -->
<?= $this->Html->link(
    __('Change Password'),
    ['controller' => 'collections', 'action' => 'index'],
    [
        'class' => 'btn btn-outline-danger mx-2',
        'data-bs-toggle' => 'modal',
        'data-bs-target' => '#changePasswordModal',
    ]
) ?>

<!-- Modal -->
<div
    class="modal fade"
    id="changePasswordModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="changePasswordModalCenterTitle"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalCenterTitle">
                    <?= __('Change Password') ?>
                </h5>
            </div>
            <div class="modal-body form-group">
                <?= $this->Form->create($user, [
                    'type' => 'patch',
                    'url' => ['action' => 'updatePassword', $user->id],
                ]) ?>
                <?= $this->Form->control('current_password', [
                    'type' => 'password',
                    'value' => '',
                    'class' => 'form-control',
                ]) ?>
                <?= $this->Form->control('password', [
                    'value' => '',
                    'label' => __('New Password'),
                    'class' => 'form-control',
                ]) ?>
                <?= $this->Form->control('password_confirm', [
                    'type' => 'password',
                    'label' => __('Confirm New Password'),
                    'class' => 'form-control',
                ]) ?>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                    <?= __('Cancel') ?>
                </button>
                <?= $this->Form->button(__('Update Password'), [
                    'class' => 'btn btn-outline-danger',
                ]) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
