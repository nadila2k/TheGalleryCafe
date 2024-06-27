document.addEventListener("DOMContentLoaded", async function () {
  console.log("health ok!");
  getFood();
  getCategory();
  getTable();
  setDefaultDate();
  setDateInputDefaults();
  document.getElementById("datePicker").addEventListener("change", getTable);
});

let cart = [];
let itemArray = [];
let tableArray = [];
let cartTotal = 0;

async function getFood(category = "", item = "", searchQuery = "") {
 
  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/getFood.php"
  );
  const data = await response.json();

  let htmlStrFood = "";
  let htmlStrBeverage = "";

  let foodCard = document.getElementById("item-food");
  let beverageCard = document.getElementById("item-beverage");

  data.forEach(function (el) {
    const name = el.name ? el.name.toLowerCase() : '';
    const type = el.type ? el.type.toLowerCase() : '';
    const categoryName = el.category_name ? el.category_name.toLowerCase() : '';
    
    if (el.availability === "Yes") {
      const cardHtml = `
          <div class="card" style="width: 18rem; padding:2px; margin: 5px; background-color: #3c3831; color:#FFFDFC;">
            <img src="./../upload/${
              el.image
            }" class="card-img-top" alt="..." style="width:281px; height:225px; text-align: center;">
            <div class="card-body">
              <h5 class="card-title">${el.name}</h5>
              <h2>${el.price}</h2>
              <p class="card-text">${el.description}</p>
              <button type="submit" class="btn btn-info add-to-cart" data-item='${JSON.stringify(
                el
              )}'><i class="bi bi-cart"> Add to Cart</i></button>
            </div>
          </div>`;
          
      const matchesSearch =
        searchQuery === "" ||
        name.includes(searchQuery.toLowerCase()) ||
        categoryName.includes(searchQuery.toLowerCase())||
        type.includes(searchQuery.toLowerCase());
      
      if (matchesSearch) {
        if (el.food_or_beverage === "food") {
          if (item === "" || item === "food") {
            if (category === "" || el.category_name === category) {
              htmlStrFood += cardHtml;
            }
          }
        } else if (el.food_or_beverage === "beverage") {
          if (item === "" || item === "beverage") {
            if (category === "" || el.category_name === category) {
              htmlStrBeverage += cardHtml;
            }
          }
        }
      }
    }
  });

  if (item === "" || item === "food") {
    foodCard.innerHTML = htmlStrFood;
  }

  if (item === "" || item === "beverage") {
    beverageCard.innerHTML = htmlStrBeverage;
  }

  document.querySelectorAll(".add-to-cart").forEach((button) => {
    button.addEventListener("click", addToCart);
  });
}

async function getCategory() {
  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/getCategory.php"
  );
  const data = await response.json();

  let htmlStrFilterFood = "";
  let htmlStrFilterBeverage = "";
  let foodFilter = document.getElementById("food-filter");
  let beverageFilter = document.getElementById("beverage-filter");

  data.forEach(function (el) {
    if (el.food_or_beverage === "food") {
      htmlStrFilterFood += `<li onclick="getFood('${el.name}', 'food','')">${el.name}</li>`;
    } else {
      htmlStrFilterBeverage += `<li onclick="getFood('${el.name}', 'beverage','')">${el.name}</li>`;
    }
  });
  foodFilter.innerHTML = `<li onclick="getFood()">All</li>` + htmlStrFilterFood;
  beverageFilter.innerHTML =
    `<li onclick="getFood()">All</li>` + htmlStrFilterBeverage;
}

async function getTable() {
  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/getTable.php"
  );
  const data = await response.json();

  let htmlStr = "";

  let tableCard = document.getElementById("item-table");
  const selectedDate = document.getElementById("datePicker").value;
  console.log(selectedDate);
  data.forEach(function (el) {
    el.selectedDate = selectedDate;
    htmlStr += `
               <div class="card" style="width: 18rem; padding:2px; margin: 5px; background-color: #3c3831; color:#FFFDFC;">
            <img src="./../upload/${
              el.image
            }" class="card-img-top" alt="..." style="width:281px; height:225px; text-align: center;">
            <div class="card-body">
              <h5 class="card-title">${el.name}</h5>
              
              <button type="submit" class="btn btn-info add-to-cart" data-item='${JSON.stringify(
                el
              )}'><i class="bi bi-cart"> Add to Cart</i></button>
            </div>
          </div>`;
  });

  tableCard.innerHTML = htmlStr;
  document.querySelectorAll(".add-to-cart").forEach((button) => {
    button.addEventListener("click", addToCart);
  });
}

function addToCart(event) {
  try {
    const button = event.currentTarget;
    const itemData = button.dataset.item;
    // console.log("Item data:", itemData);
    const item = JSON.parse(itemData);

    const existingItem = cart.find((cartItem) => cartItem.id === item.id);
    if (existingItem) {
      alertMessage("Item already added to the cart");
    } else {
      cart.push(item);
      updateCart();
      alertMessage("Item added to the cart successfully");
    }
  } catch (error) {
    console.error("Failed to add to cart:");
  }
}

function updateCart() {
  const cartItemsContainer = document.getElementById("cart-details");
  const cartTotalContainer = document.getElementById("total");
  let htmlStrCartItems = "";
  let total = 0;
  itemArray = [];
  tableArray = [];

  cart.forEach((item, index) => {
    let tblQty = item.qty;
    let date = item.selectedDate != null ? item.selectedDate : "";
    let quantity = item.quantity != null ? item.quantity : 1;
    let categoryName =
      item.category_name != null ? item.category_name : "Table";

    htmlStrCartItems += `
      <tr>
        <td >
          <div class="d-flex align-items-center">
            <img src="./../upload/${item.image}" alt="Book">
            <div class="flex-column ms-4">
              <p class="mb-2">${item.name}</p>
              <p class="mb-0">${categoryName}</p>
            </div>
          </div>
        </td>
        <td class="align-middle">
          <button class="btn btn-danger remove-from-cart" data-index="${index}">Remove</button>
        </td>`;

    if (categoryName === "Table") {
      htmlStrCartItems += `
        <td class="align-middle">
          <div class="d-flex flex-row">
            <input min="1" max="${tblQty}" name="quantity" value="${quantity}" type="number" class="form-control form-control-sm" style="width: 50px;" data-index="${index}" onchange="updateItemQuantity(this)">
          </div>
        </td>`;

      tableArray.push({
        id: item.id,
        name: item.name,
        category: categoryName,
        image: item.image,
        date: date,
        quantity: quantity,
      });
    } else {
      htmlStrCartItems += `
        <td class="align-middle">
          <div class="d-flex flex-row">
            <input min="1" name="quantity" value="${quantity}" type="number" class="form-control form-control-sm" style="width: 50px;" data-index="${index}" onchange="updateItemQuantity(this)">
          </div>
        </td>
        <td class="align-middle">
          <p class="mb-0" style="font-weight: 500;">$${(
            item.price * quantity
          ).toFixed(2)}</p>
        </td>`;
        total += parseFloat(item.price) * quantity;
      itemArray.push({
        id: item.id,
        name: item.name,
        category: categoryName,
        image: item.image,
        price: item.price * quantity,
        quantity: quantity,
        
      });
     
    }

    htmlStrCartItems += `</tr>`;
  });
  cartTotal = total.toFixed(2);
  cartItemsContainer.innerHTML = htmlStrCartItems;
  cartTotalContainer.innerHTML = `$${total.toFixed(2)}`;

  document.querySelectorAll(".remove-from-cart").forEach((button) => {
    button.addEventListener("click", removeFromCart);
  });
}

async function cartSubmit() {
  if (tableArray.length === 0) {
    let modalElement = document.getElementById("addPickDate");
    let modalInstance = new bootstrap.Modal(modalElement);

    function getDateInput() {
      return new Promise((resolve) => {
        document
          .getElementById("get-date")
          .addEventListener("submit", function (event) {
            event.preventDefault();
            let dateInput = document.getElementById("getItemPickIpDate").value;
            console.log("Selected date:", dateInput);
            modalInstance.hide();
            resolve(dateInput);
          });
      });
    }

    modalInstance.show();
    let dateInput = await getDateInput();
    console.log(itemArray);
    console.log(cartTotal);
  } else {
  }
}

function updateItemQuantity(input) {
  const index = input.dataset.index;
  const quantity = parseInt(input.value);
  if (quantity > 0) {
    cart[index].quantity = quantity;
    updateCart();
  } else {
    input.value = 1;
  }
}

function removeFromCart(event) {
  const index = event.currentTarget.dataset.index;
  cart.splice(index, 1);
  updateCart();
}

function setDefaultDate() {
  today = new Date();

  dd = String(today.getDate()).padStart(2, "0");
  mm = String(today.getMonth() + 1).padStart(2, "0");
  yyyy = today.getFullYear();

  todayFormatted = yyyy + "-" + mm + "-" + dd;

  datePicker = document.getElementById("datePicker");
  datePicker.value = todayFormatted;

  datePicker.min = todayFormatted;
}
function setDateInputDefaults() {
  const today = new Date().toISOString().split("T")[0];
  const dateInput = document.getElementById("getItemPickIpDate");
  dateInput.min = today;
  dateInput.value = today;
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

document.getElementById("search-btn").addEventListener("click", function () {
  const searchQuery = document.getElementById("search-input").value;
  getFood("", "", searchQuery);
});
