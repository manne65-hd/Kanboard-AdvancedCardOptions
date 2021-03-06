<?php

namespace Kanboard\Plugin\AdvancedCardOptions\Controller;

/**
 * Class ConfigController
 *
 * @package Kanboard\Plugin\AdvancedCardOptions\Controller
 */
class ConfigController extends \Kanboard\Controller\ConfigController
{
    public function show()
    {
        $this->response->html($this->helper->layout->config('AdvancedCardOptions:config/advanced_card_options', array(
            'title' => t('Settings').' &gt; '.t('Advanced card-options'),
            'values' => array(
                'ACO_collapsed_hide_edit'        => $this->configModel->get('ACO_collapsed_hide_edit', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_hide_edit']),
                'ACO_collapsed_description'      => $this->configModel->get('ACO_collapsed_description', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_description']),
                'ACO_collapsed_latest_comment'   => $this->configModel->get('ACO_collapsed_latest_comment', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_latest_comment']),
                'ACO_collapsed_due_date'         => $this->configModel->get('ACO_collapsed_due_date', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_due_date']),
                'ACO_collapsed_tags'             => $this->configModel->get('ACO_collapsed_tags', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_tags']),
                'ACO_collapsed_category'         => $this->configModel->get('ACO_collapsed_category', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_category']),
                'ACO_expanded_description'       => $this->configModel->get('ACO_expanded_description', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_expanded_description']),
                'ACO_descript_scroller_textsize' => $this->configModel->get('ACO_descript_scroller_textsize', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_descript_scroller_textsize']),
                'ACO_descript_scroller_maxlines' => $this->configModel->get('ACO_descript_scroller_maxlines', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_descript_scroller_maxlines']),
                'ACO_expanded_latest_comment'    => $this->configModel->get('ACO_expanded_latest_comment', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_expanded_latest_comment']),
                'ACO_comment_scroller_textsize'  => $this->configModel->get('ACO_comment_scroller_textsize', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_comment_scroller_textsize']),
                'ACO_comment_scroller_maxlines'  => $this->configModel->get('ACO_comment_scroller_maxlines', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_comment_scroller_maxlines']),
                'ACO_push_due_days_1'            => $this->configModel->get('ACO_push_due_days_1', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_push_due_days_1']),
                'ACO_push_due_days_2'            => $this->configModel->get('ACO_push_due_days_2', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_push_due_days_2']),
                'ACO_push_due_days_3'            => $this->configModel->get('ACO_push_due_days_3', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_push_due_days_3']),
                'ACO_show_push_duebtn_dropdown'  => $this->configModel->get('ACO_show_push_duebtn_dropdown', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_show_push_duebtn_dropdown']),
                'ACO_remove_due_date'            => $this->configModel->get('ACO_remove_due_date', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_remove_due_date']),
                'ACO_create_due_date'            => $this->configModel->get('ACO_create_due_date', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_create_due_date']),
                'ACO_create_due_date_min_prio'   => $this->configModel->get('ACO_create_due_date_min_prio', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_create_due_date_min_prio']),
                'ACO_create_due_time_mode'       => $this->configModel->get('ACO_create_due_time_mode', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_create_due_time_mode']),
                'ACO_create_due_time'            => $this->configModel->get('ACO_create_due_time', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_create_due_time']),
            ),
        )));
    }

    public function save()
    {
        $values =  $this->request->getValues();
        $values += array('ACO_collapsed_hide_edit' => 0);
        $values += array('ACO_collapsed_description' => 0);
        $values += array('ACO_collapsed_latest_comment' => 0);
        $values += array('ACO_collapsed_due_date' => 0);
        $values += array('ACO_collapsed_tags' => 0);
        $values += array('ACO_collapsed_category' => 0);
        $values += array('ACO_expanded_description' => 0);
        $values += array('ACO_descript_scroller_textsize' => 'normal');
        $values += array('ACO_descript_scroller_maxlines' => 4);
        $values += array('ACO_expanded_latest_comment' => 0);
        $values += array('ACO_comment_scroller_textsize' => 'medium');
        $values += array('ACO_comment_scroller_maxlines' => 3);
        $values += array('ACO_show_push_duebtn_dropdown' => 0);
        $values += array('ACO_remove_due_date' => 0);
        $values += array('ACO_create_due_date' => 0);
        $values += array('ACO_create_due_date_min_prio' => 0);
        $values += array('ACO_create_due_time_mode' => 'fixed');
        $values += array('ACO_create_due_time' => '00:00');

        if ($this->configModel->save($values)) {
            $this->flash->success(t('Settings saved successfully.'));
        } else {
            $this->flash->failure(t('Unable to save your settings.'));
        }

        $this->response->redirect($this->helper->url->to('ConfigController', 'show', array('plugin' => 'AdvancedCardOptions')));
    }
}
