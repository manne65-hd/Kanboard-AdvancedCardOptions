<?php

namespace Kanboard\Plugin\AdvancedCardOptions;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;


class Plugin extends Base
{
    public function initialize()
    {
        // Template OVERRIDES ...
        $this->template->setTemplateOverride('board/task_footer', 'AdvancedCardOptions:board/task_footer');
        $this->template->setTemplateOverride('board/task_private', 'AdvancedCardOptions:board/task_private');

        // Template HOOK-attachments ...
        $this->template->hook->attach('template:config:sidebar', 'AdvancedCardOptions:config/sidebar');
        $this->template->hook->attach('template:project:sidebar', 'AdvancedCardOptions:board/sidebar');
    }

    public function onStartup() {
        // load Translation
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__ . '/Locale');
    }

    public function getPluginName()
    {
        return 'AdvancedCardOptions';
    }

    public function getPluginDescription()
    {
        return t('Allows advanced control over the appearance and options of the task-cards in board-view');
    }

    public function getPluginAuthor()
    {
        return 'Manfred Hoffmann';
    }

    public function getPluginVersion()
    {
        return '0.0.2';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/manne65-hd/AdvancedCardOptions';
    }
}
?>
