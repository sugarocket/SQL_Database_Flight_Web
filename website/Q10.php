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
$sql="SELECT
a.Sex,
COUNT(Sex) AS 'Num_Gmails'
FROM 
(SELECT
p.Passenger_ID,
p.Sex
FROM Passengers p, Ticket t
WHERE p.Passenger_ID = t.Passenger_ID
AND p.Email LIKE '%@gmail.com') a
GROUP BY Sex;
 ";
  #Summary goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","Number gmail accounts by male or females passengers";

 #objective goes here
echo "<br><br>","<b>","Objective:","</b>","<br>","We would like to improve our offerings for Gmail account users to make our emails go from the “promotion” section to the “primary section” as sales believes this will give us better visibility, but only for Women. How many Female customers do we currently have on gmail?";

echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results update line 47
if ($result->num_rows > 0) {
    echo "<table><tr><th>Number of Gmail Emails</th><th>Sex</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table headers
        echo "<tr><td>" . $row["Num_Gmails"]. "</td><td>" . $row["Sex"]. "</td></tr>";
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


