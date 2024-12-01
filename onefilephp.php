<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "RealEst";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<!DOCTYPE html>
<html>
<head>
    <title>Real Estate Database</title>
</head>
<body>";

// Navigation menu
echo "<h1>Real Estate Database</h1>
<a href='onefilephp.php'>Home</a> | 
<a href='onefilephp.php?view=listings'>View Listings</a> | 
<a href='onefilephp.php?view=search_house'>Search Houses</a> | 
<a href='onefilephp.php?view=search_business'>Search Business Properties</a> | 
<a href='onefilephp.php?view=agents'>View Agents</a> | 
<a href='onefilephp.php?view=buyers'>View Buyers</a> | 
<a href='onefilephp.php?view=query'>Custom Query</a>
<hr>";

if (isset($_GET['view'])) {
    switch($_GET['view']) {
        case 'listings':
            // Houses
            echo "<h2>House Listings</h2>";
            $query = "SELECT P.*, H.bedrooms, H.bathrooms, H.size, L.mlsNumber, L.dateListed, A.name as agentName 
                      FROM Property P 
                      JOIN House H ON P.address = H.address 
                      LEFT JOIN Listings L ON P.address = L.address
                      LEFT JOIN Agent A ON L.agentId = A.agentId";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                echo "<table border='1'>
                    <tr><th>Address</th><th>Price</th><th>Bedrooms</th><th>Bathrooms</th>
                    <th>Size</th><th>MLS</th><th>Listed Date</th><th>Agent</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["address"]."</td><td>".$row["price"]."</td>
                    <td>".$row["bedrooms"]."</td><td>".$row["bathrooms"]."</td>
                    <td>".$row["size"]."</td><td>".$row["mlsNumber"]."</td>
                    <td>".$row["dateListed"]."</td><td>".$row["agentName"]."</td></tr>";
                }
                echo "</table>";
            }

            // Business Properties
            echo "<h2>Business Property Listings</h2>";
            $query = "SELECT P.*, B.type, B.size, L.mlsNumber, L.dateListed, A.name as agentName 
                      FROM Property P 
                      JOIN Business_Property B ON P.address = B.address 
                      LEFT JOIN Listings L ON P.address = L.address
                      LEFT JOIN Agent A ON L.agentId = A.agentId";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                echo "<table border='1'>
                    <tr><th>Address</th><th>Price</th><th>Type</th><th>Size</th>
                    <th>MLS</th><th>Listed Date</th><th>Agent</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["address"]."</td><td>".$row["price"]."</td>
                    <td>".$row["type"]."</td><td>".$row["size"]."</td>
                    <td>".$row["mlsNumber"]."</td><td>".$row["dateListed"]."</td>
                    <td>".$row["agentName"]."</td></tr>";
                }
                echo "</table>";
            }
            break;

        case 'search_house':
            echo "<h2>Search Houses</h2>
            <form method='GET'>
                <input type='hidden' name='view' value='house_results'>
                Min Price: <input type='number' name='min_price'><br>
                Max Price: <input type='number' name='max_price'><br>
                Bedrooms: <input type='number' name='bedrooms'><br>
                Bathrooms: <input type='number' name='bathrooms'><br>
                <input type='submit' value='Search'>
            </form>";
            break;

        case 'house_results':
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
            echo "<h2>House Search Results</h2>";
            if ($result->num_rows > 0) {
                echo "<table border='1'>
                    <tr><th>Address</th><th>Price</th><th>Bedrooms</th><th>Bathrooms</th><th>Size</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["address"]."</td><td>".$row["price"]."</td>
                    <td>".$row["bedrooms"]."</td><td>".$row["bathrooms"]."</td>
                    <td>".$row["size"]."</td></tr>";
                }
                echo "</table>";
            }
            break;

        case 'search_business':
            echo "<h2>Search Business Properties</h2>
            <form method='GET'>
                <input type='hidden' name='view' value='business_results'>
                Min Price: <input type='number' name='min_price'><br>
                Max Price: <input type='number' name='max_price'><br>
                Min Size (sq ft): <input type='number' name='min_size'><br>
                Max Size (sq ft): <input type='number' name='max_size'><br>
                <input type='submit' value='Search'>
            </form>";
            break;

        case 'business_results':
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
            echo "<h2>Business Property Search Results</h2>";
            if ($result->num_rows > 0) {
                echo "<table border='1'>
                    <tr><th>Address</th><th>Price</th><th>Type</th><th>Size</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["address"]."</td><td>".$row["price"]."</td>
                    <td>".$row["type"]."</td><td>".$row["size"]."</td></tr>";
                }
                echo "</table>";
            }
            break;

        case 'agents':
            $query = "SELECT A.*, F.name as firmName, 
                      (SELECT COUNT(*) FROM Listings L WHERE L.agentId = A.agentId) as listingCount
                      FROM Agent A
                      JOIN Firm F ON A.firmId = F.id";
            $result = $conn->query($query);
            echo "<h2>Real Estate Agents</h2>";
            if ($result->num_rows > 0) {
                echo "<table border='1'>
                    <tr><th>Name</th><th>Phone</th><th>Firm</th><th>Date Started</th><th>Active Listings</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["name"]."</td><td>".$row["phone"]."</td>
                    <td>".$row["firmName"]."</td><td>".$row["dateStarted"]."</td>
                    <td>".$row["listingCount"]."</td></tr>";
                }
                echo "</table>";
            }
            break;

        case 'buyers':
            $query = "SELECT B.*, A.name as agentName
                      FROM Buyer B
                      LEFT JOIN Works_With W ON B.id = W.buyerId
                      LEFT JOIN Agent A ON W.agentId = A.agentId";
            $result = $conn->query($query);
            echo "<h2>Buyers and Preferences</h2>";
            if ($result->num_rows > 0) {
                echo "<table border='1'>
                    <tr><th>Name</th><th>Phone</th><th>Property Type</th><th>Preferences</th>
                    <th>Price Range</th><th>Working With</th></tr>";
                while($row = $result->fetch_assoc()) {
                    $preferences = $row["propertyType"] == "House" ?
                        "Bedrooms: ".$row["bedrooms"].", Bathrooms: ".$row["bathrooms"] :
                        "Type: ".$row["businessPropertyType"];

                    echo "<tr><td>".$row["name"]."</td><td>".$row["phone"]."</td>
                    <td>".$row["propertyType"]."</td><td>".$preferences."</td>
                    <td>".$row["minimumPreferredPrice"]." - ".$row["maximumPreferredPrice"]."</td>
                    <td>".$row["agentName"]."</td></tr>";
                }
                echo "</table>";
            }
            break;

            case 'query':
                echo "<h2>Custom Query</h2>
                <form action='query_results.php' method='POST'>
                    <textarea name='query' rows='5' cols='50'></textarea><br>
                    <input type='submit' value='Execute Query'>
                </form>";
            break;
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'execute_query') {
    echo "<h2>Query Results</h2>";
    $query = $_POST['query'];
    try {
        $result = $conn->query($query);
        if ($result && $result->num_rows > 0) {
            echo "<table border='1'>";
            $first = true;
            while($row = $result->fetch_assoc()) {
                if ($first) {
                    echo "<tr>";
                    foreach($row as $key => $value) {
                        echo "<th>$key</th>";
                    }
                    echo "</tr>";
                    $first = false;
                }
                echo "<tr>";
                foreach($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No results or error in query";
        }
    } catch (Exception $e) {
        echo "Error executing query: " . $e->getMessage();
    }
} else {
    echo "<h2>Welcome to the Real Estate Database</h2>
          <p>Please select an option from the menu above.</p>";
}

echo "</body></html>";
$conn->close();
?>