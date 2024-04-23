<?php

include 'components/connect.php';

if (isset($_POST[ 'submit' ])) {

    $email = $_POST[ 'email' ];
    $email = filter_var( $email, FILTER_SANITIZE_STRING );
    $pass  = $_POST[ 'pass' ];
    $pass  = filter_var( $pass, FILTER_SANITIZE_STRING );

    $verify_email = $conn->prepare( "SELECT * FROM `users` WHERE email = ? LIMIT 1" );
    $verify_email->execute( [ $email ] );


    if ($verify_email->rowCount() > 0) {
        $fetch       = $verify_email->fetch( PDO::FETCH_ASSOC );
        $verfiy_pass = password_verify( $pass, $fetch[ 'password' ] );
        if ($verfiy_pass == 1) {
            setcookie( 'user_id', $fetch[ 'id' ], time() + 60 * 60 * 24 * 30, '/' );
            header( 'location:all_posts.php' );
            }
        else {
            $warning_msg[] = 'Incorrect password!';
            }
        }
    else {
        $warning_msg[] = 'Incorrect email!';
        }

    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <!-- header section starts  -->
    <?php include 'components/header.php'; ?>
    <!-- header section ends -->

    <!-- login section starts  -->

    <section class="container">
        <h1 class="form-title">Sign In</h1>
        <form action="" method="post" enctype="multipart/form-data">
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
            <input type="submit" class="btn" value="SignIn" name="submit">
        </form>

    </section>

    <!-- login section ends -->














    <!-- sweetalert cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js file link  -->
    <script src="script.js"></script>

    <?php include 'components/alers.php'; ?>

</body>

</html>