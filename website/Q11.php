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
a.Airport_City AS 'Destination',
COUNT(a.Airport_City) AS 'Popularity'
FROM
#Create large dataset joining all the tables together
(SELECT ap.Airport_City
FROM Ticket t, Seat s, Flight f, Airports ap
WHERE t.Seat_ID = s.Seat_ID
#Make sure the join is for the appropriate primary and foreign keys
AND s.Flight_ID = f.Flight_ID
AND ap.Airport_Code=f.Airport_Code_Arrival) a
GROUP BY a.Airport_City
#sort by popularity descending. Largest on top
ORDER BY COUNT(a.Airport_City)
#Limit to top 10
LIMIT 10;
 ";
  #Summary goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","Most traveled airports by number of tickets.";

 #objective goes here
echo "<br><br>","<b>","Objective:","</b>","<br>","We are looking to grow our business by advertising for our least popular destinations. What is the least popular destination we have booked and can use for advertising?";

echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results update line 47
if ($result->num_rows > 0) {
    echo "<table><tr><th>Desination</th><th>Popularity</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table headers
        echo "<tr><td>" . $row["Destination"]. "</td><td>" . $row["Popularity"]. "</td></tr>";
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


