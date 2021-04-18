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
        $this->template->hook->attach('template:task:dropdown', 'AdvancedCardOptions:task/dropdown');

        //Helpers
        $this->helper->register('AdvancedCardOptionsHelper', '\Kanboard\Plugin\AdvancedCardOptions\Helper\AdvancedCardOptionsHelper');

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
        return '0.1.0';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/manne65-hd/AdvancedCardOptions';
    }
}
?>
