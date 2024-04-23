<header class="header">

    <section class="flex">

        <a href="locationsHomepage.php" class="fas fa-home">Locations Homepage</a>

        <nav class="navbar">
            <!-- <a href="locationsHomepage.php" class="fas fa-home">Locations Homepage</a> -->

            <a href="login.php" class="fas fa-arrow-right-to-bracket"></a>
            <a href="register.php" class="far fa-registered"></a>
            <?php
            if ($user_id != '') {
                ?>
                <div id="user-btn" class="far fa-user"></div>
            <?php }
            ; ?>
        </nav>

        <?php
        if ($user_id != '') {
            ?>
            <div class="profile">
                <?php
                $select_profile = $conn->prepare( "SELECT * FROM `users` WHERE id_user = ? LIMIT 1" );
                $select_profile->execute( [ $user_id ] );
                if ($select_profile->rowCount() > 0) {
                    $fetch_profile = $select_profile->fetch( PDO::FETCH_ASSOC );
                    ?>
                    <p><?= $fetch_profile[ 'username' ]; ?></p>
                    <a href="components/logout.php" class="logout-button"
                        onclick="return confirm('logout from this website?');">logout</a>
                <?php }
                else { ?>
                    <div class="login-button">
                        <p>please login or register!</p>
                        <a href="login.php" class="inline-option-btn">login</a>
                        <a href="register.php" class="inline-option-btn">register</a>
                    </div>
                <?php }
                ; ?>
            </div>
        <?php }
        ; ?>

    </section>
    <link rel="stylesheet" href="./style.css">

</header>