<?php include 'partials/header.php'; ?>

<div id="alert"></div>
<div class="content">

    <div class="wrapper">
        <h1>Manage Food</h1>
        <br>
        <button type="button" class="btn btn-primary  " data-bs-toggle="modal" data-bs-target="#foodAddModal">
            Add Food
        </button>

        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>No</th>
                <th>Food Name</th>
                <th>Image</th>
                <th>Category</th>
                <th>Price</th>
                <th>Availability</th>
                <th>Action</th>
            </tr>
            <tbody id="tbl-category">
                <td>No</td>
                <td>Food Name</td>
                <td class="tbl-img"><img src="../assets/image/pizza.jpg" alt=""></td>
                <td>Category</td>
                <td>Price</td>
                <td>Availability</td>
                <td>Action</td>
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
                        <label class="form-label" for="food">Food Name </label>
                        <select name="" id="category-el">
                            
                        </select>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="" id="price" class="form-control" />
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
<script src="js/food.js"></script>
<?php include 'partials/footer.php'; ?>