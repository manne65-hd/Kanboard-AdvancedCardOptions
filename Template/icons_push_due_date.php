<?php

    // Get the configuration for the current project
    $ACO_board_config_method = $this->task->projectMetadataModel->get($project['id'], 'ACO_board_config_method', 'ACO_board_config_defaults');
    if ( $ACO_board_config_method === 'ACO_board_config_defaults'){
        // load DEFAULT-values as of > ADMIN / Seetings / AdvancedCardOptions
        $ACO_push_due_days_1 = $this->app->configModel->get('ACO_push_due_days_1', 0);
        $ACO_push_due_days_2 = $this->app->configModel->get('ACO_push_due_days_2', 0);
        $ACO_push_due_days_3 = $this->app->configModel->get('ACO_push_due_days_3', 0);
    } else {
        // load the custom settings for the current project
        $ACO_push_due_days_1 = $this->task->projectMetadataModel->get($project['id'], 'ACO_push_due_days_1', 0);
        $ACO_push_due_days_2 = $this->task->projectMetadataModel->get($project['id'], 'ACO_push_due_days_2', 0);
        $ACO_push_due_days_3 = $this->task->projectMetadataModel->get($project['id'], 'ACO_push_due_days_3', 0);
    }

?>
<?php if ($ACO_push_due_days_1 > 0) : ?>
    <?= $this->modal->confirmLink(
        '+' . $ACO_push_due_days_1,
        'AdvancedCardOptionsController',
        'pushDueDate',
        array(
                'plugin' => 'AdvancedCardOptions',
                'task_id' => $task['id'],
                'project_id' => $task['project_id'],
                'push_days' => $ACO_push_due_days_1,
            )
        )
    ?>
<?php endif ?>

<?php if ($ACO_push_due_days_2 > 0) : ?>
    <?= $this->modal->confirmLink(
        '+' . $ACO_push_due_days_2,
        'AdvancedCardOptionsController',
        'pushDueDate',
        array(
                'plugin' => 'AdvancedCardOptions',
                'task_id' => $task['id'],
                'project_id' => $task['project_id'],
                'push_days' => $ACO_push_due_days_2,
            )
        )
    ?>
<?php endif ?>

<?php if ($ACO_push_due_days_3 > 0) : ?>
    <?= $this->modal->confirmLink(
        '+' . $ACO_push_due_days_3,
        'AdvancedCardOptionsController',
        'pushDueDate',
        array(
                'plugin' => 'AdvancedCardOptions',
                'task_id' => $task['id'],
                'project_id' => $task['project_id'],
                'push_days' => $ACO_push_due_days_3,
            )
        )
    ?>
<?php endif ?>
