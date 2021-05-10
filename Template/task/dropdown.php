<?php
// Get the configuration for the project (INJECTED into the $task-ARRAY)
$ACO = $task['ACO'];
// Figure out if we are supposed to display ANY icons related to pushing the due date
$ACO_show_duedate_icons = ($ACO['sum_push_due_days']) ? TRUE : FALSE;

?>

<?php if ($ACO_show_duedate_icons && $ACO['show_push_duebtn_dropdown']): ?>
    <?php if ($this->user->hasProjectAccess('TaskModificationController', 'edit', $task['project_id'])): ?>
        <?php if ( ! empty($task['date_due']) && (time() > $task['date_due'] || date('Y-m-d') == date('Y-m-d', $task['date_due']))): ?>

            <?php if ($ACO['push_due_days_1'] > 0): ?>
                <?php if ($ACO['push_due_days_1'] === '1'):?>
                    <?php $ACO_menu_push_due1 = t('Push due date for 1 day'); ?>
                <?php else: ?>
                    <?php $ACO_menu_push_due1 = t('Push due date for %s days',$ACO['push_due_days_1']); ?>
                <?php endif ?>
                <li>
                <?= $this->modal->confirm(
                    'caret-right',
                    $ACO_menu_push_due1,
                    'AdvancedCardOptionsController',
                    'pushDueDate',
                    array(
                            'plugin' => 'AdvancedCardOptions',
                            'task_id' => $task['id'],
                            'project_id' => $task['project_id'],
                            'push_days' => $ACO['push_due_days_1'],
                        )
                    )
                ?>
                </li>
            <?php endif ?>

            <?php if ($ACO['push_due_days_2'] > 0) : ?>
                <?php if ($ACO['push_due_days_2'] === '1'):?>
                    <?php $ACO_menu_push_due2 = t('Push due date for 1 day'); ?>
                <?php else: ?>
                    <?php $ACO_menu_push_due2 = t('Push due date for %s days',$ACO['push_due_days_2']); ?>
                <?php endif ?>
                <li>
                <?= $this->modal->confirm(
                    'arrow-circle-o-right',
                    $ACO_menu_push_due2,
                    'AdvancedCardOptionsController',
                    'pushDueDate',
                    array(
                            'plugin' => 'AdvancedCardOptions',
                            'task_id' => $task['id'],
                            'project_id' => $task['project_id'],
                            'push_days' => $ACO['push_due_days_2'],
                        )
                    )
                ?>
                </li>
            <?php endif ?>

            <?php if ($ACO['push_due_days_3'] > 0) : ?>
                <?php if ($ACO['push_due_days_3'] === '1'):?>
                    <?php $ACO_menu_push_due3 = t('Push due date for 1 day'); ?>
                <?php else: ?>
                    <?php $ACO_menu_push_due3 = t('Push due date for %s days',$ACO['push_due_days_3']); ?>
                <?php endif ?>
                <li>
                <?= $this->modal->confirm(
                    'arrow-circle-right',
                    $ACO_menu_push_due3,
                    'AdvancedCardOptionsController',
                    'pushDueDate',
                    array(
                            'plugin' => 'AdvancedCardOptions',
                            'task_id' => $task['id'],
                            'project_id' => $task['project_id'],
                            'push_days' => $ACO['push_due_days_3'],
                        )
                    )
                ?>
                </li>
            <?php endif ?>

        <?php endif ?>
    <?php endif ?>
<?php endif ?>
