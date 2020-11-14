<?php

namespace src\BusinessLogic;

use src\BusinessLogic\AbstractAction;

class InWorkAction extends AbstractAction
{
    public static function getName()
    {
        return 'Откликнуться';
    }

    public static function getInternalName()
    {
        return 'InWorkAction';
    }

    public static function checkRights(int $userId, int $customerId, int $executorId)
    {
        return $userId === $executorId;
    }
}
