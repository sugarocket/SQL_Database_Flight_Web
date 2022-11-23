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
$sql="SELECT AVG(CO2_Emissions) AS Average_CO2_Emission 
FROM Flight;
 ";
 #objective goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","Show the average CO2 emission of all the flights.
";
echo "<br><br>","<b>","Objective:", "</b>","<br>","Our shareholders are becoming increasingly concerned by the environment. They want us to display  the average CO2 emission of all the flights in our database in order to see if our business is environmentally friendly.
";

echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results
if ($result->num_rows > 0) {
	#headers are below
    echo "<table><tr><th>Average_CO2_Emission</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table rows
        echo "<tr><td>" . $row["Average_CO2_Emission"]. "</td></tr>";
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



