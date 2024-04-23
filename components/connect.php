<?php
$host   = "localhost";
$port   = "5432";
$user   = "postgres";
$pass   = "carla";
$dbname = "locations";

$conn = new PDO( "pgsql: host = $host;port=$port; dbname=$dbname; user=$user; password=$pass" );

function create_unique_id()
    {
    $characters        = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters_lenght = strlen( $characters );
    $random_string     = '';
    for ($i = 0; $i < 20; $i++) {
        $random_string .= $characters[ mt_rand( 0, $characters_lenght - 1 ) ];
        }
    return $random_string;
    }

if (isset($_COOKIE[ 'id_user' ])) {
    $id_user = $_COOKIE[ 'id_user' ];
    }
else {
    $id_user = '';
    }

?>
