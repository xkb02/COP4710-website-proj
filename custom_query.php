<!-- custom_query.php -->
<?php include 'db_connect.php'; ?>
<html>
<head>
    <title>Custom Query</title>
</head>
<body>
    <h2>Execute Custom Query</h2>
    <form method="POST" action="query_results.php">
        <textarea name="query" rows="10" cols="50"></textarea><br>
        <input type="submit" value="Execute Query">
    </form>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>