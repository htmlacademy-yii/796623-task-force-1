<?php


namespace classes;


class Task
{

    const STATUS_NEW = 'new';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_IN_WORK = 'in work';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';

    const ACTION_CANCEL = 'action cancel';
    const ACTION_IN_WORK = 'action in work';
    const ACTION_COMPLETE = 'action complete';
    const ACTION_FAIL = 'action fail';

    const MAP_OF_THE_STATUSES = [
        'new' => 'новое',
        'cancelled' => 'отменено',
        'in work' => 'в работе',
        'completed' => 'выполнено',
        'failed' => 'провалено'
    ];

    const MAP_OF_THE_ACTIONS = [
        'action cancel' => 'отменить',
        'action in work' => 'откликнуться',
        'action complete' => 'выполнено',
        'action fail' => 'отказаться'
    ];


    private $customer_id; //заказчик
    private $executor_id; //исполнитель



    public function __construct(int $customer_id, int $executor_id)
    {
        $this->customer_id = $customer_id;
        $this->executor_id = $executor_id;
    }


    public function getMapOfTheStatuses()
    {
        return self::MAP_OF_THE_STATUSES;
    }


    public function getMapOfTheActions()
    {
        return self::MAP_OF_THE_ACTIONS;
    }


    public function getNextStatus(string $action)
    {
        switch ($action) {
            case self::ACTION_CANCEL:
                return self::STATUS_CANCELLED;
            case self::ACTION_IN_WORK:
                return self::STATUS_IN_WORK;
            case self::ACTION_COMPLETE:
                return self::STATUS_COMPLETED;
            case self::ACTION_FAIL:
                return self::STATUS_FAILED;
            default:
                return false;
        }
    }


    public function getAvailableActions(string $status)
    {
        switch ($status) {
            case self::STATUS_NEW:
                return [self::ACTION_CANCEL, self::ACTION_IN_WORK];
            case self::STATUS_IN_WORK:
                return [self::ACTION_COMPLETE, self::ACTION_FAIL];
            case self::STATUS_CANCELLED:
            case self::STATUS_COMPLETED:
            case self::STATUS_FAILED:
                return [];
            default:
                return false;
        }
    }






}
