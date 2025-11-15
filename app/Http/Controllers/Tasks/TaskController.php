<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Services\TaskService;

class TaskController extends Controller
{
    protected $taskService;
    public function __construct(TaskService $taskService){
        $this->taskService = $taskService;
    }
    public function index(): mixed{
        $tasks = $this->taskService->getAllTask();
        return view('task.index', compact('tasks'));
    }

    public function create(): mixed{
        return view('task.create');
    }

    public function store(TaskRequest $request): mixed{
        //dd($request->alL());
        $this->taskService->storeTask($request->all());
        notyf()->success('Task Saved successfully.');
        return to_route('task.index');
    }

    public function edit($id): mixed{
        $task = $this->taskService->findTask($id);
        return view('task.edit', compact('task'));
    }

    public function update(int $id, TaskRequest $request){
        $this->taskService->updateTask($id, $request->all());
         notyf()->success('Task Updated successfully.');
        return to_route('task.index');
    }

    public function destroy(int $id){
        $this->taskService->destroyTask($id);
         notyf()->success('Task deleted successfully.');
        return redirect()->back();
    }
}
