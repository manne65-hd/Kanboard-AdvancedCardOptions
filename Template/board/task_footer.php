<?php
// Get the configuration for the project / task
$ACO_initialize = $this->helper->AdvancedCardOptionsHelper->Initialize($project['id']);
$ACO_push_due_days           = $this->helper->AdvancedCardOptionsHelper->getPushDueDays();
$ACO_remove_due_date         = $this->helper->AdvancedCardOptionsHelper->getParameter('ACO_remove_due_date');
$ACO_create_due_date         = $this->helper->AdvancedCardOptionsHelper->getParameter('ACO_create_due_date');
$ACO_expanded_latest_comment = $this->helper->AdvancedCardOptionsHelper->getParameter('ACO_expanded_latest_comment');

// Figure out if we are supposed to display ANY icons related to pushing the due date (because these will be wrapped within STRONG square brackets)
if ( array_sum($ACO_push_due_days) === 1 ){
    $ACO_show_duedate_icons = TRUE;
    $ACO_push_due_days_suffix = t('Day');
    $ACO_create_due_days_suffix = t('Day');
    $ACO_push_due_days_suffix = ($ACO_remove_due_date) ? $ACO_push_due_days_suffix . ' | ' : $ACO_push_due_days_suffix;
} elseif ( array_sum($ACO_push_due_days) > 1 ) {
    $ACO_show_duedate_icons = TRUE;
    $ACO_push_due_days_suffix = t('Day(s)');
    $ACO_create_due_days_suffix = t('Day(s)');
    $ACO_push_due_days_suffix = ($ACO_remove_due_date) ? $ACO_push_due_days_suffix . ' | ' : $ACO_push_due_days_suffix;
} else {
    $ACO_show_duedate_icons = ($ACO_remove_due_date) ? TRUE : FALSE;
    $ACO_push_due_days_suffix = '';
    $ACO_create_due_days_suffix = '';
}

?>


<?php if ($ACO_expanded_latest_comment  && $task['nb_comments'] > 0): ?>
    <?php $ACO_latest_comment = $this->helper->AdvancedCardOptionsHelper->commentGetLatest($task['id']); ?>
    <?php $ACO_latest_comment_tooltip =  t('%s on %s',$ACO_latest_comment['name'], $this->dt->datetime($ACO_latest_comment['date_modification'])); ?>
    <div class="aco_expanded_latest_comment">
        <span class="aco_comment_icon" title="<?= $ACO_latest_comment_tooltip ?>" role="img" aria-label="<?= $ACO_latest_comment_tooltip ?>">
            <i class="fa fa-commenting" aria-></i></span><?= $this->helper->text->markdown($ACO_latest_comment['comment']) ?>
    </div>
<?php endif ?>

<?php if (! empty($task['category_id'])): ?>
<div class="task-board-category-container task-board-category-container-color">
    <span class="task-board-category category-<?= $this->text->e($task['category_name']) ?> <?= $task['category_color_id'] ? "color-{$task['category_color_id']}" : '' ?>">
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
            <?php if (! empty($task['category_description'])): ?>
                <?= $this->app->tooltipMarkdown($task['category_description']) ?>
            <?php endif ?>
        <?php endif ?>
    </span>
</div>
<?php endif ?>

<?php if (! empty($task['tags'])): ?>
    <div class="task-tags">
        <ul>
        <?php foreach ($task['tags'] as $tag): ?>
            <li class="task-tag <?= $tag['color_id'] ? "color-{$tag['color_id']}" : '' ?>"><?= $this->text->e($tag['name']) ?></li>
        <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<div class="task-board-icons">
    <div class="task-board-icons-row">
        <?php if ($task['reference']): ?>
            <span class="task-board-reference" title="<?= t('Reference') ?>">
                <span class="ui-helper-hidden-accessible"><?= t('Reference') ?> </span><?= $this->task->renderReference($task) ?>
            </span>
        <?php endif ?>
    </div>
    <div class="task-board-icons-row">
        <?php if ($task['is_milestone'] == 1): ?>
            <span title="<?= t('Milestone') ?>">
                <i class="fa fa-flag flag-milestone" role="img" aria-label="<?= t('Milestone') ?>"></i>
            </span>
        <?php endif ?>

        <?php if ($task['score']): ?>
            <span class="task-score" title="<?= t('Complexity') ?>">
                <i class="fa fa-trophy" role="img" aria-label="<?= t('Complexity') ?>"></i>
                <?= $this->text->e($task['score']) ?>
            </span>
        <?php endif ?>

        <?php if (! empty($task['time_estimated']) || ! empty($task['time_spent'])): ?>
            <span class="task-time-estimated" title="<?= t('Time spent and estimated') ?>">
                <span class="ui-helper-hidden-accessible"><?= t('Time spent and estimated') ?> </span><?= $this->text->e($task['time_spent']) ?>/<?= $this->text->e($task['time_estimated']) ?>h
            </span>
        <?php endif ?>

        <?php if (! empty($task['date_due'])): ?>
            <span class="task-date
                <?php if (time() > $task['date_due']): ?>
                     task-date-overdue
                <?php elseif (date('Y-m-d') == date('Y-m-d', $task['date_due'])): ?>
                     task-date-today
                <?php endif ?>
                ">
                <?php if ($this->user->hasProjectAccess('TaskModificationController', 'edit', $task['project_id'])): ?>
                    <?php if (time() > $task['date_due'] || date('Y-m-d') == date('Y-m-d', $task['date_due'])): ?>
                        <?php if ($ACO_show_duedate_icons): ?>
                            <strong>[</strong>
                            <?= $this->render('AdvancedCardOptions:self/card/icons_push_due_date', array(
                                'task' => $task,
                                'project' => $project,
                            )) ?>
                            <?= $ACO_push_due_days_suffix; ?>
                            <?php if ($ACO_remove_due_date): ?>
                                <?= $this->render('AdvancedCardOptions:self/card/icon_remove_due_date', array(
                                    'task' => $task,
                                    'project' => $project,
                                )) ?>
                            <?php endif ?>
                            <strong>]</strong>
                        <?php endif ?>
                    <?php endif ?>
                <?php endif ?>
                <i class="fa fa-calendar"></i>
                <?php if (date('Hi', $task['date_due']) === '0000' ): ?>
                    <?= $this->dt->date($task['date_due']) ?>
                <?php else: ?>
                    <?= $this->dt->datetime($task['date_due']) ?>
                <?php endif ?>
            </span>
        <?php elseif ($ACO_create_due_date && empty($task['date_due'])): ?>
            <i class="fa fa-calendar" role="img" title="<?= t('Set due date by clicking one of the "+buttons" ...') ?>" aria-label="<?= t('Set due date by clicking one of the "+buttons" ...') ?>"></i>
            <?= $this->render('AdvancedCardOptions:self/card/icons_create_due_date', array(
                'task' => $task,
                'project' => $project,
            )) ?>
            <?= $ACO_create_due_days_suffix; ?>
        <?php endif ?>
    </div>
    <div class="task-board-icons-row">

        <?php if ($task['recurrence_status'] == \Kanboard\Model\TaskModel::RECURRING_STATUS_PENDING): ?>
            <?= $this->app->tooltipLink('<i class="fa fa-refresh fa-rotate-90"></i>', $this->url->href('BoardTooltipController', 'recurrence', array('task_id' => $task['id'], 'project_id' => $task['project_id']))) ?>
        <?php endif ?>

        <?php if ($task['recurrence_status'] == \Kanboard\Model\TaskModel::RECURRING_STATUS_PROCESSED): ?>
            <?= $this->app->tooltipLink('<i class="fa fa-refresh fa-rotate-90 fa-inverse"></i>', $this->url->href('BoardTooltipController', 'recurrence', array('task_id' => $task['id'], 'project_id' => $task['project_id']))) ?>
        <?php endif ?>

        <?php if (! empty($task['nb_links'])): ?>
            <?= $this->app->tooltipLink('<i class="fa fa-code-fork fa-fw"></i>'.$task['nb_links'], $this->url->href('BoardTooltipController', 'tasklinks', array('task_id' => $task['id'], 'project_id' => $task['project_id']))) ?>
        <?php endif ?>

        <?php if (! empty($task['nb_external_links'])): ?>
            <?= $this->app->tooltipLink('<i class="fa fa-external-link fa-fw"></i>'.$task['nb_external_links'], $this->url->href('BoardTooltipController', 'externallinks', array('task_id' => $task['id'], 'project_id' => $task['project_id']))) ?>
        <?php endif ?>

        <?php if (! empty($task['nb_subtasks'])): ?>
            <?= $this->app->tooltipLink('<i class="fa fa-bars fa-fw"></i>'.round($task['nb_completed_subtasks'] / $task['nb_subtasks'] * 100, 0).'%', $this->url->href('BoardTooltipController', 'subtasks', array('task_id' => $task['id'], 'project_id' => $task['project_id']))) ?>
        <?php endif ?>

        <?php if (! empty($task['nb_files'])): ?>
            <?= $this->app->tooltipLink('<i class="fa fa-paperclip fa-fw"></i>'.$task['nb_files'], $this->url->href('BoardTooltipController', 'attachments', array('task_id' => $task['id'], 'project_id' => $task['project_id']))) ?>
        <?php endif ?>

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
        <?php endif ?>

        <?php if (! empty($task['description'])): ?>
            <?= $this->app->tooltipLink('<i class="fa fa-file-text-o"></i>', $this->url->href('BoardTooltipController', 'description', array('task_id' => $task['id'], 'project_id' => $task['project_id']))) ?>
        <?php endif ?>

        <?php if ($task['is_active'] == 1): ?>
            <div class="task-icon-age">
                <span title="<?= t('Task age in days')?>" class="task-icon-age-total"><span class="ui-helper-hidden-accessible"><?= t('Task age in days') ?> </span><?= $this->dt->age($task['date_creation']) ?></span>
                <span title="<?= t('Days in this column')?>" class="task-icon-age-column"><span class="ui-helper-hidden-accessible"><?= t('Days in this column') ?> </span><?= $this->dt->age($task['date_moved']) ?></span>
            </div>
        <?php else: ?>
            <span class="task-board-closed"><i class="fa fa-ban fa-fw"></i><?= t('Closed') ?></span>
        <?php endif ?>

        <?= $this->task->renderPriority($task['priority']) ?>

        <?= $this->hook->render('template:board:task:icons', array('task' => $task)) ?>
    </div>
</div>

<?= $this->hook->render('template:board:task:footer', array('task' => $task)) ?>
