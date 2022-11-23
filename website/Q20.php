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
$sql="SELECT CONCAT(First_Name,' ', Last_Name) AS 'Target_Name',
Birth,
Phone
FROM Passengers AS p 
WHERE p.Passenger_ID NOT IN (SELECT Passenger_ID FROM Ticket);
 ";
 #Summary goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","Show the name, birthday, phone number of all passengers who do not currently have a ticket purchased.";

 #objective goes here
echo "<br><br>","<b>","Objective:","</b>","<br>","For those customers who have a potential purchase chance, our business is thinking about sending each of them a coupon through SMS message to reactivate them, but due to budget control, we will only send coupons on the birthday of those customers.
";

echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results
if ($result->num_rows > 0) {
	#headers are below
    echo "<table><tr><th>Target name</th><th>BirthDay</th><th>Phone</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table rows
        echo "<tr><td>" . $row["Target_Name"]. "</td><td>" . $row["Birth"]. "</td><td>". $row["Phone"]. "</td></tr>";
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



