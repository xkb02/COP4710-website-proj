// results.php
<?php
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
    <title>Query Results</title>
</head>
<body>";

echo "<h1>Query Results</h1>";

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    echo "<h3>Executed Query:</h3>";
    echo "<pre>$query</pre>";
    echo "<hr>";
    
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
            echo "<p>No results found or query returned no data.</p>";
        }
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error executing query: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>No query was submitted.</p>";
}

echo "<hr>
<p><a href='onefilephp.php?view=query'>Back to Query Form</a> | 
<a href='onefilephp.php'>Back to Home</a></p>
</body>
</html>";

$conn->close();
?>