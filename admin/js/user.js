document.addEventListener("DOMContentLoaded", async function () {
  console.log("helt ok!");
  getUser();
});

document.getElementById("form-user").addEventListener("submit", async function (e) {
  e.preventDefault();

  let name = document.getElementById("name").value;
  let tpNumber = document.getElementById("tp_number").value;
  let type = document.getElementById("userLevel").value;
  let password = document.getElementById("password").value;
  let rePassword = document.getElementById("rePassword").value;
  let address = document.getElementById("Address").value;

  let modalElement = document.getElementById("userAddModal");
  let modalInstance = bootstrap.Modal.getInstance(modalElement);

  if (!name || !tpNumber || !password || !rePassword || !type || !address) {
      alertMessage("All fields must be filled out!");
      
  }else if(isNaN(tpNumber)) {
      alertMessage("Telephone number must be an integer!");
      
  }else if (password !== rePassword) {
      alertMessage("Passwords do not match!");
      
  }else{

    const data = {
      name: name,
      tp_number: tpNumber,
      address :address,
      password: password,
      type: type
      
  };

  const response = await fetch("http://localhost/TheGalleryCafe/controller/addUser.php", {
      method: "POST",
      headers: {
          "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
  });

  const responseData = await response.json();
  if (responseData.status == true) {
      getUser();
      alertMessage(responseData.message);
      
      document.getElementById("form-user").reset();
  } else {
      alertMessage(responseData.message);
  }

  modalInstance.hide();
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
    console.log(el);
    if (1 == el.type) {
      userType = "Admin";
    } else if (2 == el.type) {
      userType = "Staff";
    }else{
      userType = "Client";
    }
    htmlStr += `<tr>
                     <td>${index}</td>
                     <td>${el.name}</td>
                     <td>${userType}</td>
                    <td>${el.address}</td>
                    <td>${el.tp_number}</td>
                     <td>${el.password}</td>
                     <td>
                       <button type="button" class="btn btn-primary" onclick="deleteUser(${el.id})">Delete</button>
                        <button type="button" class="btn btn-primary" onclick="editUser(${el.id}, '${el.name}','${el.type}','${el.password}','${el.tp_number}','${el.address}')">Edit</button>
                   </td>`;
  });

  tbody.innerHTML = htmlStr;
}

async function editUser(id, name, type, password,tp_number,address) {
  document.getElementById("edit-user-id").value = id;
  document.getElementById("edit-user-name").value = name;
  document.getElementById("edit-user-userLevel").value = type;
  document.getElementById("edit-user-password").value = password;
  document.getElementById("edit-user-rePassword").value = password;
  document.getElementById("edit-user-tp_number").value = tp_number;
  document.getElementById("edit-user-Address").value = address;



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
    let tp_number = document.getElementById("edit-user-tp_number").value;
    let address = document.getElementById("edit-user-Address").value ;
    
    let modalElement = document.getElementById("userEditModal");
    let modalInstance = bootstrap.Modal.getInstance(modalElement);
    if (!name || !password || !rePassword || !type || !tp_number || !address) {
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
              getUser();
              document.getElementById("form-edit-user").reset();
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
