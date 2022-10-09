<?php

include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id))
{
    header('location:login.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>

     <!--font awesome cdn link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!--custom admin css file link -->
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>
    
    
    
    
    <!-- custom admin JS file link -->
    <script src = "js/admin_script.js"></script>
<!-- admin dashboard section starts -->
<div class="admin_animcontainer">



<section class="dashboard">

    <h1 class="title">dashboard</h1>
    <div class="box-container">
        <div class="box">
        <?php
            $total_pendings = 0;
            $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` 
            WHERE payment_status = 'pending' ") or die ('Query Failed');
            if(mysqli_num_rows($select_pending) > 0)
            {
                while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                    $total_price = $fetch_pendings['total_price'];
                    $total_pendings += $total_price; 
                };
            };
        ?>
        <h3>$<?php echo $total_pendings; ?>/-</h3>
        <p>Total Pendings</p>
        </div>



        <div class="box">
        <?php
             $total_completed = 0;
             $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
             if(mysqli_num_rows($select_completed) > 0){
                while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                   $total_price = $fetch_completed['total_price'];
                   $total_completed += $total_price;
                };
             };
        ?>
        <h3>$<?php echo $total_completed; ?>/-</h3>
        <p>Completed Payments</p>
        </div>
        
        <div class="box">
            <?php
                $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                $number_of_orders = mysqli_num_rows($select_orders);
            ?>
            <h3><?php echo $number_of_orders;  ?></h3>
            <p>Orders Placed</p>
        </div>
        <div class="box">
            <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('Query Failed');
                $number_of_products = mysqli_num_rows($select_products);
            ?>
            <h3><?php echo $number_of_products;  ?></h3>
            <p>Products Added</p>
        </div>
        <div class="box">
            <?php
                $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('Query Failed');
                $number_of_users = mysqli_num_rows($select_users);
            ?>
            <h3><?php echo $number_of_users;  ?></h3>
            <p>Normal Users</p>
        </div>
        <div class="box">
            <?php
                $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('Query Failed');
                $number_of_admins = mysqli_num_rows($select_admins);
            ?>
            <h3><?php echo $number_of_admins;  ?></h3>
            <p>Admins</p>
        </div>
        <div class="box">
            <?php
                $select_accounts = mysqli_query($conn, "SELECT * FROM `users`") or die('Query Failed');
                $number_of_accounts = mysqli_num_rows($select_accounts);
            ?>
            <h3><?php echo $number_of_accounts;  ?></h3>
            <p>Total Accounts</p>
        </div>
        <div class="box">
            <?php
                $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('Query Failed');
                $number_of_messages = mysqli_num_rows($select_messages);
            ?>
            <h3><?php echo $number_of_messages;  ?></h3>
            <p>New Messages</p>
        </div>

    </div>
</section>
</div>
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
    let container = document.querySelector('.admin_animcontainer');
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


<!-- admin dashboard section ends -->
</body>
</html>