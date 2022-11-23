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
$sql="SELECT Flight_ID,
al.Num_Accidents AS 'Num_accident of Airline' 
FROM Flight as f
INNER JOIN Airline as al ON f.Airline_Code = al.Airline_Code
ORDER BY al.Num_Accidents ASC;
 ";
 #Summary goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","Show the airline name and all the flights it has, the airline which has a minimal number of accidents.";

 #objective goes here
echo "<br><br>","<b>","Objective:","</b>","<br>"," For the only flight with the lowest number of accidents, we will advertise this feature on the homepage of the website to attract safety-conscious passengers to check all flights belonging to this airline.
";

echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results
if ($result->num_rows > 0) {
	#headers are below
    echo "<table><tr><th>Flight_ID</th><th>Num_accident of Airline</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table rows
        echo "<tr><td>" . $row["Flight_ID"]. "</td><td>" . $row["Num_accident of Airline"]. "</td></tr>";
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



