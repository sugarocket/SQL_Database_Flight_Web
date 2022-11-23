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
$sql="SELECT al.Airline_Name, 
COUNT(f.Flight_ID) 
FROM Airline AS al 
INNER JOIN Flight AS f 
INNER JOIN Aircraft AS ac 
INNER JOIN Seat AS s 
INNER JOIN Airports as ap ON al.Airline_Code = f.Airline_Code 
AND f.Model = ac.Model 
AND f.Flight_ID = s.Flight_ID 
AND f.Airport_Code_Departure = ap.Airport_Code 
WHERE s.Class = 'First' 
AND s.USB = 1 
AND ac.Wifi_Option = 1 
AND ap.Lounge = 1 
GROUP BY al.Airline_Code;
 ";
 #Summary goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","Show airline name, flight ID which flight has first class seat, USB, and WIFI, Lounge as well.";

 #objective goes here
echo "<br><br>","<b>","Objective:","</b>","<br>","Business case: For our VIP customers, they are always looking for a high quality fly experience. Especially for businessmen who often need to travel by air for work, we select all the high-quality flights for them that make sure their business will not be affected.";

echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results
if ($result->num_rows > 0) {
	#headers are below
    echo "<table><tr><th>Airline_Name</th><th>#Flight</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table rows
        echo "<tr><td>" . $row["Airline_Name"]. "</td><td>" . $row["COUNT(f.Flight_ID)"]. "</td></tr>";
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



