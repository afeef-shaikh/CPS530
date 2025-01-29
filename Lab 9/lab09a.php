<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Problem 1</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F8F4F4; /* Soft pastel background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }
        .container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 90%;
            text-align: center;
        }
        .message {
            font-size: 1.5rem;
            color: #6C5B7B; /* Soft purple text */
            margin: 1rem 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        require_once "config.php";

        // Drop existing table
        $sqlDropTable = "DROP TABLE IF EXISTS Photograph;";
        mysqli_query($connect, $sqlDropTable);

        // Create new table
        $sqlCreateTable = "CREATE TABLE Photograph (
            sku INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            picture_number INT(6),
            subject VARCHAR(50),
            location VARCHAR(50),
            date_taken DATE,
            picture_url VARCHAR(100)
        );";

        if (mysqli_query($connect, $sqlCreateTable)) {
            echo "<p class='message'>Table created in the database successfully.</p>";
        } else {
            echo "<p class='message'>Error creating table: " . mysqli_error($connect) . "</p>";
        }

        // Insert data into the table
        $sql = "INSERT INTO Photograph (picture_number, subject, location, date_taken, picture_url)
        VALUES 
        (1, 'Banff National Park', 'Banff, Alberta, Canada', '2023-08-15', 'images/banff.jpg'),
        (2, 'Niagara Falls', 'Ontario, Canada', '2023-08-20', 'images/niagara_falls.jpg'),
        (3, 'Peggy’s Cove Lighthouse', 'Nova Scotia, Canada', '2023-09-10', 'images/peggys_cove.jpg'),
        (4, 'Rocky Mountains', 'British Columbia, Canada', '2023-07-18', 'images/rocky_mountains.jpg'),
        (5, 'Mount Fuji', 'Honshu, Japan', '2023-09-12', 'images/mount_fuji.jpg'),
        (6, 'Great Barrier Reef', 'Queensland, Australia', '2023-06-25', 'images/great_barrier_reef.jpg'),
        (7, 'Grand Canyon', 'Arizona, USA', '2023-08-05', 'images/grand_canyon.jpg'),
        (8, 'Northern Lights', 'Yukon, Canada', '2023-11-10', 'images/northern_lights.jpg'),
        (9, 'Santorini Coastline', 'Santorini, Greece', '2023-07-30', 'images/santorini.jpg'),
        (10, 'Torres del Paine', 'Patagonia, Chile', '2023-08-22', 'images/torres_del_paine.jpg');";

        if (mysqli_query($connect, $sql)) {
            echo "<p class='message'>Data inserted into the Photograph table successfully.</p>";
        } else {
            echo "<p class='message'>Error inserting data: " . mysqli_error($connect) . "</p>";
        }

        mysqli_close($connect);
        ?>
    </div>
</body>
</html>
