<header class="header">

    <section class="flex">

        <a href="locationsHomepage.php" class="fas fa-home">Locations Homepage</a>


        <nav class="navbar">


            <?php
            if ($id_user == '') {
                ?>
                <a href="login.php" class="fas fa-arrow-right-to-bracket"></a>
                <a href="register.php" class="far fa-registered"></a>
            <?php }
            ; ?>

            <?php
            if ($id_user != '') {
                ?>
                <a href="components/logout.php" class="logout-button"
                    onclick="return confirm('logout from this website?');">logout</a>
            <?php }
            ; ?>
        </nav>

        </div>
        <?php
        ; ?>

    </section>
    <link rel="stylesheet" href="./style.css">

</header>