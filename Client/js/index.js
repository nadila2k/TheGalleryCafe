document.addEventListener("DOMContentLoaded", async function () {
  console.log("health ok!");
  getFood();
  getCategory();
  getTable();
  setDefaultDate();
  setDateInputDefaults();
  document.getElementById("datePicker").addEventListener("change", getTable);
  getEvent();
  slider();
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
    const name = el.name ? el.name.toLowerCase() : "";
    const type = el.type ? el.type.toLowerCase() : "";
    const categoryName = el.category_name ? el.category_name.toLowerCase() : "";

    if (el.availability === "Yes") {
      const cardHtml = `
          <div class="card">
            <img src="./../upload/${el.image}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">${el.name}</h5>
              <h2>RS ${el.price}.00</h2>
              <p class="card-text">${el.description}</p>
              <button type="submit" class="btn btn-info add-to-cart" data-item='${JSON.stringify(
                el
              )}'><i class="bi bi-cart"> Add to Cart</i></button>
            </div>
          </div>`;

      const matchesSearch =
        searchQuery === "" ||
        name.includes(searchQuery.toLowerCase()) ||
        categoryName.includes(searchQuery.toLowerCase()) ||
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
               <div class="card" >
            <img src="./../upload/${el.image}" class="card-img-top" alt="..." >
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
    console.log("Item data:", itemData);
    const item = JSON.parse(itemData);

    const existingItem = cart.find((cartItem) => cartItem.name === item.name);
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
        </td>
        <td class="align-middle">
        
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
          <p class="mb-0" style="font-weight: 500;">RS ${(
            item.price * quantity
          ).toFixed(2)}</p>
        </td>`;
      total += parseFloat(item.price) * quantity;
      itemArray.push({
        id: item.id,
        name: item.name,
        category: categoryName,
        image: item.image,
        price: item.price,
        quantity: quantity,
      });
    }

    htmlStrCartItems += `</tr>`;
  });
  cartTotal = total.toFixed(2);
  cartItemsContainer.innerHTML = htmlStrCartItems;
  cartTotalContainer.innerHTML = `RS ${total.toFixed(2)}`;

  document.querySelectorAll(".remove-from-cart").forEach((button) => {
    button.addEventListener("click", removeFromCart);
  });
}

async function cartSubmit() {
  if (cart.length === 0) {
    alertMessage("Cart is empty");
  } else {
    if (tableArray.length === 0) {
      let modalElement = document.getElementById("addPickDate");
      let modalInstance = new bootstrap.Modal(modalElement);
      modalInstance.show();

      document
        .getElementById("cardAndDate")
        .addEventListener("submit", async function (e) {
          e.preventDefault();

          const date = document.getElementById("getItemPickIpDate").value;
          const cardNumber = document.getElementById("cardNumber").value;
          const cardHolderName =
            document.getElementById("cardHolderName").value;
          const expiration = document.getElementById("expiration").value;
          const cvv = document.getElementById("Cvv").value;
          const dineInOrTakeaway =
            document.getElementById("dineInOrTakeaway").value;
          const time = document.getElementById("time").value;

          if (
            !date ||
            !dineInOrTakeaway ||
            !time ||
            !cardNumber ||
            !cardHolderName ||
            !expiration ||
            !cvv
          ) {
            alertMessage("Fields can't be empty");
          } else if (
            !Number.isInteger(Number(cardNumber)) ||
            !Number.isInteger(Number(expiration)) ||
            !Number.isInteger(Number(cvv))
          ) {
            alertMessage("Need a valid integer.");
          } else {
            modalInstance.hide();

            const data = {
              date: date,
              cartTotal: cartTotal,
              itemArray: itemArray,
              dineInOrTakeaway: dineInOrTakeaway,
              time: time,
            };
            console.log(data);
            const response = await fetch(
              "http://localhost/TheGalleryCafe/controller/itemReservation.php",
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
              clearArrays();
            } else {
              alertMessage(responseData.message);
            }
          }
        });
    } else if (tableArray.length !== 0 && itemArray.length !== 0) {
      let modalElement = document.getElementById("cardPayment");
      let modalInstance = new bootstrap.Modal(modalElement);
      modalInstance.show();

      document
        .getElementById("payment-form")
        .addEventListener("submit", async function (e) {
          e.preventDefault();
          const time = document.getElementById("timeItemAndTable").value;
          const cardNumber = document.getElementById(
            "cardNumberCardPayment"
          ).value;
          const cardHolderName = document.getElementById(
            "cardHolderNameCardPayment"
          ).value;
          const expiration = document.getElementById(
            "expirationCardPayment"
          ).value;
          const cvv = document.getElementById("CvvCardPayment").value;

          if (!cardNumber || !cardHolderName || !expiration || !cvv || !time) {
            alertMessage("Fields can't be empty");
          } else if (
            !Number.isInteger(Number(cardNumber)) ||
            !Number.isInteger(Number(expiration)) ||
            !Number.isInteger(Number(cvv))
          ) {
            alertMessage("Need a valid integer.");
          } else {
            modalInstance.hide();

            const data = {
              cartTotal: cartTotal,
              itemArray: itemArray,
              tableArray: tableArray,
              time: time,
            };

            const response = await fetch(
              "http://localhost/TheGalleryCafe/controller/itemReservation.php",
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
              clearArrays();
            } else {
              alertMessage(responseData.message);
            }
          }
        });
    } else {
      let modalElement = document.getElementById("timeForTable");
      let modalInstance = new bootstrap.Modal(modalElement);
      modalInstance.show();

      document
        .getElementById("getTimeTable-form")
        .addEventListener("submit", async function (e) {
          e.preventDefault();
          const time = document.getElementById("timeTable").value;

          if (!time) {
            alertMessage("Fields can't be empty");
          } else {
            modalInstance.hide();

            const data = {
              tableArray: tableArray,
              time: time,
            };

            const response = await fetch(
              "http://localhost/TheGalleryCafe/controller/itemReservation.php",
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
              clearArrays();
            } else {
              alertMessage(responseData.message);
            }
          }
        });
    }
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

async function getEvent() {
  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/getEvent.php"
  );
  const data = await response.json();

  let htmlStr = "";
  let index = 0;
  let eventDisplay = document.getElementById("event-Display");

  data.forEach(function (el) {
    index++;
    htmlStr += `<div class="swiper-slide">
                    <div class="row event-item" id="event-card">
                        <div class="col-lg-6">
                            <img src="./../upload/${el.image}" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6 pt-4 pt-lg-0 content">
                            <h3>${el.name}</h3>
                            <div class="price">
                                <p><span>${el.price}</span></p>
                            </div>
                            <p class="fst-italic">
                            ${el.description}
                            </p>
                            <ul>
                                
                                <li><i class="bi bi-check-circled"></i>${el.include_items}</li>
                                
                            </ul>
                            <p>
                                Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur
                            </p>
                        </div>
                    </div>
                </div>`;
  });

  eventDisplay.innerHTML = htmlStr;
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

function clearArrays() {
  cart = [];
  itemArray = [];
  tableArray = [];
  cartTotal = 0;
  updateCart();
}

function slider() {
  const swiperContainer = document.querySelector(".events-slider");
  const slides = swiperContainer.querySelectorAll(".swiper-slide");
  const loop = slides.length > 1; // Enable loop only if there are more than one slide

  new Swiper(swiperContainer, {
    speed: 600,
    loop: loop,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    slidesPerView: "auto",
    pagination: {
      el: ".swiper-pagination",
      type: "bullets",
      clickable: true,
    },
  });
}
