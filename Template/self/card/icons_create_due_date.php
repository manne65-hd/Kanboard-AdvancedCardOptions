<?php if ($ACO['push_due_days_1'] > 0) : ?>
    <?= $this->modal->confirmLink(
        '+' . $ACO['push_due_days_1'],
        'AdvancedCardOptionsController',
        'createDueDate',
        array(
                'plugin' => 'AdvancedCardOptions',
                'task_id' => $task['id'],
                'project_id' => $task['project_id'],
                'push_days' => $ACO['push_due_days_1'],
            )
        )
    ?>
<?php endif ?>

<?php if ($ACO['push_due_days_2'] > 0) : ?>
    <?= $this->modal->confirmLink(
        '+' . $ACO['push_due_days_2'],
        'AdvancedCardOptionsController',
        'createDueDate',
        array(
                'plugin' => 'AdvancedCardOptions',
                'task_id' => $task['id'],
                'project_id' => $task['project_id'],
                'push_days' => $ACO['push_due_days_2'],
            )
        )
    ?>
<?php endif ?>

<?php if ($ACO['push_due_days_3'] > 0) : ?>
    <?= $this->modal->confirmLink(
        '+' . $ACO['push_due_days_3'],
        'AdvancedCardOptionsController',
        'createDueDate',
        array(
                'plugin' => 'AdvancedCardOptions',
                'task_id' => $task['id'],
                'project_id' => $task['project_id'],
                'push_days' => $ACO['push_due_days_3'],
            )
        )
    ?>
<?php endif ?>
