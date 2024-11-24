<?php
require_once 'components/connect.php';

if (isset($_POST['signup'])) {

    $fullname       = $_POST['fullname'];
    $username       = $_POST['username'];
    $email          = $_POST['email'];
    $phoneNumber    = $_POST['phoneNumber'];   
    $password       = $_POST['password'];
    $cPassword      = $_POST['confirmPassword'];
    $gender         = $_POST['gender'];


    if ($password === $cPassword) {
        
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
        $added_on = date('Y-m-d H:i:s'); // Current timestamp

        // Prepare the SQL statement
        // $stmt = $conn->prepare("INSERT INTO user (name, username, email, mobile, password, added_on) VALUES (?, ?, ?, ?, ?, ?)");
        // $stmt->execute($fullname, $username, $email, $phoneNumber, $password, $added_on);

        // // Execute the statement
        // if ($stmt->execute()) {
        //     echo "User details inserted successfully.";
        // } else {
        //     echo $errMsg = "Error: " . $stmt->error;
        // }

        try {
            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO user (name, username, email, mobile, password, added_on) VALUES (:name, :username, :email, :mobile, :password, :added_on)");
            
            // Bind parameters
            $stmt->bindParam(':name', $fullname);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mobile', $phoneNumber);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':added_on', $added_on);
            
            // Execute the statement
            if ($stmt->execute()) {
                echo "User details inserted successfully.";
            } else {
                echo "Error: Could not execute the statement.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    }else {
        echo $errMsg = "Confirm Password Not Matched!";
    }



  
//   $query = "INSERT INTO `user`(name, username, email,	mobile,	password,	added_on	) VALUES(?, ?, ?, ?, ?, ?)";
//   $insert_message = $conn->prepare()
//      $insert_message->execute([$id, $name, $email, $number, $message]);
//      $success_msg[] = 'message send successfully!';

//   exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP</title>
    <link rel=" stylesheet" href="../Final-Project/css/signup.css"/>
</head>
<body>
    <div class="container">
        <!-- <h1 class="form-title">Sign Up</h1> -->
        <form action="" method="post">
            <div class="main-user-info">
                <div class="user-input-box">
                    <label for="fullname">Full Name</label>
                    <input type="text" 
                           name="fullname" 
                           id="fullname"
                           name="fullname"
                           placeholder="Enter Full Name"/>
                </div>
                <div class="user-input-box">
                    <label for="username">User Name</label>
                    <input type="text" 
                           name="username" 
                           id="username"
                           name="fullname"
                           placeholder="Enter User Name"/>
                </div>
                <div class="user-input-box">
                    <label for="email">Email</label>
                    <input type="email" 
                           name="email" 
                           id="email"
                           name="email"
                           placeholder="Enter Email"/>
                </div>
                <div class="user-input-box">
                    <label for="phoneNumber">Phone Number</label>
                    <input type="text" 
                           name="phoneNumber" 
                           id="phoneNumber"
                           name="phoneNumber"
                           placeholder="Enter Phone Number"/>
                </div>
                <div class="user-input-box">
                    <label for="password">Password</label>
                    <input type="password" 
                           name="password" 
                           id="password"
                           name="password"
                           placeholder="Enter Password"/>
                </div>
                <div class="user-input-box">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" 
                           name="confirmPassword" 
                           id="confirmPassword"
                           name="confirmPassword"
                           placeholder="Confirm Password"/>
                </div>
            </div>
            <div class="gender-details-box">
                <span class="gender-title">Gender</span>
                <div class="gender-category">
                    <input type="radio" name="gender" id="male">
                    <label class="pe-10p" for="male">Male</label>
                    <input type="radio" name="gender" id="female">
                    <label class="pe-10p" for="female">Female</label>
                    <input type="radio" name="gender" id="others">
                    <label class="pe-10p" for="others">Others</label>
                </div>
            </div>
            <div class="form-submit-btn">
                <input type="submit" name="signup" value="Sign Up"/>
            </div>
        </form>
    </div>
</body>
</html>