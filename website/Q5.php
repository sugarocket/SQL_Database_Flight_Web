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
$sql="SELECT Sex,
AVG(Age) AS average_age
FROM Passengers
GROUP BY Sex;
 ";
 
 #objective goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","Show the average age of passengers by sex.
";

echo "<br><br>","<b>","Objective:","</b>","<br>","The marketing manager wants to launch a new ad campaign that would ultimately increase our customer retention. He needs the average age of our customers in order to create a campaign that would  be tailored to the specific demographic of our customers.";


echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results
if ($result->num_rows > 0) {
	#headers are below
    echo "<table><tr><th>Sex</th><th>average_age</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table rows
        echo "<tr><td>" . $row["Sex"]. "</td><td>" . $row["average_age"]. "</td></tr>";
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



