<?php
namespace App\Services;

use App\Interfaces\TaskRepositoryInterface;
use Illuminate\Http\Request;

class TaskService
{
    protected $taskRepository;
    public function __construct(TaskRepositoryInterface $taskRepository){
        $this->taskRepository = $taskRepository;
    }
    public function getAllTask(){
        return $this->taskRepository->all();
    }
    public function getTaskById(int $id){
        return $this->taskRepository->find($id);
    }
    public function storeTask(array $data){
        return $this->taskRepository->store($data);
    }

    public function findTask(int $id){
        return $this->taskRepository->find($id);
    }

    public function updateTask(int $id, array $data){
        return $this->taskRepository->update($id, $data);
    }
    public function destroyTask(int $id){
        return $this->taskRepository->destroy($id);
    }
}
