document.addEventListener("DOMContentLoaded", async function () {
    console.log("helt ok!");
   
  
  });


document.getElementById("form-login").addEventListener("submit",async function(e){
    e.preventDefault();

    let userName = document.getElementById("userName").value;
    let password = document.getElementById("password").value;

    const data = {
        UserName : userName,
        pasw : password
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
          switch(responseData.userType) {
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
          alert(responseData.message);
      }
 
});