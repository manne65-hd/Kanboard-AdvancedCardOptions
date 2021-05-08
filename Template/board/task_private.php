<?php
/*
 * TEMPLATE-OverRide  task_private.php FORKED from Kanboard 1.2.18 --> MONITOR for changes in future releases !!
 */
// Get the configuration for the project / task
$ACO_initialize = $this->helper->AdvancedCardOptionsHelper->Initialize($project['id']);
$ACO_push_due_days              = $this->helper->AdvancedCardOptionsHelper->getPushDueDays();
$ACO_remove_due_date            = $this->helper->AdvancedCardOptionsHelper->getParameter('ACO_remove_due_date');
$ACO_collapsed_hide_edit        = $this->helper->AdvancedCardOptionsHelper->getParameter('ACO_collapsed_hide_edit');
$ACO_collapsed_description      = $this->helper->AdvancedCardOptionsHelper->getParameter('ACO_collapsed_description');
$ACO_collapsed_latest_comment   = $this->helper->AdvancedCardOptionsHelper->getParameter('ACO_collapsed_latest_comment');
$ACO_collapsed_due_date         = $this->helper->AdvancedCardOptionsHelper->getParameter('ACO_collapsed_due_date');
$ACO_collapsed_tags             = $this->helper->AdvancedCardOptionsHelper->getParameter('ACO_collapsed_tags');
$ACO_collapsed_category         = $this->helper->AdvancedCardOptionsHelper->getParameter('ACO_collapsed_category');

?>
<div class="
        task-board
        <?= $task['is_draggable'] ? 'draggable-item ' : '' ?>
        <?= $task['is_active'] == 1 ? 'task-board-status-open '.($task['date_modification'] > (time() - $board_highlight_period) ? 'task-board-recent' : '') : 'task-board-status-closed' ?>
        color-<?= $task['color_id'] ?>"
     data-task-id="<?= $task['id'] ?>"
     data-column-id="<?= $task['column_id'] ?>"
     data-swimlane-id="<?= $task['swimlane_id'] ?>"
     data-position="<?= $task['position'] ?>"
     data-owner-id="<?= $task['owner_id'] ?>"
     data-category-id="<?= $task['category_id'] ?>"
     data-due-date="<?= $task['date_due'] ?>"
     data-task-url="<?= $this->url->href('TaskViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>">

    <div class="task-board-sort-handle" style="display: none;"><i class="fa fa-arrows-alt"></i></div>

    <?php if ($this->board->isCollapsed($task['project_id'])): ?>
        <div class="task-board-collapsed">
            <div class="task-board-saving-icon" style="display: none;"><i class="fa fa-spinner fa-pulse"></i></div>
            <?php if ($this->user->hasProjectAccess('TaskModificationController', 'edit', $task['project_id'])): ?>
                <?= $this->render('task/dropdown', array('task' => $task, 'redirect' => 'board')) ?>
                <?php if ($this->projectRole->canUpdateTask($task) && ! $ACO_collapsed_hide_edit): ?>
                    <?= $this->modal->large('edit', '', 'TaskModificationController', 'edit', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>
                <?php endif ?>
            <?php else: ?>
                <strong><?= '#'.$task['id'] ?></strong>
            <?php endif ?>

            <?php if ($ACO_collapsed_description): ?>
                <?php if (! empty($task['description'])): ?>
                    <?= $this->app->tooltipLink('<i class="fa fa-file-text-o"></i>', $this->url->href('BoardTooltipController', 'description', array('task_id' => $task['id'], 'project_id' => $task['project_id']))) ?>
                <?php elseif (empty($task['description'])): ?>
                    <span class="aco_dimmed"><i class="fa fa-file-o"></i></span>
                <?php endif ?>
            <?php endif ?>

            <?php if ($ACO_collapsed_latest_comment  && $task['nb_comments'] > 0): ?>
                <?php
                    $ACO_latest_comment = $this->helper->AdvancedCardOptionsHelper->commentGetLatest($task['id']);
                    $ACO_latest_comment_tooltip = '####' . t('%s on %s',$ACO_latest_comment['name'], $this->dt->datetime($ACO_latest_comment['date_modification'])) . PHP_EOL;
                    $ACO_latest_comment_tooltip .= '--------------------' . PHP_EOL;
                    $ACO_latest_comment_tooltip .= $ACO_latest_comment['comment'];
                ?>
                    <i class="fa fa-commenting" title="<?= $ACO_latest_comment_tooltip ?>" aria-label="<?= $ACO_latest_comment_tooltip ?>"></i>
            <?php elseif ($ACO_collapsed_latest_comment  && $task['nb_comments'] === '0'): ?>
                    <span class="aco_dimmed"><i class="fa fa-comment"></i></span>
            <?php endif ?>

            <?php if ($ACO_collapsed_due_date && ! empty($task['date_due'])): ?>
                <?php $aco_overdue = t('Due Date was') . ': ' . $this->dt->datetime($task['date_due']) ?>
                <?php $aco_duetoday = t('Due today at') . ': ' . $this->dt->time($task['date_due']) ?>

                <div class="aco_icon_right">
                <?php if (time() > $task['date_due']): ?>
                    <span class="task-date task-date-overdue" title="<?= $aco_overdue ?>" role="img" aria-label="<?= $aco_overdue ?>">
                        <i class="fa fa-calendar"></i>
                    </span>
                <?php elseif (date('Y-m-d') == date('Y-m-d', $task['date_due'])): ?>
                    <span class="task-date task-date-today" title="<?= $aco_duetoday ?>" role="img" aria-label="<?= $aco_duetoday ?>">
                        <i class="fa fa-calendar"></i>
                    </span>
                <?php endif ?>
                </div>
            <?php endif ?>

            <?php if (! empty($task['assignee_username'])): ?>
                <span title="<?= $this->text->e($task['assignee_name'] ?: $task['assignee_username']) ?>">
                    <?= $this->text->e($this->user->getInitials($task['assignee_name'] ?: $task['assignee_username'])) ?>
                </span> -
            <?php endif ?>
            <?= $this->url->link($this->text->e($task['title']), 'TaskViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id']), false, '', $this->text->e($task['title'])) ?>
        </div>

        <?php if ($ACO_collapsed_tags && ! empty($task['tags']) || ($ACO_collapsed_category && ! empty($task['category_id']))): ?>
            <div class="aco_collapsed_tags_category">
                <div class="task-tags">
                    <ul>
        <?php endif ?>
            <?php if ($ACO_collapsed_category && ! empty($task['category_id'])): ?>
                <li class="aco_category_pill task-tag <?= $task['category_color_id'] ? "color-{$task['category_color_id']}" : '' ?>">
                    <i class="fa fa-folder-open" role="img" title="<?= t('Category ... ') ?>" aria-label="<?= t('Category ... ') ?>"></i>
                    <?php if ($not_editable): ?>
                        <?= $this->text->e($task['category_name']) ?>
                    <?php else: ?>
                        <?= $this->url->link(
                            $this->text->e($task['category_name']),
                            'TaskModificationController',
                            'edit',
                            array('task_id' => $task['id'], 'project_id' => $task['project_id']),
                            false,
                            'js-modal-large' . (! empty($task['category_description']) ? ' tooltip' : ''),
                            t('Change category')
                        ) ?>
                    <?php endif ?>
                    <?php if (! empty($task['category_description'])): ?>
                        <?= $this->app->tooltipMarkdown($task['category_description']) ?>
                    <?php endif ?>
                </li>
            <?php endif ?>

            <?php if ($ACO_collapsed_tags && ! empty($task['tags'])): ?>
                    <?php foreach ($task['tags'] as $tag): ?>
                        <li class="task-tag <?= $tag['color_id'] ? "color-{$tag['color_id']}" : '' ?>"><?= $this->text->e($tag['name']) ?></li>
                    <?php endforeach ?>
            <?php endif ?>

        <?php if ($ACO_collapsed_tags && ! empty($task['tags']) || ($ACO_collapsed_category && ! empty($task['category_id']))): ?>
                    </ul>
                </div>
            </div>
        <?php endif ?>
    <?php else: ?>
        <div class="task-board-expanded">
            <div class="task-board-saving-icon" style="display: none;"><i class="fa fa-spinner fa-pulse fa-2x"></i></div>
            <div class="task-board-header">
                <?php if ($this->user->hasProjectAccess('TaskModificationController', 'edit', $task['project_id'])): ?>
                    <?= $this->render('task/dropdown', array('task' => $task, 'redirect' => 'board')) ?>
                    <?php if ($this->projectRole->canUpdateTask($task)): ?>
                        <?= $this->modal->large('edit', '', 'TaskModificationController', 'edit', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>
                    <?php endif ?>
                <?php else: ?>
                    <strong><?= '#'.$task['id'] ?></strong>
                <?php endif ?>

                <?php if (! empty($task['owner_id'])): ?>
                    <span class="task-board-assignee">
                        <?= $this->text->e($task['assignee_name'] ?: $task['assignee_username']) ?>
                    </span>
                <?php endif ?>

                <?= $this->render('board/task_avatar', array('task' => $task)) ?>
            </div>

            <?= $this->hook->render('template:board:private:task:before-title', array('task' => $task)) ?>
            <div class="task-board-title">
                <?= $this->url->link($this->text->e($task['title']), 'TaskViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>
            </div>
            <?= $this->hook->render('template:board:private:task:after-title', array('task' => $task)) ?>

            <?= $this->render('board/task_footer', array(
                'task' => $task,
                'not_editable' => $not_editable,
                'project' => $project,
            )) ?>
        </div>
    <?php endif ?>
</div>
