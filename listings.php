<!-- listings.php -->
<?php include 'db_connect.php'; ?>
<html>
<head>
    <title>Property Listings</title>
</head>
<body>
    <h2>Houses</h2>
    <?php
    $query = "SELECT P.*, H.bedrooms, H.bathrooms, H.size, L.mlsNumber, L.dateListed, A.name as agentName 
              FROM Property P 
              JOIN House H ON P.address = H.address 
              LEFT JOIN Listings L ON P.address = L.address
              LEFT JOIN Agent A ON L.agentId = A.agentId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Address</th>
                    <th>Price</th>
                    <th>Bedrooms</th>
                    <th>Bathrooms</th>
                    <th>Size</th>
                    <th>MLS</th>
                    <th>Listed Date</th>
                    <th>Agent</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["address"]."</td>
                    <td>".$row["price"]."</td>
                    <td>".$row["bedrooms"]."</td>
                    <td>".$row["bathrooms"]."</td>
                    <td>".$row["size"]."</td>
                    <td>".$row["mlsNumber"]."</td>
                    <td>".$row["dateListed"]."</td>
                    <td>".$row["agentName"]."</td>
                </tr>";
        }
        echo "</table>";
    }
    ?>

    <h2>Business Properties</h2>
    <?php
    $query = "SELECT P.*, B.type, B.size, L.mlsNumber, L.dateListed, A.name as agentName 
              FROM Property P 
              JOIN Business_Property B ON P.address = B.address 
              LEFT JOIN Listings L ON P.address = L.address
              LEFT JOIN Agent A ON L.agentId = A.agentId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Address</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>MLS</th>
                    <th>Listed Date</th>
                    <th>Agent</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["address"]."</td>
                    <td>".$row["price"]."</td>
                    <td>".$row["type"]."</td>
                    <td>".$row["size"]."</td>
                    <td>".$row["mlsNumber"]."</td>
                    <td>".$row["dateListed"]."</td>
                    <td>".$row["agentName"]."</td>
                </tr>";
        }
        echo "</table>";
    }
    ?>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>