<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dashboard</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
<head>
<title>Adding POI</title>
</head>
<body>
    <?php
        session_start();
        if (!isset ($_SESSION["login_passed"])):
            echo "You shouldn't be here!!";
        else:
            $db = new PDO('mysql:unix_socket=/tmp/mysql.sock;dbname=assign244', 'cam', 'cancan');
            $location_name = $_POST["name"];
            $location_type = $_POST["type"];
            $country = $_POST["country"];
            $region = $_POST["region"];
            $longtitude = $_POST["longtitude"];
            $latitude = $_POST["latitude"];
            $description = $_POST["description"];
            $user = $_SESSION["gatekeeper"];
            $db->query('INSERT INTO assign244.pointsofinterest(name, type, country, region, lon, lat, description, username) VALUES("' . $location_name . '", "' . $location_type . '", "' . $country . '", "' . $region . '", ' . $longtitude . ', ' . $latitude . ', "' . $description . '", "' . $user . '")');
            echo "Upload Complete <br><br>";
            echo "<button><a href = user_dashboard.php>Return to Dashboard</a></button>";
        endif;
    ?>
</body>
</html>