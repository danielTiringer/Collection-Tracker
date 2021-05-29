<?= $this->Flash->render() ?>
<div class="users form content">
    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password') ?>
    </fieldset>
    <div class="flex-space-between">
        <?= $this->Form->button(__('Login')); ?>
        <?= $this->Form->end() ?>
        <?= $this->Html->link("Don't have an account yet?", [
            'action' => 'add',
            'class' => 'button'
        ]) ?>
    </div>
</div>
