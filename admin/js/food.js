document.addEventListener("DOMContentLoaded", async function () {
  console.log("health ok!");
  getFood();
  getCategory();
});

async function getCategory() {
  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/getCategory.php"
  );
  const data = await response.json();

  let htmlStr = "";

  let catSelect = document.getElementById("category-el");
  let updateCatSelect = document.getElementById("update-category-el");

  data.forEach(function (el) {
    htmlStr += `<option value="${el.id}">${el.name}</option>`;
  });

  catSelect.innerHTML = htmlStr;
  updateCatSelect.innerHTML = htmlStr;
}

document
  .getElementById("form-food")
  .addEventListener("submit", async function (e) {
    e.preventDefault();

    const name = document.getElementById("name").value.trim();
    const price = document.getElementById("price").value.trim();
    const category = document.getElementById("category-el").value.trim();
    const available = document.querySelector('input[name="available"]:checked');
    const image = document.getElementById("image").files[0];
    const itemtype = document.getElementById("itemtype").value.trim();

    const description = document.getElementById("description").value.trim();

    let modalElement = document.getElementById("foodAddModal");
    let modalInstance = bootstrap.Modal.getInstance(modalElement);
    modalInstance.hide();

    if (!Number.isInteger(Number(price))) {
      alertMessage("Price must be a valid integer.");
    } else {
      if (!name || !price || !category || !available || !image) {
        alertMessage("Text field name cannot be empty");
      } else {
        const formData = new FormData();
        formData.append("name", name);
        formData.append("price", price);
        formData.append("category", category);
        formData.append("available", available.value);
        formData.append("image", image);
        formData.append("itemtype", itemtype);

        formData.append("description", description);

        const response = await fetch(
          "http://localhost/TheGalleryCafe/controller/addFood.php",
          {
            method: "POST",
            body: formData,
          }
        );

        const responseData = await response.json();

        if (responseData.status === true) {
          alertMessage(responseData.message);
          getFood();
        } else {
          alertMessage(responseData.message);
        }
      }
    }
  });

async function getFood() {
  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/getFood.php"
  );
  const data = await response.json();
  console.log(data);
  let htmlStr = "";
  let index = 0;
  let tbody = document.getElementById("tbl-Food");

  data.forEach(function (el) {
    index++;
    htmlStr += `<tr>
                 <td>${index}</td>
                 <td>${el.name}</td>
                 <td>${el.category_name}</td>
                 <td>${el.type}</td>
                 <td>${el.food_or_beverage}</td>
                 <td>${el.description}</td>
                 <td>${el.price}</td>
                 <td>${el.availability}</td>
                  <td class="tbl-img"><img src="./../upload/${el.image}" alt=""></td>
                 <td>
                   <button type="button" class="btn btn-primary" onclick="deleteItem(${el.id})">Delete</button>
                     <button type="button" class="btn btn-primary" onclick="editFood(${el.id})">Edit</button>
               </td>`;
  });

  tbody.innerHTML = htmlStr;
}

async function editFood(id) {
  const response = await fetch(
    `http://localhost/TheGalleryCafe/controller/getFoodById.php?id=${id}`
  );
  const data = await response.json();
  console.log(data);
  document.getElementById("update-id").value = data.id;
  document.getElementById("update-name").value = data.name;
  document.getElementById("update-category-el").value = data.category_id;
  document.getElementById("update-itemtype").value = data.type;
  document.getElementById("update-description").value = data.description;
  document.getElementById("update-price").value = data.price;

  let modalElement = document.getElementById("foodUpdateModal");
  let modalInstance = new bootstrap.Modal(modalElement);
  modalInstance.show();
}

document
  .getElementById("form-food-update")
  .addEventListener("submit", async function (e) {
    e.preventDefault();

    const id = document.getElementById("update-id").value.trim();
    const name = document.getElementById("update-name").value.trim();
    const price = document.getElementById("update-price").value.trim();
    const category = document.getElementById("update-category-el").value.trim();
    const available = document.querySelector(
      'input[name="update-available"]:checked'
    );
    const image = document.getElementById("update-image").files[0];
    const itemtype = document.getElementById("update-itemtype").value.trim();

    const description = document
      .getElementById("update-description")
      .value.trim();

    let modalElement = document.getElementById("foodUpdateModal");
    let modalInstance = bootstrap.Modal.getInstance(modalElement);
    modalInstance.hide();

    if (!Number.isInteger(Number(price))) {
      alertMessage("Price must be a valid integer.");
    } else {
      if (!name || !price || !category || !available) {
        alertMessage("Text field name cannot be empty");
      } else {
        const formData = new FormData();
        formData.append("id", id);
        formData.append("name", name);
        formData.append("price", price);
        formData.append("category", category);
        formData.append("available", available.value);
        if (image) formData.append("image", image);
        formData.append("itemtype", itemtype);

        formData.append("description", description);

        const response = await fetch(
          "http://localhost/TheGalleryCafe/controller/updateFood.php",
          {
            method: "POST",
            body: formData,
          }
        );

        const responseData = await response.json();
        console.log(responseData);
        if (responseData.status === true) {
          getFood();
          alertMessage(responseData.message);
        } else {
          alertMessage(responseData.message);
        }
      }
    }
  });

async function deleteItem(id) {
  const data = {
    catId: id,
  };

  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/deleteFood.php",
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
    getFood();
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
