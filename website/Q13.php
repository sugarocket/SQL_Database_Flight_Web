<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title> Flight</title>
    <link rel="stylesheet" href="css/mycss.css">
  </head>
<body>

<h1>Flights</h1>

<?php

$servername = "sql203.epizy.com";
$username = "epiz_32444690";
$password = "qCiiaUqIpzIvWe";
$db = "epiz_32444690_Google_Flight";
$port = 3306;

$conn = mysqli_connect($servername,$username, $password, $db, $port);

#Modify $sql with the query
$sql="SELECT
    f.model,
    ROUND(a.SeatCount/COUNT(f.model),1) AS 'Average_Occupancy'
FROM Flight f, (SELECT
        DISTINCT af.model,
        COUNT(s.Seat_ID) AS SeatCount
    #Cartesian joining together the aircraft, airlines and flight tables
    FROM Aircraft af, Airline al, Flight f, Seat s
    WHERE af.Model = f.Model
        #Make sure the join is for the appropriate primary and foreign keys
        AND al.Airline_Code = f.Airline_Code
        AND s.Flight_ID = f.Flight_ID
    GROUP BY af.model
    ORDER BY COUNT(af.model) DESC) a
WHERE a.model = f.model
GROUP BY f.model
ORDER BY a.SeatCount/COUNT(f.model) ASC;
 ";
  #Summary goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","Most popular aircraft by average number of tickets per flight.";

 #objective goes here
echo "<br><br>","<b>","Objective:","</b>","<br>","The airlines are back! They were so impressed with work they wanted help! Now they are worried about their aircraft, and they want help with which aircraft they should retire based on passenger popularity. What is the least popular aircraft based on the average number of tickets per flight?";

echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results update line 47
if ($result->num_rows > 0) {
    echo "<table><tr><th>Airplane Model</th><th>Average Occupancy of Airplane</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table headers
        echo "<tr><td>" . $row["model"]. "</td><td>" . $row["Average_Occupancy"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
<br />
<br />
<a href="GoogleFlight.html">Home Page</a> <br />
</body>
</html>





