<div class="modal fade" id="newTaskModal" tabindex="-1" aria-labelledby="newTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="newTaskModal"><strong>Create New Task</strong></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form>
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Project Name</label>
            <input type="hidden" class="form-control" id="project_id">
            <input type="text" class="form-control" id="project_name" disabled>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Task Name</label>
            <input type="text" class="form-control" id="task_name" required>
          </div>
          <div class="mb-3">
            <label for="code" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="addtask" class="btn btn-primary">Add Task</button>
        </div>
      </form>
    </div>
  </div>
</div>