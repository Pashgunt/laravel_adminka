<?php

namespace App\ADMIN\Services;


use App\Models\Tasks;

class ToDoService
{
    public function prepareDataTasks(array $tasks): array
    {
        $prepareTasks = [];

        foreach ($tasks as $task) {
            switch ($task['status_tag_value']) {
                case Tasks::STATUS_PLANED:
                    $prepareTasks[Tasks::STATUS_PLANED][] = $task;
                    break;
                case Tasks::STATUS_PROCESS:
                    $prepareTasks[Tasks::STATUS_PROCESS][] = $task;
                    break;
                case Tasks::STATUS_SUCCESS:
                    $prepareTasks[Tasks::STATUS_SUCCESS][] = $task;
                    break;
            }
        }

        return $prepareTasks;
    }
}
