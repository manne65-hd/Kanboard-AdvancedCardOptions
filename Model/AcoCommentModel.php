<?php

namespace Kanboard\Plugin\AdvancedCardOptions\Model;

use Kanboard\Core\Base;
use Kanboard\Model\UserModel;
use Kanboard\Model\CommentModel;

/**
 * AdvancedCardOptions Comment model
 *
 * @package  Kanboard\Plugin\AdvancedCardOptions\Model
 * @author   Manfred Hoffmann
 */
class AcoCommentModel extends CommentModel
{
    /**
     * Get latest comment for a given task
     *
     * @access public
     * @param  integer  $task_id  Task id
     * @return array
     */
    public function getLatest($task_id)
    {
        return $this->db
            ->table(self::TABLE)
            ->columns(
                self::TABLE.'.id',
                self::TABLE.'.date_creation',
                self::TABLE.'.date_modification',
                self::TABLE.'.task_id',
                self::TABLE.'.user_id',
                self::TABLE.'.comment',
                UserModel::TABLE.'.username',
                UserModel::TABLE.'.name',
                UserModel::TABLE.'.email',
                UserModel::TABLE.'.avatar_path'
            )
            ->join(UserModel::TABLE, 'id', 'user_id')
            ->orderBy(self::TABLE.'.date_creation', 'DESC')
            ->orderBy(self::TABLE.'.id', 'DESC')
            ->eq(self::TABLE.'.task_id', $task_id)
            ->findOne();
    }
}
