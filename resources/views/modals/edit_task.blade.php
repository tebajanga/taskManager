<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editTaskModal"><strong>Editing Task</strong></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form>
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Project Name</label>
            <input type="hidden" class="form-control" id="et_project_id">
            <input type="text" class="form-control" id="et_project_name" disabled>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Task Name</label>
            <input type="text" class="form-control" id="et_task_name" required>
          </div>
          <div class="mb-3">
            <label for="code" class="form-label">Description</label>
            <input type="text" class="form-control" id="et_description" required>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" class="form-control" id="task_id">
          <button type="submit" id="updatetask" class="btn btn-primary">Update Task</button>
        </div>
      </form>
    </div>
  </div>
</div>