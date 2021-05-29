<?= $this->Flash->render() ?>
<div class="users form content">
    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password') ?>
    </fieldset>
    <?= $this->Form->button(__('Login')); ?>
    <?= $this->Form->end() ?>
    <?= $this->Html->link("Register", [
        'action' => 'add',
        'class' => 'button'
    ]) ?>
</div>
