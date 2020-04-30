<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>POI Search</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
<title>Search POI</title>
<body>
    <?php
        //Basic session check to ensure login has been passed
        session_start();
        if (!isset ($_SESSION["login_passed"])):
            echo "You shouldn't be here!!";
        else:
            //Establish connection to DB using hard coded credentials
            $db = new PDO('mysql:unix_socket=/tmp/mysql.sock;dbname=assign244', 'cam', 'cancan');
            //Process POI search variables from user, replace with blank if specific variable not given
            if (isset($_POST["name"])):
                $location_name = $_POST["name"];
            else:
                $location_name = '';
            endif;

            if (isset($_POST["type"])):
                $location_type = $_POST["type"];    
            else:
                $location_type = '';
            endif;
            
            if (isset($_POST["country"])):
                $country = $_POST["country"];
            else:
                $country = '';
            endif;

            if (isset($_POST["region"])):
                $region = $_POST["region"];
            else:
                $region = '';
            endif;

            if (isset($_POST["longtitude"])):
                $longtitude = $_POST["longtitude"];
            else:
                $longtitude = '';
            endif;
            
            if (isset($_POST["latitude"])):
                $latitude = $_POST["latitude"];
            else:
                $latitude = '';
            endif;

            if (isset($_POST["description"])):
                $description = $_POST["description"];
            else:
                $description = '';
            endif;

            //Store first part of search query for POI's in database (query pre where clauses)
            $base_query = "SELECT pointsofinterest.ID, pointsofinterest.name, pointsofinterest.type, pointsofinterest.country, pointsofinterest.region, pointsofinterest.lon, pointsofinterest.lat, pointsofinterest.description, pointsofinterest.recommended FROM assign244.pointsofinterest WHERE (";
            //Build where clause from variables given
            if (isset ($location_name)):
                $location_name_part = 'name LIKE "%' . $location_name . '%" AND ';
            else:
                $location_name_part = '';
            endif;

            if ((strlen($location_type))):
                $location_type_part = 'type LIKE "%' . $location_type . '%" AND ';
            else:
                $location_type_part = '';
            endif;

            if ((strlen($country))):
                $country_part = 'country LIKE "' . $country . '" AND ';
            else:
                $country_part = '';
            endif;
            
            if ((strlen($region))):
                $region_part = 'region LIKE "' . $region . '" AND ';
            else:
                $region_part = '';
            endif;
            
            if ((strlen($longtitude))):
                $longtitude_part = 'longtitude = ' . $longtitude . ' AND '; 
            else:
                $longtitude_part = '';
            endif;
            
            if ((strlen($latitude))):
                $latitude_part = 'latitude = ' . $latitude . ' AND ';
            else:
                $latitude_part = '';
            endif;
            //Build overall query eliminating unnecessary AND statements
            $query = $base_query . $location_name_part . $location_type_part . $country_part . $region_part . $longtitude_part . $latitude_part;
            $query = substr_replace($query, "", -4);
            $query = $query . ")";
            //Query database, and print results as rows in table
            $results = $db->query($query);
            echo '<table style="width:80%">
                    <tr><th><h1>Results</h1></th></tr>
                    <tr></tr>
                </table><br><br>';
            echo '<table style="width:95%">
                    <tr><th>Name</th><th>Type</th><th>Country</th><th>Region</th><th>Long</th><th>Lat</th><th>Description</th><th>Recommended</th><th></th></tr>';
            while($row=$results->fetch(PDO::FETCH_ASSOC))
            {
                echo '<td>' . $row["name"] . '</td><td>' . $row["type"] . '</td><td>' . $row["country"] . '</td><td>' . $row["region"] . '</td><td>' . $row["lon"] . '</td><td>' . $row["lon"] . '</td><td>' . $row["description"] . '</td><td>' . $row["recommended"] . '</td><td style="width: 12em;"><form method="post" action="recommend.php"><input type="hidden" name="location_id" value=' . $row["ID"] . '><input type="submit" value="Recommend" /></form><form method="post" action="review_search.php"><input type="hidden" name="location_id" value=' . $row["ID"] . '><input type="submit" value="Reviews" /></form><form method="post" action="review_write.php"><input type="hidden" name="location_id" value=' . $row["ID"] . '><input type="hidden" name="name" value=' . $row["name"] . '><input type="submit" value="Write Review" /></form></td></tr>';
            }
        endif;
        echo "</table>";
        ?>
    <br><br>
    <button><a href = user_dashboard.php>Return to Dashboard</a></button></td>
</body>
</html>