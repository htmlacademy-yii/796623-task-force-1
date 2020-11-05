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
        return 'complete_action';
    }

    public function checkRights(int $user_id, int $customer_id, int $executor_id)
    {
        return ($user_id === $customer_id) ? true : false;
    }
}
