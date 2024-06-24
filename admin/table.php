<?php include 'partials/header.php'; ?>
<div class="content">
    <div id="alert"></div>
    <h2>Manage category</h2>
    <br>

    <button type="button" class="btn btn-primary  " data-bs-toggle="modal" data-bs-target="#tableAddModel">
        Add Table
    </button>
    <br>
    <br>
    <div class="table-responsive">
        <table class="table table-dark table-striped table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Table Name</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbl-table">

            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="tableAddModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="form-table">

                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="" id="name" class="form-control" />
                        <label class="form-label" for="name">Table Name</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="" id="description" class="form-control" />
                        <label class="form-label" for="description">Description </label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="" id="quantity" class="form-control" />
                        <label class="form-label" for="quantity">Quantity </label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="file" id="image" class="form-control" />
                        <label class="form-label" for="image">Add Image </label>
                    </div>


                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="tableUpdateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Food Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="form-table-update">
                    <input type="hidden" id="update-id" />
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="update-name" class="form-control" />
                        <label class="form-label" for="update-name">Table Name</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="file" id="update-image" class="form-control" />
                        <label class="form-label" for="update-image">Add Image</label>
                    </div>
                    
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="update-description" class="form-control" />
                        <label class="form-label" for="update-description">Description</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="update-quantity" class="form-control" />
                        <label class="form-label" for="update-quantity">Quantity</label>
                    </div>
                 
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/table.js"></script>
<?php include 'partials/footer.php'; ?>