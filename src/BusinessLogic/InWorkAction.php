<?php

namespace src\BusinessLogic;

use src\BusinessLogic\AbstractAction;

class InWorkAction extends AbstractAction
{
    public function getName()
    {
        return 'Откликнуться';
    }

    public function getInternalName()
    {
        return 'in_work_action';
    }

    public function checkRights(int $user_id, int $customer_id, int $executor_id)
    {
        return ($user_id === $executor_id) ? true : false;
    }
}
