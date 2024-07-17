// JavaScript to set the active class on the current page link
document.addEventListener("DOMContentLoaded", function() {
  const currentPage = window.location.pathname.split("/").pop();
  const navLinks = document.querySelectorAll("#nav-bar a");

  navLinks.forEach(link => {
    if (link.getAttribute("href") === currentPage) {
      link.classList.add("active");
    }
  });
});

// JavaScript for the mobile nav bar toggle
const bar = document.getElementById("bar");
const close = document.getElementById("close");
const navbar = document.getElementById("nav-bar");

if (bar) {
  bar.addEventListener("click", () => {
    navbar.classList.add("active");
  });
}

if (close) {
  close.addEventListener("click", () => {
    navbar.classList.remove("active");
  });
}

// Function to toggle the visibility of the search box
function toggleCategories(event) {
  var searchBox = document.getElementById("searchBox");
  searchBox.style.display = "block"; // Always display the search box when clicked
  event.stopPropagation(); // Stop event propagation
}

// Function to toggle the visiblity of username submenu wrapper 
let submenu = document.getElementById("subMenu");

function toggleMenu() {
  submenu.classList.toggle("open-menu");
}



// to change small image to the main image

// contact form js
// const inputs = document.querySelectorAll(".input");

function focusFunc() {
  let parent = this.parentNode;
  parent.classList.add("focus");
}

function blurFunc() {
  let parent = this.parentNode;
  if (this.value == "") {
    parent.classList.remove("focus");
  }
}

inputs.forEach((input) => {
  input.addEventListener("focus", focusFunc);
  input.addEventListener("blur", blurFunc);
});

// Translations
const translations = {
  en: {
    //header
    homepage: "Home",
    shoppage: "Shop",
    blogpage: "blog",
    aboutpage: "About",
    contactpage: "Contact",
    // selected language icon
    "selected-language": "Select Language",
    value1: "English",
    value2: "Amharic",
    //main section
    "main-head2": "Best in style",
    "main-head1": "Collection for You",
    para: "If you re looking for a place to get comfortable sneaker shoes we have you covered. here are the best sneaker shoes!",
    "shop-button": "Shop Now",
    //featured product
    "product-h2": "All Release Products",
    "product-para": "New Release Collection with Modern Design",
    //product container1
    "product-name": "JORDAN",
    "product-full-name":
      "AIR JORDAN 3 RETRO (TD) - WHITE/MIDNIGHT NAVY/CEMENT GREY",
    "product-price": "ETB 4,700",
    //product container2
    "product-name": "JORDAN",
    "product-full-name":
      "AIR JORDAN 2 RETRO LOW 'CHRISTMAS' - BLACK/FIRE RED/CEMENT GREY",
    "product-price": "ETB 4,550",
    //product container3
    "product-name": "JORDAN",
    "product-full-name":
      "AIR JORDAN 1 RETRO HI OG CRAFT - CELADON/SKY J LIGHT OLIVE/BRIGHT MANDARIN",
    "product-price": "ETB 4,350",
    //product container4
    "product-name": "JORDAN",
    "product-full-name": "AIR JORDAN 14 RETRO - BLACK/WHITE",
    "product-price": "ETB 4,400",
    //product container5
    "product-name": "NIKE",
    "product-full-name": "WOMEN'S DUNK LOW PRM 'BACON' - SPORT RED/SHEEN/SAIL",
    "product-price": "ETB ETB 3,950",
  },
  am: {
    homepage: "ቤት",
    shoppage: "ሱቅ",
    blogpage: "ብሎግ",
    aboutpage: "ስለ እኛ",
    contactpage: "መገናኘት",
    "selected-language": "የተመረጠ ቋንቋ",
    value1: "እንግሊዝኛ",
    value2: "አማርኛ",
    "shop-button": "አሁን ይሸምቱ",
    //main section in am
    "main-head2": "በቅጡ ምርጥ",
    "main-head1": "ስብስብ ለእርስዎ",
    para: "ምቹ የሆኑ ስኒከር ጫማዎችን ለማግኘት ቦታ እየፈለጉ ከሆነ እርስዎን እንሸፍነዋለን። በጣም ጥሩዎቹ የጫማ ጫማዎች እዚህ አሉ!",
    "product-price": "ETB 4,700",

    //featured product
    "product-h2": "ሁሉም የተለቀቁ ምርቶች",
    "product-para": "አዲስ የተለቀቀው ስብስብ ከዘመናዊ ዲዛይን ጋር",

    //product container1
    "product-name1": "ጆርዳን",
    "product-full-name1": "አየር ጆርዳን 3 ሬትሮ (TD) - ነጭ/እኩለ ሌሊት የባህር ኃይል/ሲሚንቶ ግራጫ",
    "product-price1": "4,700 ብር",
    //product container2
    "product-name2": "ጆርዳን",
    "product-full-name2": "አየር ጆርዳን 2 ሬትሮ ዝቅተኛ 'ገና' - ጥቁር/እሳት ቀይ/ሲሚንቶ ግራጫ",
    "product-price2": "4,550 ብር",
    //product container3
    "product-name3": "ጆርዳን",
    "product-full-name3":
      "አየር ጆርዳን 1 ሬትሮ ሃይ ኦግ ክራፍት - ሴላዶን/ስካይ ጄ ብርሃን የወይራ/ብሩህ ማንዳሪን",
    "product-price3": "4,350 ብር",
    //product container4
    "product-name4": "Jጆርዳን",
    "product-full-name4": "አየር ጆርዳን  14 ሬትሮ - ጥቁር / ነጭ",
    "product-price4": "4,400 ብር",
    //product container5
    "product-name5": "ናይክ",
    "product-full-name5": "የሴቶች ዳንክ LOW PRM 'ባኮን' - ስፖርት ቀይ/ሼን/ሴይል",
    "product-price5": "3,950 ብር",
  },
};

// Function to change language
const inputs = document.querySelectorAll(".input");

function focusFunc() {
  let parent = this.parentNode;
  parent.classList.add("focus");
}

function blurFunc() {
  let parent = this.parentNode;
  if (this.value == "") {
    parent.classList.remove("focus");
  }
}

inputs.forEach((input) => {
  input.addEventListener("focus", focusFunc);
  input.addEventListener("blur", blurFunc);
});

function sendEmail() {
  Email.send({
    Host: "smtp.gmail.com",
    Username: "gebeyehuabraham19@gmail.com",
    Password: "gebeyehuabrahamselam",
    To: "abrahamgebeyehu7627@gmail.com",
    From: document.getElementById("email").value,
    Subject: "New Contact Form Enquiry",
    Body:
      "Name:" +
      document.getElementById("name").value +
      "<br> Email:" +
      document.getElementById("email").value +
      "<br> Phone no:" +
      document.getElementById("phone").value +
      "<br> Message :" +
      document.getElementById("message").value,
  }).then((message) => alert("Message  Sent Succesfully"));
}
function sendMessage() {}

function validateForm() {
  var name = document.forms["form"]["name"].value;
  var email = document.forms["form"]["email"].value;
  var phone = document.forms["form"]["phone"].value;
  var message = document.getElementById("mess").value;

  if (name == "") {
    alert("Please enter your NAME to proceed further...");
    return false;
  }
  if (!isNaN(name)) {
    alert("please enter valid name...");
    return false;
  }
  if (email == "") {
    alert("Please enter valid EMAIL to proceed further...");
    return false;
  }
  if (phone == "") {
    alert("Please enter your CONTACT number to proceed further...");
    return false;
  }
  if (isNaN(phone)) {
    alert("Invalid CONTACT number");
    return false;
  }
  if (mess == "") {
    alert("Please Provide message!");
    return false;
  }
}

//SELECT ELEMENTS
const list = document.querySelector(".pro-container");
s;

//render products
const intApp = () => {
  products.forEach((product) => {
    list.innerHTML += `
            <div class="pro">
        
             `;
    let newProduct = document.createElement("div");
    newProduct.dataset.id = product.id;
    newProduct.classList.add("pro");
    newProduct.innerHTML = `<img src="./images/${product.images}" alt="">
                <div class="descri">
                  <span data-translate="product-name1">${product.name}</span>
                  <h5 data-translate="product-full-name1">${product.desc}</h5>
                    <div class="star">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                    </div>
                      <h4 data-translate="product-price1"><strong>ETB</strong> ${product.price.toLocaleString()}</h4>
                    </div>
                      <a onclick="addToCart('${
                        product.id
                      }')"></i><i class="_cart"><i class="fa fa-shopping-cart"></i></i>
                      </a>
                    </div>  
                <img src="${product.image}" alt="">
                <h2>${product.name}</h2>
                <div class="price">$${product.price}</div>
                <button class="addCart">Add To Cart</button>`;
    listProductHTML.appendChild(newProduct);
  });
};

intApp();
// cart array
function showPopup() {
  var popup = document.getElementById("popup");
  popup.style.display = "block";
  setTimeout(function () {
    popup.style.display = "none";
  }, 2000); // 7000 milliseconds = 7 seconds
}

function closePopup() {
  var popup = document.getElementById("popup");
  popup.style.display = "none";
}

// Call showPopup function when the page loads (you might want to adjust this based on your specific login mechanism)
window.onload = function () {
  showPopup();
};
