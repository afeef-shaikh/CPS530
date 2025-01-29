<?php
function getTime() {
    date_default_timezone_set('America/Toronto');
    $currentTime = date('H:i:s');

    if ($currentTime >= '05:00:00' && $currentTime < '12:00:00') {
        return 'morning';
    } elseif ($currentTime >= '12:00:00' && $currentTime < '17:00:00') {
        return 'afternoon';
    } elseif ($currentTime >= '17:00:00' && $currentTime < '21:00:00') {
        return 'evening';
    } else {
        return 'night';
    }
}

function getGreeting() {
    $time = getTime();

    if ($time === 'morning') {
        return 'Good morning!';
    } elseif ($time === 'afternoon') {
        return 'Good afternoon!';
    } elseif ($time === 'evening') {
        return 'Good evening!';
    } elseif ($time === 'night') {
        return 'Good night!';
    }
}

function hitCounter() {
    if (!isset($_COOKIE["hitCounter"])) {
        $counter = 1;
        setcookie("hitCounter", $counter);
    } else {
        $counter = $_COOKIE["hitCounter"] + 1;
        setcookie("hitCounter", $counter);
    }

    return $counter;
} 

function getThanksgiving() {
    $images = ['chicken.gif', 'pie.gif', 'thanks.gif', 'turkey.gif', 'turkey9.gif'];
    $img = 'None';
    $ImgFromURL = '';

    if (isset($_GET['image'])) {
        $ImgFromURL = $_GET['image'];
    } 

    if (in_array($ImgFromURL, $images)) {
        $img = $ImgFromURL;
    }

    return $img;
}

$time = getTime();
$greeting = getGreeting();
$counter = hitCounter();
$thanksgiving = getThanksgiving();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab08</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <link rel="stylesheet" href="lab08.css">
    <script src="lab08.js"></script>
</head>
<body>
    <section>
        <div class="<?php echo $time; ?>">
            <h2>Problem 1</h2>
            
            <?php echo '<span class="greeting">' . $greeting . '</span>'; ?>
            
            <p id="timeContainer"></p>
        </div>
    </section>
    <hr>

    <section>
        <div class="math">
            <form action="lab08b.php" target="_blank" method="post">
                <h2> Problem 2 </h2>
                
                <label for="num1">Enter the first number (between 3 and 12):</label>
                <input type="number" id="num1" name="num1">
                
                <label for="num2">Enter the second number (between 3 and 12):</label>
                <input type="number" id="num2" name="num2">
                
                <input type="submit" value="Generate Table">
            </form>
        </div>
    </section>
    <hr>

    <section style="color: white;">
        <div class="thanksgiving">
            <h2> Problem 3 </h2>
            
            <a href="?image=chicken.gif"> chicken.gif </a>
            <a href="?image=pie.gif"> pie.gif </a>
            <a href="?image=thanks.gif"> thanks.gif </a>
            <a href="?image=turkey.gif"> turkey.gif </a>
            <a href="?image=turkey9.gif"> turkey9.gif </a>

            <p class="return">Current Image: <?php echo $thanksgiving; ?></p>
        </div>
    </section>
    <hr>

    <div id="thanksgiving-img">
        <img src="imgs/<?php echo $thanksgiving; ?>">
    </div>

    <div id="visit-counter">
        <h3> Problem 3</h3>
        <p>Visits: <?php echo $counter; ?></p>
    </div>
    <footer>
    <p>&copy; 2024 Afeef Shaikh | CPS530 Lab 08</p>
</footer>
</body>

</html>