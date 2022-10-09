<?php

include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];
if(!isset($user_id))
{
    header('location:login.php');
}

if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = $_POST['number'];
    $msg = mysqli_real_escape_string($conn, $_POST['message']);
 
    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');
 
    if(mysqli_num_rows($select_message) > 0){
       $message[] = 'Message sent already!';
    }else{
       mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
       $message[] = 'Message sent successfully!';
    }
 
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <?php include 'header.php'; ?>
    <script src="https://apps.elfsight.com/p/platform.js" defer></script>
<div class="elfsight-app-e15dd054-acbc-44da-a210-9376ddfee33d"></div>

<div class="contact_animcontainer">
    <div class="heading">
   <h3>contact us</h3>
   <p> <a href="home.php">home</a> / contact </p>
</div>

<section class="contact">

   <form action="" method="post">
      <h3>say something!</h3>
      <input type="text" name="name" required placeholder="enter your name" class="box">
      <input type="email" name="email" required placeholder="enter your email" class="box">
      <input type="number" name="number" required placeholder="enter your number" class="box">
      <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form>

</section>

</div>

















    <?php include 'footer.php'; ?>

    <!--custom js file link -->
    <script src="js/script.js"></script>
    <script >

let colors = [
    '#74b9ff',
    '#ff7675',
    '#fd79a8',
    '#fdcb6e',
    '#55efc4',
    '#fd9644'
]

function createElement(){
    let container = document.querySelector('.contact_animcontainer');
    let span = document.createElement('span');

    var size = Math.random()*50;
    let bg = colors[Math.floor(Math.random()*colors.length)];
    span.style.height = 50 + size + 'px';
    span.style.width = 50 + size + 'px';
    span.style.top = Math.random() * innerHeight + 'px';
    span.style.left = Math.random() * innerWidth + 'px';
    span.style.background = bg;

    container.appendChild(span);
    setTimeout(() => {
       span.remove() 
    }, 5000);
}

setInterval(createElement, 100);




    </script>

</body>
</html>