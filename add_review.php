<?php
include 'components/connect.php';

if (isset($_GET[ 'get_id' ])) {
    $get_id = $_GET[ 'get_id' ];

    }
else {
    $get_id = '';
    header( 'location:locationsHomepage.php' );
    }

if (isset($_POST[ 'submit' ])) {
    if ($id_user != '') {
        $id          = create_unique_id();
        $title       = $_POST[ 'title' ];
        $title       = filter_var( $title, FILTER_SANITIZE_STRING );
        $description = $_POST( [ 'description' ] );
        $description = filter_var( $description, FILTER_SANITIZE_STRING );
        $rating      = $_POST[ 'rating' ];
        $rating      = filter_var( $rating, FILTER_SANITIZE_STRING );

        $verify_review = $conn->prepare( "SELECT * FROM `reviews` where id_loc = ? and is_user = ?" );
        $verify_review->execute( [ $get_id, $id_user ] );

        if ($verify_review->rowCount() > 0) {
            $warning_msg[] = 'Your review was allready added!';
            }
        else {
            $add_review = $conn->prepare( "INSERT INTO `reviews`(id_review, title, rating, id_location, description) VALUES(?,?,?,?,?)" );
            $add_review->execute( [ $id, $title, $rating, $get_id, $description ] );
            $msg_succes = 'Review added succesfully!';
            }

        }
    else {
        $warning_msg = 'Please login first!';
        }
    }

?>


<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add review</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>

<?php include 'components/header.php';

?>

<section class="account-form">
    <form action="" method="post">
        <h2> Post your review</h2>
        <p class="placeholder"> Review title<span>*</span></p>
        <input type="text" name="title" required maxlength="50" placeholder="Enter review title" class="box">
        <p class="placeholder"> Review description<span>*</span></p>
        <textarea type="text" name="title" required maxlength="1000" cols="30" rows="10"
            placeholder="Enter review description" class="box"></textarea>

        <p class="placeholder">Review rating<span>*</span></p>
        <select name="rating" class="box" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <input type="submit" value="submit review" name="submit" class="btn">
        <a href="locationReview.php?get_id=<?= $get_id; ?>" class="option-btn">go back</a>
    </form>

</section>

<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="script.js"></script>


<?php include 'components/alers.php'; ?>

</body>

</html>