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

    const ACTION_CANCEL = 'CancelAction';
    const ACTION_IN_WORK = 'InWorkAction';
    const ACTION_COMPLETE = 'CompleteAction';
    const ACTION_FAIL = 'FailAction';

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
//    const AVAILABLE_ACTIONS_MAP = [
//        self::STATUS_NEW => [self::ACTION_CANCEL, self::ACTION_IN_WORK],
//        self::STATUS_IN_WORK => [self::ACTION_COMPLETE, self::ACTION_FAIL],
//    ];


    private $customer_id; //заказчик
    private $executor_id; //исполнитель

    private $cancel_action;
    private $in_work_action;
    private $complete_action;
    private $fail_action;

    private $available_actions_map;

    public function __construct(int $customer_id, int $executor_id)
    {
        $this->customer_id = $customer_id;
        $this->executor_id = $executor_id;

        $this->cancel_action   = new CancelAction;
        $this->in_work_action  = new InWorkAction;
        $this->complete_action = new CompleteAction;
        $this->fail_action     = new FailAction;

        $this->available_actions_map = [
            self::STATUS_NEW => [$this->cancel_action, $this->in_work_action],
            self::STATUS_IN_WORK => [$this->complete_action, $this->fail_action],
        ];
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

//    /**
//     * @param string $status
//     * @return array
//     */
//    public function getAvailableActions(string $status): ?array
//    {
//        return self::AVAILABLE_ACTIONS_MAP[$status] ?? null;
//    }

    /**
     * @param string $status
     * @param int $user_id
     * @return AbstractAction
     */
    public function getAvailableActions(string $status, int $user_id): ?AbstractAction
    {
        if (isset($this->available_actions_map[$status]) && is_array($this->available_actions_map[$status])) {
            foreach ($this->available_actions_map[$status] as $action_object) {
                if ($action_object->checkRights($user_id, $this->customer_id, $this->executor_id)) {
                    return $action_object;
                }
            }
        }

        return null;
    }

}
