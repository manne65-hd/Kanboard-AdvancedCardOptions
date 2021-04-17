<?php

namespace Kanboard\Plugin\AdvancedCardOptions\Controller;

/**
 * Class ConfigController
 *
 * @package Kanboard\Plugin\Calendar\Controller
 */
class ConfigController extends \Kanboard\Controller\ConfigController
{
    public function show()
    {
        $this->response->html($this->helper->layout->config('AdvancedCardOptions:config/advanced_card_options', array(
            'title' => t('Settings').' &gt; '.t('Advanced card-options'),
        )));
    }

    public function save()
    {
        $values =  $this->request->getValues();

        if ($this->configModel->save($values)) {
            $this->flash->success(t('Settings saved successfully.'));
        } else {
            $this->flash->failure(t('Unable to save your settings.'));
        }

        $this->response->redirect($this->helper->url->to('ConfigController', 'show', array('plugin' => 'AdvancedCardOptions')));
    }
}
