<?php
include 'components/connect.php';

if (isset($_GET[ 'get_id' ])) {
    $get_id = $_GET[ 'get_id' ];
    }
else {
    $get_id = '';
    header( 'location: locationsHomepage.php' );
    }

if (isset($_POST[ 'delete_review' ])) {
    $delete_id = $_POST[ 'delete_id' ];

    $verify_delete = $conn->prepare( "SELECT * FROM reviews WHERE id_review = ?" );
    $verify_delete->execute( [ $delete_id ] );

    if ($verify_delete->rowCount() > 0) {
        $delete_review = $conn->prepare( "DELETE FROM reviews WHERE id_review=?" );
        $delete_review->execute( [ $delete_id ] );

        $success_msg[] = 'Review deleted succesfully!';

        }
    else {
        $warning_msg[] = 'Review allready deleted!';
        }


    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view post</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


</head>

<body>
    <?php include 'components/header.php'; ?>

    <section class="view-post">
        <!-- <div class="heading">
            <h1>Location Details</h1><a href="locationsHomepage.php">All locations</a>
        </div> -->

        <?php
        $select_location = $conn->prepare( "SELECT * FROM loc WHERE location_id = ? LIMIT 1" );
        $select_location->execute( [ $get_id ] );
        if ($select_location->rowCount() > 0) {
            while ( $fetch_location = $select_location->fetch( PDO::FETCH_ASSOC ) ) {
                $total_ratings = 0;
                $rating_1      = 0;
                $rating_2      = 0;
                $rating_3      = 0;
                $rating_4      = 0;
                $rating_5      = 0;

                $select_rating = $conn->prepare( "SELECT * FROM reviews WHERE id_location = ?" );

                $select_rating->execute( [ $fetch_location[ 'location_id' ] ] );
                $total_reviews = $select_rating->rowCount();
                while ( $fetch_rating = $select_rating->fetch( PDO::FETCH_ASSOC ) ) {
                    $total_ratings += $fetch_rating[ 'rating' ];
                    if ($fetch_rating[ 'rating' ] == 1) {
                        $rating_1 += $fetch_rating[ 'rating' ];
                        }
                    if ($fetch_rating[ 'rating' ] == 2) {
                        $rating_2 += $fetch_rating[ 'rating' ];
                        }
                    if ($fetch_rating[ 'rating' ] == 3) {
                        $rating_3 += $fetch_rating[ 'rating' ];
                        }
                    if ($fetch_rating[ 'rating' ] == 4) {
                        $rating_4 += $fetch_rating[ 'rating' ];
                        }
                    if ($fetch_rating[ 'rating' ] == 5) {
                        $rating_5 += $fetch_rating[ 'rating' ];
                        }
                    }
                if ($total_reviews != 0) {
                    $average = round( $total_ratings / $total_reviews, 1 );
                    }
                else {
                    $average = 0;
                    }


                ?>
                <div class="row">
                    <div class="col">
                        <h3 class="title"><?= $fetch_location[ 'name' ]; ?></h3>
                    </div>
                    <div class="col">
                        <div class="flex">
                            <div class="total-reviews">
                                <h3><?= $average; ?><i class="fas fa-star"></i></h3>
                                <p><?= $total_reviews; ?> reviews</p>
                            </div>
                            <div class="total-ratings">
                                <p>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <span><?= 5 ?></span>
                                </p>
                                <p>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <span><?= 4 ?></span>
                                </p>
                                <p>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <span><?= 3 ?></span>
                                </p>
                                <p>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <span><?= 2 ?></span>
                                </p>
                                <p>
                                    <i class="fas fa-star"></i>
                                    <span><?= 1 ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
            }
        else {
            echo '<p class="empty">Location is missing!</p>';
            }
        ?>

    </section>

    <section class="reviews-container">

        <div class="heading">
            <a href="add_review.php?get_id=<?= $get_id; ?>" class="inline-btn" style="margin-top: 0;">add review</a>

        </div>

        <div class="box-container">

            <?php
            $select_reviews = $conn->prepare( "SELECT * FROM reviews WHERE id_location = ?" );
            $select_reviews->execute( [ $get_id ] );
            if ($select_reviews->rowCount() > 0) {
                while ( $fetch_review = $select_reviews->fetch( PDO::FETCH_ASSOC ) ) {
                    ?>
                    <div class="box" <?php if ($fetch_review[ 'id_user' ] == $id_user) {
                        echo 'style="order: -1;"';
                        }
                    ; ?>>
                        <?php
                        $select_user = $conn->prepare( "SELECT * FROM users WHERE id_user = ?" );
                        $select_user->execute( [ $fetch_review[ 'id_user' ] ] );
                        while ( $fetch_user = $select_user->fetch( PDO::FETCH_ASSOC ) ) {
                            ?>
                            <div class="user">
                                <p><?= $fetch_user[ "first_name" ] . '' . $fetch_user[ "last_name" ]; ?></p>
                            </div>

                        <?php }
                        ; ?>



                        <div class="ratings">
                            <?php if (isset($fetch_review[ 'rating' ]) && $fetch_review[ 'rating' ] == 1) { ?>
                                <p style="background:var(--red);"><i class="fas fa-star"></i>
                                    <span><?= $fetch_review[ 'rating' ]; ?></span>
                                </p>

                            <?php }
                            ; ?>
                            <?php if (isset($fetch_review[ 'rating' ]) && $fetch_review[ 'rating' ] == 2) { ?>
                                <p style="background:var(--orange);"><i class="fas fa-star"></i>
                                    <span><?= $fetch_review[ 'rating' ]; ?></span>
                                </p>
                            <?php }
                            ; ?>

                            <?php if (isset($fetch_review[ 'rating' ]) && $fetch_review[ 'rating' ] == 3) { ?>
                                <p style="background:var(--orange);"><i class="fas fa-star"></i>
                                    <span><?= $fetch_review[ 'rating' ]; ?></span>
                                </p>
                            <?php }
                            ; ?>

                            <?php if (isset($fetch_review[ 'rating' ]) && $fetch_review[ 'rating' ] == 4) { ?>
                                <p style="background:var(--main-color);"><i class="fas fa-star"></i>
                                    <span><?= $fetch_review[ 'rating' ]; ?></span>
                                </p>
                            <?php }
                            ; ?>

                            <?php if (isset($fetch_review[ 'rating' ]) && $fetch_review[ 'rating' ] == 5) { ?>
                                <p style="background:var(--main-color);"><i class="fas fa-star"></i>
                                    <span><?= $fetch_review[ 'rating' ]; ?></span>
                                </p>
                            <?php }
                            ; ?>
                        </div>
                        <?php if ($fetch_review && isset($fetch_review[ 'title' ])) { ?>
                            <h3 class="title"><?= $fetch_review[ 'title' ]; ?></h3>
                        <?php }
                        ; ?>

                        <?php if ($fetch_review && isset($fetch_review[ 'description' ]) && $fetch_review[ 'description' ] != '') { ?>
                            <p class="description"><?= $fetch_review[ 'description' ]; ?></p>
                        <?php }
                        ; ?>
                        <?php if ($fetch_review && isset($fetch_review[ 'id_user' ]) && $fetch_review[ 'id_user' ] == $id_user) { ?>
                            <form action="" method="post" class="flex-btn">
                                <input type="hidden" name="delete_id" value="<?= $fetch_review[ 'id_review' ]; ?>">
                                <a href="update_review.php?get_id=<?= $fetch_review[ 'id_review' ]; ?>" class="inline-option-btn"><i
                                        class="fas fa-edit"></i> edit
                                    review</a>
                                <!-- <input type="submit" value="delete review" class="inline-delete-btn" name="delete_review"
                                    onclick="return confirm('delete this review?');"> -->
                                <button type="submit" class="inline-delete-btn" name="delete_review"
                                    onclick="return confirm('Delete this review?');">
                                    <i class="fas fa-trash-alt"></i> Delete Review
                                </button>
                            </form>
                        <?php }
                        ; ?>
                    </div>

                    <?php
                    }
                }
            else {
                echo '<p class="empty">no reviews added yet!</p>';
                }
            ?>

        </div>


    </section>

    <!-- reviews section ends -->
    <!-- sweetalert cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js file link  -->
    <script src="script.js"></script>

    <?php include 'components/alerts.php'; ?>

</body>

</html>