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
                    <p class="form-help"><?= t('If showing tags and/or category is enabled, collapsed view will "grow" to have 2 lines!'); ?></p>
            </fieldset>
    </fieldset>

    <fieldset>
        <legend><?= t('Buttons to change the due-date (Will only appear if task is due today or overdue!)') ?></legend>
        <?= t('Number of days to push the due-date:'); ?>
        <p class="form-help"><?= t('Leave blank or set to 0 to disable button') ?></p>

        <?= $this->form->label(t('1st Button'), 'ACO_push_due_days_1') ?>
        <?= $this->form->number('ACO_push_due_days_1', $values, $errors, array('autofocus', 'tabindex="1"')) ?>

        <?= $this->form->label(t('2nd Button'), 'ACO_push_due_days_2') ?>
        <?= $this->form->number('ACO_push_due_days_2', $values, $errors, array('autofocus', 'tabindex="2"')) ?>

        <?= $this->form->label(t('3rd Button'), 'ACO_push_due_days_3') ?>
        <?= $this->form->number('ACO_push_due_days_3', $values, $errors, array('autofocus', 'tabindex="3"')) ?>

        <?= $this->form->checkbox('ACO_show_push_duebtn_dropdown', t('Show "push due-date"-buttons in the card-dropdown-menu'), 1, $values['ACO_show_push_duebtn_dropdown'] == 1) ?>

        <fieldset>
            <legend><?= t('Additional buttons') ?></legend>
            <?= $this->form->checkbox('ACO_remove_due_date', t('Show a button to remove the due-date'), 1, $values['ACO_remove_due_date'] == 1) ?>
            <?= $this->form->checkbox('ACO_create_due_date', t('Show buttons to create a due-date(Will use the same intervals as configured above)'), 1, $values['ACO_create_due_date'] == 1) ?>
        </fieldset>
    </fieldset>

    <div class="form-actions">
        <button type="submit" class="btn btn-blue"><?= t('Save') ?></button>
    </div>

</form>
