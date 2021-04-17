<?php if ($this->user->hasProjectAccess('ProjectEditController', 'show', $project['id'])): ?>
<li <?= $this->app->checkMenuSelection('BoardSettingsController', 'show', 'AdvancedCardOptions') ?>>
    <?= $this->url->icon('vcard-o', t('Advanced Card-Options'), 'BoardSettingsController', 'show', array('plugin' => 'AdvancedCardOptions','project_id' => $project['id'])) ?>
</li>
<?php endif ?>
