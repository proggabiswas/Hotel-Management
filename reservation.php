<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   setcookie('user_id', create_unique_id(), time() + 60*60*24*30, '/');
   header('location:index.php');
}

if(isset($_POST['cancel'])){

   $booking_id = $_POST['booking_id'];
   $booking_id = filter_var($booking_id, FILTER_SANITIZE_STRING);

   $verify_booking = $conn->prepare("SELECT * FROM `bookings` WHERE booking_id = ?");
   $verify_booking->execute([$booking_id]);

   if($verify_booking->rowCount() > 0){
      $delete_booking = $conn->prepare("DELETE FROM `bookings` WHERE booking_id = ?");
      $delete_booking->execute([$booking_id]);
      $success_msg[] = 'booking cancelled successfully!';
   }else{
      $warning_msg[] = 'booking cancelled already!';
   }
   
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" >

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../Final-Project/css/reservation.css">
   <link rel="stylesheet" href="../Final-Project/css/style.css">
</head>
<body>
   
 <?php include 'components/user_header.php'; ?>
    <!-- reservation section starts  -->

    <section class="reservation" id="reservation">

<form action="" method="post">
   <h3>make a reservation</h3>
   <div class="flex">
      <div class="box">
         <p>your name <span>*</span></p>
         <input type="text" name="name" maxlength="50" required placeholder="enter your name" class="input">
      </div>
      <div class="box">
         <p>your email <span>*</span></p>
         <input type="email" name="email" maxlength="50" required placeholder="enter your email" class="input">
      </div>
      <div class="box">
         <p>your number <span>*</span></p>
         <input type="number" name="number" maxlength="10" min="0" max="9999999999" required placeholder="enter your number" class="input">
      </div>
      <div class="box">
         <p>rooms <span>*</span></p>
         <select name="rooms" class="input" required>
            <option value="1" selected>1 room</option>
            <option value="2">2 rooms</option>
            <option value="3">3 rooms</option>
            <option value="4">4 rooms</option>
            <option value="5">5 rooms</option>
            <option value="6">6 rooms</option>
         </select>
      </div>
      <div class="box">
         <p>check in <span>*</span></p>
         <input type="date" name="check_in" class="input" required>
      </div>
      <div class="box">
         <p>check out <span>*</span></p>
         <input type="date" name="check_out" class="input" required>
      </div>
      <div class="box">
         <p>adults <span>*</span></p>
         <select name="adults" class="input" required>
            <option value="1" selected>1 adult</option>
            <option value="2">2 adults</option>
            <option value="3">3 adults</option>
            <option value="4">4 adults</option>
            <option value="5">5 adults</option>
            <option value="6">6 adults</option>
         </select>
      </div>
      <div class="box">
         <p>childs <span>*</span></p>
         <select name="childs" class="input" required>
            <option value="0" selected>0 child</option>
            <option value="1">1 child</option>
            <option value="2">2 childs</option>
            <option value="3">3 childs</option>
            <option value="4">4 childs</option>
            <option value="5">5 childs</option>
            <option value="6">6 childs</option>
         </select>
      </div>
   </div>
   <input type="submit" value="Book Now" name="book" class="btn">
</form>

</section>
 
 <!-- reservation section ends -->

  
 <?php include 'components/footer.php'; ?>
 
 
 
 
 
 
 
 <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
 
 <!-- custom js file link  -->
 <script src="../Final-Project/js/script.js"></script>
 <?php include 'components/message.php'; ?>
    
</body>
</html>