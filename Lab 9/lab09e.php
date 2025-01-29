<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problem 5</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 5px;
            background-color: rgb(220, 227, 210);
            text-align: center;
        }
        .rand {
            width: 80%;
            max-width: 600px;
            margin: 10px auto;
            padding: 10px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: white;
        }
        .rand img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto 10px;
        }
        .rand p {
            margin: 0;
            color: #333;
        }
    </style>
</head>
<body>

<h1>Random Image from the Database</h1>

<?php
require_once "config.php";

// Fetch a random image
$sqlRandomImage = "SELECT * FROM Photograph ORDER BY RAND() LIMIT 1";
$resultRandomImage = mysqli_query($connect, $sqlRandomImage);

// Fetch the total number of images
$sqlTotalImages = "SELECT COUNT(*) AS total FROM Photograph";
$resultTotalImages = mysqli_query($connect, $sqlTotalImages);

if ($resultTotalImages) {
    $rowTotalImages = mysqli_fetch_assoc($resultTotalImages);
    $totalImages = $rowTotalImages['total'];
} else {
    $totalImages = "Unknown"; // Handle error gracefully
}

if ($resultRandomImage && mysqli_num_rows($resultRandomImage) > 0) {
    $rowRandomImage = mysqli_fetch_assoc($resultRandomImage);
    echo '<div class="rand">';
    echo '<img src="' . htmlspecialchars($rowRandomImage['picture_url']) . '" alt="' . htmlspecialchars($rowRandomImage['subject']) . '">';
    echo '<p><strong>' . htmlspecialchars($rowRandomImage['subject']) . '</strong><br>';
    echo 'Location: ' . htmlspecialchars($rowRandomImage['location']) . '<br>';
    echo 'Date Taken: ' . htmlspecialchars($rowRandomImage['date_taken']) . '</p>';
    echo '</div>';
} else {
    echo '<p>No random image found.</p>';
}

echo '<h3>Total number of images in the database from Photograph table: ' . htmlspecialchars($totalImages) . '</h3>';
?>

</body>
</html>
