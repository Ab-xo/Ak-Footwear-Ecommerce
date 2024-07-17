 <?php
  include ('Layouts/header.php');
  ?>
  <style>
    #page-header.about-header {
  background-image: url("banner-box/istockphoto-1430911593-612x612.jpg");
  width: 100%;
  height: 40vh;
  background-size: cover;
  display: flex;
  justify-content: center;
  text-align: center;
  padding: 14px;
  flex-direction: column;
  background-repeat: no-repeat;
  background-position: center;
}
  </style>
 <section id="page-header" class="about-header">
   <h2>#Stay Connected</h2> <br>

   <p>LEAVE A MESSAGE,We Love to hear from you!</p>
 </section>

 <section id="contac-details" class="<section-p1">
   <div class="details">
     <span>GET IN TOUCH</span>
     <h2>Find Us Here,Your Destination for Stylish Steps!</h2>
     <h3>Head Office</h3>
     <div>
       <li>
         <i class="fa-solid fa-map"></i>
         <p>Yabsira Building | Riche | ያብስራ ህንጻ | ሪቼ, A1, Addis Ababa</p>
       </li>
       <li>
         <i class="fa-solid fa-envelope"></i>
         <p>contact@example.com</p>
       </li>
       <li>
         <i class="fa-solid fa-phone"></i>
         <p>+251902377627</p>
       </li>
       <li>
         <i class="fa-solid fa-clock"></i>
         <p>Monday-Friday: 8:30am to 5:30pm | Saturday: 8:30am to 12:30pm | Sunday: Closed</p>
       </li>
     </div>
   </div>
   <div class="map">
     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63050.
            30087149212!2d38.71784360303271!3d9.
            004885285321329!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.
            1!3m3!1m2!1s0x164b85b326d043b7%3A0xc6174aa09a073516!2zWWFic2lyYSBCdWlsZGluZyB8IFJpY2hlIHwg4
            Yur4Yml4Yi14YirIOGIheGKleGMuyB8IOGIquGJvA!5e0!3m2!1sen!2set!4v1706531016445!5m2!1sen!2set" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
   </div>

 </section>
 <div class="container">
   <span class="big-circle"></span>
   <img src="img/shape.png" class="square" alt="" />
   <div class="form">
     <div class="contact-info">
       <h3 class="title">Let's get in touch</h3>
       <p class="text">
         Explore our help or contact our team.
       </p>
       <div class="info">
         <div class="information">
           <img src="img/location.png" class="icon" alt="" />
           <p>Yabsira Building | Riche | ያብስራ ህንጻ | ሪቼ, A1, Addis Ababa</p>
         </div>
         <div class="information">
           <img src="img/email.png" class="icon" alt="" />
           <p>gebeyehuabraham19@gmail.com</p>
         </div>
         <div class="information">
           <img src="img/phone.png" class="icon" alt="" />
           <p>123-456-789</p>
         </div>
       </div>

       <div class="social-media">
         <p>Connect with us :</p>
         <div class="social-icons">
           <a href="#">
             <i class="fab fa-facebook-f"></i>
           </a>
           <a href="#">
             <i class="fab fa-twitter"></i>
           </a>
           <a href="#">
             <i class="fab fa-instagram"></i>
           </a>
           <a href="#">
             <i class="fab fa-linkedin-in"></i>
           </a>
         </div>
       </div>
     </div>

     <div class="contact-form">
       <span class="circle one"></span>
       <span class="circle two"></span>

       <form action="https://formspree.io/f/mdoqaqbv" method="POST" onsubmit="validateForm()">
         <h3 class="title">Contact us</h3>
         <div class="input-container">
           <input type="text" id="name" name="name" class="input" placeholder="Username"   required on invalid="this.setCustomValidity('Please Enter Your Name ')" on input="this.setCustomValidity('')">
           
         </div>
         <div class="input-container">
           <input type="email" id="email" name="email" class="input" placeholder="Email"  required on invalid="this.setCustomValidity('Please Enter Your Email ')" on input="this.setCustomValidity('')" />
           
         </div>
         <div class="input-container">
           <input type="phone" id="phone" name="tel" class="input" placeholder="phone" required on invalid="this.setCustomValidity('Please Enter Your Phone ')" on input="this.setCustomValidity('')" />
          
         </div>
         <div class="input-container textarea">
           <textarea id="mess" name="message" class="input" rows="4" placeholder="message"   required on invalid="this.setCustomValidity('Please Enter Your Message ')" on input="this.setCustomValidity('')"></textarea>
         </div>
         <input type="submit" value="Send" class="btn" />
       </form>
     </div>
   </div>
 </div>

 <?php
  include ('Layouts/footer.php');
  ?>
 <script src="js/script.js"></script>
 <script src="https://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
 <script>
   function loadGoogleTranslate() {
     new google.translate.TranslateElement("google_element")
   }
 </script>
 </body>

 </html>