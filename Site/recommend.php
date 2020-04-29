<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Adding Recommendation</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
<head>
<title>Adding Recommendation</title>
</head>
<body>
    <?php
        session_start();
        if (!isset ($_SESSION["login_passed"])):
            echo "You shouldn't be here!!";
        else:
            $location_id = $_POST["location_id"];
            $user = $_SESSION["gatekeeper"];
            //Establish connection to DB using hard coded credentials
            $db = new PDO('mysql:unix_socket=/tmp/mysql.sock;dbname=assign244', 'cam', 'cancan');
            $db->query('UPDATE pointsofinterest SET recommended = recommended + 1 WHERE ID = ' . $location_id);
        endif;
    ?>
    <br><br>
    <table>
    <tr><td><button><a href = user_dashboard.php>Return to Dashboard</a></button></td></tr>
    </table>
</body>
</html>
