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
                    <?= $this->form->checkbox('ACO_collapsed_tags', t('Show tags'), 1, $values['ACO_collapsed_tags'] == 1) ?>
                    <?= $this->form->checkbox('ACO_collapsed_category', t('Show category'), 1, $values['ACO_collapsed_category'] == 1) ?>
                    <p class="form-help"><?= t('If showing tags and/or category is enabled, collapsed view will "grow" to have at least 2 lines!'); ?></p>
            </fieldset>
            <fieldset>
                <legend><?= t('Expanded card-view') ?></legend>
                <fieldset>
                    <legend><?= t('Latest comment') ?></legend>
                        <?= $this->form->checkbox('ACO_expanded_latest_comment', t('Show latest comment'), 1, $values['ACO_expanded_latest_comment'] == 1) ?>
                        <fieldset>
                            <legend><?= t('Text-Size for latest-comment textbox') ?></legend>
                            <?= $this->form->radios('ACO_comment_scroller_textsize', array(
                                    'small' => t('Small'),
                                    'medium' => t('Medium'),
                                    'normal' => t('Normal'),
                                ),
                                $values
                            ) ?>
                        </fieldset>
                        <?= $this->form->label( t('Max (line-)height for latest-comment textbox'), 'ACO_comment_scroller_maxlines') ?>
                        <?= $this->form->number('ACO_comment_scroller_maxlines', $values, $errors, array('autofocus', 'tabindex="1"')) ?>
                        <p class="form-help"><?= t('Anything less than 3 or more than 5 will be ignored and show latest-comment textbox with a maximum of 4 lines!'); ?></p>
                </fieldset>
            </fieldset>
    </fieldset>

    <fieldset>
        <legend><?= t('Buttons to change the due date (Will only appear if task is due today or overdue!)') ?></legend>
        <?= t('Number of days to push the due date:'); ?>
        <p class="form-help"><?= t('Leave blank or set to 0 to disable button') ?></p>

        <?= $this->form->label( t('1st Button'), 'ACO_push_due_days_1') ?>
        <?= $this->form->number('ACO_push_due_days_1', $values, $errors, array('autofocus', 'tabindex="1"')) ?>

        <?= $this->form->label( t('2nd Button'), 'ACO_push_due_days_2') ?>
        <?= $this->form->number('ACO_push_due_days_2', $values, $errors, array('autofocus', 'tabindex="2"')) ?>

        <?= $this->form->label( t('3rd Button'), 'ACO_push_due_days_3') ?>
        <?= $this->form->number('ACO_push_due_days_3', $values, $errors, array('autofocus', 'tabindex="3"')) ?>

        <?= $this->form->checkbox('ACO_show_push_duebtn_dropdown', t('Also show "push due date"-commands in the card-dropdown-menu'), 1, $values['ACO_show_push_duebtn_dropdown'] == 1) ?>

        <fieldset>
            <legend><?= t('Additional buttons') ?></legend>
            <?= $this->form->checkbox('ACO_remove_due_date', t('Show a button to remove the due date'), 1, $values['ACO_remove_due_date'] == 1) ?>
            <?= $this->form->checkbox('ACO_create_due_date', t('Show buttons to create a due date(Will use the same intervals as configured above)'), 1, $values['ACO_create_due_date'] == 1) ?>
        </fieldset>
    </fieldset>

    <?= $this->modal->submitButtons(array('tabindex' => 4)) ?>

</form>
<?php endif ?>
