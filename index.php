<?php
include ('Layouts/header.php');
?>
<title>AK-FEATURE/HOME</title>
<section class="main" id="mainSection">
  <h2 data-translate="main-head2">Best in style</h2> <br>
  <h1 data-translate="main-head1">Collection for You </h1>
  <p data-translate="para">If you're looking for a place to get comfortable sneaker shoes,<br>
    we have you covered. here are the best sneaker shoes!</p>
  <button class="button-front" data-translate="shop-button"><span>Shop Now</span> </button>
</section>


<!--featured product-->
<section id="product1" class="section-p1">
  <h2 data-translate="product-h2">All Release Products</h2>
  <p data-translate="product-para">New Release Collection with Modern Design</p>
  <div class="pro-container">
    <?php include 'includes/get_product.inc.php'; ?>
    <?php while ($row = $all_release_products->fetch_assoc()) { ?>
      <div class="pro">
        <img src="products/<?php echo $row['product_image']; ?>" alt="">
        <div class="descri">
          <span data-translate="product-name1"><?php echo $row['product_name']; ?></span>
          <h5 data-translate="product-full-name1"><?php echo $row['product_description']; ?></h5>
          <div class="star">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <h4 data-translate="product-price1">ETB <?php echo $row['product_price']; ?></h4>
        </div>
        <a href="<?php echo "Sproducts.php? product_identity=" . $row['product_identity']; ?>"></i><i class="_cart"><i class="fa fa-shopping-cart "></i></i></a>
      </div>
    <?php } ?>
  </div>
</section>

<section id="banner" class="section -m1">
  <h4>Repair Services</h4>
  <h2>Up to <span>70% Off-</span> All Shoes brands</h2>
  <button class="banner-middle">Explore More</button>
</section>

<!-- new release product-->
<section id="product1" class="section-p1">
  <h2> New Arrival</h2>
  <p>New Release Collection with Modern Design</p>
  <div class="pro-container">
    <?php include 'includes/get_product.inc.php'; ?>
    <?php while ($row =$new_arrival_products->fetch_assoc()) { ?>
      <div class="pro">
        <img src="products/<?php echo $row['product_image']; ?>" alt="">
        <div class="descri">
          <span data-translate="product-name1"><?php echo $row['product_name']; ?></span>
          <h5 data-translate="product-full-name1"><?php echo $row['product_description']; ?></h5>
          <div class="star">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
          <h4 data-translate="product-price1">ETB <?php echo $row['product_price']; ?></h4>
        </div>
        <a href="<?php echo "Sproducts.php? product_identity=" . $row['product_identity']; ?>"></i><i class="_cart"><i class="fa fa-shopping-cart "></i></i></a>
      </div>
    <?php } ?>
  </div>
</section>

<section id="lw-banner" class="section-p1">
  <div class="banner-box">
    <h4>Creazy Deals</h4>
    <h2>Buy 1 get 1 free</h2>
    <span>The best classic shoes is on sale at AK</span>
    <button class="banner-lower">learn More </button>
  </div>
  <div class="banner-box banner-box2">
    <h4>Spring/Summer</h4>
    <h2>UpComing Season</h2>
    <span>The best classic shoes is on sale at AK</span>
    <button class="banner-lower">Collection </button>
  </div>
</section>

<section id="Featured" class="section-p1">
  <div class="row">
    <h1>Our <span>Features</span></h1>
  </div>
  <div class="row">
    <div class="column">
      <div class="card">
        <div class="icon">
          <img src="banner-box/our features/images1.png" alt="">
        </div>
        <h3>Online Order</h3>
        <p>Discover the perfect pair from the comfort of your home with our user-friendly interface and extensive product catalog. Simply navigate through our curated selection of shoes, add your favorites to the virtual shopping cart, and proceed to our secure checkout process.</p>
      </div>
    </div>
    <div class="column">
      <div class="card">
        <div class="icon">
          <img src="banner-box/our features/images2.jpeg" alt="">
        </div>
        <h3>Promotions</h3>
        <p>Dive into a world of savings with our Promotions Feature Service! Discover unbeatable deals on a variety of products, from fashion essentials to must-have gadgets. Take advantage of exclusive discounts, flash sales, and special offers that bring value to every purchase.</p>
      </div>
    </div>
    <div class="column">
      <div class="card">
        <div class="icon">
          <img src="banner-box/our features/images5.jpeg" alt="">
        </div>
        <h3>F24/7 Support</h3>
        <p>Step confidently with our 24/7 Support Shoe Feature Service! Our dedicated support team is ready around the clock to assist you with any inquiries, ensuring a seamless shopping experience. From finding the perfect fit to tracking your order, we're here for you day and night.</p>
      </div>
    </div>
  </div>
</section>

<section id="banner3">
  <div class="banner-box ">
    <h2>SEASONAL SALE</h2>
    <h3>Winter Collection -50% OFF</h3>
  </div>
  <div class="banner-box banner-box2">
    <h2> NEW FOOTWEAR COLLECTION</h2>
    <h3>Spring / Summer 2024</h3>
  </div>
  <div class="banner-box banner-box3">
    <h2>Sneakers</h2>
    <h3>New Trendy Fashions</h3>
  </div>
</section>

<?php
include ('Layouts/footer.php');
?>
<script src="js/script.js"></script>
<script src="https://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate" data-translate="select-language"></script>
<script>
  // Array of background image URLs
  const backgroundImages = [
    "url('img/photo-1491553895911-0055eca6402d\ \(1\).avif')",
    "url('img/photo-1556637640-2c80d3201be8.avif')",
    "url('img/photo-1587563871167-1ee9c731aefb.avif')",
    "url('img/photo-1600185365483-26d7a4cc7519.avif')",
  ];

  let currentIndex = 0;

  function changeBackgroundImage() {
    const mainSection = document.getElementById('mainSection');
    mainSection.style.backgroundImage = backgroundImages[currentIndex];
    currentIndex = (currentIndex + 1) % backgroundImages.length;
  }

  setInterval(changeBackgroundImage, 2000);
</script>
<script>
  function loadGoogleTranslate() {
    new google.translate.TranslateElement("google_element")
  }
</script>

</body>
</html>
