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
$sql='
SELECT r,
	(CASE WHEN ABS(r) BETWEEN 0.9 AND 1.0 THEN "Very highly correlated"
    WHEN ABS(r) BETWEEN 0.7 AND 0.9 THEN "Highly correlated"
	WHEN ABS(r) BETWEEN 0.5 AND 0.7 THEN "Moderately correlated"
	WHEN ABS(r) BETWEEN 0.3 AND 0.5 THEN "Low correlated"
	ELSE "No significant correlation" END) AS CorrelationCoefficients
FROM(
	SELECT
		ROUND((SUM(
			(Reputation_Rate - (SELECT ROUND(AVG(Reputation_Rate),2) AS Avg_Reputation_Rate FROM Airline))
			 * (Num_Accidents - (SELECT ROUND(AVG(Num_Accidents),2) AS Avg_Num_Accidents FROM Airline))
			)
		/ (
			(COUNT(Reputation_Rate) - 1)
			 * (SELECT ROUND(STDDEV_SAMP(Reputation_Rate) * STDDEV_SAMP(Num_Accidents),2) AS Division FROM Airline)
			)
		),2) AS r
	FROM Airline
) AS temp;
 ';

#Summary goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","Find correlation between an airline's reputation score and its number of accidents.
";

 #objective goes here
echo "<br><br>","<b>","Objective:","</b>","<br>","Recently, aircraft accidents have become more and more frequent. We want to know if each airline's reputation score would be affected by these incidents, so that better decisions could be made to improve the reputation rate.";

echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results
if ($result->num_rows > 0) {
	#headers are below
    echo "<table><tr><th>r</th><th>CorrelationCoefficients</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table rows
        echo "<tr><td>" . $row["r"]. "</td><td>" . $row["CorrelationCoefficients"]. "</td></tr>";
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



