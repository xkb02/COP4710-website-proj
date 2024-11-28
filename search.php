<!-- search.php -->
<?php include 'db_connect.php'; ?>
<html>
<head>
    <title>Search Properties</title>
</head>
<body>
    <h2>Search Houses</h2>
    <form method="GET" action="search_results.php">
        <input type="hidden" name="type" value="house">
        Min Price: <input type="number" name="min_price"><br>
        Max Price: <input type="number" name="max_price"><br>
        Bedrooms: <input type="number" name="bedrooms"><br>
        Bathrooms: <input type="number" name="bathrooms"><br>
        <input type="submit" value="Search Houses">
    </form>

    <h2>Search Business Properties</h2>
    <form method="GET" action="search_results.php">
        <input type="hidden" name="type" value="business">
        Min Price: <input type="number" name="min_price"><br>
        Max Price: <input type="number" name="max_price"><br>
        Min Size: <input type="number" name="min_size"><br>
        Max Size: <input type="number" name="max_size"><br>
        <input type="submit" value="Search Business Properties">
    </form>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>