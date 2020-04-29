<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <?php
        session_start();
        $un = $_POST["username"];
        $pw = $_POST["password"];
        $db = new PDO('mysql:unix_socket=/tmp/mysql.sock;dbname=assign244', 'cam', 'cancan');
        $user_results = $db->query('SELECT COUNT(*) FROM poi_users WHERE username = "'. $un .'" AND password = "'. $pw . '"');
        while($row=$user_results->fetch(PDO::FETCH_ASSOC))
        {
            $account_count = $row["COUNT(*)"];
        }
        if ($account_count == 1):
            $_SESSION["gatekeeper"] = $un;
            header ("Location: user_process.php");
        elseif ($account_count == 0):
            echo "incorrect credentials<br>";
            echo "<button><a href = index.html>Try again</a></button>";
        else:
            echo "General Error";
        endif;
    ?>
    </body>
</html>
