<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photograph Table</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F4F4F4; /* Light pastel background */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 1rem;
        }
        table {
            width: 90%;
            max-width: 800px;
            border-collapse: collapse;
            background: #ffffff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #6C5B7B; /* Modern purple header */
            color: #ffffff;
            font-weight: bold;
        }
        td {
            border-bottom: 1px solid #ddd;
        }
        tr:last-child td {
            border-bottom: none;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .error {
            color: red;
            font-size: 1.2rem;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <h1>Photograph Table Information</h1>
    <?php
    require_once "config.php";

    $sqlFetchData = "SELECT picture_number, subject, location, date_taken, picture_url FROM Photograph ORDER BY date_taken DESC";
    $result = mysqli_query($connect, $sqlFetchData);

    if ($result) {
        echo "<table>";
        echo "<tr><th>Picture Number</th><th>Subject</th><th>Location</th><th>Date Taken</th><th>Picture URL</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['picture_number']}</td>";
            echo "<td>{$row['subject']}</td>";
            echo "<td>{$row['location']}</td>";
            echo "<td>{$row['date_taken']}</td>";
            echo "<td><a href='{$row['picture_url']}' target='_blank'>{$row['picture_url']}</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else {
        echo "<p class='error'>Error fetching data: " . mysqli_error($connect) . "</p>";
    }

    mysqli_close($connect);
    ?>
</body>
</html>
