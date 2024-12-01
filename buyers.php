<!-- buyers.php -->
<?php include 'db_connect.php'; ?>
<html>
<head>
    <title>Buyers Information</title>
</head>
<body>
    <h2>Buyers and Their Preferences</h2>
    <?php
    $query = "SELECT B.*, A.name as agentName
              FROM Buyer B
              LEFT JOIN Works_With W ON B.id = W.buyerId
              LEFT JOIN Agent A ON W.agentId = A.agentId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Property Type</th>
                    <th>Preferences</th>
                    <th>Price Range</th>
                    <th>Agent</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            $preferences = $row["propertyType"] == "House" ? 
                "Beds: ".$row["bedrooms"].", Baths: ".$row["bathrooms"] :
                "Type: ".$row["businessPropertyType"];
            
            echo "<tr>
                    <td>".$row["name"]."</td>
                    <td>".$row["phone"]."</td>
                    <td>".$row["propertyType"]."</td>
                    <td>".$preferences."</td>
                    <td>".$row["minimumPreferredPrice"]." - ".$row["maximumPreferredPrice"]."</td>
                    <td>".$row["agentName"]."</td>
                </tr>";
        }
        echo "</table>";
    }
    ?>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>