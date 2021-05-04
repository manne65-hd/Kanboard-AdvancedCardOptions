<style>
    .fa-danger_icon {color: #b94a48 !important;}
</style>
<?= $this->modal->mediumIcon(
    'calendar-times-o fa-danger_icon',
    t('Remove the due date'),
    'AdvancedCardOptionsController',
    'removeDueDate',
    array(
            'plugin' => 'AdvancedCardOptions',
            'task_id' => $task['id'],
            'project_id' => $task['project_id'],
        )
    )
?>
