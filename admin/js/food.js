document.addEventListener("DOMContentLoaded", async function () {
    console.log("health ok!");
    getCategory();
  });

  async function getCategory() {
    const response = await fetch(
      "http://localhost/TheGalleryCafe/admin/controller/getCategory.php"
    );
    const data = await response.json();
  
    let htmlStr = "";
    
    let catSelect = document.getElementById("category-el");
  
    data.forEach(function (el) {
      
      htmlStr += `<option value="${el.id}">${el.name}</option>`;
    });
  
    catSelect.innerHTML = htmlStr;
  }

  document.getElementById("form-food").addEventListener("submit", async function (e) {
    e.preventDefault();

    const name = document.getElementById("name").value.trim();
    const price = document.getElementById("price").value.trim();
    const category = document.getElementById("category-el").value.trim();
    const available = document.querySelector('input[name="available"]:checked');
    const image = document.getElementById("image").files[0];

    let modalElement = document.getElementById("foodAddModal");
    let modalInstance = bootstrap.Modal.getInstance(modalElement);
     modalInstance.hide();

    if (!name || !price || !category || !available || !image) {
        alertMessage("Text field name cannot be empty");
        
    }else{

        const formData = new FormData();
        formData.append("name", name);
        formData.append("price", price);
        formData.append("category", category);
        formData.append("available", available.value);
        formData.append("image", image);
        for (let [key, value] of formData.entries()) {
            console.log(key, value);
        }

        const response = await fetch("http://localhost/TheGalleryCafe/admin/controller/addFood.php", {
            method: "POST",
            body: formData
        });

        const responseData = await response.json();
        console.log(responseData);

        if (responseData.status === true) {
            alertMessage(responseData.message);
             
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