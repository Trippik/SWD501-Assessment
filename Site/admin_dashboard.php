<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin Dashboard</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
<head>
<title>Admin Dashboard</title>
</head>
<body>
    <?php
        session_start();
        if (($_SESSION["admin_state"]) != 1):
            echo "You shouldn't be here!!";
        else:
            $user = $_SESSION["gatekeeper"];
            $db = new PDO('mysql:unix_socket=/tmp/mysql.sock;dbname=assign244', 'cam', 'cancan');
            echo '<table style="width:80%">
                    <tr><th><h1>POI Admin Dashboard</h1></th></tr>
                    <tr></tr>
                    <tr><td>Welcome to the admin dashboard ' . $user . ', please select from the options below</td></tr>
                </table><br><br>';
            $unapproved_reviews = $db->query('SELECT poi_reviews.id, pointsofinterest.name, pointsofinterest.type, pointsofinterest.description, poi_reviews.review FROM poi_reviews INNER JOIN pointsofinterest ON poi_reviews.poi_id = pointsofinterest.id WHERE poi_reviews.approved = 0');
            echo '<table style="width:80%">
                    <tr><th><h1>Results</h1></th></tr>
                    <tr></tr>
                </table><br><br>';
            echo '<table style="width:80%">
                    <tr><th>Name</th><th>Type</th><th>Description</th><th>Review</th></tr>';
            while($row=$unapproved_reviews->fetch(PDO::FETCH_ASSOC))
            {
                echo '<tr><td>' . $row["name"] . '</td><td>' . $row["type"] . '</td><td>' . $row["description"] . '</td><td>' . $row["review"] . '</td><td style="width: 14em;"><form method="post" action="approve_review.php"><input type="hidden" name="review_id" value=' . $row["id"] . '><input type="submit" value="Approve Review" /></form></td></tr>';
            }
            echo '</table>';
        endif;
    ?>
    <br><br>
    <table>
    <tr><td><button><a href = user_dashboard.php>Go to User Dashboard</a></button></td></tr>
    </table>
</body>
</html>