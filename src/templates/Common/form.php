<?= $this->Flash->render() ?>
<div class="form-group d-flex justify-content-center">
    <?= $this->fetch('form-creation') ?>
    <fieldset>
        <legend><?= $this->fetch('title') ?></legend>
        <?= $this->fetch('form-fields') ?>
    </fieldset>
    <div class="mt-2 d-flex justify-content-between">
        <?= $this->fetch('form-end') ?>
    </div>
</div>
