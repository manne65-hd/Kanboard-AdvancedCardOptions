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
                'ACO_push_due_days_1'           => $this->projectMetadataModel->get($project['id'], 'ACO_push_due_days_1', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_push_due_days_1']),
                'ACO_push_due_days_2'           => $this->projectMetadataModel->get($project['id'], 'ACO_push_due_days_2', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_push_due_days_2']),
                'ACO_push_due_days_3'           => $this->projectMetadataModel->get($project['id'], 'ACO_push_due_days_3', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_push_due_days_3']),
                'ACO_show_push_duebtn_dropdown' => $this->projectMetadataModel->get($project['id'], 'ACO_show_push_duebtn_dropdown', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_show_push_duebtn_dropdown']),
                'ACO_show_push_duebtn_taskview' => $this->projectMetadataModel->get($project['id'], 'ACO_show_push_duebtn_taskview', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_show_push_duebtn_taskview']),
                'ACO_remove_due_date'           => $this->projectMetadataModel->get($project['id'], 'ACO_remove_due_date', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_remove_due_date']),
                'ACO_create_due_date'           => $this->projectMetadataModel->get($project['id'], 'ACO_create_due_date', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_create_due_date']),
                'ACO_collapsed_description'     => $this->projectMetadataModel->get($project['id'], 'ACO_collapsed_description', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_description']),
                'ACO_collapsed_latest_comment'  => $this->projectMetadataModel->get($project['id'], 'ACO_collapsed_latest_comment', $this->helper->AdvancedCardOptionsHelper->ACO_defaults['ACO_collapsed_latest_comment']),
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
	    $this->projectMetadataModel->save($project['id'], array('ACO_push_due_days_1' => $values["ACO_push_due_days_1"]));
        $this->projectMetadataModel->save($project['id'], array('ACO_push_due_days_2' => $values["ACO_push_due_days_2"]));
        $this->projectMetadataModel->save($project['id'], array('ACO_push_due_days_3' => $values["ACO_push_due_days_3"]));
        $this->projectMetadataModel->save($project['id'], array('ACO_show_push_duebtn_dropdown' => isset($values["ACO_show_push_duebtn_dropdown"]) ? $values["ACO_show_push_duebtn_dropdown"] : 0 ));
        $this->projectMetadataModel->save($project['id'], array('ACO_show_push_duebtn_taskview' => isset($values["ACO_show_push_duebtn_taskview"]) ? $values["ACO_show_push_duebtn_taskview"] : 0 ));
        $this->projectMetadataModel->save($project['id'], array('ACO_remove_due_date' => isset($values["ACO_remove_due_date"]) ? $values["ACO_remove_due_date"] : 0 ));
        $this->projectMetadataModel->save($project['id'], array('ACO_create_due_date' => isset($values["ACO_create_due_date"]) ? $values["ACO_create_due_date"] : 0 ));
        $this->projectMetadataModel->save($project['id'], array('ACO_collapsed_description' => isset($values["ACO_collapsed_description"]) ? $values["ACO_collapsed_description"] : 0 ));
        $this->projectMetadataModel->save($project['id'], array('ACO_collapsed_latest_comment' => isset($values["ACO_collapsed_latest_comment"]) ? $values["ACO_collapsed_latest_comment"] : 0 ));

	    return $this->show($values, $errors);
    }

}

?>
