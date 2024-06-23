document.addEventListener("DOMContentLoaded", async function () {
  console.log("helt ok!");
  getCategory();
});

async function getCategory() {
  const response = await fetch(
    "http://localhost/TheGalleryCafe/admin/controller/getCategory.php"
  );
  const data = await response.json();

  let htmlStr = "";
  let index = 0;
  let tbody = document.getElementById("tbl-category");

  data.forEach(function (el) {
    index++;
    htmlStr += `<tr>
               <td>${index}</td>
               <td>${el.name}</td>
               <td>
                 <button type="button" class="btn btn-primary" onclick="deleteUser(${el.id})">Delete</button>
                  <button type="button" class="btn btn-primary" onclick="editCategory(${el.id}, '${el.name}')">Edit</button>
             </td>`;
  });

  tbody.innerHTML = htmlStr;
}

function editCategory(id, name) {
  document.getElementById("edit-category-id").value = id;
  document.getElementById("edit-category-name").value = name;

  let editModal = new bootstrap.Modal(
    document.getElementById("categoryEditModal")
  );
  editModal.show();
}

document
  .getElementById("form-edit-category")
  .addEventListener("submit", async function (e) {
    e.preventDefault();

    let id = document.getElementById("edit-category-id").value;
    let name = document.getElementById("edit-category-name").value;

    let modalElement = document.getElementById("categoryEditModal");
    let modalInstance = bootstrap.Modal.getInstance(modalElement);
    if (!name) {
      alertMessage("Category name cannot be empty");
      modalInstance.hide();
    } else {
      modalInstance.hide();
      const data = {
        id: id,
        name: name,
      };

      const response = await fetch(
        "http://localhost/TheGalleryCafe/admin/controller/updateCategory.php",
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

      if (responseData.status === true) {
        alertMessage(responseData.message);
        getCategory();
      } else {
        alertMessage(responseData.message);
      }
    }
  });

async function deleteUser(id) {
  const data = {
    catId: id,
  };

  const response = await fetch(
    "http://localhost/TheGalleryCafe/admin/controller/deleteCategory.php",
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
    getCategory();
  } else {
    alertMessage(responseData.message);
  }
}

document
  .getElementById("form-category")
  .addEventListener("submit", async function (e) {
    e.preventDefault();

    let name = document.getElementById("category").value;

    let modalElement = document.getElementById("categoryAddModal");
    let modalInstance = bootstrap.Modal.getInstance(modalElement);

    if (!name) {
      alertMessage("Category name cannot be empty");
      modalInstance.hide();
    } else {
      modalInstance.hide();

      const data = {
        catName: name,
      };

      const response = await fetch(
        "http://localhost/TheGalleryCafe/admin/controller/addCategory.php",
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
        getCategory();
      } else {
        alertMessage(responseData.message);
      }
    }
  });

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
