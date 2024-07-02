document.addEventListener("DOMContentLoaded", async function () {
  console.log("health ok!");
  getReservation();
  hideContainer();
});

let itemContainer = document.getElementById("item");
let tableContainer = document.getElementById("table");

function hideContainer() {
  itemContainer.style.display = "none";
  tableContainer.style.display = "none";
}
async function getReservation() {
  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/getReservation.php"
  );
  const data = await response.json();

  let htmlStr = "";
  let index = 0;
  let status = "";
  let total = "";
  let tbody = document.getElementById("tbl-reservation");

  data.forEach(function (el) {
    index++;
    if (el.status == 0) {
        status = "Pending";
    } else if(el.status == 1) {
        status = "Confirm";
    }else if(el.status == 2){
        status = "cancel by admin";
    }else{
      status = "cancel by Client";
    }

    if (el.total == 0) {
      total = "Table";
    } else {
      total = el.total;
    }

    htmlStr += `<tr>
                   <td>${index}</td>
                   <td>${el.reservation_id}</td>
                   <td>${el.client_name}</td>
                   <td>${status}</td>
                   <td>${el.date}</td>
                   <td>${total}</td>
                   <td>`;

    if (el.status != 2) {
      htmlStr += `
          <button type="button" class="btn btn-primary" onclick="manageReservation(${el.reservation_id}, '1')">Confirm</button>
          <button type="button" class="btn btn-danger" onclick="manageReservation(${el.reservation_id}, '2')">Cancel</button>
          <button type="button" class="btn btn-info" onclick="viewReservationByID(${el.reservation_id})">View</button>`;
    }

    htmlStr += `</td></tr>`;
  });

  tbody.innerHTML = htmlStr;
}

async function manageReservation(id, status) {
  const data = {
    id: id,
    status: status,
  };

  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/manageReservation.php",
    {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    }
  );
  const responseData = await response.json();
  if (responseData.status == true) {
    alertMessage(responseData.message);
    getReservation();
  } else {
    alertMessage(responseData.message);
  }
}

async function viewReservationByID(id) {
  let reservationId = id;
  const data = {
    id: reservationId,
  };

  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/viewReservationByID.php",
    {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    }
  );
  const responseData = await response.json();
  console.log(responseData);

  let htmlStrItem = "";
  let htmlStrTable = "";
  let indexItem = 0;
  let indexTable = 0;
  let tbodyItem = document.getElementById("tbl-reservationViewItem");
  let tbodyTable = document.getElementById("tbl-reservationViewTable");

  if (
    responseData.reservationTable.length === 0 &&
    responseData.reservationItem.length > 0
  ) {
    hideContainer();
    responseData.reservationItem.forEach(function (el) {
      indexItem++;
      htmlStrItem += `<tr>
                   <td>${indexItem}</td>
                   <td>${el.item_name}</td>
                   <td>${el.cart_qty}</td>
                   <td>${el.cart_qty * el.item_price}</td>
                   <td>
                     <button type="button" class="btn btn-primary" onclick="removeItem(${
                       el.cart_item_id
                     },${
        el.total_cost - el.cart_qty * el.item_price
      },${reservationId})">Remove</button>
                   </td>
                 </tr>`;
    });

    tbodyItem.innerHTML = htmlStrItem;
    itemContainer.style.display = "block";
  } else if (
    responseData.reservationTable.length > 0 &&
    responseData.reservationItem.length === 0
  ) {
    hideContainer();
    responseData.reservationTable.forEach(function (el) {
      indexTable++;
      htmlStrTable += `<tr>
                     <td>${indexTable}</td>
                     <td>${el.table_name}</td>
                     <td>${el.table_qty}</td>
                     <td>
                       <button type="button" class="btn btn-primary" onclick="removeTable(${el.cart_table_id},${reservationId})">Remove</button>
                     </td>
                   </tr>`;
    });

    tbodyTable.innerHTML = htmlStrTable;
    tableContainer.style.display = "block";
  } else if (
    responseData.reservationTable.length > 0 &&
    responseData.reservationItem.length > 0
  ) {
    hideContainer();

    responseData.reservationItem.forEach(function (el) {
      indexItem++;
      htmlStrItem += `<tr>
                   <td>${indexItem}</td>
                   <td>${el.item_name}</td>
                   <td>${el.cart_qty}</td>
                   <td>${el.cart_qty * el.item_price}</td>
                   <td>
                    <button type="button" class="btn btn-primary" onclick="removeItem(${
                      el.cart_item_id
                    },${
        el.total_cost - el.cart_qty * el.item_price
      },${reservationId})">Remove</button>
                   </td>
                 </tr>`;
    });

    responseData.reservationTable.forEach(function (el) {
      indexTable++;
      htmlStrTable += `<tr>
                     <td>${indexTable}</td>
                     <td>${el.table_name}</td>
                     <td>${el.table_qty}</td>
                     <td>
                       <button type="button" class="btn btn-primary" onclick="removeTable(${el.cart_table_id},${reservationId})">Remove</button>
                     </td>
                   </tr>`;
    });

    tbodyItem.innerHTML = htmlStrItem;
    tbodyTable.innerHTML = htmlStrTable;
    itemContainer.style.display = "block";
    tableContainer.style.display = "block";
  }else{
    alertMessage("Cart Items Are Empty");
  }
}

async function removeItem(cartItemId, total, reservationId) {
  const data = {
    cartItemId: cartItemId,
    total: total,
    reservationId: reservationId,
  };

  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/manageReservation.php",
    {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    }
  );
  const responseData = await response.json();
  if (responseData.status == true) {
    alertMessage(responseData.message);
    getReservation();
    viewReservationByID(reservationId);
  } else {
    alertMessage(responseData.message);
  }
}

async function removeTable(tableId, reservationId) {
  const data = {
    tableId: tableId,
    reservationId: reservationId,
  };

  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/manageReservation.php",
    {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    }
  );
  const responseData = await response.json();
  if (responseData.status == true) {
    alertMessage(responseData.message);
    getReservation();
    viewReservationByID(reservationId);
  } else {
    alertMessage(responseData.message);
  }
}
function alertMessage(message, timeout = 3000) {
  const alert = document.getElementById("alert");

  alert.innerHTML = `
            <div class="alert alert-success" id="alert">
                <strong>${message}</strong> 
            </div>
        `;

  setTimeout(() => {
    alert.innerHTML = "";
  }, timeout);
}
