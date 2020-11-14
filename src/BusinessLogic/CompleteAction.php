<?php

namespace src\BusinessLogic;

use src\BusinessLogic\AbstractAction;

class CompleteAction extends AbstractAction
{
    public static function getName()
    {
        return 'Завершить';
    }

    public static function getInternalName()
    {
        return 'CompleteAction';
    }

    public static function checkRights(int $userId, int $customerId, int $executorId)
    {
        return $userId === $customerId;
    }
}
