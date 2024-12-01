<!-- search_results.php -->
<?php include 'db_connect.php'; ?>
<html>
<head>
    <title>Search Results</title>
</head>
<body>
    <h2>Search Results</h2>
    <?php
    if ($_GET['type'] == 'house') {
        $conditions = array();
        
        if (!empty($_GET['min_price'])) $conditions[] = "P.price >= " . intval($_GET['min_price']);
        if (!empty($_GET['max_price'])) $conditions[] = "P.price <= " . intval($_GET['max_price']);
        if (!empty($_GET['bedrooms'])) $conditions[] = "H.bedrooms = " . intval($_GET['bedrooms']);
        if (!empty($_GET['bathrooms'])) $conditions[] = "H.bathrooms = " . intval($_GET['bathrooms']);

        $where = !empty($conditions) ? "WHERE " . implode(" AND ", $conditions) : "";

        $query = "SELECT P.*, H.bedrooms, H.bathrooms, H.size
                  FROM Property P
                  JOIN House H ON P.address = H.address
                  $where";
        
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>Address</th>
                        <th>Price</th>
                        <th>Bedrooms</th>
                        <th>Bathrooms</th>
                        <th>Size</th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["address"]."</td>
                        <td>".$row["price"]."</td>
                        <td>".$row["bedrooms"]."</td>
                        <td>".$row["bathrooms"]."</td>
                        <td>".$row["size"]."</td>
                    </tr>";
            }
            echo "</table>";
        }
    } else if ($_GET['type'] == 'business') {
        $conditions = array();
        
        if (!empty($_GET['min_price'])) $conditions[] = "P.price >= " . intval($_GET['min_price']);
        if (!empty($_GET['max_price'])) $conditions[] = "P.price <= " . intval($_GET['max_price']);
        if (!empty($_GET['min_size'])) $conditions[] = "B.size >= " . intval($_GET['min_size']);
        if (!empty($_GET['max_size'])) $conditions[] = "B.size <= " . intval($_GET['max_size']);

        $where = !empty($conditions) ? "WHERE " . implode(" AND ", $conditions) : "";

        $query = "SELECT P.*, B.type, B.size
                  FROM Property P
                  JOIN Business_Property B ON P.address = B.address
                  $where";
        
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>Address</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th>Size</th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["address"]."</td>
                        <td>".$row["price"]."</td>
                        <td>".$row["type"]."</td>
                        <td>".$row["size"]."</td>
                    </tr>";
            }
            echo "</table>";
        }
    }
    ?>
    <p><a href="search.php">Back to Search</a></p>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>