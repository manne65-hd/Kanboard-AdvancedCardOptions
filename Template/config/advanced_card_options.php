<div class="page-header">
    <h2><?= t('Advanced card-options') ?></h2>
</div>
<form method="post" action="<?= $this->url->href('ConfigController', 'save', array('plugin' => 'AdvancedCardOptions')) ?>" autocomplete="off">

    <?= $this->form->csrf() ?>

    <fieldset>
        <legend><?= t('Due-date settings') ?></legend>
        <?= t('Number of days to push the due-date:'); ?>
        <p class="form-help"><?= t('Leave blank or set to 0 to disable selected buttons') ?></p>

        <?= $this->form->label(t('1st Button:'), 'ACO_push_due_days_1') ?>
        <?= $this->form->number('ACO_push_due_days_1', $values, $errors, array('autofocus', 'tabindex="1"')) ?>

        <?= $this->form->label(t('2nd Button:'), 'ACO_push_due_days_2') ?>
        <?= $this->form->number('ACO_push_due_days_2', $values, $errors, array('autofocus', 'tabindex="2"')) ?>

        <?= $this->form->label(t('3rd Button:'), 'ACO_push_due_days_3') ?>
        <?= $this->form->number('ACO_push_due_days_3', $values, $errors, array('autofocus', 'tabindex="3"')) ?>
    </fieldset>

    <div class="form-actions">
        <button type="submit" class="btn btn-blue"><?= t('Save') ?></button>
    </div>

</form>
