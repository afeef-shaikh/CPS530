<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ontario Photos</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
        }

        h1 {
            margin-top: 20px;
            font-size: 2rem;
            color: #4A4A4A;
        }

        .photo-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin: 20px auto;
            padding: 0 15px;
        }

        .photo {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .photo:hover {
            transform: translateY(-10px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        }

        img {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #ddd;
        }

        .photo p {
            margin: 10px;
            color: #555;
            font-size: 0.9rem;
        }

        .photo p strong {
            display: block;
            margin-bottom: 5px;
            font-size: 1rem;
            color: #333;
        }

        .error {
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php
require_once "config.php";

$sqlOntarioPhotos = "SELECT picture_number, subject, location, date_taken, picture_url 
                     FROM Photograph 
                     WHERE location LIKE '%Ontario%'";
$result = mysqli_query($connect, $sqlOntarioPhotos);

if ($result) {
    echo "<h1>Ontario Photos</h1>";

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='photo-container'>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='photo'>";
            echo "<img src='{$row['picture_url']}' alt='Image of {$row['subject']}'>";
            echo "<p><strong>{$row['subject']}</strong>{$row['location']}</p>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>No Ontario photos found.</p>";
    }

    mysqli_free_result($result);
} else {
    echo "<p class='error'>Error fetching data: " . mysqli_error($connect) . "</p>";
}

mysqli_close($connect);
?>
</body>
</html>
