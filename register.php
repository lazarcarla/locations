<?php

include 'components/connect.php';

if (isset($_POST[ 'submit' ])) {

    // $id_user = hexdec( md5( uniqid( mt_rand(), true ) ) );

    $id_user = create_unique_id();

    $last_name  = $_POST[ 'last_name' ];
    $first_name = $_POST[ 'first_name' ];

    $email = $_POST[ 'email' ];
    $pass  = password_hash( $_POST[ 'password' ], PASSWORD_DEFAULT );

    $verify_email = $conn->prepare( "SELECT * FROM users WHERE email = ?" );
    $verify_email->execute( [ $email ] );

    if ($verify_email->rowCount() > 0) {
        $warning_msg[] = 'Email already taken!';
        }
    else {

        $insert_user = $conn->prepare( "INSERT INTO users(id_user,last_name,first_name,password, email) VALUES(?,?,?,?,?)" );
        $insert_user->execute( [ $id_user, $last_name, $first_name, $pass, $email ] );
        $success_msg[] = 'Registered successfully!';
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

    <!-- custom css file link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <!-- header section starts  -->
    <?php include 'components/header.php'; ?>
    <!-- header section ends -->

    <section class="container">
        <h1 class="form-title">Register</h1>
        <form action="" method="post">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
                <label for="fname">Last Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="first_name" id="firstName" placeholder="First Name" required>
                <label for="lName">First Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <p>Already have an account? <a href="login.php">Login Now</a></p>
            <input type="submit" value="Sign Up" name="submit" class="btn">
        </form>

    </section>














    <!-- sweetalert cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js file link  -->
    <script src="script.js"></script>

    <?php include 'components/alerts.php'; ?>

</body>

</html>