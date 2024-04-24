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

                        $id_location = $row[ 'location_id' ];
                        ?>
                        <div class='location' style='background-color: white'>
                            <img src="<?= $row[ 'image' ]; ?>">
                            <h3><?= $row[ 'name' ]; ?></h3>
                            <p><?= $row[ 'description' ]; ?></p>
                            <a href='locationReview.php?get_id=<?= $id_location; ?>' class='see-button'>Review Page</a>

                        </div>
                        <?php
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

    <?php include 'components/alerts.php'; ?>

</body>

</html>