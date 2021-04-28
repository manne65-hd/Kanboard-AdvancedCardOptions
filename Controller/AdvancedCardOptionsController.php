<?php
namespace Kanboard\Plugin\AdvancedCardOptions\Controller;
use Kanboard\Controller\BaseController;
use Kanboard\Core\Controller\AccessForbiddenException;
use Kanboard\Model\TaskModel;
use Kanboard\Formatter\BoardFormatter;

class AdvancedCardOptionsController extends BaseController
{
    public function pushDueDate()
    {
	$template = 'AdvancedCardOptions:self/confirm/confirm_push_due_date';
	$success_message = t('Task due-date has been pushed successfully.');
	$failure_message = t('Error while trying to push the due-date of this task.');

	$project = $this->getProject();
	$task = $this->getTask();

    // Calculate the date + time of the requested pushed due-date
    $pushed_date_due = $this->helper->AdvancedCardOptionsHelper->getPushedDateDue($task['date_due'], $_REQUEST['push_days']);
    $task['confirm_pushed_date_due'] = $pushed_date_due['formatted'];

	if ($this->request->getStringParam('confirmation') === 'yes') {
            $this->checkCSRFParam();
		$values = array();
		$valuesx = $task;
		$tagsx = $this->taskTagModel->getTagsByTask($task['id']);
		$values['id'] = $valuesx['id'];
		$values['title'] = $valuesx['title'];

	if (true){
        $values['date_due'] = $pushed_date_due['raw'];

		$this->taskModificationModel->update($values);
                $this->flash->success($success_message);
            } else {
                $this->flash->failure($failure_message);
            }

            $this->response->redirect($this->helper->url->to('BoardViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id'])), true);
        } else {
            $this->response->html($this->template->render($template, array(
                'task' => $task,
            )));
        }
    }

    public function removeDueDate()
    {
	$template = 'AdvancedCardOptions:self/confirm/confirm_remove_due_date';
	$success_message = t('Task due-date has been removed successfully.');
	$failure_message = t('Error while trying to remove the due-date of this task.');

	$project = $this->getProject();
	$task = $this->getTask();

	if ($this->request->getStringParam('confirmation') === 'yes') {
            $this->checkCSRFParam();
		$values = array();
		$valuesx = $task;
		$tagsx = $this->taskTagModel->getTagsByTask($task['id']);
		$values['id'] = $valuesx['id'];
		$values['title'] = $valuesx['title'];

	if (true){
		$values['date_due'] = '';

		$this->taskModificationModel->update($values);
                $this->flash->success($success_message);
            } else {
                $this->flash->failure($failure_message);
            }

            $this->response->redirect($this->helper->url->to('BoardViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id'])), true);
        } else {
            $this->response->html($this->template->render($template, array(
                'task' => $task,
            )));
        }
    }
}
