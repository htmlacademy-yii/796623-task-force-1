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
     * @param int $userId ID пользователя
     * @param int $customerId ID заказчика
     * @param int $executorId ID исполнителя
     * @return bool Доступность действия
     */
    abstract protected static function checkRights(int $userId, int $customerId, int $executorId);
}
