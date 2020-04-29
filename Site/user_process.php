<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
<head>
<title>HitTastic! Login</title>
</head>
<body>
    <?php
        session_start();
        if (!isset ($_SESSION["gatekeeper"])):
            echo "You shouldn't be here!!";
        else:
            $db = new PDO('mysql:unix_socket=/tmp/mysql.sock;dbname=assign244', 'cam', 'cancan');
            $user = $_SESSION["gatekeeper"];
            $user_id = $db->query('SELECT id FROM poi_users WHERE username = "'. $user .'"');
            while($row=$user_id->fetch(PDO::FETCH_ASSOC))
            {
                $id = $row["id"];
                $_SESSION["user_id"] = $id;
            }
            $admin_check = $db->query('SELECT COUNT(*) FROM poi_users WHERE username = "'. $user .'" AND isadmin = '. 1);
            while($row=$admin_check->fetch(PDO::FETCH_ASSOC))
            {
                $admin_count = $row["COUNT(*)"];
            }
            if ($admin_count == 1):
                $_SESSION["admin_state"] = 1;
                $_SESSION["login_passed"] = 1;
                header ("Location: admin_dashboard.php");
            elseif ($admin_count == 0):
                $_SESSION["admin_state"] = 0;
                $_SESSION["login_passed"] = 1;
                header ("Location: user_dashboard.php");
            else:
                echo "General Error";
            endif;
        endif;
    ?>
</body>
</html>
