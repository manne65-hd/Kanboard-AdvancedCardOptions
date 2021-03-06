<div class="page-header">
    <h2><?= t('Set a task\'s due date') ?></h2>
</div>

<div class="confirm">
    <p class="alert alert-info">
        <?= t('Set new due date %s for this task: "%s". Are you sure?', $task['confirm_pushed_date_due'], $task['title']) ?>
    </p>

    <?= $this->modal->confirmButtons(
        'AdvancedCardOptionsController',
        'createDueDate',
        array('plugin' => 'AdvancedCardOptions',
              'task_id' => $task['id'],
              'project_id' => $task['project_id'],
              'push_days' => $_REQUEST['push_days'],
              'confirmation' => 'yes')
    ) ?>
</div>
