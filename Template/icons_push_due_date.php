<?php
// Get the configuration for the project / task
$ACO_board_config_method = $this->helper->AdvancedCardOptionsHelper->getBoardConfigMethod($project['id']);
if ( $ACO_board_config_method === 'ACO_board_config_defaults'){
    // load DEFAULT-values as of > ADMIN / Seetings / AdvancedCardOptions
    $ACO_push_due_days = $this->helper->AdvancedCardOptionsHelper->getAppPushDueDays();
} else {
    // load the custom settings for the current project
    $ACO_push_due_days = $this->helper->AdvancedCardOptionsHelper->getProjectPushDueDays($project['id']);
}

?>
<?php if ($ACO_push_due_days[1] > 0) : ?>
    <?= $this->modal->confirmLink(
        '+' . $ACO_push_due_days[1],
        'AdvancedCardOptionsController',
        'pushDueDate',
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
        'pushDueDate',
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
        'pushDueDate',
        array(
                'plugin' => 'AdvancedCardOptions',
                'task_id' => $task['id'],
                'project_id' => $task['project_id'],
                'push_days' => $ACO_push_due_days[3],
            )
        )
    ?>
<?php endif ?>
