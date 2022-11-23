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
$sql="SELECT *
FROM(
	SELECT Seat_ID,
		Class,
		Model,
		Leg_Space,
		ROUND(AVG(Leg_Space) OVER (PARTITION BY Class, Model),2) AS avg_Leg_Space
	FROM Seat s
	JOIN Flight f ON s.Flight_ID = f.Flight_ID
	ORDER BY Seat_ID) AS temp
WHERE Leg_Space < avg_Leg_Space;
 ";
#Summary goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","Find out the average leg space of seats by class and aircraft model";
 
 #objective goes here
echo "<br><br>","<b>","Objective:","</b>","<br>"," We want to improve the passenger experience, so we decided to compare each seat’s leg space with its related average leg space based on its class type and aircraft model. Despite being in the same class of the same aircraft model, leg space can vary depending on the position of the seats in the cabin. So, for those seats that are lower than their corresponding averages, we want to adjust them
";

echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results
if ($result->num_rows > 0) {
	#headers are below
    echo "<table><tr><th>Seat_ID</th><th>Class</th><th>Model</th><th>Leg_Space</th><th>avg_Leg_Space</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table rows
        echo "<tr><td>" . $row["Seat_ID"]. "</td><td>" . $row["Class"]. "</td><td>". $row["Model"]. "</td><td>". $row["Leg_Space"]. "</td><td>". $row["avg_Leg_Space"]. "</td></tr>";
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



