<?php
// Get the configuration for the project / task
$ACO_initialize = $this->helper->AdvancedCardOptionsHelper->Initialize($project['id']);
$ACO_push_due_days = $this->helper->AdvancedCardOptionsHelper->getPushDueDays();

?>
<?php if ($ACO_push_due_days[1] > 0) : ?>
    <?= $this->modal->confirmLink(
        '+' . $ACO_push_due_days[1],
        'AdvancedCardOptionsController',
        'createDueDate',
        array(
                'plugin' => 'AdvancedCardOptions',
                'task_id' => $task['id'],
                'project_id' => $task['project_id'],
                'push_days' => $ACO_push_due_days[1],
            )
        )
    ?>
<?php endif ?>

<?php if ($ACO_push_due_days[2] > 0) : ?>
    <?= $this->modal->confirmLink(
        '+' . $ACO_push_due_days[2],
        'AdvancedCardOptionsController',
        'createDueDate',
        array(
                'plugin' => 'AdvancedCardOptions',
                'task_id' => $task['id'],
                'project_id' => $task['project_id'],
                'push_days' => $ACO_push_due_days[2],
            )
        )
    ?>
<?php endif ?>

<?php if ($ACO_push_due_days[3] > 0) : ?>
    <?= $this->modal->confirmLink(
        '+' . $ACO_push_due_days[3],
        'AdvancedCardOptionsController',
        'createDueDate',
        array(
                'plugin' => 'AdvancedCardOptions',
                'task_id' => $task['id'],
                'project_id' => $task['project_id'],
                'push_days' => $ACO_push_due_days[3],
            )
        )
    ?>
<?php endif ?>
