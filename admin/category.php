<?php include 'partials/header.php'; ?>
<div id="alert"></div>
<div class="content">

    <div class="wrapper">
        <h1>Manage category</h1>
        <br>
        <button type="button" class="btn btn-primary  " data-bs-toggle="modal" data-bs-target="#categoryAddModal">
      Add Category
    </button>
       
        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>No</th>
                <th>Category Name</th>
                <th>Action</th>
            </tr>
            <tbody id="tbl-category">
          
            </tbody>
        </table>

    </div>
</div>

<!--CATEGORY FORM MODEL  -->
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
          <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="js/category.js"></script>
<?php include 'partials/footer.php'; ?>