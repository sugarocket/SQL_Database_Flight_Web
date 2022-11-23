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
DISTINCT ap.Airport_City,
ap.Airport_Code,
COUNT(t.Reference_Num) AS 'Num_tic'
FROM Ticket t, Seat s, Flight f, Airports ap
#Make sure the join is for the appropriate primary and foreign keys
WHERE t.Seat_ID = s.Seat_ID
AND s.Flight_ID = f.Flight_ID
AND ap.Airport_Code = f.Airport_Code_Arrival
GROUP BY ap.Airport_Code
#sort by popularity ASC. Least popular on top
ORDER BY COUNT(ap.Airport_City) ASC
LIMIT 3;
 ";
  #Summary goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","Least popular desination buy number of tickets.";

 #objective goes here
echo "<br><br>","<b>","Objective:","</b>","<br>"," All airlines are looking for help. They have asked what is our least popular destination so that they can evaluate and either advertise or drop the flights to that destination.";

echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results update line 47
if ($result->num_rows > 0) {
    echo "<table><tr><th>Airport City</th><th>Airport Code</th><th>Number of Tickets</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table headers
        echo "<tr><td>" . $row["Airport_City"]. "</td><td>" . $row["Airport_Code"]."</td><td>" . $row["Num_tic"]. "</td></tr>"; 
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


