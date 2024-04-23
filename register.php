<?php

include 'components/connect.php';

if (isset($_POST[ 'submit' ])) {

    $id         = create_unique_id();
    $last_name  = $_POST[ 'last_name' ];
    $last_name  = filter_var( $last_name, FILTER_SANITIZE_STRING );
    $first_name = $_POST[ 'first_name' ];
    $first_name = filter_var( $firts_name, FILTER_SANITIZE_STRING );

    $email = $_POST[ 'email' ];
    $email = filter_var( $email, FILTER_SANITIZE_STRING );
    $pass  = password_hash( $_POST[ 'password' ], PASSWORD_DEFAULT );
    $pass  = filter_var( $pass, FILTER_SANITIZE_STRING );

    $verify_email = $conn->prepare( "SELECT * FROM `users` WHERE email = ?" );
    $verify_email->execute( [ $email ] );

    if ($verify_email->rowCount() > 0) {
        $warning_msg[] = 'Email already taken!';
        }
    else {
        if ($c_pass == 1) {
            $insert_user = $conn->prepare( "INSERT INTO `users`(id, last_name,first_name,password, email) VALUES(?,?,?,?,?)" );
            $insert_user->execute( [ $id, $last_name, $first_name, $pass, $email ] );
            $success_msg[] = 'Registered successfully!';
            }
        else {
            $warning_msg[] = 'Confirm password not matched!';
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
        <form action="" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
                <label for="fname">Last Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="first_Name" id="firstName" placeholder="First Name" required>
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
    <script src="js/script.js"></script>

    <?php include 'components/alers.php'; ?>

</body>

</html>