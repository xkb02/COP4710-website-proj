<!-- query_results.php -->
<?php include 'db_connect.php'; ?>
<html>
<head>
    <title>Query Results</title>
</head>
<body>
    <h2>Query Results</h2>
    <?php
    if (isset($_POST['query'])) {
        $query = $_POST['query'];
        try {
            $result = $conn->query($query);
            
            if ($result === FALSE) {
                echo "Error: " . $conn->error;
            } else if ($result->num_rows > 0) {
                echo "<table border='1'>";
                // Print header row
                $first = true;
                while($row = $result->fetch_assoc()) {
                    if ($first) {
                        echo "<tr>";
                        foreach($row as $key => $value) {
                            echo "<th>".$key."</th>";
                        }
                        echo "</tr>";
                        $first = false;
                    }
                    echo "<tr>";
                    foreach($row as $value) {
                        echo "<td>".$value."</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No results found";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    ?>
    <p><a href="custom_query.php">Back to Query Form</a></p>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>