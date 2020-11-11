<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

require_once 'vendor/autoload.php';

use src\BusinessLogic\{Task, CompleteAction, FailAction, InWorkAction, CancelAction};

$customer_id = 1;
$executor_id = 2;

$task_instance = new Task($customer_id, $executor_id);

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 1);

assert($task_instance->getStatusesMap() == Task::STATUSES_MAP, 'statuses map');
assert($task_instance->getActionsMap() == Task::ACTIONS_MAP, 'actions map');
assert($task_instance->getNextStatus(Task::ACTION_COMPLETE) == Task::STATUS_COMPLETED, 'next status');
//assert($task_instance->getAvailableActions(Task::STATUS_IN_WORK) == [Task::ACTION_COMPLETE, Task::ACTION_FAIL], 'available actions');

$user_id = 3;
assert($task_instance->getAvailableActions(Task::STATUS_NEW, $user_id) === null, 'unknown user + STATUS_NEW');
assert($task_instance->getAvailableActions(Task::STATUS_CANCELLED, $user_id) === null, 'unknown user + STATUS_CANCELLED');
assert($task_instance->getAvailableActions(Task::STATUS_IN_WORK, $user_id) === null, 'unknown user + STATUS_IN_WORK');
assert($task_instance->getAvailableActions(Task::STATUS_COMPLETED, $user_id) === null, 'unknown user + STATUS_COMPLETED');
assert($task_instance->getAvailableActions(Task::STATUS_FAILED, $user_id) === null, 'unknown user + STATUS_FAILED');

$user_id = $executor_id;
assert($task_instance->getAvailableActions(Task::STATUS_NEW, $user_id) instanceof InWorkAction, 'executor user + STATUS_NEW');       // InWorkAction
assert($task_instance->getAvailableActions(Task::STATUS_CANCELLED, $user_id) === null, 'executor user + STATUS_CANCELLED');
assert($task_instance->getAvailableActions(Task::STATUS_IN_WORK, $user_id) instanceof FailAction, 'executor user + STATUS_IN_WORK'); // FailAction
assert($task_instance->getAvailableActions(Task::STATUS_COMPLETED, $user_id) === null, 'executor user + STATUS_COMPLETED');
assert($task_instance->getAvailableActions(Task::STATUS_FAILED, $user_id) === null, 'executor user + STATUS_FAILED');

$user_id = $customer_id;
assert($task_instance->getAvailableActions(Task::STATUS_NEW, $user_id) instanceof CancelAction, 'customer user + STATUS_NEW');           // CancelAction
assert($task_instance->getAvailableActions(Task::STATUS_CANCELLED, $user_id) === null, 'customer user + STATUS_CANCELLED');
assert($task_instance->getAvailableActions(Task::STATUS_IN_WORK, $user_id) instanceof CompleteAction, 'customer user + STATUS_IN_WORK'); // CompleteAction
assert($task_instance->getAvailableActions(Task::STATUS_COMPLETED, $user_id) === null, 'customer user + STATUS_COMPLETED');
assert($task_instance->getAvailableActions(Task::STATUS_FAILED, $user_id) === null, 'customer user + STATUS_FAILED');

echo 'it is work';
