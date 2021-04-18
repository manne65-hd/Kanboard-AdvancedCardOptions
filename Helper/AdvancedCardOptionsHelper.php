<?php

namespace Kanboard\Plugin\AdvancedCardOptions\Helper;

use Kanboard\Core\Base;
use Kanboard\Helper\TaskHelper;



/**
 * Task helpers
 *
 * @package helper
 * @author  Manfred Hoffmann
 */
class AdvancedCardOptionsHelper extends TaskHelper
{
    private $project_id;
    public $project_config_method;

    public function Initialize($project_id)
    {
        $this->project_id = $project_id;
        $this->project_config_method = $this->projectMetadataModel->get($this->project_id, 'ACO_project_config_method', 'ACO_project_config_defaults');
    }

    public function getProjectConfigMethod()
    {
        $project_config_method = $this->projectMetadataModel->get($this->project_id, 'ACO_project_config_method', 'ACO_project_config_defaults');
        return $project_config_method;
    }

    public function getPushDueDays()
    {
        $push_due_days = array();

        if ($this->project_config_method === 'ACO_project_config_defaults'){
            $push_due_days[1] = $this->configModel->get('ACO_push_due_days_1', 0);
            $push_due_days[2] = $this->configModel->get('ACO_push_due_days_2', 0);
            $push_due_days[3] = $this->configModel->get('ACO_push_due_days_3', 0);
        } else {
            $push_due_days[1] = $this->projectMetadataModel->get($this->project_id, 'ACO_push_due_days_1', 0);
            $push_due_days[2] = $this->projectMetadataModel->get($this->project_id, 'ACO_push_due_days_2', 0);
            $push_due_days[3] = $this->projectMetadataModel->get($this->project_id, 'ACO_push_due_days_3', 0);
        }

        return $push_due_days;
    }

}
