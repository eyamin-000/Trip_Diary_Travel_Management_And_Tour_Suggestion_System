<?php
session_start();
require_once '../models/tripModel.php';

if (!isset($_SESSION['user'])) { 
    header("Location: login.php"); 
    exit(); 
}

$user_id = $_SESSION['user']['id'];
$my_plans = getUserPlannedTrips($user_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Plan Your Trip - Trip Diary</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body
        {
            margin: 0;
            font-family: Arial;
            background: #f4f4f4; }
        .top-black
        {
            width: 100%;
            height: 100px;
            background: #000;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative; }

        .back-btn {
            position: absolute; 
            left: 20px; 
            top: 35px; 
            background: #fff; 
            color: #000; 
            border: none; 
            padding: 5px 15px; 
            cursor: pointer; 
            font-weight: bold; }
        
        .main-container 
        { display: flex; 
        padding: 30px; 
        gap: 20px; }
        .box 
        { 
            background: #fff; 
            padding: 20px; 
            border-radius: 8px; 
         }
        
        .left-box
        {
             flex: 1; 
    }
        .left-box input, .left-box select, .left-box textarea 
        { 
            width: 100%; 
            padding: 10px; 
            margin-bottom: 10px; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
            box-sizing: border-box; }
        .save-btn 
        { 
            width: 100%; 
            padding: 10px; 
            background: #000; 
            color: #fff; 
            border: none; 
            cursor: pointer; 
            font-size: 16px; 
        }

        .right-box 
        { 
            flex: 1; 
            max-height: 500px; 
            overflow-y: auto; }
        .trip-item 
        { border: 1px solid #ddd; 
        margin-bottom: 10px; 
        border-radius: 5px; 
        overflow: hidden; }
        .trip-title-bar 
        { background: #eee; 
        padding: 15px; 
        cursor: pointer; 
        font-weight: bold; 
        display: flex; 
        justify-content: space-between; }
        .trip-details 
        { padding: 15px; 
        background: #fafafa; 
        display: none; 
        border-top: 1px solid #ddd; }
        .trip-details p 
        { margin: 5px 0; 
        font-size: 14px; 
        color: #555; }
    </style>
</head>
<body>

    <div class="white-section">
        <button class="back-btn" onclick="location.href='dashboard.php'">BACK</button>
        <h1 class="header-title">PLAN YOUR TRIP</h1>
    </div>

    <div class="black-section">
        <div class="form-area">
            <input type="text" id="dest" placeholder="Destination">
            <input type="number" id="day" placeholder="Days">
            <input type="text" id="transport" placeholder="Transport">
            <textarea id="note" placeholder="Short Note"></textarea>
            <input type="text" id="location" placeholder="Departure Location">
            <input type="number" id="budget" placeholder="Budget">
            <button class="add-btn" onclick="savePlan()">Add To Plan</button>
        </div>

        <div class="table-area">
            <div class="scroll-box">
                <table>
                    <thead>
                        <tr>
                            <th>Destination</th><th>Day</th><th>Transport</th><th>Budget</th><th>Note</th><th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($my_plans)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['destination']); ?></td>
                                <td><?php echo $row['day']; ?></td>
                                <td><?php echo $row['transport']; ?></td>
                                <td><?php echo $row['budget']; ?></td>
                                <td><?php echo $row['note']; ?></td>
                                <td><button class="del-btn" onclick="deletePlan(<?php echo $row['id']; ?>)">Delete</button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../script.js"></script>
</body>
</html>
