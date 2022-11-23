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
$sql="SELECT Model, AVG(CO2_Emissions) AS average
FROM Flight
WHERE Duration BETWEEN 5 AND 10
GROUP BY Model
ORDER BY average DESC
LIMIT 3;
 ";

#Summary goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","Find out the top three aircraft models with the highest average CO2 emissions for flights with durations between 5 and 10 hours.";

 #objective goes here
echo "<br><br>","<b>","Objective:","</b>","<br>"," In recent years, increasing global warming has put increasing pressure on the aviation industry. Green aviation has become a hot topic, and both governments and ICAO attach great importance to it. So, we want to look at the average CO2 emissions of flights for the specific aircraft model with the most common flight duration between 5 and 10 hours, to provide data support for our subsequent optimization decisions.
";

echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results
if ($result->num_rows > 0) {
	#headers are below
    echo "<table><tr><th>Model</th><th>Average CO2 Emissions</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table rows
        echo "<tr><td>" . $row["Model"]. "</td><td>" . $row["average"]. "</td></tr>";
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



