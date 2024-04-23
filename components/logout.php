<?php
include ("connect.php");
setcookie( 'id_user', '', time() - 1, '/' );
header( 'location:../locationsHomepage.php' );
?>
