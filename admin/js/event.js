document.addEventListener("DOMContentLoaded", async function () {
    console.log("health ok!");
    getEvent();
  });
  
  document
    .getElementById("event-table")
    .addEventListener("submit", async function (e) {
      e.preventDefault();
  
      const name = document.getElementById("name").value.trim();
      const description = document.getElementById("description").value.trim();
      const price = document.getElementById("price").value.trim();
      const image = document.getElementById("image").files[0];
  
      let modalElement = document.getElementById("eventAddModal");
      let modalInstance = bootstrap.Modal.getInstance(modalElement);
      modalInstance.hide();
  
      if (!name || !description || !price || !image) {
        alertMessage("Text field name cannot be empty");
      } else {
        const formData = new FormData();
        formData.append("name", name);
        formData.append("description", description);
        formData.append("price", price);
       
        formData.append("image", image);
  
        const response = await fetch(
          "http://localhost/TheGalleryCafe/controller/addEvent.php",
          {
            method: "POST",
            body: formData,
          }
        );
  
        const responseData = await response.json();
  
        if (responseData.status === true) {
          getEvent();
          alertMessage(responseData.message);
          
        } else {
          alertMessage(responseData.message);
        }
      }
    });

    async function getEvent() {
        const response = await fetch("http://localhost/TheGalleryCafe/controller/getEvent.php");
        const data = await response.json();
    
        let htmlStr = "";
        let index = 0;
        let tbody = document.getElementById("tbl-table");
    
        data.forEach(function (el) {
            index++;
            htmlStr += `<tr>
                           <td>${index}</td>
                           <td>${el.name}</td>
                           <td>${el.price}</td>
                           <td>${el.description}</td>
                           <td class="tbl-img"><img src="./../upload/${el.image}" alt="Image of ${el.name}"></td>
                           <td>
                             <button type="button" class="btn btn-danger" onclick="deleteEvent(${el.id})">Delete</button>
                            
                           </td>
                           <td>
                            <button type="button" class="btn btn-primary" onclick="editEvent(${el.id})">Edit</button></td>
                        </tr>`;
        });
    
        tbody.innerHTML = htmlStr;
    }

    async function editEvent(id) {
        const response = await fetch(
          `http://localhost/TheGalleryCafe/controller/getEventById.php?id=${id}`
        );
        const data = await response.json();
        console.log(data);
      
        document.getElementById("edit-id").value = data.id;
    document.getElementById("edit-name").value = data.name;
    document.getElementById("edit-description").value = data.description;
    document.getElementById("edit-price").value = data.price;

      
        let modalElement = document.getElementById("eventEditModal");
        let modalInstance = new bootstrap.Modal(modalElement);
        modalInstance.show();
      }



      document.getElementById("edit-event-form").addEventListener("submit", async function (e) {
        e.preventDefault();
    
        const id = document.getElementById("edit-id").value.trim(); 
        const name = document.getElementById("edit-name").value.trim();
        const description = document.getElementById("edit-description").value.trim();
        const price = document.getElementById("edit-price").value.trim();
    
        const image = document.getElementById("edit-image").files[0];
    
        let modalElement = document.getElementById("eventEditModal");
        let modalInstance = bootstrap.Modal.getInstance(modalElement);
        modalInstance.hide();
    
        if (!name || !description || !price ) {
            alert("All fields except the image are required.");
            return;
        }
    
        const formData = new FormData();
        formData.append("id", id);
        formData.append("name", name);
        formData.append("description", description);
        formData.append("price", price);
        console.log(formData);
     
        if (image) formData.append("image", image);

        console.log("ID:", formData.get("id"));
console.log("Name:", formData.get("name"));
console.log("Description:", formData.get("description"));
console.log("Price:", formData.get("price"));
   
        const response = await fetch(
            "http://localhost/TheGalleryCafe/controller/updateEvent.php",
            {
                method: "POST",
                body: formData,
            }
        );
    
        const responseData = await response.json();
    
        if (responseData.status === true) {
            getEvent();
            alertMessage(responseData.message);
           
        } else {
            alertMessage(responseData.message);
        }
    });
    
      
    async function deleteEvent(id) {
        const data = {
          catId: id,
        };
      
        const response = await fetch(
          "http://localhost/TheGalleryCafe/controller/deleteEvent.php",
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
            getEvent();
          alertMessage(responseData.message);
          
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
      