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
$sql="SELECT Airline_Name,
Reputation_rate
FROM Airline
WHERE Reputation_rate > (SELECT AVG (Reputation_rate) AS average_rep FROM Airline);
 ";
 #Summary goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","Show the airline names that have a reputation rate greater than the average.";

 #objective goes here
echo "<br><br>","<b>","Objective:","</b>","<br>","[The purpose of this query is for the airline managers to understand who are the most popular airlines on the market that significantly stand out from the others.
";

echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results
if ($result->num_rows > 0) {
	#headers are below
    echo "<table><tr><th>Airline_Name</th><th>Reputation_rate</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table rows
        echo "<tr><td>" . $row["Airline_Name"]. "</td><td>" . $row["Reputation_rate"]. "</td></tr>";
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



