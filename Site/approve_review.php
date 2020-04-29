<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Review Approved</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
<head>
<title>Review Approved</title>
</head>
<body>
    <?php
        session_start();
        if (($_SESSION["admin_state"]) != 1):
            echo "You shouldn't be here!!";
        else:
            $user = $_SESSION["gatekeeper"];
            $review_id = $_POST["review_id"];      
            $db = new PDO('mysql:unix_socket=/tmp/mysql.sock;dbname=assign244', 'cam', 'cancan');
            $db->query('UPDATE poi_reviews SET poi_reviews.approved = 1 WHERE id = ' . $review_id );
            echo 'Review has been approved';
        endif;
    ?>
    <table>
    <tr><td><button><a href = admin_dashboard.php>Return to Admin Dashboard</a></button></td></tr>
    </table>
</body>
</html>
