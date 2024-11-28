<!-- agents.php -->
<?php include 'db_connect.php'; ?>
<html>
<head>
    <title>Real Estate Agents</title>
</head>
<body>
    <h2>Real Estate Agents</h2>
    <?php
    $query = "SELECT A.*, F.name as firmName, 
              (SELECT COUNT(*) FROM Listings L WHERE L.agentId = A.agentId) as listingCount
              FROM Agent A
              JOIN Firm F ON A.firmId = F.id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Firm</th>
                    <th>Date Started</th>
                    <th>Active Listings</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["name"]."</td>
                    <td>".$row["phone"]."</td>
                    <td>".$row["firmName"]."</td>
                    <td>".$row["dateStarted"]."</td>
                    <td>".$row["listingCount"]."</td>
                </tr>";
        }
        echo "</table>";
    }
    ?>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>