@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="alert alert-success alert-dismissible fade show mb-4 d-none" role="alert" id="project-success">
                New project added successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="row mb-2">
                        <div class="col-sm-6"><h3 class="fw-bold">Project</h3></div>  
                        <div class="col-sm-6 text-end">
                            <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" 
                                data-bs-target="#newProjectModal">New Project</button>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col">
                            <select class="form-select" id="selected_project">
                                <option value="0" selected>Choose project</option>
                                @if(count($projects) > 0)
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->code }} - {{ $project->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-12 mt-4 pt-4">
                    <div class="alert alert-success alert-dismissible fade show mb-4 d-none" role="alert" id="task-success">
                        New task added successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show mb-4 d-none" role="alert" id="task-update-success">
                        Task updated successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"><h4 class="fw-bold">Tasks</h4></div>  
                        <div class="col-sm-6 text-end">
                            <button type="button" class="btn btn-outline-dark btn-sm" id="new-task">New Task</button>
                        </div>  
                    </div>
                    <hr />

                    <div class="row">
                        <div class="col" id="no-tasks">
                            <div class="alert alert-danger fade show mb-4" role="alert">
                                There are no tasks to show. Choose / Create a new project first.
                            </div>
                        </div>
                        <div class="col-md-12" id="tasks"></div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="projects_url" url="{{ url('projects') }}" />
        <input type="hidden" id="tasks_url" url="{{ url('tasks') }}" />
    </div>

    @include('modals.new_project')

    @include('modals.new_task')

    @include('modals.edit_task')
</div>
@endsection