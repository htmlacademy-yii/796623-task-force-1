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

$user_id = 3;
assert(empty($task_instance->getAvailableActions(Task::STATUS_NEW, $user_id)) === true, 'unknown user + STATUS_NEW');
assert(empty($task_instance->getAvailableActions(Task::STATUS_CANCELLED, $user_id)) === true, 'unknown user + STATUS_CANCELLED');
assert(empty($task_instance->getAvailableActions(Task::STATUS_IN_WORK, $user_id)) === true, 'unknown user + STATUS_IN_WORK');
assert(empty($task_instance->getAvailableActions(Task::STATUS_COMPLETED, $user_id)) === true, 'unknown user + STATUS_COMPLETED');
assert(empty($task_instance->getAvailableActions(Task::STATUS_FAILED, $user_id)) === true, 'unknown user + STATUS_FAILED');

$user_id = $executor_id;
assert($task_instance->getAvailableActions(Task::STATUS_NEW, $user_id) === [1 => InWorkAction::class], 'executor user + STATUS_NEW');       // InWorkAction
assert(empty($task_instance->getAvailableActions(Task::STATUS_CANCELLED, $user_id)) === true, 'executor user + STATUS_CANCELLED');
assert($task_instance->getAvailableActions(Task::STATUS_IN_WORK, $user_id) === [1 => FailAction::class], 'executor user + STATUS_IN_WORK'); // FailAction
assert(empty($task_instance->getAvailableActions(Task::STATUS_COMPLETED, $user_id)) === true, 'executor user + STATUS_COMPLETED');
assert(empty($task_instance->getAvailableActions(Task::STATUS_FAILED, $user_id)) === true, 'executor user + STATUS_FAILED');

$user_id = $customer_id;
assert($task_instance->getAvailableActions(Task::STATUS_NEW, $user_id) === [0 => CancelAction::class], 'customer user + STATUS_NEW');           // CancelAction
assert(empty($task_instance->getAvailableActions(Task::STATUS_CANCELLED, $user_id)) === true, 'customer user + STATUS_CANCELLED');
assert($task_instance->getAvailableActions(Task::STATUS_IN_WORK, $user_id) === [0 => CompleteAction::class], 'customer user + STATUS_IN_WORK'); // CompleteAction
assert(empty($task_instance->getAvailableActions(Task::STATUS_COMPLETED, $user_id)) === true, 'customer user + STATUS_COMPLETED');
assert(empty($task_instance->getAvailableActions(Task::STATUS_FAILED, $user_id)) === true, 'customer user + STATUS_FAILED');
