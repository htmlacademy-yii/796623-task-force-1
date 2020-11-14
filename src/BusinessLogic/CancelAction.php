<?php

namespace src\BusinessLogic;

use src\BusinessLogic\AbstractAction;

class CancelAction extends AbstractAction
{
    public static function getName()
    {
        return 'Отменить';
    }

    public static function getInternalName()
    {
        return 'CancelAction';
    }

    public static function checkRights(int $userId, int $customerId, int $executorId)
    {
        return $userId === $customerId;
    }
}
