### Repository Pattern:
**Saperate Database Logic(Queries. Models) From Business Logic(Controller, Services)**
### Benifit of Repository Pattern:
1. Controller Become Short.
2. We Can Use Same Repository In Multiple Place.
### Without Repository:
1. **Problem 1: ** If I Need Users In 5 Controller Then I Have To Call User Model 5 Times In Different Place. If I Use Repository Pattern Then I Just Have To Create 1 Repository & Implement It In 5 Controller.
2. **Problem 2: ** If I Try To Switch Database From Mysql To MongoDb Then I Have To CHange All The Controller But With Repository Pattern Then I Have To Only CHange 1 File. 

### Repository Pattern Steps:
**1. Make Repository Interface: Contains the methods that are going to be used in Interface Repository**
```php
<?php

namespace App\Interfaces;

interface TaskRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function store(array $data);
    public function update(int $id, array $data);
    public function destroy(int $id);
}

```
**2. Make Repository: Handles the db operations**
```php
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

```
**3. Make Service Provider: Bind Repository Interface + Repository**
```php
<?php

namespace App\Providers;

use App\Interfaces\TaskRepositoryInterface;
use App\Repositories\TaskRepository;
use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            TaskRepositoryInterface::class,
            TaskRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

```
**4. Make Service: Business Logice Layer**
```php
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
    public function getAllTask(): mixed{
        return $this->taskRepository->all();
    }
    public function getTaskById(int $id): mixed{
        return $this->taskRepository->find($id);
    }
    public function storeTask(array $data): mixed{
        return $this->taskRepository->store($data);
    }

    public function findTask(int $id): mixed{
        return $this->taskRepository->find($id);
    }

    public function updateTask(int $id, array $data): mixed{
        return $this->taskRepository->update($id, $data);
    }
    public function destroyTask(int $id): mixed{
        return $this->taskRepository->destroy($id);
    }
}

```
**5. Make Controller: Handles User Request**
```php
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

```

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
