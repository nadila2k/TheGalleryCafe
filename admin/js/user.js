document.addEventListener("DOMContentLoaded", async function () {
  console.log("helt ok!");
  getUser();
});

document
  .getElementById("form-user")
  .addEventListener("submit", async function (e) {
    e.preventDefault();

    let name = document.getElementById("name").value;
    let type = document.getElementById("userLevel").value;
    let password = document.getElementById("password").value;
    let rePassword = document.getElementById("rePassword").value;

    let modalElement = document.getElementById("userAddModal");
    let modalInstance = bootstrap.Modal.getInstance(modalElement);

    if (!name || !password || !rePassword || !type) {
      alertMessage(" All fields must be filled out !");
      modalInstance.hide();
    } else {
      if (password !== rePassword) {
        alertMessage(" Passwords do not match !");
        modalInstance.hide();
      } else {
        modalInstance.hide();

        const data = {
          name: name,
          password: password,
          type: type,
        };
        console.log(data);
        const response = await fetch(
          "http://localhost/TheGalleryCafe/controller/addUser.php",
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
          getUser();
          alertMessage(responseData.message);
        } else {
          alertMessage(responseData.message);
        }
      }
    }
  });

document
  .getElementById("togglePassword")
  .addEventListener("click", function (e) {
    const password = document.getElementById("password");

    const type =
      password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);

    this.classList.toggle("fa-eye");
    this.classList.toggle("fa-eye-slash");
  });
async function getUser() {
  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/getUser.php"
  );
  const data = await response.json();

  let htmlStr = "";
  let index = 0;
  let userType = " ";
  let tbody = document.getElementById("tbl-user");

  data.forEach(function (el) {
    index++;
    if (1 == el.type) {
      userType = "Admin";
    } else {
      userType = "Staff";
    }
    htmlStr += `<tr>
                     <td>${index}</td>
                     <td>${el.name}</td>
                     <td>${userType}</td>
                     <td>${el.password}</td>
                     <td>
                       <button type="button" class="btn btn-primary" onclick="deleteUser(${el.id})">Delete</button>
                        <button type="button" class="btn btn-primary" onclick="editUser(${el.id}, '${el.name}','${el.type}','${el.password}')">Edit</button>
                   </td>`;
  });

  tbody.innerHTML = htmlStr;
}

async function editUser(id, name, type, password) {
  document.getElementById("edit-user-id").value = id;
  document.getElementById("edit-user-name").value = name;
  document.getElementById("edit-user-userLevel").value = type;
  document.getElementById("edit-user-password").value = password;
  document.getElementById("edit-user-rePassword").value = password;



  let editModal = new bootstrap.Modal(document.getElementById("userEditModal"));
  editModal.show();
}

document
  .getElementById("form-edit-user")
  .addEventListener("submit", async function (e) {
    e.preventDefault();

    let id = document.getElementById("edit-user-id").value;
    let name = document.getElementById("edit-user-name").value;
    let type = document.getElementById("edit-user-userLevel").value;
    let password = document.getElementById("edit-user-password").value;
    let rePassword = document.getElementById("edit-user-rePassword").value; 
    
    let modalElement = document.getElementById("userEditModal");
    let modalInstance = bootstrap.Modal.getInstance(modalElement);
    if (!name || !password || !rePassword || !type) {
        alertMessage(" All fields must be filled out !");
        modalInstance.hide();
    } else {
        if (password !== rePassword) {
            alertMessage(" Passwords do not match !");
            modalInstance.hide();
          } else {
            modalInstance.hide();
    
            const data = {
                id: id,
              name: name,
              password: password,
              type: type,
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
              getUser();
              alertMessage(responseData.message);
            } else {
              alertMessage(responseData.message);
            }
    }
}
  });
async function deleteUser(id) {
  const data = {
    id: id,
  };

  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/deleteUser.php",
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
    getUser();
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
