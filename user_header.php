<!-- header section starts  -->

<section class="header">

<div class="flex">
      <img src="..\Final-Project\images\logo website.jpg" alt="logo">
      <a href="reservation.php" class="btn">Book a Stay</a>
      <div id="menu-btn" class="fa fa-bars"></div>
   </div>
 
   <nav class="navbar">
      <a href="index.php#home">Home</a>
      <a href="about.php">About</a>
      <a href="reservation.php">Reservation</a>
      <a href="index.php#gallery">Gallery</a>
      <a href="contact.php">Contact</a>
      <a href="review.php">Reviews</a>
      <?php
      if (isset($_SESSION['loggedin'])) {
         echo '<a href="bookings.php">My Bookings</a>';
      }else {
         echo '<a href="login.php">Login</a>';
      } 
      ?>
      

   </nav>

</section>

<!-- header section ends -->