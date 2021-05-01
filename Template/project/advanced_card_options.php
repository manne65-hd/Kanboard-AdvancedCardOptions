<?php if ($this->user->hasProjectAccess('ProjectEditController', 'show', $project['id'])): ?>
<div class="page-header">
    <h2><?= t('Advanced card-options for the project') . ' "' .   $project['name'] . '"' ?></h2>
</div>

<form method="post" action="<?= $this->url->href('ProjectSettingsController', 'save', array('plugin' => 'AdvancedCardOptions', 'project_id' => $project['id'], 'redirect' => 'show')) ?>" autocomplete="off">
    <?= $this->form->csrf() ?>
    <?= $this->form->hidden('id', $values) ?>

    <fieldset>
        <legend><?= t('Configuration-method') ?></legend>
        <?= $this->form->radios('ACO_project_config_method', array(
                'ACO_project_config_defaults' => t('Use the applications-defaults (configured in > ADMIN / Settings / Advanced card-options)'),
                'ACO_project_config_custom' => t('Use custom values for this project'),
            ),
            $values
        ) ?>
        <p class="form-help"><?= t('All settings listed below will be IGNORED, when using the application-defaults!'); ?></p>
    </fieldset>

    <fieldset>
        <legend><?= t('Configure card-view ...') ?></legend>
            <fieldset>
                <legend><?= t('Collapsed card-view') ?></legend>
                    <?= $this->form->checkbox('ACO_collapsed_hide_edit', t('Hide EDIT-button'), 1, $values['ACO_collapsed_hide_edit'] == 1) ?>
                    <?= $this->form->checkbox('ACO_collapsed_description', t('Show description as mouseover-tooltip'), 1, $values['ACO_collapsed_description'] == 1) ?>
                    <?= $this->form->checkbox('ACO_collapsed_latest_comment', t('Show latest comment as mouseover-tooltip'), 1, $values['ACO_collapsed_latest_comment'] == 1) ?>
                    <?= $this->form->checkbox('ACO_collapsed_due_date', t('Indicate due today or overdue as mouseover-tooltip'), 1, $values['ACO_collapsed_due_date'] == 1) ?>
            </fieldset>
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

        <fieldset>
            <legend><?= t('Additional places to display the "Push due-date-buttons"') ?></legend>
            <?= $this->form->checkbox('ACO_show_push_duebtn_dropdown', t('Show buttons in the card-dropdown-menu'), 1, $values['ACO_show_push_duebtn_dropdown'] == 1) ?>
            <?= $this->form->checkbox('ACO_show_push_duebtn_taskview', t('Show buttons in task-view'), 1, $values['ACO_show_push_duebtn_taskview'] == 1) ?>
        </fieldset>

        <fieldset>
            <legend><?= t('Additional buttons') ?></legend>
            <?= $this->form->checkbox('ACO_remove_due_date', t('Show a button to remove the due-date'), 1, $values['ACO_remove_due_date'] == 1) ?>
            <?= $this->form->checkbox('ACO_create_due_date', t('Show button(s) to create a due-date(Will use the same intervals as configured above)'), 1, $values['ACO_create_due_date'] == 1) ?>
        </fieldset>
    </fieldset>

    <?= $this->modal->submitButtons(array('tabindex' => 4)) ?>

</form>
<?php endif ?>