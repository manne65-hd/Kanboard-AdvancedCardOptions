<?php
// Get the configuration for the project / task
$ACO_initialize = $this->helper->AdvancedCardOptionsHelper->Initialize($task['project_id']);
$ACO_push_due_days = $this->helper->AdvancedCardOptionsHelper->getPushDueDays();

// Figure out if we are supposed to display ANY icons related to pushing the due date
$ACO_show_duedate_icons = array_sum($ACO_push_due_days) ? TRUE : FALSE;

?>

<?php if ($this->user->hasProjectAccess('TaskModificationController', 'edit', $task['project_id'])): ?>
    <?php if (time() > $task['date_due'] || date('Y-m-d') == date('Y-m-d', $task['date_due'])): ?>
        <?php if ($ACO_show_duedate_icons): ?>

            <?php if ($ACO_push_due_days[1] > 0) : ?>
                <li>
                <?= $this->modal->confirm(
                    'caret-right',
                    'Push interval 1',
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
                </li>
            <?php endif ?>

            <?php if ($ACO_push_due_days[2] > 0) : ?>
                <li>
                <?= $this->modal->confirm(
                    'arrow-circle-o-right',
                    'Push interval 2',
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
                </li>
            <?php endif ?>

            <?php if ($ACO_push_due_days[3] > 0) : ?>
                <li>
                <?= $this->modal->confirm(
                    'arrow-circle-right',
                    'Push interval 3',
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
                </li>
            <?php endif ?>

        <?php endif ?>
    <?php endif ?>
<?php endif ?>
