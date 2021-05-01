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
            'values' => array(
                'ACO_show_push_duebtn_dropdown' => $this->configModel->get('ACO_show_push_duebtn_dropdown', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_show_push_duebtn_dropdown']),
                'ACO_remove_due_date'           => $this->configModel->get('ACO_remove_due_date', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_remove_due_date']),
                'ACO_create_due_date'           => $this->configModel->get('ACO_create_due_date', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_create_due_date']),
                'ACO_collapsed_hide_edit'       => $this->configModel->get('ACO_collapsed_hide_edit', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_hide_edit']),
                'ACO_collapsed_description'     => $this->configModel->get('ACO_collapsed_description', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_description']),
                'ACO_collapsed_latest_comment'  => $this->configModel->get('ACO_collapsed_latest_comment', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_latest_comment']),
                'ACO_collapsed_due_date'        => $this->configModel->get('ACO_collapsed_due_date', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_due_date']),
                'ACO_collapsed_tags'             => $this->configModel->get('ACO_collapsed_tags', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_tags']),
                'ACO_collapsed_category'         => $this->configModel->get('ACO_collapsed_category', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_category']),
            ),
        )));
    }

    public function save()
    {
        $values =  $this->request->getValues();
        $values += array('ACO_show_push_duebtn_dropdown' => 0);
        $values += array('ACO_remove_due_date' => 0);
        $values += array('ACO_create_due_date' => 0);
        $values += array('ACO_collapsed_hide_edit' => 0);
        $values += array('ACO_collapsed_description' => 0);
        $values += array('ACO_collapsed_latest_comment' => 0);
        $values += array('ACO_collapsed_due_date' => 0);
        $values += array('ACO_collapsed_tags' => 0);
        $values += array('ACO_collapsed_category' => 0);

        if ($this->configModel->save($values)) {
            $this->flash->success(t('Settings saved successfully.'));
        } else {
            $this->flash->failure(t('Unable to save your settings.'));
        }

        $this->response->redirect($this->helper->url->to('ConfigController', 'show', array('plugin' => 'AdvancedCardOptions')));
    }
}
