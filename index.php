<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);


require_once 'classes/Task.php';

use classes\Task;


$customer_id = 1;
$executor_id = 2;

$task_instance = new Task($customer_id, $executor_id);


assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 1);

assert($task_instance->getMapOfTheStatuses() == Task::MAP_OF_THE_STATUSES, 'map of the statuses');
assert($task_instance->getMapOfTheActions() == Task::MAP_OF_THE_ACTIONS, 'map of the actions');
assert($task_instance->getNextStatus('action complete') == Task::STATUS_COMPLETED, 'next status');
assert($task_instance->getAvailableActions('in work') == [Task::ACTION_COMPLETE, Task::ACTION_FAIL], 'available actions');
