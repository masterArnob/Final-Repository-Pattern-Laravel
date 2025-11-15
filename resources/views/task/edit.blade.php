@extends('layout.master')
@section('content')


    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Overview
                    </div>
                    <h2 class="page-title">
                        Combo layout
                    </h2>
                </div>

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">



            <!-- password info -->
            <form action="{{ route('task.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card mt-4">
                    <div class="row g-0">

                        <div class="col-12 d-flex flex-column">
                            <div class="card-body">
                                <h3 class="card-title">Edit Task Details</h3>

                                <div class="row g-3">
                                    <div class="col-md">
                                        <div class="form-label">Task Name</div>
                                        <input type="text" class="form-control" name="name" value="{{ $task->name }}">
                                    </div>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                  <div class="row g-3">
                                    <div class="col-md">
                                        <div class="form-label">Task Details</div>
                                        <input type="text" class="form-control" name="details" value="{{ $task->details }}">
                                    </div>
                                       @error('details')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div>

                                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                                </div>



                            </div>

                        </div>
                    </div>
                </div>
            </form>

            <!-- password info -->
        </div>
    </div>

@endsection
