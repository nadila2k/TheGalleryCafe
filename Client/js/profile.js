document.addEventListener("DOMContentLoaded", async function () {
  console.log("health ok!");
  getUserData();
  getUserReservationData();
});

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
  let status ="";
  let tbody = document.getElementById("tbl-table");

  data.forEach(function (el) {
    index++;
    if (el.status == 0) {
        status = "Pending";
    } else if(el.status == 1) {
        status = "Confirm";
    }else{
        status = "Cancel";
    }
    htmlStr += `<tr>
                 <td>${index}</td>
                 <td>${el.id}</td>
                 <td>${status}</td>
                 <td>${el.date}</td>
                 <td>${el.total}</td>
               
                 <td>
                   <button type="button" class="btn btn-primary" onclick="cancelReservation(${el.id})">Cancel</button>
                    
               </td>`;
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
  