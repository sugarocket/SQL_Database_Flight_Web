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
$sql="SELECT Airport_Name, Reputation
FROM Airports
WHERE Reputation > (SELECT AVG (Reputation) AS average_rep FROM Airports);
 ";
  #Summary goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","Airports with higher than average ratings";

 #objective goes here
echo "<br><br>","<b>","Objective:","</b>","<br>","We want to improve the customer experience of our top-tier customers, as a result we will recommend them flights that are going to the best rated airports.";

echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results update line 47
if ($result->num_rows > 0) {
    echo "<table><tr><th>Airport Name</th><th>Reputation</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table headers
        echo "<tr><td>" . $row["Airport_Name"]. "</td><td>" . $row["Reputation"]. "</td></tr>";
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


