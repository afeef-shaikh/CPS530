<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtered Photos</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
        }

        h1 {
            font-size: 1.8rem;
            color: #4A4A4A;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        label, select, input {
            font-size: 1rem;
        }

        select, input[type="submit"] {
            padding: 8px 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        select:focus, input[type="submit"]:focus {
            outline: none;
            border-color: #007BFF;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .photo-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }

        .photo {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
            text-align: center;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .photo:hover {
            transform: translateY(-10px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        }

        .photo img {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #ddd;
        }

        .photo p {
            margin: 10px;
            font-size: 0.9rem;
            color: #555;
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

$sqlLocations = "SELECT DISTINCT location FROM Photograph";
$sqlYears = "SELECT DISTINCT YEAR(date_taken) AS year FROM Photograph ORDER BY year ASC";

$resultLocations = mysqli_query($connect, $sqlLocations);
$resultYears = mysqli_query($connect, $sqlYears);
?>

<h1>Filter Photos by Location and Year</h1>

<form action="" method="post">
    <label for="location">Location:</label>
    <select name="location" id="location">
        <option value="">-- All Locations --</option>
        <?php while ($rowLocation = mysqli_fetch_assoc($resultLocations)) : ?>
            <option value="<?= htmlspecialchars($rowLocation['location']) ?>"><?= htmlspecialchars($rowLocation['location']) ?></option>
        <?php endwhile; ?>
    </select>

    <label for="year">Year:</label>
    <select name="year" id="year">
        <option value="">-- All Years --</option>
        <?php while ($rowYear = mysqli_fetch_assoc($resultYears)) : ?>
            <option value="<?= htmlspecialchars($rowYear['year']) ?>"><?= htmlspecialchars($rowYear['year']) ?></option>
        <?php endwhile; ?>
    </select>

    <input type="submit" value="Filter">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $selectedLocation = $_POST["location"] ?? '';
    $selectedYear = $_POST["year"] ?? '';

    // Use prepared statements to prevent SQL injection
    $sqlQuery = "SELECT * FROM Photograph WHERE 1";
    $params = [];
    $types = '';

    if (!empty($selectedLocation)) {
        $sqlQuery .= " AND location = ?";
        $params[] = $selectedLocation;
        $types .= 's';
    }

    if (!empty($selectedYear)) {
        $sqlQuery .= " AND YEAR(date_taken) = ?";
        $params[] = $selectedYear;
        $types .= 's';
    }

    $stmt = mysqli_prepare($connect, $sqlQuery);
    if ($stmt && $types) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    if ($stmt && mysqli_stmt_execute($stmt)) {
        $resultQuery = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultQuery) > 0) {
            echo '<div class="photo-container">';
            while ($rowPhoto = mysqli_fetch_assoc($resultQuery)) {
                echo '<div class="photo">';
                echo '<img src="' . htmlspecialchars($rowPhoto['picture_url']) . '" alt="' . htmlspecialchars($rowPhoto['subject']) . '">';
                echo '<p><strong>' . htmlspecialchars($rowPhoto['subject']) . '</strong>';
                echo 'Location: ' . htmlspecialchars($rowPhoto['location']) . '<br>';
                echo 'Date Taken: ' . htmlspecialchars($rowPhoto['date_taken']) . '</p>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p class="error">No images found for the selected filters. Please try again.</p>';
        }
    } else {
        echo '<p class="error">Error executing query: ' . htmlspecialchars(mysqli_error($connect)) . '</p>';
    }

    if ($stmt) {
        mysqli_stmt_close($stmt);
    }
}
mysqli_close($connect);
?>
</body>
</html>
