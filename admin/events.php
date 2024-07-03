<?php include 'partials/header.php'; ?>
<div class="content">
    <div id="alert"></div>
    <h2>Manage event</h2>
    <br>

    <button type="button" class="btn btn-primary  " data-bs-toggle="modal" data-bs-target="#eventAddModal">
        Add Event
    </button>
    <br>
    <br>
    <div class="table-responsive">
        <table class="table table-dark table-striped table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Event Name</th>
                    <th>price</th>
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

<div class="modal fade" id="eventAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="event-table">
                
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="" id="name" class="form-control" />
                        <label class="form-label" for="name">Event Name</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="" id="description" class="form-control" />
                        <label class="form-label" for="description">Description </label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="" id="price" class="form-control" />
                        <label class="form-label" for="price">price </label>
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


<div class="modal fade" id="eventEditModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="edit-event-form">
                <input type="hidden" id="edit-id" />
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="hidden" id="edit-id" class="form-control" />
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="edit-name" class="form-control" />
                        <label class="form-label" for="edit-name">Event Name</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="edit-description" class="form-control" />
                        <label class="form-label" for="edit-description">Description</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="edit-price" class="form-control" />
                        <label class="form-label" for="edit-price">Price</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="file" id="edit-image" class="form-control" />
                        <label class="form-label" for="edit-image">Add Image</label>
                    </div>

                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="js/event.js"></script>
<?php include 'partials/footer.php'; ?>