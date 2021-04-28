<?php if ($this->user->hasProjectAccess('ProjectEditController', 'show', $project['id'])): ?>
<li <?= $this->app->checkMenuSelection('ProjectSettingsController', 'show', 'AdvancedCardOptions') ?>>
    <?= $this->url->link(t('Advanced card-options'), 'ProjectSettingsController', 'show', array('plugin' => 'AdvancedCardOptions','project_id' => $project['id'])) ?>
</li>
<?php endif ?>
