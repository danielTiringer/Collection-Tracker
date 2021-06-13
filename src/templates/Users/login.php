<?= $this->Flash->render() ?>
<div class="form-group d-flex justify-content-center">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Login') ?></legend>
        <?= $this->Form->control('email', [
            'class' => 'form-control',
        ]) ?>
        <?= $this->Form->control('password', [
            'class' => 'form-control',
        ]) ?>
    </fieldset>
    <div class="mt-2">
        <?= $this->Form->button(__('Login'), [
            'class' => 'btn btn-outline-danger',
        ]); ?>
        <?= $this->Form->end() ?>
        <?= $this->Html->link(
            "Don't have an account yet?",
            'register',
            ['class' => 'text-danger']
        ) ?>
    </div>
</div>
