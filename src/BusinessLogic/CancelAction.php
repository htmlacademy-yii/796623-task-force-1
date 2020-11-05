<?php

namespace src\BusinessLogic;

use src\BusinessLogic\AbstractAction;

class CancelAction extends AbstractAction
{
    public function getName()
    {
        return 'Отменить';
    }

    public function getInternalName()
    {
        return 'cancel_action';
    }

    public function checkRights(int $user_id, int $customer_id, int $executor_id)
    {
        return ($user_id === $customer_id) ? true : false;
    }
}
