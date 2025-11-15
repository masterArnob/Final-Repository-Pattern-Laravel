<?php
namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function all(): mixed{
        return Task::orderBy('id', 'DESC')->get();
    }
    public function find(int $id): mixed{
        return Task::find($id);
    }
    public function store(array $data): mixed{
        return Task::create($data);
    }
    public function update(int $id, array $data){
        $task = Task::find($id);
        if($task){
            return $task->update($data);
        }
    }
    public function destroy(int $id){
        $task = Task::find($id);
        if($task){
            return $task->delete();
        }
    }
}
