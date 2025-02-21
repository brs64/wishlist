<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/upload.css">
    <title>Upload Article</title>
</head>
<body>
    <h1>Add an Article to Wishlist</h1>
    <form action="../utilities/upload.function.php" method="POST">
        <label for="url">Article URL:</label>
        <input type="url" id="url" name="url" required>
        <br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>
        <br>
        <button type="submit">Add Article</button>
    </form>
</body>
</html>
