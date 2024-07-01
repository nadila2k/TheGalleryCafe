document.addEventListener("DOMContentLoaded", async function () {
  const message = localStorage.getItem('alertMessage');
  if (message) {
    alertMessage(message);
    localStorage.removeItem('alertMessage');
  }


});


document.getElementById("form-login").addEventListener("submit", async function (e) {
  e.preventDefault();

  let userName = document.getElementById("userName").value;
  let password = document.getElementById("password").value;

  const data = {
    UserName: userName,
    pasw: password
  };

  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/GetAuthUser.php",
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


  if (responseData.status) {
    switch (responseData.userType) {
      case '1':
        window.location.href = "./admin/index.php";
        break;
      case '2':
        window.location.href = "staff.php";
        break;
      case '3':
        window.location.href = "./Client/index.php";
        break;

    }
  } else {
    alertMessage(responseData.message);
  }

});


document.getElementById("form-user").addEventListener("submit", async function (e) {
  e.preventDefault();

  let name = document.getElementById("user_name").value;
  let tpNumber = document.getElementById("user_tp_number").value;
  let password = document.getElementById("user_password").value;
  let rePassword = document.getElementById("user_rePassword").value;
  let address = document.getElementById("user_Address").value;

  let modalElement = document.getElementById("userAddModal");


  if (!name || !tpNumber || !password || !rePassword || !address) {
    alertMessage("All fields must be filled out!");

  } else if (isNaN(tpNumber)) {
    alertMessage("Telephone number must be an integer!");

  } else if (password !== rePassword) {
    alertMessage("Passwords do not match!");

  } else {

    const data = {
      name: name,
      tp_number: tpNumber,
      address: address,
      password: password,
      type: "3"
    };

    console.log(data);

    const response = await fetch("http://localhost/TheGalleryCafe/controller/addUser.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });

    const responseData = await response.json();
    if (responseData.status == true) {
      localStorage.setItem('alertMessage', responseData.message);
      let modalElement = document.getElementById("userAddModal");
      let modal = new bootstrap.Modal(modalElement);
      modal.hide();
      document.getElementById("form-user").reset();
      location.reload();

    } else {
      alertMessage(responseData.message);
    }



  }

  });





document
  .getElementById("user_togglePassword")
  .addEventListener("click", function (e) {
    const password = document.getElementById("user_password");

    const type =
      password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);

    this.classList.toggle("fa-eye");
    this.classList.toggle("fa-eye-slash");
  });


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
