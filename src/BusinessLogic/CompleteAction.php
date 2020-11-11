<?php

namespace src\BusinessLogic;

use src\BusinessLogic\AbstractAction;

class CompleteAction extends AbstractAction
{
    public function getName()
    {
        return 'Завершить';
    }

    public function getInternalName()
    {
        return 'CompleteAction';
    }

    public static function checkRights(int $userId, int $customerId, int $executorId)
    {
        return $userId === $customerId;
    }
}
