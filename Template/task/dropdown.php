<?php
// Get the configuration for the project / task
$ACO_initialize = $this->helper->AdvancedCardOptionsHelper->Initialize($task['project_id']);
$ACO_push_due_days = $this->helper->AdvancedCardOptionsHelper->getPushDueDays();
$ACO_show_push_duebtn_dropdown = $this->helper->AdvancedCardOptionsHelper->getParameter('ACO_show_push_duebtn_dropdown');

// Figure out if we are supposed to display ANY icons related to pushing the due date
$ACO_show_duedate_icons = array_sum($ACO_push_due_days) ? TRUE : FALSE;

?>

<?php if ($ACO_show_duedate_icons && $ACO_show_push_duebtn_dropdown): ?>
    <?php if ($this->user->hasProjectAccess('TaskModificationController', 'edit', $task['project_id'])): ?>
        <?php if ( ! empty($task['date_due']) && (time() > $task['date_due'] || date('Y-m-d') == date('Y-m-d', $task['date_due']))): ?>

            <?php if ($ACO_push_due_days[1] > 0): ?>
                <?php if ($ACO_push_due_days[1] === '1'):?>
                    <?php $ACO_menu_push_due1 = t('Push due date for 1 day'); ?>
                <?php else: ?>
                    <?php $ACO_menu_push_due1 = t('Push due date for %s days',$ACO_push_due_days[1]); ?>
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
                            'push_days' => $ACO_push_due_days[1],
                        )
                    )
                ?>
                </li>
            <?php endif ?>

            <?php if ($ACO_push_due_days[2] > 0) : ?>
                <?php if ($ACO_push_due_days[2] === '1'):?>
                    <?php $ACO_menu_push_due2 = t('Push due date for 1 day'); ?>
                <?php else: ?>
                    <?php $ACO_menu_push_due2 = t('Push due date for %s days',$ACO_push_due_days[2]); ?>
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
                            'push_days' => $ACO_push_due_days[2],
                        )
                    )
                ?>
                </li>
            <?php endif ?>

            <?php if ($ACO_push_due_days[3] > 0) : ?>
                <?php if ($ACO_push_due_days[3] === '1'):?>
                    <?php $ACO_menu_push_due3 = t('Push due date for 1 day'); ?>
                <?php else: ?>
                    <?php $ACO_menu_push_due3 = t('Push due date for %s days',$ACO_push_due_days[3]); ?>
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
                            'push_days' => $ACO_push_due_days[3],
                        )
                    )
                ?>
                </li>
            <?php endif ?>

        <?php endif ?>
    <?php endif ?>
<?php endif ?>
