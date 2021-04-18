<?php if ($this->user->hasProjectAccess('ProjectEditController', 'show', $project['id'])): ?>
<div class="page-header">
    <h2><?= t('Advanced card-options for the project') . ' "' .   $project['name'] . '"' ?></h2>
</div>

<form method="post" action="<?= $this->url->href('BoardSettingsController', 'save', array('plugin' => 'AdvancedCardOptions', 'project_id' => $project['id'], 'redirect' => 'show')) ?>" autocomplete="off">
    <?= $this->form->csrf() ?>
    <?= $this->form->hidden('id', $values) ?>

    <fieldset>
        <legend><?= t('Configuration-method') ?></legend>
        <?= $this->form->radios('ACO_board_config_method', array(
                'ACO_board_config_defaults' => t('Use the applications-defaults (configured in > ADMIN / Settings / Advanced card-options)'),
                'ACO_board_config_custom' => t('Use custom values for this project'),
            ),
            $values
        ) ?>
        <p class="form-help"><?= t('All settings listed below will be IGNORED, when using the application-defaults!'); ?></p>
    </fieldset>

    <fieldset>
        <legend><?= t('Buttons to change the due-date') ?></legend>
        <?= t('Number of days to push the due-date:'); ?>
        <p class="form-help"><?= t('Leave blank or set to 0 to disable button') ?></p>

        <?= $this->form->label(t('1st Button'), 'ACO_push_due_days_1') ?>
        <?= $this->form->number('ACO_push_due_days_1', $values, $errors, array('autofocus', 'tabindex="1"')) ?>

        <?= $this->form->label(t('2nd Button'), 'ACO_push_due_days_2') ?>
        <?= $this->form->number('ACO_push_due_days_2', $values, $errors, array('autofocus', 'tabindex="2"')) ?>

        <?= $this->form->label(t('3rd Button'), 'ACO_push_due_days_3') ?>
        <?= $this->form->number('ACO_push_due_days_3', $values, $errors, array('autofocus', 'tabindex="3"')) ?>
    </fieldset>

    <?= $this->modal->submitButtons(array('tabindex' => 4)) ?>

</form>
<?php endif ?>
