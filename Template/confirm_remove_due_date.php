<div class="page-header">
    <h2><?= t('Remove the task\'s due-date') ?></h2>
</div>

<div class="confirm">
    <p class="alert alert-info">
        <?= t('Do you really want to remove the due date of the task "%s" ?', $task['title']) ?>
    </p>

    <?= $this->modal->confirmButtons(
        'AdvancedCardOptionsController',
        'removeDueDate',
        array('plugin' => 'AdvancedCardOptions',
              'task_id' => $task['id'],
              'project_id' => $task['project_id'],
              'confirmation' => 'yes')
    ) ?>
</div>
