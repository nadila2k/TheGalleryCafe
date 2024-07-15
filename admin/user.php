<?php include 'partials/header.php'; ?>
<div class="content">
    <div id="alert"></div>
    <h2>Manage Users</h2>
    <br>
    <br>
    <button type="button" class="btn btn-primary  " data-bs-toggle="modal" data-bs-target="#userAddModal">
        Add user
    </button>
    <br>
    <div class="table-responsive">
        <table class="table table-dark table-striped table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User Name</th>
                    <th>User Type</th>
                    <th>Password</th>
                    <th>tel-Number</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbl-user">

            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="userAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="form-user">

                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="" id="name" class="form-control" />
                        <label class="form-label" for="name">User Name</label>
                    </div>
                    
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="" id="tp_number" class="form-control" />
                        <label class="form-label" for="tp_number">tel-Number</label>
                    </div>
                    
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="" id="Address" class="form-control" />
                        <label class="form-label" for="Address">Address</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="userLevel">User Type</label>
                        <select name="" id="userLevel">
                            <option value="1">Admin</option>
                            <option value="2">Staff</option>
                        </select>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="password" id="password" class="form-control" />
                        <label class="form-label" for="password">Password</label>
                        <span id="togglePassword" class="fa fa-fw fa-eye field-icon"></span>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="password" id="rePassword" class="form-control" />
                        <label class="form-label" for="rePassword">Re-Enter Password</label>
                        
                    </div>



                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- CATEGORY EDIT FORM MODAL -->
<div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="form-edit-user">
                    <input type="hidden" id="edit-user-id" />
                
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="" id="edit-user-name" class="form-control" />
                        <label class="form-label" for="name">User Name</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="" id="edit-user-tp_number" class="form-control" />
                        <label class="form-label" for="to_number">tel-Number</label>
                    </div>
                    
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="" id="edit-user-Address" class="form-control" />
                        <label class="form-label" for="Address">Address</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="edit-user-userLevel">User Type</label>
                        <select name="" id="edit-user-userLevel">
                            <option value="1">Admin</option>
                            <option value="2">Staff</option>
                        </select>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="password" id="edit-user-password" class="form-control" />
                        <label class="form-label" for="password">Password</label>
                        <span id="togglePassword" class="fa fa-fw fa-eye field-icon"></span>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="password" id="edit-user-rePassword" class="form-control" />
                        <label class="form-label" for="rePassword">Re-Enter Password</label>
                        
                    </div>

                    
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/user.js"></script>
<?php include 'partials/footer.php'; ?>