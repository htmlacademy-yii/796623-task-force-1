<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

require_once 'src/BusinessLogic/Task.php';

use src\BusinessLogic\Task;

$customer_id = 1;
$executor_id = 2;

$task_instance = new Task($customer_id, $executor_id);

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 1);

assert($task_instance->getStatusesMap() == Task::STATUSES_MAP, 'statuses map');
assert($task_instance->getActionsMap() == Task::ACTIONS_MAP, 'actions map');
assert($task_instance->getNextStatus(Task::ACTION_COMPLETE) == Task::STATUS_COMPLETED, 'next status');
assert($task_instance->getAvailableActions(Task::STATUS_IN_WORK) == [Task::ACTION_COMPLETE, Task::ACTION_FAIL], 'available actions');

