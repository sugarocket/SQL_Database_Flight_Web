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
$sql="SELECT Airport_City AS 'Destination',
Departure_Datetime,
Reference_Price,
Duration 
FROM Flight AS f 
INNER JOIN Airports AS ap ON f.Airport_Code_Departure = ap.Airport_Code
WHERE ap.Airport_City = 'Toronto'
AND YEAR (f.Departure_Datetime) = 2021 
AND MONTH (f.Departure_Datetime) = 10 
ORDER BY Reference_Price ASC;
 ";
 #Summary goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","Show Destination city, Departure_Datetime, Price, Duration which flights’ departure date within 2021-Oct and departure airport is Pearson, Sort prices in ASC.";

 #objective goes here
echo "<br><br>","<b>","Objective:","</b>","<br>","There is a customer who lives in Toronto and works on an intensive project, but now, he will have a month break in 2021-Oct and he is willing to travel somewhere by taking flight, but he has no plan right now. Our business website is providing a function to let him search all the eligible flights for his demand by using his city airport and show several important information about the flights. For example, this guy is price sensitive, then we sort the price of each flight for him to let him make a choice.";

echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results
if ($result->num_rows > 0) {
	#headers are below
    echo "<table><tr><th>Destination</th><th> Departure_Datetime   </th><th>Reference_Price</th><th> Duration </th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table rows
        echo "<tr><td>" . $row['Destination']. "</td><td>" . $row["Departure_Datetime"]."</td><td>". $row["Reference_Price"]."</td><td>". $row["Duration"]."</td></tr>";
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



