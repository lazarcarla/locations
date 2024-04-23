<?php
$host   = "localhost";
$port   = "5432";
$user   = "postgres";
$pass   = "carla";
$dbname = "locations";

// try {
//     $conn = new PDO( "pgsql: host = $host;port=$port; dbname=$dbname; user=$user; password=$pass" );
//     $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//     }
// catch ( PDOException $e ) {
//     echo "Eroare la conectarea la baza de date: " . $e->getMessage();
//     }

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

if (isset($_COOKIE[ 'user_id' ])) {
    $user_id = $_COOKIE[ 'user_id' ];
    }
else {
    $user_id = '';
    }

?>
