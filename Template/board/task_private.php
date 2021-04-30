<?php
// Get the configuration for the project / task
$ACO_initialize = $this->helper->AdvancedCardOptionsHelper->Initialize($project['id']);
$ACO_push_due_days              = $this->helper->AdvancedCardOptionsHelper->getPushDueDays();
$ACO_remove_due_date            = $this->helper->AdvancedCardOptionsHelper->getParameter('ACO_remove_due_date');
$ACO_collapsed_description      = $this->helper->AdvancedCardOptionsHelper->getParameter('ACO_collapsed_description');
$ACO_collapsed_latest_comment   = $this->helper->AdvancedCardOptionsHelper->getParameter('ACO_collapsed_latest_comment');
$ACO_collapsed_due_date         = $this->helper->AdvancedCardOptionsHelper->getParameter('ACO_collapsed_due_date');

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
                <?php if ($this->projectRole->canUpdateTask($task)): ?>
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

            <?php if ($ACO_collapsed_latest_comment): ?>
                <?php if ($task['nb_comments'] > 0): ?>
                    <?php if ($not_editable): ?>
                        <?php $aria_label = $task['nb_comments'] == 1 ? t('%d comment', $task['nb_comments']) : t('%d comments', $task['nb_comments']); ?>
                        <span title="<?= $aria_label ?>" role="img" aria-label="<?= $aria_label ?>"><i class="fa fa-comments-o"></i>&nbsp;<?= $task['nb_comments'] ?></span>
                    <?php else: ?>
                        <?= $this->modal->medium(
                            'comments-o',
                            $task['nb_comments'],
                            'CommentListController',
                            'show',
                            array('task_id' => $task['id'], 'project_id' => $task['project_id']),
                            $task['nb_comments'] == 1 ? t('%d comment', $task['nb_comments']) : t('%d comments', $task['nb_comments'])
                        ) ?>
                    <?php endif ?>
                <?php else: ?>
                    <span class="aco_dimmed"><i class="fa fa-comments-o"></i></span>
                <?php endif ?>
            <?php endif ?>


            <?php if (! empty($task['assignee_username'])): ?>
                <span title="<?= $this->text->e($task['assignee_name'] ?: $task['assignee_username']) ?>">
                    <?= $this->text->e($this->user->getInitials($task['assignee_name'] ?: $task['assignee_username'])) ?>
                </span> -
            <?php endif ?>
            <?= $this->url->link($this->text->e($task['title']), 'TaskViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id']), false, '', $this->text->e($task['title'])) ?>

            <?php if ($ACO_collapsed_due_date && ! empty($task['date_due'])): ?>
                <?php if (time() > $task['date_due']): ?>
                    <span class="task-date task-date-overdue"><i class="fa fa-calendar"></i></span>
                <?php elseif (date('Y-m-d') == date('Y-m-d', $task['date_due'])): ?>
                    <span class="task-date task-date-today"><i class="fa fa-calendar"></i></span>
                <?php endif ?>
            <?php endif ?>
        </div>
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
