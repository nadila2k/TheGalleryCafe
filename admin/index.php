<?php include 'partials/header.php';?>
<div class="content">
    <div id="alert"></div>
    <h2>Manage Reservation</h2>
    <br>
    <div class="table-responsive">
        <table class="table table-dark table-striped table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Reservation No</th>
                    <th>Client Name</th>
                    <th>Status</th>
                    <th>Reservation Date</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbl-reservation">

            </tbody>
        </table>
    </div>
</div>
<br>
<br>
<br>
<div class="container" id="item">
    <h2>Reservation Items</h2>
    <br>
    <div class="table-responsive">
        <table class="table table-dark table-striped table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Reservation Item Name</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbl-reservationViewItem">

            </tbody>
        </table>
    </div>
</div>
<div class="container" id="table">
    <h2>Reservation Tables</h2>
    <br>
    <div class="table-responsive">
        <table class="table table-dark table-striped table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Reservation table Name</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbl-reservationViewTable">

            </tbody>
        </table>
    </div>
</div>





<script src="js/index.js"></script> 
<?php include 'partials/footer.php';?>