<?php

namespace src\BusinessLogic;

use src\BusinessLogic\{CompleteAction, FailAction, InWorkAction, CancelAction};

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_IN_WORK = 'inWork';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';

    const ACTION_CANCEL = CancelAction::class;
    const ACTION_IN_WORK = InWorkAction::class;
    const ACTION_COMPLETE = CompleteAction::class;
    const ACTION_FAIL = FailAction::class;

    const STATUSES_MAP = [
        self::STATUS_NEW => 'новое',
        self::STATUS_CANCELLED => 'отменено',
        self::STATUS_IN_WORK => 'в работе',
        self::STATUS_COMPLETED => 'выполнено',
        self::STATUS_FAILED => 'провалено',
    ];
    const ACTIONS_MAP = [
        self::ACTION_CANCEL => 'отменить',
        self::ACTION_IN_WORK => 'откликнуться',
        self::ACTION_COMPLETE => 'выполнено',
        self::ACTION_FAIL => 'отказаться',
    ];
    const NEXT_STATUS_MAP = [
        self::ACTION_CANCEL => self::STATUS_CANCELLED,
        self::ACTION_IN_WORK => self::STATUS_IN_WORK,
        self::ACTION_COMPLETE => self::STATUS_COMPLETED,
        self::ACTION_FAIL => self::STATUS_FAILED,
    ];
    const AVAILABLE_ACTIONS_MAP = [
        self::STATUS_NEW => [self::ACTION_CANCEL, self::ACTION_IN_WORK],
        self::STATUS_IN_WORK => [self::ACTION_COMPLETE, self::ACTION_FAIL],
    ];

    private $customerId; //заказчик
    private $executorId; //исполнитель

    public function __construct(int $customerId, int $executorId)
    {
        $this->customerId = $customerId;
        $this->executorId = $executorId;
    }

    /** @return array */
    public function getStatusesMap(): array
    {
        return self::STATUSES_MAP;
    }

    /** @return array */
    public function getActionsMap(): array
    {
        return self::ACTIONS_MAP;
    }

    /**
     * @param string $action
     * @return string
     */
    public function getNextStatus(string $action): ?string
    {
        return self::NEXT_STATUS_MAP[$action] ?? null;
    }

    /**
     * @param string $status
     * @param int $userId
     * @return array
     */
    public function getAvailableActions(string $status, int $userId): ?array
    {
        if (!isset(self::AVAILABLE_ACTIONS_MAP[$status])) {
            return null;
        }

        return array_filter(self::AVAILABLE_ACTIONS_MAP[$status], function ($action) use ($userId) {
            return $action::checkRights($userId, $this->customerId, $this->executorId);
        });
    }

}
