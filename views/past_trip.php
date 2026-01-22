<?php
session_start();
require_once '../models/pastTripModel.php';
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }
$past_trips = getUserPastTrips($_SESSION['user']['id']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Past Trips - Trip Diary</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body { margin: 0; font-family: Arial; background: #f4f4f4; }
        .top-black { height: 100px; background: #000; color: #fff; display: flex; align-items: center; justify-content: center; position: relative; }
        .back-btn { position: absolute; left: 20px; top: 35px; background: #fff; color: #000; border: none; padding: 5px 15px; cursor: pointer; font-weight: bold; }
        
        .main-container { display: flex; padding: 30px; gap: 20px; }
        .box { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        
        .left-box { flex: 1; }
        .left-box input, .left-box select, .left-box textarea { width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .save-btn { width: 100%; padding: 10px; background: #000; color: #fff; border: none; cursor: pointer; font-size: 16px; }

        .right-box { flex: 1; max-height: 500px; overflow-y: auto; }
        .trip-item { border: 1px solid #ddd; margin-bottom: 10px; border-radius: 5px; overflow: hidden; }
        .trip-title-bar { background: #eee; padding: 15px; cursor: pointer; font-weight: bold; display: flex; justify-content: space-between; }
        .trip-details { padding: 15px; background: #fafafa; display: none; border-top: 1px solid #ddd; }
        .trip-details p { margin: 5px 0; font-size: 14px; color: #555; }
    </style>
</head>
<body>

    <div class="top-black">
        <button class="back-btn" onclick="location.href='dashboard.php'">BACK</button>
        <h1 style="margin:0; letter-spacing: 5px;">PAST TRIP</h1>
    </div>

    <div class="main-container">
        <div class="box left-box">
            <h3>Add New Memory</h3>
            <input type="text" id="p_dest" placeholder="Destination Name">
            <select id="p_type">
                <option value="Solo">Solo</option>
                <option value="Family">Family</option>
                <option value="Friends">Friends</option>
            </select>
            <input type="date" id="p_date">
            <input type="text" id="p_country" placeholder="Country/Region">
            <input type="text" id="p_title" placeholder="Trip Title">
            <textarea id="p_desc" placeholder="Short Description" rows="4"></textarea>
            <button class="save-btn" onclick="savePastTrip()">Save Trip</button>
        </div>

        <div class="box right-box">
            <h3>Past Trip List</h3>
            <?php if(mysqli_num_rows($past_trips) > 0) {
                while($row = mysqli_fetch_assoc($past_trips)) { ?>
                <div class="trip-item">
                    <div class="trip-title-bar" onclick="toggleDetails(<?php echo $row['id']; ?>)">
                        <span><?php echo htmlspecialchars($row['title']); ?></span>
                        <span>▼</span>
                    </div>
                    <div class="trip-details" id="details_<?php echo $row['id']; ?>">
                        <p><strong>Destination:</strong> <?php echo htmlspecialchars($row['destination']); ?></p>
                        <p><strong>Type:</strong> <?php echo $row['trip_type']; ?></p>
                        <p><strong>Date:</strong> <?php echo $row['trip_date']; ?></p>
                        <p><strong>Region:</strong> <?php echo htmlspecialchars($row['country']); ?></p>
                        <hr>
                        <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                    </div>
                </div>
            <?php } } else { echo "No trips saved yet."; } ?>
        </div>
    </div>

    <script src="../script.js"></script>
</body>
</html>