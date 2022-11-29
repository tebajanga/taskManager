import './bootstrap';

$(document).ready(function(){
    // Sorting tasks
    $("#tasks").sortable({
        stop: function(event, ui) {
            let sorted_tasks = $('#tasks').sortable("toArray", { attribute: 'data-id' });
            let url = $('#tasks_url').attr('url');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url + '/sort',
                method: 'post',
                data: {
                    sorted_tasks: sorted_tasks,
                },
                success: function(result){
                    // Task sorted.
                },
                error: function (data) {
                    alert('Something went wrong, please try again.');
                }
            });
        }
    });
    $("#tasks").disableSelection();

    // Displaying a modal to add new task
    $('#new-task').click(function(e){
      let selected_project_id = $('#selected_project').val();
      if (selected_project_id != "0") {
        let selected_project_name = $("#selected_project option:selected").text();
        $('#project_id').val(selected_project_id);
        $('#project_name').val(selected_project_name);
        $('#newTaskModal').modal('show');
        $('#task-success').addClass('d-none');
        $('#task-update-success').addClass('d-none');
      }
    });

    // Loading project task when user changes the project
    $('#selected_project').change(function(e){
        $('#tasks').html('');
        hideAlerts();
        let selected_project_id = $('#selected_project').val();
        if (selected_project_id != "0") {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            loadTasks(selected_project_id);
        } else {
            $('#no-tasks').removeClass('d-none');
        }
    });

    // Deleting a task
    $(document).on('click', '#deletetask', function(e){
        let task_id = $(this).attr('taskid');
        let selected_project_id = $('#selected_project').val();
        let url = $('#tasks_url').attr('url');
        if (confirm('Are you sure you want to delete this task?')) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url + '/' + task_id,
                method: 'delete',
                data: {
                    task_id: task_id,
                },
                success: function(result){
                    loadTasks(selected_project_id);
                },
                error: function (data) {
                    alert('Something went wrong, please try again.');
                }
            });
        }
    });

    // Editing a task
    $(document).on('click', '#edittask', function(e){
        let task_id = $(this).attr('taskid');
        let url = $('#tasks_url').attr('url');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url + '/' + task_id,
            method: 'get',
            data: {
                task_id: task_id,
            },
            success: function(result){
                $('#et_project_id').val(result.project_id);
                $('#et_project_name').val(result.project.code + ' - ' + result.project.name);
                $('#et_task_name').val(result.name);
                $('#et_description').val(result.description);
                $('#task_id').val(task_id);
                $('#editTaskModal').modal('show');
            },
            error: function (data) {
                alert('Something went wrong, please try again.');
            }
        });
    });

    // Loading project task
    function loadTasks(selected_project_id) {
        let url = $('#tasks_url').attr('url');
        $('#tasks').html('');
        $.ajax({
            url: url,
            method: 'get',
            data: {
            project_id: selected_project_id,
            },
            success: function(result){
                if (result && result.length > 0) {
                    $.each(result, function(index, task){
                        let task_card = `
                        <div class="card mb-4" role="button" data-id="${task.id}">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">${task.name}</h5>
                                <p class="card-text">${task.description}</p>
                                <div class="row">
                                    <div class="col text-start">
                                        <p style="color: #4e8d35; font-weight:bold; font-size: 0.8rem;">${task.created_at}</p>
                                    </div>
                                    <div class="col text-end">
                                        <button type="button" id="edittask" taskid="${task.id}" class="btn btn-outline-primary btn-sm" style="margin-right: 0.5rem;">Edit</button>
                                        <button type="button" id="deletetask" taskid="${task.id}" class="btn btn-outline-danger btn-sm">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                        $('#tasks').append(task_card);
                    });
                    $('#no-tasks').addClass('d-none');
                } else {
                    $('#no-tasks').removeClass('d-none');
                }
            },
            error: function (data) {
                $('#no-tasks').removeClass('d-none');
            }
        });
    }

    // Adding new project
    $('#addproject').click(function(e){
        let name = $('#name').val();
        let code = $('#code').val();
        let url = $('#projects_url').attr('url');
  
        e.preventDefault();
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: url,
          method: 'post',
          data: {
            name: name,
            code: code,
          },
          success: function(result){
            let option = `<option value="${result.id}" selected>${result.code} - ${result.name}</option>`;
            $('#selected_project').append(option);
            $('#selected_project option[value="${result.id}"]');
            $('#newProjectModal').modal('hide');
            $('#project-success').removeClass('d-none');
            loadTasks(result.id);
            clearProjectForm();
          },
          error: function (data) {
            clearProjectForm();
            alert('Something went wrong, please try again.');
          }
        });
    });

    // Adding new task
    $('#addtask').click(function(e){
        let project_id = $('#project_id').val();
        let name = $('#task_name').val();
        let description = $('#description').val();
        let url = $('#tasks_url').attr('url');
  
        e.preventDefault();
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: url,
          method: 'post',
          data: {
            project_id: project_id,
            name: name,
            description: description
          },
          success: function(result){
            $('#newTaskModal').modal('hide');
            $('#task-success').removeClass('d-none');
            loadTasks(project_id);
            clearTaskForm();
          },
          error: function (data) {
            clearTaskForm();
            alert('Something went wrong, please try again.');
          }
        });
    });

    // Updating a task
    $('#updatetask').click(function(e){
        let project_id = $('#et_project_id').val();
        let task_id = $('#task_id').val();
        let name = $('#et_task_name').val();
        let description = $('#et_description').val();
        let url = $('#tasks_url').attr('url');
  
        e.preventDefault();
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: url + '/' + task_id,
          method: 'put',
          data: {
            name: name,
            description: description,
          },
          success: function(result){
            $('#editTaskModal').modal('hide');
            $('#task-update-success').removeClass('d-none');
            loadTasks(project_id);
            clearTaskForm();
          },
          error: function (data) {
            clearTaskForm();
            alert('Something went wrong, please try again.');
          }
        });
    });

    function clearTaskForm() {
        $('#task_name').val('');
        $('#description').val('');
        $('#et_task_name').val('');
        $('#et_description').val('');
    }

    function clearProjectForm() {
        $('#name').val('');
        $('#code').val('');
    }

    function hideAlerts() {
        $('#project-success').addClass('d-none');
        $('#task-success').addClass('d-none');
        $('#task-update-success').addClass('d-none');
    }
});