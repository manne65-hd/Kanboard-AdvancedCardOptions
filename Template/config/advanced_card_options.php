<div class="page-header">
    <h2><?= t('Advanced card-options') ?></h2>
</div>
<form method="post" action="<?= $this->url->href('ConfigController', 'save', array('plugin' => 'AdvancedCardOptions')) ?>" autocomplete="off">

    <?= $this->form->csrf() ?>

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
                            <legend><?= t('Text-Size for the "latest-comment" textbox') ?></legend>
                            <?= $this->form->radios('ACO_comment_scroller_textsize', array(
                                    'small' => t('Small'),
                                    'medium' => t('Medium'),
                                    'normal' => t('Normal'),
                                ),
                                $values
                            ) ?>
                        </fieldset>
                        <?= $this->form->label( t('Max (line-)height for the "latest-comment" textbox'), 'ACO_comment_scroller_maxlines') ?>
                        <?= $this->form->number('ACO_comment_scroller_maxlines', $values, $errors, array('autofocus', 'tabindex="1"')) ?>
                        <p class="form-help"><?= t('Anything less than 3 or more than 5 will be ignored and show latest-comment textbox with a maximum of 4 lines!'); ?></p>
                </fieldset>
            </fieldset>
    </fieldset>

    <fieldset>
        <legend><?= t('Buttons to change the due date (Will only appear if task is due today or overdue!)') ?></legend>
        <?= t('Number of days to push the due date:'); ?>
        <p class="form-help"><?= t('Leave blank or set to 0 to disable button') ?></p>

        <?= $this->form->label(t('1st Button'), 'ACO_push_due_days_1') ?>
        <?= $this->form->number('ACO_push_due_days_1', $values, $errors, array('autofocus', 'tabindex="1"')) ?>

        <?= $this->form->label(t('2nd Button'), 'ACO_push_due_days_2') ?>
        <?= $this->form->number('ACO_push_due_days_2', $values, $errors, array('autofocus', 'tabindex="2"')) ?>

        <?= $this->form->label(t('3rd Button'), 'ACO_push_due_days_3') ?>
        <?= $this->form->number('ACO_push_due_days_3', $values, $errors, array('autofocus', 'tabindex="3"')) ?>

        <?= $this->form->checkbox('ACO_show_push_duebtn_dropdown', t('Also show "push due date"-commands in the card-dropdown-menu'), 1, $values['ACO_show_push_duebtn_dropdown'] == 1) ?>

        <fieldset>
            <legend><?= t('Additional buttons') ?></legend>
            <?= $this->form->checkbox('ACO_remove_due_date', t('Show a button to remove the due date'), 1, $values['ACO_remove_due_date'] == 1) ?>
            <fieldset>
                <legend><?= t('Create due date') ?></legend>
                    <?= $this->form->checkbox('ACO_create_due_date', t('Show buttons to create a due date(Will use the same intervals as configured above)'), 1, $values['ACO_create_due_date'] == 1) ?>
                    <fieldset>
                        <legend><?= t('Time to be used for the new due date(relative to the moment, when setting it.)') ?></legend>
                        <?= $this->form->select('ACO_create_due_time_mode', array(
                                'round-down_15' => t('Round down to last quarter hour'),
                                'round-down_30' => t('Round down to last half hour'),
                                'round-down_60' => t('Round down to last full hour'),
                                'round-up_15' => t('Round up to next quarter hour'),
                                'round-up_30' => t('Round up to next half hour'),
                                'round-up_60' => t('Round up to next full hour'),
                                'fixed' => t('Fixed time of day(configured below)'),
                            ),
                            $values
                        ) ?>
                    </fieldset>
                    <?= $this->form->label( t('Fixed time of day(e.g.: 08:00)'), 'ACO_create_due_time') ?>
                    <?= $this->form->text('ACO_create_due_time', $values, $errors) ?>
            </fieldset>
        </fieldset>
    </fieldset>

    <div class="form-actions">
        <button type="submit" class="btn btn-blue"><?= t('Save') ?></button>
    </div>

</form>
