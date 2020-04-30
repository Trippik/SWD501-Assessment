<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Review Search</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
<head>
<title>Review Search</title>
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
            $base_query = 'SELECT pointsofinterest.name, pointsofinterest.type, pointsofinterest.description, poi_reviews.review FROM poi_reviews INNER JOIN pointsofinterest ON poi_reviews.id = poi_reviews.poi_id WHERE poi_reviews.approved = 1 AND poi_reviews.poi_id = ';
            $query = $base_query . $location_id;
            $results = $db->query($query);
            //Query database, and print results as rows in table
            echo '<table style="width:80%">
                    <tr><th><h1>Results</h1></th></tr>
                    <tr></tr>
                </table><br><br>';
            echo '<table style="width:80%">
                    <tr><th>Name</th><th>Type</th><th>Description</th><th>Review</th></tr>';
            while($row=$results->fetch(PDO::FETCH_ASSOC))
            {
                echo '<tr><td>' . $row["name"] . '</td><td>' . $row["type"] . '</td><td>' . $row["description"] . '</td><td>' . $row["review"] . '</td></tr>';
            }
        endif;
        echo "</table>";
    ?>
    <br><br>
    <table>
    <tr><td><button><a href = user_dashboard.php>Return to Dashboard</a></button></td></tr>
    </table>
</body>
</html>