<?php

include 'components/connect.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locații - Site Turism</title>
    <link rel="stylesheet" href="./styleLocations.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="./script.js" defer></script>
</head>

<body>

    <?php include 'components/header.php';
    ?>

    <!-- <ul>
        
        // if (isset($_COOKIE[ 'id_user' ]) || isset($_SESSION[ 'id_user' ])) {
        //     echo '<li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout></a></li>';
        //     }
        // else {
        //     echo '<li><a href="login.php"><i class="fas fa-user"></i>Login></a></li>';
        //     }
     
        ?>
    </ul> -->
    <!-- <section class="containerLoc">

    <div class="containerLoc">
        <h2>Locații Turistice Exotice</h2>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Caută o locație..." onkeyup="searchLocations()">
        </div>
        <div class="locations">
            
            // include 'components/connect.php';

            // try {
            //     $query = "SELECT * FROM loc";
            //     $stmt  = $conn->prepare( $query );
            //     $stmt->execute();
            //     if ($stmt->rowCount() > 0) {
            //         while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
            //             echo "<div class='location'>";
            //             echo "<img src='{$row[ 'image' ]}' alt='{$row[ 'name' ]}'>";
            //             echo "<h3>{$row[ 'name' ]}</h3>";
            //             echo "<p>{$row[ 'description' ]}</p>";
            //             echo "<button class='see-button'>Vezi mai multe detalii!!</button>";
            //             echo "</div>";
            //             }
            //         }
            //     else {
            //         echo "Nu s-au gasit locatii in baza de date!";
            //         }

            //     }
            // catch ( PDOException $e ) {
            //     echo "Eroare la interogarea bazei de date: " . $e->getMessage();
            //     }

            // $conn = null;


            ?> -->

    <!-- view all posts section starts  -->

    <section class="containerLoc">

        <div>
            <h2>Locatii Exotice</h1>
        </div>
        <div class="search-container">
            <input class="fas fa-search" type="text" id="searchInput" placeholder="Caută o locație..."
                onkeyup="searchLocations()">
        </div>
        <div class="locations">
            <?php
            try {
                $query = "SELECT * FROM loc";
                $stmt  = $conn->prepare( $query );
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
                        echo "<div class='location'>";
                        echo "<img src='{$row[ 'image' ]}' alt='{$row[ 'name' ]}'>";
                        echo "<h3>{$row[ 'name' ]}</h3>";
                        echo "<p>{$row[ 'description' ]}</p>";
                        // echo "<button class='see-button'>Vezi mai multe detalii!!</button>";
                        echo "<a href='locationReview.php' class='see-button'>Review Page</a>";
                        echo "</div>";
                        }
                    }
                else {
                    echo "Nu s-au gasit locatii in baza de date!";
                    }

                }
            catch ( PDOException $e ) {
                echo "Eroare la interogarea bazei de date: " . $e->getMessage();
                }

            $conn = null;
            ?>

        </div>



    </section>

    <script src=" https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- custom js file link  -->
    <script src="script.js"></script>

    <?php include 'components/alers.php'; ?>

</body>

</html>