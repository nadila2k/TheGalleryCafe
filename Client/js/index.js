document.addEventListener("DOMContentLoaded", async function () {
  console.log("health ok!");
  getFood();
});

let cart = [];

async function getFood() {
  const response = await fetch(
    "http://localhost/TheGalleryCafe/controller/getFood.php"
  );
  const data = await response.json();

  let htmlStrFood = "";
  let htmlStrBeverage = "";

  let foodCard = document.getElementById("item-food");
  let beverageCard = document.getElementById("item-beverage");
  data.forEach(function (el) {
    if (el.availability === "Yes") {
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

        if (el.food_or_beverage === "food") {
          htmlStrFood += cardHtml;
        } else {
          htmlStrBeverage += cardHtml;
        }
      }
    }
  });

  foodCard.innerHTML = htmlStrFood;
  beverageCard.innerHTML = htmlStrBeverage;

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

    
    const existingItem = cart.find(cartItem => cartItem.id === item.id);
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

  cart.forEach((item, index) => {
    
    let quantity = item.quantity != null ? item.quantity : 1;

    htmlStrCartItems += `
      <tr>
        <th scope="row">
          <div class="d-flex align-items-center">
            <img src="./../upload/${item.image}" class="img-fluid rounded-3" style="width: 120px;" alt="Book">
            <div class="flex-column ms-4">
              <p class="mb-2">${item.name}</p>
              <p class="mb-0">${item.food_or_beverage}</p>
            </div>
          </div>
        </th>
        <td class="align-middle">
          <button class="btn btn-danger remove-from-cart" data-index="${index}">Remove</button>
        </td>
        <td class="align-middle">
          <div class="d-flex flex-row">
            <button class="btn btn-link px-2" onclick="decreaseQuantity(${index})">
              <i class="fas fa-minus"></i>
            </button>
            <input min="1" name="quantity" value="${quantity}" type="number" class="form-control form-control-sm" style="width: 50px;" data-index="${index}" onchange="updateItemQuantity(this)">
            <button class="btn btn-link px-2" onclick="increaseQuantity(${index})">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </td>
        <td class="align-middle">
          <p class="mb-0" style="font-weight: 500;">$${(item.price * quantity).toFixed(2)}</p>
        </td>
      </tr>`;
    total += parseFloat(item.price) * quantity;
  });

  cartItemsContainer.innerHTML = htmlStrCartItems;
  cartTotalContainer.innerHTML = `$${total.toFixed(2)}`;

  document.querySelectorAll(".remove-from-cart").forEach((button) => {
    button.addEventListener("click", removeFromCart);
  });
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