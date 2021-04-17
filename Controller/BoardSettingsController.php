<?php
namespace Kanboard\Plugin\AdvancedCardOptions\Controller;
use Kanboard\Controller\BaseController;

class BoardSettingsController extends BaseController
{
    /**
     * Render AdvancedCardOptions for configuration
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

        $this->response->html($this->helper->layout->project('AdvancedCardOptions:settings_board', array(
            'owners' => $this->projectUserRoleModel->getAssignableUsersList($project['id'], true),
            'values' => array(
                'ACO_board_config_method'   => $this->projectMetadataModel->get($project['id'], 'ACO_board_config_method', 'ACO_board_config_defaults'),
                'ACO_push_due_days_1'       => $this->projectMetadataModel->get($project['id'], 'ACO_push_due_days_1'),
                'ACO_push_due_days_2'       => $this->projectMetadataModel->get($project['id'], 'ACO_push_due_days_2'),
                'ACO_push_due_days_3'       => $this->projectMetadataModel->get($project['id'], 'ACO_push_due_days_3'),
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

        $this->projectMetadataModel->save($project['id'], array('ACO_board_config_method' => $values["ACO_board_config_method"]));
	    $this->projectMetadataModel->save($project['id'], array('ACO_push_due_days_1' => $values["ACO_push_due_days_1"]));
        $this->projectMetadataModel->save($project['id'], array('ACO_push_due_days_2' => $values["ACO_push_due_days_2"]));
        $this->projectMetadataModel->save($project['id'], array('ACO_push_due_days_3' => $values["ACO_push_due_days_3"]));

	    return $this->show($values, $errors);
    }

}

?>
