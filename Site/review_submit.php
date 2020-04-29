<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Submmiting Review</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
<head>
<title>Submmiting Review</title>
</head>
<body>
    <?php
        session_start();
        if (!isset ($_SESSION["login_passed"])):
            echo "You shouldn't be here!!";
        else:
            //Bring in necessary variables
            $user = $_SESSION["gatekeeper"];
            $user_id = $_SESSION["user_id"];
            $location_id = $_POST["location_id"];
            $review = $_POST["review"];
            //Establish connection to DB using hard coded credentials
            $db = new PDO('mysql:unix_socket=/tmp/mysql.sock;dbname=assign244', 'cam', 'cancan');
            $db->query('INSERT INTO poi_reviews (poi_id, review) VALUES (' . $location_id . ', "' . $review . '")');
            echo 'Hi ' . $user . ' your review has been submitted!';
        endif;
    ?>
    <br><br>
    <button><a href = user_dashboard.php>Return to Dashboard</a></button></td>
</body>
</html>
