<?php include 'partials/header.php'; ?>
<div class="content">
  <div id="alert"></div>
  <h2>Manage category</h2>
  <br>
  <br>
  <button type="button" class="btn btn-primary  " data-bs-toggle="modal" data-bs-target="#categoryAddModal">
    Add Category
  </button>
  <br>
  <div class="table-responsive">
    <table class="table table-dark table-striped table-sm">
      <thead>
        <tr>
          <th>No</th>
          <th>Category Name</th>
          <th>Food or Beverage</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="tbl-category">

      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="categoryAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form id="form-category">

          <div data-mdb-input-init class="form-outline mb-4">
            <input type="" id="category" class="form-control" />
            <label class="form-label" for="category">Category Name</label>
          </div>
          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="food_beverage">Food Type</label>
            <select name="" id="food_beverage">
              <option value="food">Food</option>
              <option value="beverage">Beverage</option>
            </select>
          </div>


          <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- CATEGORY EDIT FORM MODAL -->
<div class="modal fade" id="categoryEditModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form id="form-edit-category">
          <input type="hidden" id="edit-category-id" />
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" id="edit-category-name" class="form-control" />
            <label class="form-label" for="edit-category-name">Category Name</label>
          </div>
          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="update-food_beverage">Food Type</label>
            <select name="" id="update-food_beverage">
              <option value="food">Food</option>
              <option value="beverage">Beverage</option>
            </select>
          </div>
          <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="js/category.js"></script>
<?php include 'partials/footer.php'; ?>