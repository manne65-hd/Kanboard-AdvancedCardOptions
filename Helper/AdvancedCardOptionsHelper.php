<?php

namespace Kanboard\Plugin\AdvancedCardOptions\Helper;

use Kanboard\Core\Base;
use Kanboard\Helper\TaskHelper;



/**
 * AdvancedCardOptions helpers
 *
 * @author  Manfred Hoffmann
 */
class AdvancedCardOptionsHelper extends TaskHelper
{
    /**
    * AdvancedCardOptions > DEFAULT-parameters (defined in the Initialize-function!)
    *
    * @access public
    * @var array
    */
    public $ACO_defaults = array(
        'ACO_project_config_method' => 'ACO_project_config_defaults',
        'ACO_push_due_days_1' => 0,
        'ACO_push_due_days_2' => 0,
        'ACO_push_due_days_3' => 0,
        'ACO_show_push_duebtn_dropdown' => 1,
        'ACO_show_push_duebtn_taskview' =>0,
        'ACO_remove_due_date' => 0,
        'ACO_create_due_date' => 0,
    );


    /**
    * project_id for current Task
    *
    * @access private
    * @var integer
    */
    private $project_id;

    /**
    * config-method for current Project
    *
    * @access public
    * @var string
    */
    public $project_config_method;


    /**
     * Initialize the helper with the current task's project_id
     *
     * @access public
     * @param  integer $project_id
     */
    public function Initialize($project_id)
    {
        $this->project_id = $project_id;
        $this->project_config_method = $this->projectMetadataModel->get($this->project_id, 'ACO_project_config_method', $this->ACO_defaults['ACO_project_config_method']);
    }

    /**
     * Return push_due(-date)_days for the current task
     *
     * @access public
     * @return array
     */
    public function getPushDueDays()
    {
        $push_due_days = array();

        if ($this->project_config_method === 'ACO_project_config_defaults'){
            $push_due_days[1] = $this->configModel->get('ACO_push_due_days_1', $this->ACO_defaults['ACO_push_due_days_1']);
            $push_due_days[2] = $this->configModel->get('ACO_push_due_days_2', $this->ACO_defaults['ACO_push_due_days_2']);
            $push_due_days[3] = $this->configModel->get('ACO_push_due_days_3', $this->ACO_defaults['ACO_push_due_days_3']);
        } else {
            $push_due_days[1] = $this->projectMetadataModel->get($this->project_id, 'ACO_push_due_days_1', $this->ACO_defaults['ACO_push_due_days_1']);
            $push_due_days[2] = $this->projectMetadataModel->get($this->project_id, 'ACO_push_due_days_2', $this->ACO_defaults['ACO_push_due_days_2']);
            $push_due_days[3] = $this->projectMetadataModel->get($this->project_id, 'ACO_push_due_days_3', $this->ACO_defaults['ACO_push_due_days_3']);
        }

        return $push_due_days;
    }

    /**
     * Return other ACO-config-parameter
     *
     * @access public
     * @param string Name of the parameter
     * @return mixed
     */
    public function getParameter($ACO_parameter)
    {
        if ($this->project_config_method === 'ACO_project_config_defaults'){
            return $this->configModel->get($ACO_parameter, $this->ACO_defaults[$ACO_parameter]);
        } else {
            return $this->projectMetadataModel->get($this->project_id, $ACO_parameter, $this->ACO_defaults[$ACO_parameter]);
        }
    }

}
