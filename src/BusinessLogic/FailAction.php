<?php

namespace src\BusinessLogic;

use src\BusinessLogic\AbstractAction;

class FailAction extends AbstractAction
{
    public static function getName()
    {
        return 'Отказаться';
    }

    public static function getInternalName()
    {
        return 'FailAction';
    }

    public static function checkRights(int $userId, int $customerId, int $executorId)
    {
        return $userId === $executorId;
    }
}
