@extends('layout.master')
@section('content')


    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manage Task
                    </h2>
                </div>
                    <div class="col-auto">
                    <a href="{{ route('task.create') }}" class="btn btn-primary">
                        Create New
                    </a>
                </div>

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">

                  <div class="table-responsive">
                    <table id="dataTableExample" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Task Nmae</th>
                                <th>Task Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            @forelse ($tasks as $task)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->details }}</td>
                                    <td>
                                        <a href="{{ route('task.edit', $task->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('task.destroy', $task->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                No Data Found
                            @endforelse

                        </tbody>
                    </table>
                </div>


        </div>
    </div>

@endsection
