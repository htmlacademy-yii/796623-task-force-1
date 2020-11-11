<?php

namespace src\BusinessLogic;

use src\BusinessLogic\AbstractAction;

class FailAction extends AbstractAction
{
    public function getName()
    {
        return 'Отказаться';
    }

    public function getInternalName()
    {
        return 'FailAction';
    }

    public static function checkRights(int $userId, int $customerId, int $executorId)
    {
        return $userId === $executorId;
    }
}
