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
$sql="SELECT MAX(Price_Paid) AS Max_Price,
Min(Price_Paid) AS Minimum_Price 
FROM Ticket;
 ";
  #Summary goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","Max and Min price of tickets";

 #objective goes here
echo "<br><br>","<b>","Objective:","</b>","<br>","Customers are becoming more price sensitive. We want to determine the range of prices our site offers to update our rating on google. Keeping our prices low will allow us to remain competitive.";

echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results
if ($result->num_rows > 0) {
    echo "<table><tr><th>Max_Price</th><th>Minimum_Price</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table rows
         echo "<tr><td>" . $row["Max_Price"]. "</td><td>" . $row["Minimum_Price"]. "</td></tr>";
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