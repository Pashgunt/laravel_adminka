<?php

namespace App\ADMIN\Repositories;

use App\Models\TagsForTasks;
use App\Models\Tasks;
use Illuminate\Database\Eloquent\Collection;

class ToDoRepository
{

    public function createNewTaskItem(
        int    $userId,
        string $taskName,
        string $description,
        string $statusTagValue,
        string $imagePath
    ): int
    {
        return Tasks::create([
            'user_id' => $userId,
            'task_name' => $taskName,
            'description' => $description,
            'status_tag_value' => $statusTagValue,
            'image_path' => $imagePath
        ]);
    }

    public function compareTagsForTasks(
        int $taskId,
        int $tagId
    ): int
    {
        return TagsForTasks::create([
            'task_id' => $taskId,
            'tag_id' => $tagId
        ]);
    }

    public function getAllTasks(): Collection
    {
        return Tasks::query()
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->select('*')
            ->get();
    }

    public function getTagsValueByTaskId(int $taskId): Collection
    {
        return TagsForTasks::query()
            ->select('*')
            ->join('tags', 'tags_for_tasks.tag_id', '=', 'tags.id')
            ->where('task_id', '=', $taskId)->get();
    }

    public function changeStatusTask(int $taskId, string $statusTagValue): int
    {
        return Tasks::query()
            ->where('task_id', '=', $taskId)
            ->update([
                'status_tag_value' => $statusTagValue
            ]);
    }
}
