<?php include 'partials/header.php'; ?>

<div id="alert"></div>
<h2>Manage Food</h2>
<br>
<br>
<button type="button" class="btn btn-primary  " data-bs-toggle="modal" data-bs-target="#foodAddModal">
    Add Food
</button>
<br>
<div class="table-responsive">
    <table class="table table-dark table-striped table-sm">
        <thead>
            <tr>
                <th>No</th>
                <th>Item Name</th>
                <th>Category Name</th>
                <th>Item Type</th>
                <th>Food and Beverages</th>
                <th>Description</th>
                <th>price</th>
                <th>Availability</th>
                <th>Item Image</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody id="tbl-Food">
            
        </tbody>
    </table>
</div>
</div>


<!--CATEGORY FORM MODEL  -->
<div class="modal fade" id="foodAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="form-food">

                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="" id="name" class="form-control" />
                        <label class="form-label" for="name">Food Name</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="file" id="image" class="form-control" />
                        <label class="form-label" for="image">Add Image </label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="food">Category Name </label>
                        <select name="" id="category-el">

                        </select>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="food">Food Type </label>
                        <select name="" id="itemtype">
                        <option value="Sri lanka">Sri lanka </option>
                            <option value="italy">Italy </option>
                            <option value="france">France </option>
                            <option value="japan">Japan </option>
                            <option value="mexico">Mexico </option>
                            <option value="india">India </option>
                            <option value="thailand">Thailand </option>
                            <option value="china">China </option>

                        </select>
                        
                    </div>

                    
                        
                    
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="description" class="form-control" />
                        <label  class="form-label" for="description">Description</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="price" class="form-control" />
                        <label class="form-label" for="price">Price</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <p>Availability ?</p>
                        <input type="radio" id="availableYes" name="available" value="Yes" />
                        <label class="form-label" for="availableYes">Yes</label>
                        <input type="radio" id="availableNo" name="available" value="No" />
                        <label class="form-label" for="availableNo">No</label>
                    </div>

                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Food Modal -->
<div class="modal fade" id="foodUpdateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Food Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="form-food-update">
                    <input type="hidden" id="update-id" />
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="update-name" class="form-control" />
                        <label class="form-label" for="update-name">Food Name</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="file" id="update-image" class="form-control" />
                        <label class="form-label" for="update-image">Add Image</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="update-category">Category Name</label>
                        <select name="" id="update-category-el">
                        </select>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="update-itemtype">Food Type</label>
                        <select name="" id="update-itemtype">
                            <option value="Sri lanka">Sri lanka</option>
                            <option value="italy">Italy</option>
                            <option value="france">France</option>
                            <option value="japan">Japan</option>
                            <option value="mexico">Mexico</option>
                            <option value="india">India</option>
                            <option value="thailand">Thailand</option>
                            <option value="china">China</option>
                        </select>
                    </div>
                   
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="update-description" class="form-control" />
                        <label class="form-label" for="update-description">Description</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="update-price" class="form-control" />
                        <label class="form-label" for="update-price">Price</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <p>Availability?</p>
                        <input type="radio" id="update-availableYes" name="update-available" value="Yes" />
                        <label class="form-label" for="update-availableYes">Yes</label>
                        <input type="radio" id="update-availableNo" name="update-available" value="No" />
                        <label class="form-label" for="update-availableNo">No</label>
                    </div>
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="js/food.js"></script>
<?php include 'partials/footer.php'; ?>