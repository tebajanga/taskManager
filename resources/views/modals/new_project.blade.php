<div class="modal fade" id="newProjectModal" tabindex="-1" aria-labelledby="newProjectModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="newProjectModal"><strong>Create New Project</strong></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form>
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Project Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="code" class="form-label">Project Code</label>
            <input type="text" class="form-control" id="code" name="code" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="addproject" class="btn btn-primary">Add Project</button>
        </div>
      </form>
    </div>
  </div>
</div>