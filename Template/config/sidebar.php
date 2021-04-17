<li <?= $this->app->checkMenuSelection('ConfigController', 'show', 'AdvancedCardOptions') ?>>
    <?= $this->url->link(t('Advanced card-options'), 'ConfigController', 'show', array('plugin' => 'AdvancedCardOptions')) ?>
</li>
