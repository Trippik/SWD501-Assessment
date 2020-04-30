<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Add a Review</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
<head>
<title>Add a Review</title>
</head>
<body>
    <?php
        session_start();
        if (!isset ($_SESSION["login_passed"])):
            echo "You shouldn't be here!!";
        else:
            $user = $_SESSION["gatekeeper"];
            $location_id = $_POST["location_id"];      
            echo '<table style="width:80%">
                    <tr><th><h1>Add a Review</h1></th></tr>
                    <tr></tr>
                    <tr><td>Hi ' . $user . ', please write your review for below</td></tr>
                </table><br><br>';
            echo '<form method="post" action="review_submit.php">
                    <table style="width:80%">
                        <tr><th>Add Review</th><tr>
                        <tr></tr>
                        <tr><td><textarea class="FormElement" name="review" id="term" cols="40" rows="10"></textarea><input type="hidden" name="location_id" value=' . $location_id . '></td></tr>
                        <tr><td><input type="submit" value="Submit review" /></td></tr>
                    </table>
                </form>';
        endif;
    ?>
</body>
</html>