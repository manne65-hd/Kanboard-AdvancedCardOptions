<?php

namespace Kanboard\Plugin\AdvancedCardOptions;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;


class Plugin extends Base
{
    public function initialize()
    {
        // Template OVERRIDES ...
        $this->template->setTemplateOverride('board/table_container', 'AdvancedCardOptions:board/table_container');
        $this->template->setTemplateOverride('board/table_tasks', 'AdvancedCardOptions:board/table_tasks');
        $this->template->setTemplateOverride('board/task_footer', 'AdvancedCardOptions:board/task_footer');
        $this->template->setTemplateOverride('board/task_private', 'AdvancedCardOptions:board/task_private');

        // Template HOOK-attachments ...
        $this->template->hook->attach('template:config:sidebar', 'AdvancedCardOptions:config/sidebar');
        $this->template->hook->attach('template:project:sidebar', 'AdvancedCardOptions:board/sidebar');
        $this->template->hook->attach('template:task:dropdown', 'AdvancedCardOptions:task/dropdown');
        $this->template->hook->attach('template:task:details:bottom', 'AdvancedCardOptions:task/bottom');

        //Helpers
        $this->helper->register('AdvancedCardOptionsHelper', '\Kanboard\Plugin\AdvancedCardOptions\Helper\AdvancedCardOptionsHelper');

        //CSS
        $this->hook->on('template:layout:css', array('template' => 'plugins/AdvancedCardOptions/Assets/css/adv_card_options.css'));
        //JS
        $this->hook->on('template:layout:js', array('template' => 'plugins/AdvancedCardOptions/Assets/js/adv_card_options.js'));
    }

    public function onStartup() {
        // load Translation
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__ . '/Locale');
    }

    public function getClasses()
    {
        return array(
            'Plugin\AdvancedCardOptions\Model' => array(
                'AcoCommentModel',
            )
        );
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
        return '0.4.2';
    }

    public function getCompatibleVersion()
    {
        return '>=1.2.20';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/manne65-hd/Kanboard-AdvancedCardOptions';
    }
}
?>
