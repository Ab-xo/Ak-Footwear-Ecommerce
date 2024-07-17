		<?php
		include('Layouts/header.php');
		include 'includes/dbh.inc.php';

		if (isset($_GET['product_identity'])) {

			$product_identity = $_GET['product_identity'];
			$stmt = $conn->prepare("SELECT * FROM products WHERE product_identity = ?");
			$stmt->bind_param("i", $product_identity);
			$stmt->execute();

			$Sproduct = $stmt->get_result();

			//no product
		} else {

			header('location: ..index.php');
		}
		?>
		<title>AK-FEATURE/Single-Product</title>
		<section id="pro-deatils" class="section-p1">
			<div class="row mt-5"></div>
			<?php while ($row =  $Sproduct->fetch_assoc()) { ?>
				<div class="single-pro-image">
					<img src="S-produts/<?php echo $row['product_single_image1']; ?>" width="100%" id="MainImg" alt="">
					<div class="small-img-group">

						<div class="small-img-col">
							<img src="S-produts/<?php echo $row['product_single_image1']; ?>" width="100%" class="small-img" alt="">

						</div>
						<div class="small-img-col">
							<img src="S-produts/<?php echo $row['product_single_image2']; ?>" width="100%" class="small-img" alt="">
						</div>
						<div class="small-img-col">
							<img src="S-produts/<?php echo $row['product_single_image3']; ?>" width="100%" class="small-img" alt="">
						</div>
						<div class="small-img-col">
							<img src="S-produts/<?php echo $row['product_single_image4']; ?>" width="100%" class="small-img" alt="">
						</div>

					</div>
				</div>
				<div class="single-pro-details">
					<h6><a href="index.php">HOME</a>/ SINGLE PRODUCT/ <?php echo $row['product_name']; ?></h6>
					<h4><?php echo $row['product_description']; ?></h4>
					<h3>ETB <?php echo $row['product_price']; ?></h3>
					<form method="POST" action="cart.php">
						<input type="hidden" name="product_identity" value="<?php echo $row['product_identity']; ?>" />
						<input type="hidden" name="product_single_image1" value="<?php echo $row['product_single_image1']; ?>" />
						<input type="hidden" name="product_description" value="<?php echo $row['product_description']; ?>" />
						<input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>" />
						<input type="hidden" name="product_quantity" value="1" min="1" />
						<select name="product_size">
							<option class="select">Select Size</option>
							<option>38</option>
							<option>39</option>
							<option>40</option>
							<option>41</option>
							<option>42</option>
						</select>
						<input type="number" name="product_quantity" value="1" min="1" />
						<button type="sumbit" name="add_to_cart"> Add To Cart</button>
					</form>
					<h4>Produtct deatils</h4>
					<span>
						<?php echo $row['product_details']; ?>

					</span>

				</div>
			<?php
			}
			?>
			</div>

		</section>
		<section id="product1" class="section-p1">
			<h2> Related products </h2>
			<p>New Release Collection with Modern Design</p>
			<div class="pro-container">

				<div class="pro">
					<img src="products/AirForce1_07-Sail_VaporGreen_UniversityRed_RELEASES.webp" alt="">
					<div class="descri">
						<span>NIKE</span>
						<h5>AIR FORCE 1 '07 - SAIL/VAPOR GREEN/UNIVERSITY RED</h5>
						<div class="star">
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
						</div>
						<h4>$98</h4>
					</div>
					<a href="#"></i><i class="_cart"><i class="fa fa-shopping-cart "></i></i></a>
				</div>
				<div class="pro">
					<img src="products/NewBalancexAimeLeonDore996MadeInUSA front pic 10.jpg" alt="">
					<div class="descri">
						<span>NEW BALANCE</span>
						<h5>NEW BALANCE X AIME LEON DORE 996 MADE IN USA - WHITE</h5>
						<div class="star">
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
						</div>
						<h4>$98</h4>
					</div>
					<a href="#"></i><i class="_cart"><i class="fa fa-shopping-cart "></i></i></a>
				</div>
				<div class="pro">
					<img src="products/AsicsxUnaffectedGel-Kayano14-BrightWhite_JetBlack_1201A922.100_DESKTOP_RELEASES.webp" alt="">
					<div class="descri">
						<span>ASICS</span>
						<h5>ASICS X UNAFFECTED GEL-KAYANO 14 - BRIGHT WHITE/JET BLACK</h5>
						<div class="star">
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
						</div>
						<h4>$98</h4>
					</div>
					<a href="#"></i><i class="_cart"><i class="fa fa-shopping-cart "></i></i></a>
				</div>
				<div class="pro">
					<img src="products/AirJordan13Retro-White_Wheat_414571-171_DESKTOP.webp" alt="">
					<div class="descri">
						<span>JORDAN</span>
						<h5>AIR JORDAN 13 RETRO - WHITE/WHEAT</h5>
						<div class="star">
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
							<i class="fa-solid fa-star"></i>
						</div>
						<h4>$98</h4>
					</div>
					<a href="#"></i><i class="_cart"><i class="fa fa-shopping-cart "></i></i></a>
				</div>

			</div>
		</section>
		<section id="newsletter">
			<div class="newstext">
				<h4>Sign Up for News letters</h4>
				<p>Get E-mail updates about our latest shop and <span>special offers</span>
				</p>
			</div>
			<div class="form">
				<input type="text" placeholder="Your email address">
				<button class="normal">Sign up</button>
			</div>

		</section>
		<?php include('Layouts/footer.php'); ?>

		<script>
			var MainImg = document.getElementById("MainImg");
			var smallimg = document.getElementsByClassName("small-img");

			for (let i = 0; i < 4; i++) {
				smallimg[i].onclick = function() {
					MainImg.src = smallimg[i].src;
				}
			}
		</script>
		<script src="script.js"></script>
		<script src="https://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
		<script>
			function loadGoogleTranslate() {
				new google.translate.TranslateElement("google_element")
			}
		</script>
		</body>
		</html>