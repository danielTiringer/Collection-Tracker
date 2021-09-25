<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?= $this->Flash->render() ?>
<div class="card">
    <div class="form-group d-flex justify-content-center card-body">
        <?= $this->Form->create($user, ['type' => 'patch']) ?>
        <fieldset>
            <legend><?= __('Edit Profile') ?></legend>
            <?= $this->Form->control('name', [
                'class' => 'form-control',
            ]) ?>
            <?= $this->Form->control('email', [
                'class' => 'form-control',
            ]) ?>
        </fieldset>
        <div class="container">
            <div class="mt-2 row justify-content-center">
                <?= $this->Form->button(__('Update Profile'), [
                    'class' => 'btn btn-outline-danger',
                ]) ?>
                <?= $this->Form->end() ?>
            </div>
            <div class="mt-2 row justify-content-center">
                <?= $this->Form->create($user, [
                    'type' => 'delete',
                    'url' => ['action' => 'delete', $user->id],
                ]) ?>
                <?= $this->Form->button(
                    __('Delete Profile'),
                    ['class' => 'btn btn-outline-danger deletion mx-2']
                ) ?>
                <?= $this->Form->end() ?>
            </div>
            <div class="mt-2 row justify-content-center">
                <?= $this->element('change_password', [
                    'user' => $user,
                ]) ?>
            </div>
            <div class="mt-2 row justify-content-center">
                <?= $this->Html->link(
                    __('Back'),
                    ['controller' => 'collections', 'action' => 'index'],
                    ['class' => 'btn btn-outline-danger mx-2']
                ) ?>
            </div>
        </div>
    </div>
</div>

<?php
?>
