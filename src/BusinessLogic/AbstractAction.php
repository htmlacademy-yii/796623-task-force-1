<?php

namespace src\BusinessLogic;

abstract class AbstractAction
{
    /**
     * @return string Название действия
     */
    abstract protected function getName();

    /**
     * @return string Внутреннее имя действия
     */
    abstract protected function getInternalName();

    /**
     * @param int $user_id ID пользователя
     * @param int $customer_id ID заказчика
     * @param int $executor_id ID исполнителя
     * @return bool Доступность действия
     */
    abstract protected function checkRights(int $user_id, int $customer_id, int $executor_id);
}
