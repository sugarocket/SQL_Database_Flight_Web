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
$sql="SELECT Flight_ID, Duration, CO2_Emissions
FROM Flight
WHERE Duration < 5;
 ";
 #Summary goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","Show the CO2 emission rate of all the flights that have an average duration less than 5 hours.";
 #objective goes here
echo "<br><br>","<b>","Objective:","</b>","<br>","[Display the CO2 emission rate of all the flights that have an average duration less than 5 hours.]
";
echo "</b>","<br>","The purpose of this query is to understand if the duration of the flight is correlated to the amount of CO2 emitted by the aircraft in order to better meet the demand of eco-friendly travelers.
";

echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results
if ($result->num_rows > 0) {
	#headers are below
    echo "<table><tr><th>Flight_ID</th><th>Duration</th><th>CO2_Emissions</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table rows
        echo "<tr><td>" . $row["Flight_ID"]. "</td><td>" . $row["Duration"]. "</td><td>". $row["CO2_Emissions"]. "</td></tr>";
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



