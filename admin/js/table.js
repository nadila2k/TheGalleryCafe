document.addEventListener("DOMContentLoaded", async function () {
  console.log("health ok!");
  getTable();
});

document
  .getElementById("form-table")
  .addEventListener("submit", async function (e) {
    e.preventDefault();

    const name = document.getElementById("name").value.trim();
    const quantity = document.getElementById("quantity").value.trim();
    const image = document.getElementById("image").files[0];
    const description = document.getElementById("description").value.trim();

    let modalElement = document.getElementById("tableAddModel");
    let modalInstance = bootstrap.Modal.getInstance(modalElement);
    modalInstance.hide();

    if (!Number.isInteger(Number(quantity))) {
      alertMessage("quantity must be a valid integer.");
    } else {
      if (!name || !quantity || !description || !image) {
        alertMessage("Text field name cannot be empty");
      } else {
        const formData = new FormData();
        formData.append("name", name);
        formData.append("quantity", quantity);
        formData.append("image", image);
        formData.append("description", description);

        const response = await fetch(
          "http://localhost/TheGalleryCafe/controller/addTable.php",
          {
            method: "POST",
            body: formData,
          }
        );

        const responseData = await response.json();

        if (responseData.status === true) {
          alertMessage(responseData.message);
          getTable();
        } else {
          alertMessage(responseData.message);
        }
      }
    }
  });

async function getTable() {
  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/getTable.php"
  );
  const data = await response.json();

  let htmlStr = "";
  let index = 0;
  let tbody = document.getElementById("tbl-table");

  data.forEach(function (el) {
    index++;
    htmlStr += `<tr>
                 <td>${index}</td>
                 <td>${el.name}</td>
                 <td>${el.qty}</td>
                 <td>${el.description}</td>
                  <td class="tbl-img"><img src="./../upload/${el.image}" alt=""></td>
                 <td>
                   <button type="button" class="btn btn-primary" onclick="deleteTable(${el.id})">Delete</button>
                     <button type="button" class="btn btn-primary" onclick="editTable(${el.id})">Edit</button>
               </td>`;
  });

  tbody.innerHTML = htmlStr;
}
async function editTable(id) {
  const response = await fetch(
    `http://localhost/TheGalleryCafe/controller/getTableById.php?id=${id}`
  );
  const data = await response.json();
  console.log(data);
  document.getElementById("update-id").value = data.id;
  document.getElementById("update-name").value = data.name;
  document.getElementById("update-quantity").value = data.quantity;
  document.getElementById("update-description").value = data.description;


  let modalElement = document.getElementById("tableUpdateModal");
  let modalInstance = new bootstrap.Modal(modalElement);
  modalInstance.show();
}

document
  .getElementById("form-table-update")
  .addEventListener("submit", async function (e) {
    e.preventDefault();

    const id = document.getElementById("update-id").value.trim();
    const name = document.getElementById("update-name").value.trim();
    const quantity = document.getElementById("update-quantity").value.trim();
    const image = document.getElementById("update-image").files[0];
    const description = document.getElementById("update-description").value.trim();

    let modalElement = document.getElementById("tableUpdateModal");
    let modalInstance = bootstrap.Modal.getInstance(modalElement);
    modalInstance.hide();

    if (!Number.isInteger(Number(quantity))) {
      alertMessage("quantity must be a valid integer.");
    } else {
      if (!name || !quantity || !description) {
        alertMessage("Text field name cannot be empty");
      } else {
        const formData = new FormData();
        formData.append("id", id);
        formData.append("name", name);
        formData.append("quantity", quantity);
        if (image) formData.append("image", image);
        formData.append("description", description);

        const response = await fetch(
          "http://localhost/TheGalleryCafe/controller/updateTable.php",
          {
            method: "POST",
            body: formData,
          }
        );

        const responseData = await response.json();
        
        if (responseData.status === true) {
          getTable();
          alertMessage(responseData.message);
        } else {
          alertMessage(responseData.message);
        }
      }
    }
  });

async function deleteTable(id) {
  const data = {
    catId: id,
  };

  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/deleteTable.php",
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
    getTable();
  } else {
    alertMessage(responseData.message);
  }
}

function alertMessage(message, timeout = 3000) {
  const alert = document.getElementById("alert");

  alert.innerHTML = `
          <div class="alert alert-success" id="alert">
              <strong>Success!</strong> ${message}.
          </div>
      `;

  setTimeout(() => {
    alert.innerHTML = "";
  }, timeout);
}
