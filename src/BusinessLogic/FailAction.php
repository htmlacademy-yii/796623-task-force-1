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
        return 'fail_action';
    }

    public function checkRights(int $user_id, int $customer_id, int $executor_id)
    {
        return ($user_id === $executor_id) ? true : false;
    }
}
