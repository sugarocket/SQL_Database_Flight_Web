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
    p.Sex,
    #The below returns the domain name by searching for the first ‘@’ symbol and returning everything to the right of it aka the bit we care about
    RIGHT(email, length(email)-INSTR(email, '@')),
    100*COUNT(RIGHT(email, length(email)-INSTR(email, '@')))/c.Total_Count AS '%_of_Email_Domain'
FROM Passengers p,
    #The subquery will pull together a total count of all rows needed for proportion
    #this is then cartesian joined to the other results but grouped by is applied 
    (SELECT
        COUNT(*) AS 'Total_Count'
    FROM Passengers) c
#Grouping the
GROUP BY RIGHT(email, length(email)-INSTR(email, '@')),c.Total_Count,p.Sex
ORDER BY COUNT(RIGHT(email, length(email)-INSTR(email, '@'))) DESC;
 ";

  #Summary goes here
echo "<br><br>","<b>","Summary:","</b>","<br>","Number of emails broken down by domain and geneder.";

 #objective goes here
echo "<br><br>","<b>","Objective:","</b>","<br>","We are attempting to have an email campaign. The colors and designs are customized based on the customer but some fundamental design choices are biased towards one gender or another and show up better on one domain (Gmail vs. Yahoo) versus others. Who should the marketing team design the email campaign for?";

echo "<br><br><b>","The query is: ","</b><br>",$sql,"<br><br><br>";

$result = $conn->query($sql);

#table of results update line 47
if ($result->num_rows > 0) {
    echo "<table><tr><th>Customer Sex</th><th>% of Email Domains</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #the below line are the table headers
        echo "<tr><td>" . $row["Sex"]. "</td><td>" . $row["%_of_Email_Domain"]. "</td></tr>";
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




