<?php

include 'config.php';
if(isset($_POST['submit']))
{
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = mysqli_real_escape_string($conn,md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn,md5($_POST['cpassword']));
    $user_type = $_POST['user_type'];

    $select_users = mysqli_query($conn, "SELECT * FROM `users` 
WHERE email = '$email'AND password = '$pass' ")  or die ("Query Failed");
    if(mysqli_num_rows($select_users)> 0){
        $message[] = 'User Already Exists!';
    }
    else{
        if($pass!= $cpass)
        {
            $message[] = 'Confirm Password Not Matched!';
        }
        else{

        mysqli_query($conn,"INSERT INTO `users` (name,email,password, user_type)
        VALUES('$name','$email', '$cpass', '$user_type') ")
        or die('Query Failed!');
        $message[] = 'Registered Successfully!';
        header('location:login.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title> 
    <!--font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    
    <!--custom css file link-->
    <link rel="stylesheet" href="css/style.css">


</head>
<body>
<script src="https://apps.elfsight.com/p/platform.js" defer></script>
<div class="elfsight-app-e15dd054-acbc-44da-a210-9376ddfee33d"></div>
<?php
if(isset($message)){
    foreach($message as $message){
        echo'
        <div class = "message">p[
            <span>'.$message.'</span>
            <i class = "fas fa-times" onclick = "this.parentElement.remove();"></i>
            </div>
        ';
    }
}
?>

<div class="form-container">
    <form action="" method = "post">
        <h3>Register Now!</h3>
        <input type="text" name = "name" placeholder = "Enter your name" required class = "box">
        <input type="email" name = "email" placeholder = "Enter your email" required class = "box">
        <input type="password" name = "password" placeholder = "Enter your password" required class = "box">
        <input type="password" name = "cpassword" placeholder = "Confirm your password" required class = "box">
        <select name="user_type" class = "box">
            <option value="user">user</option>
            <option value="admin">admin</option>
        </select>
        <input type="submit" name = "submit" value = "register now" class = "btn">
        <p>Already have an account? <a href="login.php">login now</a> </p>
    </form>

</div>    

</body>
</html>