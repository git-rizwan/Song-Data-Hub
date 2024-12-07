<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Path to the CSV file
$csvFile = 'song.csv';

// Check if the file exists and is readable
if (!file_exists($csvFile) || !is_readable($csvFile)) {
    die('CSV file not found or not readable.');
}

// Read CSV file and convert to array
$songs = array_map('str_getcsv', file($csvFile));

// Ensure the CSV file has content
if (count($songs) < 2) {
    die('CSV file is empty or does not have enough rows.');
}

// Use the first row as header keys
$headers = $songs[0];
array_shift($songs); // Remove the header row

// Convert rows to associative arrays using the headers
$songs = array_map(function($row) use ($headers) {
    return array_combine($headers, $row);
}, $songs);

// Function to sanitize YouTube URLs
function sanitizeYouTubeURL($url) {
    // Remove any query parameters from the URL
    $url = strtok($url, '?');
    return htmlspecialchars($url);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>Islamic Nasheeds</title>
    <link rel="icon" href="Duff-logo.jpeg" type="image/icontype" id="duff-logo">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    
</head>
<body>
    
   <nav class="NAV">
       
       <div id="img-and-title">
         <img id="nasheed" src="Islamic_nasheed_bg.jpg" alt="nasheed_img">
         <br>
         <!-- <h1 id="title">Dr.Julia</h1> -->
       </div>
      
       <div id="nasheed-desc">
         <p>Nasheeds are Islamic devotional songs, often performed a cappella or with minimal percussion. They focus on 
          themes like praising Allah, honoring the Prophet Muhammad, and conveying ethical lessons. Typically performed 
          in Arabic, they also exist in various languages, reflecting the global Muslim community. Nasheeds are integral
          to Islamic culture, used in religious and social settings to inspire and uplift.</p>
       </div>
      
      
      

    </nav>     
 
    
    <div id="song-container">
        <?php foreach ($songs as $song): ?>
            <div class="song-item">
                <iframe src="<?= sanitizeYouTubeURL($song['SongURL']) ?>" frameborder="0" allowfullscreen></iframe>
                <h3><?= htmlspecialchars($song['Songname']) ?></h3>
                <p>Composer: <?= htmlspecialchars($song['Composer']) ?></p>
                <p>Duration: <?= htmlspecialchars($song['Duration']) ?></p>
            </div>
  

        <?php endforeach; ?>
    </div>
   
    
    
    <button id="up-scroll">
        <a href="#" style="color: red"> <i class="fa fa-chevron-up"></i></a>
    </button>
    <footer>
        <p>Copyright 2024 | Developed by Rizwan A</p>
    </footer>
    
    <script src="script.js"></script>
    <script>
      window.addEventListener("scroll", function () {
        const upScrollButton = document.getElementById("up-scroll");
        if (window.scrollY > 100) {
          // Adjust this value based on your layout
          upScrollButton.style.opacity = "1";
          upScrollButton.style.visibility = "visible";
        } else {
          upScrollButton.style.opacity = "0";
          upScrollButton.style.visibility = "hidden";
        }
    });
    </script>

<script src="https://www.youtube.com/iframe_api"></script>

</body>
</html>
