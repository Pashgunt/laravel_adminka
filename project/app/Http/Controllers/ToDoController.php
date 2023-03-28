<?php

namespace App\Http\Controllers;

use App\ADMIN\Repositories\ToDoRepository;
use App\ADMIN\Services\ToDoService;
use App\Http\Requests\ChangeStatusValidateRequest;
use App\Http\Requests\ToDoRequest;
use App\Models\Tasks;
use Illuminate\Http\Request;
use App\ADMIN\Repositories\TagsRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ToDoController extends Controller
{

    private TagsRepository $tagsRepository;
    private ToDoRepository $toDoRepository;
    private ToDoService $toDoService;

    public function __construct()
    {
        $this->tagsRepository = new TagsRepository();
        $this->toDoRepository = new ToDoRepository();
        $this->toDoService = new ToDoService();
    }

    public function createItem(ToDoRequest $request)
    {
        $validated = $request->validated();

        if (array_key_exists('error', $validated)) {
            $this->makeEchoSolution($validated);
            exit();
        }

        $taskTags = json_decode($validated['task_tags'], true);

        $path = $request->file('task_image')->store('uploads', 'public');

        $userId = Auth::user()->id;

        $taskId = $this->toDoRepository->createNewTaskItem(
            $userId,
            $validated['task_name'],
            $validated['task_description'],
            Tasks::STATUS_PLANED,
            $path
        )->id;

        if (!empty($taskTags)) {
            foreach ($taskTags as $tag) {
                $tagId = $this->tagsRepository->getTagIdByTagName($tag)->all()[0]['id'];
                $this->toDoRepository->compareTagsForTasks($taskId, $tagId);
            }
        }

        $data = [
            'result' => 'ok'
        ];

        $this->makeEchoSolution($data);
    }

    public function checkIssetTagItem(Request $request)
    {
        $tagItems = [];
        foreach ($this->tagsRepository->checkIssetTag($request['tags'])->all() as $item) {
            $tagItems[$item['id']] = $item['tag_value'];
        }

        $this->makeEchoSolution($tagItems);
    }

    public function addNewTagItem(Request $request)
    {
        $data = [
            'id' => $this->tagsRepository->addNewTagItem($request['tag'])
        ];
        $this->makeEchoSolution($data);
    }

    public function getAllTasks(): View
    {
        $tasks = $this->toDoRepository->getAllTasks()->all();
        foreach ($tasks as $key => $task) {
            $tags = $this->toDoRepository->getTagsValueByTaskId($task['task_id'])->all();
            $tasks[$key]['tags'] = $tags;
        }

        return view('index')->with('tasks', $this->toDoService->prepareDataTasks($tasks));
    }

    public function finishProcessTask(ChangeStatusValidateRequest $request)
    {
        $validated = $request->validated();

        $result = $this->toDoRepository->changeStatusTask($validated['task_id'], Tasks::STATUS_SUCCESS);

        if ($result) {
            $data = [
                'result' => 'ok'
            ];
            $this->makeEchoSolution($data);
        }
    }

    public function startProcessTask(ChangeStatusValidateRequest $request)
    {
        $validated = $request->validated();

        $result = $this->toDoRepository->changeStatusTask($validated['task_id'], Tasks::STATUS_PROCESS);

        if ($result) {
            $data = [
                'result' => 'ok'
            ];
            $this->makeEchoSolution($data);
        }
    }
}
