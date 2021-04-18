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

    public function getBoardConfigMethod($project_id)
    {
        return $this->projectMetadataModel->get($project_id, 'ACO_board_config_method', 'ACO_board_config_defaults');
    }

    public function getAppPushDueDays()
    {
        $app_push_due_days = array();

        $app_push_due_days[1] = $this->configModel->get('ACO_push_due_days_1', 0);
        $app_push_due_days[2] = $this->configModel->get('ACO_push_due_days_2', 0);
        $app_push_due_days[3] = $this->configModel->get('ACO_push_due_days_3', 0);

        return $app_push_due_days;
    }

    public function getProjectPushDueDays($project_id)
    {
        $project_push_due_days = array();

        $project_push_due_days[1] = $this->projectMetadataModel->get($project_id, 'ACO_push_due_days_1', 0);
        $project_push_due_days[2] = $this->projectMetadataModel->get($project_id, 'ACO_push_due_days_2', 0);
        $project_push_due_days[3] = $this->projectMetadataModel->get($project_id, 'ACO_push_due_days_3', 0);

        return $project_push_due_days;
    }
}
