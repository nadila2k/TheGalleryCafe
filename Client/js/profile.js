document.addEventListener("DOMContentLoaded", async function () {
  console.log("health ok!");
  getUserData();
  getUserReservationData();
  hideContainer();
});

let itemContainer = document.getElementById("item");
let tableContainer = document.getElementById("table");

function hideContainer() {
  itemContainer.style.display = "none";
  tableContainer.style.display = "none";
}

async function getUserData() {
  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/getUserData.php"
  );
  const data = await response.json();
  console.log(data)
  document.getElementById('userId').value = data.id;
  document.getElementById('type').value = data.type;
    document.getElementById('inputUsername').value = data.name;
    document.getElementById('tp_number').value = data.tp_number;
    document.getElementById('address').value = data.address;
    document.getElementById('password').value = data.password;

  
}


document
  .getElementById("form-edit-user")
  .addEventListener("submit", async function (e) {
    e.preventDefault();

    let id = document.getElementById("userId").value;
    let name = document.getElementById("inputUsername").value;
    let type = document.getElementById("type").value;
    let password = document.getElementById("password").value;
    let tp_number = document.getElementById("tp_number").value;
    let address = document.getElementById("address").value ;
    
   
    if (!name || !password || !type || !tp_number || !address) {
        alertMessage(" All fields must be filled out !");
       
    } else {
        
        const data = {
            id: id,
          name: name,
          password: password,
          type: type,
          tp_number: tp_number,
          address :address
        };
        console.log(data);
        const response = await fetch(
          "http://localhost/TheGalleryCafe/controller/updateUser.php",
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
            getUserData();
         
          alertMessage(responseData.message);
        } else {
          alertMessage(responseData.message);
        }
    
            
    }

  });

  async function getUserReservationData() {
    const response = await fetch(
      "http://localhost/TheGalleryCafe/controller/getUserReservationData.php"
    );
    const data = await response.json();
    console.log(data);
  
    let htmlStr = "";
    let index = 0;
    let status = "";
    let tbody = document.getElementById("tbl-table");
  
    data.forEach(function (el) {
      index++;
      if (el.status == 0) {
        status = "Pending";
      } else if (el.status == 1) {
        status = "Confirm";
      } else if (el.status == 2) {
        status = "Cancel by admin";
      } else if (el.status == 3) {
        status = "Cancel";
      }
  
      htmlStr += `<tr>
                   <td>${index}</td>
                   <td>${el.id}</td>
                   <td>${status}</td>
                   <td>${el.date}</td>
                   <td>RS.${el.total}.00</td>
                   <td>`;
  
      // Conditionally add buttons based on status
      if (el.status != 2 && el.status != 3) {
        htmlStr += `
                     <button type="button" class="btn btn-primary" onclick="cancelReservation(${el.id})">Cancel</button>
                     <button type="button" class="btn btn-primary" onclick="viewReservationByID(${el.id})">View</button>`;
      }
  
      htmlStr += `</td></tr>`;
    });
  
    tbody.innerHTML = htmlStr;
  }
  


async function cancelReservation(id) {
    const data = {
      id: id,
      status: "3"
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
      getUserReservationData();
      
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
  