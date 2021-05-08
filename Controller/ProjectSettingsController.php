<?php
namespace Kanboard\Plugin\AdvancedCardOptions\Controller;
use Kanboard\Controller\BaseController;

class ProjectSettingsController extends BaseController
{
    /**
     * Render AdvancedCardOptions for project-configuration
     *
     * @access public
     * @param array $values
     * @param array $errors
     */
    public function show(array $values = array(), array $errors = array())
    {
	    $project = $this->getProject();
	    $columnList =  $this->columnModel->getList($project['id']);
	    $colorList =  $this->colorModel->getList($project['id']);
	    $tagList =  $this->tagModel->getAll($project['id']);

        $this->response->html($this->helper->layout->project('AdvancedCardOptions:project/advanced_card_options', array(
            'owners' => $this->projectUserRoleModel->getAssignableUsersList($project['id'], true),
            'values' => array(
                'ACO_project_config_method'     => $this->projectMetadataModel->get($project['id'], 'ACO_project_config_method', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_project_config_method']),
                'ACO_collapsed_hide_edit'       => $this->projectMetadataModel->get($project['id'], 'ACO_collapsed_hide_edit', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_hide_edit']),
                'ACO_collapsed_description'     => $this->projectMetadataModel->get($project['id'], 'ACO_collapsed_description', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_description']),
                'ACO_collapsed_latest_comment'  => $this->projectMetadataModel->get($project['id'], 'ACO_collapsed_latest_comment', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_latest_comment']),
                'ACO_collapsed_due_date'        => $this->projectMetadataModel->get($project['id'], 'ACO_collapsed_due_date', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_due_date']),
                'ACO_collapsed_tags'            => $this->projectMetadataModel->get($project['id'], 'ACO_collapsed_tags', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_tags']),
                'ACO_collapsed_category'        => $this->projectMetadataModel->get($project['id'], 'ACO_collapsed_category', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_category']),
                'ACO_expanded_latest_comment'   => $this->projectMetadataModel->get($project['id'], 'ACO_expanded_latest_comment', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_expanded_latest_comment']),
                'ACO_comment_scroller_textsize' => $this->projectMetadataModel->get($project['id'], 'ACO_comment_scroller_textsize', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_comment_scroller_textsize']),
                'ACO_comment_scroller_maxlines' => $this->projectMetadataModel->get($project['id'], 'ACO_comment_scroller_maxlines', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_comment_scroller_maxlines']),
                'ACO_push_due_days_1'           => $this->projectMetadataModel->get($project['id'], 'ACO_push_due_days_1', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_push_due_days_1']),
                'ACO_push_due_days_2'           => $this->projectMetadataModel->get($project['id'], 'ACO_push_due_days_2', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_push_due_days_2']),
                'ACO_push_due_days_3'           => $this->projectMetadataModel->get($project['id'], 'ACO_push_due_days_3', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_push_due_days_3']),
                'ACO_show_push_duebtn_dropdown' => $this->projectMetadataModel->get($project['id'], 'ACO_show_push_duebtn_dropdown', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_show_push_duebtn_dropdown']),
                'ACO_remove_due_date'           => $this->projectMetadataModel->get($project['id'], 'ACO_remove_due_date', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_remove_due_date']),
                'ACO_create_due_date'           => $this->projectMetadataModel->get($project['id'], 'ACO_create_due_date', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_create_due_date']),
                'ACO_create_due_date_min_prio'  => $this->projectMetadataModel->get($project['id'], 'ACO_create_due_date_min_prio', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_create_due_date_min_prio']),
                'ACO_create_due_time_mode'      => $this->projectMetadataModel->get($project['id'], 'ACO_create_due_time_mode', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_create_due_time_mode']),
                'ACO_create_due_time'           => $this->projectMetadataModel->get($project['id'], 'ACO_create_due_time', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_create_due_time']),
                'project_id' => $_REQUEST['project_id'],
            ),
            'errors' => $errors,
            'columns_list' => $columnList,
            'project' => $project,
            'title' => t('Edit project')
        )));
    }

    public function save()
    {

	    $values = $this->request->getValues();
	    $errors = array();
	    $project = $this->getProject();
	    $columnList =  $this->columnModel->getList($project['id']);

        $this->projectMetadataModel->save($project['id'], array('ACO_project_config_method' => $values["ACO_project_config_method"]));
        $this->projectMetadataModel->save($project['id'], array('ACO_collapsed_hide_edit' => isset($values["ACO_collapsed_hide_edit"]) ? $values["ACO_collapsed_hide_edit"] : 0 ));
        $this->projectMetadataModel->save($project['id'], array('ACO_collapsed_description' => isset($values["ACO_collapsed_description"]) ? $values["ACO_collapsed_description"] : 0 ));
        $this->projectMetadataModel->save($project['id'], array('ACO_collapsed_latest_comment' => isset($values["ACO_collapsed_latest_comment"]) ? $values["ACO_collapsed_latest_comment"] : 0 ));
        $this->projectMetadataModel->save($project['id'], array('ACO_collapsed_due_date' => isset($values["ACO_collapsed_due_date"]) ? $values["ACO_collapsed_due_date"] : 0 ));
        $this->projectMetadataModel->save($project['id'], array('ACO_collapsed_tags' => isset($values["ACO_collapsed_tags"]) ? $values["ACO_collapsed_tags"] : 0 ));
        $this->projectMetadataModel->save($project['id'], array('ACO_collapsed_category' => isset($values["ACO_collapsed_category"]) ? $values["ACO_collapsed_category"] : 0 ));
        $this->projectMetadataModel->save($project['id'], array('ACO_expanded_latest_comment' => isset($values["ACO_expanded_latest_comment"]) ? $values["ACO_expanded_latest_comment"] : 0 ));
        $this->projectMetadataModel->save($project['id'], array('ACO_comment_scroller_textsize' => isset($values["ACO_comment_scroller_textsize"]) ? $values["ACO_comment_scroller_textsize"] : 0 ));
        $this->projectMetadataModel->save($project['id'], array('ACO_comment_scroller_maxlines' => $values["ACO_comment_scroller_maxlines"]));
	    $this->projectMetadataModel->save($project['id'], array('ACO_push_due_days_1' => $values["ACO_push_due_days_1"]));
        $this->projectMetadataModel->save($project['id'], array('ACO_push_due_days_2' => $values["ACO_push_due_days_2"]));
        $this->projectMetadataModel->save($project['id'], array('ACO_push_due_days_3' => $values["ACO_push_due_days_3"]));
        $this->projectMetadataModel->save($project['id'], array('ACO_show_push_duebtn_dropdown' => isset($values["ACO_show_push_duebtn_dropdown"]) ? $values["ACO_show_push_duebtn_dropdown"] : 0 ));
        $this->projectMetadataModel->save($project['id'], array('ACO_remove_due_date' => isset($values["ACO_remove_due_date"]) ? $values["ACO_remove_due_date"] : 0 ));
        $this->projectMetadataModel->save($project['id'], array('ACO_create_due_date' => isset($values["ACO_create_due_date"]) ? $values["ACO_create_due_date"] : 0 ));
        $this->projectMetadataModel->save($project['id'], array('ACO_create_due_date_min_prio' => $values["ACO_create_due_date_min_prio"]));
        $this->projectMetadataModel->save($project['id'], array('ACO_create_due_time_mode' => isset($values["ACO_create_due_time_mode"]) ? $values["ACO_create_due_time_mode"] : 0 ));
        $this->projectMetadataModel->save($project['id'], array('ACO_create_due_time' => $values["ACO_create_due_time"]));

	    return $this->show($values, $errors);
    }

}

?>
