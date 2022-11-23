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
$sql="SELECT Model,
COUNT(Model) AS Number_Aircraft_No_Wifi,
Wifi_Option
FROM Aircraft
WHERE Year_Build < 2008
AND Wifi_Option = 0
GROUP BY Model;
 ";
 
 #objective goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","[Show all the aircrafts that were built before 2008 and that do not have the WIFI option.]
";
echo "</b>","<br>","The purpose of this question is for the team to know what aircrafts they should not use for their flights as they are more ancient and do not have the WIFI option.
";

echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results
if ($result->num_rows > 0) {
	#headers are below
    echo "<table><tr><th>Model</th><th><th><th>Number_Aircraft_No_Wifi</th><th><th>Wifi_Option</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table rows
        echo "<tr><td>" . $row["Model"]. "</td><td><td><td>" . $row["Number_Aircraft_No_Wifi"]. "</td><td><td>". $row["Wifi_Option"]. "</td></tr>";
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



